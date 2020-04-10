<?php

function engage_cta( $atts, $content = null )
{
	extract( shortcode_atts( array(
		"button1_title" => 'Button Text',
		"button1_url" => '',
		"button1_style" => 'outline',
		"button2_title" => '',
		"button2_url" => '',
		"button2_style" => 'solid',
        "btn1_class" => '',
        "btn2_class" => '',
		"text_color" => 'white',
		"button1_color" => 'white',
		"button2_color" => 'white',
		"container" => 'contain',
		"align" => 'left',
		"subheading" => esc_html__( "I'm a description text, feel free to change me!", "engage" ),
		"heading" => esc_html__( "This is the main heading.", "engage" ),
		"el_bg" => 'accent',
		"bg_color_custom" => '',
		"bg_color_custom2" => '',
		"extra_class" => '',
		"btn_radius" => 'default'
	), $atts ) );

	// WPBakery Page Builder Check
	if ( ! function_exists( 'vc_build_link' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	$extra_style = $extra_style = $return = $container_start = $container_end = '';

	if ( $subheading )
		$extra_class = ' cta-with-subtitle';

	// Custom Color

	if ( $el_bg == 'custom' && $bg_color_custom != '' ) {
		$extra_style = ' style="background-color: ' . esc_attr( $bg_color_custom ) . '"';
		if ( $bg_color_custom2 != '' ) {
			$extra_style = ' style="' . engage_css_gradient( $bg_color_custom, $bg_color_custom2 ) . '"';
		}
	} elseif ( $el_bg == 'dark' ) {
		$el_bg = 'dark';
	} elseif ( $el_bg == 'light' ) {
		$el_bg = 'light';
	} elseif ( $el_bg == 'none' ) {
		$el_bg = 'none';
	} elseif ( $el_bg != '' ) {
		$el_bg = $el_bg;
	}

	// Container

	if ( $container == 'contain' ) {
		$container_start = '<div class="container">';
		$container_end = '</div>';
	}

	$css_classes = array();

	$css_classes[] = 'cta-text-color-' . $text_color;
	$css_classes[] = 'bg-color-' . $el_bg;

	// Alignment

	$col1_class = ' col-md-8 col-sm-12';
	$col2_class = ' col-md-4 col-sm-12';

	if ( $align == 'center' ) {
		$col1_class = $col2_class = '';
	}
	$css_classes[] = 'cta-align-' . $align;


	$return .= '<div class="vntd-cta ' . implode( ' ', $css_classes ) . '"' . $extra_style . '>' . $container_start . '<div class="row"><div class="cta-texts' . $col1_class . '">';

	// Heading

	$return .= '<h2 class="cta-heading"><span>' . esc_html( $heading ) . '</span></h2>';

	// Subtitle

	if ( $subheading ) {
		$return .= '<p class="cta-subtitle">' . esc_html( $subheading ) . '</p>';
	}

	// Buttons

	if ( $button1_title || $button2_title ) {

		$btn_classes = '';

		if ( $btn_radius != 'default' ) {
			$btn_classes .= ' btn-' . esc_attr( $btn_radius );
		}

		$return .= '</div><div class="cta-buttons' . $col2_class . '">';

		if ( $button1_title ) {

			$btn1_classes = 'btn-' . $button1_style;
			$btn1_classes .=  ' btn-' . $button1_color;

			if( $button1_style == 'outline' ) {
				$btn1_classes .= ' btn-hover-' . $button1_color;
			} else {
				$btn1_classes .= ' btn-hover-dark';
			}

            if ( $btn1_class != '' ) {
                $btn1_classes .= ' ' . esc_attr( $btn1_class );
            }

			$return .= engage_build_link( $button1_title, $button1_url, 'btn cta-btn1 ' . $btn1_classes . $btn_classes );

		}

		if ( $button2_title ) {

			$btn2_classes = 'btn-' . $button2_style;
			$btn2_classes .=  ' btn-' . $button2_color;

			if( $button2_style == 'outline' ) {
				$btn2_classes .= ' btn-hover-' . $button2_color;
			} else {
				$btn2_classes .= ' btn-hover-white';
			}

            if ( $btn2_class != '' ) {
                $btn2_classes .= ' ' . esc_attr( $btn2_class );
            }

			$return .= engage_build_link( $button2_title, $button2_url, 'btn cta-btn2 ' . $btn2_classes . $btn_classes );

		}

		$return .= '</div>';
	}


	$return .= $container_end . '</div></div>';

	return $return;
}
remove_shortcode( 'cta' );
add_shortcode( 'cta', 'engage_cta' );
