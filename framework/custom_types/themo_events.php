<?php 

/**
	* themo_events.php
	
	* A custom post type for a restaurant events. 
	
	* LICENSE: 
	
	* @copyright  2014 Themovation
	* @version    1.0
*/


/**
	* Function themo_create_events_post_type

	* Creates new event custom post type
*/

if ( ! function_exists('themo_create_events_post_type') ) {

// Register Custom Post Type
function themo_create_events_post_type() {

	$labels = array(
		'name'                => _x( 'Events', 'Post Type General Name', 'eatery' ),
		'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'eatery' ),
		'menu_name'           => __( 'Events', 'eatery' ),
		'parent_item_colon'   => __( 'Parent Event:', 'eatery' ),
		'all_items'           => __( 'All Events', 'eatery' ),
		'view_item'           => __( 'View Event', 'eatery' ),
		'add_new_item'        => __( 'Add New Event', 'eatery' ),
		'add_new'             => __( 'Add New Event', 'eatery' ),
		'edit_item'           => __( 'Edit Event', 'eatery' ),
		'update_item'         => __( 'Update Event', 'eatery' ),
		'search_items'        => __( 'Search Events', 'eatery' ),
		'not_found'           => __( 'Not found', 'eatery' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'eatery' ),
	);
	$rewrite = array(
		'slug'                => 'event',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'events', 'eatery' ),
		'description'         => __( 'Events', 'eatery' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'post-formats', ),
		//'taxonomies'          => array( 'event_category', 'post_tag' ),
		'taxonomies'          => array( 'themo_event_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 30,
		'menu_icon'           => 'dashicons-calendar',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'themo_event', $args );
	
	

}

// Hook into the 'init' action
add_action( 'init', 'themo_create_events_post_type', 0 );

//register_taxonomy_for_object_type( 'post_tag', 'events' );

}