<?php

/*

Plugin Name: Contact Form 7
Plugin URI: http://themeforest.net/user/Veented/
Description: Display a Contact Form 7.
Version: 1.0
Author: Veented
Author URI: http://themeforest.net/user/Veented/

*/

if ( ! function_exists( 'engage_widget_contact_form_7' ) ) {

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'engage_widget_contact_form_7' );

	/* Function that registers our widget. */
	function engage_widget_contact_form_7()
	{
		register_widget( 'engage_Widget_contact_form_7' );
	}

	// Widget class.
	class engage_Widget_Contact_Form_7 extends WP_Widget
	{


		function __construct()
		{
			/* Widget settings. */
			$widget_ops = array(
				 'classname' => 'pr_widget_contact_form_7',
				'description' => 'Display a selected number of Contact Form 7 tweets.'
			);

			/* Create the widget. */

			parent::__construct( 'engage_widget_contact_form_7', 'Veented Contact Form 7', $widget_ops );
		}

		function widget( $args, $instance )
		{
			extract( $args );

			/* User-selected settings. */
			$title   = apply_filters( 'widget_title', $instance['title'] );
			$form_id = $instance['form_id'];

			/* Before widget (defined by themes). */
			echo '' . $before_widget;

			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo '' . $before_title . $title . $after_title;

			/* Display name from widget settings. */

			echo do_shortcode( '[contact-form-7 id="' . $form_id . '"]' );

			/* After widget (defined by themes). */
			echo '' . $after_widget;
		}

		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;

			/* Strip tags (if needed) and update the widget settings. */
			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['form_id'] = strip_tags( $new_instance['form_id'] );

			return $instance;
		}


		function form( $instance )
		{

			/* Set up some default widget settings. */
			$defaults = array(
				 'title' => esc_html__( 'Contact Form', 'engage' ),
				'form_id' => ''
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
	?>

	    	<p>
			<label for="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php
			echo esc_textarea( $instance['title'] ); ?>" style="width:100%;" />
			</p>

			<?php

			// Get a list of contact forms

			global $wpdb;

			$cf7 = $wpdb->get_results( "SELECT ID, post_title
			FROM $wpdb->posts
			WHERE post_type = 'wpcf7_contact_form'" );

			$contact_forms = array();

			if ( $cf7 ) {

				$contact_forms['Select Contact Form'] = 'none';

				foreach ( $cf7 as $cform ) {
					$contact_forms[$cform->post_title] = $cform->ID;
				}

			} else {

				$contact_forms["No contact forms found"] = 0;

			}

	?>

	        <p>

	        <label for="<?php
			echo esc_html( $this->get_field_id( 'form_id' ) );
	?>"><?php esc_html_e( 'Contact Form', 'engage' ); ?>:</label>

	        <select id="<?php echo esc_html( $this->get_field_id( 'form_id' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'form_id' ) );
	?>">

	        	<?php

			foreach ( $contact_forms as $contact_form => $contact_form_id ) {

				$selected = '';

				if ( $instance['form_id'] == $contact_form_id ) {
					$selected = ' selected="selected"';
				}

				echo '<option value="' . esc_attr( $contact_form_id ) . '"' . $selected . '>' . esc_html( $contact_form ) . '</option>';

			}

	?>

	        </select>

	        </p>

	        <?php
		}
	}
}
