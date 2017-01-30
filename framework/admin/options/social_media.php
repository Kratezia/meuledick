<?php

/**
	* social_media.php
	
	* Created for the theme options social media controls.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

// Set Global Vars
global $sa_icon_colors, $sa_social_media, $settings;

$sa_social_media = array(
	'soc_facebook' => 'https://facebook.com/themovation',
	'soc_twitter' => 'http://twitter.com/themovation',
	'soc_googleplus' => '',
	'soc_linkedin' => '',
	'soc_tumblr' => '',
	'soc_googlemaps' => '',
	'soc_foursquare' => '',
	'soc_youtube' => '',
	'soc_vimeo' => '',
	'soc_yelp' => '',
	'soc_urbanspoon' => '',
	'soc_tripadvisor' => '',
	'soc_meetup' => '',
	'soc_rss' => '',
	'soc_pinterest' => '',
	'soc_email' => '',
	'soc_phone' => '',
	'soc_use_custom_color' => false,
	'soc_icon_color' => 'soc_5.png',
	'soc_instagram' => '',
);

// Store layouts views in array
$sa_icon_colors = array(
	'black' => array(
		'value' => 'soc_5.png',
		'label' => __('Bright White','eatery')
	),
	'white' => array(
		'value' => 'soc_4.png',
		'label' => __('Light Grey','eatery')
	),
	'breakfast' => array(
		'value' => 'soc_3.png',
		'label' => __('Neutral Grey','eatery')
	),
	'casual' => array(
		'value' => 'soc_2.png',
		'label' => __('Charcoal Grey','eatery')
	),
	'coffee-house' => array(
		'value' => 'soc_1.png',
		'label' => __('Almost Black','eatery')
	),
	'fancy' => array(
		'value' => 'soc_0.png',
		'label' => __('Black','eatery')
	),
);

// Function to generate options page
function theme_social_media_options() {
	global $sa_icon_colors, $sa_social_media, $settings;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>	

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() ." ". __('Theme Options', 'eatery') . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php" name="themeOptions">

	<?php $settings = get_option( 'sa_social_media', $sa_social_media ); ?>
	
	<?php settings_fields( 'sa_theme_social_media' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>
        
    
<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

<table cellspacing="0" class="widefat theme-options-table">
		<thead><tr><th scope="row" colspan="2"><b><?php _e('Custom Icon Color','eatery'); ?></b></th></tr></thead>        
        <tbody>
        	<tr>
            	<th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Use Custom Icon Color','eatery'); ?></p></th>
            	<td><p class="description"></p>
        			<input type="checkbox" id="sa_social_media[soc_use_custom_color]" name="sa_social_media[soc_use_custom_color]" value="1" <?php checked( true, $settings['soc_use_custom_color'] ); ?> />
                    
        			<label for="soc_use_custom_color"><?php _e('Check and select a color below.','eatery'); ?></label></td></tr></tbody></table>        

    <div class="theme-options-group">
        <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Icon Color Selection','eatery'); ?></b></th></tr></thead>
        <tbody><tr><th scope="row"><div id="icon-themes" class="icon32"></div><p><?php _e('Choose from','eatery'); ?> 6</p></th><td><p class="description"></p>
            <select id="soc_icon_color" name="sa_social_media[soc_icon_color]">
            <?php
            foreach ( $sa_icon_colors as $soc_icon_color ) :
                $label = $soc_icon_color['label'];
                $selected = '';
                if ( $soc_icon_color['value'] == $settings['soc_icon_color'] )
                    $selected = 'selected="selected"';
                echo '<option style="padding-right: 10px;" value="' . esc_attr( $soc_icon_color['value'] ) . '" ' . $selected . '>' . $label . '</option>';
            endforeach;
            ?>
            </select>
        </td></tr></tbody>
        </table>
       </div>
    
<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
    

<div class="theme-options-group">
<table cellspacing="0" class="widefat theme-options-table">
<thead><tr><th scope="row" colspan="2"><b><?php _e('Social Media Account Links','eatery'); ?></b>  (EG: http://twitter.com/themovation)</th></tr></thead>

<style type="text/css">
.label {
	float:left;
	margin:10px 0 0 10px;
	} 

/******************** Social Media ********************/

.googleplus, .googlemaps, .linkedin, .meetup, .phone, .pinterest, .rss, .sharethis, .tripadvisor, .tumblr, .twitter, .urbanspoon, .vimeo, .yelp, .youtube, .bookmark, .email, .facebook, .foursquare, .instagram{
	background: url(<?php echo get_template_directory_uri() . '/framework/admin/images/sprites.png' ?>) no-repeat;
	float:left;
	width: 43px;
	height: 42px;
	}


.googleplus{
	background-position: -100px 0;
	
}

.googlemaps{
	background-position: -250px -50px ;
	
}

.linkedin{
	background-position: -200px -100px ;
	
}

.meetup{
	background-position: -100px -100px ;
	
}

.phone{
	background-position: 0 -50px ;
	
}

.pinterest{
	background-position: -150px 0;
	
}

.rss{
	background-position: -150px -50px ;
	
}

.sharethis{
	background-position: -100px -50px ;
	
}

.tripadvisor{
	background-position: -50px -150px ;
	
}

.tumblr{
	background-position: -50px -100px ;
	
}

.twitter{
	background-position: -50px 0;
	
}

.urbanspoon{
	background-position: 0 -150px ;
	
}

.vimeo{
	background-position: -150px -100px ;
	
}

.yelp{
	background-position: -200px 0;
	
}

.youtube{
	background-position: -250px -100px ;
	
}

.bookmark{
	background-position: 0 -100px ;
	
}

.email{
	background-position: -200px -50px ;
	
}

.facebook{
	background-position: 0 0;
	
}

.foursquare{
	background-position: -250px 0;
	
}
.instagram{
	background-position: -100px -150px;
	
}
</style>

<tbody><t><th scope="row"><div class="facebook"></div><div class="label"><strong>Facebook URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_facebook]" id="sa_social_media[soc_facebook]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_facebook']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="twitter"></div><div class="label"><strong>Twitter URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_twitter]" id="sa_social_media[soc_twitter]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_twitter']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="googleplus"></div><div class="label"><strong>Google+ URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_googleplus]" id="sa_social_media[soc_googleplus]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_googleplus']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="instagram"></div><div class="label"><strong>Instagram URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_instagram]" id="sa_social_media[soc_instagram]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_instagram']); ?>" /></td></tr></tbody>

<tbody><tr><th scope="row"><div class="linkedin"></div><div class="label"><strong>LinkedIn URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_linkedin]" id="sa_social_media[soc_linkedin]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_linkedin']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="tumblr"></div><div class="label"><strong>Tumblr URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_tumblr]" id="sa_social_media[soc_tumblr]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_tumblr']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="googlemaps"></div><div class="label"><strong>Google Map URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_googlemaps]" id="sa_social_media[soc_googlemaps]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_googlemaps']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="foursquare"></div><div class="label"><strong>FourSquare URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_foursquare]" id="sa_social_media[soc_foursquare]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_foursquare']); ?>" /></td></tr></tbody>

<tbody><tr><th scope="row"><div class="youtube"></div><div class="label"><strong>Youtube URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_youtube]" id="sa_social_media[soc_youtube]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_youtube']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="vimeo"></div><div class="label"><strong>Vimeo URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_vimeo]" id="sa_social_media[soc_vimeo]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_vimeo']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="yelp"></div><div class="label"><strong>Yelp URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_yelp]" id="sa_social_media[soc_yelp]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_yelp']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="urbanspoon"></div><div class="label"><strong>UrbanSpoon URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_urbanspoon]" id="sa_social_media[soc_urbanspoon]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_urbanspoon']); ?>" /></td></tr></tbody>

<tbody><tr><th scope="row"><div class="tripadvisor"></div><div class="label"><strong>Trip Advisor URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_tripadvisor]" id="sa_social_media[soc_tripadvisor]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_tripadvisor']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="meetup"></div><div class="label"><strong>Meetup URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_meetup]" id="sa_social_media[soc_meetup]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_meetup']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="rss"></div><div class="label"><strong>RSS URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_rss]" id="sa_social_media[soc_rss]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_rss']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="pinterest"></div><div class="label"><strong>Pinterest URL</strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_pinterest]" id="sa_social_media[soc_pinterest]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_pinterest']); ?>" /></td></tr></tbody>

<tbody><tr><th scope="row"><div class="email"></div><div class="label"><strong><?php _e('Email Link','eatery'); ?></strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_email]" id="sa_social_media[soc_email]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_email']); ?>" /></td></tr></tbody>
<tbody><tr><th scope="row"><div class="phone"></div><div class="label"><strong><?php _e('Phone URL','eatery'); ?></strong></div></th><td><p class="description"></p><input name="sa_social_media[soc_phone]" id="sa_social_media[soc_phone]" type="text" size="60" value="<?php  esc_attr_e($settings['soc_phone']); ?>" /></td></tr></tbody>

</tbody>
</table>
</div>

<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

	</form>
	</div>

	<?php
}