<?php
/**
 * Created by PhpStorm.
 * User: alexandrenguyen
 * Date: 14/01/16
 * Time: 23:35
 */
// Creating the widget
class vote_horizontal_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'vote_horizontal_widget',

            // Widget name will appear in UI
            __('Piwee Vote Horizontal', 'vote_horizontal_widget'),

            // Widget description
            array('description' => __('Provide a vote horizontal especially for PIWEE', 'vote_horizontal_widget'),)
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output

        $queried_object = get_queried_object();

        if ($queried_object) {
            $post_id = $queried_object->ID;
            $votes = getPostVoteCountAndPercent($post_id);
        }

        ?>

        <div class="vote-widget">

            <h3 class="vote-widget-title widget-head">VOTRE AVIS <span class="vote-count">(<?php echo $votes['total'] ?> votes)</span></h3>

            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-name="Génie" data-progress="<?php echo $votes['Génie']['percent'] ?>%">
                                        <span class="vote-widget-txt-percent"><?php echo $votes['Génie']['percent'] ?>
                                            %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#"
                               onclick="PiweeVote(<?php echo $post_id; ?>, <?php echo getChoiceIdByName('Génie'); ?>); return false;">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-genie.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-name="Créatif" data-progress="<?php echo $votes['Créatif']['percent'] ?>%">
                                        <span class="vote-widget-txt-percent"><?php echo $votes['Créatif']['percent'] ?>
                                            %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#"
                               onclick="PiweeVote(<?php echo $post_id; ?>, <?php echo getChoiceIdByName('Créatif'); ?>); return false;">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-creatif.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-name="Fun" data-progress="<?php echo $votes['Fun']['percent'] ?>%">
                                        <span class="vote-widget-txt-percent"><?php echo $votes['Fun']['percent'] ?>
                                            %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#"
                               onclick="PiweeVote(<?php echo $post_id; ?>, <?php echo getChoiceIdByName('Fun'); ?>); return false;">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-fun.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-name="déjà vu" data-progress="<?php echo $votes['déjà vu']['percent'] ?>%">
                                        <span class="vote-widget-txt-percent"><?php echo $votes['déjà vu']['percent'] ?>
                                            %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#"
                               onclick="PiweeVote(<?php echo $post_id; ?>, <?php echo getChoiceIdByName('déjà vu'); ?>); return false;">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-deja-vu.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="vote-display-ok">
                Votre vote a bien été pris en compte, merci !
            </div>
        </div>

        <script>

            var voteProgressTimeout;

            $(window).scroll(function () {

                clearTimeout(voteProgressTimeout);

                var hT = $('.vote-widget').offset().top,
                    hH = $('.vote-widget').outerHeight(),
                    wH = $(window).height(),
                    wS = $(this).scrollTop();
                if (wS > (hT + hH - wH)) {
                    voteProgressTimeout = setTimeout(function () {

                        $('.vote-widget .inner').each(function () {
                            $(this).animate({
                                height: $(this).attr("data-progress")
                            }, 1500);

                        });
                    }, 600);
                }
            });

        </script>

        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {

    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {

        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}


// Register and load the widget
function load_vote_horizontal_widget()
{
    register_widget('vote_horizontal_widget');
}

add_action('widgets_init', 'load_vote_horizontal_widget');


?>