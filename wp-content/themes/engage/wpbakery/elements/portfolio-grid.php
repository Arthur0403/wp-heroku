<?php

if ( !post_type_exists( 'portfolio' ) ) {
    return;
}

// Portfolio Grid

$params = array(
	array(
		"type" => "checkbox",
		"class" => "hidden-label",
		"value" => engage_vc_portfolio_cats(),
		"heading" => esc_html__( "Portfolio Categories", "engage" ),
		"param_name" => "cats",
		"description" => esc_html__( "Select categories to be displayed in the grid. Leave blank to display all.", "engage" ) 
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
			"2",
			"1" 
		),
		"std" => "3",
		"description" => esc_html__( "Number of columns", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Item Style", "engage" ),
		"param_name" => "item_style",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
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
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Always Visible", "engage" ) => "visible",
			esc_html__( "Slide on Hover", "engage" ) => "hover" 
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
			esc_html__( "Theme Defaults", 'engage' ) => '',
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
			esc_html__( "Theme Defaults", 'engage' ) => '',
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
	
		// Grid Item Spacing
		
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Caption Border", "engage" ),
			"param_name" => "caption_border",
			"value" => array(
				esc_html__( "Theme Defaults", 'engage' ) => '',
				esc_html__( "Yes", "engage" ) => "on",
				esc_html__( "No", "engage" ) => "off" 
			),
			"description" => esc_html__( "Enable border around the caption.", "engage" ),
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
			esc_html__( "Theme Defaults", 'engage' ) => '',
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
			esc_html__( "Theme Defaults", 'engage' ) => '',
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
	
	// Grid Hover Style
	
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Item Hover Style", "engage" ),
		"param_name" => "item_hover_style",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Zoom Icon + Link Icon", "engage" ) => "zoom_link",
			esc_html__( "Title", "engage" ) => "title",
			esc_html__( "Title, Categories", "engage" ) => "title_categories",
			esc_html__( "Title, Zoom + Link icons", "engage" ) => "title_icons",
			esc_html__( "None", "engage" ) => "none" 
		),
		"description" => esc_html__( "Choose a hover style for your portfolio grid items.", "engage" ) 
	),
	
	// Image Hover Effect
	
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Item Image Hover Effect", "engage" ),
		"param_name" => "image_hover_effect",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Zoom Image", "engage" ) => "zoom",
			esc_html__( "Push Right", "engage" ) => "push_right",
			esc_html__( "None", "engage" ) => "none" 
		),
		"description" => esc_html__( "Choose a hover effect for grid images.", "engage" ) 
	),
	
	// Image Hover Overlay
	
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Item Image Hover Overlay", "engage" ),
		"param_name" => "image_hover_overlay",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Dark", "engage" ) => "dark",
			esc_html__( "Accent", "engage" ) => "accent",
			esc_html__( "None", "engage" ) => "none" 
		),
		"description" => esc_html__( "Choose a hover overlay effect for grid images.", "engage" ) 
	),
	
	// Grid Item Spacing
	
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Item Spacing", "engage" ),
		"param_name" => "thumb_space",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Yes", "engage" ) => "yes",
			esc_html__( "No", "engage" ) => "no" 
		),
		"description" => esc_html__( "Enable spacing between the grid items.", "engage" ) 
	),
	
	// Masonry
	
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Layout Type", "engage" ),
		"std" => '',
		"param_name" => "layout_type",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Grid", "engage" ) => "grid",
			esc_html__( "Masonry", "engage" ) => "masonry",
			esc_html__( "Mosaic", "engage" ) => "mosaic" 
		),
		"description" => esc_html__( "Choose a layout for your portfolio grid items: classic grid, masonry or mosaic. Mosaic: thumbnail sizes are displayed according to individual post 'Thumbnail aspect ratio' option (wide, tall, big).", "engage" ) 
	),
	
	// Pagination / Ajax Tab
	
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Pagination Type", "engage" ),
		"param_name" => "pagination",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Disable", "engage" ) => "no",
			esc_html__( "Classic", "engage" ) => "classic",
			esc_html__( "Ajax - load posts on click", "engage" ) => "ajax",
//				esc_html__( "Ajax - load posts on scroll", "engage" ) => "ajax_scroll",
//				esc_html__( "Ajax - classic pagination", "engage" ) => "ajax_classic" 
		),
		"description" => esc_html__( "Choose pagination type for your grid.", "engage" ),
		"group" => esc_html__( "Pagination/Ajax", 'engage' ) 
	),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Load More Button Style", "engage" ),
			"param_name" => "more_button_style",
			"value" => array(
				esc_html__( "Theme Defaults", 'engage' ) => '',
				esc_html__( "Normal", "engage" ) => "normal",
				esc_html__( "Fullwidth", "engage" ) => "fullwidth" 
			),
			'dependency' => Array(
				"element" => "pagination",
				'value' => array(
					"ajax" 
				) 
			),
			"description" => esc_html__( "Choose style for your 'Load more' button.", "engage" ),
			"group" => esc_html__( "Pagination/Ajax", "engage" ) 
		),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Number of Posts", "engage" ),
		"param_name" => "posts_nr",
		"value" => '',
		"description" => esc_html__( "Number of portfolio posts to be displayed. Leave blank to display all.", "engage" ),
		"group" => esc_html__( "Pagination/Ajax", 'engage' ) 
	),
	
	//	      array(
	//	         "type" => "dropdown",
	//	         "class" => "hidden-label",
	//	         "heading" => esc_html__( "Ajax load more", "engage" ),
	//	         "param_name" => "ajax",
	//	         "value" => array( "No" => "no", "Yes" => "yes" ),
	//	         "description" => esc_html__( "Enable the dynamic loading of posts.", "engage" )
	//	      ),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Filters", "engage" ),
		"param_name" => "filter",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Yes", "engage" ) => "yes",
			esc_html__( "No", "engage" ) => "no" 
		),
		"description" => esc_html__( "Enable or disable the filterable effect.", "engage" ),
		"group" => esc_html__( "Filtering", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Filters Alignment", "engage" ),
		"param_name" => "filter_align",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Center", "engage" ) => "center",
			esc_html__( "Left", "engage" ) => "left",
			esc_html__( "Right", "engage" ) => "right",
			esc_html__( "Mixed", "engage" ) => "mixed" 
		),
		"description" => esc_html__( "Set alignment of grid filters.", "engage" ),
		"group" => esc_html__( "Filtering", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"description" => esc_html__( "Sort/order your grid filter items by a certain field.", 'engage' ),
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Filters Order", "engage" ),
		"param_name" => "filter_orderby",
		"value" => array(
			esc_html__( "Theme Defaults", 'engage' ) => '',
			esc_html__( "Slug", "engage" ) => "slug",
			esc_html__( "Name", "engage" ) => "name",
			esc_html__( "Term ID", "engage" ) => "term_id",
			esc_html__( "ID", "engage" ) => "id" 
		),
		"group" => esc_html__( "Filtering", "engage" ) 
	),
	
);

$params = array_merge( $params, engage_responsive_params() );

$params = array_merge( $params, engage_order_params() );

return array(
	"name" => esc_html__( "Portfolio Grid", "engage" ),
	"base" => "portfolio_grid",
	"class" => "font-awesome",
	"icon" => "fa-th",
	"controls" => "full",
	"category" => array(
		esc_html__( 'Posts', 'engage' ),
		esc_html__( 'Engage', 'engage' ),
	),
	"description" => esc_html__( "Portfolio posts grid", 'engage' ),
	"params" => $params
);