<?php

if ( !post_type_exists( 'testimonials' ) ) {
    return;
}

// Blog

$params = array(  
	array(
	   "type" => "dropdown",
	   "description" => esc_html__( "Choose a style for your testimonials carousel", 'engage' ),
	   "class" => "hidden-label",
	   "heading" => esc_html__( "Testimonials Style", 'engage' ),
	   "param_name" => "style",
	   "value" => array(
	   		esc_html__( "Minimalistic Carousel", 'engage' ) => "minimal",
	   		esc_html__( "Basic Carousel", 'engage' ) => "simple"
	   	),
	   "admin_label" => true
	),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Caption Alignment", 'engage' ),
			"param_name" => "caption_align",
			"value" => array(
				esc_html__( "Left", 'engage' ) => "left",
				esc_html__( "Center", 'engage' ) => "center"
			),
			"dependency" => array(
				'element' => "style",
				'value' => array( "simple" ) 
			),
			"description" => esc_html__( "Choose aligment of the caption (testimonial author).", 'engage' )
		),
		array(
			"type" => "dropdown",
			"class" => "hidden-label",
			"heading" => esc_html__( "Background Style", 'engage' ),
			"param_name" => "bg",
			"value" => array(
				esc_html__( "Grey", 'engage' ) => "grey",
				esc_html__( "White", 'engage' ) => "white",
				esc_html__( "Transparent", 'engage' ) => "transparent"
			),
			"dependency" => array(
				'element' => "style",
				'value' => array( "simple" ) 
			),
			"description" => esc_html__( "Choose background for a testimonial item. Transparent works great with colorful row/section backgrounds.", 'engage' )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns", 'engage' ),
			"param_name" => "cols",
			"value" => array( "4", "3", "2", "1" ),
			"description" => esc_html__( "Number of columns", 'engage' ),
			"dependency" => array(
				'element' => "style",
				'value' => array( "simple" ) 
			),
		),
	array(
		"type" => "checkbox",
		"class" => "hidden-label",
		"value" => engage_taxonomies_array( 'testimonials-category' ),
		"heading" => esc_html__( "Testimonial Categories", "engage" ),
		"param_name" => "cats",
		"admin_label" => true,
		"description" => esc_html__( "Select testimonial categories to be displayed. Leave blank for all.", "engage" ) 
	),
	array(	      
	 "type" => "textfield",
	 "class" => "hidden-label",
	 "heading" => esc_html__( "Number of posts to show", 'engage' ),
	 "param_name" => "posts_nr",
	 "value" => "8"
	),

);

$params = array_merge( $params, engage_carousel_params() );
$params = array_merge( $params, engage_order_params() );

return array(
   "name" => esc_html__( "Testimonials", 'engage' ),
   "base" => "vntd_testimonials",
   "icon" => "fa-comments",
   "class" => "font-awesome",
   "category" => array( "Carousels" ),
   "description" => esc_html__( "Fancy testimonials", 'engage' ),
   "params" => $params
);