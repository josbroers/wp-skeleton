<?php

namespace Skeleton\Theme\Hooks;

use JsonException;
use Skeleton\Theme\Lib\Assets;

class Enqueue {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'action__wp_enqueue_scripts' ], 100 );
	}

	/**
	 * @throws JsonException
	 */
	public function action__wp_enqueue_scripts(): void {
		wp_enqueue_script( 'main_js', '', ( new Assets() )->asset_path( 'ts/main.ts' ) );
		wp_enqueue_style( 'main_css', ( new Assets() )->asset_path( 'scss/main.scss' ), [] );
	}

}
