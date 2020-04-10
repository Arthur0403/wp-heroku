<?php

/**
 * Theme Dynamic Stylesheet
 *
 * @since 1.0
 *
 */

header("Content-type: text/css;");

$engage_options_accent_color = '#218fe6';
$engage_options_accent_color2 = '#f35050';
$engage_options_accent_color3 = '#222222';

if ( engage_option('accent_color') ) {
   	$engage_options_accent_color = esc_attr(engage_option('accent_color'));
}
if ( engage_option('accent_color2') ) {
	$engage_options_accent_color2 = esc_attr(engage_option('accent_color2'));
}
if ( engage_option('accent_color3') ) {
	$engage_options_accent_color3 = esc_attr(engage_option('accent_color3'));
}

if ( !function_exists('engage_print_css_rule') ) {
	function engage_print_css_rule( $css_selector, $attribute, $value, $important = false ) {

		$important_dec = '';

		if ( $important == true ) {
			$important_dec = '!important;';
		}

		if ( is_array( $css_selector ) ) {
			echo implode( ',', $css_selector);
		} else {
			echo esc_attr( $css_selector );
		}

		echo '{';
		if ( is_array( $attribute ) ) {
			foreach ( $attribute as $attr ) {
				echo esc_attr( $attr ) . ':' . esc_attr( $value ) . $important_dec . ';';
			}
		} else {
			echo esc_attr( $attribute ) . ':' . esc_attr( $value ) . $important_dec . ';';
		}
		echo '}';
	}
}

if ( !function_exists('engage_hex2rgba') ) {
	function engage_hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if (empty($color))
	          return $default;

		//Sanitize $color if "#" is provided
	        if ($color[0] == '#' ) {
	        	$color = substr( $color, 1 );
	        }

	        //Check if color has 6 or 3 characters and get values
	        if (strlen($color) == 6) {
	                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	        } elseif ( strlen( $color ) == 3 ) {
	                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	        } else {
	                return $default;
	        }

	        //Convert hexadec to rgb
	        $rgb =  array_map('hexdec', $hex);

	        //Check if opacity is set(rgba or rgb)
	        if ($opacity || $opacity == 0){
	        	if (abs($opacity) > 1)
	        		$opacity = 1.0;
	        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	        } else {
	        	$output = 'rgb('.implode(",",$rgb).')';
	        }

	        //Return rgb(a) color string
	        return $output;
	}
}

?>

<?php
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		General
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
?>

.editor-post-title__block .editor-post-title__input { background: red; }

/* Accent Text Colors */

#footer .widget-text a, #footer .widget-twitter a, #icons-wrapper ul li:hover i, #main-navigation #main-menu>ul .is-open,#main-navigation .main-menu>ul .is-open, #main-navigation #main-menu>ul>li.current i, #main-navigation #main-menu>ul>li.current>a, #main-navigation .main-menu>ul>li.current>a,#search.nav-search.search-open input, #search.nav-search.search-open input:focus, .blog-square .post .post-comments a:hover, .blog-timeline .posts .post:hover .post-date, .breadcrumb a:hover, .c-primary, .cart-wrapper .cart-subtotal td:first-child, .cart-wrapper .cart-total td:first-child, .categories-list li a.current, .categories-list li a:hover, .creative-element .title .subtitle, .datepicker thead tr th.next, .datepicker thead tr th.prev, .erinyen .tp-tab-title, .feature-box .feature-content p.subtitle, .form-group.form-grouped.required:after, .grouped-item .grouped-item-price, .header-dark #main-navigation #main-menu>ul>li.current>a, .header-dark #main-navigation #main-menu>ul>li>a.is-open, .header-dark .categories-list li a:hover, .header-dark .items-filter li a.current, .header-dark .items-filter li a:hover, .header-icon, .header-transparent.topnav-top #main-navigation #main-menu>ul>li.current>a, .hover-effect-2 a:hover span, .item .item-meta a:hover, .items-filter li a.current, .items-filter li a:hover, .pagination li:not(.disabled) a:hover, .post .post-info .post-meta a.comments:hover, .post .post-info .post-meta a:hover, .post-single .post-nav a:hover .next-icon, .post-single .post-nav a:hover .prev-icon, .posts .post .more, .product .product-info .add-to-cart, .product .product-info .product-new-price, .product .product-info .view-cart, .product-quick-desc, .rating .fa-star, .rating .fa-star-half-o, .required:after, .search-overlay form, .search.nav-search.search-open input, .search.nav-search.search-open input:focus, .shop-breadcrumb ul li a:hover, .shortcode-question span, .subtitle, .testimonial .testimonial-meta .testimonial-subtitle a, .text-primary, .title .subtitle, .title h1 span, .title h2 span, .title h3 span, .title h4 span, .title h5 span, .tp-caption.Newspaper-subtitle, .widget-links li a:hover, .widget-twitter .tweets-list li a, figure.he-2 a:hover, header .blog-meta li a:hover, header#main-navigation .current>a span::before, header.header-dark .blog-meta li a:hover, .theme-blue.clean-design .title .subtitle, .theme-blue.header-dark #main-aside-navigation #main-aside-menu>ul>li>a.is-open, .theme-blue.header-dark #main-navigation #main-menu>ul>li.current>a, .theme-blue.header-dark #main-navigation #main-menu>ul>li>a.is-open, .theme-blue.header-scroll-dark #main-navigation #main-menu>ul>li.current>a, .theme-blue.header-scroll-dark #main-navigation .main-menu>ul>li.current>a, .theme-blue.header-transparent.topnav-top #main-navigation #main-menu>ul>li.current>a, html.split-bordered #main-navigation #main-menu>ul>li.active>a, .counter-color-accent .counter-icon, .counter-color-accent .counter-number,
.jm-post-like.liked, .colored,
.post-navigation a:hover .prev-icon,
.post-navigation a:hover .next-icon,
p a,
li > a,
.post-holder .post-more:hover,
a:hover,
.widget ul > li > a:hover,
#page-title .blog-meta li a:hover,
.btn.btn-outline,
#wrapper .color-accent,
#aside-nav nav ul > li > a.is-open,
#aside-nav nav ul > li > a:hover,
.aside-nav nav ul li.current-page-parent > a,
.aside-nav nav ul li.current-page-ancestor > a,
.aside-nav nav ul li.current-menu-ancestor > a,
.aside-nav nav ul li.current_page_ancestor > a,
.aside-nav nav ul li.current_page_item > a,
.aside-nav nav ul li.current-page-item > a,
.aside-nav nav ul li.current_page_parent > a,
#woo-nav-cart .cart_list li a:hover,
.breadcrumbs a:hover,
.page-title-with-bg .breadcrumbs a:hover,
#wrapper .sidebar-widget.woocommerce li a:hover,
#wrapper .star-rating span,
.icon-list-color-accent li i,
.section-page .btn-text.btn-accent,
.vntd-icon-box .post-more:hover,
.color-scheme-accent p,
.widget.engage_widget_menu ul > li.current-menu-item > a,
.hover-effect-fadeout .vntd-gallery-item .gallery-item-overlay i,
.dropcap-accent,
.tribe-events-schedule h2,
.widget ul > li.current_page_item > a,
.main-nav .nav-button.nav-button-outline span,
table a,
.vc_icon_element-color-accent {
	color: <?php echo esc_attr( $engage_options_accent_color ); ?>;
}

.color-scheme-accent h1,
.color-scheme-accent h2,
.color-scheme-accent h3,
.color-scheme-accent h4,
.color-scheme-accent h5,
.color-scheme-accent h6 {
	color: <?php echo esc_attr( $engage_options_accent_color ); ?> !important;
}


/* Accent Background Color */

.theme-blue #footer.bg-primary, .theme-blue #royal_preloader.royal_preloader_progress .royal_preloader_meter, .theme-blue .alert-primary, .theme-blue .bg-primary, .theme-blue .btn-primary.btn-bordered:hover, .theme-blue .btn-primary:hover, .theme-blue .btn-primary:not(.btn-bordered), .theme-blue .btn-primary:not(.btn-bordered).active, .theme-blue .btn-primary:not(.btn-bordered).focus, .theme-blue .btn-primary:not(.btn-bordered):active, .theme-blue .btn-primary:not(.btn-bordered):focus, .theme-blue .datepicker table tr td span.active.active, .theme-blue .datepicker table tr td span.active.disabled.active, .theme-blue .datepicker table tr td span.active.disabled:active, .theme-blue .datepicker table tr td span.active.disabled:focus, .theme-blue .datepicker table tr td span.active.disabled:hover, .theme-blue .datepicker table tr td span.active.disabled:hover.active, .theme-blue .datepicker table tr td span.active.disabled:hover:active, .theme-blue .datepicker table tr td span.active.disabled:hover:focus, .theme-blue .datepicker table tr td span.active.disabled:hover:hover, .theme-blue .datepicker table tr td span.active:active, .theme-blue .datepicker table tr td span.active:focus, .theme-blue .datepicker table tr td span.active:hover, .theme-blue .datepicker table tr td span.active:hover.active, .theme-blue .datepicker table tr td span.active:hover:active, .theme-blue .datepicker table tr td span.active:hover:focus, .theme-blue .datepicker table tr td span.active:hover:hover, .theme-blue .datepicker table tr td.active.active, .theme-blue .datepicker table tr td.active.disabled.active, .theme-blue .datepicker table tr td.active.disabled:active, .theme-blue .datepicker table tr td.active.disabled:focus, .theme-blue .datepicker table tr td.active.disabled:hover, .theme-blue .datepicker table tr td.active.disabled:hover.active, .theme-blue .datepicker table tr td.active.disabled:hover:active, .theme-blue .datepicker table tr td.active.disabled:hover:focus, .theme-blue .datepicker table tr td.active.disabled:hover:hover, .theme-blue .datepicker table tr td.active:active, .theme-blue .datepicker table tr td.active:focus, .theme-blue .datepicker table tr td.active:hover, .theme-blue .datepicker table tr td.active:hover.active, .theme-blue .datepicker table tr td.active:hover:active, .theme-blue .datepicker table tr td.active:hover:focus, .theme-blue .datepicker table tr td.active:hover:hover, .theme-blue .label-primary, .theme-blue .open .dropdown-toggle.datepicker table tr td span.active, .theme-blue .open .dropdown-toggle.datepicker table tr td span.active.disabled, .theme-blue .open .dropdown-toggle.datepicker table tr td span.active.disabled:hover, .theme-blue .open .dropdown-toggle.datepicker table tr td span.active:hover, .theme-blue .open .dropdown-toggle.datepicker table tr td.active, .theme-blue .open .dropdown-toggle.datepicker table tr td.active.disabled, .theme-blue .open .dropdown-toggle.datepicker table tr td.active.disabled:hover, .theme-blue .open .dropdown-toggle.datepicker table tr td.active:hover, .theme-blue .open>.dropdown-toggle.btn-primary, .theme-blue .price-plan.plan-primary .plan-header, .theme-blue .price-plan.plan-primary .plan-info, .theme-blue .select-filter ul li.selected a:before, .theme-blue .select-filter ul li:hover a:before, .theme-blue .select2-container--default .select2-selection--multiple .select2-selection__choice, .theme-blue .sort-options .select-filters .select-filter ul li a:hover, .theme-blue .switcher .switch, .theme-blue .tags a:hover, .theme-blue .ui-slider .ui-slider-handle, .theme-blue .ui-slider .ui-slider-range, .theme-blue .widget .tags a:hover, .theme-blue input[type=radio]+label::after, .theme-blue input[type=checkbox]+label::after, .wpcf7-submit, #respond #submit, .accent-bg-color, .bg-color-accent,
#wrapper .vc_tta-accordion.vc_tta-style-engage_boxed_accent .vc_active .vc_tta-panel-heading, .owl-nav > div:hover,.tagcloud a:hover,#wp-calendar #today,#wrapper .post.format-audio .audio-video-wrapper > .video-js-audio,
.blog-style-classic .post.sticky .post-info:after,
#page-content .vntd-pagination li span.current,
input[type="submit"],
#wrapper .post-tags a:hover,
.vc_progress_bar.vc_progress-bar-color-accent .vc_single_bar .vc_bar, .pricing-box-featured .pricing-box-title,
.woocommerce a.button,
#woo-nav-cart p.buttons .button.checkout,
.nav-cart .woo-cart-count,
ul.products .product-overlay:hover,
#page-content .woocommerce-pagination li span.current,
#page-content .woocommerce-pagination li a:hover,
#wrapper .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce #wrapper .button, #wrapper .product .button,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
.main-nav li.nav-button span,
.header-dark .main-nav li.nav-button a:hover span,
#page-content .vntd-pagination li a:hover,
.bg-color-accent,
.bg-color-accent.vc_row:not(.vc_inner):not(.vc_gitem_row),
.pricing-box-minimal.pricing-box-featured .pricing-box-price,
a.comment-reply-link:hover,
#wrapper .widget_price_filter .ui-slider .ui-slider-handle,
body #wrapper .button,
#wrapper .product .button,
.widget.engage_widget_menu ul > li > a:hover:before,
.widget.engage_widget_menu ul > li.current-menu-item > a:before,
.dropcap-accent.dropcap-circle,
#tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a,.vc_icon_element-background-color-accent,
.main-nav .nav-button.nav-button-outline a:hover span,
body #woo-nav-cart p.buttons .button.checkout,
body.woocommerce #wrapper .button:hover,
body #wrapper .product .button:hover {
	background-color: <?php echo esc_attr( $engage_options_accent_color ); ?>;
}

/* Accent Button Colors */

.btn-accent, .btn-accent.active, .btn-accent.focus, .open>.dropdown-toggle.btn-accent, .btn-accent {
 	background-color: <?php echo esc_attr( $engage_options_accent_color ); ?>;
}

.btn.btn-hover-accent:hover,
#wrapper .vc_tta-tabs-position-top.vc_tta-style-engage_boxed .vc_tta-tab.vc_active a,
.icon-list-color-accent.icon-list-circle i {
	background-color: <?php echo esc_attr( $engage_options_accent_color ); ?> !important;
}

.owl-nav > div:hover, .tagcloud a:hover,
.blog-style-classic .post.sticky .post-info,
.btn.btn-outline,
#wrapper .vc_tta-tabs-position-top.vc_tta-style-engage_minimal .vc_tta-tab.vc_active a,
.pricing-box.pricing-box-featured,
body .section-page input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus,
.section-page select:focus,
.section-page textarea:focus,
.site-header.active-style-border-bottom .main-menu > ul > li.current-page-ancestor > a,
.site-header.active-style-border-bottom .main-menu > ul > li.current-page-parent > a,
.site-header.active-style-border-bottom .main-menu > ul > li.current-menu-ancestor > a,
.site-header.active-style-border-bottom .main-menu > ul > li.current_page_ancestor > a,
.site-header.active-style-border-bottom .main-menu > ul > li.current_page_item > a,
.site-header.active-style-border-top .main-menu > ul > li.current-page-ancestor > a,
.site-header.active-style-border-top .main-menu > ul > li.current-page-parent > a,
.site-header.active-style-border-top .main-menu > ul > li.current-menu-ancestor > a,
.site-header.active-style-border-top .main-menu > ul > li.current_page_ancestor > a,
.site-header.active-style-border-top .main-menu > ul > li.current_page_item > a,
.main-nav .nav-button.nav-button-outline span {
	border-color: <?php echo esc_attr( $engage_options_accent_color ); ?>;
}

.btn.btn-hover-accent:hover {
	border-color: <?php echo esc_attr( $engage_options_accent_color ); ?>!important;
}

.bg-overlay-accent:before,
.bg-overlay-accent-light:before {
	background-color: <?php echo esc_attr( $engage_options_accent_color ); ?>;
	opacity: .9;
}

/* Comments */

<?php

if ( engage_option('comments_bg_color') ) {
	engage_print_css_rule( '.post-comments', 'background-color', engage_option('comments_bg_color') );
}

// Header

$header_color = '#fff';

if ( engage_header_skin() == 'dark' ) {
	$header_color = '#202020';
}

if ( engage_option( 'header_height' ) ) {
	$header_height = str_replace( 'px', '', engage_option('header_height') );
	engage_print_css_rule( array( '#main-navigation', '#main-navigation .main-menu > ul > li > a', '#main-navigation .nav-tools li a', '#main-navigation.bottom-nav .main-nav-wrapper' ) , 'height' , $header_height . 'px', false );

    $new_padding_top = $header_height - 25;

    echo '.content-below-header > .section-page { padding-top:' . $new_padding_top . 'px;}';
    echo '.no-page-title .content-below-header:not(.page-with-vc) .main-row,.no-page-title .content-below-header.page-with-vc #page-content > .vc_row:first-child, .no-page-title .main-content:not(.page-with-vc) .section-page > .container { padding-top: 70px; }';
	echo '@media (max-width: 1000px) { #main-navigation,#main-navigation .main-menu > ul > li > a,#main-navigation .nav-tools li a,.nav-tools li a:not(.btn),#main-navigation.bottom-nav .main-nav-wrapper { height: ' . $header_height . 'px !important; } }';

	$extra_height = 0;

	if ( engage_option('topbar') == true ) {

		$extra_height = 45;

		$header_height = $header_height + $extra_height;
	}

	engage_print_css_rule( '#page-title .page-title-wrapper', 'padding-top', $header_height . 'px' );

}

// Header After Scroll

$header_scroll_color = '#fff';
$header_scroll_opacity = '1.0';

if ( engage_option('header_scroll_color') != '' ) {
	$header_scroll_color = engage_option('header_scroll_color');
} elseif ( engage_header_scroll_skin() == 'dark' ) {
	$header_scroll_color = '#202020';
}

if ( engage_option('header_scroll_opacity') != '1.0' ) {
	if ( $header_scroll_color == '' ) $header_scroll_color = $header_scroll;
	$header_scroll_color = engage_hex2rgba( $header_scroll_color, engage_option('header_scroll_opacity') );
}

if ( $header_scroll_color != '#fff' && $header_scroll_color != '#202020' ) {
	engage_print_css_rule( '.header-scroll-full #header .main-nav,#sticky-nav' , 'background-color', $header_scroll_color, true );
}

if ( engage_option( 'header_scroll_height' ) ) {
	engage_print_css_rule( array( '.header-scroll-full #main-navigation', '.header-sticky-now #main-navigation #main-menu > ul > li > a', '.header-sticky-now #main-navigation .main-menu > ul > li > a', '.header-scroll-full #main-navigation .nav-tools li a' ) , 'height' , str_replace( 'px', '', engage_option('header_scroll_height') ) . 'px', true );
}

function engage_print_typography( $name, $typography_array ) {

	$rules = $fix = '';

	if ( !engage_option( $name ) ) return false;

	foreach ( $typography_array as $attr => $default ) {
		if ( $attr != 'selectors' && ( $value = engage_option( $name, $attr ) ) != $default && engage_option( $name, $attr ) != '' )  {
			if ( $attr == 'font-family' ) {
				$rules .= $attr . ':' . $value . ';';
			} else {
				$rules .= $attr . ':' . esc_html( $value ) . ';';
			}

		}
	}

	if ( $rules != '' ) {
		echo esc_attr( $fix ) . $typography_array[ 'selectors' ] . '{' . $rules . '}';
	}

	return false;

}

// Typography Headings

$heading_extras = $body_extras = '';

// Extra selectors

if ( engage_option( 'typography_navigation_font' ) != 'body' ) {
	$heading_extras = ',#main-menu > ul > li a,.main-menu > ul > li > a';
} else {
	$body_extras = ',#main-menu > ul > li a,.main-menu > ul > li > a';
}

// Array of defaults:

$typography_array = array(
	'selectors' => 'h1,h2,h3,h4,h5,h6,.vc_tta-tab,.counter-number,.post-navigation a span.post-nav-title,.special-heading .special-heading-title,h2.cta-heading,#page-title h1' . $heading_extras,
	'font-family' => 'Open Sans',
	'font-weight' => '400',
	'text-transform' => 'none'
);

engage_print_typography( 'typography_primary', $typography_array );

// Typography Body

$typography_array = array(
	'selectors' => 'html,body,.page-content,.single .post-holder,.grid-filters > li.cbp-filter-item,.btn' . $body_extras,
	'font-family' => 'Open Sans',
	'font-weight' => '400',
	'text-transform' => 'none',
	'font-size' => '16px'
);

engage_print_typography( 'typography_body', $typography_array );

$typography_array = array(
	'selectors' => 'html,body,.grid-filters > li.cbp-filter-item' . $body_extras,
	'color' => '#686868'
);

engage_print_typography( 'typography_body', $typography_array );

// Typography Navigation

$typography_array = array(
	'selectors' => '#main-navigation #main-menu > ul > li > a,#main-navigation .main-menu > ul > li > a',
	'font-weight' => '400',
	'text-transform' => 'none',
	'font-size' => '15px',
	'letter-spacing' => '0'
);

engage_print_typography( 'typography_navigation', $typography_array );

// Side Header Toggle Button

if ( engage_option( 'sideh_btn_color' ) ) {
	engage_print_css_rule(
		'#nav-toggle .toggle-menu span:not(.menu-label), #nav-toggle .toggle-menu span:not(.menu-label)::before, #nav-toggle .toggle-menu span:not(.menu-label)::after',
		'background',
		engage_option( 'sideh_btn_color' )
	);
}

if ( engage_option( 'sideh_btn_bg' ) ) {
	engage_print_css_rule(
		'#nav-toggle',
		'background',
		engage_option( 'sideh_btn_bg', 'rgba' )
	);
}

// Page Loader

if ( engage_option( 'loader_size' ) ) {
	engage_print_css_rule( '.loader-wrapper .loader-circle, .loader-circle::before', array( 'width', 'height' ), engage_option( 'loader_size' ) . 'px' );
}

if ( engage_option( 'loader_thickness' ) ) {
	engage_print_css_rule( '.loader-circle::before', 'border-width', engage_option( 'loader_thickness' ) . 'px' );
}

if ( engage_option( 'typo_font_smooth' ) == 'off' ) {
	engage_print_css_rule( 'body,h1, h2, h3, h4, h5, h6,.engage-icon-icon', '-webkit-font-smoothing', 'initial' );
}

if ( engage_option( 'light_scheme_t_c' ) != '' ) {
	engage_print_css_rule( '.vc_row.color-scheme-white,.vc_row.color-scheme-white p', 'color', engage_option( 'light_scheme_t_c' ) );
}
if ( engage_option( 'light_scheme_h_c' ) != '' ) {
	engage_print_css_rule( '.vc_row.color-scheme-white h1,.vc_row.color-scheme-white h2,.vc_row.color-scheme-white h3, .vc_row.color-scheme-white h4, .vc_row.color-scheme-white h5, .vc_row.color-scheme-white h6', 'color', engage_option( 'light_scheme_h_c' ) );
}
// Main background color
if ( engage_option( 'bg_color' ) != '' ) {
	engage_print_css_rule( 'body,.vc_row:not(.vc_inner):not(.vc_gitem_row)', 'background-color', engage_option( 'bg_color' ) );
}

if ( engage_option( 'custom_css' ) != '' ) {
	echo strip_tags( engage_option( 'custom_css' ) );
}

// Predefined Gradient

if ( engage_option( 'custom_gradient' ) ) {

	$gradient = engage_option( 'custom_gradient' );

	if ( ( array_key_exists( 'from', $gradient ) && $gradient['from'] != '' ) && ( array_key_exists( 'to', $gradient ) && $gradient['to'] != '' ) ) {
	 	$css_gradient = 'linear-gradient(-32deg,' . esc_attr( $gradient['from'] ) . ',' . esc_attr( $gradient['to'] ) . ')';
	 	echo '#wrapper .color-gradient-1 { background:' . $css_gradient . ';-webkit-background-clip: text;-webkit-text-fill-color: transparent;}';
		echo '#wrapper .bg-gradient-1 { background: ' . $css_gradient . ';}';
	}
}

if ( engage_option( 'custom_gradient2' ) ) {

	$gradient = engage_option( 'custom_gradient2' );

	if ( array_key_exists( 'from', $gradient ) && array_key_exists( 'to', $gradient ) ) {
	 	$css_gradient = 'linear-gradient(-32deg,' . esc_attr( $gradient['from'] ) . ',' . esc_attr( $gradient['to'] ) . ')';
	 	echo '#wrapper .color-gradient-2 { color:' . $css_gradient . ';-webkit-background-clip: text;-webkit-text-fill-color: transparent;}';
		echo '#wrapper .bg-gradient-2 { background: ' . $css_gradient . ';}';
	}
}

?>
