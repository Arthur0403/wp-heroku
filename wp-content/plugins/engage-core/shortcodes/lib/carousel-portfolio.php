<?php

// Recent Work Shortcode


function engage_portfolio_carousel( $atts, $content = null )
{
	extract( shortcode_atts( array(
		"cats" => '',
		"posts_nr" => '',
		"item_style" => 'caption',
		"item_caption_style" => 'visible',
		"item_caption_align" => 'left',
		"item_caption_content" => 'title_categories',
		"item_caption_position" => 'center',
		"item_caption_categories" => 'no',
		"item_hover_style" => 'zoom_link',
		"image_hover_effect" => 'zoom',
		"image_hover_overlay" => 'dark',
		"love" => 'yes',
		"border" => 'yes',
		"thumb_space" => 'yes',
		"cols" => 3,
		"cols_tablet" => 2,
		"cols_mobile" => 1,
		"autoplay" => 'true',
		"autoplay_timeout" => 7000,
		"bullet_nav" => "true",
		"arrow_nav" => "false",
		"orderby" => 'date',
		"order" => 'DESC'
	), $atts ) );

	// Enqueue Scripts and Styles

	wp_enqueue_script( 'magnific-popup', '', '', '', true );
	wp_enqueue_style( 'magnific-popup' );

	wp_enqueue_script( 'owl-carousel', '', '', '', true );
	wp_enqueue_style( 'owl-carousel' );

	wp_enqueue_script( 'engage-carousels', '', '', '', true );

	// Carousel Data

	$carousel_data = array();

	$carousel_data[] = 'data-dots="' . esc_attr( $bullet_nav ) . '"';
	$carousel_data[] = 'data-nav="' . esc_attr( $arrow_nav ) . '"';
	$carousel_data[] = 'data-autoplay="' . esc_attr( $autoplay ) . '"';
	$carousel_data[] = 'data-autoplay-timeout="' . esc_attr( $autoplay_timeout ) . '"';
	$carousel_data[] = 'data-cols="' . esc_attr( $cols ) . '"';
	$carousel_data[] = 'data-cols-tablet="' . esc_attr( $cols_tablet ) . '"';
	$carousel_data[] = 'data-cols-mobile="' . esc_attr( $cols_mobile ) . '"';
	$margin = 30;
	if( $thumb_space == 'no' ) $margin = 0;
	$carousel_data[] = 'data-margin="' . esc_attr( $margin ) . '"';

	// Portfolio Classes

	$container_classes = array();

	$container_classes[] = 'portfolio-' . $item_style;
	$container_classes[] = 'portfolio-cols-' . $cols;
	$container_classes[] = 'item-hover-style-' . $item_hover_style;
	$container_classes[] = 'img-hover-effect-' . $image_hover_effect;
	$container_classes[] = 'img-hover-overlay-' . $image_hover_overlay;
	if( $bullet_nav == '' ) $bullet_nav = 'false';
	$container_classes[] = 'carousel-dots-' . esc_attr( $bullet_nav );

	if( $item_style != 'minimal' ) {
		$container_classes[] = 'item-style-' . $item_style;
		$container_classes[] = 'caption-' . $item_caption_style;
		if( !$border ) $border = 'none';
		$container_classes[] = 'caption-border-' . esc_attr( $border );
	}

	if( $arrow_nav == 'false' && $bullet_nav == 'false' ) $container_classes[] = 'carousel-no-nav';

	// Begin shortcode

	ob_start();

	echo '<div class="vntd-carousel-holder">';

	echo '<div class="vntd-carousel vntd-portfolio-carousel owl-carousel portfolio ' . esc_attr( implode( ' ', $container_classes ) ) . '" ' . implode( ' ', $carousel_data ) . '>';

	$img_size = 'engage-masonry-square';

	wp_reset_postdata();

	$args = array(
		'posts_per_page' => $posts_nr,
		'project-type' => $cats,
		'post_type' => 'portfolio',
		'orderby' => $orderby,
		'order' => $order
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ): while ( $the_query->have_posts() ): $the_query->the_post();

		$thumb_id = get_post_thumbnail_id( get_the_ID() );

		$thumb = engage_get_thumb( $thumb_id, $img_size );
		$thumb_url = $thumb['url'];

		// For lightbox zoom

		$img_url = wp_get_attachment_image_src( $thumb_id, 'full' );
		$big_thumb_url = $img_url[0];

		$post_link = get_permalink();

		?>

		<div class="item carousel-item">

			<div class="item-main">

				<a href="<?php echo esc_url( $post_link ); ?>" class="item-image">

		        	<!-- Image Src -->
		            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title(); ?>">

		            <?php if( $item_hover_style != 'none' && $item_style != 'caption_overlay' ) { ?>

		            <div class="portfolio-item-overlay item-overlay-<?php echo esc_attr( $item_hover_style ); ?>">

		            	<div class="item-overlay-inner">

		            		<?php

		            		if( $item_hover_style == 'title' || $item_hover_style == 'title_categories' || $item_hover_style == 'title_icons' ) { ?>

		            			<h4 class="item-overlay-title"><?php the_title(); ?></h4>

		            			<?php

		            			if( $item_hover_style == 'title_categories' ) {
		            				echo '<div class="item-overlay-categories">';
		            				engage_portfolio_overlay_categories();
		            				echo '</div>';
		            			}

		            		}

		            		// Additional

		            		if( $item_hover_style == 'title_categories' ) {

		            			echo '<div class="item-overlay-categories">';
		            			engage_portfolio_overlay_categories();
		            			echo '</div>';

		            		} elseif( $item_hover_style == 'zoom_link' || $item_hover_style == 'zoom' || $item_hover_style == 'title_icons' ) {

		            			wp_enqueue_script('magnific-popup', '', '', '', true);

		            			echo '<div class="item-overlay-icons">';
		            			echo '<span href="' . esc_url( $big_thumb_url ) . '" class="grid-gallery"><i class="engage-icon-icon engage-icon-zoom-2"></i></span>';

		            			if( $item_hover_style == 'zoom_link' || $item_hover_style == 'title_icons' ) {

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
			if( $item_style == 'caption' || $item_style == 'caption_overlay' ) {
			?>

			<div class="portfolio-item-caption caption-align-<?php echo esc_attr( $item_caption_align ); ?> caption-content-<?php echo esc_attr( $item_caption_content ); ?><?php if( $item_caption_style == 'hover' ) echo ' item-caption-hover'; if( $item_caption_position == 'bottom_left' ) echo ' item-caption-bottom_left'; if( $item_caption_categories == 'yes' || $item_style == 'caption_overlay' ) echo ' caption-overlay-categories'; ?>">
				<div class="item-caption-inner">

			    	<h4 class="item-title">
			    		<a href="<?php echo get_permalink(); ?>">
			    			<?php the_title(); ?>
			    		</a>
			    	</h4>

			    	<?php

			    	if( $item_caption_content == 'title_categories' && $item_style == 'caption' || $item_caption_categories == 'yes' && $item_style == 'caption_overlay' ) {

			    		echo '<div class="caption-categories">';

			    		engage_portfolio_overlay_categories();

			    		echo '</div>';

			    	}

			    	if( $love == "yes" && $item_style == "caption" ) {
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
		endwhile;
	endif;
	wp_reset_postdata();

	echo '</div></div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'portfolio_carousel' );
add_shortcode( 'portfolio_carousel', 'engage_portfolio_carousel' );
