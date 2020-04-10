<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Call to action
 * @since 4.5
 */

require_once vc_path_dir( 'CONFIG_DIR', 'content/vc-custom-heading-element.php' );

// Since VC 6.0.1
if ( function_exists( 'vc_get_shared' ) ) {
	$vc_shared_text_align = vc_get_shared( 'text align' );
} else {
	$vc_shared_text_align = getVcShared( 'text align' );
}

$params = array_merge( array(
	array(
		'type' => 'attach_image',
		'heading' => esc_html__( 'Background Image', 'engage' ),
		'param_name' => 'image',
		'value' => '',
		'description' => esc_html__( 'Select image from media library.', 'engage' ),
		'admin_label' => true,
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => esc_html__( "Background Image Overlay", 'engage' ),
		"param_name" => "bg_overlay",
		"value" => $bg_overlay_arr,
		'dependency' => array(
			'element' => 'image',
			'not_empty' => true,
		),
		"description" => esc_html__( "Set a background overlay to darken or lighten the background image and improve the text visibility.", "engage" )
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Background Color', 'engage' ),
		'param_name' => 'main_bg_color',
		'value' => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Accent Color", 'engage' ) => 'accent',
			esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
			esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
			esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
			esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
			esc_html__( "Predefined Background 1", 'engage' ) => '1',
			esc_html__( "Predefined Background 2", 'engage' ) => '2',
			esc_html__( "Custom", 'engage' ) => 'custom',
		),
		'description' => esc_html__( 'Select the box background color.', 'engage' ),
	),
	array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Custom Background Color', 'engage' ),
		'param_name' => 'main_bg_color_custom',
		'description' => esc_html__( 'Select a custom box background color.', 'engage' ),
		'dependency' => array(
			'element' => 'main_bg_color',
			'value' => array( 'custom' ),
		),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Primary title', 'engage' ),
		'admin_label' => true,
		'param_name' => 'primary_title',
		'value' => esc_html__( 'Hover Box Element', 'engage' ),
		'description' => esc_html__( 'Enter text for heading line.', 'engage' ),
		'edit_field_class' => 'vc_col-sm-9',
	),
),
//$h2_custom_heading,
array(
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Hover title', 'engage' ),
		'param_name' => 'hover_title',
		'value' => 'Hover Box Element',
		'description' => esc_html__( 'Hover Box Element', 'engage' ),
		'group' => esc_html__( 'Hover Block', 'engage' ),
		'edit_field_class' => 'vc_col-sm-9',
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Hover title alignment', 'engage' ),
		'param_name' => 'hover_align',
		'value' => $vc_shared_text_align,
		'std' => 'center',
		'group' => esc_html__( 'Hover Block', 'engage' ),
		'description' => esc_html__( 'Select text alignment for hovered title.', 'engage' ),
	),
	array(
		'type' => 'textarea_html',
		'heading' => esc_html__( 'Hover text', 'engage' ),
		'param_name' => 'content',
		'value' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'engage' ),
		'group' => esc_html__( 'Hover Block', 'engage' ),
		'description' => esc_html__( 'Hover part text.', 'engage' ),
	),
),
array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => esc_html__( "Front Box Color Scheme", "engage" ),
		"param_name" => "color_scheme",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => "",
			esc_html__( "White Scheme", 'engage' ) => "white",
			esc_html__( "Dark Scheme", 'engage' ) => "dark"
		),
		"description" => esc_html__( "White Scheme - all text styled to white color, recommended for dark backgrounds.", "engage" ),
		"group" => esc_html__( "Front Styling", 'engage' )
	),
	array(
		"type" => "colorpicker",
		"heading" => esc_html__( "Primary title color", "engage" ),
		"param_name" => "primary_color",
		"class" => "hidden-label",
		"description" => esc_html__( "Choose your primary title font color.", "engage" ),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Heading Font Size', 'engage' ),
		'param_name' => 'primary_fs',
		'value' => '',
		'description' => esc_html__( 'Enter the Primary Title font size in pixels, like: 16px or 20px', 'engage' ),
		'group' => esc_html__( 'Front Styling', 'engage' ),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Heading Line Height', 'engage' ),
		'param_name' => 'primary_lh',
		'value' => '',
		'description' => esc_html__( 'Enter the Primary Title line height in pixels, like: 16px or 20px', 'engage' ),
		'group' => esc_html__( 'Front Styling', 'engage' ),
	),
),
array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => esc_html__( "Hover State Color Scheme", "engage" ),
		"param_name" => "hover_color_scheme",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => "",
			esc_html__( "White Scheme", 'engage' ) => "white",
			esc_html__( "Dark Scheme", 'engage' ) => "dark"
		),
		"description" => esc_html__( "White Scheme - all text styled to white color, recommended for dark backgrounds.", "engage" ),
		"group" => esc_html__( "Hover Styling", 'engage' )
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Heading Font Size', 'engage' ),
		'param_name' => 'hover_fs',
		'value' => '',
		'description' => esc_html__( 'Enter the Hover Title font size in pixels, like: 16px or 20px', 'engage' ),
		'group' => esc_html__( 'Hover Styling', 'engage' ),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Heading Line Height', 'engage' ),
		'param_name' => 'hover_lh',
		'value' => '',
		'description' => esc_html__( 'Enter the Hover Title line height in pixels, like: 16px or 20px', 'engage' ),
		'group' => esc_html__( 'Hover Styling', 'engage' ),
	),
	array(
		"type" => "colorpicker",
		"heading" => esc_html__( "Hover title color", "engage" ),
		"param_name" => "hover_color",
		"class" => "hidden-label",
		"description" => esc_html__( "Choose your hover title font color.", "engage" ),
		'group' => esc_html__( 'Hover Styling', 'engage' ),
	),
),
array(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Shape', 'engage' ),
		'param_name' => 'shape',
		'std' => 'rounded',
		'value' => array(
			__( 'Theme Defaults', 'engage' ) => '',
			__( 'Square', 'engage' ) => 'square',
			__( 'Rounded', 'engage' ) => 'rounded',
			__( 'Round', 'engage' ) => 'round',
		),
		'description' => esc_html__( 'Select block shape.', 'engage' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Hover Background Color', 'engage' ),
		'param_name' => 'hover_background_color',
		'value' => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Accent Color", 'engage' ) => 'accent',
			esc_html__( "Accent Color 2", 'engage' ) => 'accent-2',
			esc_html__( "Accent Color 3", 'engage' ) => 'accent-3',
			esc_html__( "Predefined Gradient 1", 'engage' ) => 'gradient-1',
			esc_html__( "Predefined Gradient 2", 'engage' ) => 'gradient-2',
			esc_html__( "Predefined Background 1", 'engage' ) => '1',
			esc_html__( "Predefined Background 2", 'engage' ) => '2',
			esc_html__( "Custom", 'engage' ) => 'custom',
		),
		'description' => esc_html__( 'Select color schema.', 'engage' ),
		'group' => esc_html__( 'Hover Block', 'engage' ),
	),
	array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Background color', 'engage' ),
		'param_name' => 'hover_custom_background',
		'description' => esc_html__( 'Select custom background color.', 'engage' ),
		'group' => esc_html__( 'Hover Block', 'engage' ),
		'dependency' => array(
			'element' => 'hover_background_color',
			'value' => array( 'custom' ),
		),
		'edit_field_class' => 'vc_col-sm-6',
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Width', 'engage' ),
		'param_name' => 'el_width',
		'value' => array(
			'100%' => '100',
			'90%' => '90',
			'80%' => '80',
			'70%' => '70',
			'60%' => '60',
			'50%' => '50',
			'40%' => '40',
			'30%' => '30',
			'20%' => '20',
			'10%' => '10',
		),
		'description' => esc_html__( 'Select block width (percentage).', 'engage' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Alignment', 'engage' ),
		'param_name' => 'align',
		'description' => esc_html__( 'Select block alignment.', 'engage' ),
		'value' => array(
			__( 'Left', 'engage' ) => 'left',
			__( 'Right', 'engage' ) => 'right',
			__( 'Center', 'engage' ) => 'center',
		),
		'std' => 'center',
	),
	array(
		"type" => "checkbox",
		"heading" => esc_html__( "Add Icon?", "engage" ),
		"param_name" => "add_icon",
		"class" => "hidden-label",
		"value" => array(
			esc_html__( "Yes", "engage" ) => "true",
		),
		"description" => esc_html__( "Display icon above the special heading.", "engage" )
	),
),
engage_vc_icon_params( 'add_icon' ),
array(
	array(
		'type' => 'checkbox',
		'heading' => esc_html__( 'Reverse blocks', 'engage' ),
		'param_name' => 'reverse',
		'description' => esc_html__( 'Reverse hover and primary block.', 'engage' ),
	),
	vc_map_add_css_animation(),
	array(
		'type' => 'el_id',
		'heading' => esc_html__( 'Element ID', 'engage' ),
		'param_name' => 'el_id',
		'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'engage' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Extra class name', 'engage' ),
		'param_name' => 'el_class',
		'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'engage' ),
	),
	array(
		'type' => 'css_editor',
		'heading' => esc_html__( 'CSS box', 'engage' ),
		'param_name' => 'css',
		'group' => esc_html__( 'Design Options', 'engage' ),
	),
) );

return array(
	'name' => esc_html__( 'Flip Box', 'engage' ),
	'base' => 'engage_flip_box',
	'icon' => 'vc_icon-vc-hoverbox',
	'category' => array( esc_html__( 'Content', 'engage' ) ),
	'description' => esc_html__( 'Animated flip box with image and text.', 'engage' ),
	'params' => $params,
);
