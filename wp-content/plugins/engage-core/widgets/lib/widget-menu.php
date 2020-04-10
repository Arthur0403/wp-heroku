<?php

/*

Plugin Name: Veented Menu
Plugin URI: http://themeforest.net/user/Veented/
Description: The most recent posts from your blog with a thumbnail.
Version: 1.0
Author: Veented
Author URI: http://themeforest.net/user/Veented/

*/

if ( ! function_exists( 'engage_widget_menu' ) ) {

	/* Add our function to the widgets_init hook. */

	add_action( 'widgets_init', 'engage_widget_menu' );

	/* Function that registers our widget. */

	function engage_widget_menu() {
		register_widget( 'Engage_Widget_Menu' );
	}

	// Widget class.

	class Engage_Widget_Menu extends WP_Widget {

		function __construct() {
			/* Widget settings. */
			$widget_ops = array(
				 'classname' => 'engage_widget_menu',
				'description' => 'Fancy menu widget.'
			);

			/* Create the widget. */

			parent::__construct( 'engage_widget_menu', 'Veented Fancy Menu', $widget_ops );
		}

		function widget( $args, $instance ) {
			extract( $args );

			/* User-selected settings. */

			$title  = apply_filters( 'widget_title', $instance['title'] );
			$menu   = $instance[ 'menu' ];

			/* Before widget (defined by themes). */

			echo '' . $before_widget;

			/* Title of widget (before and after defined by themes). */

			if ( $title ) echo '' . $before_title . $title . $after_title;

			/* Display name from widget settings. */

			echo '<div class="sidebar-nav vntd-fancy-menu">';

			wp_nav_menu( array(
				'menu' 			=> $menu,
				'container' 	=> false,
				'menu_class' 	=> 'fancy-menu',
			));

			echo '</div>';

			/* After widget (defined by themes). */

			echo '' . $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			/* Strip tags (if needed) and update the widget settings. */
			$instance['title']  = strip_tags( $new_instance['title'] );
			$instance['menu']   = $new_instance['menu'];

			return $instance;
		}


		function form( $instance ) {

			/* Set up some default widget settings. */
			$defaults = array(
				'title' => '',
				'menu' => '',
			);

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

	    	<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"></label>
			<input id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $instance['title'] ); ?>" style="width:100%;" />
			</p>

			<p>

			<label for="<?php echo esc_html( $this->get_field_id( 'menu' ) ); ?>"><?php esc_html_e( 'Select Menu', 'engage' ); ?>:</label>

	        <select id="<?php echo esc_html( $this->get_field_id( 'menu' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'menu' ) ); ?>">
	        	<?php

	        	echo '<option>-- ' . esc_html__( 'Select', 'engage' ) . ' --</option>';

	        	$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

	        	foreach ( $menus as $menu ) {
	        		if ( !is_object( $menu ) ) continue;
	        		$selected = '';
	        		if ( $instance['menu'] == $menu->term_id ) $selected = 'selected="selected"';
	        		echo '<option ' . $selected . ' value="' . $menu->term_id . '">' . $menu->name . '</option>';
	        	}

	        	?>
	        </select>

	        <?php
		}
	}
}
