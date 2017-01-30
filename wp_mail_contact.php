<?php
/**
	* wp_mail.php
	
	* Send email using the wp_mail function
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	* 1.1 - Dec 18 - Support for 24 hour clock option.
*/

if (isset($_POST['send'])) {


$formname = $_POST['formname'];
$formemail = $_POST['formemail'];
if(($formemail > "") && (strtolower($formemail) !== 'email')){
}else{
	$formemail = __('(Email not provided)','eatery');
}

$formphone = $_POST['formphone'];
if(($formphone > "") && (strtolower($formphone) !== 'phone')){
}else{
	$formphone = __('(Phone not provided)','eatery');
}

$formcomments = $_POST['formcomments'];



// Get Global Vars for Autoresponder
$sitename = get_bloginfo('name');
$general_options = get_option('sa_general',$sa_general); 
$layout_options = get_option('sa_layout',$sa_layout); 

$emailto = $general_options['custom_email'];

if (empty($emailto)){
	$emailto = get_bloginfo('admin_email');
}

$logo = $layout_options['upload_image0']; // get logo.
if ($logo == '') { //If there is a custom logo, display it.
	$logo = '<h1>'.$sitename.'</h1>';
}else{
	$logo = "<img src='".$logo."' id='' alt='$sitename' />";
}
$site_url = home_url();


$emailheader = "<a href='$site_url'>".$logo."</a>";

$to = $emailto;
$sub = __('A new message from ','eatery'). $sitename;

$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   
        <title>'.$sub.'</title>
		<style type="text/css">
			
			#outlook a{padding:0;} 
			body{width:100% !important;} 
			body{-webkit-text-size-adjust:none;} 

			/* Reset Styles */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

			body, #backgroundTable{
				background-color:#FAFAFA;
			}

			
			#templateContainer{
				border: 1px solid #DDDDDD;
			}

			
			h1, .h1{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:34px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			
			h2, .h2{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:30px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			
			h3, .h3{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:26px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			
			h4, .h4{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:22px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				 text-align:left;
			}

			

			
			#templatePreheader{
				 background-color:#FAFAFA;
			}

			
			.preheaderContent div{
				 color:#505050;
				 font-family:Arial;
				 font-size:10px;
				 line-height:100%;
				 text-align:left;
			}

			
			.preheaderContent div a:link, .preheaderContent div a:visited, /* Yahoo! Mail Override */ .preheaderContent div a .yshortcuts /* Yahoo! Mail Override */{
				 color:#336699;
				 font-weight:normal;
				 text-decoration:underline;
			}

			

			
			#templateHeader{
				 background-color:#FFFFFF;
				 border-bottom:0;
			}

			
			.headerContent{
				 color:#202020;
				 font-family:Arial;
				 font-size:34px;
				 font-weight:bold;
				 line-height:100%;
				 padding:0;
				 text-align:center;
				 vertical-align:middle;
			}

			
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				 color:#336699;
				 font-weight:normal;
				 text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:600px !important;
			}

			
			#templateContainer, .bodyContent{
				 background-color:#FFFFFF;
			}

			
			.bodyContent div{
				 color:#505050;
				 font-family:Arial;
				 font-size:14px;
				 line-height:150%;
				 text-align:left;
			}

			
			.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
				 color:#336699;
				 font-weight:normal;
				 text-decoration:underline;
			}

			.bodyContent img{
				display:inline;
				height:auto;
			}

			
			#templateFooter{
				 background-color:#FFFFFF;
				 border-top:0;
			}

			
			.footerContent div{
				 color:#707070;
				 font-family:Arial;
				 font-size:12px;
				 line-height:125%;
				 text-align:left;
			}

			
			.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
				 color:#336699;
				 font-weight:normal;
				 text-decoration:underline;
			}

			.footerContent img{
				display:inline;
			}

			
	

			
			
		</style>
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
            	<tr>
                	<td align="center" valign="top">
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
                        	<tr>
                            	<td align="center" valign="top">
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
                                        <tr>
                                            <td class="headerContent">
												' . $emailheader . '
                                            </td>
                                        </tr>
                                    </table>
                                   
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                   
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                    	<tr>
                                            <td valign="top" class="bodyContent">
                                
                                               
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div mc:edit="std_content00">
                                                                <h1 class="h1">'.$sub.'</h1>
																'. __('You have received a new message from: ','eatery').' <strong>'.$formname.'</strong>. '. __('<BR />Email:','eatery').' <strong>'.$formemail.'</strong> '. __('<BR />Phone: ','eatery').' <strong>'.$formphone.'</strong>
																<br /><br /><strong>'. __('Comments','eatery').':</strong> '.$formcomments.'
                                                            </div>
														</td>
                                                    </tr>
                                                </table>
                                               
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<table border="0" cellpadding="10" cellspacing="0" width="600" id="templateFooter">
                                    	<tr>
                                        	<td valign="top" class="footerContent">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>';

if ($formemail > ""){
	$email_from = filter_var($formemail, FILTER_SANITIZE_EMAIL);
}else{
	$email_from = $emailto;
}

if ($formname > ""){
	$email_from_name = filter_var($formname, FILTER_SANITIZE_STRING);
}else{
	$email_from_name = $sitename;
}

/*$headers = array("From: ".$email_from_name." <".$email_from.">",
	         "Content-Type: text/html"
	         );*/
$headers[] = "From: ".$email_from_name." <".$email_from.">";
//$headers[] = "Cc: ".$email_from_name." <".$email_from.">";
$headers[] = 'Content-Type: text/html';

$h = implode("\r\n",$headers) . "\r\n";

$mailProblems = wp_mail($to, $sub, $msg, $h);


}