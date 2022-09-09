<?php

namespace Jobrodo\Theme\Functions;

class Enqueue {

	/**
	 * Function which fires when scripts and styles are enqueued.
	 * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
	 *
	 * @param $function
	 *
	 * @return void
	 */
	private function action_enqueue_scripts( $function ): void {
		add_action( 'wp_enqueue_scripts', function () use ( $function ) {
			$function();
		}, 100 );
	}

	/**
	 * Enqueue a CSS stylesheet.
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 *
	 * @param string $handle
	 * @param string $src
	 * @param array  $deps
	 * @param bool   $ver
	 * @param string $media
	 *
	 * @return $this
	 */
	public function add_style( string $handle, string $src = '', array $deps = [], bool $ver = false, string $media = 'all' ): static {
		$this->action_enqueue_scripts( function () use ( $handle, $src, $deps, $ver, $media ) {
			wp_enqueue_style( $handle, $src, $deps, $ver, $media );
		} );

		return $this;
	}

	/**
	 * Enqueue a script.
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 *
	 * @param string $handle
	 * @param string $src
	 * @param array  $deps
	 * @param bool   $ver
	 * @param bool   $in_footer
	 *
	 * @return $this
	 */
	public function add_script( string $handle, string $src = '', array $deps = [], bool $ver = false, bool $in_footer = false ): static {
		$this->action_enqueue_scripts( function () use ( $handle, $src, $deps, $ver, $in_footer ) {
			wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
		} );

		return $this;
	}

}