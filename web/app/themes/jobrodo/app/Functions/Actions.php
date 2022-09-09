<?php

namespace Jobrodo\Theme\Functions;

class Actions {

	/**
	 * Disable all feeds.
	 *
	 * @return $this
	 */
	public function disable_all_feeds(): static {
		$actions = [ 'do_feed', 'do_feed_rdf', 'do_feed_rss', 'do_feed_rss2', 'do_feed_atom', 'do_feed_rss2_comments', 'do_feed_atom_comments' ];
		foreach ( $actions as $action ) {
			add_action( $action, function (): void {
				wp_die( __( 'No feed available.', 'jobrodo-theme' ) );
			}, PHP_INT_MAX );
		}

		return $this;
	}

	/**
	 * Removes a sidebar from the list.
	 * @link https://developer.wordpress.org/reference/functions/unregister_sidebar/
	 *
	 * @param string $sidebar_id
	 *
	 * @return $this
	 */
	public function unregister_sidebar( string $sidebar_id ): static {
		add_action( 'widgets_init', function () use ( $sidebar_id ): void {
			unregister_sidebar( $sidebar_id );
		}, PHP_INT_MAX );

		return $this;
	}

	/**
	 * Unregister a taxonomy for an object type.
	 * @link https://developer.wordpress.org/reference/functions/unregister_sidebar/
	 *
	 * @param string $taxonomy
	 * @param string $object_type
	 *
	 * @return $this
	 */
	public function unregister_tax_for_obj( string $taxonomy, string $object_type = 'post' ): static {
		add_action( 'init', function () use ( $taxonomy, $object_type ): void {
			unregister_taxonomy_for_object_type( $taxonomy, $object_type );
		}, PHP_INT_MAX );

		return $this;
	}

	/**
	 * Redirect to dashboard when visiting the post type: post.
	 *
	 * @return $this
	 */
	public function redirect_post_to_admin(): static {
		$actions = [ 'load-edit.php', 'load-post.php', 'load-post-new.php' ];

		foreach ( $actions as $action ) {
			add_action( $action, function (): void {
				if ( ( $_REQUEST['post_type'] ?? 'post' ) === 'post' && ( ! isset( $_REQUEST['post'] ) || get_post_type( $_REQUEST['post'] ) === 'post' ) ) {
					wp_safe_redirect( admin_url( '/' ) );
					exit;
				}
			}, PHP_INT_MAX );
		}

		return $this;
	}

	/**
	 * Removes a top-level admin menu.
	 * @link https://developer.wordpress.org/reference/functions/remove_menu_page/
	 *
	 * @param string $menu_slug
	 *
	 * @return $this
	 */
	public function remove_menu_page( string $menu_slug ): static {
		add_action( 'admin_init', function () use ( $menu_slug ): void {
			remove_menu_page( $menu_slug );
		}, PHP_INT_MAX );

		return $this;
	}

	/**
	 * Remove support for a feature from a post type.
	 * @link https://developer.wordpress.org/reference/functions/remove_post_type_support/
	 *
	 * @param string $post_type
	 * @param string $feature
	 *
	 * @return $this
	 */
	public function remove_post_type_support( string $post_type, string $feature ): static {
		add_action( 'admin_init', function () use ( $post_type, $feature ): void {
			remove_post_type_support( $post_type, $feature );
		}, PHP_INT_MAX );

		return $this;
	}

}