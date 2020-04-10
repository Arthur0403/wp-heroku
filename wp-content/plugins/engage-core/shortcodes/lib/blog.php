<?php

// Blog Shortcode

function engage_blog( $atts, $content = null ) {

	$cats = $style = $cols = $ajax = $posts_nr = $boxed = '';

	extract( shortcode_atts( array(
		"cats" => '',
		"style" => 'default',
		"cols" => 'default',
		"ajax" => 'default',
		"posts_nr" => '',
		"boxed" => 'default',
	), $atts ) );

	// Get defaults

	if( $style == 'default' ) $style = engage_option( 'blog_style' );
	if( $boxed == 'default' ) $boxed = engage_option( 'blog_boxed' );
	if( $ajax == 'default' ) $ajax = engage_option( 'blog_ajax' );
	if( $cols == 'default' ) $cols = engage_option( 'blog_masonry_cols' );

	// Blog classes

	$masonry_data = '';
	$css_classes = array();

	// Style

	$css_classes[] = 'blog-style-' . $style;

	// Masonry

	if ( $style == 'masonry' ) {

		wp_enqueue_script( 'engage-videos' );
		wp_enqueue_style( 'video-js' );
		wp_enqueue_script( 'cube-portfolio' );
		wp_enqueue_script( 'engage-grid' );
		wp_enqueue_style( 'cube-portfolio' );

		$css_classes[] = 'blog-grid';
		$masonry_data = ' data-cols="' . esc_attr( $cols ) . '" data-item-gap="20"';

	}

	// Boxed Style

	if( $boxed == 'boxed_no_border' ) {
		$css_classes[] = 'blog-boxed-solid';
	} elseif ( $boxed == 'not_boxed' ) {
		$css_classes[] = 'blog-not-boxed';
	} else {
		$css_classes[] = 'blog-boxed-border';
	}

	// Get page layout

	$layout = engage_option( 'page_layout' );
	if( ( $value = get_post_meta( get_the_ID(), 'page_layout', true ) ) != 'default' ) {
		if( $value != '' ) $layout = $value;
	}

	// Define grid item size

	ob_start();

	echo '<div class="blog blog-index posts">';
	echo '<div class="posts-container blog-inner ' . implode( ' ', $css_classes ) . '"' . $masonry_data . '>';

	// The Loop

	wp_reset_query(); global $more; $more = 0; // Reset the More Tage
	wp_reset_postdata();
	$paged = engage_query_pagination();

	$args = array(
		'posts_per_page' => $posts_nr,
		'cat'		=> $cats,
		'orderby'	=> 'slug',
		'paged' => $paged
	);

	$the_query = new WP_Query( $args );

	if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

		engage_blog_post( $layout, $style );

	endwhile; endif;

	// Loop END

	echo '</div>';

	//engage_pagination( $the_query ); // Pagination

	if( $ajax == 'yes' && $the_query->max_num_pages > 1 ) {
		//engage_ajax_pagination( $the_query, "blog" );
		//echo '<div id="ajax-load-posts" class="pagination-wrap"><a href="#" class="ajax-load-more-text">' . esc_html__('Load More Posts','crexis') . '</a></div>';

		engage_ajax_pagination( $the_query, "blog" );
		$extra_class = '';
		echo '<div id="ajax-load-posts" class="load-more-container' . $extra_class . '"><a href="#" class="btn btn-accent load-more-button" data-label-active="' . esc_html__( 'Load more posts' , 'engage' ) . '" data-label-loading="' . esc_html__( 'Loading posts' , 'engage' ) . '..." data-label-end="' . esc_html__( 'No more posts to load' , 'engage' ) . '.">' . esc_html__( 'Load more posts' , 'engage' ) . '</a></div>';
	} else {
		engage_pagination( $the_query );
	}

	wp_reset_query();

	echo '</div>';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode('vntd_blog');
add_shortcode('vntd_blog', 'engage_blog');
