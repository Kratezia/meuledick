<?php
/**
	* rulers.php
	
	* Shortcode rulers and dividers
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

/**
	* shortcode_insert_ruler
	
	* Displays HR's Rulers, Dividers - Takes top, bottom and margin (to set margin and padding).

*/
add_shortcode('ruler', 'shortcode_insert_ruler');

function shortcode_insert_ruler($atts) {
	extract(shortcode_atts(array(
		'top' => 'false',
		'bottom'=> 'false',
		'margins'=> '10',
	), $atts));
	$percent = '';
	$styles = array();
	
	if($top!== 'false'){
		$top = intval($top );
		$styles[] = 'padding-top:'.$top.'px';
	}
	if($bottom!== 'false'){
		$bottom = intval($bottom );
		$styles[] = 'margin-bottom:'.$bottom.'px';
	}
	if($percent!== 'false'){
		$margins = intval($margins );
		$styles[] = 'margin-left:'.$margins.'px';
		$styles[] = 'margin-right:'.$margins.'px';
	}
	if(!empty($styles)){
		$style = ' style="'.implode(';', $styles).'"';
	}else{
		$style = '';
	}
	return '<div class="ruler" '.$style.'></div>';
}
