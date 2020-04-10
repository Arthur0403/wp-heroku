<?php

/*

Plugin Name: Recent Blog Posts
Plugin URI: http://themeforest.net/user/Veented/
Description: The most recent posts from your blog with a thumbnail.
Version: 1.1
Author: Veented
Author URI: http://themeforest.net/user/Veented/

*/

if ( ! function_exists( 'engage_pr_widget_blogpost' ) ) {

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'engage_pr_widget_blogpost' );

	/* Function that registers our widget. */
	function engage_pr_widget_blogpost()
	{
		register_widget( 'engage_PR_Widget_Blogpost' );
	}

	// Widget class.
	class engage_PR_Widget_Blogpost extends WP_Widget {


		function __construct()
		{
			/* Widget settings. */
			$widget_ops = array(
				 'classname' => 'pr_widget_blogpost',
				'description' => 'The most recent posts on your site with an image.'
			);

			/* Create the widget. */

			parent::__construct( 'pr_widget_blogpost', 'Veented Blog Posts', $widget_ops );
		}

		function widget( $args, $instance )
		{
			extract( $args );

			/* User-selected settings. */
			$title  = apply_filters( 'widget_title', $instance['title'] );
			$number = $instance['number'];
			$cats   = $instance['cats'];
			$thumb  = $instance['thumb'];
			$type   = $instance['type'];

			/* Before widget (defined by themes). */
			echo '' . $before_widget;

			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo '' . $before_title . $title . $after_title;


			// Build cats

			$categories = '';

			if ( $cats ) {
				foreach ( $cats as $cat ) {
					$categories .= $cat . ',';
				}
			}

			/* Display name from widget settings. */
			$extra_class = '';

			if ( $type == 'tabbed' ) {
				$extra_class = ' recent-posts-tabbed widget-tabbed';
			}
			?>

			<div class="recent-posts-wrap<?php echo esc_attr( $extra_class ); ?>">

			<?php
			if ( $type == 'tabbed' ) {
				echo '<ul class="widget-tabbed-nav"><li class="active-tab" data-tab="1">' . esc_html__( 'Recent', 'engage' ) . '</li><li data-tab="2">' . esc_html__( 'Popular', 'engage' ) . '</li></ul>';
			}
			?>

	        <ul class="widget-recent-posts content-item content-item-1">

	        <?php

			wp_reset_postdata();

			$orderby = 'date';
			if ( $type == 'popular' )
				$orderby = 'comment_count';

			$args      = array(
				 'posts_per_page' => $number,
				'cat' => $categories,
				'orderby' => $orderby,
				'tax_query' => array(
					 array(
						 'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							 'post-format-link',
							'post-format-quote'
						),
						'operator' => 'NOT IN'
					)
				)
			);
			$the_query = new WP_Query( $args );

			$no_thumb_class = '';

			if ( $the_query->have_posts() ):
				while ( $the_query->have_posts() ):
					$the_query->the_post();

	?>
	            <li class="rp-wrap clearfix">
	                <a class="rp-holder" href="<?php the_permalink(); ?>">
	                	<?php if ( $thumb ) { ?>
	                	<div class="rp-thumbnail accent-hover-border">
	                    	<?php if ( has_post_thumbnail() ) { ?>
	                    	<?php echo get_the_post_thumbnail(); ?>
	                        <?php } ?>
	                    </div>
	                    <?php
						} else {
							$no_thumb_class = ' no-thumb';
						} ?>
		                    <div class="rp-title<?php echo esc_attr( $no_thumb_class ); ?>">
		                        <div><?php the_title(); ?></div>
		                        <p class="classic-meta-section">
		                        	<?php

						if ( $type == 'popular' ) {
							comments_number( '0', '1', '%' );
							echo ' ' . esc_html__( 'comments', 'engage' );
						} else {
							the_time( 'M d, Y' );
						}

						?>
	                        </p>
	                    </div>
	                </a>
	            </li>
	            <?php
				endwhile;
			endif;
			wp_reset_postdata();
			?>
	         </ul>

	         <?php

			if ( $type == 'tabbed' ) {

				echo '<ul class="widget-recent-posts popular-posts-tab content-item content-item-2"> ';

				wp_reset_postdata();

				$args      = array(
					 'posts_per_page' => $number,
					'cat' => $categories,
					'orderby' => 'comment_count',
					'tax_query' => array(
						 array(
							 'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array(
								 'post-format-link',
								'post-format-quote'
							),
							'operator' => 'NOT IN'
						)
					)
				);
				$the_query = new WP_Query( $args );

				$no_thumb_class = '';

				if ( $the_query->have_posts() ):
					while ( $the_query->have_posts() ):
						$the_query->the_post();
	?>

	     		<li class="rp-wrap clearfix<?php
						if ( $thumb )
							echo ' rp-with-thumb';
	?>">
	     		    <a class="rp-holder" href="<?php
						the_permalink();
	?>">
	     		    	<?php
						if ( $thumb ) {
	?>
	     		    	<div class="rp-thumbnail accent-hover-border">
	     		        	<?php
							if ( has_post_thumbnail() ) {
								echo get_the_post_thumbnail();
							}
	?>
	     		        </div>
	     		        <?php
						} else {
							$no_thumb_class = ' no-thumb';
						}
	?>
	     		        <div class="rp-title<?php
						echo esc_attr( $no_thumb_class );
	?>">
	     		            <div><?php
						the_title();
	?></div>
	     		            <p class="classic-meta-section"><?php
						the_time( 'M d, Y' );
	?></p>
	     		        </div>
	     		    </a>
	     		</li>

	         	<?php
					endwhile;
				endif;
				wp_reset_postdata();

				echo '</ul>';
			}

	?>

	         </div>


	        <?php

			/* After widget (defined by themes). */
			echo '' . $after_widget;
		}

		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;

			/* Strip tags (if needed) and update the widget settings. */
			$instance['title']  = strip_tags( $new_instance['title'] );
			$instance['cats']   = $new_instance['cats'];
			$instance['number'] = strip_tags( $new_instance['number'] );
			$instance['thumb']  = strip_tags( $new_instance['thumb'] );
			$instance['type']   = strip_tags( $new_instance['type'] );

			return $instance;
		}


		function form( $instance )
		{

			/* Set up some default widget settings. */
			$defaults = array(
				 'title' => 'Recent Posts',
				'cats' => '',
				'number' => '4',
				'thumb' => 1,
				'type' => 'recent'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
	?>

	    	<p>
			<label for="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php
			echo esc_html( $instance['title'] ); ?>" style="width:100%;" />
			</p>

			<p>

			<label for="<?php
			echo esc_html( $this->get_field_id( 'cats' ) ); ?>"><?php esc_html_e( 'Categories', 'engage' ); ?>:</label>
			<?php

			$blog_categories = get_categories();

			foreach ( $blog_categories as $blog_category ) {
				$checked = "";
				if ( !isset( $portfolio_page_cats ) )
					$portfolio_page_cats = '';
				$pos = strpos( $portfolio_page_cats, $blog_category->slug );

				if ( $instance['cats'] ) {
					if ( in_array( $blog_category->term_id, $instance['cats'] ) ) {
						$checked = 'checked="checked"';
					}
				}

				echo '<div class="vntd-widget-categories"><input id="' . $this->get_field_id( 'cats' ) . $blog_category->term_id . '" type="checkbox" name="' . $this->get_field_name( 'cats' ) . '[]" ' . $checked . ' value="' . $blog_category->term_id . '">' . $blog_category->name . '</div>';

			}

	?>

			</p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'number' ) );
	?>"><?php esc_html_e( 'Number of posts to show', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'number' ) );
	?>" name="<?php
			echo esc_html( $this->get_field_name( 'number' ) );
	?>" type="text" value="<?php
			echo esc_attr( $instance['number'] );
	?>" size="3" />
	        </p>

	        <p>
	        <label for="<?php echo esc_html( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Posts Type', 'engage' ); ?>:</label>
	        <select id="<?php echo esc_html( $this->get_field_id( 'type' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'type' ) ); ?>">
	            <option <?php if ( $instance['type'] == "recent" ) echo 'selected="selected"'; ?> value="recent"><?php esc_html_e( 'Recent', 'engage' ); ?></option>
	            <option <?php if ( $instance['type'] == "popular" ) echo 'selected="selected"'; ?> value="popular"><?php esc_html_e( 'Popular', 'engage' ); ?></option>
	            <option <?php if ( $instance['type'] == "tabbed" ) echo 'selected="selected"'; ?> value="tabbed"><?php esc_html_e( 'Mixed (Tabbed Content)', 'engage' ); ?></option>
	        </select>
	        </p>

	        <p>
	        <input id="<?php
			echo esc_html( $this->get_field_id( 'thumb' ) );
	?>" name="<?php
			echo esc_html( $this->get_field_name( 'thumb' ) );
	?>" type="checkbox" <?php
			if ( $instance['thumb'] )
				echo 'checked="checked"';
	?>>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'thumb' ) );
	?>"><?php esc_html_e( 'Display thumbnail', 'engage' ); ?></label>
	        </p>


	        <?php
		}
	}
}
