<?php

namespace Jobrodo\Theme\Hooks;

class Widgets {

	public function __construct() {
		add_action( 'widgets_init', [ $this, 'action__widgets_init' ], PHP_INT_MAX );
	}

	public function action__widgets_init(): void {
		unregister_sidebar( 'sidebar-1' );
		unregister_sidebar( 'header-1' );
		unregister_sidebar( 'footer-4' );
	}

}