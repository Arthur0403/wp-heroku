<?php

/*

Plugin Name: dribbble
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display images from dribbble.
Version: 1.0
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/

if ( ! function_exists( 'engage_widget_dribbble' ) ) {

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'engage_widget_dribbble' );

	/* Function that registers our widget. */
	function engage_widget_dribbble()
	{
		register_widget( 'engage_Widget_Dribbble' );
	}

	// Widget class.
	class engage_Widget_Dribbble extends WP_Widget
	{


		function __construct()
		{
			/* Widget settings. */
			$widget_ops = array(
				 'classname' => 'pr_widget_dribbble',
				'description' => 'Display a selected number of Dribbble images.'
			);

			/* Create the widget. */

			parent::__construct( 'engage_widget_dribbble', 'Veented Dribbble', $widget_ops );
		}

		function widget( $args, $instance )
		{
			extract( $args );

			/* User-selected settings. */
			$title        = apply_filters( 'widget_title', $instance['title'] );
			$access_token = $instance['access_token'];

			if ( $access_token == '' ) {
				$access_token = 'b5c2755a8a092bcadc9b2d276f908a2fa5b9b144f154e1a13ecb891f1b312264';
			}

			/* Before widget (defined by themes). */
			echo '' . $before_widget;

			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo '' . $before_title . $title . $after_title;

			/* Display name from widget settings. */

			wp_enqueue_script( 'jribbble', '', '', '', true );

			?>

	        <div class="widget-dribbble" data-access-token="<?php echo esc_html( $access_token ); ?>">
	        	<ul class="dribbble-list"></ul>
	        </div>

	        <?php

			/* After widget (defined by themes). */
			echo '' . $after_widget;
		}

		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;

			/* Strip tags (if needed) and update the widget settings. */
			$instance['title']        = strip_tags( $new_instance['title'] );
			$instance['access_token'] = strip_tags( $new_instance['access_token'] );

			return $instance;
		}


		function form( $instance )
		{

			/* Set up some default widget settings. */
			$defaults = array(
				 'title' => 'Dribbble',
				'access_token' => ''
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
	?>

	    	<p>
			<label for="<?php
			echo esc_html( $this->get_field_id( 'title' ) );
	?>"><?php esc_html_e( 'Title', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php
			echo esc_textarea( $instance['title'] );
	?>" style="width:100%;" />
			</p>

	        <p>
	        <label for="<?php echo esc_html( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Dribbble Access Token', 'engage' ); ?>: <a class="widget-tip" href="https://github.com/tylergaw/jribbble#user-content-setting-your-apps-client-access-token" target="_blank"><?php esc_html_e( 'How to get one?', 'engage' ); ?></a></label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'access_token' ) );
	?>" name="<?php
			echo esc_html( $this->get_field_name( 'access_token' ) );
	?>" type="text" value="<?php
			echo esc_attr( $instance['access_token'] );
	?>" style="width:100%;" />
	        </p>


	        <?php
		}
	}
}
