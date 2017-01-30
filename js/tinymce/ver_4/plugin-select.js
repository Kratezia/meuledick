tinymce.PluginManager.add('wc_column', function(editor) {

	editor.addButton('wc_column', function() {

		var values = [
			//{text: 'val1', value: 'value 1'},
			//{text: 'val2', value: 'value 2'}
			{text: '1/2', value: 'one_half'},
			{text: '1/2 Last', value: 'one_half_last'},
			{text: '1/3', value: 'one_third'},
			{text: '1/3 Last', value: 'one_third_last'},
			{text: '1/4', value: 'one_fourth'},
			{text: '1/4 Last', value: 'one_fourth_last'},
			{text: '1/5', value: 'one_fifth'},
			{text: '1/5 Last', value: 'one_fifth_last'},
			{text: '2/3 ', value: 'two_third'},
			{text: '2/3 Last', value: 'two_third_last'},
			{text: '3/4', value: 'three_fourth'},
			{text: '3/4 Last', value: 'three_fourth_last'},
			{text: '2/5', value: 'two_fifth'},
			{text: '2/5 Last', value: 'two_fifth_last'},
			{text: '3/5', value: 'three_fifth'},
			{text: '3/5 Last', value: 'three_fifth_last'},
			{text: '4/5', value: 'four_fifth'},
			{text: '4/5 Last', value: 'four_fifth_last'}
		];
		
		ipsum = ' INSERT TEXT HERE ';

		return {
			type: 'listbox',
			//name: 'align',
			text: 'Columns',
			label: 'Select :',
			fixedWidth: true,
			onselect: function(e) {
				if(editor.selection.getContent() != ''){
					editor.insertContent('[' + this.value() + ']' + editor.selection.getContent() + '[/' + this.value() + ']');
				}
				else{
					editor.insertContent('[' + this.value() + ']'+ ipsum +'[/' + this.value() + ']');
				}
				//editor.insertContent( this.value() );
				},
			values: values,
		};
	});

});


tinymce.PluginManager.add('typography', function(editor) {

	editor.addButton('typography', function() {

		var values = [
			// Add some values to the list box
			{text: 'Dropcap 1', value:'dropcap1'},
			{text: 'Dropcap 1 Shade', value:'dropcap1shade'},
			{text: 'Dropcap 2', value:'dropcap2'},
			{text: 'Dropcap 2 Shade', value:'dropcap2shade'},
			{text: 'Highlight', value:'highlight'},
			{text: 'Highlight Dark', value:'highlight,dark'},
			{text: 'Pull quote', value:'pullquote'}
		];
		
		ipsum = ' INSERT TEXT HERE ';

		return {
			type: 'listbox',
			//name: 'align',
			text: 'Typography',
			label: 'Select :',
			fixedWidth: true,
			onselect: function(e) {
						
						v = this.value();
						console.log('VALUE '+v);
						switch (v){
							case 'highlight,dark':
								var myOptions=v.split(","); 
								var shortcodeName = myOptions[0];
								var shortcodeOpt1 = myOptions[1];
								
								if(editor.selection.getContent() != ''){
									editor.insertContent('[' + shortcodeName + ' style="' + shortcodeOpt1 +'"]' + editor.selection.getContent() + '[/' + shortcodeName + ']');
								}
								else{
									editor.insertContent('[' + shortcodeName + ' style="' + shortcodeOpt1 +'"]' + ipsum + '[/' + shortcodeName + ']');
								}
							break;
							
							case 'pullquote':
								if(editor.selection.getContent() != ''){
									editor.insertContent('[' + v + ' aligntext=\'left\' alignblock=\'right\' cite=\'Ryan\' style=\'style01\']' + editor.selection.getContent() + '[/' + v + ']');
								}
								else{
									editor.insertContent('[' + v + ' aligntext=\'left\' alignblock=\'right\' cite=\'Ryan\' style=\'style01\']' + ipsum + '[/' + v + ']');
								}
							break;
							
							default:
								if(editor.selection.getContent() != ''){
									editor.insertContent('[' + v + ']' + editor.selection.getContent() + '[/' + v + ']');
								}
								else{
									editor.insertContent('[' + v + ']'+ ipsum +'[/' + v + ']');
								}
						}
				},
			values: values,
		};
	});

});


tinymce.PluginManager.add('wc_button', function(editor) {

	editor.addButton('wc_button', function() {

		var values = [
			// Add some values to the list box
			{text: 'Black', value:'button,black'},
			{text: 'Gray', value:'button,gray'},
			{text: 'Light Gray', value:'button,light-gray'},
			{text: 'Red', value:'button,red'},
			{text: 'Orange', value:'button,orange'},
			{text: 'Blue', value:'button,blue'},
			{text: 'Pink', value:'button,pink'},
			{text: 'Green', value:'button,green'},
			{text: 'Rosy', value:'button,rosy'},
			{text: 'Brown', value:'button,brown'},
			{text: 'Purple', value:'button,purple'},
			{text: 'Gold', value:'button,gold'},
			{text: 'Custom', value:'button,custom'}
						
		];
		
		ipsum = ' INSERT TEXT HERE ';

		return {
			type: 'listbox',
			//name: 'align',
			text: 'Buttons',
			label: 'Select :',
			fixedWidth: true,
			onselect: function(e) {
						
						v = this.value();
						console.log('VALUE '+v);
						var myOptions=v.split(","); 
						//var myOptions=new Array(varSplit);
						var shortcodeName = myOptions[0];
						var shortcodeOpt1 = myOptions[1];
						
						if(editor.selection.getContent() != ''){
							editor.insertContent('[' + shortcodeName + ' link="http://ENTER-URL-HERE" color="' + shortcodeOpt1 +'"]' + editor.selection.getContent() + '[/' + shortcodeName + ']');
						}
						else if(shortcodeOpt1 == 'custom'){
							shortcodeOpt1 = '#FFFFFF #000000';
							editor.insertContent('[' + shortcodeName + ' link="http://ENTER-URL-HERE" color="' + shortcodeOpt1 +'"]' + ipsum + '[/' + shortcodeName + ']');
						}
						else{
							editor.insertContent('[' + shortcodeName + ' link="http://ENTER-URL-HERE" color="' + shortcodeOpt1 +'"]' + ipsum + '[/' + shortcodeName + ']');
						}
				},
			values: values,
		};
	});

});

tinymce.PluginManager.add( 'foodmenu', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'foodmenu', {
		title: 'Food Menu',
        icon: 'icon icon-menu',
		//text: 'Food Menu',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[foodmenu groups=all showtitles=1 showsubtitles=1] ' + editor.selection.getContent());
			}
			else{
				editor.insertContent('[foodmenu groups=all showtitles=1 showsubtitles=1]');
			}
		}
	} );
} );

tinymce.PluginManager.add( 'map', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'map', {
		title: 'Map',
        icon: 'icon icon-map',
		//text: 'Map',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[map addr="'+editor.selection.getContent()+'"  width="100%" height="400px" zoom="16"]');
			}
			else{
				editor.insertContent('[map addr="556 BEATTY STREET PALO ALTO, CA"  width="100%" height="400px" zoom="16"]');
			}
		}
	} );
} );


tinymce.PluginManager.add( 'themo_image', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'themo_image', {
		title: 'Image',
        icon: 'icon icon-image',
		//text: 'Image',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[image src="'+editor.selection.getContent()+'"  width="100" height="100"]');
			}
			else{
				/*editor.windowManager.alert('NOPE!');*/
				editor.insertContent('[image src="INSERT IMAGE URL HERE" width="100" height="100"]');
			}
		}
	} );
} );

tinymce.PluginManager.add( 'ruler', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'ruler', {
		title: 'Horizontal Rule',
        icon: 'icon icon-ruler',
		//text: 'Horizontal Rule',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[ruler bottom=20 top=20 margins=20]'+ editor.selection.getContent());
			}
			else{
				/*editor.windowManager.alert('NOPE!');*/
				editor.insertContent('[ruler bottom=20 top=20 margins=20]');
			}
		}
	} );
} );


tinymce.PluginManager.add( 'slideshow', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'slideshow', {
		title: 'Slideshow',
        icon: 'icon icon-slideshow',
		//text: 'Slideshow',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[slideshow slider_width=668 showtitle=0]'+ editor.selection.getContent() + '[/slideshow]');
			}
			else{
				/*editor.windowManager.alert('NOPE!');*/
				editor.insertContent('[slideshow slider_width=668 showtitle=0] ENTER IMAGE URL HERE [/slideshow]');
			}
		}
	} );
} );


tinymce.PluginManager.add( 'tab', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'tab', {
		title: 'Tabs',
        icon: 'icon icon-tab',
		//text: 'Tabs',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[tabwrap]<br />\
				[tab title="Tab 1"]'+ editor.selection.getContent() + '[/tab]<br />\
				[tab title="Tab 2"]Tab 2 content goes here.[/tab]<br />\
				[tab title="Tab 3"]Tab 3 content goes here.[/tab]<br />\
				[/tabwrap]');
			}
			else{
				editor.insertContent('[tabwrap]<br />\
				[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />\
				[tab title="Tab 2"]Tab 2 content goes here.[/tab]<br />\
				[tab title="Tab 3"]Tab 3 content goes here.[/tab]<br />\
				[/tabwrap]');
			}
		}
	} );
} );


tinymce.PluginManager.add( 'toggle', function( editor, url ) {
		
	// Add a button that opens a window
	editor.addButton( 'toggle', {
		title: 'Toggle',
        icon: 'icon icon-toggle',
		//text: 'Toggle',
		//icon: false,
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[toggle title="ENTER TITLE HERE"]<br />\
				'+ editor.selection.getContent() + '<br />\
				[/toggle]');
			}
			else{
				editor.insertContent('[toggle title="ENTER TITLE HERE"]<br />\
				ENTER CONTENT HERE <br />\
				[/toggle]');
			}
		}
	} );
} );


tinymce.PluginManager.add( 'blogfeed', function( editor, url ) {
		
	console.log(url + '/button_blogfeed.png');
		
	// Add a button that opens a window
	editor.addButton( 'blogfeed', {
		title: 'Blog Feed',
        icon: 'icon icon-blogfeed',
		onclick: function() {
			if(editor.selection.getContent() != ''){
				editor.insertContent('[blogfeed cat=1 max=] ' + editor.selection.getContent());
			}
			else{
				editor.insertContent('[blogfeed cat=1 max=1]');
			}
		}
	} );
} );