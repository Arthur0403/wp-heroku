<?php

// Icon List Shortcode

function vntd_list( $atts, $content = null )
{
	extract( shortcode_atts( array(
		"icon" => 'fa fa-star',
		"icon_color" => 'accent',
		"items" => 'List Item 1,List Item 2,List Item 3',
		"style" => 'basic'
	), $atts ) );

	$css_classes = array();

	// Icons Color

	$icon_css = '';
	if ( $icon_color != '' ) {
		$css_classes[] = 'icon-list-color-' . esc_attr( $icon_color );

		if ( $style == 'circle' ) {
			$icon_css = ' bg-color-' . esc_attr( $icon_color );
		} else {
			$icon_css = ' color-' . esc_attr( $icon_color );
		}
	}

	// Shortcode Output

	ob_start();

	echo '<div class="vntd-icon-list icon-list-simple icon-list-' . esc_attr( $style ) . ' ' . implode( ' ', $css_classes ) . '"><ul class="icon-list">';

	$items_arr = explode( ',', $items );

	foreach ( $items_arr as $item ) {
	    $item = str_replace( '(comma)', '', $item );
		echo '<li><i class="' . esc_attr( $icon ) . $icon_css . '"></i>' . esc_html( $item ) . '</li>';
	}

	echo '</ul></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'vntd_list' );
add_shortcode( 'vntd_list', 'vntd_list' );
