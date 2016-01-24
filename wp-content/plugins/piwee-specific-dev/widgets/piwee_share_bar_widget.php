<?php

// Creating the widget
class piwee_share_bar_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'piwee_share_bar_widget',

            // Widget name will appear in UI
            __('Piwee Share Bar Widget', 'piwee_share_bar_widget'),

            // Widget description
            array( 'description' => __( 'Provide a share bar widget especially for PIWEE', 'piwee_share_bar_widget' ), )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output

        ?>

        <div class="share-bar-widget">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-fb-btn.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-twitter.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-linkedin.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-pinterest.png">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-mail.png">
        </div>

        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {

    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}

// Register and load the widget
function load_piwee_share_bar_widget() {
    register_widget( 'piwee_share_bar_widget' );
}

add_action( 'widgets_init', 'load_piwee_share_bar_widget' );


?>