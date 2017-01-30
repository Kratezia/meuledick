/*
Theme Name: Eatery 
Theme URI: http://www.themovation.com/eatery
Description: Eatery - Restaurant, Cafe, Eatery Theme.  
Author: Themovation
Author URI: http://www.themovation.com
Version: 1.1
Tags: Restaurant, Eatery, Cafe, Fancy, Casual, Breakfast, Seafood, Responsive, Mobile, Black, White, Brown, Yellow, Blue

License: GNU GENERAL PUBLIC LICENSE Version 2
License URI: http://www.themovation.com/eatery/license


jQuery for WordPress Admin Theme Options specifically the file uploads.

* 1.1 - December 18, 2012 - Attempt to return the attachment ID
* for the logo upload. Send it back to layout.php

*/

jQuery(document).ready(function() {

var selnumber;

// Upload for Custom Site Logo
jQuery('#upload_image_button0').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image0\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 0;
 return false;
});

// Background Header Image #1
jQuery('#upload_image_button1').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image1\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 1;
 return false;
});

// Background Header Image #2
jQuery('#upload_image_button2').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image2\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 2;
 return false;
});

// Background Header Image #3
jQuery('#upload_image_button3').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image3\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 3;
 return false;
});

// Background Header Image #4
jQuery('#upload_image_button4').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image4\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 4;
 return false;
});

// Background Header Image #5
jQuery('#upload_image_button5').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image5\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 5;
 return false;
});

// Background Header Image #6
jQuery('#upload_image_button6').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image6\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 6;
 return false;
});

// Background Header Image #7
jQuery('#upload_image_button7').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image7\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 7;
 return false;
});

// Background Header Image #8
jQuery('#upload_image_button8').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image8\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 8;
 return false;
});


// Divider Icon #9
jQuery('#upload_image_button9').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image9\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 9;
 return false;
});

// Divider Icon #10
jQuery('#upload_image_button10').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image10\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 10;
 return false;
});

// Divider Icon #11
jQuery('#upload_image_button11').click(function() {
 formfield = jQuery('#sa_layout\\[upload_image11\\]').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 selnumber = 11;
 return false;
});

/* 
When user clicks 'insert into post', this return that
image path to the form field. 
*/
window.send_to_editor = function(html) {
	// Try and grab the Attachement ID if we are uploading a logo.
	if (selnumber == 0){
		var attachment_id = 0;
		var classes = jQuery('img',html).attr('class').match(/wp\-image\-([0-9]+)/); // regex to "hijack" the class name (which is the ID)
		if ( classes[1] ){
			attachment_id = classes[1];
			imgurl = jQuery('img',html).attr('src');
			jQuery('#sa_layout\\[upload_image_id_'+selnumber+'\\]').val(attachment_id); // assign att id.
		}
	}
		   
 imgurl = jQuery('img',html).attr('src');
jQuery('#sa_layout\\[upload_image'+selnumber+'\\]').val(imgurl);
 tb_remove();
}


});