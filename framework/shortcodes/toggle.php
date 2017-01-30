<?php
/**
	* toggle.php
	
	* Groups content into CSS toggles.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/


add_action( 'wp_enqueue_scripts' , 'register_toggle_scrtips' );

function register_toggle_scrtips() {
	
	
	wp_register_script('jquery.toggle', get_template_directory_uri() . '/js/jquery.toggle.js', array('jquery'), '', true);
	
	
	}
	

function toggle_shortcode( $atts, $content ){
	extract( shortcode_atts(
		array(
		'title' => __('Click To Open','eatery'),
		'color' => ''),
		$atts ) );
		wp_print_scripts('jquery.toggle');	
	return '<h3 class="trigger toggle-gray"><a href="#">'. $title .'</a></h3><div class="toggle_container">' . do_shortcode($content) . '</div>';
}
add_shortcode('toggle', 'toggle_shortcode');