// JavaScript Document
jQuery(window).load(function () {
	
	// New jQuery Mobile Menu
	jQuery('nav#mobile-navigation').hide();
	jQuery('nav#mobile-navigation').meanmenu();
	
	
	
	
	if (jQuery('#slider').length) { // implies *not* zero
		jQuery('#slider').nivoSlider({
				afterChange: function(){
							jQuery('.nivoSliderimg img').css('border:10px red; border-radius: 6px; -o-border-radius: 6px; -ms-border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px;')
							} // Triggers after a slide transition
				
			});
	} 
	
	// OLD mobile Menu
	/*jQuery('.mobile-menu  select').change(function(e){
   		window.location = jQuery(this).val()
 		})
	jQuery('.mobile-menu  .mob-sub').hide();*/
	
	
	var winWidth = jQuery(window).width()
			
			if (winWidth > 767){
				
				// To ensure that the sidebar sticks to the bottom of the page
				// we calculate the height of the tallest object and match the
				// sidebar to it.
				var height1 = jQuery('.eightcol').height()
				var height2 = jQuery('html').height()
				var height3 = jQuery("#sidebar-container").height()
				var height4 = jQuery(window).height()
				
				/* 	Tab Shortcode Fix
					Because all tabbed content loads stacked this throws off
				 	the height of the .eightcol and html elements so we need to subtract 
				 	the extra height added by the stacked tabbed content. Once we have that
					we can reset the hight values of html and .eightcol correctly. We will
					need to figure out the tallest of all the tabbed content elements
					and add that back into the total height of .eightcol and html

				 	ONLY do this if we are using the tab shortcode.
				*/
				if (jQuery('.tabcontent').length) {
					var max = 0;
					var numtotal = 0;
					// Loop through all .tabcontent classes and get the tallest tab.
					jQuery('.tabcontent').each(function(){
						var num = jQuery(this).height()
						// Track total height of all tabs so we can subtract later
						numtotal = numtotal + num;
						if(num > max)
						{
						   max = num;
						}
					});
					
					// Substract the total height of all .tabcontent from .eightcol and html
					// then add in only the lattest .tabcontent.
					height1 = height1 - numtotal;
					height1 = height1 + max;
					
					height2 = height2 - numtotal;
					height2 = height2 + max;
					
				};
				
				
				
				// Function to get the Max value in Array
				Array.max = function( array ){
				return Math.max.apply( Math, array );
				};
			
				var maxheight = Array.max([height1,height2,height3,height4])
				
				
				if (height3 < maxheight) {
					//jQuery("#sidebar").height(maxheight)
					jQuery("#sidebar").css('height', maxheight + 'px');
				}
				
			}else{
				jQuery("#sidebar").css("height","auto")
			}	
			
	jQuery(window).resize(function() {
			
			var winWidth = jQuery(window).width()
			
			if (winWidth > 767){
				
				var height1 = jQuery('.eightcol').height()
				var height2 = jQuery('html').height()
				var height3 = jQuery("#sidebar-container").height()
				var height4 = jQuery(window).height()
				
				
				
	
				// Function to get the Max value in Array
				Array.max = function( array ){
				return Math.max.apply( Math, array );
				};
	
				var maxheight = Array.max([height1,height2,height3,height4])
				
				//console&&console.log('maxheight ' + maxheight);
				
				if (height3 < maxheight) {
					jQuery("#sidebar").css('height', maxheight + 'px');
				}
			}else{
					jQuery("#sidebar").css("height","auto")
			}
			
       });
	   
});	

jQuery(document).ready(function(){
			var height3 = jQuery("#sidebar-container").height()
        });