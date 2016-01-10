<?php

// Creating the widget
class piwee_fb_comment_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'piwee_fb_comment_widget',

            // Widget name will appear in UI
            __('Piwee Facebook Comment Widget', 'piwee_fb_comment_widget'),

            // Widget description
            array( 'description' => __( 'Provide a facebook comment widget especially for PIWEE', 'piwee_fb_comment_widget' ), )
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
        $url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        ?>

        <h3 class="comment-widget-title">Qu'en pensez-vous ?</h3>

        <div class="fb-comments" data-href="<?php echo $url ?>" data-num-posts="4" data-width="620"></div>

        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'campain_fb_widget' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}

// Register and load the widget
function load_comment_fb_widget() {
    register_widget( 'piwee_fb_comment_widget' );
}

add_action( 'widgets_init', 'load_comment_fb_widget' );

?>