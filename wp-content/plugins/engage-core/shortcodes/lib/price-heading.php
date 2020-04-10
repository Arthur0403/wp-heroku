<?php

// Price Heading

if ( !function_exists( 'engage_price_heading' ) ) {
	function engage_price_heading( $atts, $content = null ) {

		$title = $label = $h_color = $h_tag = $label_color = $label_color_c = $el_class = $css = $extra_class = '';

		extract( shortcode_atts( array(
			"title" => '',
			"label" => '$10',
			"h_tag" => 'h5',
			"h_color" => '',
			"label_size" => '',
			"label_fw" => '',
			"label_color" => '',
			"label_color_c" => '',
			"el_class" => '',
			"border" => '',
			"css" => ''
		), $atts ) );

		// Vc check
		if ( ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
			return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
		}

		// Label Classes

		$label_classes = $label_css = '';

		if ( $label_size == 'small' ) {
			$label_classes = 'label-small';
		}

		if ( $label_fw != '' ) {
			$label_classes .= ' fw-' . $label_fw;
		}

		if ( $label_color == 'custom' ) {
		 	$label_css = ' style="color:' . esc_attr( $label_color_c ) . '"';
		} elseif( $label_color != '' ) {
			$label_classes .= ' color-' . $label_color;
		}

		// Main Classes

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

		if ( $border == 'yes' ) {
			$extra_class = ' with-border';
		}

		if ( $label_classes != '' ) $label_classes = ' class="' . esc_attr( $label_classes ) . '"';

		// Output

		$output = '<' . esc_attr( $h_tag ) . ' class="price-heading ' . esc_attr( $css_class ) . esc_attr( $extra_class ) . '">';

		$output .= esc_html( $title ) . '<span' . $label_classes . $label_css . '>' . esc_html( $label ) . '</span>';
		$output .= '</' . esc_attr( $h_tag ) . '>';

		return $output;

	}
	remove_shortcode( 'price_heading' );
	add_shortcode( 'price_heading', 'engage_price_heading' );
}
