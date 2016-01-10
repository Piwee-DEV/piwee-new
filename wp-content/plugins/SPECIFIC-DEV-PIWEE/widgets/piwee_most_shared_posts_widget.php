<?php

// Creating the widget
class most_shared_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'most_shared_widget',

            // Widget name will appear in UI
            __('Piwee most shared widget', 'most_shared_widget'),

            // Widget description
            array( 'description' => __( 'Provide a widget to display the most shared post', 'most_shared_widget' ), )
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

        <h3>Les plus partagés</h3>

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
function load_most_shared_widget() {
    register_widget( 'most_shared_widget' );
}

add_action( 'widgets_init', 'load_most_shared_widget' );


?>