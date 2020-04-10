/*
* ---------------------------------------------------------------- 
*  Veented TinyMCE Quick Shortcodes Button
* ----------------------------------------------------------------  
*/

(function() {
	// Load plugin specific language pack

	tinymce.create('tinymce.plugins.vntdtinymce', {


		init : function(ed, url) {
			
			vntd_url = url;
			
			ed.addButton('veented_shortcodes_button', {
				type: 'splitbutton',
				title : 'Add Custom Shortcode',
				tooltip: 'Quick Shortcodes',
				cmd : 'mcepshortcodes',
				onclick: function() {
	                ed.insertContent('Main button');
	            },
	            menu: [
	            {
	            	text: 'Buttons',
	            	menu: [
	            	{
	            	    text: 'Large Button',
	            	    onclick: function(){
	            	        ed.insertContent('[vntd_button label="Button text" url="#" color="accent, white, green, orange, red, blue, light-blue, dark, black" size="large"]');
	            	    }
	            	},	            	
	            	{
	            	    text: 'Standard Button',
	            	    onclick: function(){
	            	        ed.insertContent('[vntd_button label="Button text" url="#" color="accent, white, green, orange, red, blue, light-blue, dark, black" style="default, stroke, 3d, gradient"]');
	            	    }
	            	},
	            	{
	            	    text: 'Small Button',
	            	    onclick: function(){
	            	        ed.insertContent('[vntd_button label="Button text" url="#" color="accent, white, green, orange, red, blue, light-blue, dark, black" size="small"]');
	            	    }
	            	},
	            	]                	
	            
	            },
                {
                	text: 'Separators',
                	menu: [
                	{
                	    text: 'Line Separator',
                	    onclick: function(){
                	        ed.insertContent('[separator]');
                	    }
                	},
                	{
                	    text: 'Separator with Text Label',
                	    onclick: function(){
                	        ed.insertContent('[separator label="Your Text" align="center"]');
                	    }
                	},
                	{
                	    text: 'White Space',
                	    onclick: function(){
                	        ed.insertContent('[spacer height="40"]');
                	    }
                	}
                	]                	
                
                },
                {
                    text: 'Dropcaps',
                    menu: [
                    {
                        text: 'Dropcap',
                        onclick: function(){
                            ed.insertContent('[dropcap]D[/dropcap]');
                        }
                    },
                    {
                        text: 'Dropcap Circle',
                        onclick: function(){
                            ed.insertContent('[dropcap style="circle"]D[/dropcap]');
                        }
                    },
                    {
                        text: 'Dropcap Circle Accent',
                        onclick: function(){
                            ed.insertContent('[dropcap style="circle" color="accent"]D[/dropcap]');
                        }
                    },
                    ]
                },
            	{
            	    text: 'Highlight',
            	    menu: [
            	    {
            	        text: 'Accent Color',
            	        onclick: function(){
            	            ed.insertContent('[highlight]Highlighted text[/highlight]');
            	        }
            	    },
            	    {
            	        text: 'Custom Color',
            	        onclick: function(){
            	            ed.insertContent('[highlight bgcolor="#363636" color="#fff"]Highlighted text[/highlight]');
            	        }
            	    }
            	    ]
            	},
            	{
            	    text: 'Icon List',
            	    menu: [
            	    {
            	        text: 'Icon List Colored',
            	        onclick: function(){
            	            ed.insertContent('[list icon="check, heart, check-square, certificate, flag, plus, square-o, heart, caret-right" color="accent"]<br/>[li]List item[/li]<br/>[li]List item[/li]<br/>[li]List item[/li]<br/>[/list]');
            	        }
            	    },
            	    {
            	        text: 'Icon List Classic',
            	        onclick: function(){
            	            ed.insertContent('[list icon="check, heart, check-square, certificate, flag, plus, square-o, heart, caret-right" color="accent" colored="no"]<br/>[li]List item[/li]<br/>[li]List item[/li]<br/>[li]List item[/li]<br/>[/list]');
            	        }
            	    }
            	    ]
                
                },                                                              
	            ],
				image : vntd_url + '/vntd_button.png'
			});
			
			ed.addMenuItem('insertValueOfMyNewDropdown', {
			        icon: 'date',
			        text: 'Do something with this new dropdown',

			        context: 'insert'
			    });
			
		},

		getInfo : function() {
			return {
				longname : 'veented_shortcodes_button',
				author : 'Veented',
				authorurl : 'http://themeforest.net/user/Veented/',
				infourl : 'http://www.tinymce.com/',
				version : "2.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('veented_shortcodes_button', tinymce.plugins.vntdtinymce);
})();