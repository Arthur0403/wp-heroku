<?php

// Blog Posts Carousel

function engage_blog_carousel($atts, $content = null)
{

	$posts_nr = $cats = $ids = $bullet_nav = $arrow_nav = $cols = $autoplay = $autoplay_timeout = $excerpt_length = $style = $thumb = $meta = '';

	extract(shortcode_atts(array(
		"posts_nr" => '8',
		"cats" => '',
		"ids" => '',
		"bullet_nav" => 'true',
		"arrow_nav" => 'false',
		"cols" => 3,
		"cols_tablet" => 2,
		"cols_mobile" => 1,
		"autoplay" => 'true',
		"autoplay_timeout" => 7000,
		"excerpt_length" => 15,
		"style" => 'boxed_border',
		"thumb" => 'featured_image',
		"meta" => 'minimal',
	), $atts));

	// Enqueue Styles and Scripts

	wp_enqueue_script( 'owl-carousel', '', '', '', true );
	wp_enqueue_style( 'owl-carousel' );
	wp_enqueue_script( 'engage-carousels', '', '', '', true );

	$margin = 30;

	// Carousel datas

	$carousel_data = array();

	$carousel_data[] = 'data-dots="' . esc_attr( $bullet_nav ) . '"';
	$carousel_data[] = 'data-nav="' . esc_attr( $arrow_nav ) . '"';
	$carousel_data[] = 'data-autoplay="' . esc_attr( $autoplay ) . '"';
	$carousel_data[] = 'data-autoplay-timeout="' . esc_attr( $autoplay_timeout ) . '"';
	$carousel_data[] = 'data-cols="' . esc_attr( $cols ) . '"';
	$carousel_data[] = 'data-cols-tablet="' . esc_attr( $cols_tablet ) . '"';
	$carousel_data[] = 'data-cols-mobile="' . esc_attr( $cols_mobile ) . '"';
	$carousel_data[] = 'data-margin="' . esc_attr( $margin ) . '"';

	// Nav

	$carousel_nav = '';

	if( $arrow_nav == 'false' && ( $bullet_nav == 'false' || $bullet_nav == '' ) ) $carousel_nav = ' carousel-no-nav';

	ob_start();

	echo '<div class="vntd-carousel-holder vntd-content-element">';

	echo '<div class="vntd-carousel vntd-blog-carousel vntd-blog posts owl-carousel blog-style-boxed blog-' . esc_attr( $style ) . ' blog-meta-' . esc_attr( $meta ) . esc_attr( $carousel_nav ) . '" ' . implode( ' ', $carousel_data ) . '>';

	wp_reset_postdata();

	$args = array(
		'posts_per_page' => $posts_nr,
		'cat' => $cats,
		'orderby' => 'slug'
	);

	$the_query = new WP_Query($args);
	$i = 0;

	$excerpt_length = $excerpt_length;

	if ( $the_query->have_posts() ): while ( $the_query->have_posts() ): $the_query->the_post();

		$i++;
		$post_format = get_post_format( get_the_ID() );
		$img_size = 'engage-masonry-regular';
		$thumb_id = get_post_thumbnail_id( get_the_ID() );

		?>

		<div class="item post post-holder">

			<div class="blog-item-inner">

				<?php

				if ( $thumb != 'disable' && !( !$post_format && !has_post_thumbnail() ) ) {

					if ( $thumb == "featured_image" && has_post_thumbnail() ) {

						$img = engage_get_thumb( $thumb_id, $img_size );
						$thumb_url = $img['url'];

						?>

						<div class="post-medias">
							<a href="<?php echo get_permalink( get_the_ID() ); ?>">
								<img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>">
							</a>
						</div>

						<?php
					} elseif ( $thumb == "full_media" ) {
						echo 'full media';
						engage_post_media( get_the_ID(), $post_format, $img_size );

					}

				}

				?>

				<div class="post-info">

					<h5 class="post-title">
						<a href="<?php echo get_permalink( get_the_ID() ); ?>">
							<?php echo get_the_title( get_the_ID() ); ?>
						</a>
					</h5>

					<?php
                    if( $meta != 'disable' ) {
                        $args = array();
                        if ( $meta == 'date' ) {
                            $args = array(
                                    'author' => false
                            );
                        }
					    engage_post_meta( $args );
                    }
                    ?>

					<div class="post-content post-excerpt">
						<?php echo engage_excerpt( $excerpt_length, true ); ?>
					</div>

				</div>
			</div>
		</div>

		<?php

	endwhile; endif;

	wp_reset_postdata();

	echo '</div></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode('blog_carousel');
add_shortcode('blog_carousel', 'engage_blog_carousel');
