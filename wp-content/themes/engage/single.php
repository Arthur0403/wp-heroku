<?php 

$post = $wp_query->post;

get_header(); 

$post_id = get_the_ID();

$layout = engage_page_layout( $post_id );
$general_layout = engage_general_layout( $layout );
$sidebar_width = engage_sidebar_width( $post_id );
$page_width = engage_page_width( $post_id );
$container_class = engage_container_class( $page_width );

?>

<section class="section-page <?php echo esc_attr( $general_layout ); ?> page-layout-<?php echo esc_attr( $layout ); ?> sidebar-width-<?php echo esc_attr( $sidebar_width ); ?> page-width-<?php echo esc_attr( $page_width ); ?>"<?php engage_page_content_styles(); ?>>
	
	<div class="container<?php echo esc_attr( $container_class ); ?>">
	
		<div class="row main-row">
		
			<div id="page-content" class="page-content">
		
			<?php
			
			// Post Content Loop
			
			if (have_posts()) : while (have_posts()) : the_post(); 
				
				$extra_classes = array();
				$extra_classes[] = 'post-holder';
				
				?>
				
				<div <?php post_class( $extra_classes ); ?>>
				
				<?php
				
				// Post Media
				
				$post_format = get_post_format( get_the_ID() );
				
				if ( engage_option( 'blog_single_media' ) != false && get_post_meta( get_the_ID(), 'post_media', true) != 'disable' || !class_exists( 'Engage_Core' ) ) {
					if( $post_format != '' || $post_format == '' && has_post_thumbnail() ) {
						$img_size = 'engage-sidebar-auto';
						engage_post_media( get_the_ID(), $post_format, $img_size );
					}
				}
				
				?>
				
				<?php the_content(); ?>
				
				</div>
				
				<div class="after-blog-post">
				
				<?php
				
				// Trackbacks
				
				if( $post->ping_status == 'open' && engage_option('blog_trackback') != false || !class_exists( 'Engage_Core' ) ) {
					echo '<div class="post-trackbacks"><p class="post-trackback"><i class="fa fa-chain"></i> ' . esc_html__( 'Trackback URL', 'engage' ) . ': <a href="' . get_trackback_url() . '">' . get_trackback_url() . '</a></p></div>';
				}
				
				wp_link_pages();
				
				// Post Tags
				
				if ( engage_option( 'blog_post_tags' ) != false || !class_exists( 'Engage_Core' ) ) {
					engage_blog_post_tags();
				}
				
				// Post Author
				
				if ( engage_option( 'blog_post_author' ) != false || !class_exists( 'Engage_Core' ) ) {
					engage_blog_post_author();
				}
				
				// Post Navigation
				
				if( engage_option('blog_post_nav') != false || !class_exists( 'Engage_Core' ) ) {
					engage_blog_post_nav( $container_class );
				}
				
				// Comments
				
				if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
					echo '<div class="post-comments after-post-section"><div class="container' . esc_attr( $container_class ) . '">';
					comments_template();
					echo '</div></div>';
				}
				
				?>
				
				</div>
				
				<?php
				
			// End The Loop
			          
			endwhile; endif; 
			
			?>
			
			</div>
			
			<?php
			
			// Page Sidebar
		
			if( $layout != "no_sidebar" ) {
				get_sidebar();    
			}
			
			?>
		
		</div>
	
	</div>

</section>

<?php get_footer(); ?>