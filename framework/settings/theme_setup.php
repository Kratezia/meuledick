<?php

add_action( 'after_setup_theme', 'the_theme_setup' );
function the_theme_setup()
{
        // First we check to see if our default theme settings have been applied.
        $the_theme_status = get_option( 'e_theme_setup_status' );
        // If the theme has not yet been used we want to run our default settings.
        if ( $the_theme_status !== '1' ) {
                // Setup Default WordPress settings
                global $sa_layout, $sa_general, $sa_typography, $sa_social_media;
				
				$sa_general = array(
					'footer_copyright' => '',				
					'google_analytics' => '',
					'custom_css'=> '',
					'custom_email'=> '',
					'map_api_key'=> '',
					'use_timthumb'=> false,
					'currency_symbol'=> '$',
					'currency_symbol_align_right'=>0,
					'reso_24_hour_clock'=>'',
				);
				
				$sa_layout = array(
					'layout_view' => 'fluid',
					'skin_selection' => 'black',
					'website_BG_color' => '',
					'sidebar_BG_color' => '',
					'sidebar_text_color' => '',
					'sidebar_text_link_color' => '',
					'sidebar_divider_color' => '',
					'content_BG_color' => '',
					'content_divider_color' => '',
					'nav_BG_color' => '',
					'nav_button_hover' => '',
					'nav_button_current' => '',
					'nav_sub_bg' => '',
					'nav_text_color' => '',
					'sidebar_text_link_hover_color' => '',
					'use_custom_colors' => false,
					'header_BG_image' => '',
					'use_header_BG_image' => true,
					'colorPalette_dark' => '',
					'colorPalette_mid1' => '',
					'colorPalette_mid2' => '',
					'colorPalette_light' => '',
					'colorPalette_offwhite' => '',
					'colorPalette_brightwhite' => '',
					'colorPalette' => 'colorPalette_dark,colorPalette_mid1,colorPalette_mid2,colorPalette_offwhite,colorPalette_brightwhite,colorPalette_light',
					'use_skin_header_BG_image'  => false,
					'header_default' => 'header_placeholder.png',
					'header_default_sm' => 'header_placeholder_sm.png',
					'sa_layout_header_BG_image' => '',
					'sa_layout_header_BG_image_sm' => '',
					'hide_page_corners' => '0',
					'upload_image10' => '',
					'upload_image11' => '',
					'layout_skin_color' => '',
					'upload_image0' => '',
					'upload_image0-width' => '',
					'upload_image0-height' => '',
					'upload_image11-width' => '',
					'upload_image11-height' => '',
					'create_header' => '',
					'upload_image1' => '',
					'upload_image2' => '',
					'upload_image3' => '',
					'upload_image4' => '',
					'upload_image5' => '',
					'upload_image6' => '',
					'upload_image7' => '',
					'upload_image8' => '',
					'upload_image_id_0' => '',
                );
				
				$sa_social_media = array(
					'soc_facebook' => 'https://facebook.com/themovation',
					'soc_twitter' => 'http://twitter.com/themovation',
					'soc_googleplus' => '',
					'soc_linkedin' => '',
					'soc_tumblr' => '',
					'soc_googlemaps' => '',
					'soc_foursquare' => '',
					'soc_instagram' => '',
					'soc_youtube' => '',
					'soc_vimeo' => '',
					'soc_yelp' => '',
					'soc_urbanspoon' => '',
					'soc_tripadvisor' => '',
					'soc_meetup' => '',
					'soc_rss' => '',
					'soc_pinterest' => '',
					'soc_email' => '',
					'soc_phone' => '',
					'soc_use_custom_color' => false,
					'soc_icon_color' => 'soc_5.png'
				);
				
				$sa_typography = array(
					'google_font_family_h1' => 'Arvo | Georgia, Times, serif',
					'google_font_family_p' => 'PT+Sans | Helvetica, Arial, sans-serif',
					'google_h1_font' => '',
					'google_h1' => '',
					'google_h1_fontfamily' => '',
					'google_p_font' => '',
					'google_p' => '',
					'google_p_fontfamily' => '',
					'h1_size' => '',
					'h2_size' => '',
					'h3_size' => '',
					'h4_size' => '',
					'h5_size' => '',
					'h6_size' => '',
					'p_size' => '',
					'custom_google_font' => '',
					'custom_google_font_css' => '',
					'google_p_font' => '',
					'h1_sample'  => '',
					'p_sample' => ''
					
					  
				);
				

                      update_option( 'sa_general', $sa_general );
					  update_option( 'sa_layout', $sa_layout );
					  update_option( 'sa_social_media', $sa_social_media );
					  update_option( 'sa_typography', $sa_typography );
					  
                // Once done, we register our setting to make sure we don't duplicate everytime we activate.
                update_option( 'e_theme_setup_status', '1' );
                // Lets let the admin know whats going on.
                $msg = '
                <div class="error">
                        <p>' . get_option( 'current_theme' ) . ' has updated a few settings under <a href="' . admin_url() . 'options-general.php" title="See Settings">Themes Options</a> to get you started. See help file for a guide on how to get started.</p>
                </div>';
                add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
        }
        // Else if we are re-activing the theme
        elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {
                $msg = '
                <div class="updated">
                        <p>The ' . get_option( 'current_theme' ) . ' theme was successfully re-activated.</p>
                </div>';
                add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
        }
}