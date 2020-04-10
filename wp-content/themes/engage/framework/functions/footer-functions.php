<?php

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
// 		Theme Footer Functions
//
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


// Footer Widgets related functions

function engage_get_footer_cols() {
	
	if(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && is_active_sidebar('footer4')) {
		return 4;
	} elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3')) {
		return 3;
	} elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2')) {
		return 2;
	} else {
		return 1;
	}
	
	return 0;
}

function engage_get_footer_cols_class() {

	$widget_col_class = 'col-xs-3';
	
	if(engage_get_footer_cols() == 1) {
		$widget_col_class = 'col-xs-12';
	} elseif(engage_get_footer_cols() == 2) {
		$widget_col_class = 'col-xs-6';
	} elseif(engage_get_footer_cols() == 3) {
		$widget_col_class = 'col-xs-4';
	}
	
	return $widget_col_class;
}

// Copyright Text

if( !function_exists('engage_print_copyright') ) {

	function engage_print_copyright() {
		
	
	}
	
}