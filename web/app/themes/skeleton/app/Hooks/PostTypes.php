<?php

namespace Skeleton\Theme\Hooks;

class PostTypes {

	public function __construct() {
		add_filter( 'register_post_type_args', [ $this, 'filter__register_post_type_args' ], 10, 2 );
		add_action( 'admin_init', [ $this, 'action__admin_init' ], PHP_INT_MAX );
		add_action( 'load-edit.php', [ $this, 'action__redirect' ], PHP_INT_MAX );
		add_action( 'load-edit-comments.php', [ $this, 'action__redirect' ], PHP_INT_MAX );
		add_action( 'load-post.php', [ $this, 'action__redirect' ], PHP_INT_MAX );
		add_action( 'load-post-new.php', [ $this, 'action__redirect' ], PHP_INT_MAX );
	}

	public function filter__register_post_type_args( array $args, mixed $post_type ): array {
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

	public function action__admin_init(): void {
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_post_type_support( 'page', 'editor' );
	}

	public function action__redirect(): void {
		if ( ( $_REQUEST['post_type'] ?? 'post' ) === 'post' && ( ! isset( $_REQUEST['post'] ) || get_post_type( $_REQUEST['post'] ) === 'post' ) ) {
			wp_safe_redirect( admin_url( '/' ) );
			exit;
		}
	}

}
