// JavaScript Document

			var winWidth = jQuery(window).width()
			
			if (winWidth > 767){
			
				var height1 = jQuery('.eightcol').height()
				var height2 = jQuery('html').height()
				var height3 = jQuery("#sidebar-container").height()
				var height4 = jQuery(window).height()
				
				alert('test');
				console.log("eightcol: "+height1);
				console.log("html: "+height2);
				console.log("sidebar-container: "+height3);
				console.log("window: "+height4);
				
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
	
				if (height3 < maxheight) {
					jQuery("#sidebar").css('height', maxheight + 'px');
				}
			}else{
					jQuery("#sidebar").css("height","auto")
			}
			
       });
