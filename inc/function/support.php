<?php

if (!defined('ABSPATH')) exit;

function BaseThemeSupport(){

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 640, 430, true );
	set_post_thumbnail_size( 1300, 650, true );
	set_post_thumbnail_size( 1000, 1000, true );

	add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
	if ( function_exists( 'add_image_size' ) ){
		add_image_size( 'thumb-md', 640, 430, array( 'center', 'center' ) );
		add_image_size( 'thumb-single', 1300, 650, array( 'center', 'center' ) );
		add_image_size( 'thumb-slider', 1000, 1000, array( 'center', 'center' ) );
	}

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support('title-tag');

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Twenty Twenty, use a find and replace
	* to change 'Task' to the name of your theme in all the template files.
	*/
	load_theme_textdomain('Task');

	// Add support for full and wide align images.
	add_theme_support('align-wide');

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/*
	* Adds `async` and `defer` support for scripts registered or enqueued
	* by the theme.
	*/


}
add_action('after_setup_theme', 'BaseThemeSupport');

/**
 * Register navigation menus uses wp_nav_menu in five places.
*/

if( !function_exists('BaseMenus') ){
	function BaseMenus() {
		$locations = array(
			'mainMain'          => baseLang('Main Menu','القائمة الرئيسية'),
			'siteMap'          => baseLang('Site Map','خريطة الموقع')
		);
		register_nav_menus( $locations );
	}
	add_action( 'init', 'BaseMenus' );
}


/**
 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
 */

if ( ! function_exists( 'wp_body_open' ) ) {

	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
