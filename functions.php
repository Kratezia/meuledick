<?php

// Get the Eatery Theme Class.

require_once (TEMPLATEPATH . '/framework/WC_Theme.php');
$theme = new WC_Theme();
$options = include(TEMPLATEPATH . '/framework/info.php');
$theme->init($options);


// Add support for Automatic Feed Links

add_theme_support( 'automatic-feed-links' );


// Register Main menu

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'side-menu' => 'Sidebar Menu',
		  'mobile-menu' => 'Mobile Menu',
		)
	);
}

// Fallback Menu Help

function show_memu_help(){
	echo "<p>Eatery comes with a Sidebar Menu. See the help file to learn how to add sidebar navigation.</p>";
}


// Calendar Widget - Hide Title if Empty

function empty_widget_title($title)
{
    return $title == '&nbsp;' ? '' : $title;
}
add_filter('widget_title', 'empty_widget_title');


// Tag Cloud Widget modifications

function custom_tag_cloud_widget($args) {
	$args['number'] = 25; //adding a 0 will display all tags
	$args['largest'] = 11; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );


// Add Custom Blog Image Size

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'blog_image', 668, 180, true ); //(cropped)
}


// For [gallery], load PrettyPhoto Scripts

add_action( 'wp_enqueue_scripts' , 'register_prettyPhoto_script' );
add_filter( 'wp_get_attachment_link', 'sant_prettyadd');
 
function register_prettyPhoto_script() {
	wp_register_script('jquery.prettyPhoto', get_template_directory_uri() . '/js/prettyphoto/jquery.prettyPhoto.js', '', '', true);
	wp_register_script('jquery.prettyPhoto.settings', get_template_directory_uri() . '/js/prettyphoto/jquery.prettyPhoto.settings.js', '', '', true);
}
 
function sant_prettyadd ($content) {
	wp_print_scripts('jquery.prettyPhoto');	
	wp_print_scripts('jquery.prettyPhoto.settings');	
	$content = preg_replace("/<a/","<a data-gal=\"prettyPhoto[gallery1]\"",$content,1);
	return $content;
}
// END [gallery], load PrettyPhoto Scripts




/* 	
	Load jQuery + Styles 
	Don't load if we are in admin
*/
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);

function my_jquery_enqueue() {
	$scriptdir=get_bloginfo( 'template_directory' );
	
	// Load jQuery + CSS
	
	// VERT MENU | Superfish CSS  (includes superfish-vertical.css for the vertical menu)
	wp_register_style( 'superfish-css', $scriptdir.'/css/superfish.css', false, '1.4.8');
	wp_register_script( 'jqsf', $scriptdir.'/js/jqsf.js', false);
	wp_register_script( 'superfish', $scriptdir.'/js/superfish.js', false, '1.4.8');// Register the file you made that initialises Superfish
	
	
	
	wp_enqueue_style('superfish-css');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jqsf');
	wp_enqueue_script('superfish');
	
	
	// Image CSS | PrettyPhoto
	$css_prettyPhoto = get_template_directory_uri() . '/css/prettyPhoto.css';
	wp_register_style( 'imageCSS', $css_prettyPhoto, false, '3.1.4' );
	wp_enqueue_style('imageCSS');
	
	// Slide Show / Slider | NIVO CSS
	$css_nivo_default = get_template_directory_uri() . '/css/nivo/default/default.css';
	$css_nivo_slider = get_template_directory_uri() .  '/css/nivo-slider.css';	
	wp_register_style( 'nivoDefault', $css_nivo_default, false, '3.1' );
	wp_register_style( 'nivoSlider', $css_nivo_slider, false, '3.1' );
	wp_enqueue_style('nivoDefault');
	wp_enqueue_style('nivoSlider');
	
	// Conditional Comments for IE 9 and 7
	global $wp_styles; 
	wp_register_style( 
	  '1140-ie-9', 
	   $scriptdir. '/css/ie.css', 
	  false, 
	  '1.0.0' 
	); 
	
	$wp_styles->add_data( 
	  '1140-ie-9', //IE 9 handle 
	  'conditional',  //is a conditional comment 
	  'lte IE 9' //the conditional comment 
	);
	
	wp_enqueue_style('1140-ie-9'); //if lte IE 9
	
	wp_register_style( 
	  'ie-7', 
	   $scriptdir. '/css/ie7.css', 
	  false, 
	  '1.0.0' 
	); 
	
	$wp_styles->add_data( 
	  'ie-7', //IE 7 handle 
	  'conditional',  //is a conditional comment 
	  'lt IE 7' //the conditional comment 
	);
	
	wp_enqueue_style('ie-7'); //lt IE 7
	
	// 1140 framework for responsive css
	wp_register_style( '1140-css', $scriptdir.'/css/1140.css', false, '1.0.0');
	wp_enqueue_style('1140-css');
	
	// Default Skin
	global $sa_layout;
	$layout_options = get_option('sa_layout',$sa_layout);

	// THEME OPTION | Disable responsive css
	if( $layout_options['layout_view'] == 'fluid' ){ 
		wp_register_style( '1140-responsive-css', $scriptdir.'/css/1140-responsive.css', false, '1.0.0');
	}elseif ($layout_options['layout_view'] == 'semi-fluid'){ 
		wp_register_style( '1140-responsive-css', $scriptdir.'/css/1140-semi-fluid.css', false, '1.0.0');
	}else{
		wp_register_style( '1140-responsive-css', $scriptdir.'/css/1140-fixed.css', false, '1.0.0');
	} 
	wp_enqueue_style('1140-responsive-css');
	
	// WINDOW LOAD JS
	wp_register_script( 'window-load', $scriptdir.'/js/window.load.js', false);
	wp_enqueue_script('window-load');
}
// END Load jQuery + Styles


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own eatery_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */

if ( ! function_exists( 'eatery_comment' ) ) :

function eatery_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'eatery' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'eatery' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 60;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 40;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'eatery' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'eatery' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'eatery' ), '- <span class="edit-link">', '</span>' ); ?>
                    - <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'eatery' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'eatery' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for eatery_comment()


// Change the execution priority of wpautop so that it executes after the shotcodes are processed instead of before. 


function shortcode_empty_paragraph_fix($content){   
   
	$block = join("|",array("one_half","one_third","one_fourth","one_fifth","two_third","three_fourth","two_fifth","three_fifth","four_fifth","one_half_last","one_third_last","one_fourth_last","one_fifth_last","two_third_last","three_fourth_last","two_fifth_last","three_fifth_last","four_fifth_last","button","foodmenu","map","image","ruler","blogfeed","slideshow","tabwrap","tab","toggle","dropcap1","dropcap1shade","dropcap2","dropcap2shade","highlight","pullquote"));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);
	
	return $rep;
}

// Filter for Empty paragraphy fix

add_filter('the_content', 'shortcode_empty_paragraph_fix');


add_filter('widget_text', 'do_shortcode');

//load_theme_textdomain('eatery', THEME_FRAMEWORK . '/languages');

/*add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('eatery',  get_template_directory() . '/languages');
	echo get_template_directory() . '/languages';
}*/


add_filter( 'views_edit-themo_event', 'so_13813805_add_button_to_views' );
function so_13813805_add_button_to_views( $views )
{
    $admin_url = admin_url() . "options-permalink.php";
	$views['my-button'] = "<a href=\"$admin_url\" class=\"buttons\" style=\"margin:0 10px 10px 0\">Flush Rewrite Rules</a>";
    return $views;
}


/* #LOAD STYLES
================================================== */

function themo_meanmenu_css()
{

//meanmenu
 wp_enqueue_style('meanmenu', get_template_directory_uri() . '/css/meanmenu.css', 'style');

}
add_action('wp_enqueue_scripts', 'themo_meanmenu_css');


/* #LOAD SCRIPTS
================================================== */
function themo_meanmenu_js() {

 if ( !is_admin() ) {

wp_enqueue_script('jquery');  //Grabs the latest version of jQuery from WordPress

 wp_register_script('meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.js', array('jquery'), true );
 wp_enqueue_script('meanmenu');

 }
}
add_action('wp_enqueue_scripts', 'themo_meanmenu_js');

