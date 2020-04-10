<?php

/*

Plugin Name: Flickr
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display images from Flickr.
Version: 1.0
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/

if ( ! function_exists( 'engage_widget_flickr' ) ) {

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'engage_widget_flickr' );

	/* Function that registers our widget. */
	function engage_widget_flickr()
	{
		register_widget( 'engage_Widget_Flickr' );
	}

	// Widget class.
	class engage_Widget_Flickr extends WP_Widget
	{


		function __construct()
		{
			/* Widget settings. */
			$widget_ops = array(
				 'classname' => 'pr_widget_flickr',
				'description' => 'Display a selected number of Flickr images.'
			);

			/* Create the widget. */

			parent::__construct( 'engage_widget_flickr', 'Veented Flickr', $widget_ops );
		}

		function widget( $args, $instance )
		{
			extract( $args );

			/* User-selected settings. */
			$title   = apply_filters( 'widget_title', $instance['title'] );
			$userid  = $instance['userid'];
			$display = $instance['display'];
			$number  = $instance['number'];

			/* Before widget (defined by themes). */
			echo '' . $before_widget;

			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo '' . $before_title . $title . $after_title;

			/* Display name from widget settings. */
	?>

	        <div class="flickr-badge">
	        	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_attr( $number ); ?>&amp;display=<?php echo esc_attr( $display ); ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo esc_attr( $userid ); ?>"></script>
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
			$instance['userid']  = strip_tags( $new_instance['userid'] );
			$instance['display'] = strip_tags( $new_instance['display'] );
			$instance['number']  = strip_tags( $new_instance['number'] );

			return $instance;
		}


		function form( $instance )
		{

			/* Set up some default widget settings. */
			$defaults = array(
				 'title' => 'Flickr',
				'userid' => '10133335@N08',
				'display' => 'latest',
				'number' => '9'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
	?>

	    	<p>
			<label for="<?php
			echo esc_html( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'engage' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_textarea( $instance['title'] ); ?>" style="width:100%;" />
			</p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'userid' ) ); ?>"><?php esc_html_e( 'Flickr User ID', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'userid' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'userid' ) ); ?>" type="text" value="<?php
			echo esc_attr( $instance['userid'] );
	?>" style="width:100%;" />
	        </p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'display' ) ); ?>"><?php esc_html_e( 'Display type', 'engage' ); ?>:</label>
	        <select id="<?php
			echo esc_html( $this->get_field_id( 'display' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'display' ) ); ?>">
	            <option <?php
			if ( $instance['display'] == "Latest" )
				echo 'selected="selected"';
	?>><?php esc_html_e( 'Latest', 'engage' ); ?></option>
	            <option <?php
			if ( $instance['display'] == "Random" )
				echo 'selected="selected"';
	?>><?php esc_html_e( 'Random', 'engage' ); ?></option>
			</select>
	        </p>

	        <p>
	        <label for="<?php
			echo esc_html( $this->get_field_id( 'number' ) );
	?>"><?php esc_html_e( 'Number of images', 'engage' ); ?>:</label>
			<input id="<?php
			echo esc_html( $this->get_field_id( 'number' ) ); ?>" name="<?php
			echo esc_html( $this->get_field_name( 'number' ) );
	?>" type="text" value="<?php
			echo esc_html( $instance['number'] );
	?>" size="3" />
	        </p>


	        <?php
		}
	}
}
