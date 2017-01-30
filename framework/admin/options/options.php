<?php
/**
	* options.php
	
	* Created for all the theme options controls.
	* Registers 4 theme option files.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - December 18, 2012 - Added new validation for several new fields.
*/

/**
	* Function sa_register_settings.

	* Registers all theme option pages.
	
*/

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sa_theme_general', 'sa_general', 'sa_validate_general' );
	register_setting( 'sa_theme_layout', 'sa_layout', 'sa_validate_layout' );
	register_setting( 'sa_theme_social_media', 'sa_social_media', 'sa_validate_social_media' );
	register_setting( 'sa_theme_typography', 'sa_typography', 'sa_validate_typography' );
}

add_action( 'admin_init', 'sa_register_settings' );

/**
	* Function sa_theme_options.

	* Setup menu.
	
*/
function sa_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( __('Theme Options', 'eatery'), __('Theme Options', 'eatery'), 'edit_theme_options', 'theme_options', 'sa_theme_home_page' );
}

add_action( 'admin_menu', 'sa_theme_options' );

/**
	* Function mytheme_admin_tabs.

	* Setup tabs.
	
*/
function mytheme_admin_tabs(  $current = 'general' ) { 
    $tabs = array('general' => __('General', 'eatery'), 'layout' => __('Layout', 'eatery'), 'social_media' => __('Social Media', 'eatery'), 'typography' => __('Typography', 'eatery')); 
    $links = array(); 
    foreach( $tabs as $tab => $name ) : 
        if ( $tab == $current ) : 
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=theme_options&tab=$tab'>$name</a>"; 
        else : 
            $links[] = "<a class='nav-tab' href='?page=theme_options&tab=$tab'>$name</a>"; 
        endif; 
    endforeach; 
    echo '<h2 class="nav-tab-wrapper">'; 
    foreach ( $links as $link ) 
        echo $link; 
    echo '</h2>'; 
}

/**
	* Function my_admin_scripts.

	* Enqueue scripts used in admin options.
	* Includes Multiple File Uploader
	
*/
function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');

	wp_register_script('my-upload', THEME_ADMIN_URI_JS . '/my-script.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');

    //wp_enqueue_script( 'farbtastic' );
    //wp_enqueue_script( 'my-theme-options', THEME_ADMIN_URI_JS . '/theme-options.js', array( 'farbtastic', 'jquery' ) );
}

/**
	* Function my_admin_styles.

	* Enqueue styles used in admin options.
	
*/
function my_admin_styles() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style( 'farbtastic' );
	$admin_handle = 'eatery_admin_stylesheet';
    $admin_stylesheet = get_template_directory_uri() . '/framework/admin/css/theme-options.css';
	wp_enqueue_style( $admin_handle, $admin_stylesheet );
}

if (isset($_GET['page']) && $_GET['page'] == 'theme_options') {
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
}
// END Multiple File Uploader Scripts

// Function to generate options page
function sa_theme_home_page() {
	global $pagenow;
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme_options' ) : 
    if ( isset ( $_GET['tab'] ) ) : 
        $tab = $_GET['tab']; 
    else: 
        $tab = 'general'; 
    endif; 
	
	mytheme_admin_tabs($tab);
	
    switch ( $tab ) : 
        case 'general' : 
            theme_general_options(); 
            break; 
        case 'layout' : 
            theme_layout_options(); 
            break; 
        case 'social_media' : 
            theme_social_media_options(); 
            break; 
		case 'typography' : 
            theme_typography_options(); 
            break; 
		case 'advanced' : 
            theme_advanced_options(); 
            break; 
    endswitch; 
	endif;
}

// Function to generate general page
function sa_validate_general( $input ) {
	global $sa_general, $sa_categories;
	$settings = get_option( 'sa_general', $sa_general );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['footer_copyright'] =  $input['footer_copyright'] ;
	$input['google_analytics'] = wp_filter_nohtml_kses( $input['google_analytics'] );
	
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['google_analytics_UA'] ) )
		$input['google_analytics_UA'] = null;
	// We verify if the input is a boolean value
	$input['google_analytics_UA'] = ( $input['google_analytics_UA'] == 1 ? 1 : 0 );	
	
	$allowed_html = array(); 
	$input['custom_css'] = wp_kses( $input['custom_css'], $allowed_html );
	
	$input['custom_email'] = wp_filter_nohtml_kses( $input['custom_email'] );

	$input['map_api_key'] = wp_filter_nohtml_kses( $input['map_api_key'] );
	
	$input['currency_symbol'] = wp_filter_nohtml_kses( $input['currency_symbol'] );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['currency_symbol_align_right'] ) )
		$input['currency_symbol_align_right'] = null;
	// We verify if the input is a boolean value
	$input['currency_symbol_align_right'] = ( $input['currency_symbol_align_right'] == 1 ? 1 : 0 );	
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['reso_24_hour_clock'] ) )
		$input['reso_24_hour_clock'] = null;
	// We verify if the input is a boolean value
	$input['reso_24_hour_clock'] = ( $input['reso_24_hour_clock'] == 1 ? 1 : 0 );	
	
	$allowed_html = array('a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array()); 
	$input['footer_copyright'] = wp_kses( $input['footer_copyright'], $allowed_html );
		
		
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['use_timthumb'] ) )
		$input['use_timthumb'] = null;
	// We verify if the input is a boolean value
	$input['use_timthumb'] = ( $input['use_timthumb'] == 1 ? 1 : 0 );	
		
	return $input;
}

// Function to generate layout page
function sa_validate_layout( $input ) {
	global $sa_layout, $sa_layouts, $sa_layout_skins;
	$settings = get_option( 'sa_options', $sa_layout );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['colorPalette_dark'] = wp_filter_nohtml_kses( $input['colorPalette_dark'] );
	$input['colorPalette_mid1'] = wp_filter_nohtml_kses( $input['colorPalette_mid1'] );
	$input['colorPalette_mid2'] = wp_filter_nohtml_kses( $input['colorPalette_mid2'] );
	$input['colorPalette_offwhite'] = wp_filter_nohtml_kses( $input['colorPalette_offwhite'] );
	$input['colorPalette_brightwhite'] = wp_filter_nohtml_kses( $input['colorPalette_brightwhite'] );
	$input['colorPalette_light'] = wp_filter_nohtml_kses( $input['colorPalette_light'] );
	
	// sanitize header images 
	$input['upload_image0'] = wp_filter_nohtml_kses( $input['upload_image0'] );
	$input['upload_image1'] = wp_filter_nohtml_kses( $input['upload_image1'] );
	$input['upload_image2'] = wp_filter_nohtml_kses( $input['upload_image2'] );
	$input['upload_image3'] = wp_filter_nohtml_kses( $input['upload_image3'] );
	$input['upload_image4'] = wp_filter_nohtml_kses( $input['upload_image4'] );
	$input['upload_image5'] = wp_filter_nohtml_kses( $input['upload_image5'] );
	$input['upload_image6'] = wp_filter_nohtml_kses( $input['upload_image6'] );
	$input['upload_image7'] = wp_filter_nohtml_kses( $input['upload_image7'] );
	$input['upload_image8'] = wp_filter_nohtml_kses( $input['upload_image8'] );
	
	$input['upload_image_id_0'] = wp_filter_nohtml_kses( $input['upload_image_id_0'] );
	
	// sanitize tile images 
	$input['upload_image10'] = wp_filter_nohtml_kses( $input['upload_image10'] );
	$input['upload_image11'] = wp_filter_nohtml_kses( $input['upload_image11'] );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['upload_image0_resize'] ) )
		$input['upload_image0_resize'] = null;
	// We verify if the input is a boolean value
	$input['upload_image0_resize'] = ( $input['upload_image0_resize'] == 1 ? 1 : 0 );	
	
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['use_custom_colors'] ) )
		$input['use_custom_colors'] = null;
	// We verify if the input is a boolean value
	$input['use_custom_colors'] = ( $input['use_custom_colors'] == 1 ? 1 : 0 );	
	
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['create_header'] ) )
		$input['create_header'] = null;
	// We verify if the input is a boolean value
	$input['create_header'] = ( $input['create_header'] == 1 ? 1 : 0 );	
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['hide_page_corners'] ) )
		$input['hide_page_corners'] = null;
	// We verify if the input is a boolean value
	$input['hide_page_corners'] = ( $input['hide_page_corners'] == 1 ? 1 : 0 );	
		
			
	return $input;
}

// Function to generate social media page
function sa_validate_social_media( $input ) {
	global $sa_social_media, $sa_categories;

	$settings = get_option( 'sa_social_media', $sa_social_media );

	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['soc_facebook'] = wp_filter_nohtml_kses( $input['soc_facebook'] );
	$input['soc_twitter'] = wp_filter_nohtml_kses( $input['soc_twitter'] );
	$input['soc_googlemaps'] = wp_filter_nohtml_kses( $input['soc_googlemaps'] );
	$input['soc_linkedin'] = wp_filter_nohtml_kses( $input['soc_linkedin'] );
	
	$input['soc_tumblr'] = wp_filter_nohtml_kses( $input['soc_tumblr'] );
	$input['soc_googlemaps'] = wp_filter_nohtml_kses( $input['soc_googlemaps'] );
	$input['soc_foursquare'] = wp_filter_nohtml_kses( $input['soc_foursquare'] );
	$input['soc_youtube'] = wp_filter_nohtml_kses( $input['soc_youtube'] );
	
	$input['soc_vimeo'] = wp_filter_nohtml_kses( $input['soc_vimeo'] );
	$input['soc_yelp'] = wp_filter_nohtml_kses( $input['soc_yelp'] );
	$input['soc_urbanspoon'] = wp_filter_nohtml_kses( $input['soc_urbanspoon'] );
	$input['soc_tripadvisor'] = wp_filter_nohtml_kses( $input['soc_tripadvisor'] );
	
	$input['soc_meetup'] = wp_filter_nohtml_kses( $input['soc_meetup'] );
	$input['soc_rss'] = wp_filter_nohtml_kses( $input['soc_rss'] );
	$input['soc_pinterest'] = wp_filter_nohtml_kses( $input['soc_pinterest'] );
	$input['soc_email'] = wp_filter_nohtml_kses( $input['soc_email'] );
	$input['soc_phone'] = wp_filter_nohtml_kses( $input['soc_phone'] );
	$input['soc_instagram'] = wp_filter_nohtml_kses( $input['soc_instagram'] );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['soc_use_custom_color'] ) )
		$input['soc_use_custom_color'] = null;
	// We verify if the input is a boolean value
	$input['soc_use_custom_color'] = ( $input['soc_use_custom_color'] == 1 ? 1 : 0 );	
	
	
	
	return $input;
}

// Function to generate typography page
function sa_validate_typography( $input ) {
	global $sa_typography;

	$settings = get_option( 'sa_typography', $sa_typography );
	
	$input['h1_sample'] = str_replace("'", '', $input['h1_sample']) ;
	$input['p_sample'] = str_replace("'", '', $input['p_sample']) ;
	
	$input['h1_sample'] = wp_filter_nohtml_kses( $input['h1_sample'] );
	$input['p_sample'] = wp_filter_nohtml_kses( $input['p_sample'] );
		
	$input['google_font_family_h1'] = wp_filter_nohtml_kses( $input['google_font_family_h1'] );
	$input['google_font_family_p'] = wp_filter_nohtml_kses( $input['google_font_family_p'] );
	
	
	$input['custom_google_font'] = str_replace(" ", '+', $input['custom_google_font']) ; // Spaces repalced with + for Google Fonts
	
	$input['custom_google_font'] = wp_filter_nohtml_kses( $input['custom_google_font'] );
	
	$allowed_html = array(); 
	$input['custom_google_font_css'] = wp_kses( $input['custom_google_font_css'], $allowed_html );

	
	$input['h1_size'] = wp_filter_nohtml_kses( $input['h1_size'] );
	$input['h2_size'] = wp_filter_nohtml_kses( $input['h2_size'] );
	$input['h3_size'] = wp_filter_nohtml_kses( $input['h3_size'] );
	$input['h4_size'] = wp_filter_nohtml_kses( $input['h4_size'] );
	$input['h5_size'] = wp_filter_nohtml_kses( $input['h5_size'] );
	$input['h6_size'] = wp_filter_nohtml_kses( $input['h6_size'] );
	$input['p_size'] = wp_filter_nohtml_kses( $input['p_size'] );
	
	
	
	
	return $input;
}

// Function to generate advanced options page
function sa_validate_advanced( $input ) {
	global $sa_advanced;

	$settings = get_option( 'sa_advanced', $sa_advanced );
		
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['author_credits'] ) )
		$input['author_credits'] = null;
	// We verify if the input is a boolean value
	$input['author_credits'] = ( $input['author_credits'] == 1 ? 1 : 0 );
	
	return $input;
}