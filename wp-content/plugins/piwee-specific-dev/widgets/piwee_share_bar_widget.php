<?php

// Creating the widget
class piwee_share_bar_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'piwee_share_bar_widget',

            // Widget name will appear in UI
            __('Piwee Share Bar Widget', 'piwee_share_bar_widget'),

            // Widget description
            array('description' => __('Provide a share bar widget especially for PIWEE', 'piwee_share_bar_widget'),)
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

        <div class="share-bar-widget">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-fb-btn.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-twitter.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-linkedin.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-pinterest.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-mail.png">

            <div class="native-btn">
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/"
                     data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: fr_FR</script>
                <script type="IN/Share" data-counter="right"></script>
                <a data-pin-do="buttonPin" data-pin-count="beside"
                   href="https://www.pinterest.com/pin/create/button/?url=https%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=https%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest"><img
                        src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/></a>
                <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
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
function load_piwee_share_bar_widget()
{
    register_widget('piwee_share_bar_widget');
}

add_action('widgets_init', 'load_piwee_share_bar_widget');


?>