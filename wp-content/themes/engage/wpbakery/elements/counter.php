<?php

// Engage Image Slider

return array(
	"name" => esc_html__( "Counter", "engage" ),
	"base" => "counter",
	"class" => "font-awesome",
	"icon" => "fa-clock-o",
	"category" => esc_html__( 'Content', 'engage' ),
	"description" => esc_html__( "Countdown numbers", 'engage' ),
	"params" => array(
		 array(
			"type" => "textfield",
			"heading" => esc_html__( "Counter Title", "engage" ),
			"param_name" => "title",
			"description" => esc_html__( "Your Counter title.", "engage" ),
			"value" => "Days",
			"admin_label" => true
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Number value", "engage" ),
			"param_name" => "number",
			"description" => esc_html__( "Value of the counter number.", "engage" ),
			"value" => "100",
			"admin_label" => true
		),
		array(
		   "type" => "dropdown",
			"class" => "hidden-label",
			"value" => array(
				esc_html__( "Dark", "engage" ) => 'dark',
				esc_html__( "White", "engage" ) => 'white',
				esc_html__( "Accent", "engage" ) => 'accent',
				esc_html__( "Custom", "engage" ) => 'custom'
			),
		   "heading" => esc_html__( "Counter Color", 'engage' ),
		   "param_name" => "color",
		   "description" => esc_html__( "Choose counter color.", 'engage'),
		),
		array(
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Counter Color", 'engage' ),
		   "param_name" => "color_custom",
		   "value" => '',
		   "dependency" => Array('element' => "color", 'value' => array("custom")),
		   "description" => esc_html__( "Select a custom color for the counter's icon and text.", 'engage'),
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'add_icon',
			'std' => 'true',
			'heading' => esc_html__( 'Enable icon?', 'engage' ),
			'description' => esc_html__( 'Enable icon in the counter.', 'engage' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'engage' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'engage' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'engage' ) => 'openiconic',
				esc_html__( 'Typicons', 'engage' ) => 'typicons',
				esc_html__( 'Entypo', 'engage' ) => 'entypo',
				esc_html__( 'Linecons', 'engage' ) => 'linecons',
				esc_html__( 'Pixel', 'engage' ) => 'pixelicons',
			),
			'param_name' => 'icon_type',
			'dependency' => array(
				'element' => 'add_icon',
				'value' => 'true',
			),
			'description' => esc_html__( 'Select icon library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_fontawesome',
		    'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
			'element' => 'icon_type',
			'value' => 'typicons',
		),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		)

	)
);
