<?php

namespace Jobrodo\Theme\Functions;

class Nav {

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
		} );
	}

	/**
	 * Register navigation menus.
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 *
	 * @param array $menus
	 *
	 * @return $this
	 */
	public function register_menus( array $menus ): static {
		$this->action_after_setup( function () use ( $menus ) {
			register_nav_menus( $menus );
		} );

		return $this;
	}

}