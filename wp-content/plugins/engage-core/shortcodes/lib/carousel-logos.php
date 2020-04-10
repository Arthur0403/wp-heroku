<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Logos Carousel
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists( 'engage_client_logos' ) ) {
	function engage_client_logos($atts, $content = null) {

		$item_class = $element_class = '';

		extract( shortcode_atts( array(
			"images" => '',
			"onclick" => '',
			"custom_links" => '',
			"link_target" => 'no',
			"cols" => 4,
			"cols_grid" => 4,
			"cols_tablet" => 3,
			"cols_mobile" => 2,
			"dots" => "true",
			"type" => 'carousel',
			"autoplay" => 'true',
			"autoplay_timeout" => 7000,
			"nav" => "false",
			"nav_position" => "bottom",
			"logos_height" => 'regular'
		), $atts ) );

		if ( $type == 'grid' ) {
			$cols = $cols_grid;
			$element_class = ' vntd-grid vntd-grid-' . esc_attr( $cols );
			$item_class = ' vntd-grid-item';
		} else {
			wp_enqueue_script( 'owl-carousel', '', '', '', true );
			wp_enqueue_script( 'engage-carousels', '', '', '', true );
			wp_enqueue_style( 'owl-carousel' );
			$element_class = ' vntd-carousel owl-carousel';
		}

		ob_start();

		$link_href = '';

		if ( $autoplay == 'false' ) $autoplay_timeout = 0;

		if( $onclick == 'custom_link' ) {
			$custom_links = explode( ',', $custom_links );

			if ( $link_target == 'yes' ) {
				$link_target = '_blank';
			} else {
				$link_target = '_self';
			}
		}

		$images = explode( ',', $images );

		$i = -1;

		echo '<div class="vntd-client-logos-holder vntd-carousel-holder">';

		echo '<div class="vntd-client-logos client-logos-' . $type . $element_class . ' logos-height-' . esc_attr( $logos_height ) . '" data-cols="' . esc_attr( $cols ) . '" data-dots="' . esc_attr( $dots ) . '" data-cols-tablet="' . esc_attr( $cols_tablet ) . '" data-cols-mobile="' . esc_attr( $cols_mobile ) . '" data-autoplay=" ' . esc_attr( $autoplay ) . '" data-autoplay-timeout=" ' . esc_attr( $autoplay_timeout ) . '">';

		foreach ( $images as $attach_id ) {

			$i++;
			$link_href = '';

			if ( $onclick == 'custom_link' ) {
				$link_href = ' href="' . esc_url( $custom_links[$i] ) . '" target="' . $link_target .'"';
			}

            if ( strpos($attach_id, '.com') !== false) {
                $img_url = $attach_id;
            } else {
                $img = wp_get_attachment_image_src( $attach_id, 'full' );
                $img_url = $img[0];
            }



			?>
			<div class="client-logo<?php if( $type == 'grid' ) echo $item_class; ?>">
				<!-- Logo Link -->
				<a <?php if( $link_href ) echo $link_href; ?>>
					<!-- Logo Image SRC -->
					<img src="<?php echo esc_url( $img_url ); ?>" alt>
				</a>
			</div>
			<?php

		}

		echo '</div></div>';

		$content = ob_get_contents();
		ob_end_clean();

		return $content;

	}

	remove_shortcode( 'client_logos' );
	add_shortcode( 'client_logos', 'engage_client_logos' );
}
