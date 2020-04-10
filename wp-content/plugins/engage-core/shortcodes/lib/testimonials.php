<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Testimonials Carousel
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_testimonials($atts, $content = null) {
	extract(shortcode_atts(array(
		"posts_nr" => '',
		"cats" => '',
		"cols" => 3,
		"autoplay" => 'true',
		"autoplay_timeout" => 7000,
		"style" => 'minimal',
//		"excerpt" => 'yes',
		"carousel_title" => '',
		"orderby" => 'date',
		"order" => 'DESC',
		"bullet_nav" => "true",
		"arrow_nav" => "false",
		"arrow_nav_position" => 'bottom',
		"caption_align" => 'left',
		"bg" => 'grey'
	), $atts));

	wp_enqueue_script( 'owl-carousel', '', '', '', true );
	wp_enqueue_style( 'owl-carousel' );
	wp_enqueue_script( 'engage-carousels', '', '', '', true );

	// Carousel Data

	$animate_in = $animate_out = false;

	$margin = 30;
	if( $style == "minimal" ) {
		$cols = $cols_tablet = 1;
		$animate_in = 'fadeIn';
		$animate_out = 'fadeOut';
	} else if ( $cols > 2 ) {
	    $cols_tablet = 2;
    }

	$carousel_data = array();

	$carousel_data[] = 'data-dots="' . esc_attr( $bullet_nav ) . '"';
	$carousel_data[] = 'data-nav="' . esc_attr( $arrow_nav ) . '"';
	$carousel_data[] = 'data-autoplay="' . esc_attr( $autoplay ) . '"';
	$carousel_data[] = 'data-autoplay-timeout="' . esc_attr( $autoplay_timeout ) . '"';
	$carousel_data[] = 'data-cols="' . esc_attr( $cols ) . '"';
	$carousel_data[] = 'data-cols-tablet="' . esc_attr( $cols_tablet ) . '"';
	$carousel_data[] = 'data-margin="' . esc_attr( $margin ) . '"';
	$carousel_data[] = 'data-animate-in="' . $animate_in . '"';
	$carousel_data[] = 'data-animate-out="' . $animate_out . '"';

	// Carousel Classes

	$css_classes = array();

	$css_classes[] = 'testimonials-' . esc_attr( $style );
	$css_classes[] = 'nav-position-' . esc_attr( $arrow_nav_position );

	if( $style == "simple" ) {
		$css_classes[] = 'testimonials-bg-' . esc_attr( $bg );
		$css_classes[] = 'caption-align-' . esc_attr( $caption_align );
	}

	// Output

	ob_start();

	echo '<div class="vntd-testimonials-holder vntd-carousel-holder">';

	echo '<div class="vntd-testimonials vntd-carousel owl-carousel ' . implode( ' ', $css_classes ) . '" ' . implode( ' ', $carousel_data ) . '>';

	wp_reset_postdata();

	// The query

	$args = array(
		'posts_per_page' => $posts_nr,
		'testimonials-category' => $cats,
		'post_type' => 'testimonials',
		'orderby' => $orderby,
		'order' => $order
	);

	$the_query = new WP_Query( $args );

	// The Loop

	if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ): $the_query->the_post();

	$post_id = get_the_ID();

	?>

		<div class="item carousel-item testimonial-item">

			<div class="testimonial-inner">

				<div class="testimonial-content">
					<p><?php echo esc_html( get_post_meta( $post_id, "testimonial_content", true ) ); ?></p>
				</div>

				<div class="testimonial-caption">
					<div class="testimonial-author"><?php echo esc_html( get_post_meta( $post_id, "name", true ) ); ?></div>
					<?php

					$position_start = $position_end = '';

					if( $website_url = get_post_meta( $post_id, "website_url", true ) ) {
						$position_start = '<a href="' . esc_url( $website_url ) . '">';
						$position_end = '</a>';
					}

					echo $position_start . '<div class="testimonial-position">' . esc_html( get_post_meta( $post_id, "position", true ) ) . '</div>' . $position_end;

					?>
				</div>

			</div>

		</div>

	<?php

	endwhile;

	else :

		echo '<div class="vntd-no-posts"><p><i class="fa fa-info"></i> It seems you don\'t have any testimonial posts created. You may add new <a href="' . admin_url( 'edit.php?post_type=testimonials' ) . '" target="_blank">here</a>.</p></div>';

	endif; // End The Loop


	echo '</div></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode('vntd_testimonials');
add_shortcode('vntd_testimonials', 'engage_testimonials');
