<?php

namespace Jobrodo\Plugin;

/**
 * Theme wrapper
 *
 * @link https://roots.io/sage/docs/theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function template_path() {
	return Wrapper::$main_template;
}

function sidebar_path(): Wrapper {
	return new Wrapper( 'templates/sidebar.php' );
}

class Wrapper {
	// Stores the full path to the main template file
	public static $main_template;

	// Basename of template file
	public static $base;

	// Array of templates
	public string $slug;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	public array $templates;

	public function __construct( $template = 'base.php' ) {
		$this->slug      = basename( $template, '.php' );
		$this->templates = [ $template ];

		if ( self::$base ) {
			$str = substr( $template, 0, - 4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	public static function filter__template_include( $main ) {
		// Check for other filters returning null
		if ( ! is_string( $main ) ) {
			return $main;
		}

		self::$main_template = $main;
		self::$base          = self::$base !== 'index' ? basename( self::$main_template, '.php' ) : false;

		return new Wrapper();
	}

	public function __toString() {
		$this->templates = apply_filters( 'sage/wrap_' . $this->slug, $this->templates );

		return locate_template( $this->templates );
	}
}