<?php
/**
	* header_typoOpt.php
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - Jan 11, 2012 - Fixed missing P custom font styles.
*/

global $sa_typography;

$google_p_font = '';
$google_p  = '';
$google_p_fontfamily = '';

/* TYPOGRAPHY OPTIONS */
$typography_options = get_option('sa_typography',$sa_typography); 

$google_font_family_h1 = $typography_options['google_font_family_h1'];
$google_h1_font = $typography_options['google_h1_font'];
$google_h1 = $typography_options['google_h1'];
$google_h1_fontfamily = $typography_options['google_h1_fontfamily'];

$google_font_family_p = $typography_options['google_font_family_p'];

if(isset($typography_options['google_p_font'])){
	$google_p_font = $typography_options['google_p_font'];
}
if(isset($typography_options['google_p'])){
	$google_p = $typography_options['google_p'];
}

if(isset($typography_options['google_p_fontfamily'])){
	$google_p_fontfamily = $typography_options['google_p_fontfamily'];
}

$h1_size = $typography_options['h1_size'];
$h2_size = $typography_options['h2_size'];
$h3_size = $typography_options['h3_size'];
$h4_size = $typography_options['h4_size'];
$h5_size = $typography_options['h5_size'];
$h6_size = $typography_options['h6_size'];
$p_size = $typography_options['p_size'];

$custom_google_font = $typography_options['custom_google_font'];
$custom_google_font_css = $typography_options['custom_google_font_css'];


if ($google_font_family_h1 > ""){ // SET H1 Google Font if selected

echo "\n<!-- Custom Google H1 Font -->\n";
echo "<link href='http://fonts.googleapis.com/css?family=".$google_h1_font."' rel='stylesheet' type='text/css' />\n";
$google_h1_style = "h1, h2, h3, h4, h5, #sidebar-menu li a {font-family: '" . $google_h1 . "', ".$google_h1_fontfamily.";} "; // Inline CSS Override 
echo "<style type=\"text/css\">". $google_h1_style ."</style>\n";
}

if ($google_font_family_p > ""){ // SET P Google Font if selected

echo "\n<!-- Custom Google P Font -->\n";
echo "<link href='http://fonts.googleapis.com/css?family=".$google_p_font."' rel='stylesheet' type='text/css' />\n";	
$google_p_style = "body, p, li, #sidebar-menu li ul li a, .dropcap1, .dropcap2 {font-family: '" . $google_p . "', ".$google_p_fontfamily.";} "; // Inline CSS Override 
echo "<style type=\"text/css\">". $google_p_style ."</style>\n";
}

if ($custom_google_font > "" && $custom_google_font_css > ""){
echo "\n<!-- Custom Google Font -->\n";
echo "<link href='http://fonts.googleapis.com/css?family=".$custom_google_font."' rel='stylesheet' type='text/css'>\n";
echo "<style type=\"text/css\">\n".$custom_google_font_css."\n</style>\n";
echo "<!-- END Custom Google Font -->\n";
}


$arrayTextSizes = array(
    "h1" => $h1_size,
    "h2" => $h2_size,
    "h3"   => $h3_size,
	".dropcap1" => $h3_size,
	".dropcap2" => $h3_size,
    "h4"  => $h4_size,
	"h5"  => $h5_size,
	"h6"  => $h6_size,
	"p" => $p_size,
	"body" => $p_size
);

$themeHeadingSizes = "";
foreach ($arrayTextSizes as $k => $v) {
	if (strlen($v)>0){
		if($k == 'h1'){
			$k = 'h1, h1 .page-title ';
		}
		$themeHeadingSizes .= $k ."{font-size:$v !important ;}\n";
	}
}
if ($themeHeadingSizes > ""){
echo "\n<!-- Custom Heading Sizes -->\n";
echo "\n<style type=\"text/css\">\n". $themeHeadingSizes ."\n</style>";
echo "\n<!-- END Custom Heading Sizes -->\n";
}

?>