<?php

//
// Custom Visual Composer Scripts for a Theme Integration
//

if ( ! has_filter( 'engage_vc_enable_default_blocks' ) ) {
	vc_remove_element( 'vc_carousel' );
	vc_remove_element( 'vc_posts_grid' );
	vc_remove_element( 'vc_wp_pages' );
	vc_remove_element( 'vc_wp_recentcomments' );
	vc_remove_element( 'vc_wp_posts' );
	vc_remove_element( 'vc_flickr' );
	vc_remove_element( 'vc_pinterest' );
	vc_remove_element( 'vc_button2' ); // To-do
	vc_remove_element( 'vc_cta_button' );
	vc_remove_element( 'vc_cta_button2' );
}

function engage_overlay_array( $accent = null ) {
	$bg_overlay_arr = array(
		esc_html__( "None", "engage" ) => "none",
		esc_html__( "Dark 10%", "engage" ) => "dark10",
		esc_html__( "Dark 20%", "engage" ) => "dark20",
		esc_html__( "Dark 30%", "engage" ) => "dark30",
		esc_html__( "Dark 40%", "engage" ) => "dark40",
		esc_html__( "Dark 50%", "engage" ) => "dark50",
		esc_html__( "Dark 60%", "engage" ) => "dark60",
		esc_html__( "Dark 70%", "engage" ) => "dark70",
		esc_html__( "Dark 80%", "engage" ) => "dark80",
		esc_html__( "Dark 90%", "engage" ) => "dark90",
		esc_html__( "Light 20%", "engage" ) => "light20",
		esc_html__( "Light 40%", "engage" ) => "light40",
		esc_html__( "Light 60%", "engage" ) => "light60",
		esc_html__( "Light 80%", "engage" ) => "light80",
	);

	if( $accent == true ) {
		$bg_overlay_arr[ esc_html__( "Accent Color", 'engage' ) ] = 'accent';
		$bg_overlay_arr[ esc_html__( "Accent Light", 'engage' ) ] = 'accent-light';
	}

	return $bg_overlay_arr;

}

function engage_vc_gradient_color1( $group_name = 'Styling' ) {
	return array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Background Gradient Color 1', "engage" ),
		'param_name' => 'bg_gradient1',
		"class" => "hidden-label",
		'value' => '', // default video url
		'description' => esc_html__( 'Choose a first (top) color for the background gradient. Leave blank to disable.', "engage" ),
		'group' => $group_name,
		'edit_field_class' => 'vc_col-sm-6',
	);
}

function engage_vc_gradient_color2( $group_name = 'Styling' ) {
	return array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Background Gradient Color 2', "engage" ),
		'param_name' => 'bg_gradient2',
		"class" => "hidden-label",
		'value' => '', // default video url
		'description' => esc_html__( 'Choose a second (bottom) color for the background gradient.', "engage" ),
		'group' => $group_name,
		'edit_field_class' => 'vc_col-sm-6',
	);
}

// Fade Animation for elements

function engage_vc_animation( $css_animation )
{
	$animation_data = '';

	if ( $css_animation != '' ) {
		$animation_data = ' data-animation="';
		if ( $css_animation == 'left-to-right' ) {
			$animation_data .= 'fadeInLeft';
		} elseif ( $css_animation == 'right-to-left' ) {
			$animation_data .= 'fadeInRight';
		} elseif ( $css_animation == 'top-to-bottom' ) {
			$animation_data .= 'fadeInDown';
		} elseif ( $css_animation == 'bottom-to-top' ) {
			$animation_data .= 'fadeInUp';
		} else {
			$animation_data .= 'fadeIn';
		}
		$animation_data .= '" data-animation-delay="100"';
	}

	return $animation_data;
}

// VC Row

vc_add_param( "vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Text Color Scheme", "engage" ),
	"param_name" => "color_scheme",
	"value" => array(
		esc_html__( "Default", 'engage' ) => "",
		esc_html__( "Light Scheme", 'engage' ) => "white",
		esc_html__( "Dark Scheme", 'engage' ) => "dark"
	),
	"description" => esc_html__( "White Scheme - all text styled to white color, recommended for dark backgrounds. Suitable for rows with a dark background image or color.", "engage" ),
	"group" => esc_html__( "Styling", 'engage' )
) );

vc_add_param( "vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Predefined Background", 'engage' ),
	"param_name" => "bg_color_pre",
	"value" => array(
		esc_html__( "None", 'engage' ) => '',
		esc_html__( "Predefined Background 1", 'engage' ) => 'bg-color-1',
		esc_html__( "Predefined Background 2", 'engage' ) => 'bg-color-2',
		esc_html__( "Predefined Gradient 1", 'engage' ) => 'bg-gradient-1',
		esc_html__( "Predefined Gradient 2", 'engage' ) => 'bg-gradient-2',
		esc_html__( "Accent Color", 'engage' ) => 'bg-color-accent',
		esc_html__( "Accent Color 2", 'engage' ) => 'bg-color-accent-2',
		esc_html__( "Accent Color 3", 'engage' ) => 'bg-color-accent-3',
	),
	"description" => esc_html__( "Select a predefined background color. You may customize them in Theme Options / Styling tab.", "engage" ),
	"group" => esc_html__( "Styling", 'engage' )
) );

vc_add_param( "vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Background Image Overlay", 'engage' ),
	"param_name" => "bg_overlay",
	"value" => engage_overlay_array( true ),
	"description" => esc_html__( "Enable the row's background overlay to darken or lighten the background image.", "engage" ),
	"group" => esc_html__( "Styling", 'engage' )
) );

vc_add_param( "vc_row", engage_vc_gradient_color1() );
vc_add_param( "vc_row", engage_vc_gradient_color2() );

// VC Column

vc_add_param( "vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Column Padding", "engage" ),
	"param_name" => "col_padding",
	"value" => array(
		"None" => "0",
		"1%" => "1",
		"2%" => "2",
		"3%" => "3",
		"4%" => "4",
		"5%" => "5",
		"6%" => "6",
		"7%" => "7",
		"8%" => "8",
		"9%" => "9",
		"10%" => "10",
		"12%" => "12",
		"15%" => "15"
	),
	"description" => esc_html__( "Choose a padding value for the column. For more specific settings, please visit the 'Design Tab'.", "engage" )
) );

vc_add_param( "vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Column Padding Side", "engage" ),
	"param_name" => "col_padding_side",
	"value" => array(
		esc_html__( "All sides", 'engage' ) => "all",
		esc_html__( "Top + Bottom", 'engage' ) => "top_bottom",
		esc_html__( "Top + Bottom + Right", 'engage' ) => "top_bottom_right",
		esc_html__( "Top + Bottom + Left", 'engage' ) => "top_bottom_left",
		esc_html__( "Left + Right", 'engage' ) => "left_right",
		esc_html__( "Top", 'engage' ) => "top",
		esc_html__( "Bottom", 'engage' ) => "bottom",
		esc_html__( "Left", 'engage' ) => "left",
		esc_html__( "Right", 'engage' ) => "right"
	),
	"description" => esc_html__( "Choose a side of the padding value selected in the 'Column Padding' field.", "engage" )
) );

// VC Pie

$colors_pie_arr = array(
	esc_html__( 'Accent', "engage" ) => 'accent',
	esc_html__( 'Grey', "engage" ) => 'vntd-color-grey',
	esc_html__( 'Blue', "engage" ) => 'vntd-color-blue',
	esc_html__( 'Turquoise', "engage" ) => 'vntd-color-turquoise',
	esc_html__( 'Green', "engage" ) => 'vntd-color-green',
	esc_html__( 'Orange', "engage" ) => 'vntd-color-orange',
	esc_html__( 'Red', "engage" ) => 'vntd-color-red',
	esc_html__( 'Black', "engage" ) => "vntd-color-black"
);

// VC Accordion

vc_add_param( "vc_accordion", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Accordion Style", 'engage' ),
	"param_name" => "style",
	"value" => array(
		esc_html__( "Style 1", 'engage' ) => "style1",
		esc_html__( "Style 2", 'engage' ) => "style2",
		esc_html__( "Style 3", 'engage' ) => "style3",
		esc_html__( "Style 4", 'engage' ) => "style4"
	),
	"description" => esc_html__( "Choose a style for your accordion section.", 'engage' )
) );


// VC Tabs

if ( ! has_filter( 'engage_enable_vc_tabs_params' ) ) {
	vc_remove_param( "vc_tabs", "el_class" );
}

vc_add_param( "vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Tabs Style", 'engage' ),
	"param_name" => "style",
	"value" => array(
		esc_html__( "Style 1", 'engage' ) => 'style1',
		esc_html__( "Style 2", 'engage' ) => 'style2',
		esc_html__( "Style 3", 'engage' ) => 'style3',
		esc_html__( "Style 4", 'engage' ) => 'style4',
		esc_html__( "Style 5 (Minimalistic)", 'engage' ) => 'style5'
	),
	"description" => esc_html__( "Tab's style.", 'engage' ),
) );


// VC Separator

// VC Text

vc_add_param( "vc_column_text", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Paragraph Font Size", 'engage' ),
	"param_name" => "font_size",
	"value" => array(
		esc_html__( "Default", 'engage' ) => "",
		esc_html__( "Small", 'engage' ) => "small",
		esc_html__( "Medium", 'engage' ) => "medium",
		esc_html__( "Large", 'engage' ) => "large",
        esc_html__( "Larger", 'engage' ) => "larger",
        esc_html__( "XLarge", 'engage' ) => "xlarge",
        esc_html__( "XLarger", 'engage' ) => "xlarger"
	),
	"description" => esc_html__( "Choose a font size for regular paragraph text in this widget. You may adjust font sizes under Theme Options / Typography menu.", 'engage' )
) );

vc_add_param( "vc_column_text", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Font Family", 'engage' ),
	"param_name" => "font_family",
	"value" => array(
		esc_html__( "Default", 'engage' ) => "",
		esc_html__( "Additional Font specified in Theme Options / Typography.", 'engage' ) => "additional",
	),
	"description" => esc_html__( "Choose a font family for the text block.", 'engage' )
) );

vc_add_param( "vc_column_text", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Text Color", 'engage' ),
	"param_name" => "text_color",
	"value" => array(
		esc_html__( "Default", 'engage' ) => "",
		esc_html__( "White", 'engage' ) => "white",
		esc_html__( "Accent", 'engage' ) => "accent",
	),
	"description" => esc_html__( "Choose a font color for the text block. Both heading and regular text will be colored.", 'engage' )
) );

// VC Progress Bar

if ( ! has_filter( 'engage_enable_vc_progress_bar_params' ) ) {
	vc_remove_param( "vc_progress_bar", "options" );
}

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Progress Bar Style", "engage" ),
	"param_name" => "style",
	"value" => array(
		esc_html__( "Default", "engage" ) => "default",
		esc_html__( "Boxed", "engage" ) => "boxed",
	),
	"description" => esc_html__( "Choose a style for your accordion section.", "engage" )
));

if( !function_exists( 'engage_vc_update_defaults' ) ) {
	function engage_vc_update_defaults() {

		// Change the default single image size to 'full'
		$param          = WPBMap::getParam( 'vc_single_image', 'img_size' );
		$param['value'] = 'full';
		vc_update_shortcode_param( 'vc_single_image', $param );

		// Add Accent color to Progress Bars

		$param = WPBMap::getParam( 'vc_progress_bar', 'bgcolor' );
		$param['value'][esc_html__( 'Accent', "engage" )] = 'accent';
		vc_update_shortcode_param( 'vc_progress_bar', $param );

        // Add Accent color to Progress Bars

		$param = WPBMap::getParam( 'vc_icon', 'color' );
		$param['value'][esc_html__( 'Accent', "engage" )] = 'accent';
		vc_update_shortcode_param( 'vc_icon', $param );

        $param = WPBMap::getParam( 'vc_icon', 'background_color' );
		$param['value'][esc_html__( 'Accent', "engage" )] = 'accent';
		vc_update_shortcode_param( 'vc_icon', $param );

		// Add VC Tabs styles

		$param = WPBMap::getParam( 'vc_tta_tabs', 'style' );
		$param['value'][esc_html__( 'Engage Outline', "engage" )] = "engage_outline";
		$param['value'][esc_html__( 'Engage Outline Full', "engage" )] = "engage_outline_full";
		$param['value'][esc_html__( 'Engage Minimal', "engage" )] = "engage_minimal";
		$param['value'][esc_html__( 'Engage Boxed', "engage" )] = "engage_boxed";
		vc_update_shortcode_param( 'vc_tta_tabs', $param );

		// Add VC Tour styles

		$param = WPBMap::getParam( 'vc_tta_tour', 'style' );
		$param['value'][esc_html__( 'Engage Outline', "engage" )] = "engage_outline";
		$param['value'][esc_html__( 'Engage Outline Full', "engage" )] = "engage_outline_full";
		$param['value'][esc_html__( 'Engage Boxed', "engage" )] = "engage_boxed";
		vc_update_shortcode_param( 'vc_tta_tour', $param );

		// Add VC Accordion styles

		$param = WPBMap::getParam( 'vc_tta_accordion', 'style' );
		$param['value'][esc_html__( 'Engage Outline', "engage" )] = "engage_outline";
		$param['value'][esc_html__( 'Engage Outline Full', "engage" )] = "engage_outline_full";
		$param['value'][esc_html__( 'Engage Boxed', "engage" )] = "engage_boxed";
		$param['value'][esc_html__( 'Engage Boxed Accent', "engage" )] = "engage_boxed_accent";
		vc_update_shortcode_param( 'vc_tta_accordion', $param );
	}
}
add_action( 'init', 'engage_vc_update_defaults', 100 ); // Visual Composer Defaults

//
// Register new params
//

// Dropdown menu of blog categories

function engage_vc_blog_cats()
{
	$blog_cats       = array();
	$blog_categories = get_categories();

	foreach ( $blog_categories as $blog_cat ) {
		$blog_cats[$blog_cat->name] = $blog_cat->term_id;
	}

	return $blog_cats;
}

// Dropdown menu of portfolio categories

function engage_vc_portfolio_cats()
{

	$portfolio_categories = get_categories( 'taxonomy=portfolio-category' );

	if ( is_array( $portfolio_categories ) ) {

		$portfolio_cats = array();

		foreach ( $portfolio_categories as $portfolio_cat ) {
			if ( is_object( $portfolio_cat ) ) {
				$portfolio_cats[$portfolio_cat->name] = $portfolio_cat->slug;
			}
		}

		return $portfolio_cats;

	}

	return null;

}

// Dropdown menu of portfolio categories

function engage_taxonomies_array( $taxonomy_name = null )
{

	if( $taxonomy_name != null ) {

		$taxonomies = get_categories( 'taxonomy=' . $taxonomy_name );

		if ( is_array( $taxonomies ) ) {

			$taxonomy_array = array();

			foreach ( $taxonomies as $taxonomy ) {
				if ( is_object( $taxonomy ) ) {
					$taxonomy_array[$taxonomy->name] = $taxonomy->slug;
				}
			}

			return $taxonomy_array;

		}

	}

	return null;

}

function engage_vc_slider_cats()
{

	$portfolio_categories = get_categories( 'taxonomy=slide-locations' );

	$portfolio_cats = array();

	foreach ( $portfolio_categories as $portfolio_cat ) {
		if ( is_object( $portfolio_cat ) ) {
			$portfolio_cats[$portfolio_cat->name] = $portfolio_cat->slug;
		}
	}

	return $portfolio_cats;

}

function engage_vc_team_cats()
{

	$team_categories = get_categories( 'taxonomy=member-position' );

	$team_cats = array();

	foreach ( $team_categories as $team_cat ) {
		if ( is_object( $team_cat ) ) {
			$team_cats[$team_cat->name] = $team_cat->slug;
		}
	}

	return $team_cats;

}

//
// Register new shortcodes:
//


// Carousel Portfolio

add_action( "admin_init", "engage_vc_shortcodes" );

function engage_vc_shortcodes()
{


	// Google Fonts


	add_filter( 'vc_google_fonts_get_fonts_filter', 'engage_extend_vc_fonts', 10, 2 );

	function engage_extend_vc_fonts( $fonts ) {
		print_r( $fonts );

		$new_fonts = array(
			(object) array(
				"font_family" => "Dancing Script",
				"font_styles" => "regular",
				"font_types" => "400 regular:400:normal",
			),
		);

		$fonts = array_merge( $fonts, $new_fonts );

		return $fonts;
	}

	// Link Target array
	$target_arr = array(
		esc_html__( "Same window", "engage" ) => "_self",
		esc_html__( "New window", "engage" ) => "_blank"
	);

	// Colors Array

	$colors_arr = array(
		esc_html__( "Accent Color", "engage" ) => "accent",
		esc_html__( "Accent Color 2", "engage" ) => "accent2",
		esc_html__( "Accent Color 3", "engage" ) => "accent3",
		esc_html__( "Dark", "engage" ) => "dark",
		esc_html__( 'Blue', 'engage' ) => 'blue',
		esc_html__( 'Turquoise', 'engage' ) => 'turquoise',
		esc_html__( 'Pink', 'engage' ) => 'pink',
		esc_html__( 'Violet', 'engage' ) => 'violet',
		esc_html__( 'Peacoc', 'engage' ) => 'peacoc',
		esc_html__( 'Chino', 'engage' ) => 'chino',
		esc_html__( 'Wine', 'engage' ) => 'wine',
		esc_html__( 'Mulled Wine', 'engage' ) => 'mulled_wine',
		esc_html__( 'Vista Blue', 'engage' ) => 'vista_blue',
		esc_html__( 'Black', 'engage' ) => 'black',
		esc_html__( 'Grey', 'engage' ) => 'grey',
		esc_html__( 'Orange', 'engage' ) => 'orange',
		esc_html__( 'Sky', 'engage' ) => 'sky',
		esc_html__( 'Green', 'engage' ) => 'green',
		esc_html__( 'Juicy pink', 'engage' ) => 'juicy_pink',
		esc_html__( 'Sandy brown', 'engage' ) => 'sandy_brown',
		esc_html__( 'Purple', 'engage' ) => 'purple',
		esc_html__( 'Deep Purple', 'engage' ) => 'deep_purple',
		esc_html__( 'Indigo', 'engage' ) => 'indigo',
		esc_html__( "Light", "engage" ) => "light",
		esc_html__( "White", "engage" ) => "white",
		esc_html__( "Custom Color", "engage" ) => "custom"
	);

	// Pixel Icons

	$pixel_icons = array();

	$bg_overlay_arr = engage_overlay_array( true );

	$bg_position_arr = array(
		esc_html__( 'Default', 'engage' ) => '',
		esc_html__( 'Center Center', 'engage' ) => 'center center',
		esc_html__( 'Center Top', 'engage' ) => 'center top',
		esc_html__( 'Center Bottom', 'engage' ) => 'center bottom',
		esc_html__( 'Left Center', 'engage' ) => 'left center',
		esc_html__( 'Left Top', 'engage' ) => 'left top',
		esc_html__( 'Left Bottom', 'engage' ) => 'left bottom',
		esc_html__( 'Right Center', 'engage' ) => 'right center',
		esc_html__( 'Right Top', 'engage' ) => 'right top',
		esc_html__( 'Right Bottom', 'engage' ) => 'right bottom',
	);

	// Load VC Elements

	foreach ( scandir( get_template_directory() . '/wpbakery/elements/' ) as $filename ) {

	    $path = get_template_directory() . '/wpbakery/elements/' . $filename;

	    if ( is_file( $path ) && preg_match( '%\.php$%', $filename ) ) {

	        $element_array = include $path;

	        if ( is_array( $element_array ) ) {
                vc_map( $element_array );
            }

	    }

	}

	// Social Icons

	$social_icons_params_arr = array();

	$social_icons_params_arr[] = array(
		"type" => "dropdown",
		"heading" => esc_html__( "Color Style", "engage" ),
		"param_name" => "color",
		"class" => "hidden-label",
		"value" => array(
			esc_html__( "Theme Defaults", "engage" ) => "",
			esc_html__( "Outline", "engage" ) => "outline",
			esc_html__( "Grey", "engage" ) => "grey",
			esc_html__( "Dark", "engage" ) => "dark",
			esc_html__( "Colorful", "engage" ) => "colorful"
		),
		"description" => esc_html__( "Choose a color style for your icons.", "engage" )
	);

	$social_icons_params_arr[] = array(
		"type" => "dropdown",
		"heading" => esc_html__( "Border Radius", "engage" ),
		"param_name" => "border",
		"class" => "hidden-label",
		"value" => array(
			esc_html__( "Theme Defaults", "engage" ) => "",
			esc_html__( "Round", "engage" ) => "round",
			esc_html__( "Circle", "engage" ) => "circle",
			esc_html__( "Square", "engage" ) => "square"
		),
		"description" => esc_html__( "Choose a border radius of your icons.", "engage" )
	);

	$social_icons_params_arr[] = array(
		"type" => "dropdown",
		"heading" => esc_html__( "Size", "engage" ),
		"param_name" => "size",
		"class" => "hidden-label",
		"value" => array(
			esc_html__( "Theme Defaults", "engage" ) => "",
			esc_html__( "Small", "engage" ) => "small",
			esc_html__( "Regular", "engage" ) => "regular",
			esc_html__( "Large", "engage" ) => "large"
		),
		"description" => esc_html__( "Social icons size.", "engage" )
	);

	$social_icons_params_arr[] = array(
		"type" => "dropdown",
		"heading" => esc_html__( "Hover Effect", "engage" ),
		"param_name" => "effect",
		"class" => "hidden-label",
		"value" => array(
			esc_html__( "Theme Defaults", "engage" ) => "",
			esc_html__( "Slide Up", "engage" ) => "slideup",
			esc_html__( "None", "engage" ) => "none"
		),
		"description" => esc_html__( "Choose a hover effect for your icons.", "engage" )
	);

	$social_icons_params_arr[] = array(
		"type" => "dropdown",
		"heading" => esc_html__( "Icons Alignment", "engage" ),
		"param_name" => "align",
		"class" => "hidden-label",
		"value" => array(
			esc_html__( "Theme Defaults", "engage" ) => "",
			esc_html__( "Left", "engage" ) => "left",
			esc_html__( "Center", "engage" ) => "center",
			esc_html__( "Right", "engage" ) => "right"
		),
		"description" => esc_html__( "Choose the alignment of social icons.", "engage" )
	);

	//$social_icons_param = array();


	$social_icons = engage_social_sites_array();

	$icon_key = '';

	foreach ( $social_icons as $social_icon_key => $social_icon_name ) {

		$icon_key = $social_icon_key;

		if ( is_numeric( $social_icon_key ) ) {
			$icon_key = $social_icon_name;
		}

		$social_icons_params_arr[] = array(
			"type" => "textfield",
			"heading" => ucfirst( $social_icon_name ),
			"param_name" => $icon_key,
			"holder" => "h5",
			"description" => ucfirst( $social_icon_name ) . ' social site URL.'
		);
	}

	$social_icons_params_arr[] = array(
		'type' => 'css_editor',
		'heading' => esc_html__( 'CSS box', "engage" ),
		'param_name' => 'css',
		'group' => esc_html__( 'Design Options', "engage" )
	);

	vc_map( array(
		"name" => esc_html__( "Social Icons", "engage" ),
		"base" => "social_icons",
		"class" => "font-awesome",
		"icon" => "fa-twitter",
		"category" => esc_html__( 'Content', 'engage' ),
		"description" => esc_html__( "List of social icons", 'engage' ),
		"params" => $social_icons_params_arr
	) );

}

function engage_social_sites_array() {
	$social_sites = array(
		'twitter' => 'Twitter',
		'facebook' => 'Facebook',
		'linkedin' => 'LinkedIn',
		'behance' => 'Behance',
		'codepen' => 'Codepen',
		'bitbucket' => 'Bitbucket',
		'deviantart' => 'Deviant Art',
		'digg' => 'Digg',
		'dribbble' => 'Dribbble',
		'dropbox' => 'Dropbox',
		'email' => 'Email',
		'flickr' => 'Flickr',
		'git' => 'Git',
		'github' => 'Github',
		'google' => 'Google',
		'google-plus' => 'Google Plus',
		'telegram' => 'Telegram',
		'houzz' => 'Houzz',
		'instagram' => 'Instagram',
		'pinterest' => 'Pinterest',
		'quora' => 'Quora',
		'reddit' => 'Reddit',
		'skype' => 'Skype',
		'snapchat' => 'Snapchat',
		'soundcloud' => 'Soundcloud',
		'stack-exchange' => 'Stack Exchange',
		'stack-overflow' => 'Stack Overflow',
		'spotify' => 'Spotify',
		'steam' => 'Steam',
		'tripadvisor' => 'Trip Advisor',
		'tumblr' => 'Tumblr',
		'twitch' => 'Twitch',
		'vimeo' => 'Vimeo',
		'whatsapp' => 'Whatsapp',
		'yelp' => 'Yelp',
		'youtube' => 'YouTube'
	);

	return $social_sites;
}

if ( !function_exists( 'engage_social_params' ) ) {
	function engage_social_params() {

		$social_sites = engage_social_sites_array();

		$params = array();

		foreach ( $social_sites as $id => $name ) {
			$params[] = array(
				"type" => "textfield",
				"class" => "hidden-label",
				"heading" => $name,
				"param_name" => $id,
				"value" => "",
				"description" => esc_html__( "Enter URL for", "engage" ) . ': ' . $name,
				'group' => esc_html__( "Social Profiles", "engage" ),
			);
		}

		return $params;
	}
}

if ( !function_exists( 'engage_responsive_params' ) ) {
	function engage_responsive_params() {
		$params = array(
			array(
			   "type" => "dropdown",
			   "class" => "hidden-label",
			   "heading" => esc_html__( "Columns Mobile", "engage" ),
			   "description" => esc_html__( "Number of columns on mobile smartphone devices (resolution < 768px).", "engage" ),
			   "param_name" => "cols_mobile",
			   "value" => array(
					esc_html__( "Default", "engage" ) => "default",
					esc_html__( "1", "engage" ) => 1,
					esc_html__( "2", "engage" ) => 2,
					esc_html__( "3", "engage" ) => 3,
					esc_html__( "4", "engage" ) => 4,
					esc_html__( "5", "engage" ) => 5,
			   ),
			   "std" => 'default',
			   'group' => esc_html__( "Responsive", "engage" )
			),
			array(
			   "type" => "dropdown",
			   "class" => "hidden-label",
			   "heading" => esc_html__( "Columns Tablet", "engage" ),
			   "description" => esc_html__( "Number of columns on tablet devices (resolution between 768px and 1000px).", "engage" ),
			   "param_name" => "cols_tablet",
			   "value" => array(
					esc_html__( "Default", "engage" ) => "default",
					esc_html__( "1", "engage" ) => 1,
					esc_html__( "2", "engage" ) => 2,
					esc_html__( "3", "engage" ) => 3,
					esc_html__( "4", "engage" ) => 4,
					esc_html__( "5", "engage" ) => 5,
			   ),
			   "std" => 'default',
			   'group' => esc_html__( "Responsive", "engage" )
			),
		);
		return $params;
	}
}

if ( !function_exists( 'engage_order_params' ) ) {
	function engage_order_params() {
		$params = array(
			array(
				"type" => "dropdown",
				"description" => esc_html__( "Sort/order your posts by a certain value.", 'engage' ),
				"class" => "hidden-label",
				"heading" => esc_html__( "Order posts by", "engage" ),
				"param_name" => "orderby",
				"value" => array(
					esc_html__( "Date", 'engage' ) => "date",
					esc_html__( "None - no order", 'engage' ) => "none",
					esc_html__( "Post ID", 'engage' ) => "ID",
					esc_html__( "Author", 'engage' ) => "author",
					esc_html__( "Title", 'engage' ) => "title",
					esc_html__( "Name (slug)", 'engage' ) => "name",
					esc_html__( "Menu Order", 'engage' ) => "menu_order"
				),
				"group" => esc_html__( "Order Settings", "engage" )
			),
			array(
				"type" => "dropdown",
				"description" => esc_html__( "Posts order.", 'engage' ),
				"class" => "hidden-label",
				"heading" => esc_html__( "Posts order", "engage" ),
				"param_name" => "order",
				"value" => array(
					esc_html__( "Descending (DESC)", 'engage' ) => "DESC",
					esc_html__( "Ascending (ASC)", 'engage' ) => "ASC"
				),
				"group" => esc_html__( "Order Settings", "engage" )
			)
		);
		return $params;
	}
}

if ( !function_exists( 'engage_carousel_params' ) ) {
	function engage_carousel_params() {
		$params = array(
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Bullet Navigation', 'engage' ),
				'param_name' => 'bullet_nav',
				'std' => 'true',
				'description' => esc_html__( 'Enable bullet navigation.', 'engage' ),
				'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
				'group' => esc_html__( "Carousel Settings", "engage" )
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Arrow Navigation', 'engage' ),
				'param_name' => 'arrow_nav',
				'description' => esc_html__( 'Enable arrow navigation.', 'engage' ),
				'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
				'group' => esc_html__( "Carousel Settings", "engage" )
			),
			array(
				"type" => "checkbox",
				"class" => "hidden-label",
				"heading" => esc_html__( "Carousel Autoplay", "engage" ),
				"param_name" => "autoplay",
				"std" => "true",
				'value' => array( esc_html__( 'Yes', 'engage' ) => 'true' ),
				"description" => esc_html__( "Enable the autoplay of the carousel.", "engage" ),
				'group' => esc_html__( "Carousel Settings", "engage" )
			),
			array(
				"type" => "textfield",
				"class" => "hidden-label",
				"heading" => esc_html__( "Carousel Speed", "engage" ),
				"param_name" => "autoplay_timeout",
				"value" => "7000",
				"description" => esc_html__( "Time beetween slides in miliseconds i.e. 1000 = 1 second. Default: 7000", "engage" ),
				'group' => esc_html__( "Carousel Settings", "engage" ),
				"dependency" => Array(
					"element" => "autoplay",
					'value' => array(
						"true"
					)
				),
			)
		);
		return $params;
	}
}

function engage_vc_icon_params( $dependency = null ) {

    $icon_fonts = array(
        esc_html__( 'Font Awesome', 'engage' ) => 'fontawesome',
        esc_html__( 'Open Iconic', 'engage' ) => 'openiconic',
        esc_html__( 'Typicons', 'engage' ) => 'typicons',
        esc_html__( 'Entypo', 'engage' ) => 'entypo',
        esc_html__( 'Linecons', 'engage' ) => 'linecons',
        esc_html__( 'Mono Social', 'engage' ) => 'monosocial',
        esc_html__( 'Material', 'engage' ) => 'material',
    );

    if ( has_filter( 'engage_icon_fonts' ) ) { // Append new icon set if needed
        $icon_fonts = apply_filters( 'engage_icon_fonts', $icon_fonts );
    }

	if ( $dependency == false ) {
		$icon_main_param = '';
		$icon_main_param = array(array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'engage' ),
			'value' => $icon_fonts,
			'admin_label' => true,
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'engage' ),
		));
	} else {
		if ( $dependency == null ) $dependency = 'add_icon';

		$icon_main_param = array(array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'engage' ),
			'value' => $icon_fonts,
			'admin_label' => true,
			'param_name' => 'icon_type',
			'dependency' => array(
				'element' => $dependency,
				'value' => 'true',
			),
			'description' => esc_html__( 'Select icon library.', 'engage' ),
		));
	}

	$icon_pickers = array(
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' =>'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
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
			'value' => 'typcn typcn-adjust-brightness',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
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
			'value' => 'entypo-icon entypo-icon-note',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
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
			'value' => 'vc_li vc_li-heart',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_monosocial',
			'value' => 'vc-mono vc-mono-fivehundredpx',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'monosocial',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'monosocial',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'engage' ),
			'param_name' => 'icon_material',
			'value' => 'vc-material vc-material-cake',
			// default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'material',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'material',
			),
			'description' => esc_html__( 'Select icon from library.', 'engage' ),
		),
	);

	$icon_params = array_merge( $icon_main_param, $icon_pickers );

	if ( has_filter( 'engage_icon_params' ) ) { // Append new icon set if needed
	    $icon_params = apply_filters( 'engage_icon_params', $icon_params );
    }

	return $icon_params;
}

function engage_vc_pages_array() {

	$pages_array = array();

	$site_pages = get_pages();

	foreach ( $site_pages as $page ) {
		$pages_array[$page->post_title] = $page->ID;
	}

	return $pages_array;

}

?>
