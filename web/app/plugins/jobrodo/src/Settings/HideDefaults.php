<?php

namespace Jobrodo\Plugin\Settings;

use JetBrains\PhpStorm\NoReturn;

class HideDefaults {

	public function __construct() {
		add_action( 'init', [ $this, 'action__init' ], PHP_INT_MAX );
		add_action( 'load-edit.php', [ $this, 'action__redirect_to_dashboard' ], PHP_INT_MAX );
		add_action( 'load-post.php', [ $this, 'action__redirect_to_dashboard' ], PHP_INT_MAX );
		add_action( 'load-post-new.php', [ $this, 'action__redirect_to_dashboard' ], PHP_INT_MAX );
		add_action( 'admin_init', [ $this, 'action__admin_init' ], PHP_INT_MAX );
		add_action( 'widgets_init', [ $this, 'action__widgets_init' ], PHP_INT_MAX );
		add_action( 'do_feed', [ $this, 'action__do_feed' ], PHP_INT_MAX );
		add_action( 'do_feed_rdf', [ $this, 'action__do_feed' ], PHP_INT_MAX );
		add_action( 'do_feed_rss', [ $this, 'action__do_feed' ], PHP_INT_MAX );
		add_action( 'do_feed_rss2', [ $this, 'action__do_feed' ], PHP_INT_MAX );
		add_action( 'do_feed_atom', [ $this, 'action__do_feed' ], PHP_INT_MAX );
		add_action( 'do_feed_rss2_comments', [ $this, 'action__do_feed' ], PHP_INT_MAX );
		add_action( 'do_feed_atom_comments', [ $this, 'action__do_feed' ], PHP_INT_MAX );

		add_filter( 'register_post_type_args', [ $this, 'filter__post_type_args' ], 10, 2 );
		add_filter( 'register_taxonomy_args', [ $this, 'filter__taxonomy_args' ], 10, 2 );
	}

	/**
	 * Unregister the default taxonomies for the post type: post.
	 *
	 * @return void
	 */
	public function action__init(): void {
		unregister_taxonomy_for_object_type( 'category', 'post' );
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	}

	/**
	 * Redirect to dashboard when visiting the post type: post.
	 *
	 * @return void
	 */
	public function action__redirect_to_dashboard(): void {
		if ( ( $_REQUEST['post_type'] ?? 'post' ) === 'post' && ( ! isset( $_REQUEST['post'] ) || get_post_type( $_REQUEST['post'] ) === 'post' ) ) {
			wp_safe_redirect( admin_url( '/' ) );
			exit;
		}
	}

	/**
	 * Alter admin settings.
	 *
	 * @return void
	 */
	public function action__admin_init(): void {
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php' );

		remove_post_type_support( 'page', 'editor' );
	}

	/**
	 * Alter settings for post type: post.
	 *
	 * @param $args
	 * @param $post_type
	 *
	 * @return mixed
	 */
	public function filter__post_type_args( $args, $post_type ) {
		if ( $post_type === 'post' ) {
			$args['public']              = false;
			$args['show_ui']             = false;
			$args['show_in_menu']        = false;
			$args['show_in_admin_bar']   = false;
			$args['show_in_nav_menus']   = false;
			$args['can_export']          = false;
			$args['has_archive']         = false;
			$args['exclude_from_search'] = true;
			$args['publicly_queryable']  = false;
			$args['show_in_rest']        = false;
		}

		return $args;
	}

	public function filter__taxonomy_args( $args, $taxonomy ) {
		if ( in_array( $taxonomy, [ 'category', 'post_tag' ], true ) ) {
			$args['rewrite']           = false;
			$args['public']            = false;
			$args['show_in_rest']      = false;
			$args['show_ui']           = false;
			$args['show_admin_column'] = false;
		}

		return $args;
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

	/**
	 * Disable RSS feed.
	 *
	 * @return void
	 */
	#[NoReturn] public function action__do_feed(): void {
		wp_die( __( 'No feed available, please visit the <a href="' . esc_url( home_url( '/' ) ) . '">homepage</a>!' ) );
	}

}