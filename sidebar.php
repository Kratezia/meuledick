<!-- BEGIN sidebar -->
<?php 

global $soc_options, $sa_layout;

$soc_icon_color = $soc_options['soc_icon_color'];
$layout_options = get_option('sa_layout',$sa_layout); // Get currenly selected theme, default to black theme.
$style_theme = $layout_options['skin_selection']; // get selected theme.
$logo = $layout_options['upload_image0']; // get logo path.
$width = $layout_options['upload_image0-width']; // get logo width.
$height = $layout_options['upload_image0-height']; // get logo height.

if ($logo == '') { //If there is a custom logo, display it.
	$logo = get_template_directory_uri() . '/skins/'.$style_theme.'/images/logo.png';
	$width = '260px';
	$heigh = '200px';
}
$site_title = get_bloginfo( );
$site_url = home_url();
/* SOCIAL MEDIA OPTIONS */ include (TEMPLATEPATH . '/sidebar_socialOpt.php'); 
?>
<div id="sidebar-container" class="fourcol">
    <div id="sidebar">
        <div id="sidebarBorder">
            <div id="logo"><?php echo "<a href='$site_url'><img src='$logo' alt='$site_title' /></a>"; ?></div>
            <!-- ABOVE BEGIN--><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Above Sidebar Navigation") ) : ?> <?php endif; ?><!-- ABOVE END-->
			<div id="the-side-menu"><div class="menu-main-menu-container"><ul id="sidebar-menu" class="sf-menu sf-vertical"><?php wp_nav_menu(array( 'theme_location' => 'side-menu', 'menu_id' => 'sidebar-menu', 'menu_class'  => 'sf-menu sf-vertical', 'depth' => 4, 'fallback_cb' => 'show_memu_help', 'items_wrap' => '%3$s', 'container' => '' )); ?>
            </ul></div><br class="clear" /></div>         
            <!-- BELOW BEGIN--><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Below Sidebar Navigation") ) : ?><?php endif; ?>	<!-- BELOW END-->
            <!-- MOBILE BEGIN--><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Mobile Sidebar") ) : ?><?php endif; ?>	<!-- MOBILE END-->
            <?php echo returnSOClinks($style_theme); // Calls Funstion to Return icons and links to social media accounts. Check out include file sidebar_socialOpt.php ?>
        </div>
    </div>
</div>
<!-- END sidebar -->