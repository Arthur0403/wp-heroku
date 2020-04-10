<?php

// Shortcode Processing

function engage_pricing_box( $atts, $content )
{

	$icon_type = 'fontawesome';
	$defaultIconClass = 'fa fa-info-circle';

	extract( shortcode_atts( array(
		"featured" => 'no',
		"title" => esc_html__( 'Standard', 'engage' ),
		"features" => 'Feature 1,Feature 2,Feature 3',
		"button_label" => esc_html__( 'Buy Now', 'engage' ),
		"period" => esc_html__( 'Month', 'engage' ),
		"price" => '$99',
		"button_url" => '#',
		"animated" => 'no',
		"animation_delay" => '100',
		"border_radius" => 'default',
		"style" => 'minimal',
		"bg" => 'gray',
		"add_icon" => 'false',
		"icon_fontawesome" => $defaultIconClass,
	), $atts ) );

	$animated_data = '';

	$css_classes = array();

	if ( $animated == 'yes' ) {
		$css_classes[] = Engage_Core::get_animated_class();
		$animated_data  = ' data-animation="fadeIn" data-animation-delay="' . esc_attr( $animation_delay ) . '"';
		wp_enqueue_script( 'engage-appear', '', '', '', true );
	}

	if ( $featured == 'yes' ) {
		$css_classes[] = "pricing-box-featured";
		$css_classes[] = ' border-color-accent';
	}

	if ( $border_radius && $border_radius != 'default' ) {
		$css_classes[] = 'vntd-border-radius-' . esc_attr( $border_radius );
	}

	if ( $style == 'minimal' ) {
		$css_classes[] = 'pricing-box-minimal';
		$css_classes[] = 'pricing-box-' . $bg;
	} elseif ( $style == 'classic' ) {

	}

	// Add icon

	$icon = '';

	if ( $add_icon != "false" ) {

		// Vc check
		if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
			return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
		}

		$icon = str_replace( 'fa-', '', $icon );
		vc_icon_element_fonts_enqueue( $icon_type );
		$iconClass = isset( ${"icon_" . $icon_type} ) ? ${"icon_" . $icon_type} : $defaultIconClass;

		$css_classes[] = 'pricing-box-with-icons';
		$icon = '<span class="pricing-box-icon"><i class="' . $iconClass . '"></i></span> ';

	}

	// Output

	$output = '<div class="pricing-box ' . implode( ' ', $css_classes ) . '"' . $animated_data . '>';

	$output .= '<h4 class="pricing-box-title">' . esc_html( $title ) . '</h2>';

	$output .= '<div class="pricing-box-price"><h5>' . esc_html( $price ) . '</h5>';

	if( $period != '' ) {
		$output .= '<span class="pricing-box-period">/ ' . esc_html( $period ) . '</span>';
	}

	$output .= '</div><ul class="pricing-box-features">';

	// features loop

	$features_arr = explode( ',', $features );

	foreach ( $features_arr as $single_feature ) {
		if ( strpos( $single_feature, 'fa-' ) !== false ) {
			$single_feature = '<i class="fa ' . $single_feature . '"></i>';
		}
		$output .= '<li>' . $icon . esc_textarea( $single_feature ) . '</li>';
	}

	// end loop

	$output .= '</ul>';

	// button

	if ( $button_label ) {

		$btn_color = 'btn-grey';
		if( $featured == 'yes' ) {
			$btn_color = 'btn-accent';
		}

		$output .= '<div class="pricing-box-button-holder"><a href="' . esc_url( $button_url ) . '" class="btn pricing-box-button btn-hover-dark ' . $btn_color . '">' . esc_html( $button_label ) . '</a></div>';

	}

	$output .= '</div>';

	return $output;

}

remove_shortcode( 'pricing_box' );
add_shortcode( 'pricing_box', 'engage_pricing_box' );
