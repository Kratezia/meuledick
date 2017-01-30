<?php
/**
	* images.php
	
	* Image Settings
		
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

/* TURN ON SUPPORT FOR Featured Images / Custom Thumbnail Sizes*/
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}

/* Set custom thumbnail sizes  */
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'food-menu-thumb', 150, 150, true ); //300 pixels wide (and unlimited height)
}