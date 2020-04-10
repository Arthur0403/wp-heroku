<?php

function engage_flip_box( $atts, $content = null ) {

	$defaultFont = 'fontawesome';
	$defaultIconClass = 'fa fa-info-circle';

	extract( shortcode_atts( array(
		"image" => '',
		"url" => '',
		"bg_overlay" => '',
		"main_bg_color" => '',
		"main_bg_color_custom" => '',
	    "primary_title" => 'Flip Box Element',
	    "use_custom_fonts_primary_title" => '',
	    "primary_align" => 'center',
	    "primary_title_font_container" => '',
	    "hover_title" => 'Hover Title',
	    "use_custom_fonts_hover_title" => '',
	    "hover_align" => 'center',
	    "hover_title_font_container" => '',
	    "shape" => 'rounded',
	    "hover_background_color" => '',
	    "hover_custom_background" => '',
	    "el_width" => 100,
	    "align" => 'center',
	    "hover_add_button" => '',
	    "reverse" => false,
	    "hover_btn_title" => 'Text on the button',
	    "css_animation" => '',
	    "el_id" => '',
	    "el_class" => '',
	    "css" => '',
	    "add_icon" => 'false',
	    "icon_type" => $defaultFont,
	    "icon_fontawesome" => $defaultIconClass,
	    "icon_typicons" => '',
	    "icon_openiconic" => '',
	    "icon_entypo" => '',
	    "icon_linecons" => 'vc_li vc_li-heart',
	    "icon_material" => 'vc-material vc-material-cake',
	    "icon_monosocial" => '',
	    "color_scheme" => '',
	    "hover_color_scheme" => ''
	), $atts ) );

	// WPBakery Page Builder Check
	if ( ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	$image_data = $image_src = '';

	if ( strpos( $image, 'unsplash') !== false ) {
		$image_src = $image;
	} elseif ( $image != '' ) {
		$image = intval( $image );
		$image_data = wp_get_attachment_image_src( $image, 'large' );
		$image_src = $image_data[0];
	}

	$image_src = esc_url( $image_src );

	$align = 'vc-hoverbox-align--' . esc_attr( $align );
	$shape = 'vc-hoverbox-shape--' . esc_attr( $shape );
	$width = 'vc-hoverbox-width--' . esc_attr( $el_width );

	if ( $reverse == true ) {
		$reverse = 'vc-hoverbox-direction--reverse';
	} else {
		$reverse = 'vc-hoverbox-direction--default';
	}

	$id = '';
	if ( ! empty( $el_id ) ) {
		$id = 'id="' . esc_attr( $el_id ) . '"';
	}

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' );

	$el_css = array();

	$el_css[] = vc_shortcode_custom_css_class( $css );

	// Icon

	$icon_output = $icon = '';

	if ( $add_icon != "false" ) {

		$icon = str_replace( 'fa-', '', $icon );
		vc_icon_element_fonts_enqueue( $icon_type );
		$iconClass = isset( ${"icon_" . $icon_type} ) ? ${"icon_" . $icon_type} : $defaultIconClass;

		$el_css[] = 'flipbox-with-icon';
		$icon_output = '<div class="flipbox-icon"><i class="' . $iconClass . '"></i></div>';

	}

	// Front Background

	$front_bg = false;

	$front_box_css = $front_box_inline_css = '';

	if ( $main_bg_color != '' ) {
		$front_box_css .= ' bg-color-' . $main_bg_color;
		$front_bg = true;
	}

	if ( $main_bg_color == 'custom' ) {
		$front_box_inline_css .= 'background-color:' . $main_bg_color_custom . ';';
		$front_bg = true;
	}

	if ( $image_src != '' ) {
		$front_bg = true;
		$front_box_inline_css .= 'background-image: url(' . $image_src . ');';
		if ( $bg_overlay != '' ) $front_box_css .= ' bg-overlay bg-overlay-' . $bg_overlay;
	}

	if ( $front_bg == true && $color_scheme == '' ) $front_box_css .= ' color-scheme-white no-border';

	if ( $color_scheme != '' ) $front_box_css .= ' color-scheme-' . $color_scheme;

	// Hover Background color

	$hover_bg = false;
	$hover_box_inline_css = $hover_box_css = '';
	if ( $hover_background_color == 'custom' ) {
		$hover_box_inline_css .= 'background-color:' . $hover_custom_background . ';';
		$hover_bg = true;
	} elseif ( $hover_background_color != '' ) {
		$hover_box_css = ' bg-color-' . $hover_background_color;
		$hover_bg = true;
	}

	if ( $hover_bg == true && $hover_color_scheme == '' ) $hover_box_css .= ' color-scheme-white no-border';
	if ( $hover_color_scheme != '' ) $hover_box_css .= ' color-scheme-' . $hover_color_scheme;

	// Titles

	$primary_title = '<h5 class="flipbox-front-title">' . $primary_title . '</h5>';
	$hover_title = '<h5 class="flipbox-hover-title">' . $hover_title . '</h5>';
	//$hover_title = $this->getHeading( 'hover_title', $atts, $atts['hover_align'] );

	$content = wpb_js_remove_wpautop( $content, true );
	$button = '';

	if ( $hover_add_button ) {
		$button = $this->renderButton( $atts );
	}

	$template = '<div class="engage-flipbox vc-hoverbox-wrapper ' . implode( ' ', $el_css ) . ' ' . $shape . ' ' . $align . ' ' . $reverse . ' ' . $width . '" ' . $id . '>
	  <div class="vc-hoverbox">
	    <div class="vc-hoverbox-inner">
	      <div class="engage-flipbox-front vc-hoverbox-block vc-hoverbox-front' . $front_box_css . '" style="' . $front_box_inline_css . '">
	        <div class="vc-hoverbox-block-inner vc-hoverbox-front-inner">';

	if ( $icon_output != '' ) $template .= $icon_output;
	$template .= $primary_title . '</div>
	      </div>
	      <div class="engage-flipbox-hover vc-hoverbox-block vc-hoverbox-back' . $hover_box_css . '" style="' . $hover_box_inline_css . '">
	        <div class="vc-hoverbox-block-inner vc-hoverbox-back-inner">
	            ' . $hover_title . '
	            ' . $content . '
	            ' . $button . '
	        </div>
	      </div>
	    </div>
	  </div>
	</div>';

	return $template;

}

remove_shortcode( "engage_flip_box" );
add_shortcode( "engage_flip_box", "engage_flip_box" );
