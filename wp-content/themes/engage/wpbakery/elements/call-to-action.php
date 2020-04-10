<?php

// Engage Image Slider

return array(
	"name" => esc_html__( "Call to Action", "engage" ),
	"base" => "cta",
	"class" => "",
	"icon" => "icon-wpb-call-to-action",
	"controls" => "edit_popup_delete",
	"category" => esc_html__( 'Content', 'engage' ),
	"description" => esc_html__( "Heading text with buttons", 'engage' ),
	"params" => array(
		 array(
			"type" => "textarea",
			"heading" => esc_html__( "Heading", "engage" ),
			"param_name" => "heading",
			"value" => esc_html__( "This is the main heading.", 'engage' ),
			"description" => esc_html__( "Enter your Call to Action Heading", "engage" ),
			"admin_label" => true
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__( "Subtitle", "engage" ),
			"param_name" => "subheading",
			"value" => esc_html__( "I'm a subtitle, feel free to change me!", 'engage' ),
			"description" => esc_html__( "A description text of your Call to Action element.", "engage" ),
			"admin_label" => true
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button Title", "engage" ),
			"param_name" => "button1_title",
			"description" => esc_html__( "Enter label for the button.", "engage" ),
			"value" => esc_html__( "Click me!", 'engage' ),
			"admin_label" => true
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( "Button Link", "engage" ),
			"param_name" => "button1_url",
			"description" => esc_html__( "URL for the button.", "engage" ),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button 2 Title", "engage" ),
			"param_name" => "button2_title",
			"description" => esc_html__( "Enter label for the secondary button.", "engage" ),
			"admin_label" => true
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( "Button 2 Link", "engage" ),
			"param_name" => "button2_url",
			"description" => esc_html__( "URL for the button.", "engage" ),
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Contain in grid", "engage" ) => 'contain',
				esc_html__( "Stretch to row size", "engage" ) => 'stretch',
			),
			"std" => "accent",
			"heading" => esc_html__( "Container", "engage" ),
			"param_name" => "container",
			"description" => esc_html__( "Use 'stretch' type if you want the CTA area to stretch to the width of the row (i.e. when the row is fully stretched to browser window sides).", "engage" ),
		),
//			array(
//				"type" => "textfield",
//				"heading" => esc_html__( "Button 2 Title", "engage" ),
//				"param_name" => "button2_title",
//				"description" => esc_html__( "Enter the title for the second button.", "engage" ),
//				"value" => ""
//			),
//			array(
//				"type" => "textfield",
//				"heading" => esc_html__( "Button 2 Link", "engage" ),
//				"param_name" => "button2_url",
//				"description" => esc_html__( "Enter the URL for your second button.", "engage" ),
//				"dependency" => Array(
//					"element" => "button2_title",
//					'not_empty' => true
//				),
//				"value" => "http://"
//			),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Left", "engage" ) => 'left',
				esc_html__( "Center", "engage" ) => 'center',
			),
			"heading" => esc_html__( "Alignment", "engage" ),
			"param_name" => "align",
			"description" => esc_html__( "Choose the content alignment.", "engage" ),
			"group" => esc_html__( "Design", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "White", "engage" ) => 'white',
				esc_html__( "Dark", "engage" ) => 'dark',
			),
			"heading" => esc_html__( "Text color", "engage" ),
			"param_name" => "text_color",
			"description" => esc_html__( "Select text color.", "engage" ),
			"group" => esc_html__( "Design", "engage" )
		),
		array(
			"heading" => esc_html__( "Button 1 Color", "engage" ),
			"description" => esc_html__( 'Color of your Call to Action button.', "engage" ),
			"param_name" => "button1_color",
			"group" => esc_html__( "Design", "engage" ) ,
			"type" => "dropdown",
			"class" => "hidden-label",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "White", "engage" ) => 'white',
				esc_html__( "Accent", "engage" ) => 'accent',
				esc_html__( "Accent 2", "engage" ) => 'accent2',
				esc_html__( "Accent 3", "engage" ) => 'accent3',
				esc_html__( "Dark", "engage" ) => 'dark'
			),
			"std" => 'accent2',
			"dependency" => Array(
				"element" => "button1_title",
				'not_empty' => true
			),
		),
		array(
			"heading" => esc_html__( "Button 1 Style", "engage" ),
			"description" => esc_html__( 'Choose a style for the primary button.', "engage" ),
			"param_name" => "button1_style",
			"group" => esc_html__( "Design", "engage" ) ,
			"type" => "dropdown",
			"class" => "hidden-label",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "Outline", "engage" ) => 'outline',
				esc_html__( "Solid", "engage" ) => 'solid',
			),
			"dependency" => Array(
				"element" => "button1_title",
				'not_empty' => true
			),
		),
		array(
			"heading" => esc_html__( "Button 2 Color", "engage" ),
			"description" => esc_html__( 'Color of your Call to Action secondary button.', "engage" ),
			"param_name" => "button2_color",
			"group" => esc_html__( "Design", "engage" ) ,
			"type" => "dropdown",
			"class" => "hidden-label",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "White", "engage" ) => 'white',
				esc_html__( "Accent", "engage" ) => 'accent',
				esc_html__( "Accent 2", "engage" ) => 'accent2',
				esc_html__( "Accent 3", "engage" ) => 'accent3',
				esc_html__( "Dark", "engage" ) => 'dark'
			),
			"dependency" => Array(
				"element" => "button2_title",
				'not_empty' => true
			),
		),
		array(
			"heading" => esc_html__( "Button 2 Style", "engage" ),
			"description" => esc_html__( 'Choose a style for the secondary button.', "engage" ),
			"param_name" => "button2_style",
			"group" => esc_html__( "Design", "engage" ) ,
			"type" => "dropdown",
			"class" => "hidden-label",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "Solid", "engage" ) => 'solid',
				esc_html__( "Outline", "engage" ) => 'outline',
			),
			"dependency" => Array(
				"element" => "button2_title",
				'not_empty' => true
			),
		),
		array(
		   "type" => "dropdown",
		   "class" => "hidden-label",
		   "heading" => esc_html__( "Button Border Radius", "engage" ),
		   "param_name" => "btn_radius",
		   "value" => array(
		   	esc_html__( "Default", "engage" ) => "default",
		   	esc_html__( "Circle", "engage" ) => "circle",
		   	esc_html__( "Square (no radius)", "engage" ) => "square",
		   ),
		   	'group' => esc_html__( "Design", "engage" )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Accent", 'engage' ) => 'accent',
				esc_html__( "Accent Color", 'engage' ) => 'accent',
				esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
				esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
				esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
				esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
				esc_html__( "Dark", 'engage' ) => 'dark',
				esc_html__( "Light", 'engage' ) => 'light',
				esc_html__( "None (you can set the background in the row settings)", 'engage' ) => 'none',
				esc_html__( "Custom - color picker", 'engage' ) => 'custom'
			),
			"heading" => esc_html__( "Background color", "engage" ),
			"param_name" => "el_bg",
			"description" => esc_html__( "Select text color. Leave blank for default", "engage" ),
			"group" => esc_html__( "Design", "engage" )
		),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Custom Background Color", "engage" ),
				"param_name" => "bg_color_custom",
				"value" => '',
				"dependency" => Array( 'element' => "el_bg", 'value' => array( "custom" ) ),
				"description" => esc_html__( "Select a custom color for your background.", "engage" ),
				"group" => esc_html__( "Design", "engage" )
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Custom Background Color 2", "engage" ),
				"param_name" => "bg_color_custom2",
				"value" => '',
				"dependency" => Array( 'element' => "el_bg", 'value' => array( "custom" ) ),
				"description" => esc_html__( "Choose a secondary color to create a beautiful gradient.", "engage" ),
				"group" => esc_html__( "Design", "engage" )
			),
        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Button 1 CSS Class', "engage" ),
			'param_name' => 'btn1_class',
			"dependency" => Array(
				"element" => "button1_title",
				'not_empty' => true
			),
			"group" => esc_html__( "Advanced", "engage" ),
			"description" => esc_html__( "Optional: add a custom CSS class to the first button.", "engage" )
		),
        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Button 2 CSS Class', "engage" ),
			'param_name' => 'btn2_class',
			"dependency" => Array(
				"element" => "button1_title",
				'not_empty' => true
			),
			"group" => esc_html__( "Advanced", "engage" ),
			"description" => esc_html__( "Optional: add a custom CSS class to the second button.", "engage" )
		),


	)
);
