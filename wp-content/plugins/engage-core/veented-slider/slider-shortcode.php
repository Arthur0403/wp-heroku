<?php

// Blog Posts Carousel

function engage_slider($atts, $content = null) {

    $cats = '';

	extract( shortcode_atts( array(
		"cats" => '',
		"height" => 'fullscreen',
		"height_custom" => '',
		"offset" => '',
		"scroll_button" => 'no',
		"slider_id" => '',
		"animated" => 'yes',
		"parallax" => 'yes',
		"autoplay" => '7000',
		"slider_speed" => '700',
		"simulate_touch" => 'true',
		"loop" => 'true',
		"slider_effect" => 'slide',
		"slider_direction" => 'horizontal',
		"arrow_navigation" => 'true',
		"bullet_navigation" => 'true',
		"parallax" => 'yes',
		"fullwidth" => 'fullwidth',
		"scroll_btn" => 'no'
	), $atts ) );

	$slider_fullscreen = $slider_classes = $slider_parallax_class = $parallax_content = $parallax_container = '';

	// Enqueue Slider Scripts & Styles

	wp_enqueue_script( 'engage-sliders', '', '', '', true );
	wp_enqueue_script( 'swiper', '', '', '', true );
	wp_enqueue_style( 'swiper' );

	// Parallax

	if( $parallax == 'yes' ) {

		wp_enqueue_script('skrollr', '', '', '', true);
		$slider_parallax_class = ' veented-slider-parallax';
		$parallax_content = 'data-0="opacity:1;transform:translateY(0px);" data-500="opacity:0;transform:translateY(-40px);"';
		$parallax_container = 'data-0="transform: translateY(0px);" data-end="transform: translateY(-350px);"';
		$parallax_container = 'data-0="transform: translateY(0px);" data-top-bottom="transform: translateY(-350px);"';

	}

	// Fullwidth

	if( $fullwidth == 'fullwidth' ) {
		$slider_classes .= ' fullwidth-section';
	}

	// Slider Height

	if( $height != 'custom' ) {
		$slider_fullscreen .= ' fullscreen-section';
	}

	// Unique Slider ID

	if( $slider_id == '' ) {
		$slider_id = rand( 1, 99999 );
	}


	$slider_id = esc_attr( $slider_id );

	// Slider CSS

	$slider_css = '<style type="text/css">';

	ob_start();

	?>

    <div id="veented-slider-<?php echo $slider_id; ?>" class="veented-slider vntd-section veented-slider-holder veented-slider-navigation-white<?php echo $slider_fullscreen . $slider_classes . $slider_parallax_class; ?>" data-slider-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-slider-effect="<?php echo esc_attr( $slider_effect ); ?>" data-slider-speed="<?php echo esc_attr( $slider_speed ); ?>" data-slider-loop="<?php echo esc_attr( $loop ); ?>" data-slider-touch="<?php echo esc_attr( $simulate_touch ); ?>" data-slider-direction="<?php echo esc_attr( $slider_direction ); ?>">

		<div class="veented-slider-loader">
			<div class="spinner">
			  <div class="dot1"></div>
			  <div class="dot2"></div>
			</div>
		</div>

		<div class="veented-slider-container swiper-containers<?php if( $height != 'custom' ) echo ' ' . $slider_fullscreen; ?>"<?php if( $parallax == 'yes' ) echo $parallax_container; ?>>

			<div class="veented-slider-inner swiper-wrapper">

				<?php

				wp_reset_postdata();

        // Maximum number of slides, default is unlimited
        $posts_per_page = -1;

        if ( has_filter( 'engage_slider_slides_limit' ) ) {
          $posts_per_page = apply_filters( 'engage_slider_slides_limit', $posts_per_page );
        }

				$args = array(
					'post_type' 		=> 'veented_slider',
					'slide-locations' 	=> $cats,
					'orderby' 			=> 'date',
					'order' 			=> "DESC",
          'posts_per_page' => $posts_per_page,
				);

				$the_query = new WP_Query($args);
				$i = 0;

				if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

				// Begin Slide Loop

				$i++;
				$css_classes = array();
				$bg_img_url = $slide_bg = $slide_bg_lazy = $slide_css = $slide_bg_overlay = '';

				// Slide ID

				$slide_id = 'slide-id-' . get_the_ID();

                $css_classes[] = 'slide-nr-' . $i;
				$css_classes[] = $slide_id;

				// Slide background type

				$bg_type = 'image';

				if ( get_post_meta( get_the_ID(), "slide_background_type", TRUE) ) {

					$bg_type = get_post_meta( get_the_ID(), "slide_background_type", TRUE);

				}

				if ( $bg_type == 'youtube' ) { // Video background

					wp_enqueue_script('YTPlayer', '', '', '', true);
					wp_enqueue_style('YTPlayer');

				} elseif( $bg_type != 'color' ) { // Solid color background

					$bg_img = get_post_meta( get_the_ID(), "slide_image", true );
					if ( array_key_exists( 'url', $bg_img ) ) {
						$bg_img_url = $bg_img['url'];
					}

				}

				$css_classes[] = 'slide-type-' . $bg_type;

				// Animation

				$animated_class = '';

				if( get_post_meta(get_the_ID(),"animation",TRUE) != 'no' && $animated != 'no' ) {
					$animated_class = ' animated animatedSlider';
				}

				// Slide Color Scheme

				$slide_color = 'light';

				if( get_post_meta( get_the_ID(), "slide_color", TRUE ) == 'dark' ) {
					$slide_color = 'dark';
				}

				$css_classes[] = 'color-scheme-' . $slide_color;

				// Alignment

				$slide_align = 'center';

				if( get_post_meta( get_the_ID(), "slide_content_align", TRUE ) ) {
					$slide_align = esc_attr( get_post_meta( get_the_ID(), "slide_content_align", TRUE ) );
				}

				$css_classes[] = 'slide-align-' . $slide_align;

				// Container width

				$container_class = '';

				$container_width = get_post_meta( get_the_ID(), "slide_content_container", TRUE );

				if( $container_width == 'stretched' ) {
					$container_class = '-large';
				}

				// Content width

				$content_width = get_post_meta( get_the_ID(), "slide_content_width", TRUE );

				if ( $content_width == 'fullwidth' ) {
					$css_classes[] = 'slide-content-fullwidth';
				} else {
					$css_classes[] = 'slide-content-narrow';
				}

				// Slide CSS

				$slide_css = veented_slider_slide_css( $slide_id );

				if ( $slide_css != '' ) $slider_css .= $slide_css;

				?>

				<div id="<?php echo esc_attr( $slide_id ); ?>" class="swiper-slide veented-slide <?php echo implode( ' ', array_unique( $css_classes ) ) ?>">

					<?php

					// Background Image Holder

					if ( $bg_type == 'image' || $bg_type == 'video' ) {

            $bg_img_position = '';

            if ( get_post_meta( get_the_ID(), "slide_bg_img_position", TRUE ) != '' ) {
                $bg_img_position = 'background-position:' . esc_attr( get_post_meta( get_the_ID(), "slide_bg_img_position", TRUE ) ) . ';';
            }

						echo '<div class="veented-slide-bg-image" style="background-image: url(\'' . esc_url( $bg_img_url ) . '\');' . $bg_img_position . '">';
						echo '<img src="' . esc_url( $bg_img_url ) . '" alt="' . esc_html( get_post_meta( get_the_ID(), "slide_heading", TRUE ) ) . '">';
						echo '</div>';

					}

					?>

					<div class="slide-container container<?php echo $container_class; ?>">
						<div class="veented-slide-inner"<?php if( $parallax_content ) echo $parallax_content; ?>>
							<?php

							// Extra Image

							if( is_array( get_post_meta( get_the_ID(), "slide_extra_image", TRUE ) ) ) {

								$slide_extra_img = get_post_meta( get_the_ID(), "slide_extra_image", TRUE );

								if( $slide_extra_img[ 'url' ] ) {

									$slider_height = '';

									if( get_post_meta( get_the_ID(), "slide_extra_image_height", TRUE ) ) {
										$slider_height = ' style="height: ' . esc_attr( get_post_meta( get_the_ID(), "slide_extra_image_height", TRUE ) ) . 'px;"';
									}

									echo '<div class="veented-slide-extra-image' . $animated_class . '"><img src="' . esc_url( $slide_extra_img[ 'url' ] ) . '" alt' . $slider_height . '></div>';
								}

							}

                            // Top heading

							if( get_post_meta( get_the_ID(), "slide_top_heading", TRUE ) ) {

								echo '<h6 class="veented-slide-top-heading' . $animated_class . '">' . esc_html( get_post_meta( get_the_ID(), "slide_top_heading", TRUE ) ) . '</h6>';

							}

							// Main heading

							if ( get_post_meta( get_the_ID(), "slide_heading", TRUE ) ) {

								echo '<h2 class="veented-slide-heading' . $animated_class . '">' . esc_html( get_post_meta( get_the_ID(), "slide_heading", TRUE ) ) . '</h2>';

							}

							if( get_post_meta( get_the_ID(), "slide_subtitle", TRUE ) ) {

								echo '<p class="veented-slide-subtitle' . $animated_class . '">' . esc_html( get_post_meta( get_the_ID(), "slide_subtitle" , TRUE ) ) .'</p>';

							}

							// Slide Buttons

							$button1_label = esc_html__('Learn More', 'engage');
							$button2_label = '';

							if( get_post_meta( get_the_ID(), "slide_button1_label", TRUE ) ) {
								$button1_label = get_post_meta( get_the_ID(), "slide_button1_label", TRUE );
							} else {
							    $button1_label = false;
                            }

							$button2_label = get_post_meta( get_the_ID(), "slide_button2_label", TRUE );

							if( $button1_label || $button2_label ) {

								echo '<div class="veented-slide-buttons' . $animated_class . '">';

								// Button Radius

								$btn_radius = ' btn-default-radius';

								if( get_post_meta( get_the_ID(), "slide_buttons_border", TRUE ) == 'circle' ) {
									$btn_radius = ' btn-circle';
								} elseif( get_post_meta( get_the_ID(), "slide_buttons_border", TRUE ) == 'square' ) {
									$btn_radius = ' btn-square';
								}

								// First Button

								if( $button1_label ) {

									$button1_url = '#';
									$button1_action = get_post_meta( get_the_ID(), "slide_button1_action" , TRUE );
									$button1_classes = array();
									$button1_target = $button1_inline_css = '';

									// Button Style

									$button1_style = 'solid';

									if( get_post_meta( get_the_ID(), "slide_button1_style", TRUE ) == 'bordered' ) {
										$button1_style = 'bordered';
									}

									$button1_classes[] = 'btn-' . $button1_style;
									$button1_classes[] = $btn_radius;

									// Button Color

									$button1_color = 'white';

									if( get_post_meta( get_the_ID(), "slide_button1_color", TRUE ) == 'custom' && ( get_post_meta( get_the_ID(), "slide_button1_color_custom", TRUE ) != '' || get_post_meta( get_the_ID(), "slide_button1_bg_color_custom", TRUE ) != '' ) ) {

										$button1_inline_css = ' style="';

										$new_color = get_post_meta( get_the_ID(), "slide_button1_bg_color_custom", TRUE );

										if( $button1_style == 'bordered' ) {
											$button1_inline_css .= 'border-color:' . $new_color .';';
										} else {
											$button1_inline_css .= 'background-color:' . $new_color .';';
										}

										if( get_post_meta( get_the_ID(), "slide_button1_color_custom", TRUE ) != '' ) {
											$button1_inline_css .= 'color:' . get_post_meta( get_the_ID(), "slide_button1_color_custom", TRUE ) .';';
										}

										$button1_inline_css .= '"';

										$button1_color = 'custom';

									} elseif( get_post_meta( get_the_ID(), "slide_button1_color", TRUE ) ) {

										$button1_color = esc_attr( get_post_meta( get_the_ID(), "slide_button1_color", TRUE ) );

									}

									$button1_classes[] = 'btn-' . $button1_color;

									// Button Hover Color

									$button1_hover_color = 'white';

									if( get_post_meta( get_the_ID(), "slide_button1_hover_color", TRUE ) != '' ) {

										$button1_hover_color = get_post_meta( get_the_ID(), "slide_button1_hover_color", TRUE );

									}

									$button1_classes[] = 'btn-hover-' . $button1_hover_color;

									// Button Action

									if ( $button1_action == 'link_external' && get_post_meta( get_the_ID(), "slide_button1_link_url", TRUE ) != '' ) {

										$button1_url = esc_url( get_post_meta( get_the_ID(), "slide_button1_link_url", TRUE ) );
										$button1_target = ' target="_self" ';
										if ( get_post_meta( get_the_ID(), "slide_button1_link_target", TRUE ) == '_blank' ) $button1_target = ' target="_blank" ';

									} elseif ( $button1_action == 'video' && get_post_meta( get_the_ID(), "slide_button1_video_url", TRUE ) != '' ) {

                                        $button1_url = esc_url( get_post_meta( get_the_ID(), "slide_button1_video_url", TRUE ) );
                                        $button1_target = '';
                                        $button1_classes[] = 'mp-video';
                                        wp_enqueue_script( 'magnific-popup', '', '', '', true );
                                        wp_enqueue_style( 'magnific-popup' );

                                    } elseif( $button1_action == 'scroll_to' && get_post_meta( get_the_ID(), "slide_button1_link_url", TRUE ) != '' ) {

										$button1_classes = 'button-scroll';
										$button1_url = get_post_meta( get_the_ID(), "slide_button1_link_url", TRUE );

									} elseif( $button1_action == 'link' ) {

										$button1_url = get_permalink( get_post_meta( get_the_ID(), "slide_button1_link_page", TRUE ) );
										$button1_target = ' target="_self" ';
										if( get_post_meta( get_the_ID(), "slide_button1_link_target", TRUE ) == '_blank' ) $button1_target = ' target="_blank" ';

									} else { // Scroll after slider

										$button1_classes[] = 'button-scroll-after-slider';

									}

									echo '<a href="' . $button1_url . '"' . $button1_target . 'class="btn btn-lg veented-slide-button veented-slide-button1 ' . implode( ' ', $button1_classes ) . '"' . $button1_inline_css . '><span>' . esc_html( $button1_label ) . '</span></a>';

								}

								// Second Button

								if( $button2_label ) {

									$button2_url = '#';
									$button2_action = get_post_meta( get_the_ID(), "slide_button2_action" , TRUE );
									$button2_classes = array();
									$button2_target = $button2_inline_css = '';

									// Button Style

									$button2_style = 'bordered';

									if( get_post_meta( get_the_ID(), "slide_button2_style", TRUE ) == 'solid' ) {
										$button2_style = 'solid';
									}

									$button2_classes[] = 'btn-' . $button2_style;
									$button2_classes[] = $btn_radius;

									// Button Color

									$button2_color = 'white';

									if( get_post_meta( get_the_ID(), "slide_button2_color", TRUE ) == 'custom' && ( get_post_meta( get_the_ID(), "slide_button2_color_custom", TRUE ) != '' || get_post_meta( get_the_ID(), "slide_button2_bg_color_custom", TRUE ) != '' ) ) {

										$button2_inline_css = ' style="';

										$new_color = get_post_meta( get_the_ID(), "slide_button2_bg_color_custom", TRUE );

										if( $button2_style == 'bordered' ) {
											$button2_inline_css .= 'border-color:' . $new_color .';';
										} else {
											$button2_inline_css .= 'background-color:' . $new_color .';';
										}

										if( get_post_meta( get_the_ID(), "slide_button2_color_custom", TRUE ) != '' ) {
											$button2_inline_css .= 'color:' . get_post_meta( get_the_ID(), "slide_button2_color_custom", TRUE ) .';';
										}

										$button2_inline_css .= '"';

										$button2_color = 'custom';

									} elseif( get_post_meta( get_the_ID(), "slide_button2_color", TRUE ) ) {

										$button2_color = esc_attr( get_post_meta( get_the_ID(), "slide_button2_color", TRUE ) );

									}

									$button2_classes[] = 'btn-' . $button2_color;

									// Button Hover Color

									$button2_hover_color = 'white';

									if( get_post_meta( get_the_ID(), "slide_button2_hover_color", TRUE ) != '' ) {

										$button2_hover_color = get_post_meta( get_the_ID(), "slide_button2_hover_color", TRUE );

									}

									$button2_classes[] = 'btn-hover-' . $button2_hover_color;

									// Button Action

									if( $button2_action == 'link_external' && get_post_meta( get_the_ID(), "slide_button2_link_url", TRUE ) != '' ) {

										$button2_url = esc_url( get_post_meta( get_the_ID(), "slide_button2_link_url", TRUE ) );
										$button2_target = ' target="_self" ';
										if( get_post_meta( get_the_ID(), "slide_button2_link_target", TRUE ) == '_blank' ) $button2_target = ' target="_blank" ';

									} elseif ( $button2_action == 'video' && get_post_meta( get_the_ID(), "slide_button2_video_url", TRUE ) != '' ) {

                                        $button2_url = esc_url( get_post_meta( get_the_ID(), "slide_button2_video_url", TRUE ) );
                                        $button2_target = '';
                                        $button2_classes[] = 'mp-video';
                                        wp_enqueue_script( 'magnific-popup', '', '', '', true );
                                        wp_enqueue_style( 'magnific-popup' );

                                    } elseif( $button2_action == 'scroll_to' && get_post_meta( get_the_ID(), "slide_button2_link_url", TRUE ) != '' ) {

										$button2_classes = 'button-scroll';
										$button2_url = get_post_meta( get_the_ID(), "slide_button2_link_url", TRUE );

									} elseif( $button2_action == 'link' ) {

										$button2_url = get_permalink( get_post_meta( get_the_ID(), "slide_button2_link_page", TRUE ) );
										$button2_target = ' target="_self" ';
										if( get_post_meta( get_the_ID(), "slide_button2_link_target", TRUE ) == '_blank' ) $button2_target = ' target="_blank" ';

									} else { // Scroll after slider

										$button2_classes[] = 'button-scroll-after-slider';

									}

									echo '<a href="' . $button2_url . '"' . $button2_target . 'class="btn btn-lg veented-slide-button veented-slide-button2 ' . implode( ' ', $button2_classes ) . '"' . $button2_inline_css . '><span>' . esc_html( $button2_label ) . '</span></a>';

								}

								// End buttons

								echo '</div>';
							}

							?>

						</div>

					</div>

					<?php

					// YouTube Background

					if ( $bg_type == 'youtube' ) {

						$placeholder_img = $placeholder_img_url = $video_controls = $video_mute = $video_autoplay = '';

						if( get_post_thumbnail_id( get_the_ID() ) ) {
							$placeholder_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							$placeholder_img_url = $placeholder_img[0];
						}

						$slide_youtube_url = get_post_meta( get_the_ID(), "slide_youtube_url", TRUE );

						if ( $slide_youtube_url == '' ) {
							$slide_youtube_url = 'http://youtu.be/BsekcY04xvQ'; // Default video
						}

						echo '<div id="fullscreen-' . $slider_id . '" class="veented-slider-video element-fullscreen" style="background-image:url(' . $placeholder_img_url . ')">';

						echo '<div id="bgndVideo-' . $slider_id . '" class="player bgndVideo" data-property="{videoURL:\'' . $slide_youtube_url . '\',containment:\'#fullscreen-' . $slider_id . '\',autoPlay:true, showControls: false, mute:true, startAt:0, opacity:1}"></div>';

						echo '</div>'; // End fullscreen

					} elseif ( $bg_type == 'video' && get_post_meta( get_the_ID(), "slide_video_mp4", TRUE ) ) {

						wp_enqueue_script('vide', '', '', '', true);

						$video_mp4 = $video_webm = '';

						$video_mp4 = get_post_meta( get_the_ID(), "slide_video_mp4", TRUE );

						if( get_post_meta( get_the_ID(), "slide_video_webm", TRUE ) ) {
							$video_webm = get_post_meta( get_the_ID(), "slide_video_webm", TRUE );

							if( $video_webm[ 'url' ] != '' ) {
								$video_webm = ', webm: ' . esc_url( $video_webm[ 'url' ] );
							} else {
								$video_webm = '';
							}

						}

						echo '<div class="veented-slider-video-bg" style="width: 100%;"
						  data-vide-bg="mp4: ' . esc_url( $video_mp4[ 'url' ] ) . $video_webm . ', poster: ' . esc_url( $bg_img_url ) . '"
						  data-vide-options="posterType: jpg, loop: true, muted: true, position: 0% 0%">
						</div>';

					}

					// Slide Background Overlay

					$slide_bg_overlay = get_post_meta( get_the_ID(), "slide_bg_overlay", TRUE );

					if( $slide_bg_overlay != 'none' && $slide_bg_overlay != '' && $bg_type != 'color' ) {

						echo '<div class="bg-overlay bg-overlay-' . esc_attr( $slide_bg_overlay ) . '"></div>';

					}

					?>

				</div>

				<?php

				endwhile; endif; wp_reset_postdata();

				if( $height_custom > 0 && $height == 'custom' || $offset != 0 ) {

					$height_custom = str_replace( 'px', '', $height_custom );

					$slider_selector = '#veented-slider-' . $slider_id;

					if( $height_custom > 0 && $height == 'custom' ) {
						$slider_css .= $slider_selector . ',' . $slider_selector . ' .veented-slider-container { height: ' . esc_attr( $height_custom ) . 'px; }';
					}
					if( $offset != 0 ) {
						$slider_css .= $slider_selector . ' .inner { padding-top: ' . esc_attr( $offset ) . 'px; }';
					}

				}

				?>

			</div>

			<?php if( $bullet_navigation != 'false' ) { ?>

			<div class="veented-slider-pagination swiper-pagination"></div>

			<?php

			} // End Bullet Navigation

			if( $arrow_navigation != 'false' ) {

			?>

			<!-- Slider Arrows -->

			<div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
			<div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

			<?php

			}

			// Scroll Button

			if( $scroll_btn != 'no' ) {
				echo '<div class="veented-slider-scroll-button-holder"><a href="#second" class="scroll veented-slider-scroll-button veented-scroll-after"><span class="vntd-mouse-dot"></span></a></div>';
			}

			// End Slider CSS

			$slider_css .= '</style>';

			if( $slider_css != '<style type="text/css"></style>' ) {
				echo $slider_css;
			}

			?>

		</div>

	</div>

	<?php

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode('engage_slider');
add_shortcode('engage_slider', 'engage_slider');
