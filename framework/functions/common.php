<?php
/**
	* common.php
	
	* Created to provide commonly used functions to framework
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/


/**
	* Function resize_img.

	* Resizes images using the TimThumb Library 
	* http://code.google.com/p/timthumb/ 

	* @source (string) - Full path to an image. EG: http://www.myweb.com/image.jpg
	* @width (string) - Desired width of returned image.
	* @height (string) - Desired height of returned image.
	* @quality (string) - Quality of image.
	
	* Returns timthumb URL.
*/

function resize_img($source,$width = NULL,$height = NULL,$quality=100){
	$src = $source;
	$width = $width;
	$height = $height;
	return THEME_INCLUDES.'/timthumb.php?src='.$src.((empty($height))?'':'&amp;h='.$height).'&amp;w='. $width .'&amp;zc=1'.($quality?'&q='.$quality:'');
}

/**
	* Function get_attachment_id_from_src.

	* Returns attachement ID from URL 

	* @url (string) - Full URL to post.
	
	* Returns attachment ID.
*/
function get_attachment_id_from_src($url) {
		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$url'";
		$id = $wpdb->get_var($query);
		return $id;
}

/**
	* Function remove_http.

	* Removes http:// and https:// from URL 

	* @url (string) - Full URL to post.
	
	* Returns URL without http://
*/
function remove_http($url = '')
{
    $list = array('http://', 'https://');
    foreach ($list as $word)
        if (strncasecmp($url, $word, strlen($word)) == 0)
            return substr($url, strlen($word));
    return $url;
}

/**
	* Function print_inline_stylesheet.
	* Helps keep track of styles so they are not printed twice.
	* Also ensures that they are registered before printing.

	* Prints inline stylesheet.

	* @handle (string) - stylesheet handle.
	
	* Prints Stylesheet.
*/
function print_inline_stylesheet( $handle ) {
	// continue only if the style has been registered and hasn't been printed yet.
	if ( wp_style_is( $handle, 'registered') && ! wp_style_is( $handle, 'done' ) ) {
		
		// gain access the wp_styles object
		global $wp_styles;
		
		// make sure the style is formatted with html 5 markup
		add_filter( 'style_loader_tag', 'html5_inline_stylesheet', 10, 2 );
		$print = $wp_styles->do_item( $handle );
		
		// set this style to 'done' status
		$wp_styles->done[] = $handle;
		
		// remove from to do just in case the style was invoked elsewhere for the footer.
		$to_do = $wp_styles ->to_do;
		if ( is_array( $to_do ) ) {
			foreach( $to_do as $key => $to_do_handle ) {
				if( $to_do_handle == $handle ) {
					unset( $wp_styles->to_do[$key] );
				}
			}
		}
	}
}

/**
	* Function html5_inline_stylesheet.

*/
function html5_inline_stylesheet( $output ) {
	$url = preg_match("/(href=')(.+)(' type)/", $output, $styleurl);
	$output = '<style scoped>@import url('.$styleurl[2].');</style>';
	return $output;
}

?>