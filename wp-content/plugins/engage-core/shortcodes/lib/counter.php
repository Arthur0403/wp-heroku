<?php

// Counter Shortcode Processing

if( !function_exists( 'engage_counter' ) ) {
	function engage_counter( $atts, $content = null ) {

		$defaultFont      = 'fontawesome';
		$defaultIconClass = 'fa fa-info-circle';
		$icon = true;

		extract( shortcode_atts( array(
			"title" => 'Days',
			"number" => '100',
			"color" => 'dark',
			"color_custom" => '',
			"add_icon" => true,
			"icon" => 'heart-o',
			"icon_type" => $defaultFont,
			"icon_fontawesome" => $defaultIconClass,
			"icon_typicons" => '',
			"icon_openiconic" => '',
			"icon_entypo" => '',
			"icon_linecons" => ''
		), $atts ) );

		// WPBakery Page Builder Check
		if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
			return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
		}
		

		wp_enqueue_script( 'appear', '', '', '', true );
		wp_enqueue_script( 'engage-appear', '', '', '', true );

		$extra_classes = '';
		$rand_id = rand( 1, 1000 );

		// Icon related

		if( gettype( $add_icon ) === 'string' ) {
			$icon = false;
		}

		if( $icon ) {

			$icon = str_replace( 'fa-', '', $icon );
			vc_icon_element_fonts_enqueue( $icon_type );
			$iconClass = isset( ${"icon_" . $icon_type} ) ? ${"icon_" . $icon_type} : $defaultIconClass;

			$extra_classes = ' counter-with-icon';
		}

		// End Icon related

		$extra_style = '';

		if( $color == 'custom' && $color_custom != '' ) {
			$extra_style = 'style="color:' . esc_attr( $color_custom ) . ';"';
		}

		$return = '<div id="counter-' . $rand_id . '" class="vntd-counter vntd-content-element counter-color-' . esc_attr( $color ) . $extra_classes . '" data-perc="' . esc_attr( $number ) . '">';

		if( $icon ) {
			$return .= '<div class="counter-icon"><i class="' . $iconClass . '"' . $extra_style . '></i></div>';
		}

		$return .= '<div class="counter-value"><div class="counter-number"' . $extra_style . '>0</div></div>';

		$return .= '<div class="counter-title">' . esc_html( $title ) . '</div>';

		$return .= '</div>';

		return $return;
	}
	remove_shortcode( 'counter' );
	add_shortcode( 'counter', 'engage_counter' );
}
