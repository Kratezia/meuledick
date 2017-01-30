<?php
/**
	* layout.php
	
	* Created for the theme options layout controls.
	* Helps set value such as Skins, Site colors and header image.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1.2
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - December 18, 2012 - Fix issues with some hosts that
	* have allow_url_fopen turned off. Use the built-in WordPress
	* function wp_get_attachment_image_src in place of getimagesize
	* for external http requets.
	* Add option for logo resize.
	
	* 1.1.1 - Jan 11, 2012 - Error handling.
	* 1.1.2 - JAN 24, 2014 - Text changes + full Background image support.
*/

// Set Global Vars
global $sa_layout, $sa_layouts, $sa_layout_skins; 

// Store layouts views in array
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
	'use_full_background_image' => '0',
	'disable_sidebar_bg_tiling'=> '0',
	'upload_image0' => '',
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

// Store layouts views in array
$sa_layout_skins = array(
	'black' => array(
		'value' => 'black',
		'label' => 'Black Theme',
		'colors' => '#000000,#ede8d8,#161614,#efead9,#ffffff,#31302d'
	),
	'Casual' => array(
		'value' => 'casual',
		'label' => 'Casual Theme',
		'colors' => '#a02a0e,#ffffff,#ac2e10,#eae7db,#ffffff,#1f1003'
	),
	'breakfast' => array(
		'value' => 'breakfast',
		'label' => 'Breakfast Theme',
		'colors' => '#e68c19,#4a2512,#e99932,#efead9,#ffffff,#333333'
	),
	'coffee-house' => array(
		'value' => 'coffee-house',
		'label' => 'Coffee House Theme',
		'colors' => '#351710,#f5db96,#3d1e13,#efead9,#ffffff,#180a07'
	),
	'seafood' => array(
		'value' => 'seafood',
		'label' => 'Seafood Theme',
		'colors' => '#32a2b1,#f1f2ec,#41a8b6,#efead9,#ffffff,#454a4e'
	),
	'blank' => array(
		'value' => 'blank',
		'label' => 'Blank Theme',
		'colors' => '#ffffff,#5a3631,#e8e4cd,#f0ede2,#ffffff,#5a3631'
	),
);

// Store layouts views in array
$sa_layouts = array(
	'fluid' => array(
		'value' => 'fluid',
		'label' => __('Responsive / Fluid', 'eatery')
	),
	'semi-fluid' => array(
		'value' => 'semi-fluid',
		'label' => __('Disable Responsive / Semi-Fluid', 'eatery')
	),
	'fixed' => array(
		'value' => 'fixed',
		'label' => __('Disable Responsive / Fixed', 'eatery')
	),

);

/**
	* Function Save_theme_option

	* Saves or Creates passed in theme option name and value.
	* This will attempt to find an existing option to update
	* if no option is found it will create a new one.

	* @option_name (string) - Name of option
	* @newvalue (string) - Value of option
*/

function Save_theme_option($option_name, $newvalue){		 

	if ( get_option( $option_name ) != $newvalue ) {
		update_option( $option_name, $newvalue );
	} else {
		$deprecated = ' ';
		$autoload = 'no';
		add_option( $option_name, $newvalue, $deprecated, $autoload );
	}
}

/**
  * Function to fetch, modify and store a serialized options string 
  * Used for updating an individual key-value pair within a larger data set
  * 
  * $opt_group is the name if the option in the wp_options table
  * it contains serialized data representing an array of individual oprions relating
  * to an 'options-group of a theme framework
  */

function alt_update_option($opt_key,$opt_val,$opt_group){   
    // get options-data as it exists before update
    $options = get_option($opt_group);
    // update it
    $options[$opt_key] = $opt_val;
    // store updated data
    update_option($opt_group,$options);
}

/**
  * Function that uses a Built-in wordpress function to return an attachement height / width.
  * Used for resizing metrics.
  * 
  * $attachment_id is all that is needed.
  */

function return_img_attributes_by_id($attachment_id){
	$size = 'full';
	$image_attributes = wp_get_attachment_image_src( $attachment_id, $size); // returns an array
	return $image_attributes;
}

/**
  * Function that uses a database search to return an attachement ID
  * Used for resizing metrics.
  * 
  * $attachment_url is all that is needed.
  */
function pn_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

/**
	* Function theme_layout_options.

	* Create admin form for the layout theme controls. Skin, site colours and header image. 
	
*/

// Function to generate options page
function theme_layout_options() {
	
	global $sa_layout, $sa_layouts, $sa_layout_skins; 
	
	$image_attributes = "";

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'eatery' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'eatery' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php" name="themeOptions">

	<?php $settings = get_option( 'sa_layout', $sa_layout ); ?>
	
	<?php settings_fields( 'sa_theme_layout' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>
    
    <input type="hidden" name="sa_layout[header_default]" id="sa_layout[header_default]"  value="<?php  esc_attr_e($settings['header_default']); ?>" />
    <input type="hidden" name="sa_layout[header_default_sm]" id="sa_layout[header_default_sm]"  value="<?php  esc_attr_e($settings['header_default_sm']); ?>" />
    <input type="hidden" name="sa_layout[upload_image0-width]" id="sa_layout[upload_image0-width]"  value="<?php  esc_attr_e($settings['upload_image0-width']); ?>" />
    <input type="hidden" name="sa_layout[upload_image0-height]" id="sa_layout[upload_image0-height]"  value="<?php  esc_attr_e($settings['upload_image0-height']); ?>" />
    <input type="hidden" name="sa_layout[upload_image11-width]" id="sa_layout[upload_image11-width]"  value="<?php  esc_attr_e($settings['upload_image11-width']); ?>" />
    <input type="hidden" name="sa_layout[upload_image11-height]" id="sa_layout[upload_image11-height]"  value="<?php  esc_attr_e($settings['upload_image11-height']); ?>" />
    
    
    <?php
	
	// Our include file to create the background header image.
		require_once (THEME_ADMIN_FUNCTIONS .'/create_header_image.php' );
	
	/*
	Regular Logo | Check to see if it something new has been added and 
	see if it needs resizing, store image and save height and width.
	*/	
	
	if($settings['upload_image0'] > ""){
		
		// Create the string of where the image is stored
		$src = $settings['upload_image0'];
		$url = $src;
		
		//Grab Attachement ID if it's set.
		$attachment_id = $settings['upload_image_id_0'];
		
		// If Attachement ID is not set, then we will try and grab it another way.
		if ($attachment_id == ""){
			$attachment_id = pn_get_attachment_id_from_url($url);
		}
		
		$img_attributes = return_img_attributes_by_id($attachment_id);
		
		// Hopefully we were able to get $attachment_id, and now we have width and height. 
		// If not no resizing can happen.
		$width = $img_attributes[1]; // width
		$height = $img_attributes[2]; // height
		
		// If the uploaded file is larger than 260px, and the user has requested that the logo
		// be resized, resize it for them.
		if ($width > 260 && $settings["upload_image0_resize"]){
			
			//Get upload path
			$upload_dir = wp_upload_dir();
			$save_src_dir = $upload_dir['path'].'/';
			$save_src_url = $upload_dir['url'].'/';
					
			// Extract the file extension so we know what type of image file we are working with.
			$extension = strtolower(substr($src, strrpos($src, ".") + 1)); 
		
			// Choose a random number to keep file names short and unique.
			$filename = RandNumber(3);
			
			// Create new file name.
			$save_src_name = $filename.'-logo.'.$extension;
		
			// Resize image.
			Image($src, null, '260x', $save_src_name, $save_src_dir, $extension);
		
			// Remember file path and name.
			$src = $save_src_dir . $save_src_name;
			
			// Remember the URL
			$url = $save_src_url . $save_src_name;
			
			//get image information(size and dimensions)
			list($width, $height, $type, $attr) = getimagesize($src);
		}

		//get sa_layout options and add new values then update.
		$options = get_option('sa_layout');

		// Add new values
		$options['upload_image0'] = $url;
		$options['upload_image0-width'] = $width;
		$options['upload_image0-height'] = $height;
		$options['upload_image_id_0'] = "";
		
		// Update
		update_option('sa_layout', $options);

		// Save local settings for form.
		$settings['upload_image0'] = $url;
		$settings['upload_image0-width'] = $width;
		$settings['upload_image0-height'] = $height;
	}
	
	/*
	Retina Logo | Check to see if it something new has been added and 
	see if it needs resizing, store image and save height and width.
	Check size and only save if it is more than double the size of the
	low res logo
	*/	
	if($settings['upload_image11'] > ""){
		
		// Create the string of where the image is stored
		$src = $settings['upload_image11'];
		
		$url = $src;
		//Extract the file name
		
		
		//Grab Attachement ID if it's set.
		$attachment_id = $settings['upload_image_id_0'];
		
		// If Attachement ID is not set, then we will try and grab it another way.
		if ($attachment_id == ""){
			$attachment_id = pn_get_attachment_id_from_url($url);
		}
		
		$img_attributes = return_img_attributes_by_id($attachment_id);
		
		// Hopefully we were able to get $attachment_id, and now we have width and height. 
		// If not no resizing can happen.
		$width = $img_attributes[1]; // width
		$height = $img_attributes[2]; // height
		
		
		$lowresLogoWidth = $settings['upload_image0-width'];
		$minRetinaWidth = $lowresLogoWidth * 2;
		
		if ($width > $minRetinaWidth){
			
			//Get upload path
			$upload_dir = wp_upload_dir();
			$save_src_dir = $upload_dir['path'].'/';
			$save_src_url = $upload_dir['url'].'/';
					
			// Extract the file extension so we know what type of image file we are working with.
			$extension = strtolower(substr($src, strrpos($src, ".") + 1)); 
		
			// Choose a random number to keep file names short and unique.
			$filename = RandNumber(3);
			
			// Create new file name.
			$save_src_name = $filename.'-logo.'.$extension;
		
			// Resize image.
			Image($src, null, '520x', $save_src_name, $save_src_dir, $extension);
		
			// Remember file path and name.
			$src = $save_src_dir . $save_src_name;
			
			// Remember the URL
			$url = $save_src_url . $save_src_name;
			
			//get image information(size and dimensions)
			list($width, $height, $type, $attr) = getimagesize($src);
			
		}
		
		//get sa_layout options and add new values then update.
		$options = get_option('sa_layout');

		// Add new values
		$options['upload_image11'] = $url;
		$options['upload_image11-width'] = $width;
		$options['upload_image11-height'] = $height;
		
		// Update
		update_option('sa_layout', $options);

		// Save local settings for form.
		$settings['upload_image11'] = $url;
		$settings['upload_image11-width'] = $width;
		$settings['upload_image11-height'] = $height;
	}
	
	
	if ($settings["create_header"]){ // Start Created Header Switch
		$settings["create_header"] = 0; // RESET and save server resources
		$img_num = 8; //number of images to display. Take the first X number of images from the array
		$numbers = array(); // Create Array
		
		for ($i = 1; $i <= $img_num; $i++) {
			if ($settings["upload_image$i"] > ''){
				array_push($numbers, $settings["upload_image$i"]);
			}
		}
		
		if (!empty($numbers)) {
			
			$dest_w = 0;
			/* 
			Path to save temp header images as well as final header image.
			Use the main file uploads path set under Settings > Media > Uploading Files	
			WordPress adds a new folder each day and month of the year. You can trun this setting off
			under Settings > Media > Uploading Files > Uncheck 'Organize my uploads into month and year.
			*/
			$upload_dir = wp_upload_dir();
			$save_src_dir = $upload_dir['path'].'/';
			
			$i = 0;
			foreach ($numbers as $key => $val){
				$i++;
				// Create the string of where the image is stored
				$src = $val;
				
				if(preg_match("/\.(gif|png|jpg|jpeg)$/", $src)){ // validate file type
				
					//echo $src;
					// Extract the file extension so we know what type of image file we are working with.
					$extension = strtolower(substr($src, strrpos($src, ".") + 1)); 
					
					// Create new file name.
					$save_src_name = $i.'.'.$extension;
				
					// Resize image.
					$pass = Image($src, null, 'x340', $save_src_name, $save_src_dir, $extension);
				}else{
					$pass = false;
					$error_string = "Please use images with valid image extensions. E.G.: gif, png, jpg, jpeg";
					echo '<div id="message" class="error"><p>Image Error: ' . $error_string . '</p></div>';
				}
				
				if ($pass){
				
					// Remember file path and name.
					$src = $save_src_dir . $save_src_name;
					
					//get image information(size and dimensions)
					$size = getimagesize($src);
					
					if ($size) {
						//Create an image resource based on that jpeg
						$src_gds[$key]['img'] = imagegreatfromtype($extension,$src);
						
						$src_gds[$key]['w'] = $size[0];
						$src_gds[$key]['h'] = $size[1];
						$dest_w += $src_gds[$key]['w'];
						$hts[] = $src_gds[$key]['h'];
					} else {
						// error
						break;
					}
				
				}
				
			}
			
			
			if ($pass){
				$dest_h = max($hts);
			
				//create a new background template of the total size of the combined images
				$dest_gd = imagecreatetruecolor($dest_w, $dest_h);
			
				$dest_x = 0;
				foreach ($src_gds as $gd){
					imagecopymerge($dest_gd, $gd['img'], $dest_x, 0, 0, 0, $gd['w'], $gd['h'], 99);
					$dest_x += $gd['w'];
					imagedestroy($gd['img']);
				}
			
				/*
				Path to save the final header images as well as final header image.
				Use the main file uploads path set under Settings > Media > Uploading Files	
				but use baseURL not the month/day setting. Keeps this header-bg.jpg in an area that is predetermined.
				*/
			
				// Hardcoded file name.
				$save_file_name = 'header-bg.jpg';
				
				// Folder path + File Name
				$save_src_dir = $upload_dir['path'] . '/';
				$save_full_path_file = $save_src_dir . $save_file_name;
				
				// Image URL
				$save_src_url = $upload_dir['url']. '/';
				$save_full_url = $save_src_url . $save_file_name;
				
				// Create the new image
				$imagecreated = imagejpeg($dest_gd, $save_full_path_file, 100);
				
				// If it was created then generate a smaller version for our responsive theme
				// and save URL value in a theme option for use in our CSS.
				if($imagecreated){
					// Clean up	
					imagedestroy($dest_gd);
					
					// Save new header_BG_image value to hidden form field. 
					$option_name = 'sa_layout_header_BG_image' ;
					$newvalue = $save_full_url ;
				
					// Save sa_layout_header_BG_image to sa_layout option
					 
					alt_update_option($option_name, $newvalue, 'sa_layout');
					
					//Save_theme_option($option_name, $newvalue);
					
					
					
					
					// Resize image for Small Customer Header Version (Responsive Theme)
					$save_file_name = 'header-bg-sm.jpg';
					$extension = 'jpg';
					Image($save_full_path_file, null, 'x250', $save_file_name, $save_src_dir, $extension);
								
					// Save the URL to the small header option in our theme options.
					$option_name = 'sa_layout_header_BG_image_sm' ;
					$save_full_url = $save_src_url . $save_file_name;
					$newvalue = $save_full_url ;
					
					// Save sa_layout_header_BG_image to sa_layout option
					alt_update_option($option_name, $newvalue, 'sa_layout');
					
					//Save_theme_option($option_name, $newvalue);
					
					
					
				}else{
					$errMsg = "<div class='adminErrMsg2'><p>There was an error saving your header image. Before contacting the theme author please ensure that WordPress has created the /uploads folder and that the folder permissions are set correctly.<p><p>If you can upload an image using the Media Library then it's safe to assume that the /uploads folder has been created successfully and that there is unique server issue causing this error. At this point please contact the theme author for support.</p></div>";
					
				}	
			}
			
		}else{
			$errMsg = "<div class='adminErrMsg2'>Eatery tried to create a new header image but did not find anything specified for 'Image 1' under the 'Upload header images' area. Eatery will try to revert back to the default placeholder header for now.</div>";
			
			
				// Save new header_BG_image value to hidden form field. 
				$option_name = 'sa_layout_header_BG_image' ;
				$newvalue = '';
			
				// Save sa_layout_header_BG_image to sa_layout option
				alt_update_option($option_name, $newvalue, 'sa_layout');
				
				
				// Save the URL to the small header option in our theme options.
				$option_name = 'sa_layout_header_BG_image_sm' ;
				$newvalue = '';
				
				// Save sa_layout_header_BG_image to sa_layout option
				alt_update_option($option_name, $newvalue, 'sa_layout');
		}
	}
	
	
	?>
    
    <?php $settings = get_option( 'sa_layout', $sa_layout ); ?>
	
	<?php settings_fields( 'sa_theme_layout' ); ?>
    
    <input type="hidden" name="sa_layout[sa_layout_header_BG_image]" id="sa_layout[sa_layout_header_BG_image]"  value="<?php  esc_attr_e($settings['sa_layout_header_BG_image']); ?>" />
    <input type="hidden" name="sa_layout[sa_layout_header_BG_image_sm]" id="sa_layout[sa_layout_header_BG_image_sm]"  value="<?php  esc_attr_e($settings['sa_layout_header_BG_image_sm']); ?>" />
    
	<?php 
	if (isset($errMsg) && $errMsg > ''){
		echo $errMsg;
	}?>

<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
	
	<div class="theme-options-group">
	<table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Enable / Disable Responsive','eatery'); ?></b></th></tr></thead>
        <tbody><tr><th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Layout','eatery'); ?></p></th><td><p class="description"></p>
			<?php foreach( $sa_layouts as $layout ) : ?>
            <input type="radio" id="<?php echo $layout['value']; ?>" name="sa_layout[layout_view]" value="<?php esc_attr_e( $layout['value'] ); ?>" <?php checked( $settings['layout_view'], $layout['value'] ); ?> />
            <label for="<?php echo $layout['value']; ?>"><?php echo $layout['label']; ?></label><br />
            <?php endforeach; ?>
        </td></tr></tbody>
	</table>
    </div>
<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
    <div class="theme-options-group">
        <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Skin Selection','eatery'); ?></b></th></tr></thead>
        <tbody><tr><th scope="row"><div id="icon-themes" class="icon32"></div><p>6 <?php _e('Styles','eatery'); ?></p></th><td><p class="description"></p>
            <select id="sa_layout[skin_selection]" name="sa_layout[skin_selection]">
            <?php
            foreach ( $sa_layout_skins as $layout_skin ) :
                $label = $layout_skin['label'];
                $selected = '';
                if ( $layout_skin['value'] == $settings['skin_selection'] )
                    $selected = 'selected="selected"';
                echo '<option style="padding-right: 10px;" value="' . esc_attr( $layout_skin['value'] ) . '" ' . $selected . '>' . $label . '</option>';
            endforeach;
            ?>
            </select>
        </td></tr></tbody>
        </table>
       </div>
	<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

	<table cellspacing="0" class="widefat theme-options-table">
		<thead><tr><th scope="row" colspan="2"><b><?php _e('Custom Color Selection','eatery'); ?></b></th></tr></thead>        
        <tbody>
        	<tr>
            	<th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Choose your own','eatery'); ?></p></th>
            	<td><p class="description"></p>
        			<input type="checkbox" id="use_custom_colors" name="sa_layout[use_custom_colors]" value="1" <?php checked( true, $settings['use_custom_colors'] ); ?> />
        			<label for="use_custom_colors"><?php _e('Use custom colors (select below)','eatery'); ?></label></td></tr></tbody></table>        
   
	<hr />
    
    
    <div class="theme-options-group">
        <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Custom Color Field Populator','eatery'); ?></b></th></tr></thead>
        <tbody><tr><th scope="row"><div id="icon-themes" class="icon32"></div><p><?php _e('To help you get started. (Save after you select.)','eatery'); ?></p></th><td><p class="description"></p>
            
            <select id="layout_skin_color" name="sa_layout[layout_skin_color]" onchange="popCustomColors(this)">
            <?php
			if (!$settings['layout_skin_color'] > ""){
				echo "<option value='none' selected='selected'>Choose a color combo</option>";
			}else{
				echo "<option value='none'>None</option>";
			}
			foreach ( $sa_layout_skins as $layout_skin ) :
                $label = $layout_skin['label'];
                $selected = '';
                if ( $layout_skin['value'] == $settings['layout_skin_color'] )
                    $selected = 'selected="selected"';
                echo '<option style="padding-right: 10px;" value="' . esc_attr( $layout_skin['value'] ) . '" ' . $selected . '>' . $label . '</option>';
            endforeach;
            ?>
            </select>
            <label for="layout_skin_color"></label>
        </td></tr></tbody>
        </table>
       </div>
    <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
  <table cellspacing="0" class="widefat theme-options-table">
		<thead><tr><th scope="row" colspan="2"><b><?php _e('A background color for the sidebar.','eatery'); ?></b></th><th scope="row" colspan="2"><b><?php _e('A contrasting color for the sidebar','eatery'); ?></b></th></tr></thead>
       	<tbody>
        	<tr>
				<th scope="row"><p><?php _e('A good option for your primary company color.','eatery'); ?></p></th>
                <td><p class="description"></p>
                    <input name="sa_layout[colorPalette_dark]" id="sa_layout[colorPalette_dark]" type="text" size="10" value="<?php  echo ($settings['colorPalette_dark'] > '' ? esc_attr_e($settings['colorPalette_dark']) : "#"); ?>" /><div id="colorpicker1"></div>
                    <script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery('#colorpicker1').hide();
                        jQuery('#colorpicker1').farbtastic("#sa_layout\\[colorPalette_dark\\]");
                        jQuery("#sa_layout\\[colorPalette_dark\\]").click(function(){jQuery('#colorpicker1').slideToggle()});
                      });
                    </script></td>
	        
            <th scope="row"><p><?php _e('Choose a color that contrasts nicely with your select background color for the sidebar.','eatery'); ?></p></th>
                <td ><p class="description"></p>
                    <input name="sa_layout[colorPalette_mid1]" id="sa_layout[colorPalette_mid1]" type="text" size="10" value="<?php  echo ($settings['colorPalette_mid1'] > '' ? esc_attr_e($settings['colorPalette_mid1']) : "#"); ?>" /><div id="colorpicker2"></div>
                    <script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery('#colorpicker2').hide();
                        jQuery('#colorpicker2').farbtastic("#sa_layout\\[colorPalette_mid1\\]");
                        jQuery("#sa_layout\\[colorPalette_mid1\\]").click(function(){jQuery('#colorpicker2').slideToggle()});
                      });
					  
					  
                    </script></td></tr></tbody></table>
   		<hr />
        
	<table cellspacing="0" class="widefat theme-options-table">
		<thead><tr><th scope="row" colspan="2"><b>Tint</b></th><th scope="row" colspan="2"><b><?php _e('Website background','eatery'); ?></b></th></tr></thead>
       	<tbody>
        	<tr>
				<th scope="row"><p><?php _e('Select a slight tint of your sidebar background color. (Subtle for rulers and soft fills)','eatery'); ?></p></th>
                <td><p class="description"></p>
                    <input name="sa_layout[colorPalette_mid2]" id="sa_layout[colorPalette_mid2]" type="text" size="10" value="<?php  echo ($settings['colorPalette_mid2'] > '' ? esc_attr_e($settings['colorPalette_mid2']) : "#"); ?>" /><div id="colorpicker3"></div>
                    <script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery('#colorpicker3').hide();
                        jQuery('#colorpicker3').farbtastic("#sa_layout\\[colorPalette_mid2\\]");
                        jQuery("#sa_layout\\[colorPalette_mid2\\]").click(function(){jQuery('#colorpicker3').slideToggle()});
                      });
                    </script></td>
	        
            <th scope="row"><p><?php _e('Choose a colour for your website background. An off white works nicely.','eatery'); ?></p></th>
                <td><p class="description"></p>
                    <input name="sa_layout[colorPalette_offwhite]" id="sa_layout[colorPalette_offwhite]" type="text" size="10" value="<?php  echo ($settings['colorPalette_offwhite'] > '' ? esc_attr_e($settings['colorPalette_offwhite']) : "#"); ?>" /><div id="colorpicker5"></div>
                    <script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery('#colorpicker5').hide();
                        jQuery('#colorpicker5').farbtastic("#sa_layout\\[colorPalette_offwhite\\]");
                        jQuery("#sa_layout\\[colorPalette_offwhite\\]").click(function(){jQuery('#colorpicker5').slideToggle()});
                      });
                    </script></td></tr></tbody></table>
                    
            
   		<hr />                    
    
    
    <table cellspacing="0" class="widefat theme-options-table">
		<thead><tr><th scope="row" colspan="2"><b><?php _e('Page and content background color','eatery'); ?></b></th><th scope="row" colspan="2"><b><?php _e('Headings & text color','eatery'); ?></b></th></tr></thead>
       	<tbody>
        	<tr>
            <th scope="row"><p><?php _e('Choose something very light (bright white works well).','eatery'); ?></p></th>
                <td ><p class="description"></p>
                    <input name="sa_layout[colorPalette_brightwhite]" id="sa_layout[colorPalette_brightwhite]" type="text" size="10" value="<?php  echo ($settings['colorPalette_brightwhite'] > '' ? esc_attr_e($settings['colorPalette_brightwhite']) : "#"); ?>" /><div id="colorpicker6"></div>
                    <script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery('#colorpicker6').hide();
                        jQuery('#colorpicker6').farbtastic("#sa_layout\\[colorPalette_brightwhite\\]");
                        jQuery("#sa_layout\\[colorPalette_brightwhite\\]").click(function(){jQuery('#colorpicker6').slideToggle()});
                      });
                    </script></td>
                    
			<th scope="row"><p><?php _e('Choose a dark color for good contrast.','eatery'); ?></p></th>
                <td ><p class="description"></p>
                    <input name="sa_layout[colorPalette_light]" id="sa_layout[colorPalette_light]" type="text" size="10" value="<?php  echo ($settings['colorPalette_light'] > '' ? esc_attr_e($settings['colorPalette_light']) : "#"); ?>" /><div id="colorpicker4"></div>
                    <script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery('#colorpicker4').hide();
                        jQuery('#colorpicker4').farbtastic("#sa_layout\\[colorPalette_light\\]");
                        jQuery("#sa_layout\\[colorPalette_light\\]").click(function(){jQuery('#colorpicker4').slideToggle()});
                      });
                    </script></td></tr></tbody></table>                    
   		<hr />                    
 <script type="text/javascript">
	 function popCustomColors(color){ 
		switch(color.value)
		{
		<?php
		foreach ( $sa_layout_skins as $layout_skin ){
			echo "case '".$layout_skin['value']."':\n";
			$colorPalettes = explode(",",trim($sa_layout['colorPalette']));
			$colors = explode(",",trim($layout_skin['colors']));
			
			$icount = 0;
			foreach ( $colors as $color ){
				
				echo "themeOptions.elements[\"sa_layout[".$colorPalettes[$icount]."]\"].value = '".$color."';\n";
				echo "themeOptions.elements[\"sa_layout[".$colorPalettes[$icount]."]\"].style.backgroundColor = '".$color."';\n";
				$icount++;
			}
			echo "break;\n";
		}
		?>
		default:
		  <?php 
		  $colorPalettes = explode(",",trim($sa_layout['colorPalette']));
			$icount = 0;
		  foreach ( $colors as $color ){
				echo "themeOptions.elements[\"sa_layout[".$colorPalettes[$icount]."]\"].value = '#';\n";
				echo "themeOptions.elements[\"sa_layout[".$colorPalettes[$icount]."]\"].style.backgroundColor = '#FFFFFF';\n";
				$icount++;
			}
		  ?>
		}
	 }

     </script>


<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
    
    
        <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Logo','eatery'); ?></b></th></tr></thead>
    		<tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Logo','eatery'); ?></p></th><td><p class="description"></p><label for="logo">
                        <input id="sa_layout[upload_image0]" type="text" size="36" name="sa_layout[upload_image0]" value="<?php esc_attr_e( $settings['upload_image0'] ); ?>" />
                        <input id="upload_image_button0" type="button" value="Upload Image" />
                        <input id="sa_layout[upload_image_id_0]" name="sa_layout[upload_image_id_0]" type="hidden" value="<?php esc_attr_e( $settings['upload_image_id_0'] ); ?>" />
                        </label>
                        
                        </td></tr></tbody>
			<tbody><tr><th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Resize to fit on save','eatery'); ?></p></th><td><p class="description"></p>
         		<input type="checkbox" id="upload_image0_resize" name="sa_layout[upload_image0_resize]" value="1" />
        		<label for="author_credits"><?php _e('If your logo is larger than 260px, we will resize it to fit.','eatery'); ?></label>
        	</td></tr></tbody>
                    
		<?php
		$upload_image0_width = $settings['upload_image0-width'];
		$minRetinaWidth = $upload_image0_width * 2;
		$upload_image0_height = $settings['upload_image0-height'];
		$minRetinaHeight = $upload_image0_height * 2;
		
		$upload_image11_width = $settings['upload_image11-width'];
		$upload_image11_height = $settings['upload_image11-height'];
		
		?>
                        </table>
   

<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
    
        <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Header Image','eatery'); ?></b></th></tr></thead>
        
        <tbody><tr><th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Use header image:','eatery'); ?></p></th><td><p class="description"></p>
        	<input type="checkbox" id="use_header_BG_image" name="sa_layout[use_header_BG_image]" value="1" <?php checked( true, $settings['use_header_BG_image'] ); ?> />
        	<label for="use_header_BG_image"><?php _e('Yes, use a custom header image. (upload below)','eatery'); ?></label>
        </td></tr></tbody>
        
        
        
        </table>
       
       <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>  
       
        <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b><?php _e('Upload header images - up to','eatery'); ?> 8</b></th></tr></thead>
        
         <tbody><tr><th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Auto crop and sew on save','eatery'); ?></p></th><td><p class="description"></p>
         <input type="checkbox" id="create_header" name="sa_layout[create_header]" value="1" <?php //if($settings["create_header"]){echo " CHECKED";} ?> />
        	<label for="author_credits"><?php _e('Combine your header images below.','eatery'); ?></label>
        </td></tr></tbody>
        
        <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 1</p></th>
        	<td><p class="description">&nbsp;</p>
				<label for="upload_image 1">
                	<input id="sa_layout[upload_image1]" type="text" size="36" name="sa_layout[upload_image1]" value="<?php esc_attr_e( $settings['upload_image1'] ); ?>" />
                	<input id="upload_image_button1" type="button" value="Upload Image" />
                </label>
            </td></tr></tbody>
            
		<tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 2</p></th><td><p class="description">&nbsp;</p>
			<label for="upload_image 2">
                        <input id="sa_layout[upload_image2]" type="text" size="36" name="sa_layout[upload_image2]" value="<?php esc_attr_e( $settings['upload_image2'] ); ?>" />
                        <input id="upload_image_button2" type="button" value="Upload Image" />
                        </label></td></tr></tbody>
        
       <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 3</p></th><td><p class="description">&nbsp;</p>
        <label for="upload_image 3">
                        <input id="sa_layout[upload_image3]" type="text" size="36" name="sa_layout[upload_image3]" value="<?php esc_attr_e( $settings['upload_image3'] ); ?>" />
                        <input id="upload_image_button3" type="button" value="Upload Image" />
                        </label>
        </td></tr></tbody>
        
         <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 4</p></th><td><p class="description">&nbsp;</p>
        <label for="upload_image 4">
                        <input id="sa_layout[upload_image4]" type="text" size="36" name="sa_layout[upload_image4]" value="<?php esc_attr_e( $settings['upload_image4'] ); ?>" />
                        <input id="upload_image_button4" type="button" value="Upload Image" />
                        </label>
        </td></tr></tbody>
        
         <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 5</p></th><td><p class="description">&nbsp;</p>
        <label for="upload_image 5">
                        <input id="sa_layout[upload_image5]" type="text" size="36" name="sa_layout[upload_image5]" value="<?php esc_attr_e( $settings['upload_image5'] ); ?>" />
                        <input id="upload_image_button5" type="button" value="Upload Image" />
                        </label>
        </td></tr></tbody>
        
         <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 6</p></th><td><p class="description">&nbsp;</p>
        <label for="upload_image 6">
                        <input id="sa_layout[upload_image6]" type="text" size="36" name="sa_layout[upload_image6]" value="<?php esc_attr_e( $settings['upload_image6'] ); ?>" />
                        <input id="upload_image_button6" type="button" value="Upload Image" />
                        </label>
        </td></tr></tbody>
        
         <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 7</p></th><td><p class="description">&nbsp;</p>
        <label for="upload_image 7">
                        <input id="sa_layout[upload_image7]" type="text" size="36" name="sa_layout[upload_image7]" value="<?php esc_attr_e( $settings['upload_image7'] ); ?>" />
                        <input id="upload_image_button7" type="button" value="Upload Image" />
                        </label>
        </td></tr></tbody>
        
         <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Image','eatery'); ?> 8</p></th><td><p class="description">&nbsp;</p>
        <label for="upload_image 8">
                        <input id="sa_layout[upload_image8]" type="text" size="36" name="sa_layout[upload_image8]" value="<?php esc_attr_e( $settings['upload_image8'] ); ?>" />
                        <input id="upload_image_button8" type="button" value="Upload Image" />
                        </label>
        </td></tr></tbody>
        
        
        
        </table>
	
    

	<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
    
     <table cellspacing="0" class="widefat theme-options-table">
        <thead><tr><th scope="row" colspan="2"><b>Backgrounds</b></th></tr></thead>
    		<tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Background','eatery'); ?></p></th><td><p class="description"><?php _e('Enter a URL or upload a background here.','eatery'); ?></p><label for="bg-tile">
                        <input id="sa_layout[upload_image10]" type="text" size="36" name="sa_layout[upload_image10]" value="<?php esc_attr_e( $settings['upload_image10'] ); ?>" />
                        <input id="upload_image_button10" type="button" value="Upload Image" />
                        </label></td></tr></tbody>
            <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Disable Pattern Tiling ','eatery'); ?></p></th><td><p class="description"><?php _e('Check if using a Full Background Image vs Pattern.','eatery'); ?></p><label for="bg-tile">
                        <input type="checkbox" id="use_full_background_image" name="sa_layout[use_full_background_image]" value="1" <?php checked( true, $settings['use_full_background_image'] ); ?> />
        				<label for="use_full_background_image"><?php _e('Disable Tiling for best full image background results.','eatery'); ?></label></td></tr></tbody>            
    		<tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Sidebar Pattern','eatery'); ?></p></th><td><p class="description"><?php _e('Enter a URL or upload a sidebar pattern here.','eatery'); ?></p><label for="bg-tile">
                        <input id="sa_layout[upload_image11]" type="text" size="36" name="sa_layout[upload_image11]" value="<?php esc_attr_e( $settings['upload_image11'] ); ?>" />
                        <input id="upload_image_button11" type="button" value="Upload Image" />
                        </label></td></tr></tbody>
			 <tbody><tr><th scope="row"><div id="icon-upload" class="icon32"></div><p><?php _e('Disable Sidebar Pattern Tiling ','eatery'); ?></p></th><td><p class="description"><?php _e('Check to disable default sidebar background pattern.','eatery'); ?></p><label for="bg-tile">
                        <input type="checkbox" id="disable_sidebar_bg_tiling" name="sa_layout[disable_sidebar_bg_tiling]" value="1" <?php checked( true, $settings['disable_sidebar_bg_tiling'] ); ?> />
        				<label for="disable_sidebar_bg_texture"><?php _e('Disable.','eatery'); ?></label></td></tr></tbody>
                        </table>

	<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

	<table cellspacing="0" class="widefat theme-options-table">
		<thead><tr><th scope="row" colspan="2"><b><?php _e('Page Corners','eatery'); ?></b></th></tr></thead>        
        <tbody>
        	<tr>
            	<th scope="row"><div id="icon-options-general" class="icon32"></div><p><?php _e('Disable / Hide','eatery'); ?></p></th>
            	<td><p class="description"></p>
        			<input type="checkbox" id="hide_page_corners" name="sa_layout[hide_page_corners]" value="1" <?php checked( true, $settings['hide_page_corners'] ); ?> />
        			<label for="hide_page_corners"><?php _e('Hide Page Corner Styles','eatery'); ?></label></td></tr></tbody></table>   

	<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
                    
</form>
	<?php
}