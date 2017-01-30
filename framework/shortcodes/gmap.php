<?php
/**
	* gmap.php
	
	* Shortcode to display a google map
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.1
	* @link       http://www.themovation.com/eatery
	
	* 1.1 - Jan 11, 2013 - Fixed issue with zoom controls.
	* Always default to +/-.
	
*/

/**
	* wc_gmap
	
	* Displays a google map takes width, height, zoom level, lat, lng, or address, 
	
	* Sample shortcode [customPost type=movies,books limit=5]

*/

add_shortcode('map', 'wc_gmap');

function wc_gmap($params){

    if(isset($params['width'])){
		if($params['width']){
			$width = $params['width'];
		}else{
			$width = '100%';
		}
	}else{
			$width = '100%';
	}
	
	if(isset($params['height'])){
		if($params['height']){
			$height = $params['height'];
		}else{
			$height = '400px';
		}
	}else{
			$height = '400px';
		}
	
	if(isset($params['zoom'])){	
		if($params['zoom']){
			$zoom = $params['zoom'];
		}else{
			$zoom = 18;
		}
	}else{
			$zoom = 18;
		}
		
	if(isset($params['lat']) && isset($params['lng'])){	
		if ($params['lat'] && $params['lng']) {
			$lat = $params['lat'];
			$lng = $params['lng'];
			$addr = null;
		} elseif (isset($params['addr']) && $params['addr']) {
			$lat  = null;
			$lng  = null;
			$addr = html_entity_decode($params['addr'], ENT_QUOTES, 'UTF-8');
		}
	}else   {
			$lat  = null;
			$lng  = null;
			$addr = html_entity_decode($params['addr'], ENT_QUOTES, 'UTF-8');
		}

	// GET Google MAP API KEY
	$general_options = get_option('sa_general',$sa_general);
	$map_api_key_setting = $general_options['map_api_key'];

	if (isset($map_api_key_setting) && $map_api_key_setting > ""){
		$map_api_key = '&key='.esc_attr($map_api_key_setting);
	}else{
		$map_api_key = '&key=AIzaSyAbqTh4gqGG1SHnJFkwZmD5PE90-cbmv9Y';
	}

	//print_r($general_options);

	//echo "HELLO: ". $map_api_key.

$html = "<div id=\"gmap\" style=\"width:{$width};height:{$height};\"></div>\n";
$html .= "<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false$map_api_key\"></script>\n";
$html .= "<script type=\"text/javascript\">\n";
$html .= "var dragFlag = false;\n";
$html .= "var start = 0, end = 0;\n";

$html .= "function thisTouchStart(e)\n";
$html .= "{\n";
$html .=  "  dragFlag = true;\n";
$html .=  "   start = e.touches[0].pageY;\n";
$html .= "}\n";

$html .= "function thisTouchEnd()\n";
$html .= "{\n";
$html .=  "   dragFlag = false;\n";
$html .= "}\n";

$html .= "function thisTouchMove(e)\n";
$html .= "{\n";
$html .=  "   if ( !dragFlag ) return;\n";
$html .=  "   end = e.touches[0].pageY;\n";
$html .=  "   window.scrollBy( 0,( start - end ) );\n";
$html .= "}\n";

$html .= "if(document.getElementById(\"gmap\").addEventListener){\n";
$html .= "document.getElementById(\"gmap\").addEventListener(\"touchstart\", thisTouchStart, true);\n";
$html .= "document.getElementById(\"gmap\").addEventListener(\"touchend\", thisTouchEnd, true);\n";
$html .= "document.getElementById(\"gmap\").addEventListener(\"touchmove\", thisTouchMove, true);\n";
$html .= "}else{\n";
$html .= "document.getElementById(\"gmap\").attachEvent(\"touchstart\",thisTouchStart);\n";
$html .= "document.getElementById(\"gmap\").attachEvent(\"touchend\",thisTouchEnd);\n";
$html .= "document.getElementById(\"gmap\").attachEvent(\"touchmove\",thisTouchMove);\n";
$html .= "}\n";


$html .= "function display(pos) {\n";
$html .=  "   var myOptions = {\n";
$html .=  "      mapTypeControl: false,\n";
$html .=  "       zoom: {$zoom},\n";
$html .=  "      center: pos,\n";
$html .=  "       streetViewControl: false,\n";
$html .=  "       scrollwheel: false,\n";
$html .=  "       scaleControl: false,\n";
$html .=  "       zoomControl: true,\n";
$html .=  "       zoomControlOptions: {\n";
$html .=  "         style:google.maps.ZoomControlStyle.SMALL \n";
$html .=  "         },\n";
$html .=  "	draggable: false,\n";
$html .=  "       mapTypeId: google.maps.MapTypeId.ROADMAP\n";
$html .=  "   };\n";
$html .=  "   var map = new google.maps.Map(\n";
$html .=  "       document.getElementById(\"gmap\"),\n";
$html .=  "       myOptions\n";
$html .=  "   );\n";
$html .=  "   var marker = new google.maps.Marker({\n";
$html .=  "       position: pos,\n";
$html .=  "       map: map\n";
$html .=  "   });\n";
$html .=  "	//click listener on layer\n";
$html .= "	google.maps.event.addListener(map, 'click', function(e) {\n";
$html .= "		map.setOptions({draggable: true});\n";
$html .= "	});\n";
$html .= "	}";
if ($addr){
	$html .= " function address2map(res, stat) {\n";
	$html .=  "   if (stat != google.maps.GeocoderStatus.OK) {\n";
	$html .=   "      return;\n";
	$html .=    " }\n";
	$html .=    " var pos = res[0].geometry.location;\n";
	$html .=    " if (pos.lat()) {\n";
	$html .=    "     display(pos);\n";
	$html .=    " }\n";
	$html .= "}\n";
	$html .= "var addr = '{$addr}';\n";
	$html .= "var geo = new google.maps.Geocoder();\n";
	$html .= " geo.geocode({'address': addr}, address2map);\n";
} elseif ($lat && $lng) {
	$html .= " var pos = new google.maps.LatLng('{$lat}', '{$lng}');\n";
	$html .= " display(pos);\n";
}
$html .= "</script>\n";

return $html;
}

