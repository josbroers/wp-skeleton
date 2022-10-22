<?php

namespace Skeleton\Theme\Hooks\Acf;

class Settings {

	public function __construct() {
		if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
			return;
		}

		add_filter( 'acf/settings/show_admin', '__return_false', 999 );
		add_action( 'load-edit.php', [ $this, 'action__redirect' ] );
		add_action( 'load-post.php', [ $this, 'action__redirect' ] );
	}

	/**
	 * Redirect to admin URL on non-development environments
	 */
	public function action__redirect(): void {
		$screen = get_current_screen();
		if ( $screen && isset( $screen->post_type ) && 'acf-field-group' === $screen->post_type ) {
			wp_redirect( admin_url() );
			exit;
		}
	}

}
