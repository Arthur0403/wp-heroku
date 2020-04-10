<?php

//
// Theme Options
//

add_action( 'plugins_loaded', 'engage_load_redux' );

function engage_load_redux() {

  $disable_redux = apply_filters( 'engage_disable_redux_framework', false );

  // Load Theme Options Framework
  if ( ! $disable_redux && ! class_exists( 'ReduxFramework' ) && file_exists( ENGAGE_CORE_PATH . '/theme-panel/ReduxCore/framework.php' ) ) {

     require_once( ENGAGE_CORE_PATH . '/theme-panel/ReduxCore/framework.php' );

     // Redux URL filter
     if ( ! apply_filters( 'engage_disable_redux_misc', false ) && ! function_exists( 'engage_redux_url' ) ) {
       function engage_redux_url() {
           $url = ENGAGE_CORE_URI . "/theme-panel/ReduxCore/";
           return $url;
       }
       add_filter( 'redux/_url', 'engage_redux_url', 10, 3 );
     }

  }


  //
  // Redux Extensions Loader
  //

  $disable_redux_extensions = apply_filters( 'engage_disable_redux_extensions', false );

  if ( ! $disable_redux_extensions && class_exists( 'ReduxFramework' ) && ! function_exists( 'engage_redux_register_theme_extension_loader' ) ) :
      function engage_redux_register_theme_extension_loader( $ReduxFramework ) {
  	    $path    = ENGAGE_CORE_PATH . '/theme-panel/extensions/';
  	    $folders = scandir( $path, 1 );
  	    foreach ( $folders as $folder ) {
  	        if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
  	            continue;
  	        }
  	        $extension_class = 'ReduxFramework_Extension_' . $folder;
  	        if ( ! class_exists( $extension_class ) ) {
  	            // In case you wanted override your override, hah.
  	            $class_file = $path . $folder . '/extension_' . $folder . '.php';
  	            $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
  	            if ( $class_file ) {
  	                require_once( $class_file );
  	            }
  	        }
  	        if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
  	            $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
  	        }
  	    }
      }
      add_action( "redux/extensions/engage_options/before", 'engage_redux_register_theme_extension_loader', 0 );
  endif;

}
