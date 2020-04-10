<?php

// Google Map Shortcode

function engage_gmap( $atts, $content = null ) {

  $markers = $marker_title = $marker_text = $marker_color = '';

	extract( shortcode_atts( array(
		"height" => '400',
		"zoom" => '14',
		"label" => '',
		"fullscreen" => 'no',
		"lat" => '40.7179907',
		"long" => '-74.0001119',
		"map_style" => 'regular',
		"markers" => '',
		"marker_title" => '',
		"market_text" => '',
		"marker_color" => 'red',
		"map_scroll" => 'false',
		"address" => '40.7179907,-74.0001119',
	), $atts ) );

  // WPBakery Page Builder Check
	if ( ! function_exists( 'vc_param_group_parse_atts' ) ) {
		return '<div class="engage-missing-parts-notice">' . esc_html__( 'Please install and activate the WPBakery Page Builder plugin via Appearance / Install Plugins menu.', 'engage' ) . '</div>';
	}

	$style_class = '';

	$rand_id = rand( 1, 9999 );

	wp_enqueue_script( 'google-map-sensor', '', '', '', true );
	wp_enqueue_script( 'google-map-label', '', '', '', true );

	ob_start();

	if ( engage_option( 'google_maps_api' ) ) {

    if ( $address == Engage_Theme::$default_address ) {
      $map_center = Engage_Theme::$default_address_ll;
    } elseif ( $address != '' ) {

  		$result = explode( ",", $address );  // Split the string by commas
  		$lat = trim( $result[0] );         // Clean whitespace
  		$lon = trim( $result[1] );

  		if ( (is_numeric( $lat ) ) && ( is_numeric( $lon ) ) ) {
  			// Proper coordinates
  		} else { // Regular text address

  			$engage_misc = get_option( 'engage_misc' );
  			$address_new = $address;
        $address_safe = esc_attr( str_replace( ' ', '', $address_new ) );

        if ( !is_array( $engage_misc ) )  {
          $engage_misc = array();
        }

  			if ( is_array( $engage_misc ) && array_key_exists( 'addresses', $engage_misc ) && array_key_exists( $address_safe, $engage_misc[ 'addresses' ] ) ) {
  				$address = $engage_misc[ 'addresses' ][ $address_safe ];
  			} else {

  				$url = "https://maps.google.com/maps/api/geocode/json?address={$address_new}&key=" . esc_attr( engage_option( 'google_maps_api' ) );
  				$request = wp_remote_get( $url );
  				$response = wp_remote_retrieve_body( $request );
  				$response = json_decode( $response, true );

  				if ( $response['status'] == 'OK' ) {

  					$lati = $response['results'][0]['geometry']['location']['lat'];
  					$longi = $response['results'][0]['geometry']['location']['lng'];
  					$address = $lati . ',' . $longi;

            if ( !array_key_exists( 'addresses', $engage_misc ) ) {
                $engage_misc[ 'addresses' ] = array();
            }

  					$engage_misc[ 'addresses' ][ $address_safe ] = $address;
  					update_option( 'engage_misc', $engage_misc );

  				} else {
            $error_message = esc_html__( 'Google Maps API returned an error during the Geocoding process:', 'engage' ). ' ';
            if ( isset( $response['error_message'] ) ) {
              $error_message .= '"' . esc_html( $response['error_message'] ) . '"';
            }
            $error_message .= '<br /><br />' . sprintf( esc_html__( 'Please try inserting the address in lat,lng format. You may learn more about Geocoding and map coordinates in <a href="%s" target="_blank">this article</a>.', 'engage' ), 'https://veented.ticksy.com/article/14770/' );
            return '<div class="alert alert-warning" style="font-size:14px;">' . $error_message . '</div>';
  				}

  			}

  		}

  		$map_center = $address;

  	} else {
  		if ( !$lat || !$long ) {
  			return esc_html__( 'Error: no location lat and/or long data found', 'engage' );
  		}

  		$map_center = $lat . ',' . $long;
  	} // End if address

	?>
	<script type="text/javascript">

	jQuery(document).ready(function() {

		'use strict';

		<?php

		$style_class = '';

		if ( $map_style == "grayscale" ) {
			$style_class = 'styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]';
		} elseif( $map_style == 'dark' ) {
			$style_class = 'styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
		} elseif( $map_style == 'light' ) {
			$style_class = 'styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]';
		} elseif( $map_style == 'dark_green' ) {
			$style_class = 'styles: [{"featureType":"all","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"},{"saturation":"-100"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40},{"visibility":"off"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#4d6059"}]},{"featureType":"landscape","elementType":"geometry.stroke","stylers":[{"color":"#4d6059"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#4d6059"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"lightness":21}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#4d6059"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"color":"#4d6059"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#7f8d89"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#7f8d89"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#7f8d89"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#7f8d89"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#2b3638"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2b3638"},{"lightness":17}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#24282b"}]},{"featureType":"water","elementType":"geometry.stroke","stylers":[{"color":"#24282b"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.icon","stylers":[{"visibility":"off"}]}]';
		} elseif( $map_style == 'light_dream' ) {
			$style_class = 'styles: [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]';
		}

		?>

		// Map Coordination

		var latlng = new google.maps.LatLng(<?php echo esc_attr( $map_center ); ?>);

		// Map Options

		var myOptions = {
			zoom: <?php echo esc_attr( $zoom ); ?>,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			disableDefaultUI: false,
			mapTypeControl: false,
			scrollwheel: <?php echo esc_attr( $map_scroll ); ?>,
			<?php if ( $style_class ) echo $style_class; ?>
		};

		var map = new google.maps.Map( document.getElementById('google-map-<?php echo $rand_id; ?>' ), myOptions);

		var markersArray = [];
		var markersContentArray = [];
		var infoWindows = [];

		<?php

		// Map Markers

		if ( $markers != '' ) {

                $values = (array)vc_param_group_parse_atts($markers);

                $i = 0;

                foreach ( $values as $data ) {

                    $new_line = $data;

                    $new_line['title'] = isset($data['title']) ? $data['title'] : '';
                    $new_line['text'] = isset($data['text']) ? $data['text'] : '';
                    $new_line['location'] = isset($data['location']) ? $data['location'] : '';
                    $new_line['location_custom'] = isset($data['location_custom']) ? $data['location_custom'] : '';
                    $new_line['color'] = isset($data['color']) ? $data['color'] : '';

                    $marker_location = $map_center;

                    if ($new_line['location'] == 'custom') {
                        $marker_location = $new_line['location_custom'];
                    }

                    ?>
                    var markerLocation = new google.maps.LatLng(<?php echo esc_attr($marker_location); ?>);
                    var contentString = '<div id="content">' +
                        '<div id="siteNotice">' +
                        '</div>' +
                        '<h4>' + '<?php echo esc_html($new_line['title']); ?>' + '</h4>' +
                        <?php if ( $new_line['text'] ) { ?>

                        '<p class="vntd-marker-text">' +

                        '<?php echo esc_html($new_line['text']); ?>' +

                        '</p>' + <?php } ?>

                        '</div>';

                    markersContentArray.push(contentString);

                    var markerIcon = ' ';

                    <?php
                    if ( $new_line['color'] == 'def' ) {
                    ?>
                    markerIcon = '';
                    <?php
                    }
                    ?>

                    var marker = new MarkerWithLabel({
                        position: markerLocation,
                        draggable: false,
                        raiseOnDrag: false,
                        icon: markerIcon,
                        map: map,
                        labelContent: '<div class="vntd-gmap-marker<?php if ($new_line['color'] == 'def') echo '-def'; ?> vntd-gmap-marker1 vntd-marker-color-<?php echo esc_attr($new_line['color']); ?>"></div>',
                        labelAnchor: new google.maps.Point(22, 50),
                        labelClass: "labels" // the CSS class for the label
                    });

                    markersArray.push(marker);

                    markersArray[<?php echo esc_attr($i); ?>].setMap(map);

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    infoWindows.push(infowindow);

                    google.maps.event.addListener(markersArray[<?php echo esc_attr($i); ?>], 'click', function (e) {
                        infoWindows[<?php echo esc_attr($i); ?>].open(map, this);
                    });

                    <?php

                    $i++;

                } // End markers loop

		} elseif ( $marker_title != '' ) {

            $i = 0;

            $marker_location = $map_center;

            ?>
            var markerLocation = new google.maps.LatLng(<?php echo esc_attr($marker_location); ?>);
            var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h4>' + '<?php echo esc_html( $marker_title ); ?>' + '</h4>' +
                <?php if ( $marker_text) { ?>

                '<p class="vntd-marker-text">' +

                '<?php echo esc_html( $marker_text ); ?>' +

                '</p>' + <?php } ?>

                '</div>';

            var markerIcon = ' ';

            <?php

            $marker_color = $marker_color;

            if ( $marker_color == 'def' ) {
            ?>
            markerIcon = '';
            <?php
            }
            ?>

            var marker = new MarkerWithLabel({
                position: markerLocation,
                draggable: false,
                raiseOnDrag: false,
                icon: markerIcon,
                map: map,
                labelContent: '<div class="vntd-gmap-marker<?php if ( $marker_color == 'def' ) echo '-def'; ?> vntd-gmap-marker1 vntd-marker-color-<?php echo esc_attr( $marker_color ); ?>"></div>',
                labelAnchor: new google.maps.Point(22, 50),
                labelClass: "labels" // the CSS class for the label
            });

            markersArray.push(marker);

            markersArray[<?php echo esc_attr( $i ); ?>].setMap(map);

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            infoWindows.push(infowindow);

            google.maps.event.addListener(markersArray[<?php echo esc_attr($i); ?>], 'click', function (e) {
                infoWindows[<?php echo esc_attr($i); ?>].open(map, this);
            });

            <?php

        }

		?>

	});

	</script>

	<div class="vntd-gmap map-skin-<?php echo esc_attr( $map_style ); ?>">
	<?php

	$height = str_replace( 'px', '', $height );

	if ( is_null( $height ) ) $height = 400;

	?>
	    <div id="google-map-<?php echo $rand_id; ?>" style="height:<?php echo esc_attr( $height ); ?>px;"></div>

	</div>
	<?php

	} else {
		echo '<div class="no-gmap-api">' . esc_html__( "Please configure your Google Maps API Key to use the Google Maps element. Please proceed here:", "engage" ) . ' <a href="' . admin_url( 'admin.php?page=Engage&tab=21' ) . '" target="_blank">Theme Options / Google Maps</a></div>';
	}

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode( 'vntd_gmap' );
add_shortcode( 'vntd_gmap', 'engage_gmap' );
