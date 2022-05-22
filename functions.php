<?php

if (!defined('ABSPATH')) exit;

/**
 *
 * features functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage features
 * @since 1.0.0
 *
 *
*/

// Definitions && Functions
define('PATH', get_template_directory());
define('URL', get_template_directory_uri());
define( 'VERSION', wp_get_theme()->get('Version') );
define( 'NAME', get_bloginfo('name') );
define('THCSS', URL.'/static/css/');
define('THJS', URL.'/static/js/' );
define('THIMG', URL.'/static/img/');

// Include required files.

/**
 * REQUIRED FILES
 * Include required files.
*/

if ( file_exists(PATH . '/inc/option/init.php') ) {
	require PATH . '/inc/option/init.php';
}

if ( file_exists(PATH . '/inc/function/init.php') ) {
	require PATH . '/inc/function/init.php';
}

if ( file_exists(PATH . '/inc/classes/init.php') ) {
	require PATH . '/inc/classes/init.php';
}

