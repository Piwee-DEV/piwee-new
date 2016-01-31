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
            <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>"
               target="_blank">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-fb-btn.png">
            </a>
            <a href="https://twitter.com/home?status=<?php echo get_the_title() . ' ' . get_permalink() ?>"
               target="_blank">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-twitter.png">
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink() ?>&title=<?php echo get_the_title() . ' ' . get_permalink() ?>&summary=&source=Piwee.net"
               target="_blank">
                <img
                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-linkedin.png">
            </a>
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink() ?>&description=<?php echo get_the_title() . ' ' . get_permalink() ?>"
               target="_blank">
                <img
                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-pinterest.png">
            </a>
            <a href="mailto:?subject=<?php echo rawurlencode(get_the_title() . ' | Piwee.net') ?>&body=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()) ?>">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-mail.png">
            </a>

            <div class="native-btn hidden-xs hidden-sm">
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/"
                     data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <a href="https://twitter.com/share" class="twitter-share-button" {count}>Tweet</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + '://platform.twitter.com/widgets.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');</script>
                <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: fr_FR</script>
                <script type="IN/Share" data-counter="right"></script>
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