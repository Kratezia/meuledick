<?php 
/**
	* header.php
	
	* WordPress Header File - Responsible for Doctype through open BODY tag. 
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.2
	* @link       http://www.themovation.com/eatery

	* AUG 20, 2013 - Add / Remove Viewport tag as per fluid, semi-fluid and fully responsive
	* options inside theme options (layout tab).

	* FEB 21, 2014 - Added support for full screen background images in IE8

*/


/**
	* wc_button

	* Takes a URL, Target, color, align, size, shape and returns a formatted button.

*/

/* CUSTOM LAYOUT OPTIONS */
global $sa_layout;
$layout_options = get_option('sa_layout',$sa_layout); // Get Layout Options
$layout_view = $layout_options['layout_view']; // Responsive (Fluid) or Unresponsive (Fixed)
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
<?php 
/* Theme Options | ENABLE / DISABLE Responsive theme */
if ($layout_view == 'fluid'){ echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />"; }
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php
    if ( is_single() ) { single_post_title(); }
    elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); }
    elseif ( is_page() ) { single_post_title(''); }
    elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . esc_html($s); }
    elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
	else { bloginfo('name'); wp_title('|'); }
?></title>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<?php wp_head(); ?>
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'eatery' ), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'eatery' ), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Responsive JS -->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!-- END Responsive JS -->

<?php 
/* ################ THEME OPTIONS ################ */ 
/* LAYOUT OPTIONS */ include (TEMPLATEPATH . '/header_layoutOpt.php'); 
/* TYPOGRAPHY OPTIONS */ include (TEMPLATEPATH . '/header_typoOpt.php'); 
/* GENERAL OPTIONS */ include (TEMPLATEPATH . '/header_generalOpt.php'); 
/* ################ END THEME OPTIONS ################ */ 
global $bg_tile, $use_full_background_image;
?>

</head>

<body <?php body_class(); ?>>

<?php
//-----------------------------------------------------
// demo options
//-----------------------------------------------------
$is_demo = false;
if($is_demo){
	wp_register_script('demo_options_cookie', get_template_directory_uri() . '/demo/js/jquery.cookie.js', array(), 1, true);
	wp_register_script('demo_options', get_template_directory_uri() . '/demo/js/demo_options.js', array('demo_options_cookie'), 1, true);
	wp_enqueue_script('demo_options');
	include( locate_template( 'demo/demo_options.php' ) );
} ?>
 
<?php if ($bg_tile > "" && $use_full_background_image){ ?>
<!--[if lte IE 8]>
<style type="text/css" media="screen">body {background:none !important;}</style>
<img src="<?php echo $bg_tile; ?>" class="ie87-bg">
<![endif]-->
<?php } ?>

<?php 
if ($layout_view == 'fluid'){  ?>
<!-- MOBILE MENU -->
<nav id="mobile-navigation" role="navigation">
    <?php 
	$theme_location = 'mobile-menu';
	if ( has_nav_menu( $theme_location ) ) {
		wp_nav_menu( array( 'theme_location' => $theme_location, 'menu_class' => 'nav-menu', 'fallback_cb'     => 'wp_page_menu', ) ); 
	}else{
		wp_nav_menu( array( 'theme_location' => '', 'menu_class' => 'nav-menu', 'fallback_cb'  => 'wp_page_menu', ) ); 
    }
	?>
</nav>
<?php } ?>

<div id="wrapper">
	<div id="header-bg"></div>