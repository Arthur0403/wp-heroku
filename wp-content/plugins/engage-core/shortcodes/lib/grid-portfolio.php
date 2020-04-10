<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Portfolio Grid Shortcode
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

if ( !function_exists( 'engage_portfolio_grid' ) ) {
	function engage_portfolio_grid( $atts, $content = null ) {

		$defaults = Engage_Core::portfolio_defaults();

		extract( shortcode_atts( array(
			"cats" => '',
			"cols" => 3,
			"cols_tablet" => 2,
			"cols_mobile" => 1,
			"layout_type" => 'grid',
			"item_style" => $defaults[ 'item_style' ],
			"item_caption_style" => $defaults[ 'item_caption_style' ],
			"item_caption_align" => $defaults[ 'item_caption_align' ],
			"item_caption_content" => $defaults[ 'item_caption_content' ],
			"item_caption_position" => $defaults[ 'item_caption_position' ],
			"item_caption_categories" => $defaults[ 'item_caption_categories' ],
			"caption_border" => $defaults[ 'caption_border' ],
			"item_hover_style" => $defaults[ 'item_hover_style' ],
			"image_hover_effect" => $defaults[ 'image_hover_effect' ],
			"image_hover_overlay" => $defaults[ 'image_hover_overlay' ],
			"thumb_space" => $defaults[ 'thumb_space' ],
			"love" => $defaults[ 'love' ],
			"posts_nr" => '',
			"pagination" => $defaults[ 'pagination' ],
			"more_button_style" => $defaults[ 'more_button_style' ],
			"filter" => $defaults[ 'filter' ],
			"filter_align" => $defaults[ 'filter_align' ],
			"filter_orderby" => $defaults[ 'filter_orderby' ],
			"animation" => 'quicksand',
			"order" => $defaults[ 'order' ],
			"orderby" => $defaults[ 'orderby' ],
		), $atts ) );

		// Enqueue portfolio related scripts and styles

		wp_enqueue_script( 'cube-portfolio' );
		wp_enqueue_script( 'engage-grid' );
		wp_enqueue_style( 'cube-portfolio' );

		global $post;

		if ( !$posts_nr ) $posts_nr = "-1";
		$grid_id = rand(1,9999);

		$layout_class = $post_in = '';

		$item_class = ' cbp-caption-zoom';

		if ( $item_style == 'minimal' ) {
			//$portfolio_style = 'type1';
			$item_class .= ' cbp-caption-active';
		}

		if ( class_exists('engageDemo') ) {
			$post_in = engageDemo::portfolioGridPosts( $item_style, $masonry );
			$orderby = 'post__in';
		}

		// Grid items Gap

		$thumb_gap = 20;
		if ( $thumb_space == "no" ) $thumb_gap = 0;

		// Portfolio Container Classes

		$container_classes = array();

		$container_classes[] = 'portfolio-' . $item_style;
		$container_classes[] = 'portfolio-cols-' . $cols;
		$container_classes[] = 'item-hover-style-' . $item_hover_style;
		$container_classes[] = 'img-hover-effect-' . $image_hover_effect;
		$container_classes[] = 'img-hover-overlay-' . $image_hover_overlay;

		if ( $filter == 'yes' ) {
			$container_classes[] = 'filter-align-' . $filter_align;
		}

		if ( $item_style != 'minimal' ) {
			$container_classes[] = 'item-style-' . $item_style;
			$container_classes[] = 'caption-' . $item_caption_style;
			$container_classes[] = 'caption-border-' . $caption_border;
		}

		// Grid Options

		$grid_options = array();

		$grid_options[] = 'data-cols="' . $cols . '"';
		$grid_options[] = 'cols-tablet="' . $cols_tablet . '"';
		$grid_options[] = 'cols-mobile="' . $cols_mobile . '"';
		$grid_options[] = 'animation="' . $animation . '"';
		$grid_options[] = 'filters="grid-filters-' . $grid_id . '"';
		$grid_options[] = 'item-gap="' . $thumb_gap . '"';

		if ( $layout_type == 'mosaic' ) {
			$grid_options[] = 'layout="mosaic"';
		} else {
			$grid_options[] = 'layout="grid"';
		}

		ob_start();

		echo '<div class="portfolio portfolio-grid ' . esc_attr( implode( ' ', $container_classes ) ) . '">';

			if ( $filter == "yes" ) engage_grid_filters( 'portfolio-category', $cats, $grid_id, $filter_orderby );

			echo '<div id="grid-' . $grid_id . '" class="portfolio-items grid-items" ' . implode( ' data-', $grid_options ) . '>';

			wp_reset_query();

			$paged = engage_query_pagination();

			$cats_arr = explode( " ", $cats );
			$args = array(
				'posts_per_page' => $posts_nr,
				'portfolio-category' => $cats,
				'paged' => $paged,
				'post_type' => 'portfolio',
				'order' => $order,
				'orderby' => $orderby,
				'post__in' => $post_in,
			);
			$the_query = new WP_Query( $args );

			// Default Thumbnail Sizes

			$ajax_class = '';

			$img_size = 'engage-masonry-square';

			// The Loop

			if ( $the_query->have_posts() ) : while ($the_query->have_posts()) : $the_query->the_post();

				$img_size = 'engage-masonry-square';
				$img_width = $img_height = 600;
				$item_size_class = 'item-size-regular';

				$thumb_id = get_post_thumbnail_id( $post->ID );

				if ( $layout_type == 'masonry' ) {

					$img_size = 'engage-masonry-auto';
					$thumb = engage_get_thumb( $thumb_id, $img_size );
					$thumb_url = $thumb['url'];

					$img_height = 0;

				} elseif ( $layout_type == 'mosaic' && ( $thumb_size = get_post_meta( $post->ID, 'portfolio_thumb_ratio', true ) ) ) {

					$height = $width = 500;

					if ( $thumb_size == 'tall' ) {
						$item_size = 'high';
						$img_height = $height = 1000;
					} elseif ( $thumb_size == 'wide' ) {
						$item_size = 'wide';
						$img_width = $width = 1000;
					} elseif ( $thumb_size == 'big' ) {
						$item_size = 'high-wide';
						$img_height = $height = 1000;
						$img_width = $width = 1000;
					}

					$img_size = 'engage-masonry-' . $item_size;
					$item_size_class = ' item-size-' . $item_size;

					if ( $img_size != 'engage-masonry-square' ) {
						$p_img = engage_img_resize( $thumb_id, null, $width, $height, true );
						$thumb_url = $p_img['url'];
					} else {
						$img_url = wp_get_attachment_image_src( $thumb_id, $img_size );
						$thumb_url = $img_url[0];
					}

				} else {

					$thumb = engage_get_thumb( $thumb_id, $img_size );
					$thumb_url = $thumb['url'];

				}

				// For lightbox zoom

				$img_url = wp_get_attachment_image_src( $thumb_id, 'full' );
				$big_thumb_url = $img_url[0];

				$post_link = get_permalink();

				?>

				<div class="item grid-item cbp-item <?php echo engage_portfolio_item_class() . $item_size_class; ?>">

					<div class="item-main">

						<a href="<?php echo esc_url( $post_link ); ?>" class="item-image">

		                	<!-- Image Src -->
		                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title(); ?>">

		                    <?php if ( $item_hover_style != 'none' && $item_style != 'caption_overlay' ) { ?>

		                    <div class="portfolio-item-overlay item-overlay-<?php echo esc_attr( $item_hover_style ); ?>">

		                    	<div class="item-overlay-inner">

		                    		<?php

		                    		if ( $item_hover_style == 'title' || $item_hover_style == 'title_categories' || $item_hover_style == 'title_icons' ) { ?>

		                    			<h4 class="item-overlay-title"><?php the_title(); ?></h4>

		                    			<?php

		                    			if ( $item_hover_style == 'title_categories' ) {
		                    				echo '<div class="item-overlay-categories">';
		                    				engage_portfolio_overlay_categories();
		                    				echo '</div>';
		                    			}

		                    		}

		                    		// Additional

		                    		if ( $item_hover_style == 'zoom_link' || $item_hover_style == 'zoom' || $item_hover_style == 'title_icons' ) {

		                    			wp_enqueue_script('magnific-popup', '', '', '', true);

		                    			echo '<div class="item-overlay-icons">';
		                    			echo '<span href="' . esc_url( $big_thumb_url ) . '" class="grid-gallery"><i class="engage-icon-icon engage-icon-zoom-2"></i></span>';

		                    			if ( $item_hover_style == 'zoom_link' || $item_hover_style == 'title_icons' ) {

		                    				echo '<span><i class="engage-icon-icon engage-icon-link-72"></i></span>';

		                    			}

		                    			echo '</div>';

		                    		}

		                    		?>

		                    	</div>

		                    </div>

		                    <?php } ?>

			            </a>

			    	</div>

			    	<?php
			    	if ( $item_style == 'caption' || $item_style == 'caption_overlay' ) {
			    	?>

			    	<div class="portfolio-item-caption caption-align-<?php echo esc_attr( $item_caption_align ); ?> caption-content-<?php echo esc_attr( $item_caption_content ); ?><?php if ( $item_caption_style == 'hover' ) echo ' item-caption-hover'; if ( $item_caption_position == 'bottom_left' ) echo ' item-caption-bottom_left'; if ( $item_caption_categories == 'yes' || $item_style == 'caption_overlay' ) echo ' caption-overlay-categories'; ?>">
			    		<div class="item-caption-inner">

					    	<h4 class="item-title">
					    		<a href="<?php echo get_permalink(); ?>">
					    			<?php the_title(); ?>
					    		</a>
					    	</h4>

					    	<?php

					    	if ( $item_caption_content == 'title_categories' && $item_style == 'caption' || $item_caption_categories == 'yes' && $item_style == 'caption_overlay' ) {

					    		echo '<div class="caption-categories">';

					    		engage_portfolio_overlay_categories();

					    		echo '</div>';

					    	}

					    	if ( $love == "yes" && $item_style == "caption" ) {
					    		 engage_love_button();
					    	}

					    	?>

				    	</div>
			    	</div>

			    	<?php
			    	}
			    	?>

				</div>

				<?php


			endwhile; endif;

			echo '</div>';

			if ( $posts_nr > 1 ) {
				if ( $pagination == 'classic' ) {
					engage_pagination( $the_query );
				} elseif ( $pagination == 'ajax' ) {

					engage_ajax_pagination( $the_query, "portfolio" );
					$extra_class = '';
					if ( $more_button_style == 'fullwidth' ) $extra_class = ' load-more-fullwidth';
					echo '<div id="portfolio-load-posts" class="load-more-container' . $extra_class . '"><a href="#" class="btn btn-accent btn-hover-dark load-more-button btn-xlarge">' . esc_html__( 'Load More' , 'engage' ) . '</a></div>';

				}
			}

			echo '</div>';

			wp_reset_postdata();

		$content = ob_get_contents();
		ob_end_clean();

		return $content;

	}

	remove_shortcode('portfolio_grid');
	add_shortcode('portfolio_grid', 'engage_portfolio_grid');
}
