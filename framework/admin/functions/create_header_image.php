<?php

/**
	* create_header_image.php
	
	* created to prepare individual images (resize, crop, rename) before 
	* they are sewed together as one large header image.
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.2.1
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - November 27, 2012 - Very minor code change to resolve issues
	* reported by some users Line: 37
	
	* 1.2 - December 18, 2012 - Use wp_remote_get to fetch remote files.
	
	* 1.2.1 - Jan 11, 2012 - Error handling.
*/


/**
	* Function Image.

	* Resizes and prepares each individual header image so they are ready 
	* to be sewed together.

	* @image (string) - Full path to an image. EG: http://www.myweb.com/image.jpg
	* @crop (bol) - True or False. CROP (Aspect Ratio)
	* @size (string) - Finished size of image. WxH EG: x352 or 352x352 or 352x
	* @save_src_name (string) - Finished image name and extension
	* @save_src_dir  (string) - Finished image path (should be writable by server).
	* @extension (string) - Image type / extension
*/
 
function Image($image, $crop = null, $size = null, $save_src_name, $save_src_dir, $extension) {


	if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
	{
		$isURL = false;
	}else{
		$isURL = true;
	}

	// If this is a URL, use the built-in WordPres Function to fetch remove file.
	if ($isURL){
  		$image = create_image_from_url($image);
	}else{
		$image = file_get_contents($image);
		
		if ($image){
			$image = ImageCreateFromString($image);
		}else{
			// Error
			$image = false;
			$error_string = "Not a valid image type.";
			echo '<div id="message" class="error"><p>Image Error: ' . $error_string . '</p></div>';
		}
		
	}
	

    if (is_resource($image) === true) {
        $x = 0;
        $y = 0;
        $width = imagesx($image);
        $height = imagesy($image);

        /* CROP (Aspect Ratio) Section */

        if (is_null($crop) === true) {
            $crop = array($width, $height);
        } else {
            $crop = array_filter(explode(':', $crop));

            if (empty($crop) === true) {
                    $crop = array($width, $height);
            } else {
                if ((empty($crop[0]) === true) || (is_numeric($crop[0]) === false)) {
                        $crop[0] = $crop[1];
                } else if ((empty($crop[1]) === true) || (is_numeric($crop[1]) === false)) {
                        $crop[1] = $crop[0];
                }
            }

            $ratio = array(0 => $width / $height, 1 => $crop[0] / $crop[1]);

            if ($ratio[0] > $ratio[1]) {
                $width = $height * $ratio[1];
                $x = (imagesx($image) - $width) / 2;
            }

            else if ($ratio[0] < $ratio[1]) {
                $height = $width / $ratio[1];
                $y = (imagesy($image) - $height) / 2;
            }

        }

        /* Resize Section */

        if (is_null($size) === true) {
            $size = array($width, $height);
        }

        else {
            $size = array_filter(explode('x', $size));

            if (empty($size) === true) {
                    $size = array(imagesx($image), imagesy($image));
            } else {
                if ((empty($size[0]) === true) || (is_numeric($size[0]) === false)) {
                        $size[0] = round($size[1] * $width / $height);
                } else if ((empty($size[1]) === true) || (is_numeric($size[1]) === false)) {
                        $size[1] = round($size[0] * $height / $width);
                }
            }
        }

       $result = ImageCreateTrueColor($size[0], $size[1]);

        if (is_resource($result) === true) {
            ImageAlphaBlending($result, false);
			ImageSaveAlpha($result, true);
            ImageFill($result, 0, 0, ImageColorAllocate($result, 255, 255, 255));
            ImageCopyResampled($result, $image, 0, 0, $x, $y, $size[0], $size[1], $width, $height);

            ImageInterlace($result, true);
            //ImageJPEG($result, null, 90);
			
			$quality = 90;
			//saveimagefromtype($extension, $result, $save_src_dir, $save_src_name, $quality);
			
			switch ($extension)
				{
				case 'jpg':
					ImageJPEG($result, $save_src_dir.$save_src_name, 100);
				break;
				case 'jpeg':
					ImageJPEG($result, $save_src_dir.$save_src_name, 100);
				break;
				case 'png':
					ImagePNG($result, $save_src_dir.$save_src_name, 6);
				break;
				case 'gif':
					ImageGIF($result, $save_src_dir.$save_src_name);
				break;
				default:
				die("Image is of unsupported type.");
				} 
	
			//ImageJPEG($result, $save_src_dir.$save_src_name, 90);
			
        }
		
    }else{
		return false;
		break;
	}
	return true;
}


/**
	* Function imagegreatfromtype

	* Creates an image resource based on the original image type eg: gif, jpeg, png

	* @image (string) - Full path to an image. EG: http://www.myweb.com/image.jpg
	* @extension (string) - Image type / extension
*/


// Load image from file
function imagegreatfromtype($extension, $image)
{
	switch ($extension)
	{
	case 'jpg':
	$background = imagecreatefromjpeg($image);
	break;
	case 'jpeg':
	$background = imagecreatefromjpeg($image);
	break;
	case 'png':
	$background = imagecreatefrompng($image);
	break;
	case 'gif':
	$background = imagecreatefromgif($image);
	break;
	default:
	die("Image is of unsupported type.");
	} 
	return $background;
}

function create_image_from_url($url) {

		$error_string = false;
		
		$rsp = wp_remote_get($url);
		
		if (is_wp_error($rsp)){
			$error_string = $rsp->get_error_message();
			echo '<div id="message" class="error"><p>Upload header image error. WordPress says: ' . $error_string . '</p></div>';
			
		}

		if ( (wp_remote_retrieve_response_code($rsp) != 200) && ( wp_remote_retrieve_response_code($rsp) != "" )){
			$error_string = wp_remote_retrieve_response_code($rsp);
			echo '<div id="message" class="error"><p>Upload header image error. Raw http response code : ' . $error_string . '</p></div>';
			
		}
		
		if ($error_string > ""){
			//return false;
			echo '<div id="message" class="updated fade"><p>It looks like your web host is preventing this theme from using the <a href="http://codex.wordpress.org/Function_API/wp_remote_get" target+"_blank">wp_remote_get</a> function. This is usually due to a firewall rule or overzealous security settings. We are trying a work around...</p></div>';
			
			// Convert URL into relative file path.
			$local_path_to_file = wp_make_link_relative($url);
			
			// Get WordPress install path.
			$wordpress_root_path = ABSPATH;
			
			// Combine into full local file path.
			$full_path = $wordpress_root_path . $local_path_to_file;
			
			// Retrieve the file using a full local path.
			$image = file_get_contents($full_path);
			
			if ($image){
				echo '<div id="message" class="updated fade"><p>Success!</p></div>';
				return imagecreatefromstring($image);
			}else{
				// Error
				$image = false;
				$error_string = "Sorry, or work around failed. Please contact your web host with the error message above and see if they can help you revolve this hosting issue.";
				echo '<div id="message" class="error"><p>Image Error: ' . $error_string . '</p></div>';
				return false;
			}
		}else{
			$img_data = wp_remote_retrieve_body($rsp);
			return imagecreatefromstring($img_data);
		}
	}

