<?php 
$post = $wp_query->post;
get_header();
$page_width = get_post_meta($post->ID, 'page_width', true);

if(!$page_width) $page_width == 'fullwidth';
?>

<div class="single-post single-team-post page-holder">
		
	<?php 		
	
	if($page_width != 'fullwidth') {
		echo '<div class="inner clearfix">';
	}
	
	echo '<div class="single-team-inner">';
	
	if (have_posts()) : while (have_posts()) : the_post(); 
	
		if(has_post_thumbnail()) echo '<div class="single-team-thumbnail">'; engage_post_media(); echo '</div>';
		
		echo '<h4 class="position">'.get_post_meta(get_the_ID(),"member_position",TRUE).'</h4>';
	        
		the_content();
	          
	endwhile; endif;    
	
	echo '</div>';
	
	if($page_width != 'fullwidth') {
		echo '</div>';
	}
	
	?>

</div>

<?php get_footer(); ?>