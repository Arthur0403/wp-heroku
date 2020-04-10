<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Portfolio Grid Shortcode
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_simple_grid( $atts, $content = null) {
	extract(shortcode_atts(array(
		"cols" => 3,
		"caption_style" => 'boxed',
		"caption_align" => 'left',
		"img_hover" => 'zoom',
		"items" => '',
		"img_size" => 'engage-masonry-regular',
		"img_size_custom" => '600x360',
		"btn_arrow" => 'yes',
	), $atts));

	// Vc check
	if ( ! function_exists( 'vc_param_group_parse_atts' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	// Enqueue portfolio related scripts and styles

	wp_enqueue_script('cube-portfolio');
	wp_enqueue_script('engage-grid');
	wp_enqueue_style('cube-portfolio');

	$grid_id = rand( 1,9999 );

	$layout_class = $post_in = '';

	// Portfolio Container Classes

	$container_classes = array();

	$container_classes[] = 'simple-grid-' . $caption_style;
	$container_classes[] = 'grid-cols-' . $cols;
	$container_classes[] = 'img-hover-effect-' . $img_hover;
	$container_classes[] = 'caption-align-' . $caption_align;

	if ( $btn_arrow == 'no' ) {
		$container_classes[] = 'vntd-no-arrow';
	} else {
		$container_classes[] = 'vntd-with-arrow';
	}

	if ( $img_size == 'portrait' ) {
		$img_size = 'engage-masonry-square';
	}

	ob_start();

	echo '<div id="simple-grid-' . $grid_id . '" class="vntd-grid vntd-simple-grid ' . esc_attr( implode( ' ', $container_classes ) ) . '">';

		echo '<div class="simple-grid-items container">';

		$values = (array) vc_param_group_parse_atts( $items );

		$i = 0;

		$item_class = 'item simple-grid-item ';
		$col_class = 'vc_col-sm-4';

		if ( $cols == 4 ) {
			$col_class = 'vc_col-sm-3';
		} elseif ( $cols == 2 ) {
			$col_class = 'vc_col-sm-6';
		}

		$item_class .= $col_class;

		foreach ( $values as $data ) {

			$i++;
			$row_closed = false;

			if ( $i == 1 ) {
				echo '<div class="vc_row wpb_row">';
			}

			$new_line = $data;

			$new_line['img']  = isset( $data['img'] ) ? $data['img'] : '';
			$new_line['title'] = isset( $data['title'] ) ? $data['title'] : '';
			$new_line['text'] = isset( $data['text'] ) ? $data['text'] : '';
			$new_line['btn_label'] = isset( $data['btn_label'] ) ? $data['btn_label'] : '';
			$new_line['item_url'] = isset( $data['item_url'] ) ? $data['item_url'] : '';

			$link_start = $link_end = '';

			if ( $new_line['item_url'] ) {
				$link_start = '<a href="' . esc_url ( $new_line['item_url'] ) . '" title="' . esc_html( $new_line['title'] ) . '">';
				$link_end = '</a>';
			}

			echo '<div class="' . $item_class . '">';

				if ( $new_line['img'] ) {

					$size = $img = '';

					if ( $img_size == 'custom' && $img_size_custom != '' ) {
						$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $new_line['img'], 'thumb_size' => $img_size_custom ) );

						$img = $post_thumbnail['thumbnail'];
					} else {
						$thumb = engage_get_thumb( $new_line['img'], $img_size );
						$img_url = $thumb['url'];
						$img = '<img src="' . $img_url . '" alt="' . esc_html( $new_line['title'] ) . '">';
					}

					echo '<div class="simple-grid-image">' . $link_start . $img . $link_end . '</div>';
				}

				if ( $new_line['title'] || $new_line['text'] || $new_line['btn_label'] ) {

					echo '<div class="simple-grid-caption vntd-caption">';

					if ( $new_line['title'] ) {
						echo '<h5 class="simple-grid-title">' . esc_html( $new_line['title'] ) . '</h5>';
					}
					if ( $new_line['text'] ) {
						echo '<p class="simple-grid-description">' . esc_html( $new_line['text'] ) . '</p>';
					}
					if ( $new_line['btn_label'] ) {
						echo '<a href="' . esc_url( $new_line['item_url'] ) . '" class="simple-grid-btn post-more">' . esc_html( $new_line['btn_label'] ) . '</a>' ;
					}
					echo '</div>';

				}

			echo '</div>';

			// Row end

			if ( $i == $cols ) {
				$i = 0;
				echo '</div>';
				$row_closed = true;
			}

		} // End foreach

		if ( $row_closed == false ) echo '</div>';

		echo '</div>';


	echo '</div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}

remove_shortcode( 'vntd_simple_grid' );
add_shortcode( 'vntd_simple_grid', 'engage_simple_grid' );
