<?php

/*

Plugin Name: Contact Details
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display images from Flickr.
Version: 1.0
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/

if ( ! function_exists( 'engage_widget_contact_details' ) ) {

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'engage_widget_contact_details' );

	/* Function that registers our widget. */
	function engage_widget_contact_details()
	{
		register_widget( 'engage_Widget_Contact_Details' );
	}

	// Widget class.
	class engage_Widget_Contact_Details extends WP_Widget
	{


		function __construct()
		{
			/* Widget settings. */
			$widget_ops = array(
				 'classname' => 'pr_widget_contact_details',
				'description' => esc_html__( 'Display your contact details.', 'engage' )
			);

			/* Create the widget. */

			parent::__construct( 'engage_widget_contact_details', 'Veented Contact Details', $widget_ops );
		}

		function widget( $args, $instance )
		{
			extract( $args );

			/* User-selected settings. */
			$title   = apply_filters( 'widget_title', $instance['title'] );
			$address = $instance['address'];
			$phone   = $instance['phone'];
			$email   = $instance['email'];
			$mobile  = $instance['mobile'];
			$website = $instance['website'];
			$showmap = $instance['showmap'];

			/* Before widget (defined by themes). */
			echo '' . $before_widget;

			/* Title of widget (before and after defined by themes). */
			if ( $title ) echo '' . $before_title . $title . $after_title;

			/* Display name from widget settings. */
			$extra_class = '';
			if ( $showmap ) $extra_class = 'contact-details-map';

			?>

	        <div class="widget-contact-details <?php echo esc_attr( $extra_class ); ?>">
	        	<?php

			if ( $address ) {
				echo '<div class="widget-contact-details-item"><i class="fa fa-map-marker"></i><span>' . wp_kses( $address, engage_kses() ) . '</span></div>';
			}

			if ( $phone ) {
				echo '<div class="widget-contact-details-item"><i class="fa fa-phone"></i><span><a href="tel:' . esc_html( $phone ) . '">' . esc_html( $phone ) . '</a></span></div>';
			}

			if ( $mobile ) {
				echo '<div class="widget-contact-details-item"><i class="fa fa-mobile"></i><span><a href="tel:' . esc_html( $mobile ) . '">' . esc_html( $mobile ) . '</a></span></div>';
			}

			if ( $email ) {
				echo '<div class="widget-contact-details-item"><i class="fa fa-envelope"></i><span><a href="mailto:' . esc_html( $email ) . '" class="accent-hover">' . $email . '</a></span></div>';
			}

			if ( $website ) {
				$website_url = $website;
				echo '<div class="widget-contact-details-item"><i class="fa fa-globe"></i><span><a href="' . esc_url( $website_url ) . '" class="accent-hover">' . esc_url( $website ) . '</a></span></div>';
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
			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['address'] = wp_kses( $new_instance['address'], engage_kses() );
			$instance['phone']   = strip_tags( $new_instance['phone'] );
			$instance['mobile']  = strip_tags( $new_instance['mobile'] );
			$instance['email']   = strip_tags( $new_instance['email'] );
			$instance['website'] = strip_tags( $new_instance['website'] );
			$instance['showmap'] = strip_tags( $new_instance['showmap'] );
			return $instance;
		}


		function form( $instance )
		{

			/* Set up some default widget settings. */
			$defaults = array(
				 'title' => esc_html__( 'Contact Details', 'engage' ),
				'address' => 'Manchester Road 123-78B, Silictown 7854MD, Great Country',
				'phone' => '+46 123 456 789',
				'mobile' => '',
				'email' => 'hello@sitename.com',
				'website' => 'www.sitename.com',
				'showmap' => true
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
	?>


	        <p>
	        <label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title', 'engage' ); ?>:</label>
	        <input id="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php
			echo esc_textarea( $instance['title'] ); ?>" style="width:100%;" />
	        </p>

	    	<p>
			<label for="<?php
			echo esc_html( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'address' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php
			echo wp_kses( $instance['address'], engage_kses() ); ?>" style="width:100%;" />
			</p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'phone' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php
			echo esc_textarea( $instance['phone'] ); ?>" style="width:100%;" />
	        </p>

	        <p>
	        <label for="<?php echo esc_html( $this->get_field_id( 'mobile' ) ); ?>"><?php esc_html_e( 'Mobile Phone', 'engage' ); ?>:</label>
	        <input id="<?php echo esc_html( $this->get_field_id( 'mobile' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'mobile' ) ); ?>" type="text" value="<?php
			echo esc_textarea( $instance['mobile'] ); ?>" style="width:100%;" />
	        </p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'E-mail', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'email' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo sanitize_email( $instance['email'] ); ?>" style="width:100%;" />
	        </p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'website' ) ); ?>"<?php esc_html_e( 'Website', 'engage' ); ?>:</label>
	        <input id="<?php
			echo esc_html( $this->get_field_id( 'website' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'website' ) ); ?>" type="text" value="<?php
			echo esc_url( $instance['website'] ); ?>" style="width:100%;" />
	        </p>

	        <p>
	        	<label for="<?php echo esc_html( $this->get_field_id( 'showmap' ) ); ?>"><?php esc_html_e( 'Background Map Image', 'engage' ); ?>?</label>
	        	<input type="checkbox" id="<?php
			echo esc_html( $this->get_field_id( 'showmap' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'showmap' ) ); ?>" <?php echo esc_html( $instance['showmap'] ) ? 'checked="checked" ' : '';
	?>>
	        </p>

	        <?php
		}
	}
}
