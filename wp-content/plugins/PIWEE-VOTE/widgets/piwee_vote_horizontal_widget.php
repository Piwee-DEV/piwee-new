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

        ?>

        <div class="vote-widget">

            <h3 class="vote-widget-title">VOTRE AVIS</h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-progress="30%">
                                        <span class="vote-widget-txt-percent">30%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-genie.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-progress="10%">
                                        <span class="vote-widget-txt-percent">10%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-creatif.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-progress="15%">
                                        <span class="vote-widget-txt-percent">15%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-fun.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="vote-widget-col">
                        <div class="vote-widget-progress">
                            <div class="skill">
                                <div class="vote-widget-progress-bar">
                                    <div class="inner" data-progress="25%">
                                        <span class="vote-widget-txt-percent">25%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vote-widget-btn">
                            <a class="btn-piwee" href="#">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-deja-vu.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

            $(document).ready(function () {
                $('.vote-widget .inner').each(function () {
                    $(this).animate({
                        height: $(this).attr("data-progress")
                    }, 1500);

                });
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