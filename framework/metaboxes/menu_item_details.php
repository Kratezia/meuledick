<?php
/**
	* menu_item_details.php
	
	* Creates META BOXES (Menu Item Details) for the Food Menu Custom Post Type. 
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
		// Include & setup custom metabox and fields
		$prefix = 'mg_';
		$meta_boxes = array();
		
		$meta_boxes['menu_item_details'] = array(
			'id' => 'menu_item_details',
			'title' => __('Menu Item Details','eatery'),
			'pages' => array('food'), // post type
		// condition examples: order of priority is: (1) id, (2) template, & (3) cat
		//'condition' => array( 'type' => 'id', 'id' => '123' ),
		//'condition' => array( 'type' => 'template', 'id' => '' , 'template' => 'page-gridblog.php' ),
		//'condition' => array( 'type' => 'cat', 'id' => '' , 'cat_include' => '1,2,3,5' , 'cat_exclude' => '' ),
		//'condition' => array( 'type' => 'cat', 'id' => '' , 'cat_include' => '' , 'cat_exclude' => '1,2,3,5' ),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Price Description','eatery'),
					'desc' => __('Price Description (optional)','eatery'),
					'id' => $prefix . 'price_description',
					'type' => 'text'
				),
				array(
					'name' => __('Price','eatery'),
					'desc' => __('Price','eatery'),
					'id' => $prefix . 'price',
					'type' => 'text_money'
				),
				 array(
					'name' => __('Second Price Description','eatery'),
					'desc' => __('Second Price Description (optional)','eatery'),
					'id' => $prefix . 'second_price_description',
					'type' => 'text'
				),
				array(
					'name' => __('Second Price','eatery'),
					'desc' => __('Second Price (optional)','eatery'),
					'id' => $prefix . 'second_price',
					'type' => 'text_money'
				),
				array(
					'name' => __('Third Price Description','eatery'),
					'desc' => __('Third Price Description (optional)','eatery'),
					'id' => $prefix . 'third_price_description',
					'type' => 'text'
				),
				array(
					'name' => __('Third Price','eatery'),
					'desc' => __('Third Price (optional)','eatery'),
					'id' => $prefix . 'third_price',
					'type' => 'text_money'
				),
				array(
					'name' => __('Fourth Price Description','eatery'),
					'desc' => __('Fourth Price Description (optional)','eatery'),
					'id' => $prefix . 'fourth_price_description',
					'type' => 'text'
				),
				array(
					'name' => __('Fourth Price','eatery'),
					'desc' => __('Fourth Price (optional)','eatery'),
					'id' => $prefix . 'fourth_price',
					'type' => 'text_money'
				),
				array(
					'name' => __('Fifth Price Description','eatery'),
					'desc' => __('Fifth Price Description (optional)','eatery'),
					'id' => $prefix . 'fifth_price_description',
					'type' => 'text'
				),
				array(
					'name' => __('Fifth Price','eatery'),
					'desc' => __('Fifth Price (optional)','eatery'),
					'id' => $prefix . 'fifth_price',
					'type' => 'text_money'
				),
				array(
					'name' => __('Item Details Link','eatery'),
					'desc' => __('Disable Link to Item Details Page','eatery'),
					'id' => $prefix . 'disable_details_link',
					'type' => 'checkbox'
				),
			)
		);
		
		$meta_boxes['themo_events'] = array(
			'id'         => 'themo_events',
			'title'      => __( 'Event Details', 'eatery' ),
			'pages'      => array( 'themo_event', ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __( 'Start Date / Time', 'eatery' ),
					'desc' => __( 'Choose a start date and time', 'eatery' ),
					'id'   => $prefix . 'event_start_datetime_timestamp',
					'type' => 'text_datetime_timestamp',
				),
				array(
					'name' => __( 'End Date / Time', 'eatery' ),
					'desc' => __( 'Choose a end date and time', 'eatery' ),
					'id'   => $prefix . 'event_end_datetime_timestamp',
					'type' => 'text_datetime_timestamp',
				),
			)
		);
		
		$meta_boxes['page_options'] = array(
		'id'         => 'page_options_metabox',
		'title'      => __( 'Page Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
					'name' => __('Hide Page Title','eatery'),
					'desc' => __('Click to hide page title from display.','eatery'),
					'id' => $prefix . 'themo_hide_page_title',
					'type' => 'checkbox'
				),
		)
	);


	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}