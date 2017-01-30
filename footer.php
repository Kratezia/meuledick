<?php 
global $sa_general;
$general_options = get_option('sa_general', $sa_general); 
$copyright_footer_text = $general_options['footer_copyright'];

if ($copyright_footer_text > ""){
	$footer_text = $copyright_footer_text;
}else{
	$footer_text = "Copyright &copy; " . date("Y ") . get_bloginfo('name') . ". All rights reserved.";
}
?>

<div id="footer"><div class="footer-inner"><p class="copyright"><?php echo $footer_text; ?></p><p class="credit"><a href="http://demo.themovation.com/eatery/">Eatery Theme</a> by <a href="http://www.themovation.com/">Themovation</a></p></div></div>
</div> <!-- .eightcol End -->    
</div> <!-- .row -->        
</div> <!-- #container -->
</div> <!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>