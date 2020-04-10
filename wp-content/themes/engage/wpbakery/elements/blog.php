<?php 

// Blog

$params = array(
	array(
		"type" => "checkbox",
		"class" => "hidden-label",
		"value" => engage_vc_blog_cats(),
		"heading" => esc_html__( "Blog Categories", "engage" ),
		"param_name" => "cats",
		"description" => esc_html__( "Leave blank to show all.", "engage" )
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Blog Style", "engage" ),
		"param_name" => "style",
		"value" => array(
			esc_html__( "Theme defaults", 'engage' ) => 'default',
			esc_html__( "Classic", 'engage' ) => "classic",
			esc_html__( "Left Image", 'engage' ) => "left_image",
			esc_html__( "Masonry", 'engage' ) => "masonry"
		),
		"description" => esc_html__( "Choose a style of your blog or leave default settings set in the Theme Options panel.", "engage" )
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Grid Columns", "engage" ),
		"param_name" => "cols",
		"value" => array(
			esc_html__( "Theme defaults", 'engage' ) => 'default',
			"6",
			"5",
			"4",
			"3",
			"2" 
		),
		"std" => "default",
		"dependency" => Array(
			"element" => "style",
			'value' => array(
				"masonry" 
			) 
		),
		"description" => esc_html__( "Select number of columns for your masonry style blog.", "engage" )
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Ajax Pagination", "engage" ),
		"param_name" => "ajax",
		"value" => array(
			esc_html__( "Theme defaults", 'engage' ) => 'default',
			esc_html__( "No", 'engage' ) => "no",
			esc_html__( "Yes", 'engage' ) => "yes" 
		),
		"description" => esc_html__( "Enable or disable the ajax pagination (load more button).", "engage" )
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Blog Post Style", "engage" ),
		"param_name" => "boxed",
		"value" => array(
			esc_html__( "Theme defaults", 'engage' ) => 'default',
			esc_html__( "Boxed", 'engage' ) => "boxed",
			esc_html__( "Boxed No Border", 'engage' ) => "boxed_no_border",
			esc_html__( "Not Boxed", 'engage' ) => "not_boxed",
		),
		"description" => esc_html__( "Choose a boxed style for your blog posts. Applies only for 'Clasic' and 'Masonry' blog style.", "engage" )
	),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Posts per page", "engage" ),
		"param_name" => "posts_nr",
		"value" => '',
		"description" => esc_html__( "Number of posts to be displayed per page. Leave blank for site defaults.", "engage" )
	) 
);

$params = array_merge( $params, engage_order_params() );

return array(
	"name" => esc_html__( "Blog", "engage" ),
	"base" => "vntd_blog",
	"class" => "font-awesome",
	"icon" => "fa-file-text-o",
	"controls" => "full",
	"category" => array( esc_html__( 'Posts', 'engage' ), 'Engage' ),
	"params" => $params 
);