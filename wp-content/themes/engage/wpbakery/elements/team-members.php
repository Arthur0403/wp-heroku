<?php

if ( !post_type_exists( 'team' ) ) {
    return;
}

// Team Members

$params = array(
	array(
		"type" => "dropdown",
		"heading" => esc_html__( "Columns", "engage" ),
		"param_name" => "cols",
		"std" => "3",
		"value" => array(
			"4",
			"3",
			"2"
		),
		"description" => esc_html__( "Number of columns", "engage" ) 
	),
	array(
		"type" => "checkbox",
		"class" => "hidden-label",
		"value" => engage_vc_team_cats(),
		"heading" => esc_html__( "Team member positions", "engage" ),
		"param_name" => "positions",
		"description" => esc_html__( "Select member positions to be displayed in the grid. Leave blank to display all.", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Style", "engage" ),
		"param_name" => "style",
		"value" => array(
			esc_html__( "Modern - icons displayed on hover, name centered below", "engage" ) => "modern",
			esc_html__( "Classic", "engage" ) => "classic",
		),
		"description" => esc_html__( "Choose a style for your team members grid.", "engage" ) 
	),
	
	array(
		"type" => "checkbox",
		"heading" => esc_html__( "Member Description", "engage" ),
		"param_name" => "show_bio",
		"class" => "hidden-label",
		"description" => esc_html__( "Include the short biography text under the member name.", "engage" ),
		"value" => array(
			esc_html__( "Display member description.", "engage" ) => "yes"
		),
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Boxed Style", "engage" ),
		"param_name" => "boxed",
		"value" => array(
			esc_html__( "No", "engage" ) => "no",
			esc_html__( "Boxed Solid", "engage" ) => "boxed-solid",
			esc_html__( "Boxed Border", "engage" ) => "boxed-border",
		),
		"description" => esc_html__( "Choose a boxed style for your team member grid items.", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Thumbnail Size", "engage" ),
		"param_name" => "thumb_size",
		"value" => array(
			esc_html__( "Portrait", "engage" ) => "portrait",
			esc_html__( "Square", "engage" ) => "square",
		),
		"description" => esc_html__( "Choose the thumbnail size.", "engage" ) 
	),
	array(
		"type" => "dropdown",
		"class" => "hidden-label",
		"heading" => esc_html__( "Filtering Menu", "engage" ),
		"param_name" => "filter",
		"value" => array(
			esc_html__( "Theme Defaults", "engage" ) => "default",
			esc_html__( "On", "engage" ) => "on",
			esc_html__( "Off", "engage" ) => "off",
		),
		"description" => esc_html__( "Enable or disable the filtering menu to filter team members by 'position'.", "engage" ) 
	),
	array(
		"type" => "textfield",
		"class" => "hidden-label",
		"heading" => esc_html__( "Posts Number", "engage" ),
		"param_name" => "posts_nr",
		"value" => '',
		"description" => esc_html__( "Number of portfolio posts to be displayed. Leave blank for no limit.", "engage" ) 
	) 
);

$params = array_merge( $params, engage_responsive_params() );

return array(
	"name" => esc_html__( "Team Members", "engage" ),
	"base" => "team_members",
	"class" => "font-awesome",
	"icon" => "fa-users",
	"controls" => "full",
	"category" => array(
		esc_html__( 'Posts', 'engage' ) 
	),
	"description" => esc_html__( "Display team members.", "engage" ),
	"params" => $params 
);