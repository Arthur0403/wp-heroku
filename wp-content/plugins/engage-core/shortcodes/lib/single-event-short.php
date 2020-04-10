<?php

function engage_single_event( $atts, $content = null)
{

    extract( shortcode_atts( array(
        "event_id" => '',
        "counter" => 'on',
        "title_tag" => 'h3',
        "img_size" => '',
        "img_size_custom" => "700x500"
    ), $atts ) );

    // Events Calendar Check
  	if ( ! function_exists( 'tribe_get_start_date' ) ) {
  		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate The Events Calendar plugin via the Appearance / Install Plugins menu.', 'engage' ) . '</div>';
  	}

    $event = get_post( $event_id ); // Event object

    $post_thumbnail_id = get_post_thumbnail_id( $event_id );

    $thumbnail_url = null;

    if ( $post_thumbnail_id ) {

        if ( $img_size == 'custom' && $img_size_custom != '' ) {
            $img_sizes = explode( 'x', $img_size_custom );

            $thumb = engage_img_resize( $post_thumbnail_id, null, $img_sizes[0],$img_sizes[1], true );
            $thumb = engage_img_resize( $post_thumbnail_id, null, $img_sizes[0],$img_sizes[1], true ); // URL fix
            $thumbnail_url = $thumb['url'];

        } else {
            $thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
            $thumbnail_url = $thumbnail_url[ 0 ];
        }

    }

    ob_start();

    ?>

    <div class="vntd-single-event vntd-content-element">

        <div class="row">

            <?php
            if ( $thumbnail_url ) {
                ?>
                <div class="col-md-6 col-xs-12">
                    <a href="<?php echo get_permalink($event_id); ?>" class="single-event-media">
                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt>
                    </a>
                </div>
                <?php
            }
            ?>

            <div class="<?php if ( $thumbnail_url == null ) { echo 'col-md-12'; } else { echo 'col-md-6'; } ?> col-xs-12">
                <<?php echo $title_tag; ?> class="single-event-title"><a href="<?php echo get_permalink( $event_id ); ?>"><?php echo esc_html( $event->post_title ); ?></a></<?php echo $title_tag; ?>>

                <ul class="single-event-meta">
                    <li class="single-event-date"><i class="fa fa-calendar"></i> <?php echo tribe_get_start_date( $event_id ); ?></li>
                    <li class="single-event-location"><i class="fa fa-map"></i> <?php echo tribe_get_venue( $event_id); ?></li>
                </ul>

                <p><?php

                $excerpt = $event->post_excerpt;

                if ( $excerpt != '' ) {
                    echo esc_html__( $excerpt );
                } else {
                    esc_html_e( 'Please add an excerpt to your event post.' );
                }

                ?></p>

                <?php if ( $counter == 'on' ) { ?>

                <div class="single-event-counter">
                <?php

                // Calculate remaining time

                $date_event = tribe_get_start_date( $event_id, true, 'Y-m-d h:i A' );
                $date_event = strtotime( $date_event );

                $remaining = $date_event - time();

                $days_remaining = floor($remaining / 86400);
                $hours_remaining = floor(($remaining % 86400) / 3600);
                $minutes_remaining = floor(($remaining % 3600) / 60);

                echo '<div class="event-counter-days"><span class="counter-value">' . $days_remaining . '</span><span class="counter-label">' . esc_html( 'Days', 'engage' ) . '</span></div>';
                echo '<div class="event-counter-hours"><span class="counter-value">' . $hours_remaining . '</span><span class="counter-label">' . esc_html( 'Hours', 'engage' ) . '</span></div>';
                echo '<div class="event-counter-minutes"><span class="counter-value">' . $minutes_remaining . '</span><span class="counter-label">' . esc_html( 'Minutes', 'engage' ) . '</span></div>';

                ?>
                </div>

                <?php } ?>
            </div>

        </div>

    </div>

    <?php

    $content = ob_get_contents();
    ob_end_clean();

    return $content;

}

add_shortcode( 'vntd_single_event', 'engage_single_event' );
