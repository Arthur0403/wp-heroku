<?php

// Shortcode Processing

function engage_content_box( $atts, $content ) {

	extract( shortcode_atts( array(
		"img" => '',
		"title" => esc_html__( 'Item Title', 'engage' ),
		"text" => '',
		"btn_label" => esc_html__( 'Learn More', 'engage' ),
		"item_url" => '',
		"link_type" => 'inner',
		"item_link_page" => '',
		"target" => '_self',
		"caption_style" => 'boxed',
		"caption_align" => 'left',
		"img_hover" => 'zoom',
		"img_size" => 'engage-masonry-regular',
		"img_size_custom" => '600x360',
		"btn_arrow" => 'yes',
		"title_tag" => 'h5'
	), $atts ) );

	// Item Classes

	$item_classes = array();

	$item_classes[] = 'item simple-grid-item vntd-content-box';
	$item_classes[] = 'simple-grid-' . $caption_style;
	$item_classes[] = 'img-hover-effect-' . $img_hover;
	$item_classes[] = 'caption-align-' . $caption_align;

	if ( $btn_arrow == 'no' ) {
		$item_classes[] = 'vntd-no-arrow';
	} else {
		$item_classes[] = 'vntd-with-arrow';
	}

	$html_tag = 'h5';

	if ( $title_tag == 'h4' || $title_tag == 'h3' || $title_tag = 'h6' ) {
		$html_tag = $title_tag;
	}

	// Img Size

	if ( $img_size == 'portrait' ) {
		$img_size = 'engage-masonry-square';
	}

	if ( !$img ) $item_classes[] = 'item-no-image';

	// Output

	$link_start = $link_end = '';

	// New URL Param

	$url = '';

	if ( $link_type == 'external' && $item_url != '' ) {
		$url = $item_url;
	} else if ( $link_type == 'inner' && $item_link_page != '' ) {
		$url = get_permalink( $item_link_page );
	}

	if ( $url != '' ) {
		$link_start = '<a href="' . esc_url ( $url ) . '" title="' . esc_html( $title ) . '" target="' . esc_attr( $target ) . '">';
		$link_end = '</a>';
	}

	$output = '<div class="' . implode( ' ', $item_classes ) . '">';

		if ( $img ) {

			$size = $item_img = '';

			if ( strpos( $img, 'veented.com') !== false ) {

				$img_url = $img;
				$img_size = '600x420';

				$img_url = str_replace( '.jpg', '-' . $img_size . '.jpg', $img_url );
				$img_url = str_replace( '.jpeg', '-' . $img_size . '.jpeg', $img_url );
				$img_url = str_replace( '.png', '-' . $img_size . '.png', $img_url );

				$item_img = '<img src="' . $img_url . '" alt="' . esc_html( $title ) . '">';

			} elseif ( $img_size == 'custom' && $img_size_custom != '' ) {

				// WPBakery Page Builder Check
			  if ( ! function_exists( 'wpb_getImageBySize' ) ) {
			    return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
			  }

				$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $img, 'thumb_size' => $img_size_custom ) );

				$item_img = $post_thumbnail['thumbnail'];
			} else {
				$thumb = engage_get_thumb( $img, $img_size );
				$thumb_url = $thumb['url'];
				$item_img = '<img src="' . $thumb_url . '" alt="' . esc_html( $title ) . '">';
			}

			$output .= '<div class="simple-grid-image">' . $link_start . $item_img . $link_end . '</div>';
		}

		if ( $title || $text || $btn_label ) {

			$output .= '<div class="simple-grid-caption vntd-caption">';

			if ( $title ) {
				$output .= $link_start . '<' . $html_tag . ' class="simple-grid-title">' . esc_html( $title ) . '</' . $html_tag . '>' . $link_end;
			}
			if ( $text ) {
				$output .= '<p class="simple-grid-description">' . esc_html( $text ) . '</p>';
			}
			if ( $btn_label ) {
				$output .= '<a href="' . esc_url( $url ) . '" class="simple-grid-btn post-more">' . esc_html( $btn_label ) . '</a>' ;
			}

			$output .= '</div>';

		}

	$output .= '</div>';

	return $output;

}

remove_shortcode( 'vntd_content_box' );
add_shortcode( 'vntd_content_box', 'engage_content_box' );
