<?php
/**
	* columns.php
	
	* Shortcode for column layouts
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/


/**
	* wc_column & wc_column_last

	* A very common way to produce several different column layouts.
	* one_half, one_half_last etc...

*/

function wc_column($atts, $content = null, $tag) {
	return '<div class="'.$tag.'">' . do_shortcode(trim($content)) . '</div>';
}
function wc_column_last($atts, $content = null, $tag) {
	return '<div class="'.str_replace('_last','',$tag).' last">' . do_shortcode(trim($content)) . '</div><div class="clearboth"></div>';
}

add_shortcode('one_half', 'wc_column');
add_shortcode('one_third', 'wc_column');
add_shortcode('one_fourth', 'wc_column');
add_shortcode('one_fifth', 'wc_column');


add_shortcode('two_third', 'wc_column');
add_shortcode('three_fourth', 'wc_column');
add_shortcode('two_fifth', 'wc_column');
add_shortcode('three_fifth', 'wc_column');
add_shortcode('four_fifth', 'wc_column');


add_shortcode('one_half_last', 'wc_column_last');
add_shortcode('one_third_last', 'wc_column_last');
add_shortcode('one_fourth_last', 'wc_column_last');
add_shortcode('one_fifth_last', 'wc_column_last');


add_shortcode('two_third_last', 'wc_column_last');
add_shortcode('three_fourth_last', 'wc_column_last');
add_shortcode('two_fifth_last', 'wc_column_last');
add_shortcode('three_fifth_last', 'wc_column_last');
add_shortcode('four_fifth_last', 'wc_column_last');



