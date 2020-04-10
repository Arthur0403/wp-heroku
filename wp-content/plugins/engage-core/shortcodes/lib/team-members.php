<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Team Members Shortcode
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_team_members( $atts, $content = null ) {

	$filter_orderby = $post_in = '';

	extract( shortcode_atts( array(
		"filter" => 'off',
		"animation" => 'rotateSides',
		"posts_nr" => '',
		"positions" => '',
		"style" => 'simple',
		"thumb_size" => 'portrait',
		"cols" => '3',
		"cols_tablet" => '2',
		"cols_mobile" => '1',
		"orderby" => 'name',
		"order" => 'ASC',
		"style" => 'modern',
		"show_bio" => 'no',
		"boxed" => 'no'
	), $atts ) );

	// Enqueue portfolio related scripts and styles

	wp_enqueue_script('cube-portfolio');
	wp_enqueue_script('engage-grid');
	wp_enqueue_style('cube-portfolio');

	if( !$posts_nr ) $posts_nr = "-1";
	$grid_id = rand(1,9999);

	$layout_class = $post_in = '';

	$item_class = ' cbp-caption-zoom';

	// Grid items Gap

	$thumb_gap = 30;

	// Grid Options

	$grid_options = array();

	$grid_options[] = 'cols="' . $cols . '"';
	$grid_options[] = 'cols-tablet="' . $cols_tablet . '"';
	$grid_options[] = 'cols-mobile="' . $cols_mobile . '"';
	$grid_options[] = 'animation="' . $animation . '"';
	$grid_options[] = 'filters="grid-filters-' . $grid_id . '"';
	$grid_options[] = 'item-gap="' . $thumb_gap . '"';

	ob_start();

	echo '<div class="team-members vntd-person team-members-grid team-members-' . esc_attr( $style ) . ' team-members-' . esc_attr( $boxed ) . ' wpb_content_element">';

	wp_reset_query();

	$paged = engage_query_pagination();

	//$positions = explode( " ", $positions );
	$args = array(
		'posts_per_page' => $posts_nr,
		'member-position' => $positions,
		'post_type' => 'team',
		'order' => $order,
		'orderby' => $orderby,
		'post__in' => $post_in,
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {

	if( $filter != "off" ) engage_grid_filters( 'member-position', $positions, $grid_id, $filter_orderby );

	echo '<div id="grid-' . $grid_id . '" class="team-items grid-items" data-' . implode( ' data-', $grid_options ) . '>';
	// Default Thumbnail Sizes

	$size = "engage-masonry-square";
	if( $thumb_size == "square" ) $size = "engage-masonry-regular";

	if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

		$post_id = get_the_ID();

		$thumb = engage_get_thumb( get_post_thumbnail_id( $post_id ), $img_size );
		$img_url = $thumb['url'];

		?>

		<div class="item grid-item team-item cbp-item <?php echo engage_team_member_class(); ?>">

			<div class="item-main">

				<a class="item-image">

                	<!-- Image Src -->
                    <img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="member-image">

                    <?php

                    if( $hover_image = get_post_meta( $post_id, "hover_image", true ) ) {
                    	$hover_image = wp_get_attachment_image_src( $hover_image['id'], $size );
                    	if( $hover_image ) {
                    		echo '<img src="' . $hover_image[0] . '" class="member-image-hover" alt>';
                    	}
                    }

                    ?>

	            </a>

	            <?php if( $style == 'modern' ) { ?>

	            <div class="item-overlay">

	            	<div class="item-overlay-inner">

	            		<?php engage_member_social_profiles(); ?>

	            	</div>

	            </div>

	            <?php } ?>

	    	</div>

	    	<div class="item-caption">
	    		<div class="item-caption-inner">

	    			<div class="team-caption-header">

	    				<div class="team-caption-titles">
					    	<h5 class="item-title team-member-name">
					    		<!--<a href="<?php echo get_permalink(); ?>">-->
					    			<?php the_title(); ?>
					    		<!--</a>-->
					    	</h5>

					    	<div class="caption-categories member-position">

					    		<?php engage_team_member_categories(); ?>

					    	</div>
				    	</div>
				    	<?php

				    	if( $style == 'classic' ) {
				    		echo '<div class="team-caption-social">';
				    		engage_member_social_profiles( 'outline' );
				    		echo '</div>';
				    	}

				    	?>
			    	</div>

			    	<?php

			    	if( ( $show_bio == 'yes' ) && get_post_meta( $post_id, 'bio', true ) ) {
			    		echo '<div class="team-caption-bio"><p>';
			    		echo esc_html( get_post_meta( $post_id, 'bio', true ) );
			    		echo '</p></div>';
			    	}

			    	?>

		    	</div>
	    	</div>

		</div>

	<?php

	endwhile;
	endif; // End The Loop

	echo '</div>';

	} else { // No posts
		echo '<div class="vntd-no-posts"><p><i class="fa fa-info"></i> It seems you don\'t have any team member posts created. You may add new <a href="' . admin_url( 'edit.php?post_type=team' ) . '" target="_blank">here</a> or import them with one of the demo sites.</p></div>';
	}

	echo '</div>';

	wp_reset_postdata();

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'team_members' );
add_shortcode( 'team_members', 'engage_team_members' );
