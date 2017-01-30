// JavaScript Document
// Version 1.1
// JAN 23, 2014 - Fixed tinymce icon for image
(function() {
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.shortcode', {
		init : function(ed, url) {
    		theurl = url;
			edObject = ed;
			last = '_last';
			ipsum = ' INSERT TEXT HERE ';
			//alert(theurl);
		},
        createControl: function(n, cm) {
            //alert(theurl);
			switch (n) {
                case 'wc_column':
                    var mlb = cm.createListBox('wc_column', {
                        title : 'Columns',
                        onselect : function(v) {
                            /*tinyMCE.activeEditor.windowManager.alert('Value selected:' + v);
							edObject.selection.setContent('[' + v + ']Replace This Text[/' + v + '] [' + v + last + '] '+ipsum+' [/' + v + last + ']');*/
							
							if(edObject.selection.getContent() != ''){
                         		edObject.selection.setContent('[' + v + ']' + edObject.selection.getContent() + '[/' + v + ']');
							}
							else{
								edObject.selection.setContent('[' + v + ']'+ ipsum +'[/' + v + ']');
							}
                        }
                    });

                    // Add some values to the list box
						mlb.add('1/2', 'one_half');
						mlb.add('1/2 Last', 'one_half_last');
						mlb.add('1/3', 'one_third');
						mlb.add('1/3 Last', 'one_third_last');
						mlb.add('1/4', 'one_fourth');
						mlb.add('1/4 Last', 'one_fourth_last');
						mlb.add('1/5', 'one_fifth');
						mlb.add('1/5 Last', 'one_fifth_last');
						mlb.add('2/3 ', 'two_third');
						mlb.add('2/3 Last', 'two_third_last');
						mlb.add('3/4', 'three_fourth');
						mlb.add('3/4 Last', 'three_fourth_last');
						mlb.add('2/5', 'two_fifth');
						mlb.add('2/5 Last', 'two_fifth_last');
						mlb.add('3/5', 'three_fifth');
						mlb.add('3/5 Last', 'three_fifth_last');
						mlb.add('4/5', 'four_fifth');
						mlb.add('4/5 Last', 'four_fifth_last');

                // Return the new listbox instance
                return mlb;

				case 'wc_button':
                    var mlb = cm.createListBox('wc_button', {
                        title : 'Buttons',
                        onselect : function(v) {
                            
							var myOptions=v.split(","); 
							//var myOptions=new Array(varSplit);
							var shortcodeName = myOptions[0];
							var shortcodeOpt1 = myOptions[1];
							
							if(edObject.selection.getContent() != ''){
                         		edObject.selection.setContent('[' + shortcodeName + ' link="http://ENTER-URL-HERE" color="' + shortcodeOpt1 +'"]' + edObject.selection.getContent() + '[/' + shortcodeName + ']');
							}
							else if(shortcodeOpt1 == 'custom'){
								shortcodeOpt1 = '#FFFFFF #000000';
								
								edObject.selection.setContent('[' + shortcodeName + ' link="http://ENTER-URL-HERE" color="' + shortcodeOpt1 +'"]' + ipsum + '[/' + shortcodeName + ']');
							}
							else{
								edObject.selection.setContent('[' + shortcodeName + ' link="http://ENTER-URL-HERE" color="' + shortcodeOpt1 +'"]' + ipsum + '[/' + shortcodeName + ']');
							}
                        }
                    });

                    // Add some values to the list box
						mlb.add('Black', 'button,black');
						mlb.add('Gray', 'button,gray');
						mlb.add('Light Gray', 'button,light-gray');
						mlb.add('Red', 'button,red');
						mlb.add('Orange', 'button,orange');
						mlb.add('Blue', 'button,blue');
						mlb.add('Pink', 'button,pink');
						mlb.add('Green', 'button,green');
						mlb.add('Rosy', 'button,rosy');
						mlb.add('Brown', 'button,brown');
						mlb.add('Purple', 'button,purple');
						mlb.add('Gold', 'button,gold');
						mlb.add('Custom', 'button,custom');

                // Return the new listbox instance
                return mlb;
				
				case 'foodmenu':
				
				var mlb = edObject.addButton('foodmenu', {
					 title : 'Food Menu',
					 image : theurl + '/button_menu.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[foodmenu groups=all showtitles=1 showsubtitles=1] ' + edObject.selection.getContent());
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[foodmenu groups=all showtitles=1 showsubtitles=1]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				case 'map':
				
				var mlb = edObject.addButton('map', {
					 title : 'Map',
					image : theurl + '/button_map.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[map addr="'+edObject.selection.getContent()+'"  width="100%" height="400px" zoom="16"]');
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[map addr="556 BEATTY STREET PALO ALTO, CA"  width="100%" height="400px" zoom="16"]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				case 'themo_image':
				
				var mlb = edObject.addButton('themo_image', {
					 title : 'Image',
					 image : theurl + '/button_image.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[image src="'+edObject.selection.getContent()+'"  width="100" height="100"]');
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[image src="INSERT IMAGE URL HERE" width="100" height="100"]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				case 'ruler':
				
				var mlb = edObject.addButton('ruler', {
					 title : 'Horizontal Rule',
					 image : theurl + '/button_ruler.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[ruler bottom=20 top=20 margins=20]'+ edObject.selection.getContent());
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[ruler bottom=20 top=20 margins=20]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				
				case 'slideshow':
				
				var mlb = edObject.addButton('slideshow', {
					 title : 'Slide Show',
					 image : theurl + '/button_slideshow.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[slideshow slider_width=668 showtitle=0]'+ edObject.selection.getContent() + '[/slideshow]');
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[slideshow slider_width=668 showtitle=0] ENTER IMAGE URL HERE [/slideshow]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				case 'tab':
				
				var mlb = edObject.addButton('tab', {
					 title : 'Tabs',
					 image : theurl + '/button_tab.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[tabwrap]<br />\
								[tab title="Tab 1"]'+ edObject.selection.getContent() + '[/tab]<br />\
								[tab title="Tab 2"]Tab 2 content goes here.[/tab]<br />\
								[tab title="Tab 3"]Tab 3 content goes here.[/tab]<br />\
								[/tabwrap]');
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[tabwrap]<br />\
								[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />\
								[tab title="Tab 2"]Tab 2 content goes here.[/tab]<br />\
								[tab title="Tab 3"]Tab 3 content goes here.[/tab]<br />\
								[/tabwrap]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				case 'toggle':
				
				var mlb = edObject.addButton('toggle', {
					 title : 'Toggle',
					 image : theurl + '/button_toggle.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
                         		/*edObject.windowManager.alert('You have selected something!');*/
								edObject.selection.setContent('[toggle title="ENTER TITLE HERE"]<br />\
								'+ edObject.selection.getContent() + '<br />\
								[/toggle]');
							}
							else{
								/*edObject.windowManager.alert('NOPE!');*/
								edObject.selection.setContent('[toggle title="ENTER TITLE HERE"]<br />\
								ENTER CONTENT HERE <br />\
								[/toggle]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				case 'blogfeed':
				
				var mlb = edObject.addButton('blogfeed', {
					 title : 'Blog Feed',
					 image : theurl + '/button_blogfeed.png',
					 onclick : function() {
							if(edObject.selection.getContent() != ''){
								edObject.selection.setContent('[blogfeed cat=1 max=] ' + edObject.selection.getContent());
							}
							else{
								edObject.selection.setContent('[blogfeed cat=1 max=1]');
							}
                		}
				  });
				// Return the new listbox instance
                return mlb;
				
				 case 'typography':
                    var mlb = cm.createListBox('typography', {
                        title : 'Typography',
                        onselect : function(v) {
							
							switch (v)
							{
								case 'highlight,dark':
									var myOptions=v.split(","); 
									//var myOptions=new Array(varSplit);
									var shortcodeName = myOptions[0];
									var shortcodeOpt1 = myOptions[1];
									
									if(edObject.selection.getContent() != ''){
										edObject.selection.setContent('[' + shortcodeName + ' style="' + shortcodeOpt1 +'"]' + edObject.selection.getContent() + '[/' + shortcodeName + ']');
									}
									else{
										edObject.selection.setContent('[' + shortcodeName + ' style="' + shortcodeOpt1 +'"]' + ipsum + '[/' + shortcodeName + ']');
									}
								break;
								
								case 'pullquote':
									if(edObject.selection.getContent() != ''){
										edObject.selection.setContent('[' + v + ' aligntext=\'left\' alignblock=\'right\' cite=\'Ryan\' style=\'style01\']' + edObject.selection.getContent() + '[/' + v + ']');
									}
									else{
										edObject.selection.setContent('[' + v + ' aligntext=\'left\' alignblock=\'right\' cite=\'Ryan\' style=\'style01\']' + ipsum + '[/' + v + ']');
									}
								break;
								
								default:
									if(edObject.selection.getContent() != ''){
									edObject.selection.setContent('[' + v + ']' + edObject.selection.getContent() + '[/' + v + ']');
									}
									else{
										edObject.selection.setContent('[' + v + ']'+ ipsum +'[/' + v + ']');
									}
							}
                        }
                    });

                    // Add some values to the list box
						mlb.add('Dropcap 1', 'dropcap1');
						mlb.add('Dropcap 1 Shade', 'dropcap1shade');
						mlb.add('Dropcap 2', 'dropcap2');
						mlb.add('Dropcap 2 Shade', 'dropcap2shade');
						mlb.add('Highlight', 'highlight');
						mlb.add('Highlight Dark', 'highlight,dark');
						mlb.add('Pull quote', 'pullquote');

                // Return the new listbox instance
                return mlb;
               
            }
            return null;
        }
    });
    tinymce.PluginManager.add('typography', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('wc_column', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('wc_button', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('foodmenu', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('map', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('themo_image', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('ruler', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('slideshow', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('tab', tinymce.plugins.shortcode);
	tinymce.PluginManager.add('blogfeed', tinymce.plugins.shortcode);
	
})();
