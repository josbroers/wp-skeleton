<?php

namespace Jobrodo\Theme\Hooks;

use Jobrodo\Theme\Lib\Assets;

class Enqueue {

	public function __construct() {
    add_action( 'wp_enqueue_scripts', [$this, 'action__wp_enqueue_scripts'], 100);
	}

  public function action__wp_enqueue_scripts(): void {
    wp_enqueue_script( 'app_js', '', ( new Assets() )->asset_path( '/scripts/app.js' ) );
    wp_enqueue_style( 'app_css', ( new Assets() )->asset_path( '/styles/app.css' ), [] );
  }

}