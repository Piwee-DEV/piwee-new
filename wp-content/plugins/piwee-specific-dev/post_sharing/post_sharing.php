<?php

use Doctrine\Common\Cache\PhpFileCache;
use SocialShare\SocialShare;
use SocialShare\Provider\Facebook;
use SocialShare\Provider\Twitter;
use SocialShare\Provider\LinkedIn;
use SocialShare\Provider\Pinterest;
use SocialShare\Provider\Google;
use Elasticsearch\ClientBuilder;

$cache = new PhpFileCache(SHARECOUNT_CACHE_LOCATION); // Use sys_get_temp_dir() to get the system temporary directory, but be aware of the security risk if your website is hosted on a shared server
$socialShare = new SocialShare($cache);

$socialShare->registerProvider(new Facebook());
$socialShare->registerProvider(new Twitter());
$socialShare->registerProvider(new Linkedin());
$socialShare->registerProvider(new Pinterest());
$socialShare->registerProvider(new Google());

const ES_INDEX_NAME = 'piwee_wordpress';
const ES_TYPE_NAME = 'post';

$Es_hosts = ES_HOSTS;

$client = ClientBuilder::create()->setHosts(explode(',', $Es_hosts))->build();
$current_loaded_post_for_update = array();

init_es_index_if_not_exists();


/**
 * Return shares counts data from a public API
 * @param $providerName
 * @param $url
 * @return int
 */
function social_share_shares($providerName, $url)
{
    global $socialShare;

    $shares = $socialShare->getShares($providerName, $url);

    return $shares;
}

/**
 * Create the index in ES if it does not exists
 */
function init_es_index_if_not_exists() {

    global $client;

    $exists = $client->indices()->exists(['index' => ES_INDEX_NAME]);

    if(!$exists) {

        $params = [
            'index' => ES_INDEX_NAME,
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];

        $client->indices()->create($params);
    }
}

/**
 * Refresh a post share count
 * @param $post_id
 */
function refresh_share_count_in_db($post_id)
{
    $count = 0;
    $networks = array("facebook", "linkedin", "google", "pinterest", "twitter");
    $permalink = get_permalink($post_id);
    $month = date('m.Y');
    $week = date('W.m.Y');

    foreach ($networks as $network) {
        $count += social_share_shares($network, $permalink);
    }

    //Update in DB
    update_or_create_share_count($post_id, 'total_share_count', $count);

    //Store in DB by month
    update_or_create_share_count($post_id, 'total_share_count_month_' . $month, $count);

    //Store in DB by week
    update_or_create_share_count($post_id, 'total_share_count_week_' . $week, $count);

    //A "month diff" for the current month share diff
    $oneMonthAgo = date("m.Y", strtotime("-1 months"));

    //A "week diff" for the current month share diff
    $oneWeekAgo = date("W.m.Y", strtotime("-1 weeks"));

    $shareCountData = get_post_share_count($post_id);
    $countOneMonthAgo = $shareCountData['total_share_count_month_' . $oneMonthAgo];
    $countOneWeekAgo = $shareCountData['total_share_count_week_' . $oneWeekAgo];

    if ($countOneMonthAgo != null) {

        $diff = $count - $countOneMonthAgo;

        update_or_create_share_count($post_id, 'share_count_month_diff_' . $month, $diff);
    }

    if ($countOneWeekAgo != null) {

        $diff = $count - $countOneWeekAgo;

        update_or_create_share_count($post_id, 'share_count_week_diff_' . $week, $diff);
    }

    commit_update_or_create_share_count($post_id);
}

/**
 * Update share count in loaded $current_loaded_post_for_update
 * Lazy load $current_loaded_post_for_update
 *
 * @param $post_id
 * @param $key
 * @param $value
 */
function update_or_create_share_count($post_id, $key, $value) {

    global $client;
    global $current_loaded_post_for_update;

    if(!$current_loaded_post_for_update) {

        $params = [
            'index' => ES_INDEX_NAME,
            'type' => ES_TYPE_NAME,
            'id' => $post_id
        ];

        $exists = $client->exists($params);

        $post = [];

        if($exists) {
            $post = $client->getSource($params);
        }

        $current_loaded_post_for_update = $post;

    }

    $current_loaded_post_for_update[$key] = $value;

}

/**
 * Update the current $current_loaded_post_for_update to ES
 * @param $post_id
 */
function commit_update_or_create_share_count($post_id) {

    global $client;
    global $current_loaded_post_for_update;

    $params = [
        'index' => ES_INDEX_NAME,
        'type' => ES_TYPE_NAME,
        'id' => $post_id,
        'body' => $current_loaded_post_for_update
    ];

    $client->index($params);

    //Reset payload
    $current_loaded_post_for_update = array();
}


/**
 * Get post share count data
 *
 * @param $post_id
 * @param $key
 * @return null
 */
function get_post_share_count($post_id) {

    global $client;

    $params = [
        'index' => ES_INDEX_NAME,
        'type' => ES_TYPE_NAME,
        'id' => $post_id
    ];

    $exists = $client->exists($params);

    if($exists) {
        $post = $client->getSource($params);
        return $post;
    }

    return array();
}

/**
 * Get total share counts
 *
 * @param $post_id
 * @return array
 */
function get_total_share_count($post_id)
{
    $month = date('m.Y');

    global $client;

    $params = [
        'index' => ES_INDEX_NAME,
        'type' => ES_TYPE_NAME,
        'id' => $post_id
    ];

    $exists = $client->exists($params);

    if($exists) {
        $post = $client->getSource($params);
    }

    $total_share_count = null;
    if($post && isset($post['total_share_count'])) {
        $total_share_count = $post['total_share_count'];
    }

    $total_share_count_month = null;
    if($post && isset($post['total_share_count_month_' . $month])) {
        $total_share_count_month = $post['total_share_count_month_' . $month];
    }

    $share_count_month_diff = null;
    if($post && isset($post['share_count_month_diff_' . $month])) {
        $share_count_month_diff = $post['share_count_month_diff_' . $month];
    }

    return array('total_share_count' => $total_share_count,
        'total_share_count_month' => $total_share_count_month,
        'share_count_month_diff' => $share_count_month_diff);
}


/**
 * Refresh share counts for recent posts
 */
function refresh_share_count_in_db_recent_posts()
{
    $posts = query_posts(array('posts_per_page' => 1000, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));

    foreach($posts as $post) {
        refresh_share_count_in_db($post->ID);
    }

    return $posts;
}

function migrate_post_share_count() {

    ini_set('memory_limit', '-1');

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=192.168.0.1;dbname=piwee_old;charset=utf8', 'root', 'piwee123', $pdo_options);

    $query = $bdd->prepare("select * from wp_postmeta where meta_key like '%share_%'");
    $query->execute();

    $all = $query->fetchAll();

    echo 'results count : ' . count($all) . PHP_EOL;

    foreach($all as $a) {
        update_or_create_share_count($a['post_id'], $a['meta_key'], $a['meta_value']);
        echo 'update post ' . $a['post_id'] . ' forkey ' . $a['meta_key'] . ' forvalue' . $a['meta_value'] . PHP_EOL;
    }
}