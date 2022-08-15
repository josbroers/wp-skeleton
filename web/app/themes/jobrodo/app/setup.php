<?php

namespace Jobrodo\Theme\App\Setup;

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action( 'after_setup_theme', function () {
	/**
	 * Load the theme’s translated strings.
	 * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
	 */
	load_theme_textdomain( 'jobrodo-theme', get_template_directory() . '/languages' );

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

	/**
	 * Restoring the classic Widgets Editor.
	 * Disable when using the Block Editor!
	 * @link   https://developer.wordpress.org/block-editor/how-to-guides/widgets/opting-out/
	 */
	remove_theme_support( 'widgets-block-editor' );
}, 20 );
