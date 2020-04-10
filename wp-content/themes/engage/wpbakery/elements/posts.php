<?php

// VC Autocomplete

add_filter( 'vc_autocomplete_vntd_posts_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
add_filter( 'vc_autocomplete_vntd_posts_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

$postTypes = get_post_types( array() );
$postTypesList = array();

$excludedPostTypes = array(
    'revision',
    'nav_menu_item',
    'vc_grid_item',
    'wpcf7_contact_form',
    'custom_css',
    'customize_changeset',
    'oembed_cache',
    'shop_order_refund',
    'shop_webhook'
);

if ( has_filter( 'engage_filter_exclude_post_types' ) ) {
    $excludedPostTypes = apply_filters( 'engage_filter_exclude_post_types'. $excludedPostTypes );
}

$postTypesData = array();

if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
    foreach ( $postTypes as $postType ) {
        if ( ! in_array( $postType, $excludedPostTypes ) ) {
            $label = ucfirst( $postType );
            $postTypesData[ $label ] = $postType;
        }
    }
}

// Posts shortcode register

$params = array(
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Data source', 'engage' ),
        'param_name' => 'post_type',
        'value' => $postTypesData,
        'save_always' => true,
        'description' => esc_html__( 'Select post type to be displayed.', 'engage' ),
        'admin_label' => true,
    ),
    array(
        'type' => 'autocomplete',
        'heading' => esc_html__( 'Narrow data source', 'engage' ),
        'param_name' => 'taxonomies',
        'settings' => array(
            'multiple' => true,
            'min_length' => 1,
            'groups' => true,
            // In UI show results grouped by groups, default false
            'unique_values' => true,
            // In UI show results except selected. NB! You should manually check values in backend, default false
            'display_inline' => true,
            // In UI show results inline view, default false (each value in own line)
            'delay' => 500,
            // delay for search. default 500
            'auto_focus' => true,
            // auto focus input, default true
        ),
        'param_holder_class' => 'vc_not-for-custom',
        'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'engage' )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Posts Style", "engage" ),
        "param_name" => "style",
        "value" => array(
            esc_html__( "Theme defaults", 'engage' ) => 'default',
            esc_html__( "Classic", 'engage' ) => "classic",
            esc_html__( "Left Image", 'engage' ) => "left_image",
            esc_html__( "Masonry", 'engage' ) => "masonry"
        ),
        "description" => esc_html__( "Choose a style of posts or leave default settings set in the Theme Options panel.", "engage" )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Grid Columns", "engage" ),
        "param_name" => "cols",
        "value" => array(
            esc_html__( "Theme defaults", 'engage' ) => 'default',
            "6",
            "5",
            "4",
            "3",
            "2"
        ),
        "std" => "default",
        "dependency" => Array(
            "element" => "style",
            'value' => array(
                "masonry"
            )
        ),
        "description" => esc_html__( "Select number of columns for your masonry style posts.", "engage" )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Ajax Pagination", "engage" ),
        "param_name" => "ajax",
        "value" => array(
            esc_html__( "Theme defaults", 'engage' ) => 'default',
            esc_html__( "No", 'engage' ) => "no",
            esc_html__( "Yes", 'engage' ) => "yes"
        ),
        "description" => esc_html__( "Enable or disable the ajax pagination (load more button).", "engage" )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Blog Post Style", "engage" ),
        "param_name" => "boxed",
        "value" => array(
            esc_html__( "Theme defaults", 'engage' ) => 'default',
            esc_html__( "Boxed", 'engage' ) => "boxed",
            esc_html__( "Boxed No Border", 'engage' ) => "boxed_no_border",
            esc_html__( "Not Boxed", 'engage' ) => "not_boxed",
        ),
        "description" => esc_html__( "Choose a boxed style for your posts. Applies only for 'Clasic' and 'Masonry' posts style.", "engage" )
    ),
    array(
        "type" => "textfield",
        "class" => "hidden-label",
        "heading" => esc_html__( "Posts per page", "engage" ),
        "param_name" => "posts_nr",
        "value" => '',
        "description" => esc_html__( "Number of posts to be displayed per page. Leave blank for site defaults.", "engage" )
    )
);

$params = array_merge( $params, engage_order_params() );

return array(
    "name" => esc_html__( "Posts", "engage" ),
    "base" => "vntd_posts",
    "class" => "font-awesome",
    "icon" => "fa-file-text-o",
    "controls" => "full",
    "description" => esc_html__( 'Display posts', 'engage' ),
    "category" => array( esc_html__( 'Posts', 'engage' ), 'Engage' ),
    "params" => $params
);