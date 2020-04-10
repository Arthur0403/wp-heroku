<?php

// Blog Posts Carousel

function engage_hero_slider( $atts, $content = null )
{

	$slider_classes = '';

	extract( shortcode_atts( array(
		"style" => 'centered',
		"height" => 'custom',
		"height_custom" => '700',
		"fullwidth" 		=> 'fullwidth',
		"offset" => '0px',
		"autoplay" => 'true',
		"autoplay_timeout" => '7000',
		"slides" => '',
		"button_color" => 'dark',
		"heading_size" => 'default',
		"subtitle_fs" => '',
		"text_size" => 'default',
		"text_size_custom" => '15px',
		"nav" => 'yes',
		"bullet_nav" => 'yes',
		"loop" => 'true',
		"btn_radius" => 'default',
		"scroll_btn" => 'no',
	), $atts ) );

	// WPBakery Page Builder Check
	if ( ! function_exists( 'vc_param_group_parse_atts' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	// Enqueue scripts and styles

	wp_enqueue_script('swiper', '', '', '', true);
	wp_enqueue_style('swiper');
	wp_enqueue_script( 'engage-sliders', '', '', '', true );

	$random_id = rand( 1, 99999 );

	// Fullscreen

	if ( $height == 'fullscreen' ) {
		$slider_classes .= ' veented-slider-fullscreen';
	}

	// Fullwidth

	if( $fullwidth == 'fullwidth' ) {
		$slider_classes .= ' fullwidth-section';
	}

	// Scroll Btn

	if( $scroll_btn == 'yes') $slider_classes .= ' with-scroll-btn';

	// Slider Datas

	$slider_data = array();

	if( $nav != 'yes' ) $nav = 'false';
	$slider_data[] = 'data-nav="' . esc_attr( $nav ) . '"';
	if( $autoplay == 'true' ) $autoplay = $autoplay_timeout;
	$slider_data[] = 'data-autoplay="' . esc_attr( $autoplay ) . '"';
	$slider_data[] = 'data-loop="' . esc_attr( $loop ) . '"';

	// Extra Styling

	$custom_style = $custom_style_inner = '';

	if ( $height_custom > 0 && $height == 'custom' ) {
		$height_custom = str_replace( 'px', '', $height_custom );
		$custom_style = 'style="height:' . esc_attr( $height_custom ) . 'px"';
	}

	if( $offset != 0 ) {
		$offset = str_replace( 'px', '', $offset );
		$custom_style = 'style="padding-top:' . esc_attr( $offset ) . 'px"';
	}

	// Output

	ob_start();

	echo '<div id="hero-slider-' . $random_id . '" class="hero-slider-holder vntd-section veented-slider-holder ' . $slider_classes . '" ' . $custom_style . implode( ' ', $slider_data ) . '>';

	?>

		<div class="veented-slider-loader hero-slider-loader">
			<div class="spinner">
			  <div class="dot1"></div>
			  <div class="dot2"></div>
			</div>
		</div>

		<div class="hero-slider veented-slider swiper-containers">

			<div class="hero-slider-inner veented-slider-inner swiper-wrapper">

			<?php

			$values = (array) vc_param_group_parse_atts( $slides );

			$i = 0;
			$img_bg = false;

			foreach ( $values as $data ) {

				$i++;
				$new_line = $data;

				$new_line[ 'image' ]  = isset( $data['image'] ) ? $data['image'] : '';
				$new_line[ 'heading' ] = isset( $data['heading'] ) ? $data['heading'] : '';
				$new_line[ 'text' ] = isset( $data['text'] ) ? $data['text'] : '';
				$new_line[ 'btn_label' ] = isset( $data['btn_label'] ) ? $data['btn_label'] : '';
				$new_line[ 'btn_url' ] = isset( $data['btn_url'] ) ? $data['btn_url'] : '';
				$new_line[ 'align' ] = isset( $data['align'] ) ? $data['align'] : '';
				$new_line[ 'color' ] = isset( $data['color'] ) ? $data['color'] : '';
				$new_line[ 'bg_color' ] = isset( $data['bg_color'] ) ? $data['bg_color'] : '';
				$new_line[ 'bg_color2' ] = isset( $data['bg_color2'] ) ? $data['bg_color2'] : '';
				$new_line[ 'bg_overlay' ] = isset( $data['bg_overlay'] ) ? $data['bg_overlay'] : '';

				$bg_overlay = $new_line['bg_overlay'];

				if ( strpos( $new_line['image'], 'http') !== false ) {
					$img_url = $new_line['image'];
				} else {
					$img_url = wp_get_attachment_image_src( $new_line['image'], 'full' );
					$img_url = $img_url[0];
				}



				$slide_align = 'center';
				if( $new_line['align'] == 'left' || $new_line['align'] == 'right' ) {
					$slide_align = esc_attr( $new_line['align'] );
				}

				$slide_classes = array();

				$slide_classes[] = 'veented-slide-' . $i;
				$slide_classes[] = 'slide-align-' . $slide_align;

				if( $new_line['color'] == 'dark' ) $slide_classes[] = 'color-scheme-dark';

				$slide_bg_color = '';

				if ( $new_line['bg_color'] ) {
					$slide_bg_color .= 'background:' . $new_line['bg_color'] . ';';
					if ( $new_line['bg_color2'] ) {
						$slide_bg_color .= engage_css_gradient( $new_line['bg_color'], $new_line['bg_color2'] );
					}
				}

				if ( $slide_bg_color != '' ) {
					$slide_bg_color = 'style="' . $slide_bg_color . '"';
				}

				?>

				<div class="swiper-slide hero-slide <?php echo implode( ' ', $slide_classes ); ?>"<?php echo $slide_bg_color; ?>>

				<?php

				// Background Image Holder

				if( $img_url ) {

					$img_bg = true;

					$bg_overlay_e = '';

					if( $bg_overlay != 'none' && $bg_overlay != ''  ) {

						$bg_overlay_e = '<div class="bg-overlay bg-overlay-' . esc_attr( $bg_overlay ) . '"></div>';
					}

					echo '<div class="hero-slide-bg-image veented-slide-bg-image" style="background-image: url(\'' . $img_url . '\');">';
					if ( $bg_overlay_e ) echo $bg_overlay_e;
					echo '<img src="' . $img_url . '" alt>';
					echo '</div>';

				}

				$heading_size_class = '';
				if( $heading_size != '' && $heading_size != 'default' ) {
					$heading_size_class = ' fs' . $heading_size;
				}

				?>

				<div class="inner">

					<div class="hero-slide-inner">

						<h2 class="hero-slide-heading veented-slide-heading<?php echo esc_attr( $heading_size_class ); ?>"> <?php echo esc_html( $new_line['heading'] ); ?></h2>

						<?php

						$subtitle_inline_css = '';

						if ( $new_line['text'] ) {

						if ( $subtitle_fs != 'default' && $subtitle_fs != '' ) {
							$subtitle_inline_css = 'style="font-size:' . esc_attr( $subtitle_fs ) . ';"';
						}

						?>

						<p class="hero-slide-text veented-slide-subtitle"<?php if ( $subtitle_inline_css ) echo $subtitle_inline_css; ?>><?php echo esc_html( $new_line['text'] ); ?></p>

						<?php

						}

						if ( $new_line['btn_label'] ) {

							echo '<div class="hero-slide-buttons">';

							$btn_classes = '';

							$button_href  = esc_url( $new_line['btn_url'] );

							$btn_color = ' btn-text-dark btn-dark btn-hover-dark';

							if ( $new_line['color'] == 'white' ) $btn_color = ' btn-white btn-hover-white';

							$btn_classes .= $btn_color;
							$btn_classes .= ' btn-outline';

							if ( $btn_radius != 'default' ) {
								$btn_classes .= ' btn-' . esc_attr( $btn_radius );
							}

							echo '<a class="btn hero-slider-btn ' . $btn_classes . '" href="' . $button_href . '">' . esc_html( $new_line['btn_label'] ) . '</a>';

							echo '</div>';
						}

						?>
					</div>

				</div>

				</div>

			<?php }

			if ( $img_bg == false ) echo '<div class="vntd-ghost-img"><img src="' .  get_template_directory_uri() . '/img/select-arrows.png' . '"></div>';

			?>

			</div>

			<!-- Slider Arrows -->

			<div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
			<div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

		</div>


	<?php

	// Scroll Button

	if( $scroll_btn != 'no' ) {
		echo '<div class="veented-slider-scroll-button-holder"><a href="#second" class="scroll veented-slider-scroll-button veented-scroll-after"><span class="vntd-mouse-dot"></span></a></div>';
	}

	?>

	</div>

	<?php

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'vntd_hero_slider' );
add_shortcode( 'vntd_hero_slider', 'engage_hero_slider' );
