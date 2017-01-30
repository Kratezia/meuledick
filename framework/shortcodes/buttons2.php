<?php
/**
	* buttons2.php
	
	* Shortcode for Displaying Buttons
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/


/**
	* wc_button

	* Takes a URL, Target, color, align, size, shape and returns a formatted button.

*/


add_shortcode('button','wc_button');	
	
function wc_button($att, $content = null) {
	extract(shortcode_atts(array(
		'link' => '#',
		'target' => '',
		'color' => '',
		'align' => '',
		'size' => '',
		'shape' => '',
		'gradient' => '',
	), $att));
	
	$inlineStyleBG = '';
	$inlineStyleColor = '';
	$customColors = explode(" ", $color);
	
	$iCount = 0;
	
	if (is_array($customColors)){
		foreach ($customColors as $value){
			$hex_color = $value;
			if(preg_match('/^#[a-f0-9]{6}$/i', $hex_color) && $iCount == 0){
				//echo "The color code is valid";
				$inlineStyleBG = ' style="background-color:'.$hex_color.';"';
				$color = '';
			}elseif(preg_match('/^#[a-f0-9]{6}$/i', $hex_color) && $iCount == 1){
				$inlineStyleColor = 'style="color:'.$hex_color.';"';
			}
			$iCount ++;
		}
	}
	
	print_inline_stylesheet('button3CSS');
	
	if ($target > ""){
		$target = "target='".$target."'";
	}
	
	if ($gradient == "yes"){
		$my_button = '<a href="'.$link.'" ' .$target.' class="button '.$color.'"' .$inlineStyleBG.'><span '.$inlineStyleColor.'>'.do_shortcode($content).'</span></a>';
	}else{
		$my_button = '<a href="'.$link.'" ' .$target.' class="flatbutton '.$color.'"' .$inlineStyleBG.'><span '.$inlineStyleColor.'>'.do_shortcode($content).'</span></a>';
	}
	
	return $my_button; 
}
