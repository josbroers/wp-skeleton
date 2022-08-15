<?php

namespace Jobrodo\Plugin;

use JetBrains\PhpStorm\NoReturn;

class Admin {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'action__admin_menu' ], 999 );
		add_action( 'do_feed', [ $this, 'action__do_feed' ], 1 );
		add_action( 'do_feed_rdf', [ $this, 'action__do_feed' ], 1 );
		add_action( 'do_feed_rss', [ $this, 'action__do_feed' ], 1 );
		add_action( 'do_feed_rss2', [ $this, 'action__do_feed' ], 1 );
		add_action( 'do_feed_atom', [ $this, 'action__do_feed' ], 1 );
		add_action( 'do_feed_rss2_comments', [ $this, 'action__do_feed' ], 1 );
		add_action( 'do_feed_atom_comments', [ $this, 'action__do_feed' ], 1 );
		add_action( 'widgets_init', [ $this, 'action__widgets_init' ], 11 );
	}

	/**
	 * Remove items from WP admin menu.
	 *
	 * @return void
	 */
	public function action__admin_menu(): void {
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php' );
	}

	/**
	 * Disable RSS feed.
	 *
	 * @return void
	 */
	#[NoReturn] public function action__do_feed(): void {
		wp_die( __( 'No feed available, please visit the <a href="' . esc_url( home_url( '/' ) ) . '">homepage</a>!' ) );
	}

	/**
	 * Unregister default sidebars.
	 *
	 * @return void
	 */
	public function action__widgets_init(): void {
		unregister_sidebar( 'sidebar-1' );
		unregister_sidebar( 'header-1' );
		unregister_sidebar( 'footer-4' );
	}

}