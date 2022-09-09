<?php

namespace Jobrodo\Theme\Functions;

class Theme {

	/**
	 * Function which fires after the theme is loaded.
	 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
	 *
	 * @param $function
	 *
	 * @return void
	 */
	private function action_after_setup( $function ): void {
		add_action( 'after_setup_theme', function () use ( $function ) {
			$function();
		}, 20 );
	}

	/**
	 * Registers theme support for a given feature.
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support
	 *
	 * @param string $feature
	 * @param        $options
	 *
	 * @return $this
	 */
	public function add_support( string $feature, $options = null ): static {
		$this->action_after_setup( function () use ( $feature, $options ) {
			if ( $options ) {
				add_theme_support( $feature, $options );
			} else {
				add_theme_support( $feature );
			}
		} );

		return $this;
	}

	/**
	 * Allows a theme to de-register its support of a certain feature
	 * @link https://developer.wordpress.org/reference/functions/remove_theme_support/
	 *
	 * @param string $feature
	 *
	 * @return $this
	 */
	public function remove_support( string $feature ): static {
		$this->action_after_setup( function () use ( $feature ) {
			remove_theme_support( $feature );
		} );

		return $this;
	}

	/**
	 * Load the theme’s translated strings.
	 * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
	 *
	 * @param string $domain
	 * @param bool   $path
	 *
	 * @return $this
	 */
	public function load_text_domain( string $domain, bool $path = false ): static {
		$this->action_after_setup( function () use ( $domain, $path ) {
			load_theme_textdomain( $domain, $path );
		} );

		return $this;
	}

	/**
	 * Add custom stylesheets to the TinyMCE editor.
	 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
	 *
	 * @param string $file
	 *
	 * @return $this
	 */
	public function add_editor_style( string $file ): static {
		$this->action_after_setup( function () use ( $file ) {
			add_editor_style( $file );
		} );

		return $this;
	}

}