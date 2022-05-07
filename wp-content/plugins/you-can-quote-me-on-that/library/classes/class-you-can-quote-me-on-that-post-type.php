<?php
/**
 * Post type declaration file.
 *
 * @package You Can Quote Me On That/Includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post type declaration class.
 */
class You_Can_Quote_Me_On_That_Post_Type {

	/**
	 * The single instance of You_Can_Quote_Me_On_That_Post_Type.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;
	
	/**
	 * The main plugin object.
	 * @var 	object
	 * @access  public
	 * @since 	1.0.0
	 */
	public $parent = null;
	
	/**
	 * The name for the custom post type.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $post_type;

	/**
	 * The name for the custom post type.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $field;
	
	/**
	 * The plural name for the custom post type posts.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plural;

	/**
	 * The singular name for the custom post type posts.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $single;

	/**
	 * The description of the custom post type.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $description;

	/**
	 * The options of the custom post type.
	 *
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $options;
	
	public $repeatable_fieldset_settings;
	
	/**
	 * Constructor
	 *
	 * @param string $post_type Post type.
	 * @param string $plural Post type plural name.
	 * @param string $single Post type singular name.
	 * @param string $description Post type description.
	 * @param array  $options Post type options.
	 */
	public function __construct( $parent, $post_type = '', $plural = '', $single = '', $description = '', $options = array() ) {
		$this->parent = $parent;
		
		if ( ! $post_type || ! $plural || ! $single ) {
			return;
		}
		
		$this->settings = array(
			'repeatable' => false,
			'fields' => array(
				'you_can_quote_me_on_that_slideshow' => array(
					'type'			=> 'checkbox',
					'hasDependents'	=> true,
					'class'			=> '',
					'default'		=> false,
					'description' 	=> __( 'Slideshow', 'you-can-quote-me-on-that' )
				),
				'you_can_quote_me_on_that_speed' => array(
					'label'			=> __( 'Transition Speed', 'you-can-quote-me-on-that' ),
					'type'			=> 'milliseconds',
					'placeholder'	=> '',
					'suffix'		=> 'ms',
					'class'			=> 'full-width',
					'default'		=> 800,
					'description' => __( 'The speed it takes to transition between slides in milliseconds. 1000 milliseconds equals 1 second.', 'you-can-quote-me-on-that' )
				),
				'you_can_quote_me_on_that_slideshow_speed' => array(
					'label'			=> __( 'Slideshow Speed', 'you-can-quote-me-on-that' ),
					'type'			=> 'milliseconds',
					'placeholder'	=> '',
					'class'			=> 'full-width',
					'default'		=> 3000,
					'description' 	=> __( 'The speed of the slideshow in milliseconds. 1000 milliseconds equals 1 second.', 'you-can-quote-me-on-that' )
				),
				'you_can_quote_me_on_that_quote_font_color' => array(
					'label'			=> __( 'Quote Font Color', 'you-can-quote-me-on-that' ),
					'type'			=> 'color',
					'class'			=> 'full-width',
					'default'		=> '#0086ED',
					'description'	=> ''
				),
				'you_can_quote_me_on_that_navigation_button_color' => array(
					'label'			=> __( 'Button Color', 'you-can-quote-me-on-that' ),
					'type'			=> 'color',
					'class'			=> 'full-width',
					'default'		=> '#0086ED',
					'description'	=> ''
				),
				'you_can_quote_me_on_that_navigation_button_rollover_color' => array(
					'label'			=> __( 'Button Rollover Color', 'you-can-quote-me-on-that' ),
					'type'			=> 'color',
					'class'			=> 'full-width',
					'default'		=> '#006bbe',
					'description'	=> ''
				)
			)
		);
		
		$this->repeatable_fieldset_settings = array(
			'repeatable' => true,
			'fields' => array(
				'you_can_quote_me_on_that_slide_quote' => array(
					'type'			=> 'html',
					'placeholder'	=> __( 'Quote', 'you-can-quote-me-on-that' ),
					'class'			=> '',
					'description'	=> ''
				),
				'you_can_quote_me_on_that_slide_name' => array(
					'type'			=> 'text',
					'placeholder'	=> __( 'Name', 'you-can-quote-me-on-that' ),
					'class'			=> '',
					'description'	=> ''
				),
				'you_can_quote_me_on_that_slide_title' => array(
					'type'			=> 'text',
					'placeholder'	=> __( 'Title', 'you-can-quote-me-on-that' ),
					'class'			=> '',
					'description'	=> ''
				),
				'you_can_quote_me_on_that_slide_company' => array(
					'type'			=> 'text',
					'placeholder'	=> __( 'Company', 'you-can-quote-me-on-that' ),
					'class'			=> '',
					'description'	=> ''
				)
			)
		);

		// Post type name and labels.
		$this->post_type   = $post_type;
		$this->plural      = $plural;
		$this->single      = $single;
		$this->description = $description;
		$this->options     = $options;

		// Regsiter post type.
		add_action( 'init', array( $this, 'register_post_type' ) );

		// Add custom meta boxes
		add_action( 'admin_init', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post_ycqmot', array( $this, 'save_slides_meta' ) );
		add_action( 'save_post_ycqmot', array( $this, 'save_global_settings_meta' ) );

		// Register shortcodes
		add_shortcode( 'ycqmot', array( $this, 'you_can_quote_me_on_that_shortcode' ) );
		add_shortcode( 'you-can-quote-me-on-that', array( $this, 'you_can_quote_me_on_that_shortcode' ) );
		
		// Load the single post type template
		add_filter( 'single_template', array( $this, 'load_single_template' ) );

		// Display custom update messages for posts edits.
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
	}

	/**
	 * Register new post type
	 *
	 * @return void
	 */
	public function register_post_type() {
		//phpcs:disable
		$labels = array(
			'name'               => $this->plural,
			'singular_name'      => $this->single,
			'name_admin_bar'     => $this->single,
			'add_new'            => _x( 'Add New', $this->post_type, 'you-can-quote-me-on-that' ),
			'add_new_item'       => sprintf( __( 'Add New %s', 'you-can-quote-me-on-that' ), $this->single ),
			'edit_item'          => sprintf( __( 'Edit %s', 'you-can-quote-me-on-that' ), $this->single ),
			'new_item'           => sprintf( __( 'New %s', 'you-can-quote-me-on-that' ), $this->single ),
			'all_items'          => sprintf( __( 'All %s', 'you-can-quote-me-on-that' ), $this->plural ),
			'view_item'          => sprintf( __( 'View %s', 'you-can-quote-me-on-that' ), $this->single ),
			'search_items'       => sprintf( __( 'Search %s', 'you-can-quote-me-on-that' ), $this->plural ),
			'not_found'          => sprintf( __( 'No %s Found', 'you-can-quote-me-on-that' ), $this->plural ),
			'not_found_in_trash' => sprintf( __( 'No %s Found In Trash', 'you-can-quote-me-on-that' ), $this->plural ),
			'parent_item_colon'  => sprintf( __( 'Parent %s' ), $this->single ),
			'menu_name'          => $this->plural,
		);
		//phpcs:enable

		$args = array(
			'labels'                => apply_filters( $this->post_type . '_labels', $labels ),
			'description'           => $this->description,
			'public'                => true,
			'publicly_queryable'    => true,
			'exclude_from_search'   => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'query_var'             => true,
			'can_export'            => true,
			'rewrite'               => true,
			'capability_type'       => 'post',
			'has_archive'           => false,
			'hierarchical'          => false,
			'show_in_rest'          => true,
			'rest_base'             => $this->post_type,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports'              => array( 'title' ),
			'menu_position'         => 80,
			'menu_icon'             => 'dashicons-admin-post',
		);

		$args = array_merge( $args, $this->options );

		register_post_type( $this->post_type, apply_filters( $this->post_type . '_register_args', $args, $this->post_type ) );
	}

	/*
	* Setup custom meta boxes
	*/
	public function add_meta_boxes() {
		// Create the Slide Meta Boxes
		add_meta_box( 'you-can-quote-me-on-that-slide-settings-group', __( 'Testimonials', 'you-can-quote-me-on-that' ), array( $this, 'create_slide_settings_meta_box' ), $this->post_type, 'normal', 'default' );
		add_filter( 'postbox_classes_you-can-quote-me-on-that_you-can-quote-me-on-that-slide-settings-group', array( $this, 'add_metabox_classes' ) );
		
		// Create the Shortcode Meta Box
		add_meta_box( 'you-can-quote-me-on-that-shortcode-group', __( 'Shortcode', 'you-can-quote-me-on-that' ), array( $this, 'create_shortcode_meta_box' ), $this->post_type, 'side', 'high' );
		
		// Create the Global Settings Meta Box
		add_meta_box( 'you-can-quote-me-on-that-global-settings-group', __( 'Global Settings', 'you-can-quote-me-on-that' ), array( $this, 'create_global_settings_meta_box' ), $this->post_type, 'side', 'default' );
	}

	/*
	* Create repeatable slide fieldset
	*/
	public function create_slide_settings_meta_box() {
		global $post;
		
		$slide_settings = get_post_meta( $post->ID, 'you-can-quote-me-on-that-slide-settings-group', true );

		wp_nonce_field( 'otb_repeater_nonce', 'otb_repeater_nonce' );
		?>
		
		<div class="otb-postbox-container">

			<table class="otb-panel-container multi sortable repeatable" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tbody class="container">
					<?php
					$hidden_panel = false;
					
					if ( $slide_settings ) :
						foreach ( $slide_settings as $setting ) {
							$this->field = $setting;
							include( $this->parent->assets_dir .'/template-parts/repeatable-panel-slide.php' );
						}
					else : 
						// show a blank one
						include( $this->parent->assets_dir .'/template-parts/repeatable-panel-slide.php' );
					endif;
					
					$this->field = null;
					
					// Empty hidden panel used for creating a new panel
					$hidden_panel = true;
					include( $this->parent->assets_dir .'/template-parts/repeatable-panel-slide.php' );
					?>
				</tbody>
			</table>

			<div class="footer">
				<div class="left">
				</div>
				
				<div class="right">
					<a class="button add-repeatable-panel" href="#"><?php esc_html_e( 'Add Another Testimonial', 'you-can-quote-me-on-that' ); ?></a>
				</div>
			</div>
			
		</div>
		
	<?php
	}
	
	public function add_metabox_classes( $classes ) {
		array_push( $classes, 'otb-postbox', 'seamless' );
		return $classes;
	}
	
	/*
	* Create global settings meta box
	*/
	public function create_global_settings_meta_box() {
		global $post;
		
		include( $this->parent->assets_dir .'/template-parts/global-settings.php' );
	}
	
	/*
	* Create Shortcode meta box
	*/
	public function create_shortcode_meta_box() {
		global $post;
	?>
		<div class="text-input-with-button-container copyable">
			<input name="you_can_quote_me_on_that_shortcode" value="<?php esc_html_e( '[ycqmot id="' . $post->ID . '"]' ); ?>" readonly />
			<div class="icon copy">
				<i class="ycqmot-fa ycqmot-fa-copy"></i>
			</div>
			<div class="message"><?php esc_html_e( 'Copied to clipboard', 'you-can-quote-me-on-that' ); ?></div>
		</div>
	<?php
	}
	
	/*
	* Save slides meta
	*/
	public function save_slides_meta( $post_id ) {
		if ( !isset( $_POST['otb_repeater_nonce'] ) || !wp_verify_nonce( $_POST['otb_repeater_nonce'], 'otb_repeater_nonce' ) )
			return;
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( !current_user_can( 'edit_post', $post_id ) )
			return;

		$ycqmot_old = get_post_meta( $post_id, 'you-can-quote-me-on-that-slide-settings-group', true );
		$ycqmot_new = array();
		
		$repeatable_fieldset_settings = $this->repeatable_fieldset_settings['fields'];
		
        foreach ( $repeatable_fieldset_settings as $name => $config ) {
			$values_array = wp_unslash( $_POST[ $name ] );
			
			for ( $i=0; $i<count( $values_array ); $i++ ) {
				$ycqmot_new[$i][ $name ] = $this->sanitize_field( $values_array[$i], $config['type'] );
			}
        }
        
		if ( !empty( $ycqmot_new ) && $ycqmot_new != $ycqmot_old ) {
			update_post_meta( $post_id, 'you-can-quote-me-on-that-slide-settings-group', $ycqmot_new );
		} elseif ( empty( $ycqmot_new ) && $ycqmot_old ) {
			delete_post_meta( $post_id, 'you-can-quote-me-on-that-slide-settings-group', $ycqmot_old );
		}
	}
	
	/*
	* Save global settings meta
	*/
	public function save_global_settings_meta( $post_id ) {
		if ( !isset( $_POST['otb_repeater_nonce'] ) || !wp_verify_nonce( $_POST['otb_repeater_nonce'], 'otb_repeater_nonce' ) )
			return;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
		
		$settings = $this->settings['fields'];
		$value;
		
        foreach ( $settings as $name => $config ) {
			$post = '';
			
			if ( isset( $_POST[ $name ] ) ) {
				$post = $_POST[ $name ];
			}

			$value = $this->sanitize_field( wp_unslash( $post ), $config['type'] );
			update_post_meta( $post_id, $name, $value);
        }
	}
	
	/* Utility function for creating form controls */
	public function create_form_control( $id, $settings ) {
		global $post;
		
		$value = '';
		$formControl = null;
		
		$repeatable 	   = $this->getIfSet( $settings['repeatable'], false);
		$parent_field_type = $this->getIfSet($settings['type'], '');
		$field_counter 	   = $this->getIfSet($settings['field_counter'], '');
		$settings 		   = $settings['fields'][$id];
		$field_type 	   = $settings['type'];
		
		if ( ( $repeatable || $parent_field_type == 'repeatable_fieldset' ) && isset( $this->field[$id] ) ) {
			$value = $this->field[$id];
		} else if ( !$repeatable ) {
			$value = get_post_meta( $post->ID, $id, true );
		}

		if ( !is_numeric( $value ) && empty( $value ) && isset( $settings['default'] ) ) {		
			$value = $settings['default'];
		}
		
		$formControl = new You_Can_Quote_Me_On_That_Form_Control( $id, $this, $repeatable, $settings, $value, $field_counter );
		
		return $formControl;
	}
	
	/* Utility function for sanitizing form control values */
	public function sanitize_field( $value, $type ) {
		switch( $type ) {
			case 'text':
			case 'email':
			case 'password':
				$value = sanitize_text_field( $value );
			break;

			case 'number':
				$value = intval( $value );
			break;

			case 'float':
			case 'milliseconds':
			case 'percentage':
			case 'range':
				$value = floatVal( $value );
			break;

			case 'color':
				$value = sanitize_hex_color( $value );
			break;
			
			case 'url':
				$value = esc_url( $value );
			break;
			
			case 'textarea':
				$value = sanitize_textarea_field( $value );
			break;

			case 'html':
				$value = wp_kses( $value, array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array()
					),
					'img' => array(
						'src' => array(),
						'height' => array(),
						'width' => array()
					),
					'ol' => array(),
					'ul' => array(),
					'li' => array(),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
				) );
			break;
			
			case 'tinymce':
				$value = $value;
			break;

			case 'checkbox':
 				$value = intval( (bool) $value );
			break;
			
			case 'media_upload':
				$value = intval( $value );
			break;
		}
		
		return $value;
	}
	
	function getIfSet( &$var, $defaultValue ) {
		if(isset($var)) {
			return $var;
		} else {
			return $defaultValue;
		}
	}

	public function get_default_value( $id, $settings_array ) {
		return $this->$settings_array['fields'][$id]['default'];
	}
	
	/**
	 * Create Slider Shortcode
	 */
	function you_can_quote_me_on_that_shortcode( $atts ) {
		// Extract attributes passed to shortcode
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );
		
		ob_start();
		include( $this->parent->assets_dir .'/template-parts/slider.php' );
		return ob_get_clean();		
	}

	function create_slider( $id ) {
		ob_start();
		include( $this->parent->assets_dir .'/template-parts/slider.php' );
		return ob_get_clean();
	}
	
	function load_single_template( $template ) {
	    global $post;

		if ( 'ycqmot' === $post->post_type && locate_template( array( 'single-ycqmot.php' ) ) !== $template ) {
	        /*
	         * This is a 'movie' post
	         * AND a 'single movie template' is not found on
	         * theme or child theme directories, so load it
	         * from our plugin directory.
	         */
			//echo $this->parent->assets_dir .'/template/single-ycqmot.php';
			//exit;
	        return $this->parent->assets_dir .'/templates/single-ycqmot.php';
	    }

	    return $template;
	}
	
	/**
	 * Set up admin messages for post type
	 *
	 * @param  array $messages Default message.
	 * @return array           Modified messages.
	 */
	public function updated_messages( $messages = array() ) {
		global $post, $post_ID;
		//phpcs:disable
		$messages[ $this->post_type ] = array(
			0  => '',
			1  => sprintf( __( '%1$s updated. %2$sView %3$s%4$s.', 'you-can-quote-me-on-that' ), $this->single, '<a href="' . esc_url( get_permalink( $post_ID ) ) . '">', $this->single, '</a>' ),
			2  => __( 'Custom field updated.', 'you-can-quote-me-on-that' ),
			3  => __( 'Custom field deleted.', 'you-can-quote-me-on-that' ),
			4  => sprintf( __( '%1$s updated.', 'you-can-quote-me-on-that' ), $this->single ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( '%1$s restored to revision from %2$s.', 'you-can-quote-me-on-that' ), $this->single, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( '%1$s published. %2$sView %3$s%4s.', 'you-can-quote-me-on-that' ), $this->single, '<a href="' . esc_url( get_permalink( $post_ID ) ) . '">', $this->single, '</a>' ),
			7  => sprintf( __( '%1$s saved.', 'you-can-quote-me-on-that' ), $this->single ),
			8  => sprintf( __( '%1$s submitted. %2$sPreview post%3$s%4$s.', 'you-can-quote-me-on-that' ), $this->single, '<a target="_blank" href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) . '">', $this->single, '</a>' ),
			9  => sprintf( __( '%1$s scheduled for: %2$s. %3$sPreview %4$s%5$s.', 'you-can-quote-me-on-that' ), $this->single, '<strong>' . date_i18n( __( 'M j, Y @ G:i', 'you-can-quote-me-on-that' ), strtotime( $post->post_date ) ) . '</strong>', '<a target="_blank" href="' . esc_url( get_permalink( $post_ID ) ) . '">', $this->single, '</a>' ),
			10 => sprintf( __( '%1$s draft updated. %2$sPreview %3$s%4$s.', 'you-can-quote-me-on-that' ), $this->single, '<a target="_blank" href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) . '">', $this->single, '</a>' ),
		);
		//phpcs:enable

		return $messages;
	}

	/**
	 * Set up bulk admin messages for post type
	 *
	 * @param  array $bulk_messages Default bulk messages.
	 * @param  array $bulk_counts   Counts of selected posts in each status.
	 * @return array                Modified messages.
	 */
	public function bulk_updated_messages( $bulk_messages = array(), $bulk_counts = array() ) {

		//phpcs:disable
		$bulk_messages[ $this->post_type ] = array(
			'updated'   => sprintf( _n( '%1$s %2$s updated.', '%1$s %3$s updated.', $bulk_counts['updated'], 'you-can-quote-me-on-that' ), $bulk_counts['updated'], $this->single, $this->plural ),
			'locked'    => sprintf( _n( '%1$s %2$s not updated, somebody is editing it.', '%1$s %3$s not updated, somebody is editing them.', $bulk_counts['locked'], 'you-can-quote-me-on-that' ), $bulk_counts['locked'], $this->single, $this->plural ),
			'deleted'   => sprintf( _n( '%1$s %2$s permanently deleted.', '%1$s %3$s permanently deleted.', $bulk_counts['deleted'], 'you-can-quote-me-on-that' ), $bulk_counts['deleted'], $this->single, $this->plural ),
			'trashed'   => sprintf( _n( '%1$s %2$s moved to the Trash.', '%1$s %3$s moved to the Trash.', $bulk_counts['trashed'], 'you-can-quote-me-on-that' ), $bulk_counts['trashed'], $this->single, $this->plural ),
			'untrashed' => sprintf( _n( '%1$s %2$s restored from the Trash.', '%1$s %3$s restored from the Trash.', $bulk_counts['untrashed'], 'you-can-quote-me-on-that' ), $bulk_counts['untrashed'], $this->single, $this->plural ),
		);
		//phpcs:enable

		return $bulk_messages;
	}
	
	/**
	 * Main You_Can_Quote_Me_On_That_Post_Type Instance
	 *
	 * Ensures only one instance of You_Can_Quote_Me_On_That_Post_Type is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see You_Can_Quote_Me_On_That()
	 * @return Main You_Can_Quote_Me_On_That_Post_Type instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()

}
