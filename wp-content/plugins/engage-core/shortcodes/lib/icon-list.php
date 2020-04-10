<?php

// Icon List Shortcode

function vntd_icon_list( $atts, $content = null )
{
    $el_class = '';


	extract( shortcode_atts( array(
		"icons_color" => 'gray',
		"elements" => '',
		"border" => 'on',
		"size" => 'regular',
		"style" => '',
        "el_class" => ''
	), $atts ) );

  // WPBakery Page Builder Check
  if ( ! function_exists( 'vc_param_group_parse_atts' ) ) {
    return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
  }

	$css_classes = array();

	$css_classes[] = 'icon-list-' . esc_attr( $size );

	// Border

	if( $border == 'off' ) {
		$css_classes[] = 'icon-list-no-border';
	} else {
		$css_classes[] = 'icon-list-border';
	}

	// Icons Color

	$icon_css = '';

	if( $icons_color != 'gray' ) {
		$css_classes[] = 'icon-list-color-' . esc_attr( $icons_color );
		if ( $style == 'outline' ) {
			$selector = ' color-';
		} else {
			$selector = ' bg-color-';
		}
		$icon_css = $selector . esc_attr( $icons_color );
	}

	if ( $style == 'outline' ) {
		$css_classes[] = 'icon-list-outline';
	}

	// Style

	$css_classes[] = 'icon-list-circle';

	// Shortcode Output

	ob_start();

	echo '<div class="vntd-icon-list ' . implode( ' ', $css_classes ) . '"><ul class="icon-list">';

	$values = (array) vc_param_group_parse_atts( $elements );

	foreach ( $values as $data ) {

		$new_line = $data;

		$new_line['icon_fontawesome']  = isset( $data['icon_fontawesome'] ) ? $data['icon_fontawesome'] : '';
		$new_line['text'] = isset( $data['text'] ) ? $data['text'] : '';
		$icon_class = $new_line['icon_fontawesome'];
		if ( $el_class == 'omd-icons' ) $icon_class = str_replace( 'fa fa-', 'omd_icon-', $icon_class );
		echo '<li><i class="' . esc_attr( $icon_class ) . $icon_css . '"></i><span class="icon-list-text">' . wp_kses( $new_line['text'], engage_kses() ) . '</span></li>';

	} // End foreach

	echo '</ul></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'vntd_icon_list' );
add_shortcode( 'vntd_icon_list', 'vntd_icon_list' );
