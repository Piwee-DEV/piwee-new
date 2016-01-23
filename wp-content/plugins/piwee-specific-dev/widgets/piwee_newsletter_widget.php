<?php

// Creating the widget
class newsletter_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'newsletter_widget',

            // Widget name will appear in UI
            __('Piwee Newsletter Widget', 'newsletter_widget'),

            // Widget description
            array('description' => __('Provide a newsletter widget especially for PIWEE', 'newsletter_widget'),)
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

        <script type='text/javascript'
                src='http://piwee.net/wp-content/themes/blt-katla/assets/js/theme.min.js?ver=2.1'></script>
        <script type='text/javascript'
                src='http://piwee.net/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-fr.js?ver=2.6.16'></script>
        <script type='text/javascript'
                src='http://piwee.net/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.6.16'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var wysijaAJAX = {
                "action": "wysija_ajax",
                "controller": "subscribers",
                "ajaxurl": "http:\/\/piwee.net\/wp-admin\/admin-ajax.php",
                "loadingTrans": "Chargement...",
                "is_rtl": ""
            };
            /* ]]> */
        </script>
        <script type='text/javascript'
                src='http://piwee.net/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.16'></script>

        <div class="widget_wysija_cont piwee-newsletter-widget">
            <div id="msg-form-wysija-3" class="wysija-msg ajax"></div>
            <form id="form-wysija-3" method="post" action="#wysija" class="widget_wysija">

                <p class="wysija-paragraph">
                    <label>E-mail <span class="wysija-required">*</span></label>

                    <input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]"
                           title="E-mail" value=""/>

                    <span class="abs-req">
                        <input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]"
                               value=""/>
                    </span>

                    <input class="wysija-submit wysija-submit-field" type="submit" value="Je m'abonne !"/>
                </p>

                <input type="hidden" name="form_id" value="2"/>
                <input type="hidden" name="action" value="save"/>
                <input type="hidden" name="controller" value="subscribers"/>
                <input type="hidden" value="1" name="wysija-page"/>

                <input type="hidden" name="wysija[user_list][list_ids]" value="1"/>
            </form>

            <p>Tous les samedi matin dans votre boîte et c'est tout</p>
        </div>

        <h4>Devenez Fan</h4>

        <div class="fb-page" data-href="https://www.facebook.com/piwee.net" data-small-header="false"
             data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <div class="fb-xfbml-parse-ignore">
                <blockquote cite="https://www.facebook.com/piwee.net"><a href="https://www.facebook.com/piwee.net">Piwee.net</a>
                </blockquote>
            </div>
        </div>
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1411359452474265";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'campain_twitter_widget');
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
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
function load_newsletter_widget()
{
    register_widget('newsletter_widget');
}

add_action('widgets_init', 'load_newsletter_widget');


?>