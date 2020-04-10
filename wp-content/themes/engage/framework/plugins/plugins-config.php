<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.6.1
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

get_template_part( 'framework/plugins/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'engage_tgmpa_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function engage_tgmpa_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Engage Core
		array(
		    'name'			=> 'Engage Core', // The plugin name
		    'slug'			=> 'engage-core', // The plugin slug (typically the folder name)
		    'source'		=> get_template_directory() . '/framework/plugins/lib/engage-core.zip', // The plugin source
		    'required'	=> true, // If false, the plugin is only 'recommended' instead of required
		    'version'		=> '3.2.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		    'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		    'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    'external_url'				=> '', // If set, overrides default API URL and points to an external URL
		),

		// WPBakery Page Builder (former Visual Composer)
    array(
        'name'			=> 'WPBakery Page Builder', // The plugin name
        'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
        'source'   	=> 'https://s3.us-east-2.amazonaws.com/plugins.veented.com/oct01_325901/js_composer.zip', // The plugin source
        'required'	=> true, // If false, the plugin is only 'recommended' instead of required
        'version'		=> '6.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
    ),

		// Templatera
    array(
        'name'			=> 'Templatera', // The plugin name
        'slug'			=> 'templatera', // The plugin slug (typically the folder name)
        'source'   	=> 'https://s3.us-east-2.amazonaws.com/plugins.veented.com/oct01_325901/templatera.zip', // The plugin source
        'required'	=> false, // If false, the plugin is only 'recommended' instead of required
        'version'		=> '2.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
    ),

		// Revolution Slider
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> 'https://s3.us-east-2.amazonaws.com/plugins.veented.com/oct01_325901/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '6.1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		),
		array(
			'name'     				=> 'Layer Slider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> 'https://s3.us-east-2.amazonaws.com/plugins.veented.com/oct01_325901/LayerSlider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '6.9.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		),
		array(
			'name'     				=> 'Essential Grid', // The plugin name
			'slug'     				=> 'essential-grid', // The plugin slug (typically the folder name)
			'source'   				=> 'https://s3.us-east-2.amazonaws.com/plugins.veented.com/oct01_325901/essential-grid.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.3.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		),

		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),

		// Contact Form 7
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),

		// Classic Editor
		array(
			'name' 			=> 'Classic Editor',
			'slug' 			=> 'classic-editor',
			'required' 	=> false,
		),

		// Events Calendar
		array(
			'name' 		=> 'The Events Calendar',
			'slug' 		=> 'the-events-calendar',
			'required' 	=> false,
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'engage';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug' 	=> 'themes.php', 				// Default parent menu slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '<div class="notice notice-info"><p>' . esc_html__( 'Note: If you cannot see an update for a particular bundled plugin, you can either find it in the newest theme package (perform a theme update or download the "All files" theme package from ThemeForest) or use our', 'engage' ) . ' <a href="https://plugins.veented.com/" target="_blank">Veented Plugins</a> ' . esc_html__( 'service.', 'engage' ) . '</p></div>', // Message to output right before the plugins table
		'dismissable' 		=> true,
	);

	tgmpa( $plugins, $config );

}

if ( function_exists( 'layerslider_set_as_theme' ) ) {
    layerslider_set_as_theme();
}
