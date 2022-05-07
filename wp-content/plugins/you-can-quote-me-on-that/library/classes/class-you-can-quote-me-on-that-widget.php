<?php 
class You_Can_Quote_Me_On_That_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'you-can-quote-me-on-that-widget', 

			// Widget name will appear in UI
			__( 'You can quote me on that', 'you-can-quote-me-on-that' ), 

			// Widget description
			array( 'description' => __( 'Display any You can quote me on that testimonial slider.', 'you-can-quote-me-on-that' ), )
		);
	}
	
	// Create the widget front-end
	public function widget( $args, $instance ) {
		global $post;
		
		$you_can_quote_me_on_that = you_can_quote_me_on_that();
	
		$title 	   = apply_filters( 'widget_title', $instance['title'] );
		$id 	   = $instance['slider_id'];
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// This is where you run the code and display the output
		if ( ! empty( $id ) ) {
			echo $you_can_quote_me_on_that->post_type->create_slider( $id );
		}
		
		echo $args['after_widget'];
	}
	
	// Create the widget back-end
	public function form( $instance ) {
		$title 	   = $this->get_if_set( $instance[ 'title' ], '' );
		$slider_id = $this->get_if_set( $instance[ 'slider_id' ], null );
		
		// Create the widget settings UI
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">
					<?php _e( 'Title:', 'you-can-quote-me-on-that' ); ?>
				</label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			
			<p>
				<?php
				$dropdown = '<select class="widefat" id="' .$this->get_field_id( 'slider_id' ). '" name="' .$this->get_field_name( 'slider_id' ). '">';
				$dropdown .= '<option value="">Select</option>';
				
				// Get all sliders
				$posts = get_posts( array(
					'post_type' => 'ycqmot'
				) );
				
				foreach ( $posts as $post ) {
					$selected = false;
					if ( $post->ID == $slider_id ) {
						$selected = true;
					}
	
					$dropdown .= '<option ' . selected( $selected, true, false ) . ' value="' .$post->ID. '">' .$post->post_title. '</option>';
				}
				
				// Prevent weirdness
				wp_reset_postdata();
				
				$dropdown .= '</option>';
				$dropdown .= '</select>';
				?>
	
				<label for="<?php echo $this->get_field_id( 'slider_id' ); ?>">
					<?php _e( 'Slider:', 'you-can-quote-me-on-that' ); ?>
				</label> 
				<?php echo $dropdown; ?>
			</p>
		<?php
	}
	
	// Save the widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] 	   = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['slider_id'] = ( ! empty( $new_instance['slider_id'] ) ) ? intval( $new_instance['slider_id'] ) : '';
		
		return $instance;
	}
	
	public function get_if_set( &$var, $defaultValue = '' ) {
		if ( isset($var) ) {
			return $var;
		} else {
			return $defaultValue;
		}
	}

}
