<?php

/**
	* typography.php
	
	* Several shortcodes to assist with Typography settings.
	* wc_dropcap - for drop caps
	* wc_highlight - content highlighting
	* wc_pullquote - pullquotes
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

/**
	* Function wc_dropcap.

	* displays dropcaps with several options
	* 2 drop cap style with bg fills or without.
*/

function wc_dropcap($atts, $content = null, $tag) {
	switch ($tag)
	{
	case 'dropcap1shade':
	  $tag = 'dropcap1 dropcap1shade';
	  break;
	case 'dropcap2':
	   $tag = 'dropcap2';
	  break;
	case 'dropcap2shade':
	   $tag = 'dropcap2 dropcap2shade';
	  break;
	default:
	  $tag = 'dropcap1';
	} 
	
	return '<span class="'.$tag.'">' . do_shortcode($content) . '</span>';
}

add_shortcode('dropcap1', 'wc_dropcap');
add_shortcode('dropcap1shade', 'wc_dropcap');
add_shortcode('dropcap2', 'wc_dropcap');
add_shortcode('dropcap2shade', 'wc_dropcap');


/**
	* Function wc_highlight.

	* content highligting.
*/

function wc_highlight($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => false,
	), $atts));
	
	if($style!== 'false'){
		switch ($style)
		{
		case 'dark':
		  $style = 'dark';
		  break;
		default:
		  $style = "";
		} 
	}
	
	return '<span class="highlight '.$style.'">'.do_shortcode($content).'</span>';
}

add_shortcode('highlight', 'wc_highlight');


function wc_icon($atts, $content = null) {
	extract(shortcode_atts(array(
		'graphic' => false,
		'skin' => '',
	), $atts));
	
	if($skin){
		$skin = ' '.$skin;
	}
	return '<span class="icon_text icon_'.$graphic.$skin.'">'.do_shortcode($content).'</span>';
}
add_shortcode('icon', 'wc_icon');

function wc_icon_link($atts, $content = null) {
	extract(shortcode_atts(array(
		'graphic' => false,
		'link' => '#',
		'skin' => '',
		'target' => false,
	), $atts));
	
	if($skin){
		$skin = ' '.$skin;
	}
	$target = $target?' target="'.$target.'"':'';
	
	return '<a href="'.$link.'"'.$target.' class="icon_text icon_'.$graphic.$skin.'" >'.do_shortcode($content).'</a>';
}
add_shortcode('icon_link', 'wc_icon_link');


/**
	* Function wc_pullquote.

	* Pullquote with several styles
	* alignblock, style, aligntext, cite.
*/
function wc_pullquote( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alignblock' => 'left',
		'style' => 'style01',
		'aligntext' => 'left',
		'cite' => ''
	), $atts ) );
	
	
	$alignblock = 'alignblock'.$alignblock;
	$aligntext = 'aligntext'.$aligntext;
	return '<blockquote class="'.$alignblock.' '.$style.' '.$aligntext.'"><span>'. do_shortcode($content) .'<cite>'.$cite.'</cite></span></blockquote>';	
}
add_shortcode( 'pullquote', 'wc_pullquote' );

