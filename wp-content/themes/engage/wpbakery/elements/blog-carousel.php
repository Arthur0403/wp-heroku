<?php

// Blog Carousel

$params = array(
	array(
		"type" => "checkbox",
		"class" => "hidden-label",
		"value" => engage_vc_blog_cats(),
		"heading" => esc_html__( "Blog Categories", "engage" ),
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
		"admin_label" => true,
		"description" => esc_html__( "Number of blog posts to be displayed in the carousel.", "engage" )
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__( "Columns", "engage" ),
		"param_name" => "cols",
		"value" => array(
			"5",
			"4",
			"3",
			"2"
		),
		"std" => "3",
		"description" => esc_html__( "Number of columns", "engage" )
	),
	array(
		"type" => "dropdown",
		"description" => esc_html__( "Posts Style", "engage" ),
		"heading" => esc_html__( "Choose a style for your carousel posts.", "engage" ),
		"param_name" => "style",
		"value" => array(
			esc_html__( "Boxed Border", "engage" ) => "boxed_border",
			esc_html__( "Boxed Solid", "engage" ) => "boxed_solid",
		),
	),
	array(
		"type" => "dropdown",
		"description" => esc_html__( "Thumbnail Type", "engage" ),
		"heading" => esc_html__( "Thumbnail type for your blog posts.", "engage" ),
		"param_name" => "thumb",
		"value" => array(
			esc_html__( "Featured Image", "engage" ) => "featured_image",
			esc_html__( "Disable", "engage" ) => "disable",
		),
	),
	array(
		"type" => "dropdown",
		"description" => esc_html__( "Post Meta", "engage" ),
		"heading" => esc_html__( "Post meta settings.", "engage" ),
		"param_name" => "meta",
		"value" => array(
			esc_html__( "Author + Date", "engage" ) => "author_date",
			esc_html__( "Date", "engage" ) => "date",
			esc_html__( "Disable", "engage" ) => "disable",
		),
	),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Excerpt length", "engage" ),
		"param_name" => "excerpt_length",
		"description" => esc_html__( "Insert number of words to be displayed in the post excerpt. Leave blank for default.", "engage" )
	),
);

$params = array_merge( $params, engage_carousel_params() );
$params = array_merge( $params, engage_responsive_params() );

return array(
	"name" => esc_html__( "Blog Carousel", "engage" ),
	"base" => "blog_carousel",
	"class" => "font-awesome",
	"icon" => "fa-file-text-o",
	"controls" => "full",
	"category" => array(
		esc_html__( "Carousels", "engage" ),
		esc_html__( "Posts", "engage" ),
		'Engage'
	),
	"description" => esc_html__( "Carousel of your blog posts", "engage" ),
	"params" => $params
);
