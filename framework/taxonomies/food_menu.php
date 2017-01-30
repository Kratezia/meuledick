<?php
/* Taxonomies */

//Register Taxonomies

add_action( 'init', 'create_food_menu_taxonomies', 0 );
function create_food_menu_taxonomies() {
    register_taxonomy('food_menu_groups',
		array (0 => 'food'),
		array( 'hierarchical' => true,
				'label' => __( 'Menu Groups', 'eatery'),'show_ui' => true,
							'query_var' => true,
							'rewrite' => array('slug' => 'menu-groups'),'singular_label' => __( 'Menu Group', 'eatery')) );
}

?>