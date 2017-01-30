<?php
/**
	* slideshow.php
	
	* Shortcode for slideshow / references nivo-slider library. 
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - Sep 26, 2013 - Fixed bug when using links with sliders. line 194
*/

/**
	* wc_slideshow
	
	* Displays a slider using the nivo-slider libary.

*/


add_action( 'wp_enqueue_scripts' , 'register_slideshow_scrtips' );
add_shortcode('slideshow', 'wc_slideshow');
 
function register_slideshow_scrtips() {	
	wp_register_script('jquery.nivo.slider', get_template_directory_uri() . '/js/nivo-slider/jquery.nivo.slider.js',array('jquery') , '1.0' , true);
	$css_url_default = get_template_directory_uri() . '/css/nivo/default/default.css';
	$css_url_nivo_slider = get_template_directory_uri() .  '/css/nivo-slider.css';	
	
	wp_register_style( 'slideshowCSS', $css_url_default );
	wp_register_style( 'slideshowCSS1', $css_url_nivo_slider );
}
	
/**
	* Function wc_slideshow.

	* Produces a slider from list of image URLs 
	* Uses Nivo-Slider Scripts / Library 
	* http://nivo.dev7studios.com/

	* @slider_height (string) - height of the slider in px
	* @slider_width (string) - width of the slider in px
	* @effect (string) - use different effects
	
	* Returns timthumb URL.
*/

function wc_slideshow($atts, $content = null) {
	global $sa_general;
	
	extract(shortcode_atts(array(
		'slider_height' => '0',
		'slider_width' => '668',
		'effect' => 'boxRandom',
		'showtitle' => true
	), $atts));

	$title = '';
	$preStyle = '';
	$IMG_TAGS = '';
	
	$general_options = get_option('sa_general',$sa_general); 
	$use_timthumb = $general_options['use_timthumb'];
	
	$slider_height_att = '';
	if($slider_height > 0){
		$slider_height_att = "height='".$slider_height."'";
	}
	wp_print_scripts('jquery.nivo.slider');
	
	$effect = strtolower($effect);
	
	/* Allows User to select their own slider effect. They pass this in with the effect=boxRain attribute. */
	switch ($effect) {
    case 'slicedown':
        $effect = "sliceDown";
        break;
    case 'sliceup':
		$effect = "sliceUp";
        break;
    case 'sliceupdown':
		$effect = "sliceUpDown";
        break;
    case 'fold':
		$effect = "fold";
        break;
    case 'fade':
		$effect = "fade";
        break;
    case 'boxrain':
		$effect = "boxRain";
        break;
	default:
		$effect = "boxRandom";
	}
	
	
	// Trim all space off $content.
	$content = trim($content);
	
	if ($content > ""){
		$doc = new DOMDocument();
		$doc->loadHTML($content);
		$imageTags = $doc->getElementsByTagName('img');
		//$imageHref = $doc->getElementsByTagName('a');
		
		foreach($imageTags as $tag) {
		   // $content .= $tag->getAttribute('src') ."\n";
			$IMG_TAGS .= $tag->getAttribute('src') ."\n";
		}		
	}
	
	// Remove all IMG TAGS
	$content = preg_replace("/<img[^>]+\>/i", "", $content);
	
	// Remove all HREF TAGS
	$content = preg_replace("/<\\/?a(\\s+.*?>|>)/", "", $content);
	
	// ADD Everything together.
	$content = $content . "\n" . $IMG_TAGS;
	
	// Organize each line of content into an array.
	$images = !empty($content)?preg_split("/(\r?\n)/", $content):'';
	
	//print_r($images);

	// Check if something exists and that it is an array.
	if(!empty($images) && is_array($images)){
		
		// Clear the $content string.
		$content = '';
		
		// For each image in the array, check for URL's and create the Nivo Slider Content.
		foreach($images as $image){
			
			// Strip any HTML Tags
			$image = trim(strip_tags($image));
			
			// Separate the image path and link url (looks for comma to distinguish).
			
			
			$pos = strpos($image, ',');
			
			// Look for , and if it exists then we have to split URL and Image path.
			if ($pos === false) {
				$imagePath = $image;
				$imageLink = '';
			} else {
				list($imagePath, $imageLink) = split(',', $image);
			}

			
			
			// Clean up any leading or trailing spaces. Make sure to remove http:// and https://
			$imageLink = trim($imageLink);
			$imageLink = remove_http($imageLink);

			
			// If image path is no empty and it's great than nothing, continue...
			if(!empty($imagePath) && $imagePath > ''){
				
				// We now use get_attachment_id_from_src() to find the postID of the image attachement (custom function under /functions/common.php). 
				$postid = get_attachment_id_from_src($imagePath);
				
				// Get the image size.
				$image_attributes = wp_get_attachment_image_src( $postid, 'full' ); // returns an array
				
				// Return the post object and title
				$postid = get_post($postid); 
				if ($showtitle){
					$title = $postid->post_title;
				}
				
				// Clear tmp vars.
				$imageLinkOpen = "";
				$imageLinkClose = "";
				
				// Build the tmp vars for the image link (if one was supplied)
				if ($imageLink > ""){
					$imageLinkOpen = "<a href='http://".$imageLink."'>";
					$imageLinkClose = "</a>";
				}
				
				
				// TIMTHUMB OPTION
				if ($use_timthumb){
				// Build and add on to the $content string.
					$content .= $imageLinkOpen . "<img src='". resize_img($image_attributes[0],$slider_width,$slider_height) ."' width='". $slider_width . "' ".$slider_height_att." alt='". $title ."' title='". $title ."' data-transition='".$effect."' />" . $imageLinkClose;
				}else{
				// DEFAULT RESIZING OPTION
					$content .= $imageLinkOpen . "<img src='". $imagePath ."' width='". $slider_width . "' ".$slider_height_att." alt='". $title ."' title='". $title ."' data-transition='".$effect."' />" . $imageLinkClose;
				}
				
				
			} //end IF
		} // END FOR EACH
		
		
		$preHTML = "<div class=\"slider-wrapper theme-default\">
					<div class=\"ribbon\"></div>
					<div id=\"slider\" class=\"nivoSlider\"  style=\"max-width:".$slider_width."px\">"; 
		$postHTML = "</div>\n</div>";
		return $preStyle . $preHTML . $content . $postHTML;
	} // END IF
} // END FUNCTION