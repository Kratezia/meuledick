<?php
/**
	* WC_Theme.php
	
	* A class to keep all our framework pointers in check.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.2
	* @link       http://www.themovation.com/eatery
		
	* JAN 22, 2014 - Added new custom post type , events.
	* JAN 22, 2014 - Added new tax event category
	* APR 15, 2014 - Added support for TinyMCE 4
	
*/

if(!class_exists('WC_Theme')){

class WC_Theme {
	
	// Initialize
	
	function init($options) {
		
		// Define constants
		$this->constants($options);
		
		// Add language support
		$this->language();
		
		// Functions
		$this->functions();
		
		// Custom post type
		$this->types();
		
		// Mobile Functions
		$this->mobile();
		
		// Custom Taxonomies
		$this->taxonomies();
		
		// Custom Metaboxes
		$this->metaboxes();
		
		// Shortcodess
		$this->shortcodes();
		
		// settings
		$this->settings();

		// Admin files
       $this->admin_options();
	   
	   // Plugins
       $this->plugins();
	   
	   // Widgets
       $this->widgets();

	}
	
	// Class Constants

	function constants($options) {
		
		// THEME
		define('THEME_NAME', $options['theme_name']);
		define('THEME_SLUG', $options['theme_slug']);
		define('THEME_VERSION', $options['theme_version']);
		define('THEME_DIR', get_template_directory());
		define('THEME_URI', get_template_directory_uri());
		
		define('THEME_FRAMEWORK', THEME_DIR . '/framework');
		define('THEME_FRAMEWORK_URI', THEME_URI . '/framework');
		
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		define('THEME_CUSTOM_TYPES', THEME_FRAMEWORK . '/custom_types');
		define('THEME_MOBILE', THEME_FRAMEWORK . '/mobile');
		define('THEME_TAXONOMIES', THEME_FRAMEWORK . '/taxonomies');
		define('THEME_META_BOXES', THEME_FRAMEWORK . '/metaboxes');
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');
		define('THEME_SHORTCODES', THEME_FRAMEWORK . '/shortcodes');
		define('THEME_SETTINGS', THEME_FRAMEWORK . '/settings');
		
		define('THEME_INCLUDES', THEME_URI . '/includes');
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');
		
		// ADMIN
		define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
		define('THEME_ADMIN_URI', THEME_FRAMEWORK_URI . '/admin');
		
		define('THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions');
		define('THEME_ADMIN_URI_JS', THEME_ADMIN_URI . '/js');
		
	}
	
	
	
	// Register the custom post type for the theme.
	function types() {
		require_once (THEME_CUSTOM_TYPES . '/menu_item.php');
		require_once (THEME_CUSTOM_TYPES . '/themo_events.php');
	}
	
	// Register the mobile / responsive functions for this theme.
	function mobile() {
		require_once (THEME_MOBILE . '/walker_responsive_menu.php');
	}
	

	// Load taxonomies
	function taxonomies() {
		require_once (THEME_TAXONOMIES . '/food_menu.php');
		require_once (THEME_TAXONOMIES . '/event_category.php');
	}
	
	
	// Load metaboxes / Custom Post Type Meta
	function metaboxes() {
		require_once (THEME_META_BOXES . '/menu_item_details.php');
	}
	
	// Load specific global settings.
	function settings() {
		require_once (THEME_SETTINGS . '/images.php');
		require_once (THEME_SETTINGS . '/theme_setup.php');
		require_once (THEME_SETTINGS . '/sidebars.php');
	}
	
	
	
	// Loads the core functions.
	function functions() {
		require_once (THEME_FUNCTIONS . '/common.php');
		require_once (THEME_FUNCTIONS . '/err.php');
	}
	
	// Load theme options.
	function admin_options() {
		
		if (is_admin()) {
			require_once (THEME_ADMIN_OPTIONS . '/general.php');
			require_once (THEME_ADMIN_OPTIONS . '/layout.php');
			require_once (THEME_ADMIN_OPTIONS . '/social_media.php');
			require_once (THEME_ADMIN_OPTIONS . '/typography.php');
			require_once (THEME_ADMIN_OPTIONS . '/advanced.php');
			require_once (THEME_ADMIN_OPTIONS . '/options.php');
		}
	}
	
	
	// Load plugins 
	// Placeholder for future plugins
	function plugins() {
	}
	
	// Register theme's extra widgets.
	// Placeholder for future widgets
	function widgets() {
		require_once (THEME_WIDGETS . '/text_widget_centered.php');
		require_once (THEME_WIDGETS . '/themo_upcoming_events.php');
	}
	
	// Register shortcodes.
	function shortcodes() {
		global $wp_version;
		if ( $wp_version >= 3.9 ) { // Support for TinyMCE 4 with WP version 3.9 +
			require_once (THEME_SHORTCODES . '/tinymce_buttons_ver_4.php');
		}else{
			require_once (THEME_SHORTCODES . '/tinymce_buttons.php');
		}
		require_once (THEME_SHORTCODES . '/food_menu.php');
		require_once (THEME_SHORTCODES . '/wp_caption.php');
		require_once (THEME_SHORTCODES . '/columns.php');
		require_once (THEME_SHORTCODES . '/rulers.php');
		require_once (THEME_SHORTCODES . '/typography.php');
		require_once (THEME_SHORTCODES . '/slideshow.php');
		require_once (THEME_SHORTCODES . '/images.php');
		require_once (THEME_SHORTCODES . '/gmap.php');
		require_once (THEME_SHORTCODES . '/buttons2.php');
		require_once (THEME_SHORTCODES . '/tabs3.php');
		require_once (THEME_SHORTCODES . '/toggle.php');
		require_once (THEME_SHORTCODES . '/show_posts.php');
	}
	
	// Load admin files.
	function admin() {
		if (is_admin()) {
			require_once (THEME_ADMIN . '/admin.php');
			$admin = new Theme_admin();
			$admin->init();
		}
	}
	
	/**
	 * Make theme available for translation
	 */
	
	function language(){			
		 /* Load translation domain --------------------------------------------------*/
		load_theme_textdomain('eatery', THEME_DIR . '/languages'); 
		
		$locale = get_locale();
		$locale_file = THEME_DIR . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	}

}
}