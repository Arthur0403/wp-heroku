<?php

if ( !post_type_exists( 'portfolio' ) ) {
    return;
}

// Portfolio Carousel

$params = array(
	array(
		"type" => "checkbox",
		"class" => "hidden-label",
		"value" => engage_vc_portfolio_cats(),
		"heading" => esc_html__( "Portfolio Categories", "engage" ),
		"param_name" => "cats",
		"admin_label" => true,
		"description" => esc_html__( "Select categories to be displayed in your carousel. Leave blank for all.", "engage" )
	),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Number of posts to show", "engage" ),
		"param_name" => "posts_nr",
		"value" => "8",
		"dependency" => Array(
			"element" => "type",
			'value' => array(
				"classic"
			)
		),
		"description" => esc_html__( "This is a total number of posts in the carousel.", "engage" )
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__( "Columns", "engage" ),
		"param_name" => "cols",
		"value" => array(
			"6",
			"5",
			"4",
			"3",
			"2"
		),
		"std" => "3",
		"description" => esc_html__( "Number of columns", "engage" )
	),

	// Begin Item Related

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Item Style", "engage" ),
		"param_name" => "item_style",
		"value" => array(
			esc_html__( "With Caption", "engage" ) => "caption",
			esc_html__( "With Overlay Caption", "engage" ) => "caption_overlay",
			esc_html__( "Minimal (just image)", "engage" ) => "minimal",
		),
		"description" => esc_html__( "Choose a style of your portfolio grid items.", "engage" )
	),

	// Caption Related

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Caption Display", "engage" ),
		"param_name" => "item_caption_style",
		"value" => array(
			esc_html__( "Always Visible", "engage" ) => "visible",
			esc_html__( "Show on Hover", "engage" ) => "hover"
		),
		"description" => esc_html__( "Should caption be always displayed or show only on hover?", "engage" ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption"
			)
		)
	),

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Caption Alignment", "engage" ),
		"param_name" => "item_caption_align",
		"value" => array(
			esc_html__( "Left", "engage" ) => "left",
			esc_html__( "Center", "engage" ) => "center"
		),
		"description" => esc_html__( "Set alignment of the caption's content.", "engage" ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption"
			)
		)
	),

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Caption Content", "engage" ),
		"param_name" => "item_caption_content",
		"value" => array(
			esc_html__( "Title + Categories", "engage" ) => "title_categories",
			esc_html__( "Title", "engage" ) => "title"
		),
		"description" => esc_html__( "Choose caption content.", "engage" ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption"
			)
		)
	),

	array(
		'type' => 'checkbox',
		'heading' => esc_html__( 'Love Button', 'engage' ),
		'param_name' => 'love',
		'std' => 'yes',
		'description' => esc_html__( 'Enable the love (likes) button.', 'engage' ),
		'value' => array( esc_html__( 'Yes', 'engage' ) => 'yes' ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption"
			)
		)
	),

	array(
		'type' => 'checkbox',
		'heading' => esc_html__( 'Border?', 'engage' ),
		'param_name' => 'border',
		'std' => 'yes',
		'description' => esc_html__( 'Enable a 1px border line around the caption.', 'engage' ),
		'value' => array( esc_html__( 'Yes', 'engage' ) => 'yes' ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption"
			)
		)
	),

	// Title Style Related
	// Title Position

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Overlay Caption Position", "engage" ),
		"param_name" => "item_caption_position",
		"value" => array(
			esc_html__( "Center", "engage" ) => "center",
			esc_html__( "Bottom left", "engage" ) => "bottom_left"
		),
		"description" => esc_html__( "Choose position of the item title.", "engage" ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption_overlay"
			)
		)
	),

	// Display categories under title

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Display Categories", "engage" ),
		"param_name" => "item_caption_categories",
		"value" => array(
			esc_html__( "No", "engage" ) => "no",
			esc_html__( "Yes", "engage" ) => "yes"
		),
		"description" => esc_html__( "Display categories under the overlay caption?", "engage" ),
		'dependency' => Array(
			"element" => "item_style",
			'value' => array(
				"caption_overlay"
			)
		)
	),

	// Hover Style

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Item Hover Style", "engage" ),
		"param_name" => "item_hover_style",
		"value" => array(
			esc_html__( "Zoom + Link icons", "engage" ) => "zoom_link",
			esc_html__( "Title", "engage" ) => "title",
			esc_html__( "Title, Categories", "engage" ) => "title_categories",
			esc_html__( "Title, Zoom + Link icons", "engage" ) => "title_icons",
			esc_html__( "None", "engage" ) => "none"
		),
		"description" => esc_html__( "Choose a hover style for your portfolio grid items.", "engage" )
	),

	// Grid Item Spacing

	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Item Spacing", "engage" ),
		"param_name" => "thumb_space",
		"value" => array(
			esc_html__( "Yes", "engage" ) => "yes",
			esc_html__( "No", "engage" ) => "no",
		),
		"description" => esc_html__( "Enable spacing between carousel items.", "engage" )
	),

	// End Item Related

);

$params = array_merge( $params, engage_carousel_params() );

$params = array_merge( $params, engage_responsive_params() );

$params = array_merge( $params, engage_order_params() );

return array(
	"name" => esc_html__( "Portfolio Carousel", "engage" ),
	"base" => "portfolio_carousel",
	"class" => "font-awesome",
	"icon" => "fa-briefcase",
	"controls" => "full",
	"description" => esc_html__( "Carousel of portfolio posts", 'engage' ),
	"category" => array(
		esc_html__( "Carousels", "engage" ),
		esc_html__( "Posts", "engage" )
	),
	"params" => $params
);
