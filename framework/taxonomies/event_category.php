<?php

/**
	* event_category.php
	
	* A custom post type for a restaurant events
	
	* LICENSE: 
	
	* @copyright  2014 Themovation
	* @version    1
*/

// Register Custom Taxonomy
function themo_add_event_category() {

	$labels = array(
		'name'                       => _x( 'Event Categories', 'Taxonomy General Name', 'eatery' ),
		'singular_name'              => _x( 'Event Category', 'Taxonomy Singular Name', 'eatery' ),
		'menu_name'                  => __( 'Event Category', 'eatery' ),
		'all_items'                  => __( 'All Event Categories', 'eatery' ),
		'parent_item'                => __( 'Parent Event Category', 'eatery' ),
		'parent_item_colon'          => __( 'Parent Event Category:', 'eatery' ),
		'new_item_name'              => __( 'New Event Category', 'eatery' ),
		'add_new_item'               => __( 'Add New Event Category', 'eatery' ),
		'edit_item'                  => __( 'Edit Event Category', 'eatery' ),
		'update_item'                => __( 'Update Event Category', 'eatery' ),
		'separate_items_with_commas' => __( 'Separate Event Categories with commas', 'eatery' ),
		'search_items'               => __( 'Search Event Categories', 'eatery' ),
		'add_or_remove_items'        => __( 'Add or remove Event Category', 'eatery' ),
		'choose_from_most_used'      => __( 'Choose from the most used Event Categories', 'eatery' ),
		'not_found'                  => __( 'Not Found', 'eatery' ),
	);
	$rewrite = array(
		'slug'                       => 'event_category',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'themo_event_category', 'themo_event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'themo_add_event_category', 0 );