<?php
/**
	* tabs.php
	
	* Shortcode for tab style content containers
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

/**
	* tab_wrap
	
	* Groups content into tab groups.

*/

add_action( 'wp_enqueue_scripts' , 'register_tabcontent_scrtips' );
add_shortcode( 'tabwrap', 'tab_wrap' );

function register_tabcontent_scrtips() {
	wp_register_script('tabcontent', get_template_directory_uri() . '/js/tabcontent.js', array('jquery'), '', true);
	}

/**
	* Function tab_wrap.

	* Returns tab group. Tab group can have multiple tabs inside
	* a single tab group.

*/

function tab_wrap( $atts, $content ){
	
	$return = '';
	$GLOBALS['tab_count'] = 0;
	$iCount = 0;
	$tagGroup = RandNumber(3);
	$iCount = $tagGroup + $iCount;
	do_shortcode( $content );
	wp_print_scripts('tabcontent');	
	
	if( is_array( $GLOBALS['tabs'] ) ){
		$headings[] = '<ul class="tabs">';
		$panes[] = '<div class="tabcontents">';
		foreach( $GLOBALS['tabs'] as $tab ){
			
			
			$headings[] = '<li><a href="#" data-rel="view'.$iCount.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="view'.$iCount.'" class="tabcontent">'."\n".$tab['content'].'</div>';
			$iCount++;		
		}
		$headings[] = "</ul>";
		$panes[] = '</div>';
		$return = $return . "\n".'<!-- the tabs -->'.implode( "\n", $headings )."\n".implode( "\n", $panes )."\n";
		}
	
	return $return;
	}


add_shortcode( 'tab', 'tab' );

/**
	* Function tab.

	* Returns single tab to be used inside of a tab group.

*/
function tab( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => 'Tab %d'
	), $atts));
	

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['tab_count']++;
}


function RandNumber($e){
 $rand = 0;
 
 for($i=0;$i<$e;$i++){
 $rand =  $rand .  rand(0, 9); 
 }
 return $rand;

 }
