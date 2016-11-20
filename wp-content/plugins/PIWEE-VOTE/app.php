<?php
/*
Plugin Name: PIWEE Vote Module
Plugin URI: http://alexandrenguyen.fr
Description: Vote module for PIWEE
Version: 2.0
Author: Alexandre Nguyen
Author URI: http://alexandrenguyen.fr
License: Copyright 2016 Alexandre Nguyen  (email : alex.nr@hotmail.co.jp)

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as
        published by the Free Software Foundation.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once("widgets/piwee_vote_horizontal_widget.php");

register_activation_hook(__FILE__, 'registerTables');
add_action('admin_menu', 'register_vote_page');

//frontend voting system
add_action("wp_ajax_nopriv_my_user_vote", "my_user_vote");
add_action("wp_ajax_my_user_vote", "my_user_vote");
add_action("wp_ajax_nopriv_my_user_vote_update", "my_user_vote_update");
add_action("wp_ajax_my_user_vote_update", "my_user_vote_update");
add_action("wp_ajax_nopriv_get_vote_count_and_percent", "getPostVoteCountAndPercentAjax");
add_action("wp_ajax_get_vote_count_and_percent", "getPostVoteCountAndPercentAjax");
add_action("wp_ajax_nopriv_get_max_vote_entity", "getMaxVoteEntityAjax");
add_action("wp_ajax_get_max_vote_entity", "getMaxVoteEntityAjax");


function register_vote_page()
{
    add_menu_page('PIWEE Vote', 'PIWEE Vote', 'manage_options', 'vote_page', 'vote_page', plugins_url('images/logo-piwee.jpg', __FILE__), null);
}

function vote_page()
{
    global $wpdb;

    if (isset($_POST['name'])) { //add
        addVoteChoice($_POST['name']);
    }

    if (isset($_POST['choice_id'])) { //delete
        deleteVoteChoice($_POST['choice_id']);
    }

    ?>

    <h3>Ajouter un nouveau choix de vote</h3>
    <form action="#" method="POST">
        <input type="text" name="name" placeholder="Nouveau choix de vote" required>
        <input type="submit" value="Ajouter" class="button">
    </form>

    <?php

    $choices = getChoices();

    foreach ($choices as $choice) {

        ?>

        <p>
            <?php echo $choice->name ?>
        <form action="#" method="POST">
            <input type="hidden" name="choice_id" value="<?php echo $choice->id ?>">
            <input type="submit" value="Supprimer" class="button"
                   onclick="return confirm('Voulez-vous vraiment supprimer cette entrée ?');">
        </form>
        </p>

        <hr>

        <?php
    }

    ?>

    <?php

}

function deleteVoteChoice($id)
{

    global $wpdb;
    $wpdb->query($wpdb->prepare("DELETE FROM wp_piwee_vote_field WHERE id = %d", $id));
}

function addVoteChoice($name)
{
    global $wpdb;
    $wpdb->query($wpdb->prepare("INSERT INTO wp_piwee_vote_field(name) VALUES(%s)", array($name)));
}

function getChoices()
{
    global $wpdb;
    $result = $wpdb->get_results("SELECT * FROM  wp_piwee_vote_field");

    return $result;
}

function isCategoryAVoteCategory($permalink) {

    $choices = getChoices();

    $splittedPermalink = explode('/', $permalink);
    $slug = $splittedPermalink[2];

    $category = get_category_by_slug($slug);

    foreach ($choices as $choice) {

        if (unaccent(strtoupper($category->name)) == unaccent(strtoupper($choice->name))
            || unaccent(strtoupper($category->name)) == unaccent(strtoupper($choice->name))) {
            return true;
            break;
        }
    }

    return false;

}

function unaccent($string) {
    return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
}

function getVotePostsForCategory($permalink)
{
    global $wpdb;

    $choices = getChoices();

    $splittedPermalink = explode('/', $permalink);
    $slug = $splittedPermalink[2];

    $category = get_category_by_slug($slug);

    foreach ($choices as $choice) {
        
        if (unaccent(strtoupper($category->name)) == unaccent(strtoupper($choice->name))
            || unaccent(strtoupper($category->name)) == unaccent(strtoupper($choice->name))) {

            $title = $choice->name;

            $post_ids_results = $wpdb->get_results("SELECT post_id FROM wp_piwee_vote WHERE vote_field_id = " . $choice->id . " GROUP BY post_id ORDER BY COUNT(*) DESC LIMIT 20;");

            $posts = array();

            foreach($post_ids_results as $post_ids_result) {
                $post = get_post($post_ids_result->post_id);
                $posts[] = $post;
            }

        }
    }

    if (!$posts) {
        return null;
    }

    return array('title' => $title, 'posts' => $posts);
}

function getChoiceIdByName($field_name)
{
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM  wp_piwee_vote_field WHERE name = '" . $field_name . "'");

    return $result->id;
}

function registerTables()
{
    global $wpdb;

    $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_piwee_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `vote_field_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

    $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_piwee_vote_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

}

function my_user_vote_update()
{
    $response = new stdClass;

    $choice_id = $_REQUEST['choice_id'];
    $post_id = $_REQUEST['post_id'];
    $choice_id_to_remove = $_REQUEST['choice_id_to_remove'];

    vote($post_id, $choice_id, $choice_id_to_remove);

    $response->result = "ok";

    echo json_encode($response);

    die();
}

function my_user_vote()
{
    $response = new stdClass;

    $choice_id = $_REQUEST['choice_id'];
    $post_id = $_REQUEST['post_id'];

    vote($post_id, $choice_id);

    $response->result = "ok";

    echo json_encode($response);

    die();
}

function vote($post_id, $choice_id, $choice_id_to_remove = null)
{
    global $wpdb;

    if ($choice_id_to_remove) {
        $wpdb->query("DELETE FROM wp_piwee_vote WHERE post_id = " . $post_id . " AND vote_field_id = " . $choice_id_to_remove . " LIMIT 1");
    }

    $wpdb->query("INSERT INTO wp_piwee_vote(post_id, vote_field_id, datetime) VALUES($post_id, $choice_id, '" . date("Y-m-d H:i:s") . "')");
}

function getVoteCountByPostAndChoice($choice_id = null, $post_id = null)
{
    global $wpdb;
    $entries = $wpdb->query("SELECT id FROM wp_piwee_vote WHERE post_id = " . $post_id . " AND vote_field_id = " . $choice_id);

    return $entries;
}

function getPostVoteCountAndPercent($post_id)
{
    if($post_id) {

        $choices = getChoices();
        $votes = array();

        //get votes in an array
        foreach ($choices as $choice) {
            $count = getVoteCountByPostAndChoice($choice->id, $post_id);
            $votes[] = array('name' => $choice->name, 'count' => $count);
        }

        //calculate vote percent rate
        $total = 0;

        //incrementing total
        foreach ($votes as $vote) {
            $total += $vote['count'];
        }

        //calculate percent with the count and total
        foreach ($votes as $key => $vote) {
            $percent = 0;
            if ($total > 0) {
                $percent = round($vote['count'] * 100 / $total, 0);
            }
            $vote['percent'] = $percent;
            $votes[$key] = $vote;
        }

        //reformat array by setting the name as a key and not as a value
        $formattedVotes = array();
        foreach ($votes as $vote) {
            $formattedVotes[$vote['name']] = $vote;
            unset($formattedVotes[$vote['name']]['name']);
        }

        $formattedVotes['total'] = $total;

        return $formattedVotes;
    }
    else {
        return false;
    }
}

function getPostVoteCountAndPercentAjax()
{
    $post_id = $_POST['post_id'];
    $response = getPostVoteCountAndPercent($post_id);
    $response = json_encode($response);
    echo $response;
    die();
}

function getMaxVoteEntityAjax()
{

    $post_id = $_REQUEST['post_id'];
    $entity = getMaxVoteEntity($post_id);

    echo json_encode($entity);

    die;
}

function getMaxVoteEntity($post_id)
{
    $votes = getPostVoteCountAndPercent($post_id);
    $max = 0;
    $maxEntity = null;
    foreach ($votes as $key => $vote) {
        if ($vote['count'] > $max) {
            $max = $vote['count'];
            $maxEntity = $vote;
            $maxEntity['name'] = $key;
        }
    }

    return $maxEntity;
}

add_action('wp_head', 'registerVotingJS');

function registerVotingJS()
{

    ?>
    <script type="text/javascript">

        var genieImg = '<?php echo get_template_directory_uri() . '/assets/img/piwee-icon/GENIE-flat-icons-piwee.png'; ?>';
        var dejavuImg = '<?php echo get_template_directory_uri() . '/assets/img/piwee-icon/DEJA-VU-flat-icons-piwee.png'; ?>';
        var funImg = '<?php echo get_template_directory_uri() . '/assets/img/piwee-icon/FUN-flat-icons-piwee.png'; ?>';
        var creatifImg = '<?php echo get_template_directory_uri() . '/assets/img/piwee-icon/CREATIF-flat-icons-piwee.png'; ?>';

        function reloadVoteWidget(post_id) {

            jQuery.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php') ?>",
                data: {action: "get_vote_count_and_percent", post_id: post_id},
                success: function (response) {

                    var votesEntities = JSON.parse(response);

                    $('.total-vote-count').text(votesEntities.total + ' votes');
                    $('.vote-count').text('(' + votesEntities.total + ' votes)');

                    //Refresh widget below posts
                    $('.vote-widget .inner').each(function () {

                        for (var voteEntityKey in votesEntities) {

                            var vote = votesEntities[voteEntityKey];

                            if (voteEntityKey == $(this).attr("data-name")) {

                                $(this).find('.vote-widget-txt-percent').text(vote.percent + "%");
                                $(this).attr('data-progress', vote.percent + "%");

                                $(this).animate({
                                    height: vote.percent + "%"
                                }, 1500);
                            }
                        }

                    });

                    //Refresh header
                    $('.progress-bar').each(function () {

                        for (var voteEntityKey in votesEntities) {

                            var vote = votesEntities[voteEntityKey];

                            if (voteEntityKey == $(this).attr("data-name")) {

                                $(this).attr('data-progress', vote.percent + "%");

                                console.log($(this).parent().parent());

                                $(this).parent().parent().parent().find('.bar-percent').html('<span>' + vote.percent + '%</span>');

                                $(this).animate({
                                    width: vote.percent + "%"
                                }, 700);
                            }
                        }

                    });

                }
            });

            //Update total vote count and max vote
            jQuery.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php') ?>",
                data: {action: "get_max_vote_entity", post_id: post_id},
                success: function (response) {

                    var maxEntity = JSON.parse(response);

                    $('.max-vote-entity .percent').text(maxEntity.percent + '%');
                    $('.max-vote-entity .description').text(maxEntity.name);

                    $('.img-max-entity').attr('src', getVoteIcon(maxEntity.name));

                }
            });
        }

        function getVoteIcon(name) {

            var vote_icon = '';

            switch (name) {
                case "Génie":
                    vote_icon = genieImg;
                    break;
                case "déjà vu":
                    vote_icon = dejavuImg;
                    break;
                case "Fun":
                    vote_icon = funImg;
                    break;
                case "Créatif":
                    vote_icon = creatifImg;
                    break;
            }

            return vote_icon;
        }

        function PiweeVote(post_id, choice_id) {

            var voteCookie = jQuery.cookie("piwee_vote_post_" + post_id);

            if (!(voteCookie > 0)) {

                //This user never voted, we just add a vote
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php') ?>",
                    data: {action: "my_user_vote", post_id: post_id, choice_id: choice_id},
                    success: function (response) {

                        response = JSON.parse(response);

                        if (response.result == "ok") {
                            jQuery("#vote-display-ok").show("fast");
                            jQuery.cookie("piwee_vote_post_" + post_id, choice_id);
                            reloadVoteWidget(post_id);
                        }
                    }
                });
            }
            else {

                //This use already voted, we update its vote
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php') ?>",
                    data: {
                        action: "my_user_vote_update",
                        post_id: post_id,
                        choice_id: choice_id,
                        choice_id_to_remove: voteCookie
                    },
                    success: function (response) {

                        response = JSON.parse(response);

                        if (response.result == "ok") {
                            jQuery("#vote-display-ok").show("fast");
                            jQuery.cookie("piwee_vote_post_" + post_id, choice_id);
                            reloadVoteWidget(post_id);
                        }
                    }
                });
            }

        }

    </script>
    <?php
}
