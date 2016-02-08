<?php

// Creating the widget
class piwee_author_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'piwee_author_widget',

            // Widget name will appear in UI
            __('Piwee Author Widget', 'piwee_author_widget'),

            // Widget description
            array('description' => __('Provide an author widget especially for PIWEE', 'piwee_author_widget'),)
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

        <div class="author-widget-wrapper">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="author-widget-image-wrapper">
                        <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename') ?>">
                            <?php echo get_avatar(get_the_author_meta('ID')); ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div class="author-widget-text-wrapper">
                        <h4><a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename') ?>">Par <?php the_author_meta('display_name') ?></a>
                                <a href="https://twitter.com/<?php echo get_the_author_meta('twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></h4>
                        <p>
                            <?php the_author_meta('description') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
function load_piwee_author_widget()
{
    register_widget('piwee_author_widget');
}

add_action('widgets_init', 'load_piwee_author_widget');


?>