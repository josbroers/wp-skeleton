<?php

namespace Jobrodo\Theme\App\Setup;

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action( 'after_setup_theme', function () {
	/**
	 * Register the navigation menus.
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	register_nav_menus( [
		'primary_navigation' => __( 'Primary Navigation', 'jobrodo-theme' ),
	] );

	/**
	 * Enable plugins to manage the document title.
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable post thumbnail support.
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable HTML5 markup support.
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support( 'html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	] );
}, 20 );
