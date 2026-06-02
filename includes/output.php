<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Register menu location
add_action( 'after_setup_theme', 'simply_utility_bar_register_menu' );
function simply_utility_bar_register_menu() {
	register_nav_menus( array(
		'simply-utility-bar' => __( 'Utility Bar', 'simply-utility-bar' ),
	) );
}

// Output the bar — hooks both wp_body_open (standard) and genesis_before (Genesis).
// Static flag prevents double output if both fire.
add_action( 'wp_body_open', 'simply_utility_bar_output', 5 );
add_action( 'genesis_before', 'simply_utility_bar_output', 5 );

function simply_utility_bar_output() {
	static $done = false;
	if ( $done ) return;
	$done = true;

	if ( ! get_option( 'simply_utility_bar_enabled', 1 ) ) return;
	if ( ! has_nav_menu( 'simply-utility-bar' ) ) return;

	echo '<div class="simply-utility-bar" role="navigation" aria-label="' . esc_attr__( 'Utility bar', 'simply-utility-bar' ) . '">';
	echo '<div class="simply-utility-bar__inner">';

	wp_nav_menu( array(
		'theme_location' => 'simply-utility-bar',
		'container'      => false,
		'menu_class'     => 'simply-utility-bar__menu',
		'depth'          => 1,
		'fallback_cb'    => false,
	) );

	echo '</div>';
	echo '</div>';
}

// Add body class via PHP so CSS applies before JS loads — no layout flash.
add_filter( 'body_class', 'simply_utility_bar_body_class' );
function simply_utility_bar_body_class( $classes ) {
	if ( get_option( 'simply_utility_bar_enabled', 1 ) && has_nav_menu( 'simply-utility-bar' ) ) {
		$classes[] = 'has-utility-bar';
	}
	return $classes;
}

// Enqueue front-end assets
add_action( 'wp_enqueue_scripts', 'simply_utility_bar_enqueue' );
function simply_utility_bar_enqueue() {
	if ( ! get_option( 'simply_utility_bar_enabled', 1 ) ) return;
	if ( ! has_nav_menu( 'simply-utility-bar' ) ) return;

	wp_enqueue_style(
		'simply-utility-bar',
		SIMPLY_UTILITY_BAR_URL . 'assets/css/simply-utility-bar.css',
		array(),
		SIMPLY_UTILITY_BAR_VERSION
	);

	wp_enqueue_script(
		'simply-utility-bar',
		SIMPLY_UTILITY_BAR_URL . 'assets/js/simply-utility-bar.js',
		array(),
		SIMPLY_UTILITY_BAR_VERSION,
		true
	);

	wp_localize_script( 'simply-utility-bar', 'simplyUtilityBarData', array(
		'scrollThreshold' => (int) get_option( 'simply_utility_bar_scroll_threshold', 20 ),
	) );

	// Output inline CSS for admin-configurable overrides.
	// Falls back to CSS custom properties (--sub-*) if values are left as defaults.
	$bg_color  = sanitize_text_field( get_option( 'simply_utility_bar_bg_color', '' ) );
	$txt_color = sanitize_text_field( get_option( 'simply_utility_bar_text_color', '' ) );
	$height    = absint( get_option( 'simply_utility_bar_height', 40 ) );

	$inline = '.simply-utility-bar { --sub-height: ' . $height . 'px; max-height: ' . $height . 'px; }';

	if ( $bg_color ) {
		$inline .= ' .simply-utility-bar { --sub-bg: ' . $bg_color . '; }';
	}
	if ( $txt_color ) {
		$inline .= ' .simply-utility-bar { --sub-text: ' . $txt_color . '; }';
	}

	wp_add_inline_style( 'simply-utility-bar', $inline );
}
