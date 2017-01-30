<?php

/* Register Sidebars */
if ( function_exists('register_sidebar') )  {
     register_sidebar(array(  	
		'name' => __( 'Above Sidebar Navigation', 'eatery' ),  
		'before_widget' => '<div class="side-widget above">',  
		'after_widget' => '</div><!--br class="clear"-->',  
		'before_title' => '<h2 class="sidebar-widget-title">',  
		'after_title' => '</h2>'
	));

	register_sidebar(array(  
		'name' => __( 'Below Sidebar Navigation', 'eatery' ),  
		'before_widget' => '<div class="side-widget below">',  
		'after_widget' => '</div><!--br class="clear"-->',  
		'before_title' => '<h2 class="sidebar-widget-title">',  
		'after_title' => '</h2>'
	));
	
	register_sidebar(array(  
		'name' => __( 'Mobile Sidebar', 'eatery' ),
		'before_widget' => '<div class="side-widget mobile">',  
		'after_widget' => '</div>',  
		'before_title' => '<h2 class="sidebar-widget-title mobile">',  
		'after_title' => '</h2>'
	));
}