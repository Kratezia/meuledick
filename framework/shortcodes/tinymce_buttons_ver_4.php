<?php
/**
 * Plugin Name: TinyMCE 4 @ WP Test
 * Description: 
 * Plugin URI:  
 * Version:     0.0.1
 * Author:      Frank Bültge
 * Author URI:  http://bueltge.de
 * License:     GPLv2
 * License URI: ./assets/license.txt
 * Text Domain: 
 * Domain Path: /languages
 * Network:     false
 */

// TINY MCE 4 Styling
add_action( 'admin_enqueue_scripts', 'tinymce_stylesheet' );
/**
 * Add stylesheet to the admin pages
 */
function tinymce_stylesheet() {
    wp_enqueue_style( 'custom-mce-style', get_template_directory_uri() . '/js/tinymce/tinymce-style.css' );
}


add_action( 'admin_head', 'fb_add_tinymce' );
function fb_add_tinymce() {
	global $typenow;
	
	if( ! in_array( $typenow, array( 'post', 'page' ) ) )
		return ;
	
	add_filter( 'mce_external_plugins', 'fb_add_tinymce_plugin' );
	// Add to line 1 form WP TinyMCE
	add_filter( 'mce_buttons_3', 'fb_add_tinymce_button' );
}

function fb_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['typography'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['wc_column'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['wc_button'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['foodmenu'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['map'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['themo_image'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['ruler'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['slideshow'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['tab'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['toggle'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	$plugin_array['blogfeed'] = get_template_directory_uri() . '/js/tinymce/ver_4/plugin-select.js';
	return $plugin_array;
}

function fb_add_tinymce_button( $buttons ) {

	//array_push( $buttons, 'fb_test_button_key' );
	array_push( $buttons, "typography");
	array_push( $buttons, "wc_column" );
	array_push( $buttons, "wc_button" );
	array_push( $buttons, "foodmenu" );
	array_push( $buttons, "map" );
	array_push( $buttons, "themo_image" );
	array_push( $buttons, "ruler" );
	array_push( $buttons, "slideshow");
	array_push( $buttons, "tab");
	array_push( $buttons, "toggle");
	array_push( $buttons, "blogfeed" );
	return $buttons;
}

function fb_add_tinymce_button_2( $buttons ) {

	//var_dump( $buttons );
	return $buttons;
}
