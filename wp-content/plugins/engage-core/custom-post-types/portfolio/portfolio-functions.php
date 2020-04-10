<?php

//
// New Post Type
//

add_action('init', 'engage_portfolio_register');

if( !function_exists("engage_portfolio_register") ) {
	function engage_portfolio_register() {

		$portfolio_slug = 'portfolio';

		if ( engage_option( 'portfolio_slug' ) ) $portfolio_slug = esc_attr( engage_option( 'portfolio_slug' ) );

		if ( has_filter( 'engage_portfolio_slug' ) ) {
		    $portfolio_slug = esc_attr( apply_filters( 'engage_portfolio_slug', $portfolio_slug ) );
		}

	    $args = array(
	        'label' => esc_html__('Portfolio', 'engage'),
	        'public' => true,
	        'show_ui' => true,
	        'capability_type' => 'post',
	        'hierarchical' => true,
	        'has_archive' => false,
	        'rewrite'     => array(
	                         'slug'       => $portfolio_slug, // if you need slug
	                         'with_front' => false,
	                         ),
	        'menu_icon' => 'dashicons-art',
	        'supports' => array('title','editor','thumbnail')
	       );

	    register_post_type( 'portfolio' , $args );

	    register_taxonomy(
	    	"portfolio-category",
	    	array("portfolio"),
	    	array(
	    		"hierarchical" => true,
	    		"context" => "normal",
	    		'show_ui' => true,
	    		"label" => esc_html__( "Portfolio Categories", 'engage' ),
	    		"singular_label" => esc_html__( "Portfolio Category", 'engage' ),
	    		"rewrite" => true
	    	)
	    );

	    register_taxonomy(
	    	"portfolio-skills",
	    	array("portfolio"),
	    	array(
	    		"hierarchical" => true,
	    		"context" => "normal",
	    		'show_ui' => true,
	    		"label" => esc_html__( "Portfolio Skills", 'engage' ),
	    		"singular_label" => esc_html__( "Portfolio Skill", 'engage' ),
	    		"rewrite" => true
	    	)
	    );

	}
}

//
// Custom taxonomy field: category icon
//

function engage_taxonomy_add_new_meta_field() {

	// this will add the custom meta field to the add new term page
	?>

	<div class="form-field">
		<label for="term_meta[category_icon]"><?php esc_html_e( 'Category Icon', 'crexis' ); ?></label>
		<input type="text" name="term_meta[category_icon]" id="term_meta[category_icon]" value="">
		<p class="description"><?php esc_html_e( 'Code of the FontAwesome icon that will represent this portfolio category. A full list of icon can be found <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">here</a>. Example: fa-camera-retro','crexis' ); ?></p>
	</div>

<?php
}

add_action( 'portfolio-category_add_form_fields', 'engage_taxonomy_add_new_meta_field', 10, 2 );

function engage_taxonomy_edit_meta_field($term) {

	// put the term ID into a variable
	$t_id = $term->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>

	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[category_icon]"><?php esc_html_e( 'Category Icon', 'crexis' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[category_icon]" id="term_meta[category_icon]" value="<?php echo esc_attr( $term_meta['category_icon'] ) ? esc_attr( $term_meta['category_icon'] ) : ''; ?>">
			<p class="description"><?php esc_html_e( 'Code of the FontAwesome icon that will represent this portfolio category. A full list of icon can be found <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">here</a>. Example: fa-camera-retro','crexis' ); ?></p>
		</td>
	</tr>

<?php
}

add_action( 'portfolio-category_edit_form_fields', 'engage_taxonomy_edit_meta_field', 10, 2 );

function engage_save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}
add_action( 'edited_portfolio-category', 'engage_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_portfolio-category', 'engage_save_taxonomy_custom_meta', 10, 2 );

// End custom taxonomy field


//
// New Columns
//

add_filter( 'manage_edit-portfolio_columns', 'engage_portfolio_columns_settings' ) ;

function engage_portfolio_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__('Title', 'crexis'),
		'category' => esc_html__( 'Category', 'crexis'),
		'date' => esc_html__('Date', 'crexis'),
		'thumbnail' => ''
	);

	return $columns;
}

add_action( 'manage_portfolio_posts_custom_column', 'engage_portfolio_columns_content', 10, 2 );

function engage_portfolio_columns_content( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'category' :

			$taxonomy = "portfolio-category";
			$post_type = get_post_type($post_id);
			$terms = get_the_terms( $post_id, $taxonomy );

			if ( !empty($terms) ) {
				$i = 1;
				foreach ( $terms as $term ) {
					if( is_object( $term ) ) {
						$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $taxonomy, 'edit') ) . "</a>";
					}
				}
				echo join( ', ', $post_terms );

			}
			else echo '<i>' . esc_html__('No categories' , 'engage') . '</i>';

			break;

		/* If displaying the 'genre' column. */
		case 'thumbnail' :

			the_post_thumbnail('thumbnail', array('class' => 'column-img'));

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

//
// Filtering Menu
//


if ( !function_exists( 'engage_portfolio_overlay_categories' ) ) {
	function engage_portfolio_overlay_categories(){

		global $post;
	    $terms = wp_get_object_terms($post->ID, "portfolio-category");
		foreach ( $terms as $term ) {
			echo esc_textarea($term->name);
			if(end($terms) !== $term){
				echo ", ";
			}
		}

	}
}

if ( !function_exists( 'engage_portfolio_holder_class' ) ) {
	function engage_portfolio_holder_class(){

		global $post;

		if(get_post_meta($post->ID, 'portfolio_post_type', true) == "direct" || get_post_meta($post->ID, 'video_post_type', true) == "direct")

		echo "gallery clearfix";
	}
}

if ( !function_exists( 'engage_portfolio_navigation' ) ) {
	function engage_portfolio_navigation(){

		global $post;

		// Check if Portfolio Navigation isn't disabled
		if(!get_post_meta($post->ID, 'nav_disabled', true)){

			echo '<div id="portfolio-navigation" class="page-title-side">';
			if(get_permalink(get_adjacent_post(false,'',false)) != get_permalink($post->ID)){
				echo '<a href="'.get_permalink(get_adjacent_post(false,'',false)).'" class="portfolio-prev fa fa-angle-left"></a>';
			}
			// Check if Parent Portfolio Page is set
			if(get_post_meta($post->ID, 'home_button', true) == 'enabled' && get_post_meta($post->ID, 'home_button_link', true)){

				$home_url = get_permalink(get_post_meta($post->ID, 'home_button_link', true));
				if(!$home_url) {
					$home_url = engage_option('portfolio_url');
				}
				if($home_url) {
					echo '<a href="'.esc_url($home_url).'" class="portfolio-home fa fa-th"></a>';
				}
			}

			if(get_permalink(get_adjacent_post(false,'',true)) != get_permalink($post->ID)){
				echo '<a href="'.get_permalink(get_adjacent_post(false,'',true)).'" class="portfolio-next fa fa-angle-right"></a>';
			}

			echo '</div>';
		}
	}
}


//
// Retrieve Custom Values
//

if(!function_exists('engage_portfolio_overlay_icon')) {
	function engage_portfolio_overlay_icon(){

		global $post;
		$post_type = get_post_meta($post->ID, 'portfolio_post_type', true);

		if($post_type == "direct"){
			echo "resize-full";
		}else{
			echo "link";
		}

	}
}

if(!function_exists('engage_portfolio_zoom_icon')) {
	function engage_portfolio_zoom_icon($page_id = NULL, $type = NULL) {

		global $post;

		$rel = 'prettyPhoto';
		$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );

		if($page_id) {
			$rel = 'gallery[gallery'.$page_id.']'; // If Portfolio Page, create a global gallery
		}

		if(!get_post_meta($post->ID, 'lightbox_disabled', true)) {
			echo '<a href="'.esc_url($thumb_url[0]).'" rel="'.esc_attr($rel).'"><span class="hover-icon hover-icon-zoom"></span></a>';
		}

	}
}

if(!function_exists('engage_portfolio_hidden_images')) {
	function engage_portfolio_hidden_images() {

		global $post;

		$gallery_images = get_post_meta($post->ID, 'gallery_images', true);

		if(get_post_meta($post->ID, 'on_click', true) == "lightbox" && $gallery_images){
			echo '<div class="lightbox-hidden">';
			$ids = explode(",", $gallery_images);
			foreach(array_slice($ids,1) as $id){
				$imgurl = wp_get_attachment_image_src($id, "large");
				echo '<a href="'.esc_url($imgurl[0]).'" rel="gallery[gallery'. $post->ID .']"></a>';
			}
			echo '</div>';
		}

	}
}

if(!function_exists('engage_lightbox_gallery_images')) {
	function engage_lightbox_gallery_images() {

		global $post;
		$gallery_images = get_post_meta($post->ID, 'gallery_images', true);

		if($gallery_images){

			echo '<div class="lightbox-hidden">';
			$ids = explode(",", $gallery_images);
			foreach($ids as $id){
				echo '<a href="'.wp_get_attachment_url($id).'" rel="gallery[gallery'. $post->ID .']"></a>';
			}
			echo '</div>';

		}

	}
}

if( !function_exists('engage_portfolio_item_class') ) {
	function engage_portfolio_item_class(){

		global $post;
		$output = '';
	    $terms = wp_get_object_terms($post->ID, "portfolio-category");
		foreach ( $terms as $term ) {
			$output .= $term->slug . " ";
		}

		return $output;

	}
}

if( !function_exists('engage_grid_filters') ) {
	function engage_grid_filters( $taxonomy, $cats, $grid_id, $orderby = null ) {

		if( $orderby == null ) {
			$orderby = 'name';
		}

		if(!$cats) {

			$portfolios_cats = get_terms( $taxonomy, array( 'orderby' => $orderby ) );

			$cats = '';
			foreach($portfolios_cats as $portfolio_cat) {
				$cats .= $portfolio_cat->slug.',';
			}
		}

		// Item Counter

		$counter = false;
		$counter_tag = '';

		if( $counter == true ) {
			$counter_tag = '<div class="cbp-filter-counter"></div>';
		}

		?>

		<div class="vntd-filters portfolio-filters-wrap">

			<ul id="grid-filters-<?php echo esc_attr( $grid_id ); ?>" class="grid-filters cbp-l-filters-alignCenter" data-gid="grid-<?php echo esc_attr( $grid_id ); ?>">
				<li data-filter="*" class="cbp-filter-item-active cbp-filter-item"><?php echo engage_translate( 'view-all' ); ?><?php if( $counter == true ) echo $counter_tag; ?></li>
				<?php

				$categories = explode( ",", $cats );

				foreach ( $categories as $value ) {
					$term = get_term_by( 'slug', $value, $taxonomy );
					if( isset( $term->name ) ) {
						echo '<li data-filter=".' . $value . '" class="cbp-filter-item">' . $term->name . $counter_tag . '</li>';
					}
				}

				?>
			</ul>
		</div>
		<?php
	}
}

if(!function_exists('engage_related_work')) {
	function engage_related_work() {
		global $post;

		$cols = 4;
		$title = $nav_style = $url = '';
		$thumb_size = 'vntd-portfolio-square';

		echo '<div id="related-work" class="vntd-carousel portfolio-carousel vntd-carousel-nav-side portfolio-style-default vntd-cols-'.esc_attr($cols).'" data-cols="'.esc_attr($cols).'">';
		echo '<h3>'.esc_html__('Related Work','crexis').'</h3>';

			engage_carousel_heading($title,$nav_style,$url);
			echo '<div class="carousel-overflow"><div class="carousel-holder vntd-row"><ul>';

				wp_reset_postdata();

				$args = array(
					'posts_per_page' => 8,
					'portfolio-category'		=> $cats,
					'post_type' => 'portfolio',
					'post__not_in' => array($post->ID)
				);
				$the_query = new WP_Query($args);

				if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

				echo '<li class="carousel-item span'.esc_attr(engage_carousel_get_cols($cols)).'">';

				?>

					<div class="portfolio-thumbnail-holder thumbnail-default hover-item">
						<a href="<?php echo get_permalink(); ?>" class="noSwipe portfolio-thumbnail">
							<img src="<?php echo engage_thumb(460,345); ?>" alt>
							<span class="hover-icon hover-icon-link"></span>
						</a>

						<div class="portfolio-thumbnail-caption">
						    <h4 class="caption-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
						    <span class="caption-categories"><?php engage_portfolio_overlay_categories(); ?></span>
						</div>
					</div>

				<?php

				echo '</li>';

				endwhile; endif; wp_reset_postdata();

			echo '</ul></div></div></div>';

	}
}

// Portfolio Navigation related functions

if(!function_exists('engage_portfolio_nav_enabled')) {
	function engage_portfolio_nav_enabled() {
		$return = 'enabled';

		return $return;
	}
}

if(!function_exists('engage_portfolio_nav')) {
	function engage_portfolio_nav() {

		global $post;

		?>
		<div class="vntd-portfolio-nav">
			<div class="inner">

				<div class="portfolio-nav-wrap">

					<?php

					next_post_link('<div class="portfolio-nav-next">%link</div>','<div class="thin-arrow thin-arrow-left"></div>');

					if(engage_option('portfolio_url')) {

					$parent_url = 'test';

					if(get_post_meta($post->ID, 'portfolio_parent_url', true)) {
						$parent_url = get_permalink(get_post_meta($post->ID, 'portfolio_parent_url', true));
					} else {
						$parent_url = get_permalink(get_page_by_path(engage_option('portfolio_url')));
					}

					?>
					<a href="<?php echo esc_url($parent_url); ?>" class="portfolio-nav-grid">
						<div class="nav-grid-1"></div>
						<div class="nav-grid-2"></div>
						<div class="nav-grid-3"></div>
						<div class="nav-grid-4"></div>
					</a>
					<?php
					}

					previous_post_link('<div class="portfolio-nav-prev">%link</div>','<div class="thin-arrow thin-arrow-right"></div>');

					?>
				</div>

			</div>
		</div>
		<?php
	}
}

if(!function_exists('engage_love_button')) {
	function engage_love_button() {

		if( function_exists( 'getPostLikeLink' ) ) {

			echo '<div class="portfolio-love-button">'.getPostLikeLink( get_the_ID() ).'</div>';

		} else {
			return false;
		}

	}
}

if(!function_exists('engage_get_category_icon')) {
	function engage_get_category_icon() {

		$terms = wp_get_object_terms(get_the_ID(), "portfolio-category");

		if( is_array( $terms ) ) {

			$term = $terms[0];

			$t_id = $term->term_id;

			$term_meta = get_option( "taxonomy_$t_id" );

			if( is_array( $term_meta ) ) {
				if( array_key_exists('category_icon', $term_meta) ) {
					return $term_meta["category_icon"];
				} else {
					return 'fa-camera-retro';
				}
			}

		}

		return 'fa-camera-retro';

	}
}

if( !function_exists('engage_portfolio_post_nav') ) {
	function engage_portfolio_post_nav( $container_class ) {

		global $post;

        $content = 'all';

        $title = $label = true;

        if ( engage_option( 'por_nav_cont' ) == 'title' || engage_option( 'por_nav_cont' ) == 'label' ) {
            $content = engage_option( 'por_nav_cont' );

            if ( $content == 'title' ) {
                $label = false;
            } else {
                $title = false;
            }
        }

		?>

		<div class="portfolio-nav post-navigation portfolio-nav-cont-<?php echo esc_attr( $content ); ?>">
			<div class="container<?php echo esc_attr( $container_class ); ?>">
				<div class="row">

					<div class="col-xs-5 portfolio-nav-previous">
						<div class="previous-post">
						<?php

						$next_post = get_next_post();

						if ( !empty( $next_post ) ) {

						  echo '<a href="' . get_permalink( $next_post->ID ) . '">';
						  echo '<span class="side-icon side-prev-icon"><i class="fa fa-angle-left"></i></span>';

                          if ( $label ) echo '<span class="post-nav-label previous-post-label">'. engage_translate( 'previous-project' ) . '</span>';
						  if ( $title ) echo '<span class="post-nav-title">' . $next_post->post_title . '</span>';

						  echo '</a>';

						}

						?>
						</div>
					</div>

					<div class="col-xs-2 portfolio-nav-grid">
						<div class="portfolio-nav-parent">
						<?php

						$parent_link = false;

						if( get_post_meta( $post->ID, 'portfolio_parent', true ) == 'custom' && get_post_meta( $post->ID, 'portfolio_parent_page', true ) != '' ) {
							$parent_link = get_permalink( get_post_meta( $post->ID, 'portfolio_parent_page', true ) );
						} elseif( engage_option( 'portfolio_page' ) != '' ) {
							$parent_link = get_permalink( engage_option( 'portfolio_page' ) );
						}

						if ( $parent_link != false ) {

						  echo '<a href="' . esc_url( $parent_link ) . '" title="' . engage_translate( 'View All' ) . '"><i class="engage-icon-icon engage-icon-grid-45"></i></a>';

						}

						?>
						</div>
					</div>

					<div class="col-xs-5 portfolio-nav-next">
						<div class="next-post">
						<?php

						$previous_post = get_previous_post();

						if ( !empty( $previous_post ) ) {

						  echo '<a href="' . get_permalink( $previous_post->ID ) . '">';
						  echo '<span class="side-icon side-next-icon"><i class="fa fa-angle-right"></i></span>';
						  if ( $label ) echo '<span class="post-nav-label next-post-label">' . engage_translate( 'next-project' ) . '</span>';
						  if ( $title ) echo '<span class="post-nav-title">' . $previous_post->post_title . '</span>';
						  echo '</a>';

						}

						?>
						<div class="next-post">
					</div>

				</div>
			</div>
		</div>
		<?php
	}
}

if ( !function_exists( 'engage_portfolio_video' ) ) {
	function engage_portfolio_video( $video_url, $featured_image_url ) {

		wp_enqueue_script( 'video-js', '', '', '', true );
		wp_enqueue_style( 'video-js' );

		echo
		'<div class="portfolio-video portfolio-video-self-hosted portfolio-media-element video-wrapper">
			<video class="video-js video-js-video vjs-sublime-skin" controls preload="auto" data-poster="' . $featured_image_url . '" data-setup="{}">
				<source src="' . esc_url( $video_url ) . '" type="video/mp4"/>
			</video>
		</div>';

	}
}

if ( !function_exists( 'engage_portfolio_media' ) ) {
	function engage_portfolio_media( $post_id, $post_layout ) {

		?>

		<div class="portfolio-media">

		<?php

		$img_size = 'engage-large';

		if( $post_layout == 'side' ) {
			$img_size = 'engage-sidebar-auto';
		}

		$featured_image = engage_get_thumb( get_post_thumbnail_id( $post_id ), $img_size );
		$featured_image_url  = $featured_image['url'];

		$video = $gallery = false;

		// Video

		if ( get_post_meta( $post_id, 'portfolio_video_type', true ) == 'oembed' && ( $video_url = get_post_meta( $post_id, 'portfolio_video_url', true ) ) != '' ) {

			// oEmbed Video
			$video = true;
			echo '<div class="portfolio-video portfolio-video-oembed portfolio-media-element oembed-video-container">' . wp_oembed_get( esc_url( $video_url ) ) . '</div>';

		} elseif( get_post_meta( $post_id, 'portfolio_video_type', true ) == 'self_hosted' && get_post_meta( $post_id, 'portfolio_video_file', true ) ) {

			// Self Hosted Video

			$video = true;

			$video_file = get_post_meta( $post_id, 'portfolio_video_file', true );

			if ( $video_file ) {

				$video_url = $video_file['url'];

				if ( function_exists( 'engage_portfolio_video' ) ) {
					engage_portfolio_video( $video_url, $featured_image_url );
				}

			} else {
				echo '<p class="missing-field">' . esc_html__('No video file selected.', 'engage') . '</p>';
			}

		}

		// Image Gallery

		$img_gallery = get_post_meta( $post_id, 'portfolio_gallery', true );

		if ( $img_gallery && $img_gallery != '' ) {

			echo '<div class="portfolio-gallery portfolio-media-element">';

			if( strpos( get_post_meta( $post_id, 'portfolio_gallery', true ), ',' ) !== false ) {

				wp_enqueue_script('engage-sliders', '', '', '', true);
				wp_enqueue_style('swiper');
				wp_enqueue_script('magnific-popup', '', '', '', true);
				wp_enqueue_style('magnific-popup');

				$gallery = explode( ',', get_post_meta( $post_id, 'portfolio_gallery', true ) );

				$gallery_type = 'slider';
				$holder_class = '';

				if( ( $value = get_post_meta( get_the_ID(), "portfolio_gallery_type", true ) ) != '' || ( $value = engage_option( 'portfolio_gallery_type' ) ) != 'slider' ) {
					$gallery_type = $value;
				}

				if( $gallery_type == 'slider' ) {
					echo '<div class="engage-swiper-slider swiper-container swiper-auto-height" data-auto-height="true"><div class="swiper-wrapper">';
					$holder_class = 'swiper-slide';
				} else {
					echo '<div class="portfolio-image-list">';
					$holder_class = 'image-list-item';
				}

				foreach ( $gallery as $image_id ) {

					$img = engage_get_thumb( $image_id, $img_size );
					$img_url  = $img['url'];

					$image = wp_get_attachment_image_src( $image_id, 'full' );
					$big_img_url = $image[0];

					$image_title = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

					echo '<div class="' . $holder_class . ' mp-gallery"><a href="' . esc_url( $big_img_url ) . '" title="' . $image_title . '"><img src="' . esc_url( $img_url ) . '" alt="' . esc_html( $image_title ) . '"></a>';
					// Caption

					$image = get_post( $image_id );
					if ( is_object( $image ) && isset( $image->post_excerpt ) ) {
					    echo '<p class="image-caption caption">' . esc_html( $image->post_excerpt ) . '</p>';
					}
					echo '</div>';

				}

				if( $gallery_type == 'slider' ) {
					echo '</div><div class="engage-slider-pagination swiper-pagination"></div>';
				}

				echo '</div>';

			} else { // Singular image in Gallery
				//echo 'Single image';
			}

			echo '</div>';

		}

		// Featured Image

		if( $video == false && $gallery == false ) {

			wp_enqueue_script('magnific-popup', '', '', '', true);
			wp_enqueue_style('magnific-popup');

			echo '<a href="' . esc_url( $featured_image_url ) . '" class="mp-single"><img class="portfolio-post-featured-image portfolio-media-element" src="' . $featured_image_url . '" alt="' . get_the_title( $post_id ) . '"></a>';
		}

		// Extra content

		if( ( $value = get_post_meta( $post_id, 'portfolio_info', true ) ) ) {

			if (have_posts()) : while (have_posts()) : the_post();

			    echo '<div class="portfolio-extra-content">';
				the_content();
				echo '</div>';

			endwhile; endif;

		}

		?>

		</div>

		<?php
	}
}
