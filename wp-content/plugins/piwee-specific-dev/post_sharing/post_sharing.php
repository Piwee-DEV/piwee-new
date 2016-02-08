<?php

use Doctrine\Common\Cache\PhpFileCache;
use SocialShare\SocialShare;
use SocialShare\Provider\Facebook;
use SocialShare\Provider\Twitter;
use SocialShare\Provider\LinkedIn;
use SocialShare\Provider\Pinterest;
use SocialShare\Provider\Google;


$cache = new PhpFileCache("/tmp"); // Use sys_get_temp_dir() to get the system temporary directory, but be aware of the security risk if your website is hosted on a shared server
$socialShare = new SocialShare($cache);

$socialShare->registerProvider(new Facebook());
$socialShare->registerProvider(new Twitter());
$socialShare->registerProvider(new Linkedin());
$socialShare->registerProvider(new Pinterest());
$socialShare->registerProvider(new Google());

function social_share_link($providerName, $url, $options = array())
{
    global $socialShare;

    return $socialShare->getLink($providerName, $url, $options);
}

function social_share_shares($providerName, $url)
{
    global $socialShare;

    return $socialShare->getShares($providerName, $url);
}

function get_total_share_count($post_id)
{
    $month = date('m.Y');

    $total_share_count = get_post_meta($post_id, 'total_share_count', true);
    $total_share_count_month = get_post_meta($post_id, 'total_share_count_month_' . $month, true);
    $share_count_month_diff = get_post_meta($post_id, 'share_count_month_diff_' . $month, true);

    $site_url = "http://" . $_SERVER['SERVER_NAME'];

    //shell_exec('curl --data "action=refresh_share_count_in_db&post_id=' . $post_id . '" ' . $site_url . '/wp-admin/admin-ajax.php > /dev/null 2>/dev/null &');

    return array('total_share_count' => $total_share_count,
        'total_share_count_month' => $total_share_count_month,
        'share_count_month_diff' => $share_count_month_diff);
}

/**
 * This ajax call is called from a cron task.
 * It refreshes all share count of every posts.
 */
function refresh_share_count_in_db_cron()
{
    $posts = query_posts(array('posts_per_page' => 1300, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));

    $site_url = "http://" . $_SERVER['SERVER_NAME'];

    foreach($posts as $post) {
        shell_exec('curl --data "action=refresh_share_count_in_db&post_id=' . $post->ID . '" ' . $site_url . '/wp-admin/admin-ajax.php > /dev/null 2>/dev/null &');
        echo "UPDATE SHARE COUNT " . $post->ID . " ";
    }
}

add_action('wp_ajax_refresh_share_count_in_db_cron', 'refresh_share_count_in_db_cron');
add_action('wp_ajax_nopriv_refresh_share_count_in_db_cron', 'refresh_share_count_in_db_cron');

/**
 * Called by a back2front CURL
 */
function refresh_share_count_in_db()
{
    $post_id = $_POST['post_id'];
    $count = 0;
    $networks = array("facebook", "linkedin", "google", "pinterest");
    $permalink = get_permalink($post_id);
    $month = date('m.Y');
    $week = date('W.m.Y');

    foreach ($networks as $network) {
        $count += social_share_shares($network, $permalink);
    }

    //Update in DB
    add_post_meta($post_id, 'total_share_count', $count, true)
    || update_post_meta($post_id, 'total_share_count', $count);

    //Store in DB by month
    add_post_meta($post_id, 'total_share_count_month_' . $month, $count, true)
    || update_post_meta($post_id, 'total_share_count_month_' . $month, $count);

    //Store in DB by week
    add_post_meta($post_id, 'total_share_count_week_' . $week, $count, true)
    || update_post_meta($post_id, 'total_share_count_week_' . $week, $count);

    //A "month diff" for the current month share diff
    $oneMonthAgo = date("m.Y", strtotime("-1 months"));

    //A "week diff" for the current month share diff
    $oneWeekAgo = date("W.m.Y", strtotime("-1 weeks"));

    $countOneMonthAgo = get_post_meta($post_id, 'total_share_count_month_' . $oneMonthAgo, true);
    $countOneWeekAgo = get_post_meta($post_id, 'total_share_count_week_' . $oneWeekAgo, true);

    if ($countOneMonthAgo != null) {

        $diff = $count - $countOneMonthAgo;

        add_post_meta($post_id, 'share_count_month_diff_' . $month, $diff, true)
        || update_post_meta($post_id, 'share_count_month_diff_' . $month, $diff);
    }

    if ($countOneWeekAgo != null) {

        $diff = $count - $countOneWeekAgo;

        add_post_meta($post_id, 'share_count_week_diff_' . $week, $diff, true)
        || update_post_meta($post_id, 'share_count_week_diff_' . $week, $diff);
    }

    echo $count;

    die();
}

add_action('wp_ajax_refresh_share_count_in_db', 'refresh_share_count_in_db');
add_action('wp_ajax_nopriv_refresh_share_count_in_db', 'refresh_share_count_in_db');