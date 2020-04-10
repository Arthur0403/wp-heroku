<?php

// Shortcode Processing


function engage_button( $atts, $content = null ) {

	$defaultFont = 'fontawesome';
	$defaultIconClass = 'fa fa-adjust';
	$custom_style = $scroll_class = $align_class = $icon_class = $icon_element = '';

	$defaults = Engage_Core::get_element_defaults( 'button' );

	extract( shortcode_atts( array(
		"label" => 'Button Text',
		"url" => '',
		"action" => 'link',
		"url_video" => '',
		"color" => $defaults[ 'color' ],
		"color_hover" => $defaults[ 'color_hover' ],
		"color_custom" => '',
		"color_text" => '',
		"size" => 'regular',
		"style" => $defaults[ 'style' ],
		"shadow" => $defaults[ 'shadow' ],
		"text_transform" => 'uppercase',
		"border_radius" => $defaults[ 'border_radius' ],
		"icon_enabled" => 'no',
		"icon" => 'heart-o',
		"icon_type" => $defaultFont,
		"icon_fontawesome" => $defaultIconClass,
		"icon_material" => 'vc-material vc-material-cake',
    "icon_style" => 'right_side',
		"margin_top" => '',
		"margin_bottom" => '',
		"el_class" => '',
		"align" => 'left',
		"display" => 'block',
		"link_target" => ''
	), $atts ) );

	// WPBakery Page Builder Check
	if ( ! function_exists( 'vc_build_link' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	$btn_classes = array();
	$holder_css = '';

	// Display

	if ( $display == 'inline' ) {
		$holder_css .= ' btn-inline';
	}

	// Color

	if( $color == "custom" ) {
		$important = '';
		if( $color_hover == 'original' ) $important = '!important;';
		$custom_style .= ' style="border-color:' . $color_custom . $important . ';';
		if( $style == "outline" ) {
			$custom_style .= 'color:' . $color_custom  . $important . ';';
		} else {
			$custom_style .= 'background-color:' . $color_custom . $important . ';';
		}
		$custom_style .= '" ';

	} elseif(strpos($color,'#') !== false) {
		$custom_style .= ' style="background-color:' . $color . ';border-color:' . $color . ';';
		if($style == "outline") {
			$custom_style .= 'color:' . $customcolor . ';';
		}
		$custom_style .= '" ';
	}

	// Button Size

	$btn_classes[] = 'btn-' . esc_attr( $size );

	// Border Radius

	if( $border_radius == 'circle' ) {
		$btn_classes[] = 'btn-circle';
	} elseif( $border_radius == 'square' ) {
		$btn_classes[] = 'btn-square';
	}

	// Button Style

	if( $style == 'outline' ) {
		$btn_classes[] = 'btn-outline';
		if( $color_text == 'dark' ) {
			$btn_classes[] = 'btn-text-dark';
		}
	} else if ( $style == 'text-btn' ) {
		$btn_classes[] = 'btn-text';
	} else {
		$btn_classes[] = 'btn-solid';
	}

	// Shadow

	if( $shadow != 'no' ) {
		$btn_classes[] = 'btn-shadow';
	}

	// Button Color

	$btn_classes[] = ' btn-'. esc_attr( $color );

	// Button Hover

	$btn_classes[] = 'btn-hover-' . esc_attr( $color_hover );

	// Text Transform

	if( $text_transform == 'none' ) $btn_classes[] = ' btn-transform-none';

	// Icon

	if ( $icon_enabled == "yes" ) {

		$icon = str_replace( 'fa-', '', $icon );
		vc_icon_element_fonts_enqueue( $icon_type );
        $iconClass = isset( $atts['icon_' . $icon_type] ) ? $atts['icon_' . $icon_type] : $defaultIconClass;
		$btn_classes[] = 'btn-with-icon';
		$icon_element = '<i class="' . $iconClass . '"></i>';

		if( $icon_style == 'right_side_hover' || $icon_style == 'outline_hover' ) {
			$label = '<span>' . $label . '</span>';
		}
		$btn_classes[] = 'btn-icon-' . $icon_style;

	}

	// Outer CSS

	$outer_css = '';

	if ( $margin_top != '' ) {
		$outer_css .= 'margin-top:' . esc_attr( str_replace( 'px', '', $margin_top ) ) . 'px;';
	}
	if ( $margin_bottom != '' ) {
		$outer_css .= 'margin-top:' . esc_attr( str_replace( 'px', '',  $margin_bottom ) ) . 'px;';
	}

	if ( $outer_css != '' ) $outer_css = ' style="' . $outer_css . '"';

	// Extra Class

	if($el_class != '') $btn_classes[] = ' ' . esc_attr( $el_class );

	// New URL Param

	$target = $title = '';

    if ( $action == 'video' ) {
        $url = $url_video;
        $btn_classes[] = 'mp-video';
        wp_enqueue_script('magnific-popup', '', '', '', true);
        wp_enqueue_style('magnific-popup');
    } else if ( strpos( $url, '|' ) !== false ) {
		$link = vc_build_link( $url );
		$url = $link['url'];
		$target = $link['target'];
		$title = $link['title'];
	}

	if ( $link_target != '' ) {
		$target = $link_target;
	}

	return '<div class="btn-holder btn-align-' . esc_attr( $align ) . $holder_css . '"' . $outer_css . '><a href="' . esc_url($url) . '" title="'. esc_html( $title ) .'" class="btn ' . implode( ' ', $btn_classes ) . '" target="' . $target . '"' . $custom_style . '>' . $label . $icon_element . '</a></div>';

}
remove_shortcode('vntd_button');
add_shortcode('vntd_button', 'engage_button');
