<?php

namespace Skeleton\Theme\Hooks;

use JetBrains\PhpStorm\NoReturn;

class Feeds {

	public function __construct() {
		add_action('do_feed', [$this, 'action__disable_feed'], PHP_INT_MAX );
		add_action('do_feed_rdf', [$this, 'action__disable_feed'], PHP_INT_MAX );
		add_action('do_feed_rss', [$this, 'action__disable_feed'], PHP_INT_MAX );
		add_action('do_feed_rss2', [$this, 'action__disable_feed'], PHP_INT_MAX );
		add_action('do_feed_atom', [$this, 'action__disable_feed'], PHP_INT_MAX );
		add_action('do_feed_rss2_comments', [$this, 'action__disable_feed'], PHP_INT_MAX );
		add_action('do_feed_atom_comments', [$this, 'action__disable_feed'], PHP_INT_MAX );
	}

	#[NoReturn] public function action__disable_feed(): void {
		wp_die( __( 'No feed available.', 'skeleton-theme' ) );
	}

}
