<?php
/*
 * Plugin Name: You can quote me on that
 * Version: 1.0.06
 * Plugin URI: https://www.outtheboxthemes.com/wordpress-plugins/you-can-quote-me-on-that/
 * Description: The quickest and easiest way to create testimonial sliders.
 * Author: Out the Box
 * Author URI: https://www.outtheboxthemes.com/
 * Requires at least: 4.0
 * Tested up to: 5.8
 * Requires PHP: 5.3
 *
 * Text Domain: you-can-quote-me-on-that
 * Domain Path: /languages/
 *
 * @package WordPress
 * @author Out the Box
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'YOU_CAN_QUOTE_ME_ON_THAT_DEBUG', false );
define( 'YOU_CAN_QUOTE_ME_ON_THAT_PLUGIN_VERSION', '1.0.06' );

// Load plugin class files.
require_once 'library/classes/class-you-can-quote-me-on-that.php';
require_once 'library/classes/class-you-can-quote-me-on-that-post-type.php';
require_once 'library/classes/class-you-can-quote-me-on-that-widget.php';
require_once 'library/classes/class-you-can-quote-me-on-that-form-control.php';

/**
 * Returns the main instance of You_Can_Quote_Me_On_That to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object You_Can_Quote_Me_On_That
 */
function you_can_quote_me_on_that() {
	$instance = You_Can_Quote_Me_On_That::instance( __FILE__, YOU_CAN_QUOTE_ME_ON_THAT_PLUGIN_VERSION );
	
	return $instance;
}

you_can_quote_me_on_that();

$post_type = 'ycqmot';
$plural    = __( 'Testimonial Sliders', 'you-can-quote-me-on-that' );
$single    = __( 'You can quote me on that', 'you-can-quote-me-on-that' );

// Create the Custom Post Type and a Taxonomy for the 'you-can-quote-me-on-that' Post Type
you_can_quote_me_on_that()->register_post_type( $post_type, $plural, $single, '', array(
	'labels'	=> array(
		'name'               => $plural,
		'singular_name'      => $single,
		'name_admin_bar'     => $single,
		'add_new'            => _x( 'Create New Slider', $post_type, 'you-can-quote-me-on-that' ),
		'add_new_item'       => __( 'Create New Slider', 'you-can-quote-me-on-that' ),
		'edit_item'          => __( 'Edit Slider', 'you-can-quote-me-on-that' ),
		'new_item'           => sprintf( __( 'New %s', 'you-can-quote-me-on-that' ), $single ),
		'all_items' 		 => __( 'View Sliders', 'you-can-quote-me-on-that' ),
		'view_item'          => __( 'View Slider', 'you-can-quote-me-on-that' ),
		'search_items'       => __( 'Search Sliders', 'you-can-quote-me-on-that' ),
		'not_found'          => __( 'No Sliders', 'you-can-quote-me-on-that' ),
		'not_found_in_trash' => __( 'No Sliders Found In Trash', 'you-can-quote-me-on-that' ),
		'parent_item_colon'  => sprintf( __( 'Parent %s' ), $single ),	
		'menu_name' 		 => 'You can quote me on that',
	),
	'public'    => true,
	'publicly_queryable' => true,
	'exclude_from_search' => true, // Check if this is legit
	'rewrite' => array(
		'slug' => 'you-can-quote-me-on-that',
		'with_front' => false
	),
	'menu_icon' => 'dashicons-format-quote'
) );
