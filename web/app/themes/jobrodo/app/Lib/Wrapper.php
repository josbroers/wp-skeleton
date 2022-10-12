<?php

namespace Jobrodo\Theme\Lib;

function template_path() {
	return Wrapper::$main_template;
}

function sidebar_path(): Wrapper {
	return new Wrapper( 'templates/sidebar.php' );
}

class Wrapper {

	public static $main_template;
	public static $base;
	public string $slug;
	public array  $templates;

	public function __construct( $template = 'base.php' ) {
		$this->slug      = basename( $template, '.php' );
		$this->templates = [ $template ];

		if ( self::$base ) {
			$str = substr( $template, 0, - 4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	public function template_include(): static {
		add_filter( 'template_include', function ( $main ) {
			if ( ! is_string( $main ) ) {
				return $main;
			}

			self::$main_template = $main;
			self::$base          = self::$base !== 'index' ? basename( self::$main_template, '.php' ) : false;

			return new Wrapper();
		}, 109 );

		return $this;
	}

	public function __toString(): string {
		$this->templates = apply_filters( 'sage/wrap_' . $this->slug, $this->templates );

		return locate_template( $this->templates );
	}

}