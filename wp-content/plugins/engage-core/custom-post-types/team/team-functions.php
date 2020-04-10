<?php

//
// New Post Type
//


add_action('init', 'engage_team_register');

function engage_team_register() {
    $args = array(
        'label' => esc_html__( 'Team Members', 'engage' ),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title','thumbnail')
       );

    register_post_type( 'team' , $args );

    register_taxonomy(
    	"member-position",
    	array("team"),
    	array(
    		"hierarchical" => true,
    		"context" => "normal",
    		'show_ui' => true,
    		"label" => esc_html__( "Member Position", 'engage' ),
    		"singular_label" => esc_html__( "Member Position", 'engage' ),
    		"rewrite" => true
    	)
    );
}


//
// Thumbnail column
//

add_filter( 'manage_edit-team_columns', 'engage_team_columns_settings' ) ;

function engage_team_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__('Title', 'crexis'),
		'date' => esc_html__('Date', 'crexis'),
		'slider-thumbnail' => ''
	);

	return $columns;
}

add_action( 'manage_team_posts_custom_column', 'engage_team_columns_content', 10, 2 );

function engage_team_columns_content( $column, $post_id ) {
	global $post;
	the_post_thumbnail('thumbnail', array('class' => 'column-img'));
}

if( !function_exists( 'engage_team_member_categories' ) ) {
	function engage_team_member_categories() {
		global $post;

		$terms = wp_get_object_terms($post->ID, "member-position");

		if($terms) {
			foreach ( $terms as $term ) {
				echo $term->name;
				if(end($terms) !== $term){
					echo ", ";
				}
			}
		}
	}
}

if( !function_exists( 'engage_team_member_class' ) ) {
	function engage_team_member_class(){

		global $post;
		$output = '';
	    $terms = wp_get_object_terms($post->ID, "member-position");
		foreach ( $terms as $term ) {
			$output .= $term->slug . " ";
		}

		return $output;

	}
}
