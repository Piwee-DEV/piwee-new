<?php

// Creating the widget
class piwee_last_pensee_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'piwee_last_pensee_widget',

            // Widget name will appear in UI
            __('Piwee Denière Pensée Widget', 'piwee_last_pensee_widget'),

            // Widget description
            array('description' => __('Affiche la dernière pensée du jour', 'piwee_last_pensee_widget'),)
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
        $citations_posts = query_posts(array('category__in' => array(1158), 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));
        $citation_post = $citations_posts[0];

        ?>

        <div class="article-mega-featured widget">

            <a href="<?php echo get_permalink($citation_post->ID) ?>">
                <div class="article-mega-featured-img-container widget">
                    <?php echo get_the_post_thumbnail($citation_post->ID, "attachment-large") ?>
                    <div class="sharing-interactive">
                        <?php if (function_exists("social_shares_button")) social_shares_button($citation_post->ID); ?>
                    </div>
                    <div class="article-mega-featured-title">
                        <h2><?php echo $citation_post->post_title; ?></h2>
                    </div>
                </div>
            </a>

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
function load_piwee_last_pensee_widget()
{
    register_widget('piwee_last_pensee_widget');
}

add_action('widgets_init', 'load_piwee_last_pensee_widget');


?>