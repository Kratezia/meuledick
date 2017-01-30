<?php

/**
	* typography.php
	
	* Created for the theme options typography controls.
	* Helps set value such as Font Family, Heading Sizes, Paragraph Sizes
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

global $sa_typography, $settings; 

// Default Heading / Body Fonts.
$sa_typography = array(
	'google_font_family_h1' => 'Lobster',
	'google_font_family_p' => 'Cabin'
);


/**
  * Function to fetch, modify and store a serialized options string 
  * Used for updating an individual key-value pair within a larger data set
  * 
  * $opt_group is the name if the option in the wp_options table
  * it contains serialized data representing an array of individual oprions relating
  * to an 'options-group of a theme framework
  */

/*function alt_update_option($opt_key,$opt_val,$opt_group){   
    // get options-data as it exists before update
    $options = get_option($opt_group);
    // update it
    $options[$opt_key] = $opt_val;
    // store updated data
	//echo "STORING NEW KEY ". $opt_key . " VALUE ". $value;
    update_option($opt_group,$options);
}*/


/**
  * Function to pre google fonts for use in the website. 
  * 
  */

function prep_h1($opt_val,$opt_group){   
   
	// get options-data as it exists before update
    $google_font_family_h1 = str_replace(' ', '', $opt_val); // Remove spaces
	$parts = explode("|",$google_font_family_h1); // Split family-name and generic-family
	$google_h1_font = $parts['0'];	// Family-name
	$google_h1_fontfamily = $parts['1']; // Generic-family
	
	$opt_key = "google_h1_font";
	alt_update_option($opt_key,$google_h1_font,$opt_group);
	
	$google_h1_font = str_replace('+',' ',$google_font_family_h1); // Remove + from Google Font Family Name
	$parts = explode(":",$google_h1_font); // Split weight
	
	//break the string up around the "/" character in $mystring
	$google_h1 = $parts['0']; // Family-name
	$parts = explode("|",$google_h1); // Split family-name and generic-family again.
	$google_h1 = $parts['0']; // Family-name
	
	$opt_key = "google_h1";
	alt_update_option($opt_key,$google_h1,$opt_group);
	
	$opt_key = "google_h1_fontfamily";
	alt_update_option($opt_key,$google_h1_fontfamily,$opt_group);

}

function prep_p($opt_val,$opt_group){   
   
	$google_font_family_p = str_replace(' ', '', $opt_val); // Remove spaces
	$parts = explode("|",$google_font_family_p); // Split family-name and generic-family
	$google_p_font = $parts['0'];	// Family-name
	$google_p_fontfamily = $parts['1']; // Generic-family
	
	$opt_key = "google_p_font";
	alt_update_option($opt_key,$google_p_font,$opt_group);
	
	$google_p_font = str_replace('+',' ',$google_font_family_p); // Remove + from Google Font Family Name
	$parts = explode(":",$google_p_font); // Split weight
	
	//break the string up around the "/" character in $mystring
	$google_p = $parts['0']; // Family-name
	$parts = explode("|",$google_p); // Split family-name and generic-family again.
	$google_p = $parts['0']; // Family-name
	
	$opt_key = "google_p";
	alt_update_option($opt_key,$google_p,$opt_group);
	
	$opt_key = "google_p_fontfamily";
	alt_update_option($opt_key,$google_p_fontfamily,$opt_group);

}



// Function to generate options page
function theme_typography_options() {
	global $sa_typography, $settings; 
	
	
	

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . " " . __( 'Theme Typography Options', 'eatery') . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php" name="themeOptions">

	<?php $settings = get_option( 'sa_typography', $sa_typography ); 
	
	
	//Update Google Fonts
	if ($settings['google_font_family_h1'] > ""){
		prep_h1($settings['google_font_family_h1'],'sa_typography');
	}
	
	//Update Google Fonts
	if ($settings['google_font_family_p'] > ""){
		prep_p($settings['google_font_family_p'],'sa_typography');
	}
	
	?>
	
	<?php settings_fields( 'sa_theme_typography' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>


   <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

<div class="theme-options-group">

<table cellspacing="0" class="widefat theme-options-table">
<thead><tr><th scope="row" colspan="2"><?php _e('Sample Text for Font Preview','eatery'); ?></th></tr></thead>
	<tbody>
    	<tr><th scope="row"><strong>H1:</strong></th><td><p class="description"></p><input style="" type="text" size="40" name="sa_typography[h1_sample]" id="sa_typography[h1_sample]" value="<?php  esc_attr_e($settings['h1_sample']); ?>" /></td></tr>
		<tr><th scope="row"><strong>Paragraph:</strong></th><td><p class="description"></p> <input type="text" size="80" name="sa_typography[p_sample]" id="sa_typography[p_sample]" value="<?php  esc_attr_e($settings['p_sample']); ?>" /></td></tr>
</tbody></table>
<hr />
<table cellspacing="0" class="widefat theme-options-table">
<thead><tr><th scope="row"><?php _e('Font Family','eatery'); ?></th></tr></thead>

<!-- Link to Google Fonts for Preview -->
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Raleway:200,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Allan:bold' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Cuprum:bold' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Junge' rel='stylesheet' type='text/css'>




<style type="text/css">
	h1.google_font {font-size: 40px; color:#000; vertical-align:middle}
	td p.google_font { font-size:16px;} 
	
	h1.google_font input, td p.google_font input{vertical-align:top;}
	
	h1.Lobster {font-family: 'Lobster', Georgia, Times, serif; size:70px;}
 	p.cabin {font-family: 'Cabin', Helvetica, Arial, sans-serif; }
	
	h1.raleway {font-family: 'Raleway', Helvetica, Arial, sans-serif;}
	h1.raleway-light {font-family: 'Raleway', Helvetica, Arial, sans-serif; font-weight:200}
	
 	p.goudy {font-family: 'Goudy Bookletter 1911', Georgia, Times, serif; }
	
	h1.Merriweather {font-family: 'Merriweather', Georgia, Times, serif;}
 	p.NewsCycle {font-family: 'News Cycle', Helvetica, Arial, sans-serif;}
	
	h1.Arvo {font-family: 'Arvo', Georgia, Times, serif;}
 	p.PT {font-family: 'PT Sans', Helvetica, Arial, sans-serif;}
	
	h1.Dancing {font-family: 'Dancing Script', Georgia, Times, serif;}
 	p.Josefin {font-family: 'Josefin Sans', Helvetica, Arial, sans-serif;}
	
	h1.Allan {font-family: 'Allan', Helvetica, Arial, sans-serif;}
 	p.Cardo {font-family: 'Cardo', Georgia, Times, serif;}
	
	h1.Ubuntu {font-family: 'Ubuntu', Helvetica, Arial, sans-serif;}
 	p.Rokkitt {font-family: 'Rokkitt', Georgia, Times, serif;}
	
	h1.Droid_Serif {font-family: 'Droid Serif', Georgia, Times, serif;}
 	p.Droid_Sans {font-family: 'Droid Sans', Helvetica, Arial, sans-serif;}
	
	h1.Cuprum {font-family: 'Cuprum', Helvetica, Arial, sans-serif;}
 	p.Junge {font-family: 'Junge', Georgia, Times, serif;}
	
	td.border{border:#CCC thin solid}
</style>

<?php 
// Default sample text for heading / paragraph preview.
$h1text = 'Eatery';
$h1text = ($settings['h1_sample'] > '' ? $settings['h1_sample'] : $h1text); // returns true

$ptext = __('The five boxing wizards jump quickly.','eatery');
$ptext = ($settings['p_sample'] > '' ? $settings['p_sample'] : $ptext); // returns true

?>


<tbody><tr><th>


<table>

<tr >
    <td class="border">
        <strong>Raleway & Goudy Bookletter 1911</strong>
       
        <h1 class="raleway google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Raleway | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_h1'], "Raleway | Helvetica, Arial, sans-serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="goudy google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Goudy+Bookletter+1911 | Georgia, Times, serif" <?php checked( $settings['google_font_family_p'], "Goudy+Bookletter+1911 | Georgia, Times, serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    <td class="border">
        <strong>Raleway Extra Light & Goudy Bookletter 1911</strong>
       
        <h1 class="raleway-light google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Raleway:200 | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_h1'], "Raleway:200 | Helvetica, Arial, sans-serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="goudy google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Goudy+Bookletter+1911 | Georgia, Times, serif" <?php checked( $settings['google_font_family_p'], "Goudy+Bookletter+1911 | Georgia, Times, serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    <td class="border">
        <strong>Lobster & Cabin</strong>
        <style type="text/css">
		
		</style>
        <h1 class="Lobster google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Lobster | Georgia, Times, serif" <?php checked( $settings['google_font_family_h1'], "Lobster | Georgia, Times, serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="cabin google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Cabin | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_p'], "Cabin | Helvetica, Arial, sans-serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
</tr>
<tr>
    <td class="border">
        <strong>Arvo & PT Sans</strong>
        
        <h1 class="Arvo google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Arvo | Georgia, Times, serif" <?php checked( $settings['google_font_family_h1'], "Arvo | Georgia, Times, serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="PT google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="PT+Sans | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_p'], "PT+Sans | Helvetica, Arial, sans-serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    <td class="border">
        <strong>Dancing Script & Josefin Sans</strong>
        
        <h1 class="Dancing google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Dancing+Script | Georgia, Times, serif" <?php checked( $settings['google_font_family_h1'], "Dancing+Script | Georgia, Times, serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="Josefin google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Josefin+Sans | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_p'], "Josefin+Sans | Helvetica, Arial, sans-serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    <td class="border">
        <strong>Allan & Cardo</strong>
        
        <h1 class="Allan google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Allan:bold | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_h1'], "Allan:bold | Helvetica, Arial, sans-serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="Cardo google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Cardo | Georgia, Times, serif" <?php checked( $settings['google_font_family_p'], "Cardo | Georgia, Times, serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    </tr>
    
    <tr>
    <td class="border">
        <strong>Ubuntu & Rokkitt</strong>
       
        <h1 class="Ubuntu google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Ubuntu | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_h1'], "Ubuntu | Helvetica, Arial, sans-serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="Rokkitt google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Rokkitt | Georgia, Times, serif" <?php checked( $settings['google_font_family_p'], "Rokkitt | Georgia, Times, serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    <td class="border">
        <strong>Droid Serif & Droid Sans</strong>
        
        <h1 class="Droid_Serif google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Droid+Serif | Georgia, Times, serif" <?php checked( $settings['google_font_family_h1'], "Droid+Serif | Georgia, Times, serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="Droid_Sans google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Droid+Sans | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_p'], "Droid+Sans | Helvetica, Arial, sans-serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
    <td class="border">
        <strong>Cuprum & Junge</strong>
        
        <h1 class="Cuprum google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Cuprum:bold | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_h1'], "Cuprum:bold | Helvetica, Arial, sans-serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="Junge google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="Junge | Georgia, Times, serif" <?php checked( $settings['google_font_family_p'], "Junge | Georgia, Times, serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
</tr>
<tr>
    <td class="border">
        <strong>Merriweather & News Cycle</strong>
        
        <h1 class="Merriweather google_font"><input type="radio"  name="sa_typography[google_font_family_h1]" value="Merriweather | Georgia, Times, serif" <?php checked( $settings['google_font_family_h1'], "Merriweather | Georgia, Times, serif" ); ?> /><?php echo $h1text; ?></h1>
        <p class="NewsCycle google_font"><input type="radio"  name="sa_typography[google_font_family_p]" value="News+Cycle | Helvetica, Arial, sans-serif" <?php checked( $settings['google_font_family_p'], "News+Cycle | Helvetica, Arial, sans-serif" ); ?> /><?php echo $ptext; ?></p>
    </td>
</tr>
</table></th></tr></tbody>

<script>

<!--
function uncheckRadio() {
 //var formstuff = 'sa_typography\[google_font_family_h1\]';
 
 var choice = eval("document.themeOptions." + "sa_typography\\[google_font_family_h1\\]");
 alert(choice);
 for (i = 0; i < choice.length; i++) {
  if ( choice[i].checked = true ) 
   choice[i].checked = false; 
 }
}
//-->
</script>

<thead><tr><th scope="row"><?php _e('Clear H1','eatery'); ?> <input type="radio"  name="sa_typography[google_font_family_h1]" value="" /> <?php _e('Clear','eatery'); ?> Pagraph Text <input type="radio"  name="sa_typography[google_font_family_p]" value=""  /></p></th></tr></thead>

</table>
</div>
	
    <p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>

<table cellspacing="0" class="widefat theme-options-table">
<thead><tr><th scope="row" colspan="2"><?php _e('Custom Google Font','eatery'); ?> - <a href="http://www.google.com/webfonts" target="_blank"><?php _e('Find More','eatery'); ?></a></th></tr></thead>
	<tbody>
    	<tr><th scope="row"><strong><?php _e('Choose a Font Name','eatery'); ?></strong></th><td><p class="description"></p> <input style="" type="text" size="40" name="sa_typography[custom_google_font]" id="sa_typography[custom_google_font]" value="<?php  esc_attr_e($settings['custom_google_font']); ?>" /> e.g. Rancho</td></tr>
        <tr><th scope="row"><strong><?php _e('Custom Font CSS','eatery'); ?></strong></th><td><p class="description"></p><textarea id="custom_css" rows="10" name="sa_typography[custom_google_font_css]" type="textarea" class="code"><?php  esc_attr_e($settings['custom_google_font_css']); ?></textarea><br />
        e.g.: h1 { font-family: 'Rancho', cursive;}
        </td></tr>
</tbody></table>


<div class="theme-options-group">
<table cellspacing="0" class="widefat theme-options-table">
<thead><tr><th scope="row" colspan="2"><?php _e('Heading Sizes','eatery'); ?></th></tr></thead>

<style type="text/css">
.textbottom {vertical-align:middle; padding-right:10px;} 
</style>


<tbody><tr><th scope="row"><strong>H1 </strong></th><td><p class="description"><?php _e('Includes Page Titles','eatery'); ?></p><input name="sa_typography[h1_size]" id="sa_typography[h1_size]" type="text" size="4" value="<?php  esc_attr_e($settings['h1_size']); ?>" /> e.g. 52px</td></tr>
<tbody><tr><th scope="row"><strong>H2 </strong></th><td><p class="description"></p><input name="sa_typography[h2_size]" id="sa_typography[h2_size]" type="text" size="4" value="<?php  esc_attr_e($settings['h2_size']); ?>" /></td></tr>
<tbody><tr><th scope="row"><strong>H3 </strong></th><td><p class="description"></p><input name="sa_typography[h3_size]" id="sa_typography[h3_size]" type="text" size="4" value="<?php  esc_attr_e($settings['h3_size']); ?>" /></td></tr>
<tbody><tr><th scope="row"><strong>H4 </strong></th><td><p class="description"></p><input name="sa_typography[h4_size]" id="sa_typography[h4_size]" type="text" size="4" value="<?php  esc_attr_e($settings['h4_size']); ?>" /></td></tr>
<tbody><tr><th scope="row"><strong>H5 </strong></th><td><p class="description"></p><input name="sa_typography[h5_size]" id="sa_typography[h5_size]" type="text" size="4" value="<?php  esc_attr_e($settings['h5_size']); ?>" /></td></tr>
<tbody><tr><th scope="row"><strong>H6 </strong></th><td><p class="description"></p><input name="sa_typography[h6_size]" id="sa_typography[h6_size]" type="text" size="4" value="<?php  esc_attr_e($settings['h6_size']); ?>" /></td></tr>
<tbody><tr><th scope="row"><strong>P </strong></th><td><p class="description"></p><input name="sa_typography[p_size]" id="sa_typography[p_size]" type="text" size="4" value="<?php  esc_attr_e($settings['p_size']); ?>" /></td></tr>

</tbody>
</table>
</div>

<p class="submit"><input type="submit" name="save_theme_options" class="button-primary autowidth" value="<?php _e('Save Changes','eatery'); ?>" /></p>
   
	<?php
}