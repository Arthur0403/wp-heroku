<?php

// Blog Posts Carousel

function engage_hero_section($atts, $content = null) {
	extract(shortcode_atts(array(
		"media_type" 	=> 'images',
		"images" 		=> '',
		"youtube_id"	=> 'https://youtu.be/SLC1y4nAyzE',
		"video_url"		=> '',
		"heading" 		=> 'Design Your Life',
		"top_heading" 	=> '',
		"subtitle" 		=> 'Contrary to popular belief, Lorem Ipsum is not simply random text. Piece of classical Latin literature.',
		"bg_overlay" 	=> 'none',
		"bg_overlay_color" => '',
		"bg_gradient1"  => '',
		"bg_gradient2"  => '',
		"height" 		=> 'fullscreen',
		"fullwidth" 		=> 'fullwidth',
		"height_custom" => '',
		"h_t"			=> '',
		"h_m"			=> '',
		"img_extra" 	=> '',
		"img_align" 		=> 'center',
		"img_width" 	=> '500px',
		"img_margin" 	=> '0px',
		"btn1_label" 	=> 'Button Text',
		"btn1_color" 	=> 'white',
		"btn1_style" 	=> 'outline',
		"btn1_action" => 'link',
		"btn1_video"     => '',
		"btn1_url" 		=> '',
		"btn2_label" 	=> '',
		"btn2_color" 	=> 'accent',
		"btn2_style" 	=> 'solid',
        "btn2_action" => 'link',
		"btn2_url" 		=> '',
        "btn2_video"     => '',
        "btn1_class"    => '',
        "btn2_class"    => '',
		"btn_radius"	=> 'default',
		"scroll_btn" 	=> 'no',
		"scroll_offset" => '',
		"font_family" 	=> 'default',
		"google_font" 	=> '',
		"arrow_nav" 	=> 'true',
		"arrow_nav_style" => 'side',
		"video_autoplay" 	=> 'true',
		"video_controls" 	=> 'true',
		"video_mute" 		=> 'true',
		"video_img"			=> '',
		"content_align"		=> 'center',
		"color" 		=> 'white',
		"heading_fs" 		=> 'default',
		"heading_fw" 		=> 'default',
		"heading_tt"		=> 'default',
		"top_heading_fs" 	=> '',
		"top_heading_fw" 	=> '',
		"top_heading_tt" 	=> '',
		"top_heading_ff" 	=> '',
		"content_width"		=> 'default',
		"container"			=> 'default',
		"subtitle_fs" 		=> 'default',
		"subtitle_ff" 		=> '',
		"parallax" 			=> 'yes',
		"img_autoplay" => '15000',
		"content_offset" 	=> '',
		"bg_img_position" 	=> ''
	), $atts ) );

	// WPBakery Page Builder Check
	if ( ! function_exists( 'vc_build_link' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	$parallax_container = $parallax_content = $parallax_class = $inline_css = '';

	// Enqueue Scripts & Styles

	if ($media_type == "youtube") {
		wp_enqueue_script('YTPlayer', '', '', '', true);
		wp_enqueue_style('YTPlayer');
	}

	$random_id = rand(1,9999);

    $css = '';

	if ( $height == 'custom' ) {

		if (!$height_custom) {
			$height_custom = '700';
		} else {
			$height_custom = str_replace('px','',$height_custom);
		}

		$hero_height_selector = '#hero-section-' . $random_id . ',#hero-section-' . $random_id . ' .hero-container';

		if ( $height_custom > 0 && $height == 'custom' ) {
			$css .= $hero_height_selector . '{height:' . esc_attr( $height_custom ) . 'px !important;}';

			if ( $h_t == '' && $height_custom > 500 ) {
				$css .= '@media (max-width: 768px){ ' . $hero_height_selector . '{height: 520px !important;}}';
			}

			if ( $h_m == '' && $height_custom > 400 ) {
				$css .= '@media (max-width: 480px){ ' . $hero_height_selector . '{height: 500px !important;}}';
			}
		}

		// Responsive height
		// Tablet height

		if ( $h_t != '' ) {
			$css .= '@media (max-width: 768px){ ' . $hero_height_selector . '{height:' . esc_attr( str_replace( 'px', '', $h_t ) ) . 'px !important;}}';
		}

		// Mobile height

		if ( $h_m != '' ) {
			 $css .= '@media (max-width: 480px){ ' . $hero_height_selector . '{height:' . esc_attr( str_replace( 'px', '', $h_m ) ) . 'px !important;}}';
		}

	}

    // Content offset

    if ( $content_offset != '' ) {
        $css .= '#hero-section-' . $random_id . ' .hero-content{margin-top:' . str_replace( 'px', '', $content_offset ) . 'px;}';
    }

	// Hero Classes

	$hero_classes = 'hero-media-' . esc_attr( $media_type );
	$hero_classes .= ' arrow-nav-' . esc_attr( $arrow_nav_style );
	$color_scheme = $color;
	$hero_classes .= ' color-scheme-' . esc_attr( $color_scheme );
	if ( $scroll_btn == 'yes') $hero_classes .= ' with-scroll-btn';
	if ( $height == 'fullscreen' ) {
		$hero_classes .= ' fullscreen-section';
	}
	if ( $fullwidth == 'fullwidth' ) {
		$hero_classes .= ' fullwidth-section';
	} elseif ( $fullwidth == 'fullwidth-stretch' ) {
		$hero_classes .= ' fullwidth-section fullwidth-stretch';
	}

	if ( $img_extra ) {
		$hero_classes .= ' hero-with-image';
	}

	// Parallax

	if ( $parallax == 'yes' ) {
		wp_enqueue_script( 'skrollr', '', '', '', true );
		$hero_classes .= ' hero-parallax';
		$parallax_content = ' data-0="opacity:1;transform:translateY(0px);" data--900-bottom="opacity:0;transform:translateY(-140px);"';
		$parallax_container = ' data-0="transform: translateY(0px);" data-end="transform: translateY(-360px);"';
	}

	// Background Gradient

	if ( $bg_gradient1 != '' && $bg_gradient2 != '' ) {
		$inline_css = engage_css_gradient( $bg_gradient1, $bg_gradient2 );
	}

	// Media Bg

	if ( $media_type == "youtube" && $video_controls != 'true' ) $hero_classes .= ' video-controls-disabled';

	// Inline CSS

	if ( $inline_css != '' ) {
		$inline_css = 'style="' . $inline_css . '"';
	}

	ob_start();

    // CSS Output

    if ( $css != '' ) {
        echo '<style type="text/css">' . $css . '</style>';
    }

	echo '<div id="hero-section-' . $random_id . '" class="vntd-hero vntd-section hero-section ' . $hero_classes . '"' . $inline_css . '><div class="hero-container"' . $parallax_container . '>';

	?>

		<?php

		$bg_overlay_e = '';

		if ( $bg_overlay != 'none'  ) {
			$custom_color = '';

			$bg_overlay_e = '<div id="bg-overlay-'. $random_id . '" class="bg-overlay bg-overlay-' . esc_attr( $bg_overlay ) . '"></div>';

			if ( $bg_overlay == 'custom' && $bg_overlay_color != '' ) {

			    if ( strpos( $bg_overlay_color, 'rgba' ) === false ) {
                    $bg_overlay_color = engage_hex2rgba( $bg_overlay_color, 0.7 );
                }
				$bg_overlay_e .= '<style type="text/css">#bg-overlay-' . $random_id . ':before{background-color:' .$bg_overlay_color . ';}</style>';
			}
		}

		if ( $media_type == 'images' && $images ) { // Image Background

			if ( strpos ($images, ',' ) !== false ) { // Slider

			    // More than one image

			    wp_enqueue_script( 'engage-sliders', '', '', '', true );
			    wp_enqueue_style( 'swiper' );

			    echo '<div class="hero-bg hero-bg-images engage-swiper-slider swiper-container" data-slider-touch="false" data-autoplay="' . esc_attr( $img_autoplay ) . '"><div class="swiper-wrapper">';

				$img_arr = explode(',',$images);

				foreach( $img_arr as $img ) {

					if ( strpos( $img, 'http') !== false ) {
						$img_url = $img;
					} else {
						$img_url = wp_get_attachment_image_src( $img, 'full' );
						$img_url = $img_url[0];
					}

					$bg_position = '';
					if ( $bg_img_position != '' ) $bg_position = 'background-position:' . esc_attr( $bg_img_position ) . ';';

					//echo '<div class="swiper-slide"><img src="' . $img_url[0] . '" alt></div>';
					echo '<div class="swiper-slide" style="background-image:url(\'' . $img_url . '\');");' . $bg_position . '">';

					if ( $bg_overlay != 'none' ) echo $bg_overlay_e;

					echo '</div>';
				}

				echo '</div>';

				// Slider Arrow Nav

				if ( $arrow_nav == 'true' ) {

					echo '<div class="swiper-nav swiper-button-next"><i class="fa fa-angle-right"></i></div>';
					echo '<div class="swiper-nav swiper-button-prev"><i class="fa fa-angle-left"></i></div>';

				}

				echo '</div>';

			} else { // Single image

				if ( strpos( $images, 'http') !== false ) {
					$img_url = $images;
				} else {
					$img_url = wp_get_attachment_image_src( $images, 'full' );
					$img_url = $img_url[0];
				}

				$bg_position = '';
				if ( $bg_img_position != '' ) $bg_position = 'background-position:' . esc_attr( $bg_img_position ) . ';';

				echo '<div class="hero-bg hero-bg-image" style="background-image:url(\'' . esc_url( $img_url ) . '\');' . $bg_position . '"><img class="vntd-fake-image" src="'. esc_url( $img_url ) . '"></div>';

				if ( $bg_overlay != 'none' ) echo $bg_overlay_e;
			}

		} elseif ( $media_type == "youtube" && $youtube_id ) { // Video Background

			wp_enqueue_script( 'YTPlayer', '', '', '', true );
			wp_enqueue_style( 'YTPlayer' );

			$rand_id = rand(9,9999);

			if ( $bg_overlay != 'none' ) echo $bg_overlay_e;

			$placeholder_img = '';
			$placeholder_img_url = '';

			if ( $video_img ) {
				if ( strpos( $video_img, 'http') !== false ) {
					$placeholder_img_url = $video_img;
				} else {
					$placeholder_img = wp_get_attachment_image_src( $video_img, 'full' );
					$placeholder_img_url = $placeholder_img[0];
				}

			}

			$rand_id = rand(1,99999);

			echo '<div id="fullscreen-' . $rand_id . '" class="fullscreen-div fullscreen-video-holder" style="background-image:url(' . $placeholder_img_url . ')">';
			echo '<img class="vntd-fake-image" src="' . esc_url( $placeholder_img_url ) . '">';

			echo '<div id="bgndVideo-' . $rand_id . '" class="bgndVideo player" data-property="{videoURL:\'' . $youtube_id . '\',containment:\'#fullscreen-' . $rand_id . '\',autoPlay:true, showControls: false, mute:true, startAt:0, opacity:1}"></div>';

			echo '</div>'; // End fullscreen


		} elseif ( $media_type == "video" ) {

			if ( $video_url == '' ) {
				echo esc_html__( 'Please provide video URL in Hero Section settings.', 'engage' );
			} else {

				if ( $bg_overlay != 'none' ) echo $bg_overlay_e;

				$placeholder_img = '';
				$placeholder_img_url = '';

				if ( $video_img ) {
					$placeholder_img = wp_get_attachment_image_src( $video_img, 'full' );
					$placeholder_img_url = $placeholder_img[0];
				}

				echo '<div class="bg-video-wrapper">';

				echo '<video id="hero-video-' . $rand_id . '" autoplay loop muted poster="' . $placeholder_img_url . '" loop="true" autoplay="autoplay"><source src="' . esc_url( $video_url ) . '" type="video/mp4"></video><script>document.getElementById("hero-video-' . $rand_id . '").play();</script>';

				echo '</div>';

			}
		}

		// Content

		$extra_classes = '';
		$aligned = false;

		if ( $content_align == 'left' || $content_align == 'right' ) {
			$extra_classes .= ' hero-align-' . esc_attr( $content_align );
			$aligned = true;
		} else {
			$extra_classes .= ' hero-align-center';
		}

		if ( $content_width == 'narrow' ) $extra_classes .= ' hero-content-narrow';

		// Container Width

		$container_width = '';

		if ( $container == 'stretch' ) {
			$container_width = '-large';
		}

		?>

		<!-- Home Inner Details -->
		<div class="hero-inner<?php echo esc_attr( $extra_classes ); ?> container<?php echo esc_attr( $container_width ); ?>"<?php if ( $parallax_content ) echo $parallax_content; ?>>

			<?php

			$img_extra_content = '';

			if ( $aligned == true && $img_extra ) {

//				echo '<div class="row row-flex">';
//				echo '<div class="col col-md-6">';
//
//				$extra_image_content = '';
//
//				$img_url = wp_get_attachment_image_src( $img_extra, 'full' );
//
//				$extra_image_content = '<div class="vertical-align-middle hero-extra-image extra-image-' . esc_attr( $img_align ) . '"><img src="' . $img_url[0] . '" style="width:' . esc_attr( $img_width ) . ';margin-top:' . esc_attr( $img_margin ) . ';" alt></div>';
//
//				if ( $content_align == 'right' ) {
//					echo $extra_image_content;
//					echo '</div><div class="col col-md-6">';
//				}

			}

			?>

			<div class="hero-content vertical-align-middle"><div class="hero-content-inner">

			<?php

			if ( $aligned == false && $img_extra ) {
				$img_url = wp_get_attachment_image_src( $img_extra, 'full' );
				echo '<div class="hero-extra-image extra-image-center"><img src="' . $img_url[0] . '" style="margin-top:' . esc_attr( $img_margin ) . ';" alt></div>';
			}

			if ( $top_heading ) {

				$inline_css = '';

				$top_heading_css = $top_heading_inline_css = '';

				if ( $top_heading_fs != '' ) $top_heading_css .= ' fs' . $top_heading_fs;
				if ( $top_heading_fw != '' ) $top_heading_css .= ' fw-' . $top_heading_fw;
				if ( $top_heading_tt != '' ) $top_heading_css .= ' tt-' . $top_heading_tt;

				if ( $top_heading_ff == 'additional' ) {
					$top_heading_css .= ' font-additional';
				}

				?>
				<p class="hero-top-heading<?php echo esc_attr( $top_heading_css ); ?>"<?php if ( $inline_css ) echo $inline_css; ?>><?php echo esc_html( $top_heading ); ?></p>
				<?php

			}

			if ( $heading ) {

				$inline_css = '';

				$heading_css = $heading_inline_css = '';
				if ( $heading_fs != 'default' ) $heading_css .= ' fs' . $heading_fs;
				if ( $heading_fw != 'default' ) $heading_css .= ' fw-' . $heading_fw;
				if ( $heading_tt != 'default' ) $heading_css .= ' tt-' . $heading_tt;

				if ( $font_family == 'custom' && $google_font ) {

					$google_font_data = engage_vc_google_font( $google_font );

					$inline_css = 'style="font-family:\'' . esc_attr( $google_font_data['font-family'] ) . '\';font-weight:' . esc_attr( $google_font_data['font-style'] ) .';"';

				} elseif ( $font_family == 'additional' ) {
					$heading_css .= ' font-additional';
				}

				?>
				<h1 class="hero-heading<?php echo esc_attr( $heading_css ); ?>"<?php if ( $inline_css ) echo $inline_css; ?>><?php echo wp_kses( $heading, engage_kses() ); ?></h1>
				<?php

			}
			if ( $subtitle ) {

				$subtitle_css = $subtitle_inline_css = '';

				if ( $subtitle_fs != 'default' ) {
					$subtitle_fs = str_replace( 'px', '', $subtitle_fs );
					$subtitle_inline_css .= ' font-size:' . $subtitle_fs . 'px;';
					if ( $subtitle_fs > 18 ) $subtitle_css .= ' subtitle-fs-bigger';
				}

				if ( $subtitle_ff == 'additional' ) {
					$subtitle_css .= ' font-additional';
				}

				?>
				<p class="hero-subtitle<?php echo esc_attr( $subtitle_css ); ?>"<?php if ( $subtitle_inline_css ) echo 'style="' . $subtitle_inline_css . '"';?>><?php echo str_replace( "(br)", "<br>", esc_html( $subtitle ) ); ?></p>
				<?php

			}

			// Buttons

			if ( $btn1_label != '' || $btn2_label != '' ) {

				$btn_classes = '';

				if ( $btn_radius == 'circle' ) {
					$btn_classes .= ' btn-circle';
				} elseif ( $btn_radius == 'square' ) {
					$btn_classes .= ' btn-square';
				}

				echo '<div class="hero-buttons">';

				if ( $btn1_label != '' ) {

					if ( $btn1_color == 'black' ) $btn1_color = 'dark';
					$btn1_classes = ' btn-' . $btn1_color;
					$btn1_classes .= ' btn-' . $btn1_style;
					$btn1_classes .= ' btn-hover-white';

                    if ( $btn1_class != '' ) {
                        $btn1_classes .= ' ' . $btn1_class;
                    }

                    if ( $btn1_action == 'video' ) {
                        $btn1_url = $btn1_video;
                        $btn1_classes .= ' mp-video';
                        wp_enqueue_script('magnific-popup', '', '', '', true);
                        wp_enqueue_style('magnific-popup');
                    }

					echo engage_build_link( $btn1_label, $btn1_url, 'btn hero-btn hero-btn1' . esc_attr( $btn1_classes ) . $btn_classes );

				}

				if ( $btn2_label != '' ) {

					if ( $btn2_color == 'black' ) $btn2_color = 'dark';
					$btn2_classes = ' btn-' . $btn2_color;
					$btn2_classes .= ' btn-' . $btn2_style;
					$btn2_classes .= ' btn-hover-white';

                    if ( $btn2_class != '' ) {
                        $btn2_classes .= ' ' . $btn2_class;
                    }

                    if ( $btn2_action == 'video' ) {
                        $btn2_url = $btn2_video;
                        $btn2_classes .= ' mp-video';
                        wp_enqueue_script('magnific-popup', '', '', '', true);
                        wp_enqueue_style('magnific-popup');
                    }

					echo engage_build_link( $btn2_label, $btn2_url, 'btn hero-btn hero-btn2' . esc_attr( $btn2_classes ) . $btn_classes );

				}

				echo '</div>';

			}

			?>

			</div></div>

		</div>

		<!-- End Content -->

		<?php

		// Scroll Button

		if ( $scroll_btn != 'no' ) {
			echo '<div class="veented-slider-scroll-button-holder"><a href="#second" class="scroll veented-slider-scroll-button veented-scroll-after"><span class="vntd-mouse-dot"></span></a></div>';
		}

	echo '</div></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode('vntd_hero_section');
add_shortcode('vntd_hero_section', 'engage_hero_section');
