<?php
/**
	* tinymce_buttons.php
	
	* Inserts custom buttons into the WordPress Tinymce toolbar.
	* These buttons help with creating and deploying shortcodes.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* JAN 23, 2014 - Fixed tinymce icon for image
	* @link       http://www.themovation.com/eatery
*/

add_action('init', 'reg_button');

function reg_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons_3', 'register_button' );
   }

}
/**
Register Button
*/

function register_button( $buttons ) {
	array_push( $buttons, "", "typography");
	array_push( $buttons, "", "wc_column" );
	array_push( $buttons, "", "wc_button" );
	array_push( $buttons, "", "foodmenu" );
	array_push( $buttons, "", "map" );
	array_push( $buttons, "", "themo_image" );
	array_push( $buttons, "", "ruler" );
	array_push( $buttons, "", "slideshow");
	array_push( $buttons, "", "tab");
	array_push( $buttons, "", "toggle");
	array_push( $buttons, "", "blogfeed" );
	
 return $buttons;
}

/**
Register TinyMCE Plugin
*/
function add_plugin( $plugin_array ) {	
	
   $plugin_array['typography'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['wc_column'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['wc_button'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['foodmenu'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['map'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['themo_image'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['ruler'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['slideshow'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['tab'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['toggle'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   $plugin_array['blogfeed'] = get_template_directory_uri() . '/js/tinymce/tinymce_buttons.js';
   
   return $plugin_array;
}

