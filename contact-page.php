<?php
/*
 Template Name: Contact Page
 This page template displays the content, with a contact form after.
 */
get_header(); ?>


<?php include (TEMPLATEPATH . '/wp_mail_contact.php'); ?>

<script src="<?php bloginfo('template_directory'); ?>/js/form-validation/jquery.metadata.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/form-validation/jquery.validate.js" type="text/javascript"></script>


<script type="text/javascript">
jQuery().ready(function() {
	jQuery("#form1").validate({
		errorLabelContainer: jQuery("#form1 div.error")
	});
	
	var container = jQuery('div.message');
	// validate the form when it is submitted
	var validator = jQuery("#reso").validate({
		errorContainer: container,
		errorLabelContainer: jQuery("ol", container),
		wrapper: 'li',
		meta: "validate"
	});
	
	jQuery(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
	
<div class="container">        
<div class="row">
    <?php get_sidebar(); ?>
    <div class="eightcol last">              
    <div id="main-content">
        <div id="inner-content">
            <?php while ( have_posts() ) : the_post(); ?> 
           		<h1 class="page-title"><?php the_title(); ?></h1>
                <hr class="headings">
            	<?php the_content(''); ?>
                
                <!-- FORM -->
                <div id="form-wrapper">
                
                <!-- our error container -->

                <div class="message">       
                
                <h4><?php _e('There are errors with your form','eatery'); ?>:</h4>
                <ol>
                    <li><label for="formname" class="error"><?php _e('Please enter your full name','eatery'); ?></label></li>
                    <li><label for="formphone" class="error"><?php _e('Please enter your phone number','eatery'); ?></label></li>
                    <li><label for="formemail" class="error"><?php _e('Please enter your email address','eatery'); ?></label></li>
                </ol>
                </div>
                
                <?php 
				
					if (isset($mailProblems)) {
						
						?>
                        <div class="result">
                       
                        <?php
						if(!$mailProblems){
							echo "<h4>".__('Sorry, but your message was not sent; please try again. If this error happens again please contact us directly.','eatery')."</h4>"; 
						} else{

							echo "<h4 class='success'>" . __('Message sent. Thank you','eatery') . "</h4>"; 
						}?>
                        </div>
                        <?php
					}
				?>        
                                
                <form name="reservations" id="reso" action="<?php the_permalink(); ?>" method="post">
                 <div class="infoWrapper">
                  <div class="infoContent">
                  
                    <input type="hidden" id="formname_default" value="<?php _e('Full Name','eatery') ?>" />
                    <input type="hidden" id="formphone_default" value="<?php _e('Phone','eatery') ?>" />
                   
                   <input type="text" name="formname" id="formname" value="<?php _e('Full Name','eatery') ?>" onfocus="if(this.value=='<?php _e('Full Name','eatery') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Full Name','eatery') ?>';" class="input-text full {validate:{required:true,minlength:3}}"  />
                   
                  </div>
                 </div>
    
                 
                 <div class="infoWrapper">
                    <div class="infoContent">
                    	<input type="text" name="formphone" id="formphone" value="<?php _e('Phone','eatery') ?>" onfocus="if(this.value=='<?php _e('Phone','eatery') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Phone','eatery') ?>';" class="input-text full {validate:{required:true,minlength:7}}"  />
                    </div>
                </div>
                
                 <div class="infoWrapper">
                  <div class="infoContent">
                   <input type="text" name="formemail" id="formemail" value="<?php _e('Email','eatery') ?>" onfocus="if(this.value=='<?php _e('Email','eatery') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Email','eatery') ?>';" class="input-text full {validate:{required:true,email:true}}" />
                  </div>
                 </div>
                 
                 <div class="infoWrapper">
                  <div class="infoContent">
                   <textarea name="formcomments" id="formcomments" onfocus="if(this.value=='<?php _e('Comments / notes (optional)','eatery') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Comments / notes (optional)','eatery') ?>';" class="input-text full tall"><?php _e('Comments / notes (optional)','eatery'); ?></textarea>
                  </div>
                 </div>
                 
                 <div class="infoWrapper">
                  <div class="infoTitle"></div>
                  <div class="infoContent">
                   <input type="submit" name="send" value="<?php _e('Send','eatery'); ?>" class="sendbtn" />                   
                  </div>
                 </div>
                 	
					
                </form>
                </div>
                <!-- /FORM -->  
                              
            <?php endwhile; ?>
            <div class="corner topLeft"></div>
            <div class="corner topRight"></div>            
            <div class="corner bottomLeft"></div>
            <div class="corner bottomRight"></div>
        </div>                
    </div>

        <div style="clear:both;"></div>        

    <?php get_footer(); ?>    