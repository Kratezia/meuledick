<?php
/**
	* images.php
	
	* Shortcode for an image resizer (pseudo-TimThumb)
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - Jan 16, 2012
	* Added case sensitive support for WP installs in sub folders.
	* 1.2 - Feb 7, 2014
	* Support for images smaller than 180px high 
*/

/**
 * Image shortcode callback
 *
 * Enables the [image] shortcode, pseudo-TimThumb but creates resized and cropped image files
 * from existing media library entries. Usage: 
 * [image src="http://example.org/wp-content/uploads/2012/05/image.png" width="100" height="100"]
 *
 * @uses image_make_intermediate_size
 */
 
 
add_action( 'wp_enqueue_scripts' , 'register_image_scrtips' );
add_shortcode( 'image', 'wc_image_shortcode' );

function register_image_scrtips() {
	wp_register_script('jquery.prettyPhoto', get_template_directory_uri() . '/js/prettyphoto/jquery.prettyPhoto.js', '', '', true);
	wp_register_script('jquery.prettyPhoto.settings', get_template_directory_uri() . '/js/prettyphoto/jquery.prettyPhoto.settings.js', '', '', true);
	}
	
	
function wc_image_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'src' => '',
		'width' => '',
		'height' => '',
		'lightbox' => 1,
		'title' => '',
		'align' => 'none'
	), $atts ) );


	wp_print_scripts('jquery');	
	wp_print_scripts('jquery.prettyPhoto');	
	wp_print_scripts('jquery.prettyPhoto.settings');	
	
	$alt = '';
	
	global $wpdb;
	$orgSize = $src;
	

	// Sanitize
	$height = absint( $height );
	$width = absint( $width );
	$org_src = esc_url( $src ); // Oringal src without conversion to lowercase.
	$src = esc_url( strtolower( $src ) );
	$needs_resize = true;
	$align = strtolower($align);

	$upload_dir = wp_upload_dir();
	$org_base_url = $upload_dir['baseurl'] ; // org_base_url without conversion to lowercase.
	$base_url = strtolower( $upload_dir['baseurl'] );
	
	// Let's see if the image belongs to our uploads directory.
	if ( substr( $src, 0, strlen( $base_url ) ) != $base_url ) {
		return "Error: external images are not supported.";
	}
	
	// Look the file up in the database.
	$file = str_replace( trailingslashit( $base_url ), '', $src );
	$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE %s LIMIT 1;", '%"' . like_escape( $file ) . '"%' ) );

	// If an attachment record was not found.
	if ( ! $attachment_id ) {
		return "Error: attachment not found.";
	}
	
	// Look through the attachment meta data for an image that fits our size.
	$meta = wp_get_attachment_metadata( $attachment_id );	
	foreach( $meta['sizes'] as $key => $size ) {
		if ( $size['width'] == $width && $size['height'] == $height ) {
			$src = str_replace( basename( $org_src ), $size['file'], $org_src );
			$needs_resize = false;
			break;
		}
	}
	
	// If an image of such size was not found, we can create one.
	if ( $needs_resize ) {
		
		$attached_file = get_attached_file( $attachment_id );
		$resized = image_make_intermediate_size( $attached_file, $width, $height, true );
		
		if ($resized) {
			// Let metadata know about our new size.
			$key = sprintf( 'resized-%dx%d', $width, $height );
			$meta['sizes'][$key] = $resized;
			$src = str_replace( basename( $org_src ), $resized['file'], $org_src );
			wp_update_attachment_metadata( $attachment_id, $meta );
			
			// Record in backup sizes so everything's cleaned up when attachment is deleted.
			$backup_sizes = get_post_meta( $attachment_id, '_wp_attachment_backup_sizes', true );
			if ( ! is_array( $backup_sizes ) ) $backup_sizes = array();
			$backup_sizes[$key] = $resized;
			update_post_meta( $attachment_id, '_wp_attachment_backup_sizes', $backup_sizes );
		}else{
			$src = $org_src;
		}
		
	}
	
	// Generate the markup and return.
	$width = ( $width ) ? 'width="' . absint( $width ) . '"' : '';
	$height = ( $height ) ? 'height="' . absint( $height ) . '"' : '';
	
	switch ($align) {
		case "left":
			$align = "alignleft";
			break;
		case "right":
			$align = "alignright";
			break;
		case "center":
			$align = "aligncenter";
			break;
		default:
       		$align = "alignnone";
	}
	

	if (!$lightbox){
		return sprintf( '<img class="'.$align.'" src="%s" %s %s />', esc_url( $src ), $width, $height );			
	}else{
		global $add_my_lightbox_script; 
		$add_my_lightbox_script = true;
		
		if ($title > ""){
			$alt = $title;
			$title = "title='".$title."' ";
			
		} 
		$prettyPhoto  = ' data-gal="prettyPhoto[gallery1]" ' . $title ;
		return sprintf( '<a '.$prettyPhoto.' href="'.$orgSize.'"><img src="%s" %s %s alt="'.$alt.'" class="'.$align.'" /></a>', esc_url( $src ), $width, $height );
	}	
}