<?php

namespace Skeleton\Theme\Hooks;

use JsonException;
use Skeleton\Theme\Lib\Assets;

class Theme {

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'action__after_setup_theme' ], 20 );
		add_filter( 'body_class', [ $this, 'filter__body_class' ] );
		add_filter( 'excerpt_more', [ $this, 'filter__excerpt_more' ] );
	}

	public function filter__excerpt_more(): string {
		return wp_sprintf(
			' &hellip; <a href="%s">%s</a>', get_permalink(),
			__( 'Continued', 'skeleton-theme' )
		);
	}

	public function filter__body_class( array $classes ): array {
		if ( is_single() || ( is_page() && ! is_front_page() ) ) {
			if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
				$classes[] = basename( get_permalink() );
			}
		}

		return $classes;
	}

	/**
	 * @throws JsonException
	 */
	public function action__after_setup_theme(): void {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
			'script',
			'style',
		] );

		remove_theme_support( 'widgets-block-editor' );

		load_theme_textdomain( 'skeleton-theme', get_template_directory() . '/languages' );

		add_editor_style( ( new Assets() )->asset_path( 'scss/main.scss' ) );

		register_nav_menus( [
			'primary_navigation' => __( 'Primary navigation', 'skeleton-theme' ),
		] );
	}

}
