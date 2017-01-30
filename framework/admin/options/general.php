<?php
/**
	* general.php
	
	* Created for the theme options general controls.
	* Helps set value such as Google Analytics Code, Custom CSS, Footer
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	* 1.1 - Dec 18, 2012 - Add support for 24 hour clock, currency symbol, 
	* currency symbol right align.
*/

global $sa_general;

// Default options values
$sa_general = array(
	'footer_copyright' => '',
	'google_analytics' => '',
	'google_analytics_UA' => '',
	'custom_css'=> '',
	'custom_email'=> '',
    'map_api_key'=> '',
	'use_timthumb'=> false,
	'currency_symbol'=> '$',
	'currency_symbol_align_right'=>0,
	'reso_24_hour_clock'=>'',
);

/**
	* Function theme_general_options.

	* Create admin form for the general theme controls. Google Analytics Code, Custom CSS, Footer.
	
*/
function theme_general_options() {
	global $sa_general;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'eatery' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'eatery' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

        <form method="post" action="options.php" name="themeOptions">
    
        <?php $settings = get_option( 'sa_general', $sa_general ); ?>
        
        <?php settings_fields( 'sa_theme_general' );
        /* This function outputs some hidden fields required by the form,
        including a nonce, a unique number used to ensure the form has been submitted from the admin page
        and not somewhere else, very important for security */ ?>
            
    
            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>   
            
            <div class="theme-options-group">
            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr><th scope="row" colspan="2"><?php _e('Tracking','eatery'); ?></th></tr></thead>
            <tbody><tr><th scope="row"><h4><label for="analytics"><a href='http://www.google.com/analytics/' target='_blank'>Google Analytics</a><br /><?php _e('Tracking ID','eatery'); ?></label></h4></th><td><p class="description"></p><input type="text" id="google_analytics" name="sa_general[google_analytics]" size="36" value="<?php  esc_attr_e($settings['google_analytics']); ?>" /> e.g.: UA-4455334-1</td></tr>
            <tbody><tr><th scope="row"><h4><label for="analytics"><?php _e('Universal Analytics','eatery'); ?></label></h4></th><td><p class="description"></p><input type="checkbox" id="google_analytics_UA" name="sa_general[google_analytics_UA]" value="1" <?php checked( true, $settings['google_analytics_UA'] ); ?> /></td></tr>            
            </tbody>
            </table>
            </div>
            
            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
            
            <div class="theme-options-group">
            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr><th scope="row" colspan="2"><?php _e('Custom CSS','eatery'); ?></th></tr></thead>
            <tbody><tr><th scope="row"><h4><label for="custom_css"><?php _e('Custom CSS','eatery'); ?></label></h4></th><td><p class="description"></p><textarea id="custom_css" rows="10" name="sa_general[custom_css]" type="textarea" class="code"><?php  esc_attr_e($settings['custom_css']); ?></textarea><br /></td></tr>
            </tbody>
            </table>
            </div>
            
            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
            
            <div class="theme-options-group">
            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr><th scope="row" colspan="2"><?php _e('Email Contact','eatery'); ?></th></tr></thead>
            <tbody><tr><th scope="row"><h4><label for="custom_email"><?php _e('Email Address','eatery'); ?></label></h4></th><td><p class="description"></p><input type="text" id="email_contact" name="sa_general[custom_email]" size="36" value="<?php  esc_attr_e($settings['custom_email']); ?>" /></td></tr>
            </tbody>
            </table>
            </div>

            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

            <div class="theme-options-group">
                <table cellspacing="0" class="widefat theme-options-table">
                    <thead><tr><th scope="row" colspan="2"><?php _e('Google MAP API Key','eatery'); ?></th></tr></thead>
                    <tbody><tr><th scope="row"><h4><label for="map_api_key"><?php _e('API Key','eatery'); ?></label></h4></th><td><p class="description"><?php echo esc_html__( 'Get your free API key here: ', 'eatery' ) . '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Key/Authentication</a>. ' . esc_html__( 'Leave it blank and use our key but we do not guarantee that it will work as it has a daily use limit.', 'eatery' ); ?></p><input type="text" id="map_api_key" name="sa_general[map_api_key]" size="36" value="<?php  esc_attr_e($settings['map_api_key']); ?>" /></td></tr>
                    </tbody>
                </table>
            </div>

            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
            
            <div class="theme-options-group">
            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr><th scope="row" colspan="2"><?php _e('Footer','eatery'); ?></th></tr></thead>
            <tbody>
            <tr><th scope="row"><h4><label for="copyright"><?php _e('Copyright / Footer Text','eatery'); ?></label></h4></th><td><p class="description"><?php _e('Allowed HTML Tags: a, href, title, br, em, strong','eatery'); ?></p><textarea rows="10" id="sa_general[footer_copyright]" rows="3" name="sa_general[footer_copyright]" type="textarea" class="code"><?php  esc_attr_e($settings['footer_copyright']); ?></textarea><br /></td></tr>
            </tbody>
            </table>
            </div>
            
            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
            
            <div class="theme-options-group">
            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr><th scope="row" colspan="2"><?php _e('Currency','eatery'); ?></th></tr></thead>
            <tbody><tr><th scope="row"><h4><label for="custom_email"><?php _e('Currency Symbol','eatery'); ?></label></h4></th><td><p class="description"></p><input type="text" id="currency_symbol" name="sa_general[currency_symbol]" size="5" value="<?php  esc_attr_e($settings['currency_symbol']); ?>" /></td></tr></tbody>
            <tbody><tr><th scope="row"><h4><label for="custom_email"><?php _e('Right Align Currency Symbol','eatery'); ?></label></h4></th><td><p class="description"></p><input type="checkbox" id="currency_symbol_align_right" name="sa_general[currency_symbol_align_right]" value="1" <?php checked( true, $settings['currency_symbol_align_right'] ); ?> /> <label for="use_timthumb"><?php _e('Display Currency Symbol to the right of the Price','eatery'); ?></label></td></tr>
            </table>
            </div>
            
            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
            
            <div class="theme-options-group">
            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr><th scope="row" colspan="2"><?php _e('Clock Format','eatery'); ?></th></tr></thead>
            <tbody><tr><th scope="row"><h4><label for="custom_email"><?php _e('24 Hour Clock','eatery'); ?></label></h4></th><td><p class="description"></p><input type="checkbox" id="reso_24_hour_clock" name="sa_general[reso_24_hour_clock]" value="1" <?php checked( true, $settings['reso_24_hour_clock'] ); ?> /> <label for="use_timthumb"><?php _e('Use a 24 hour clock vs AM / PM','eatery'); ?></label></td></tr>
            </table>
            </div>
            
            <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
           

            <table cellspacing="0" class="widefat theme-options-table">
            <thead><tr>
              <th scope="row" colspan="2"><b><a href="http://code.google.com/p/timthumb/source/browse/trunk/timthumb.php" target="_blank">Timthumb</a></b>. <?php _e('(Not Required) Resizes and crops images for [slideshow] shortcode.','eatery'); ?></th></tr></thead>        
            <tbody>
            <tr>
            <th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Check to enable','eatery'); ?></p> </th>
            <td><p class="description"><strong><?php _e('CONFIGURATION NEEDED! Please see theme documentation for help.','eatery'); ?></strong></p>
			<p><strong><?php _e('It is VERY important to keep Timthumb up to date. Keep up to date with the latest version of TimThumb found here:','eatery'); ?> <a href="http://code.google.com/p/timthumb/source/browse/trunk/timthumb.php" target="_blank">TimThumb on Google Code Site</a>.</strong></p>
            <input type="checkbox" id="use_timthumb" name="sa_general[use_timthumb]" value="1" <?php checked( true, $settings['use_timthumb'] ); ?> />
            <label for="use_timthumb"><?php _e('Enable','eatery'); ?> Timthumb - <?php _e('May not work with your web host.','eatery'); ?> </label></td></tr></tbody></table>        
   
			<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
    
        </form>
	</div>

	<?php
}