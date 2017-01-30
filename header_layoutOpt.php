<?php
/* CUSTOM LAYOUT OPTIONS */
global $sa_layout, $sa_social_media, $bg_tile, $use_full_background_image, $disable_sidebar_bg_tiling;

$layout_options = get_option('sa_layout',$sa_layout); // Get Layout Options
$bg_tile = $layout_options['upload_image10']; // Background Tile

$use_full_background_image = false;
$use_full_background_image = $layout_options['use_full_background_image']; // Background Tile

$disable_sidebar_bg_tiling = false;
$disable_sidebar_bg_tiling = $layout_options['disable_sidebar_bg_tiling']; // Sidebar Background Tile

$bg_sidebar_tile = $layout_options['upload_image11']; // Sidebar Tile

if(isset($layout_options['hide_page_corners']))
{ 
	$hide_page_corners = $layout_options['hide_page_corners']; // Hide Corner Style
}

$layout_view = $layout_options['layout_view']; // Responsive (Fluid) or Unresponsive (Fixed)
$style_theme = $layout_options['skin_selection']; // Skin Selection

// THEME LAYOUT OPTIONS
$use_custom_colors  = $layout_options['use_custom_colors']; // Custom Color Selection. (Override skin colors.)
$skin_color_populator = $layout_options['layout_skin_color']; // Skin Color Populator
$colorPalette_dark = $layout_options['colorPalette_dark'];  // Custom Color Selection.
$colorPalette_mid1 = $layout_options['colorPalette_mid1']; // Custom Color Selection.
$colorPalette_mid2 = $layout_options['colorPalette_mid2']; // Custom Color Selection.
$colorPalette_light = $layout_options['colorPalette_light']; // Custom Color Selection.
$colorPalette_offwhite = $layout_options['colorPalette_offwhite']; // Custom Color Selection.
$colorPalette_brightwhite = $layout_options['colorPalette_brightwhite'];// Custom Color Selection.
$use_header_BG_image = $layout_options['use_header_BG_image']; // Use Header Image Option
$header_default = $layout_options['header_default']; // Get default header placeholder for theme activation. 
$header_default_sm = $layout_options['header_default_sm']; // Get default small header placeholder for theme activation. 
$header_default_image_path = get_bloginfo('template_directory'). "/images/"; // Get default header placeholder
$header_default_sm = $header_default_image_path . $header_default_sm; // Get default header placeholder
$header_default = $header_default_image_path . $header_default; // Get default header placeholder

if(isset($layout_options['sa_layout_header_BG_image'])){
	if (is_ssl()) {
		$url = $layout_options['sa_layout_header_BG_image'];
		$header_BG_image = str_replace("http", "https", $url); // Get Custom Header Image
	}else{
		$header_BG_image = $layout_options['sa_layout_header_BG_image']; // Get Custom Header Image
	}
}
if(isset($layout_options['sa_layout_header_BG_image_sm'])){
	if (is_ssl()) {
		$url = $layout_options['sa_layout_header_BG_image_sm'];
		$header_BG_image_sm = str_replace("http", "https", $url); // Get Custom Header Image
	}else{
		$header_BG_image_sm = $layout_options['sa_layout_header_BG_image_sm']; // Get Custom Header Image
	}
}
// END THEME LAYOUT OPTIONS

// THEME SOCIAL OPTIONS
$soc_options = get_option('sa_social_media',$sa_social_media);
if(isset($soc_options['soc_use_custom_color'])){
	$soc_use_custom_color = $soc_options['soc_use_custom_color'];
}else{
	$soc_use_custom_color ='';
}
$soc_icon_color = $soc_options['soc_icon_color'];
// END SOCIAL OPTIONS

?>
<?php if ($use_custom_colors){ 
/* Theme Options | Custom Colors */ ?>
<style type="text/css">
/* CUSTOM COLORS */
div.message {
	background-color: <?php echo $colorPalette_offwhite; ?>;
	border-color:<?php echo $colorPalette_dark; ?>;
	color:#333;
}

div.message, div.message h4, div.message ol li{
	color:<?php echo $colorPalette_light; ?>;
}

/* GENERAL */

#wp-calendar tbody .pad:hover { background:none} 

/* Off white  */

body{background-color:<?php echo $colorPalette_offwhite; ?>;}

/* Bright white  *****************/

#footer, #inner-content {background-color:<?php echo $colorPalette_brightwhite; ?>;}

/* Background Color  *****************/

#sidebar {background-color:<?php echo $colorPalette_dark; ?>;}
#sidebar .soc a:hover {background-color:<?php echo $colorPalette_dark; ?> !important;}
#sidebar .side-widget a:hover {color:<?php echo $colorPalette_dark; ?>;}
#sidebar .side-widget ul li a:hover {background-color:<?php echo $colorPalette_mid1; ?>;  color:<?php echo $colorPalette_dark; ?>;}  /* SIDE BG & SIDE CONTRAST */
#wp-calendar tbody td:hover { background: <?php echo $colorPalette_dark; ?> ;} 		
#wp-calendar tbody td {  border: 1px solid <?php echo $colorPalette_dark; ?>; }
#wp-calendar tbody .pad {background:<?php echo $colorPalette_dark; ?>;}
#sidebar-menu li ul li {border-top:2px solid <?php echo $colorPalette_dark; ?>;  border-style: dotted dashed;}
#sidebar-menu li ul{
		border: 1px solid <?php echo $colorPalette_dark; ?>;
-webkit-border-bottom-right-radius: 5px;
 -webkit-border-bottom-left-radius: 5px;
	-moz-border-radius-bottomright: 5px;
	 -moz-border-radius-bottomleft: 5px;
		border-bottom-right-radius: 5px;
		 border-bottom-left-radius: 5px;
-webkit-box-shadow:0 0 4px rgba(0, 0, 0, 0.1);
   -moz-box-shadow:0 0 4px rgba(0, 0, 0, 0.1);
		box-shadow:0 0 4px rgba(0, 0, 0, 0.1);
}

#sidebar-menu li a:hover {background:<?php echo $colorPalette_dark; ?>;}

/*.dropcap1{background-color: <?php echo $colorPalette_dark; ?>;}*/

#form-wrapper .sendbtn{border-color:<?php echo $colorPalette_dark; ?>;}

/* Contrasting Color  *****************/

#sidebar h1, #sidebar h2, #sidebar h3, #sidebar h4, #sidebar h5, #sidebar h6, 
#sidebar h1 a, #sidebar h2 a, #sidebar h3 a, #sidebar h4 a, #sidebar h5 a, #sidebar h6 a,
#sidebar p a, #sidebar a{color: <?php echo $colorPalette_mid1; ?>;}
#sidebar h1 a:hover, #sidebar h2 a:hover, #sidebar h3 a:hover, #sidebar h4 a:hover, 
#sidebar h5 a:hover, #sidebar h6 a:hover, #sidebar p a:hover, #sidebar #older-posts a:hover, 
#sidebar #newer-posts a:hover{text-decoration:none; color:<?php echo $colorPalette_dark; ?> ;background-color: <?php echo $colorPalette_mid1; ?>;}
p a, #older-posts a, #newer-posts a{color: <?php echo $colorPalette_mid1; ?>;}
#sidebar p {color:<?php echo $colorPalette_mid1; ?>;}
#sidebar .tagcloud a:hover {background-color:<?php echo $colorPalette_mid1; ?> ;}
#sidebar-menu li a, #sidebar .side-widget a {color:<?php echo $colorPalette_mid1; ?>;}
#sidebar .side-widget ul li a {border-color:<?php echo $colorPalette_mid1; ?>; border-width:1px} 
#sidebar-menu li a:hover {color:<?php echo ($skin_color_populator == 'blank' ?  "#000000" :  $colorPalette_brightwhite);?>;}
#sidebar #wp-calendar tbody td a:link, #sidebar #wp-calendar tbody td a {color:<?php echo $colorPalette_mid1; ?>; font-weight:bold; text-decoration:underline }
#wp-calendar thead th, #wp-calendar caption { color: <?php echo $colorPalette_mid1; ?>;}
#wp-calendar tbody { color: <?php echo $colorPalette_mid1; ?>; }

/* Tint  *****************/

h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, p a:hover, #older-posts a:hover, #newer-posts a:hover{text-decoration:none; color:<?php echo $colorPalette_mid1; ?> ;background-color: <?php echo $colorPalette_mid2; ?>;}
#sidebar .tagcloud a{background-color: <?php echo $colorPalette_mid2; ?>;}		
#wp-calendar tbody td { background: <?php echo $colorPalette_mid2; ?>;}		
#form-wrapper .sendbtn:hover{background-color: <?php echo $colorPalette_mid2; ?>;}
#form-wrapper .sendbtn{background-color:<?php echo $colorPalette_mid2; ?>;}
#sidebar-menu li ul {background-color:<?php echo $colorPalette_mid2; ?>;}
blockquote p{color: <?php echo ($skin_color_populator == 'blank' ?  $colorPalette_mid1 :  $colorPalette_mid2); ?>;}
.dropcap1shade{background-color:<?php echo ($skin_color_populator == 'blank' ?  $colorPalette_mid1 :  $colorPalette_mid2); ?>;}
.dropcap2shade{color:<?php echo ($skin_color_populator == 'blank' ?  $colorPalette_mid1 :  $colorPalette_mid2); ?>; }
.highlight.dark{background-color: echo <?php ($skin_color_populator == 'blank' ?  $colorPalette_mid1 :  $colorPalette_mid2); ?>;}
blockquote{border-top-color:<?php echo $colorPalette_mid2; ?>; }
.ruler{border-color:<?php echo $colorPalette_mid2; ?>;}
body > div#top-bar {
	background: <?php echo $colorPalette_mid2; ?>;
}
.mobile-menu, .mobile-menu:active,  .mobile-menu:hover {
	background: <?php echo $colorPalette_mid2; ?>;
}
#sidebar .side-widget.mobile {border-color:<?php echo $colorPalette_mid2; ?>;}
.menu_item_wrapper, h3.menu-title, h4.menu-title {border-color:<?php echo $colorPalette_offwhite; ?>;}

/* Text, Headings etc.  *****************/
h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, p a, a{color: <?php echo $colorPalette_light; ?>;}
img.alignleft, img.alignright, img.aligncenter {
	border-color:<?php echo $colorPalette_offwhite; ?>
}
.menu_item_image_sm img, .search_image_sm {
	border-color:<?php echo $colorPalette_offwhite; ?>
}
.wp-caption {
	font-family:Arial, Helvetica, sans-serif;
	border-color:<?php echo $colorPalette_offwhite; ?>;
	background-color:<?php echo $colorPalette_brightwhite; ?>;
}
p.wp-caption-text {background-color:<?php echo $colorPalette_offwhite; ?>;}

/* END CUSTOM COLORS */	
</style>
<?php  
/* END Theme Options | Custom Colors */ 
} else { 
/* Skin Style Sheet */ 
?>
<!-- SKIN STYLE SHEET -->
<link href="<?php bloginfo('stylesheet_directory'); ?>/skins/<?php echo $style_theme ?>/style.css" rel="stylesheet" type="text/css" />
<?php 
/* END Skin Style Sheet */ 
} ?>

<!-- THEME OPTION SETTINGS | CSS --> 
<style type="text/css"> 
 <?php
/* Social Media */
if ($soc_use_custom_color && $soc_icon_color > ""){	?>
/* Custom Social Media Icon */
.googleplus, .googlemaps, .linkedin, .meetup, .phone, .pinterest, .rss, .sharethis, .tripadvisor, .tumblr, .twitter, .urbanspoon, .vimeo, .yelp, .youtube, .bookmark, .email, .facebook, .foursquare, .instagram{
background-image: url(<?php bloginfo('template_directory'); echo "/images/" . $soc_icon_color; ?>);}
.soc a, soc a:hover{ opacity:1.0 ;}

<?php } else { ?>	
/* Social Media Icon  */
.googleplus, .googlemaps, .linkedin, .meetup, .phone, .pinterest, .rss, .sharethis, .tripadvisor, .tumblr, .twitter, .urbanspoon, .vimeo, .yelp, .youtube, .bookmark, .email, .facebook, .foursquare, .instagram{
		background-image: url(<?php bloginfo('template_directory'); ?>/skins/<?php echo $style_theme ?>/images/sprites.png);}
<?php }

// If theme option has use header bg image to true, show bg image.	
if ($use_header_BG_image){	?>
/* CUSTOM BG HEADER */
#header-bg{
	background-image:url(<?php echo ($header_BG_image > "" ? $header_BG_image : $header_default);?>);}

<?php 
/* Theme Options | ENABLE / DISABLE Responsive theme */
if ($layout_view == 'fluid'){ ?>
/* Responsive CSS */
@media only screen and (max-width: 1280px) {
	#header-bg {
		background:url(<?php echo ($header_BG_image_sm > "" ? $header_BG_image_sm : $header_default_sm);?>);
		background-position:top center;
		background-repeat:repeat-x;
		}				
		#main-content {
			margin-top:270px;
		}
}
@media handheld, only screen and (max-width: 767px) {
	#main-content{
		margin: 0;
	}
}
<?php 
}
		
// Else don't show header-bg and move content up to top of page.
 }else{ ?>
		/* CUSTOM HEADER OPTION */
		#header-bg{
			visibility:hidden;
			display:none;
		}
		.container, #main-content {
			margin-top: 0;
		}
	<?php
}

// Theme option to use custom page background tile
if ($bg_tile > ""){	?>
        /* CUSTOM background Tile */
        body {background-image:url(<?php echo $bg_tile; ?>);
		<?php if ($use_full_background_image){ ?>
			background-repeat:no-repeat;
			background-attachment:fixed;
			-webkit-background-size: cover; /* For WebKit*/
			-moz-background-size: cover;    /* Mozilla*/
			-o-background-size: cover;      /* Opera*/
			background-size: cover;         /* Generic*/
		<?php }else{ ?>
			background-repeat:repeat;
		<?php } ?>
		}
<?php } 

// Theme option to use custom sidebar tile.
if ($bg_sidebar_tile > ""){	?>
        /* CUSTOM Sidebar Tile */
        #sidebar {background-image:url(<?php echo $bg_sidebar_tile; ?>);
        background-repeat:repeat;}
<?php } 
if ($disable_sidebar_bg_tiling){	?>
		#sidebar {background-image:none !important}
<?php }

// Hide page corners from admin options.	
if ($hide_page_corners == 1){ ?>
        /* Hide page corner style  */
        .corner {background:none;}
        
<?php }  ?>


</style>
<link href="<?php bloginfo('template_directory'); ?>/css/social_media.css" rel="stylesheet" type="text/css" />