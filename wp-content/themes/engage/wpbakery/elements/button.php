<?php

// Engage Image Slider

return array(
	"name" => esc_html__( "Button", "engage" ),
	"base" => "vntd_button",
	"class" => "font-awesome vntd-element",
	"icon" => "fa-square-o",
	"category" => array( esc_html__( 'Content', 'engage' ), 'Engage' ),
	"description" => esc_html__( "Theme Button", 'engage' ),
	"params" => array(
		 array(
			"type" => "textfield",
			"heading" => esc_html__( "Button Label", "engage" ),
			"holder" => "button",
			"class" => "button",
			"param_name" => "label",
			"value" => esc_html__( "Button Text", "engage" ),
			"description" => esc_html__( "Text on the button.", "engage" )
		),
        array(
            "type" => "dropdown",
            "class" => "hidden-label",
            "heading" => esc_html__( "Button Action", "engage" ),
            "param_name" => "action",
            "value" => array(
                esc_html__( "Regular Link", "engage" ) => "link",
                esc_html__( "Open Video Lightbox", "engage" ) => "video"
            ),
            "description" => esc_html__( "Choose the click action for the button.", "engage" )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Button Video URL", "engage" ),
            "param_name" => "url_video",
            "description" => esc_html__( "Enter the URL for a lightbox video (YouTube or Vimeo only), like:", "engage" ) . ' http://www.youtube.com/watch?v=7HKoqNJtMTQ',
            'dependency' => array(
                "element" => 'action',
                'value' => 'video',
            ),
        ),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( "Button Link", "engage" ),
			"param_name" => "url",
			"description" => esc_html__( "Button link", "engage" ),
            'dependency' => array(
                "element" => 'action',
                'value' => 'link',
            )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Style", "engage" ),
			"param_name" => "style",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Theme Defaults", "engage" ) => "",
				esc_html__( "Solid", "engage" ) => "solid",
				esc_html__( "Outline", "engage" ) => "outline",
				esc_html__( "Plain Text", 'engage' ) => "text-btn"
			),
			"description" => esc_html__( "Choose a style for your button. Outline - no solid background, just border.", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Color", "engage" ),
			"param_name" => "color",
			"class" => "hidden-label",
			"value" => array_merge(
				array(
					esc_html__( "Theme Defaults", "engage" ) => "",
				),
				$colors_arr
			),
			"description" => esc_html__( "Select button color.", "engage" )
		),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Button Custom Color", "engage" ),
				"param_name" => "color_custom",
				"class" => "hidden-label",
				"description" => esc_html__( "Choose a custom color for your button.", "engage" ),
				"dependency" => Array(
					"element" => "color",
					'value' => array(
						'custom'
					)
				)
			),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Hover Color", "engage" ),
			"param_name" => "color_hover",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Theme Defaults", "engage" ) => "",
				esc_html__( "Accent", "engage" ) => "accent",
				esc_html__( "Dark", "engage" ) => "dark",
				esc_html__( "Lower Opacity", "engage" ) => "opacity",
				esc_html__( "White", "engage" ) => "white",
				esc_html__( "Same as default", "engage" ) => "original"
			),
			"dependency" => Array(
				"element" => "style",
				'value' => array( 'solid', '', 'outline' )
			),
			"description" => esc_html__( "Select button hover color/style.", "engage" )
		),

			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Button Text Color", "engage" ),
				"param_name" => "color_text",
				"class" => "hidden-label",
				"value" => array(
					esc_html__( "Same as button", "engage" ) => "default",
					esc_html__( "Dark", "engage" ) => "dark",
				),
				"dependency" => Array(
					"element" => "style",
					'value' => array( 'outline', '' )
				),
				"description" => esc_html__( "Choose button text color.", "engage" )
			),

			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Button Shadow", "engage" ),
				"param_name" => "shadow",
				"class" => "hidden-label",
				"description" => esc_html__( "Delicate shadow under the button.", "engage" ),
				"value" => array(
					esc_html__( "Theme Defaults", "engage" ) => "",
					esc_html__( "Yes", "engage" ) => "yes",
					esc_html__( "No", "engage" ) => "no"
				),
				"dependency" => Array(
					"element" => "style",
					'value' => array( 'solid', '' )
				)
			),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Size", "engage" ),
			"param_name" => "size",
			"class" => "hidden-label",
			"std" => "",
			"value" => array(
				esc_html__( "Theme Defaults", "engage" ) => "",
				esc_html__( "Small", "engage" ) => "small",
				esc_html__( "Medium", "engage" ) => "medium",
				esc_html__( "Large", "engage" ) => "large",
				esc_html__( "Extra Large", "engage" ) => "xlarge",
				esc_html__( "XLarge Fullwidth", "engage" ) => "fullwidth"
			),
			"dependency" => Array(
				"element" => "style",
				'value' => array( 'solid', '', 'outline' )
			),
			"description" => esc_html__( "Button size.", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Border Radius", "engage" ),
			"param_name" => "border_radius",
			"value" => array(
				esc_html__( "Theme Defaults", "engage" ) => "",
				esc_html__( "Default", "engage" ) => "default",
				esc_html__( "Circle", "engage" ) => "circle",
				esc_html__( "Square (no radius)", "engage" ) => "square",
			),
			"dependency" => Array(
				"element" => "style",
				'value' => array( 'solid', '' )
			),
			"description" => esc_html__( "Button border radius. Rounded corners.", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Align", "engage" ),
			"param_name" => "align",
			"value" => array(
				esc_html__( "Left", "engage" ) => "left",
				esc_html__( "Center", "engage" ) => "center",
				esc_html__( "Right", "engage" ) => "right"
			),
			"description" => esc_html__( "Choose alignment of the button.", "engage" )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Display", "engage" ),
			"param_name" => "display",
			"value" => array(
				esc_html__( "Block", "engage" ) => "block",
				esc_html__( "Inline", "engage" ) => "inline"
			),
			"description" => esc_html__( "Choose button\'s display. Use inline to display buttons one next to each other", "engage" )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Icon?", "engage" ),
			"param_name" => "icon_enabled",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Enable icon", "engage" ) => "yes",
			),
			"description" => esc_html__( "Enable icon for the button.", "engage" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', "engage" ),
			'value' => array(
				esc_html__( 'Font Awesome', "engage" ) => 'fontawesome',
				esc_html__( 'Open Iconic', "engage" ) => 'openiconic',
				esc_html__( 'Typicons', "engage" ) => 'typicons',
				esc_html__( 'Entypo', "engage" ) => 'entypo',
				esc_html__( 'Linecons', "engage" ) => 'linecons',
				esc_html__( 'Pixel', "engage" ) => 'pixelicons'
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', "engage" )
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', "engage" ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200 // default 100, how many icons per/page to display
			),
			'dependency' => array(
				"element" => 'icon_type',
				'value' => 'fontawesome'
			),
			'description' => esc_html__( 'Select icon from library.', "engage" )
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', "engage" ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200 // default 100, how many icons per/page to display
			),
			'dependency' => array(
				"element" => 'icon_type',
				'value' => 'openiconic'
			),
			'description' => esc_html__( 'Select icon from library.', "engage" )
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', "engage" ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200 // default 100, how many icons per/page to display
			),
			'dependency' => array(
				"element" => 'icon_type',
				'value' => 'typicons'
			),
			'description' => esc_html__( 'Select icon from library.', "engage" )
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', "engage" ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300 // default 100, how many icons per/page to display
			),
			'dependency' => array(
				"element" => 'icon_type',
				'value' => 'entypo'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', "engage" ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200 // default 100, how many icons per/page to display
			),
			'dependency' => array(
				"element" => 'icon_type',
				'value' => 'linecons'
			),
			'description' => esc_html__( 'Select icon from library.', "engage" )
		),
//			array(
//				'type' => 'iconpicker',
//				'heading' => esc_html__( 'Icon', "engage" ),
//				'param_name' => 'icon_pixelicons',
//				'settings' => array(
//					'emptyIcon' => false, // default true, display an "EMPTY" icon?
//					'type' => 'pixelicons',
//					'source' => $pixel_icons
//				),
//				'dependency' => array(
//					"element" => 'icon_type',
//					'value' => 'pixelicons'
//				),
//				'description' => esc_html__( 'Select icon from library.', "engage" )
//			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Icon Style", "engage" ),
				"param_name" => "icon_style",
				"class" => "hidden-label",
				"std" => "solid-btn",
				"value" => array(
					esc_html__( "Right side", "engage" ) => "right_side",
					esc_html__( "Slide from right on hover", "engage" ) => "right_side_hover",
				),
				"dependency" => array(
					"element" => 'icon_enabled',
					'value' => 'yes'
				),
				"description" => esc_html__( "Choose a display style for your button's icon.", "engage" )
			),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Text Transform", "engage" ),
			"param_name" => "text_transform",
			"value" => array(
				esc_html__( "Uppercase", "engage" ) => "uppercase",
				esc_html__( "None", "engage" ) => "none"
			),
			"description" => esc_html__( "Button label text transform.", "engage" )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Margin Top", "engage" ),
			"param_name" => "margin_top",
			"description" => esc_html__( "Change button's top margin value. Default value: 0px", "engage" ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Margin Bottom", "engage" ),
			"param_name" => "margin_bottom",
			"description" => esc_html__( "Change button's bottom margin value. Default value: 20px", "engage" ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', "engage" ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', "engage" )
		)
	)
);
