
    jQuery(document).ready(function(){ 
       jQuery(".toggle_container").hide(); 
		jQuery("h3.trigger").click(function(){
			jQuery(this).toggleClass("active").next().slideToggle("normal");
			return false; //Prevent the browser jump to the link anchor
		});
	}); // END <------ $(document).ready --------->