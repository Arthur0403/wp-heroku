<?php

if ( !post_type_exists( 'tribe_events' ) || !function_exists( 'tribe_get_events' ) ) {
    return;
}

$params = array(
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Choose event', "engage" ),
        'param_name' => 'event_id',
        'value' => engage_events_list(),
        'description' => esc_html__( 'Choose the event. Please note that past events are not displayed and you may select only the upcoming ones.', "engage" ),
        'dependency' => array(
            "element" => 'onclick',
            'value' => array(
                'custom_link'
            )
        )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Display Counter?", "engage" ),
        "param_name" => "counter",
        'value' => array(
            esc_html__( 'Yes', "engage" ) => 'yes',
            esc_html__( 'No', "engage" ) => 'no'
        ),
        "description" => esc_html__( "Enable a countdown to the event date.", "engage" )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Event Title HTML Tag", "engage" ),
        "param_name" => "title_tag",
        'value' => array(
            esc_html__( 'Default', "engage" ) => 'yes',
            'H1' => 'h1',
            'H2' => 'h2',
            'H3' => 'h3',
            'H4' => 'h4',
            'H5' => 'h5',
            'H6' => 'h6'
        ),
        "description" => esc_html__( "Choose a HTML heading tag for the Event Title.", "engage" )
    ),
    array(
        "type" => "dropdown",
        "class" => "hidden-label",
        "heading" => esc_html__( "Image Size", "engage" ),
        "param_name" => "img_size",
        "value" => array(
            esc_html__( "Regular", "engage" ) => "",
            esc_html__( "Custom", "engage" ) => "custom"
        ),
        "description" => esc_html__( "Choose event image size.", "engage" )
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Custom Image Size', 'engage' ),
        'param_name' => 'img_size_custom',
        'value' => '700x500',
        'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 200x100 (Width x Height).', 'engage' ),
        'dependency' => Array(
            "element" => "img_size",
            'value' => array(
                "custom"
            )
        ),
    ),
);

// Add responsive group

$params = array_merge( $params, engage_responsive_params() );

// Blog

return array(
    "name" => esc_html__( "Single Event", "engage" ),
    "base" => "vntd_single_event",
    "icon" => "fa-star",
    "class" => "font-awesome",
    "category" => array(
        'Engage'
    ),
    "description" => esc_html__( "A single event view.", "engage" ),
    "params" => $params
);

function engage_events_list() {

    $events_array = array();

    $events = tribe_get_events( array(
        'posts_per_page' => 500,
    ) );

    $events_array[ esc_html__( 'Select an event', 'engage' ) . ':' ] = '';

    if ( count( $events ) > 0 ) {
        foreach( $events as $event ) {

            $date_event = tribe_get_start_date( $event->ID, true, 'Y-m-d h:i A' );
            $date_event = strtotime( $date_event );

            $remaining = $date_event - time();

            if ( $remaining > 0 ) {
                //$events_array[ $remaining ] = 'bla';
                $events_array[ $event->post_title ] = $event->ID;
            }

        }
    } else {
        $events_array[ esc_html__( 'No events found.', 'engage' ) ] = '';
    }

    return $events_array;
}