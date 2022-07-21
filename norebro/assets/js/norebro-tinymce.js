(function() {
	"use strict";
	
	var norebroColorpicker = function(ed, title, colorNow, callback){
		var button = this;
		var colortext, colorpicker;
		var win = ed.windowManager.open({
			title: title,
			body: [
				{
					type: 'colorpicker',
					name: 'dropcap_colorpicker',
					plugins: 'colorpicker',
					onchange: function(){
						colortext.value = colorpicker._color.toHex();
					}
				},
				{
					type: 'textbox',
					name: 'colortext',
					oninput: function(){
						colorpicker.value(colortext.value);
						colorpicker.renderBefore();
					}
				}
			],
			onSubmit: function(e){
				callback(e.data.dropcap_colorpicker);
			}
		});
		colortext = win._items[0]._items[1].$el[0];
		colorpicker = win._items[0]._items[0];
		var colorNow = new tinymce.util.Color(colorNow).toHex();
		colortext.value = colorNow;
		colorpicker.value(colorNow);
		colorpicker.renderBefore();
	};

	tinymce.create('tinymce.plugins.norebro', {
		init: function(ed, url) {
			ed.addButton('norebro_shortcodes', {
				type: 'menubutton',
				text: 'Insert shortcode',
				icon: false,
				extended_valid_elements: 'span',
				menu: [{
					text: 'Dropcap',
					onclick: function() {
						var color = '';
						var win = ed.windowManager.open({
							title: 'Dropcap',
							body: [
								{
									type: 'listbox',
									name: 'dropcap_type',
									label: 'Type: ',
									minWidth: 150,
									'values': [ 
										{ text: 'Simple', value: 'simple' },
										{ text: 'Outline', value: 'outline' },
										{ text: 'Flat', value: 'flat' },
										{ text: 'Decorated', value: 'decorated' },
									],
								},
								{
									type: 'button',
									name: 'dropcap_color',
									label: 'Color color:',
									id: 'norebro_dropcap_color',
									style: 'background: #333',
									onclick: function(){
										var button = this;
										norebroColorpicker(ed, 'Dropcap border color', this.$el.css('background-color'), function(value){
											button.$el.css('background', value);
											color = value;
										});
									}
								},
							],
							onSubmit: function(e){
								if( !color ) { color = '#333' }
								switch(e.data.dropcap_type){
									case 'outline':
										ed.insertContent('<span class="dropcap outline" style="border-color: '+color+';color: '+color+'">' + ed.selection.getContent() + '</span>');
										break;
									case 'flat':
										ed.insertContent('<span class="dropcap flat" style="background-color: '+color+';">' + ed.selection.getContent() + '</span>');
										break;
									case 'decorated':
										ed.insertContent('<span class="dropcap decorated" style="border-color: '+color+';color: '+color+'">' + ed.selection.getContent() + '</span>');
										break;
									default:
										ed.insertContent('<span class="dropcap" style="color: '+color+'">' + ed.selection.getContent() + '</span>');
										break;
								}
							}
						});
					}
				}, {
					text: 'Blockquote',
					onclick: function() {
						ed.windowManager.open({
							title: 'Blockquote',
							body: [
								{
									type: 'textbox',
									name: 'author_name',
									label: 'Author name:'
								}
							],
							onSubmit: function(e) {
								var content = '<blockquote>' + ed.selection.getContent();
								if ( e.data.author_name.length ) {
									content += '<footer><h4>- ' + e.data.author_name + '</h4></footer>';
								}
								content += "</blockquote>";
								ed.insertContent(content);
							}
						});
					}
				}, {
					text: 'Hightlight',
					onclick: function() {
						var markColor = '#ffffff';
						ed.windowManager.open({
							title: 'Highlight',
							body: [
								{
									type: 'button',
									name: 'dropcap_background_color',
									label: 'Color:',
									id: 'norebro_dropcap_background_color',
									style: 'background: #ffffff',
									onclick: function(){
										var button = this;
										norebroColorpicker(ed, 'Highlight color', this.$el.css('background-color'), function(value){
											button.$el.css('background', value);
											markColor = value;
										});
									}
								}
							],
							onSubmit: function(e){
								ed.insertContent('<mark style="background: ' + markColor + '">' + ed.selection.getContent() + '</mark>');
							}
						});
					}
				}, {
					text: 'Tooltip',
					onclick: function() {
						var backgroundColor = '';
						var win = ed.windowManager.open({
							title: 'Tooltip',
							body: [
								{
									type: 'listbox',
									name: 'tooltip_position',
									label: 'Position: ',
									minWidth: 250,
									'values': [ 
										{ text: 'Left', value: 'left' },
										{ text: 'Right', value: 'right' },
										{ text: 'Top', value: 'top' },
										{ text: 'Bottom', value: 'bottom' },
									]
								},
								{
									type: 'textbox',
									name: 'tooltip_content',
									label: 'Content text: ',
									minWidth: 250
								},
								{
									type: 'button',
									name: 'dropcap_background_color',
									label: 'Background color:',
									id: 'tooltip_background',
									style: 'background: #ffffff;',
									onclick: function(){
										var button = this;
										norebroColorpicker(ed, 'Dropcap background color', this.$el.css('background-color'), function(value){
											button.$el.css('background', value);
											backgroundColor = value;
										});
									}
								},
							],
							onSubmit: function(e){
								var result = '<span class="tooltip brand-color" role="tooltip">';
								result += ed.selection.getContent();
								result += '<span class="tooltip-' + e.data.tooltip_position + ' tooltip-nowrap text-left">';
								result += '<span class="tooltip-text text-center" style="background:' + backgroundColor + '">' + e.data.tooltip_content + '</span>';
								result += '</span></span>';
								ed.insertContent(result);
							}
						});
					}
				}]
			});
		},
		content_style: "div {margin: 10px; border: 5px solid red; padding: 3px}"
	});

	// Register plugin
	tinymce.PluginManager.add('norebro', tinymce.plugins.norebro);
})();