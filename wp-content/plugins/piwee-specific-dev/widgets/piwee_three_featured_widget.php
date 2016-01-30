<?php

// Creating the widget
class piwee_three_featured_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'piwee_three_featured_widget',

            // Widget name will appear in UI
            __('Piwee 3 Featured Posts Widget', 'piwee_three_featured_widget'),

            // Widget description
            array('description' => __('Provide a featured post widget especially for PIWEE', 'piwee_three_featured_widget'),)
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

        $week = date('W.m.Y');

        $most_shared_post_of_the_week_x_next = query_posts(
            array(
                'meta_key' => 'share_count_week_diff_' . $week,
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'posts_per_page' => 3,
                'ignore_sticky_posts' => 1
            )
        );

        // This is where you run the code and display the output

        ?>

        <?php foreach ($most_shared_post_of_the_week_x_next as $post): ?>

        <div class="article-mega-featured widget">

            <a href="<?php echo get_permalink($post->ID) ?>">
                <div class="article-mega-featured-img-container widget">
                    <?php echo get_the_post_thumbnail($post->ID, "attachment-large") ?>
                    <div class="sharing-interactive">
                        <?php if (function_exists("social_shares_button")) social_shares_button($post->ID); ?>
                    </div>
                    <div class="article-mega-featured-title">
                        <h2><?php echo $post->post_title; ?></h2>
                    </div>
                </div>
            </a>

        </div>

        <?php endforeach; ?>

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
function load_piwee_three_featured_widget()
{
    register_widget('piwee_three_featured_widget');
}

add_action('widgets_init', 'load_piwee_three_featured_widget');

?>