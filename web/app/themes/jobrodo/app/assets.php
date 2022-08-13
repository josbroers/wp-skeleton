<?php

namespace Jobrodo\Theme\App\Assets;

use Jobrodo\Plugin\Assets;

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'app_css', ( new Assets() )->asset_path( '/styles/app.css' ), false, null );
	wp_enqueue_script( 'app_js', ( new Assets() )->asset_path( '/scripts/app.js' ), [], null, true );
}, 100 );