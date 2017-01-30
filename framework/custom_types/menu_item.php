<?php
/**
	* menu_item.php
	
	* A custom post type for a restaurant menu system. 
	* Supports Menu Groups EG: Breakfast, Lunch, Supper, Specials
	
	* LICENSE: 
	
	* @copyright  2012 Themovation
	* @version    1.2
	* Added new Dashicon
*/


/**
	* Function create_post_food_menu.

	* Creates new custom post type
*/

/* CREATE NEW CUSTOM POST TYPE [ MENU ITEM ] */
add_action('init', 'create_post_food_menu');
function create_post_food_menu() 
{
  $labels = array(
    'name' => _x('Food Menu', 'post type general name','eatery'),
    'singular_name' => _x('Menu Item', 'post type singular name','eatery'),
    'add_new' => _x('Add New', 'food','eatery'),
    'add_new_item' => __('Add New Menu Item','eatery'),
    'edit_item' => __('Edit Menu Item','eatery'),
    'new_item' => __('New Menu Item','eatery'),
    'all_items' => __('All Menu Items','eatery'),
    'view_item' => __('View Menu Item','eatery'),
    'search_items' => __('Search Food Menu','eatery'),
    'not_found' =>  __('No Menu Items found','eatery'),
    'not_found_in_trash' => __('No Menu Items found in Trash','eatery'), 
    'parent_item_colon' => '',
    'menu_name' => __('Food Menu','eatery')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments','revisions'),
	'menu_icon' => 'dashicons-list-view',
  ); 
  register_post_type('food',$args);
}

//add filter to ensure the text is displayed when user updates a food menu item 
add_filter('post_updated_messages', 'food_menu_updated_messages');
function food_menu_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['food'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Menu item updated. <a href="%s">View menu item</a>','eatery'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.','eatery'),
    3 => __('Custom field deleted.','eatery'),
    4 => __('Menu item updated.','eatery'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Menu item restored to revision from %s','eatery'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Menu item published! Looks tasty! <a href="%s">View menu item</a>','eatery'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Menu item saved.','eatery'),
    8 => sprintf( __('Menu item submitted. <a target="_blank" href="%s">Preview Menu Item</a>','eatery'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Menu item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Menu item</a>','eatery'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i','eatery' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Menu item draft updated. <a target="_blank" href="%s">Preview menu item</a>','eatery'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


// Provide filter by Food Group Taxonomy<br />
// EG: http://wp.tutsplus.com/tutorials/plugins/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives/
add_action( 'restrict_manage_posts', 'my_filter_list' );
function my_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'food' ) {
        wp_dropdown_categories( array(
            'show_option_all' => __('Show All Food Items','eatery','eatery'),
            'taxonomy' => 'food_menu_groups',
            'name' => 'food_menu_groups',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['food_menu_groups'] ) ? $wp_query->query['food_menu_groups'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}


add_filter( 'parse_query','perform_filtering' );
function perform_filtering( $query ) {
    $qv = &$query->query_vars;
    if (isset($qv['food_menu_groups'])){
		if ( ( $qv['food_menu_groups'] ) && is_numeric( $qv['food_menu_groups'] ) ) {
			$term = get_term_by( 'id', $qv['food_menu_groups'], 'food_menu_groups' );
			$qv['food_menu_groups'] = $term->slug;
		}
	}
}

/*add_filter( 'manage_edit-food_columns', 'my_columns' );

function my_columns( $columns ) {
    $columns['food_menu_group'] = 'Food Meny Group';
    return $columns;
}

add_action( 'manage_posts_custom_column', 'populate_columns' );


function populate_columns( $column ) {
    if ( 'food_menu_group' == $column ) {
        $food_menu = esc_html( get_post_meta( get_the_ID(), 'movie_director', true ) );
        echo $movie_director;
    }
    elseif ( 'food_menu_group' == $column ) {
        $movie_rating = get_post_meta( get_the_ID(), 'movie_rating', true );
        echo $movie_rating . ' stars';
    }
}*/

?>