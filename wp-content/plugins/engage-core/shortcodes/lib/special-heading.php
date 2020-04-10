<?php

// Blog Shortcode

function engage_special_heading( $atts, $content = null ) {

	$defaultFont = 'fontawesome';
	$defaultIconClass = 'fa fa-info-circle';
	$title = $subtitle = $icon_output = $border = $align = $heading_fs = $heading_fw = $heading_transform = $add_icon = '';

	extract( shortcode_atts( array(
		"title" => 'This is a Special Heading',
		"subtitle" => 'This is a subtitle, feel free to change it!',
		"align" => 'default',
		"border" => 'default',
		"add_icon" => 'false',
		"icon" => 'heart-o',
		"icon_type" => $defaultFont,
		"icon_fontawesome" => $defaultIconClass,
		"icon_typicons" => '',
		"icon_openiconic" => '',
		"icon_entypo" => '',
		"icon_linecons" => 'vc_li vc_li-heart',
		"icon_monosocial" => '',
		"icon_material" => 'vc-material vc-material-cake',
		"font_size" => '',
		"font_weight" => '',
		"text_transform" => '',
		"subtitle_fs" => '',
		"subtitle_ff" => '',
		"subtitle_color" => '',
		"el_class" => '',
		"c_margin_top" => '',
		"c_margin_bottom" => '',
		"heading_tag" => 'h3',
		"heading_color" => '',
		"subtitle_mt" => ''
	), $atts ) );

	// Get defaults

	if ( $align == 'default' ) $align = engage_option( 'sheading_align' );
	if ( $align == '' ) $align = 'center';
	if ( $border == 'default' ) $border = engage_option( 'sheading_border' );

	// Heading classes

	$css_classes = array();

	if ( $border == 'below' ) {
		$css_classes[] = 'heading-border-below';
	} elseif ( $border == 'inline' ) {
		$css_classes[] = 'heading-border-inline';
	} else {
		$css_classes[] = 'heading-no-border';
	}

	$css_classes[] = 'heading-align-' . esc_attr( $align );

	// Icon

	if ( $add_icon != "false" ) {

		// Vc check
		if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
			return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
		}

		$icon = str_replace( 'fa-', '', $icon );
		vc_icon_element_fonts_enqueue( $icon_type );
		$iconClass = isset( ${"icon_" . $icon_type} ) ? ${"icon_" . $icon_type} : $defaultIconClass;

		$css_classes[] = 'heading-with-icon';
		$icon_output = '<div class="special-heading-icon colored"><i class="' . $iconClass . '"></i></div>';

	}

	// Inline CSS

	$inline_css = array();
	$inline_styles = '';

	if ( $c_margin_top ) $inline_css[] = 'margin-top:' . esc_attr( str_replace( 'px', '', $c_margin_top ) ) . 'px;';
	if ( $c_margin_bottom ) $inline_css[] = 'margin-bottom:' . esc_attr( str_replace( 'px', '', $c_margin_bottom ) ) . 'px;';

	if ( $inline_css ) $inline_styles = 'style="' . implode( '', $inline_css ) . '"';

	// Output

	$content = '<div class="special-heading vntd-heading ' . implode( ' ', $css_classes ) . '"' . $inline_styles . '>';

	// Icon

	if ( $icon_output ) $content .= $icon_output;

	// Title

	$title = esc_html( $title );
	$title = str_replace( "(b)", '<span class="colored">', $title );
	$title = htmlspecialchars_decode( str_replace( "(/b)", '</span>', $title ) );
	$title_inline_css = array();
	$title_inline_styles = $heading_classes = '';

	if ( $font_weight ) $title_inline_css[] = 'font-weight:' . esc_attr( $font_weight ) . ';';
	if ( $font_size ) $title_inline_css[] = 'font-size:' . esc_attr( $font_size ) . ';';
	if ( $text_transform ) $title_inline_css[] = 'text-transform:' . esc_attr( $text_transform ) . ';';
	if ( $title_inline_css ) $title_inline_styles = 'style="' . implode( '', $title_inline_css ) . '"';
	if ( $heading_color != '' ) $heading_classes .= ' color-' . $heading_color;

	$content .= '<' . $heading_tag . ' class="special-heading-title' . $heading_classes . '"' . $title_inline_styles . '>' . $title . '</' . $heading_tag . '>';

	// Subtitle

	if ( $subtitle ) {
		$subtitle = esc_html( $subtitle );
		$subtitle = str_replace( "(b)", '<span class="colored">', $subtitle );
		$subtitle = htmlspecialchars_decode( str_replace( "(/b)", '</span>', $subtitle ) );
		$subtitle_inline_styles = $subtitle_classes = '';
		if (  $subtitle_fs  ) {
			$subtitle_inline_styles .= 'font-size:' . esc_attr( $subtitle_fs ) . ';';
		}
		if ( $subtitle_ff == 'additional' ) {
			$subtitle_classes .= ' font-additional';
			engage_enqueue_font( 'additional' );
		}
		if ( $subtitle_color != '' ) {
			$subtitle_classes .= ' color-' . $subtitle_color;
		}
		if( $subtitle_mt != '' ) {
			$subtitle_inline_styles .= 'margin-top:' . esc_attr( str_replace( 'px', '', $subtitle_mt ) ) . 'px;';
		}
		if ( $subtitle_inline_styles ) $subtitle_inline_styles = 'style="' . $subtitle_inline_styles . '"';
		$content .= '<p class="special-heading-subtitle' . $subtitle_classes . '"' . $subtitle_inline_styles . '>' . $subtitle . '</p>';
	}

	$content .= '</div>';

	return $content;

}
remove_shortcode( 'special_heading' );
add_shortcode( 'special_heading', 'engage_special_heading' );
