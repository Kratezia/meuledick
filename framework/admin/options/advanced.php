<?php
/**
	* advanced.php
	
	* Created for the theme options advanced controls.
	* For future use.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

$sa_advanced = array(
	'author_credits' => true
);

/**
	* Function theme_advanced_options.

	* Create admin form for the advanced theme controls. 
	
*/
function theme_advanced_options() {
	global $sa_advanced;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Advanced Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php" name="themeOptions">

	<?php $settings = get_option( 'sa_advanced', $sa_advanced ); ?>
	
	<?php settings_fields( 'sa_theme_advanced' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->

	<tr valign="top"><th scope="row"><?php _e('Author Credits','eatery'); ?></th>
	<td>
	<input type="checkbox" id="author_credits" name="sa_advanced[author_credits]" value="1" <?php checked( true, $settings['author_credits'] ); ?> />
	<label for="author_credits"><?php _e('Show Author Credits','eatery'); ?></label>
	</td>
	</tr>
    
	<?php
}