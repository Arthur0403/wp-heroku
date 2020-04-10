<?php

// Icon Box

return array(
	"name" => esc_html__( "Icon Box", "engage" ),
	"base" => "icon_box",
	"class" => "font-awesome",
	"icon" => "fa-check-circle-o",
	"controls" => "full",
	"category" => esc_html__( 'Content', 'engage' ),
	"description" => esc_html__( "Text with an icon", 'engage' ),
	"params" => array_merge(
		array(
			 array(
				"type" => "textfield",
				"class" => "hidden-label",
				"heading" => esc_html__( "Title", "engage" ),
				"description" => esc_html__( "The title of your icon box.", "engage" ),
				"param_name" => "title",
				"holder" => "h4",
				"value" => 'Icon Box Title'
			),
			array(
				"type" => "textarea",
				"class" => "hidden-label",
				"heading" => esc_html__( "Text Content", "engage" ),
				"description" => esc_html__( "Description text of the icon box.", "engage" ),
				"param_name" => "text",
				"holder" => "span",
				"value" => 'Icon Box text content, feel free to change it!'
			),
			array(
				"type" => "dropdown",
				"class" => "hidden-label",
				"heading" => esc_html__( "Style", "engage" ),
				"description" => esc_html__( "Choose a style for your icon box.", "engage" ),
				"param_name" => "style",
				"value" => array(
					esc_html__( 'Top Icon Circle Outline', "engage" ) => 'centered-outline',
					esc_html__( 'Top Icon Circle', "engage" ) => 'centered-circle',
					esc_html__( 'Top Icon Basic', "engage" ) => 'centered-basic',
					esc_html__( 'Aligned Left, Basic', "engage" ) => 'aligned-left-basic',
					esc_html__( 'Aligned Left, Circle', "engage" ) => 'aligned-left-circle',
					esc_html__( 'Aligned Left, Circle Outline', "engage" ) => 'aligned-left-outline',
					esc_html__( 'Aligned Right, Basic', "engage" ) => 'aligned-right-basic',
					esc_html__( 'Aligned Right, Circle', "engage" ) => 'aligned-right-circle',
					esc_html__( 'Aligned Right, Circle Outline', "engage" ) => 'aligned-right-outline',
					esc_html__( 'Centered Boxed', "engage" ) => 'centered-boxed',
				)
			),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Icon Alignment", "engage" ),
					"param_name" => "icon_align",
					"value" => array(
						esc_html__( "Theme Defaults", "engage" ) => "",
						esc_html__( "Left", "engage" ) => "left",
						esc_html__( "Center", "engage" ) => "center",
						esc_html__( "Right", "engage" ) => "right"
					),
					"description" => esc_html__( "Specify alignment of the big icon.", "engage" ),
					"dependency" => Array(
						"element" => "style",
						'value' => array(
							'centered-outline',
							'centered-circle',
							'centered-basic',
						)
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Icon Size", "engage" ),
					"param_name" => "icon_size",
					"value" => array(
						esc_html__( "Theme Defaults", "engage" ) => "",
						esc_html__( "Small", "engage" ) => "sm",
						esc_html__( "Medium", "engage" ) => "md",
						esc_html__( "Large", "engage" ) => "lg"
					),
					"description" => esc_html__( "Specify size of the icon.", "engage" ),
					"dependency" => Array(
						"element" => "style",
						'value' => array(
							'centered-outline',
							'centered-circle',
							'centered-basic',
						)
					)
				),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Icon Color", "engage" ),
				"param_name" => "color",
				"value" => array(
					esc_html__( "Theme Defaults", "engage" ) => "",
					esc_html__( "Accent Color", "engage" ) => "accent",
					esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
					esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
					esc_html__( "White", 'engage' ) => 'white',
					esc_html__( "Grey", "engage" ) => "grey",
					esc_html__( "Dark", "engage" ) => "dark",
					esc_html__( "Custom", "engage" ) => "custom"
				),
				"description" => esc_html__( "Choose a color for your icon box.", "engage" ),
			),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__( "Icon Box Custom Color", "engage" ),
					"param_name" => "color_custom",
					"class" => "hidden-label",
					"description" => esc_html__( "Choose a custom color for your icon.", "engage" ),
					"value" => '',
					"dependency" => array(
						"element" => "color",
						'value' => array(
							'custom'
						)
					)
				),
		),
		engage_vc_icon_params( false ),
		array(
			array(
				"type" => "textfield",
				"heading" => esc_html__( "URL (Link)", "engage" ),
				"param_name" => "url",
				"description" => esc_html__( "Optional icon link.", "engage" )
			),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Link Text Label", "engage" ),
					"description" => esc_html__( "Optional label that will represent a hyperlink in your icon box. Displayed below the description text.", "engage" ) ,
					"param_name" => "link_label",
					"value" => '',
					"dependency" => Array(
						"element" => "url",
						'not_empty' => true
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Target", "engage" ),
					"param_name" => "target",
					"value" => $target_arr,
					"dependency" => Array(
						"element" => "url",
						'not_empty' => true
					)
				),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Margin Bottom", "engage" ),
				"param_name" => "c_margin_bottom",
				"description" => esc_html__( "Icon box bottom margin. Leave blank for defaults.", "engage" ),
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Animated", "engage" ),
				"param_name" => "animated",
				"value" => array(
					esc_html__( "No", "engage" ) => "no",
					esc_html__( "Yes", "engage" ) => "yes"
				),
				"description" => esc_html__( "Enable the element fade in animation on scroll", "engage" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Animation Delay", "engage" ),
				"param_name" => "animation_delay",
				"value" => '100',
				"description" => esc_html__( "Fade in animation delay. Can be used to create a nice delay effect if multiple elements of same type.", "engage" ),
				"dependency" => Array(
					"element" => "animated",
					'value' => 'yes'
				)
			),

			// Background

			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Add background?", "engage" ),
				"param_name" => "bg",
				"value" => array(
					esc_html__( "No", "engage" ) => "no",
					esc_html__( "Yes", "engage" ) => "yes"
				),
				"description" => esc_html__( "Add a background to the icon box.", "engage" ),
				"group" => esc_html__( "Advanced", "engage" )
			),

			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background Color", "engage" ),
				"param_name" => "bg_color",
				"value" => array(
					esc_html__( "Theme Defaults", "engage" ) => "",
					esc_html__( "Accent Color", "engage" ) => "accent",
					esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
					esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
					esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
					esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
					esc_html__( "Predefined Background 1", 'engage' ) => '1',
					esc_html__( "Predefined Background 2", 'engage' ) => '2',
					esc_html__( "Custom color", "engage" ) => "custom"
				),
				"dependency" => Array(
					"element" => "bg",
					'value' => 'yes'
				),
				"description" => esc_html__( "Choose a background color.", "engage" ),
				"group" => esc_html__( "Advanced", "engage" )
			),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Background Color", "engage" ),
				"param_name" => "bg_color_custom",
				"class" => "hidden-label",
				"description" => esc_html__( "Choose a custom background color.", "engage" ),
				"value" => '',
				"dependency" => Array(
					"element" => "bg_color",
					'value' => 'custom'
				),
				"group" => esc_html__( "Advanced", "engage" )
			),

			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Text Color Scheme", "engage" ),
				"param_name" => "color_scheme",
				"value" => array(
					esc_html__( "Theme Defaults", 'engage' ) => "",
					esc_html__( "White Scheme", 'engage' ) => "white",
					esc_html__( "Dark Scheme", 'engage' ) => "dark"
				),
				"description" => esc_html__( "White Scheme - all texts styled to white color, recommended for dark backgrounds.", "engage" ),
				"group" => esc_html__( "Advanced", "engage" )
			),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Heading Custom Color", "engage" ),
				"param_name" => "color_heading",
				"class" => "hidden-label",
				"description" => esc_html__( "Choose a custom heading color.", "engage" ),
				"value" => '',
				"group" => esc_html__( "Advanced", "engage" )
			),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Text Custom Color", "engage" ),
				"param_name" => "color_text",
				"class" => "hidden-label",
				"description" => esc_html__( "Choose a custom text color.", "engage" ),
				"value" => '',
				"group" => esc_html__( "Advanced", "engage" )
			),
		)
	)
);
