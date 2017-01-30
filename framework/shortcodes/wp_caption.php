<?php
add_filter( 'img_caption_shortcode', 'dap_responsive_img_caption_filter', 10, 3 );

function dap_responsive_img_caption_filter( $val, $attr, $content = null ) {
extract(shortcode_atts( array(
'id' => '',
'align' => '',
'width' => '',
'caption' => ''
),
$attr));

if ( 1 > (int) $width || empty($caption) )
return $val;

if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="max-width: 100% !important; height: auto; width: ' . (12 + (int) $width) . 'px">'
. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}