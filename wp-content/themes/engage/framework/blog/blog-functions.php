<?php

// Blog Post Content

if ( !function_exists( 'engage_blog_post' ) ) {
	function engage_blog_post( $page_layout = 'no_sidebar', $blog_style = 'classic' ) {

		$post_id = get_the_ID();

		$post_format = get_post_format( $post_id );

		$extra_classes = array(); // Additional classes for the post

		// Define is post has any media

		$post_has_media = false;

		$extra_classes[] = 'post-holder';

		if ( has_post_thumbnail() || get_post_gallery() || $post_format == 'quote' || $post_format == 'link' || $post_format == 'audio' || $post_format == 'video' ) {
			$post_has_media = true;
		} else {
			$extra_classes[] = 'post-no-media';
		}

		// Masonry blog style

		if( $blog_style == 'masonry' ) {
			$extra_classes[] = 'item';
			$extra_classes[] = 'grid-item cbp-item';
		}

		$post_meta = true;

    if ( engage_option( 'blog_meta' ) != '' && engage_option( 'blog_meta' ) == '0' ) {
        $post_meta = false;
    }

		?>

		<div <?php post_class( $extra_classes ); ?>>

			<?php

			if ( $post_has_media ) {

				// Image Size

				$img_size = 'engage-masonry-regular';

				if ( $blog_style == 'grid' ) {

				} elseif ( $blog_style == 'classic' ) {
					if ( $page_layout == 'no_sidebar' ) {
						$img_size = 'engage-fullwidth-crop';
					} else {
						$img_size = 'engage-sidebar-wide';
					}
				} elseif ( $blog_style == 'left_image' ) {
					$img_size = 'engage-masonry-regular';
				} elseif ( $blog_style == 'masonry' ) {
					$img_size = 'engage-masonry-auto';
				}

				if( is_single() ) $img_size = 'engage-sidebar-auto';

                if ( has_filter( 'engage_blog_index_img_size' ) ) {
                    $img_size = apply_filters( 'engage_blog_index_img_size', $img_size );
                }

				engage_post_media( $post_id, $post_format, $img_size ); // Print post media

			}

			?>

			<div class="post-info">

                <?php do_action( 'engage_blog_index_before_post_title' ); ?>

				<h4 class="post-title"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h4>

				<?php

				// Post meta:

				if ( $post_meta == true && get_post_type( $post_id ) != 'page' ) {
				    $args = array();

				    if ( engage_option( 'blog_meta_author' ) == '0' ) {
				        $args['author'] = false;
            }

            if ( engage_option( 'blog_meta_date' ) == '0' ) {
                $args['date'] = false;
            }

				    engage_post_meta( $args );
        }

				?>

				<div class="post-content <?php echo ( is_single() ? 'single-post-content' : 'post-excerpt' ); ?>">

					<?php

					if ( is_single( $post_id ) ) { // Single Post

						the_content();

					} else { // Blog Index page: display excerpt

						$excerpt_size = 40;

						if( $blog_style == 'masonry' ) {
							$excerpt_size = 25;
						}

						echo engage_excerpt( $excerpt_size, true );

					}

					?>

				</div>

			</div>

		</div>

		<?php

	}
}

// Print blog post media: image, audio, video etc

if( !function_exists( 'engage_post_media' ) ) {
	function engage_post_media( $post_id, $post_format, $img_size = 'engage-masonry-regular' ) {

		if ( $post_format == 'gallery' && get_post_gallery( $post_id, false ) && !array_key_exists( 'ids', get_post_gallery( $post_id, false ) ) ) {
			return false;
		}

		// Featured image

		if ( has_post_thumbnail( $post_id ) ) {
			$featured_image = engage_get_thumb( get_post_thumbnail_id( $post_id ), $img_size );
			$featured_image_url  = $featured_image['url'];
		} else {
			$featured_image_url = '';
		}

		if ( $post_format == 'gallery' && get_post_meta( $post_id, 'blog_post_gallery', true ) != '' ) {

			// Gallery - Slider

			wp_enqueue_script( 'swiper', '', '', '', true );
			wp_enqueue_script( 'engage-sliders', '', '', '', true );
			wp_enqueue_style( 'swiper' );

			//$post_gallery = get_post_gallery( $post_id, false );

			if ( $img_size == 'engage-masonry-auto' ) {
				$img_size = 'engage-masonry-regular';
			} else {
				$img_size = 'engage-sidebar-wide';
			}

			$post_gallery = explode( ',', get_post_meta( $post_id, 'blog_post_gallery', true ) );

			echo '<div class="post-medias">';
			echo '<div class="engage-swiper-slider swiper-container"><div class="swiper-wrapper">';

			foreach( $post_gallery as $gallery_image_id ) {

				$slide_image = engage_get_thumb( $gallery_image_id, $img_size );
				$slide_url  = $slide_image['url'];
				$slide_title = esc_textarea( get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true ) );

				echo '<div class="swiper-slide"><a href="' . esc_url( $slide_url ) . '" title="' . $slide_title . '"><img src="' . esc_url( $slide_url ) . '" alt="' . $slide_title . '"></a></div>';

			}

			echo '</div><div class="engage-slider-pagination swiper-pagination"></div></div>';

			echo '</div>';


		} elseif ( $post_format == 'video' ) {

			// Video

			if ( get_post_meta( $post_id, 'format_video_source', true ) == 'self_hosted' ) {

				wp_enqueue_script( 'video-js', '', '', '', true );
				wp_enqueue_script( 'engage-videos', '', '', '', true );
				wp_enqueue_style( 'video-js' );

				$video_file = get_post_meta( $post_id, 'format_video_file', true );
				$video_url = '';

				echo '<div class="post-medias">';

				if( $video_file ) {

					$video_url = $video_file['url'];

					echo
					'<div class="video-wrapper">
						<video id="video-' . $post_id . '" class="video-js video-js-video vjs-sublime-skin" controls preload="auto" data-poster="' . $featured_image_url . '" data-setup="{}">
							<source src="' . esc_url( $video_url ) . '" type="video/mp4"/>
						</video>
					</div>';

				} else {
					echo esc_html__( 'No video file selected.', 'engage' );
				}

				echo '</div>';

			} else {

				// External website (YouTube, Vimeo) - oEmbed

				if( !get_post_meta( $post_id, 'format_video_url', true ) ) {

				} else {
					echo '<div class="post-medias">';
					echo '<div class="oembed-video-container video-container-blog">' . wp_oembed_get( esc_url( get_post_meta( $post_id, 'format_video_url', true ) ) ) . '</div>';
					echo '</div>';
				}


			}

		} elseif( $post_format == 'quote' ) { // Quote

			$inline_css = '';

			echo '<div class="post-medias">';

			if( get_post_meta( $post_id, 'format_quote_bg_color', true ) != '' ) {
				$inline_css = 'style="background-color:' . esc_attr( get_post_meta( $post_id, 'format_quote_bg_color', true ) ) . ';"';
			}

			echo '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="post-quote-wrap-a"><div class="post-quote-wrap accent-bg-color"' . $inline_css . '>';

			$quote_content = esc_html__('Your quote content textarea is empty. Please edit your post.', 'engage');

			if( get_post_meta( $post_id, 'format_quote_content', true ) != '' ) {
				$quote_content = esc_textarea( get_post_meta( $post_id, 'format_quote_content', true ) );
			}

			echo '<div class="post-quote">' . $quote_content . '</div>';

			if( get_post_meta( $post_id, 'format_quote_author', true ) != '' ) {
				echo '<span class="post-quote-author">- ' . esc_html( get_post_meta( $post_id, 'format_quote_author', true ) ) . '</span>';
			}

			echo '<i class="engage-icon-icon engage-icon-quote"></i></div></a>';

			echo '</div>';

		} elseif( $post_format == 'link' ) {

			$inline_css = '';

			if( get_post_meta( $post_id, 'format_link_bg_color', true ) != '' ) {
				$inline_css = 'style="background-color:' . esc_attr( get_post_meta( $post_id, 'format_link_bg_color', true ) ) . ';"';
			}

			$link = $final_link = '';

			if( get_post_meta( $post_id, 'format_link_url', true ) ) {
				$final_link = $link = get_post_meta( $post_id, 'format_link_url', true );
			}

			if( $link == '' ) {
				$final_link = get_permalink( $post_id );
			}

			$link_label = '';

			if( get_post_meta( $post_id, 'format_link_label', true ) != '' ) {
				$link_label = get_post_meta( $post_id, 'format_link_label', true );
			}

			if ( $link_label != '' ) {

				echo '<div class="post-medias">';

				echo '<a href="' . esc_url( $final_link ) . '" class="post-link-wrap-a"><div class="post-link-wrap accent-bg-color"' . $inline_css . '>';

				echo '<div class="post-link-label">' . esc_html( $link_label ) . '</div>';

				if( $link != '' ) {
					echo '<span class="post-link-url">' . esc_url( $link ) . '</span>';
				}

				echo '<i class="engage-icon-icon engage-icon-link-72"></i></div>';

				echo '</a></div>';

			}

		} elseif( $post_format == 'audio' ) {

			// Audio

			wp_enqueue_script( 'video-js', '', '', '', true );
			wp_enqueue_script( 'engage-videos', '', '', '', true );
			wp_enqueue_style( 'video-js' );

			$audio_file = get_post_meta( $post_id, 'format_audio_file', true );
			$audio_url = '';

			if( $audio_file && array_key_exists( 'url', $audio_file ) && $audio_file['url'] != '' ) {
				$audio_url = $audio_file['url'];
			} elseif( get_post_meta( $post_id, 'format_audio_url', true ) ) {
				$audio_url = get_post_meta( $post_id, 'format_audio_url', true );
			} else {
				echo esc_html__('No audio file selected.', 'engage');
			}

			$extra_styling = '';

			if( get_post_meta( $post_id, 'format_audio_bg_color', true ) ) {
				$extra_styling = 'style="background-color:' . esc_html( get_post_meta( $post_id, 'format_audio_bg_color', true ) ) . '"';
			}

			if( $audio_url ) {
				echo '<div class="post-medias">';
				echo
				'<div class="audio-video-wrapper">
					<audio id="audio-' . $post_id . '" class="video-js video-js-audio vjs-sublime-skin" controls preload="auto" data-setup="{}" ' . $extra_styling . '>
						<source src="' . esc_url( $audio_url ) . '" type="audio/mp3"/>
					</audio>
				</div>';
				echo '</div>';
			}

		} elseif( has_post_thumbnail( $post_id ) ) {

			// Standard

      $img_alt = '';

      if ( get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true ) ) {
          $img_alt = get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );
      }

			?>
			<div class="post-medias">
			<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
				<img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_html( $img_alt ); ?>">
			</a>
			</div>
			<?php

		}

	}
}

// Print post meta

if( !function_exists( 'engage_post_meta' ) ) {
	function engage_post_meta( $args = array() ) {

		?>

		<ul class="post-meta">
            <?php if ( isset($args['author']) && $args['author'] == false ) { } else { ?>
                <li>
                    <?php echo engage_translate('by'); ?>
                    <a class="meta-value"
                       href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                </li>
                <?php
            }
            if ( isset($args['date']) && $args['date'] == false ) { } else {
            ?>
			<li>
				<?php echo engage_translate( 'on' ); ?>
				<span class="meta-value"><?php the_time( get_option( 'date_format' ) ); ?></span>
			</li>
            <?php } ?>
		</ul>

		<?php

	}
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Comments Layout
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_comment($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment;
   	global $post;

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :

   		?>
   		<li <?php comment_class(); ?> class="comment pingback">
   				<p><?php esc_html_e( 'Pingback:', 'engage' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'engage' ), '<span class="edit-link">', '</span>' ); ?></p>
   		</li>
   		<?php

   		break;

   	default:

    ?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

		<!-- Comment -->
		<div class="comment media">
			<!-- Image -->
			<div class="comment-author-avatar pull-left">
				<?php echo get_avatar($comment,$size='100'); ?>
			</div>
			<!-- Description -->
			<div class="comment-text media-body">

				<div class="details">
					<!-- Reply Button -->

					<h5 class="comment-heading media-heading font-secondary">

						<!-- Name -->
						<span class="comment-author"><?php comment_author(); ?></span>
						<!-- Date -->
						<span class="comment-date"><?php echo esc_html( get_comment_date('F d, Y') ); ?></span>
						<!-- Reply -->
						<span class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => engage_translate( 'reply' ) ) ) ); ?></span>

					</h5>
					<!-- Description -->
					<?php comment_text(); ?>

				</div>

			</div>
			<!-- End Description -->
		</div>
		<!-- End Comment -->

	</li>

	<?php

	break;

	endswitch;

}

// Blog Comments Script

function engage_comments_script() {
	if ( is_singular() )
	wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'engage_comments_script');

if ( !function_exists( 'engage_blog_post_author' ) ) {
	function engage_blog_post_author( $blog_style = NULL ) {

		global $post;

        $author_desc = '';
        $author_class = 'no-desc';

        if ( get_the_author_meta( 'description' ) != '' ) {
            $author_desc = get_the_author_meta( 'description' );
            $author_class = 'with-desc';
        }

		?>
		<div class="post-author after-post-section <?php echo esc_attr( $author_class ); ?>">

			<div class="post-author-avatar">
				<div class="post-author-circle"><?php echo get_avatar( get_the_author_meta('ID'), 100 ); ?></div>
			</div>

			<div class="post-author-info">
				<h5 class="post-section-heading"><?php the_author(); ?></h5>
				<?php

                if ( $author_desc != '' ) {
                    echo '<p>' . $author_desc . '</p>';
                }

				?>
			</div>

		</div>
		<?php
	}
}

function engage_post_meta_extra() {
	?>

	<div class="blog-extra-meta">
		<div class="extra-meta-item extra-meta-date">
			<?php

			echo '<span class="vntd-day">';
			$date_format = 'd';
			the_time( $date_format );
			echo '</span><span class="vntd-month">';
			$date_format = 'M';
			the_time( $date_format );
			echo '</span>';

			?>
		</div>
	</div>

	<?php
}

if ( !function_exists( 'engage_short_text' ) ) {
	function engage_short_text( $text, $limit = null ) {
		if ( $limit == null ) $limit = 30;

		if ( strlen( $text ) > $limit ) {
			$text = substr( $text, 0, $limit ) . '...';
		}

		return esc_html( $text );
	}
}

// Blog Post Navigation

if( !function_exists( 'engage_blog_post_nav' ) ) {
	function engage_blog_post_nav( $container_class = null ) {

		$container = '';

		if( $container_class == 'fluid' || $container_class == 'large' ) {
			$container = $container_class;
		}

		?>
		<div id="blog-post-nav" class="post-navigation blog-navigation after-post-section">
			<div class="container<?php echo esc_attr( $container ); ?>">
				<div class="row">

					<div class="col-xs-6 previous-post-wrap">
						<div class="previous-post">
							<?php

							$next_post = get_next_post();

							if ( !empty( $next_post ) ) {

							  echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" title="'. esc_attr( $next_post->post_title ) . '">';
							  echo '<span class="side-icon side-prev-icon"><i class="fa fa-angle-left"></i></span>';
							  echo '<span class="post-nav-label previous-post-label">'. esc_html( engage_translate( 'previous-post' ) ) . '</span>';

							  echo '<span class="post-nav-title">' . engage_short_text( $next_post->post_title, 45 ) . '</span>';
							  echo '</a>';

							}

							?>
						</div>
					</div>

					<div class="col-xs-6 next-post-wrap">
						<div class="next-post">
							<?php

							$previous_post = get_previous_post();

							if ( !empty( $previous_post ) ) {

							  echo '<a href="' . esc_url( get_permalink( $previous_post->ID ) ) . '" title="' . esc_attr( $previous_post->post_title ) . '">';
							  echo '<span class="side-icon side-next-icon"><i class="fa fa-angle-right"></i></span>';
							  echo '<span class="post-nav-label next-post-label">'. esc_html( engage_translate( 'next-post' ) ) . '</span>';
							  echo '<span class="post-nav-title">' . engage_short_text( $previous_post->post_title, 45 ) . '</span>';
							  echo '</a>';

							}

							?>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php
	}
}

// Single Blog Post Tags

if( !function_exists( 'engage_blog_post_tags' ) ) {
	function engage_blog_post_tags() {

		if( has_tag() ) {

			echo '<div class="post-tags after-post-section">';

			the_tags('', '', '');

			echo '</div>';

		}

	}
}

function engage_post_tags(){

	$posttags = get_the_tags();

	if($posttags == NULL) return false;

	if ($posttags) {
		echo '<span class="post-meta-tags">';
		$i = 0;
		$len = count($posttags);
		foreach($posttags as $tag) {
		  echo '<a href="'. esc_url( get_tag_link($tag->term_id) ) .'">';
		  echo esc_textarea($tag->name);
		  echo "</a>";
		   $i++;
		  if($i != $len) echo ', ';
		}
		echo '</span>';
	}
}

// Blog Post Title Meta

if( !function_exists('engage_blog_post_title_meta') ) {
	function engage_blog_post_title_meta() {

		global $post;
		$post_id = get_the_ID();

		echo '<ul class="blog-meta">';

		    // Post author

			if ( engage_option( 'blog_single_meta_author' ) != false ) {

                $post_author_id = get_post_field( 'post_author', $post_id );
                $author = get_userdata( $post_author_id );

                if ( is_object( $author ) ) {
                    echo '<li><span class="meta-label">' . esc_html( engage_translate( 'by' ) ) . '</span> <a href="' . esc_url( get_author_posts_url( $post_author_id ) ) . '">' . $author->display_name . '</a></li>';
                }

			}

			// Date

            if ( engage_option( 'blog_single_meta_date' ) != false ) {
                echo '<li><span class="meta-label">' . engage_translate('on') . '</span> <span>';
                the_time(get_option('date_format'));
                echo '</span></li>';
            }

            // Categories

            if ( engage_option( 'blog_single_meta_cats' ) != false ) {
			    if ( engage_translate('in') != '' ) {
                    echo '<li><span class="meta-label">' . engage_translate('in') . '</span> ';
                    the_category(', ');
                    echo '</li>';
                } else {
                    the_category(', ');
                }
            }

            // Comments

            if ( engage_option( 'blog_single_meta_comments' ) != false ) {
			    $comments_number = get_comments_number( $post_id );
                echo '<li class="meta-comments-count"><a href="#comments" class="meta-comments-link"><span class="meta-label">' . engage_translate('comments') . ':</span> <span>';
                echo '' . $comments_number;
                echo '</span></a></li>';
            }

		echo '</ul>';

	}
}

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// 		Post Views Count
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function engage_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function engage_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function engage_blog_masonry_activate() {
	wp_enqueue_script( 'cube-portfolio' );
	wp_enqueue_script( 'engage-grid' );
	wp_enqueue_style( 'cube-portfolio' );
}
