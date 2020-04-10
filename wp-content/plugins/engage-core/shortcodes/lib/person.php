<?php

// Shortcode Processing

function engage_person( $atts, $content ) {

	extract( shortcode_atts( array(
		"name" => '',
		"position" => '',
		"bio" => '',
		"img" => '',
		"img_size" => 'square',
		"img_size_custom" => false,
		"link" => '',
		"style" => 'modern',
		"boxed" => 'no',
	), $atts ) );

	// Social Profiles

	$social_profiles = '';

	$social_sites = engage_social_sites();

	foreach ( $social_sites as $id => $site_name ) {

		if ( array_key_exists( $id, $atts ) && $atts[ $id ] != '' ) {
		    $fa_class = $id;
		    if ( $id == 'email' ) {
		        $fa_class = 'envelope';
		        $url = 'mailto:' . $atts[ $id ];
            } else {
		        $url = $atts[ $id ];
            }
			$social_profiles .= '<a href="' . esc_url( $url ) . '" class="icon-' . $id . '" target="_blank" alt="' . $site_name . '"><i class="fa fa-' . $fa_class . ' icon-primary"></i></a>';
		}

	}

	// Icons output

	if ( $social_profiles != '' ) {
		$icon_style = '';
		if ( $style == 'classic' ) $icon_style = ' social-icons-outline';
		$social_profiles = '<div class="vntd-social-icons social-icons social-icons-circle' . $icon_style . '">' . $social_profiles . '</div>';
	}

	// Item Classes

	$item_classes = array();
	$item_classes[] = 'team-members-' . $style;
	$item_classes[] = 'team-members-' . $boxed;

	// Img Size

	if ( $img_size == 'square' ) {
		$img_size = 'engage-masonry-square';
	} elseif ( $img_size == 'regular' ) {
		$img_size = 'engage-masonry-regular';
	}

	// Output

	$output = '<div class="team-item vntd-person wpb_content_element ' . implode( ' ', $item_classes ) . '">';

	if ( $img ) {

		$person_url = '';

		if ( $link != '' ) $person_url = 'href="' . esc_url ( $link ) . '"';

		$output .= '<div class="item-main"><a ' . $person_url . ' class="item-image">';

		$img = engage_get_img_url( $img, $img_size, $img_size_custom );
		$img_url = $img[ 'url' ];

		$output .= '<img src="' . $img_url . '" alt="' . esc_html( $name ) . '" title="' . esc_html( $name ) . '">';

		$output .= '</a>';

		if ( $style == 'modern' && $social_profiles != '' ) {

			$output .= '<div class="item-overlay"><div class="item-overlay-inner">';

			$output .= $social_profiles;

			$output .= '</div></div>';

		}

		$output .= '</div>';

	}

	// Caption

	$output .= '<div class="item-caption"><div class="item-caption-inner"><div class="team-caption-header"><div class="team-caption-titles"><h4 class="item-title team-member-name">' . esc_html( $name ) . '</h4><div class="caption-categories member-position">' . esc_html( $position ) . '</div></div>';

	if ( $style == 'classic' && $social_profiles != '' ) {
		$output .= '<div class="team-caption-social"> ' . $social_profiles . '</div>';
	}

	$output .= '</div>';

	// Biography

	if ( $bio ) {
		$output .= '<div class="team-caption-bio">' .$bio . '</div>';
	}

	$output .= '</div></div></div>';

	return $output;

}

remove_shortcode( 'vntd_person' );
add_shortcode( 'vntd_person', 'engage_person' );
