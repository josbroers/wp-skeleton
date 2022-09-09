<?php

namespace Jobrodo\Theme\Functions;

use WP_Theme;

class Acf {

	public function __construct() {
		if ( ! class_exists( 'acf' ) ) {
			return;
		}
	}

	/**
	 * Add ACF options pages.
	 *
	 * @return void
	 */
	public function add_options_page(): void {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( [
				'page_title' => __( 'Site options', 'jobrodo-theme' ),
				'menu_title' => __( 'Site options', 'jobrodo-theme' ),
				'menu_slug'  => 'site-options',
				'capability' => 'edit_posts',
				'redirect'   => false,
			] );
		}
	}

	/**
	 * Check if ACF is activated, else display a warning.
	 *
	 * @return $this
	 */
	public function require_acf(): static {
		add_action( 'after_switch_theme', function ( string $old_theme_name, WP_Theme $old_theme ): void {
			if ( ! class_exists( 'acf' ) ) : ?>
        <div class="notice notice-error is-dismissible">
          <p style="font-size: 2em;">
						<?= wp_sprintf( '<b>%s</b> %s', __( 'NOTE:', 'jobrodo-theme' ), __( 'First activate the ACF plugin.', 'jobrodo-theme' ) ) ?>
          </p>
        </div>
				<?php switch_theme( $old_theme->get_stylesheet() ); ?>
			<?php endif;
		}, 10, 2 );

		return $this;
	}

	/**
	 * Switch ACF_LITE on if it's not needed to edit ACF fields
	 * and intercept ACF edit pages and redirect to admin dashboard.
	 *
	 * @return $this
	 */
	public function disable_edit_for_non_dev(): static {
		if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
			return $this;
		}

		add_filter( 'acf/settings/show_admin', '__return_false', 999 );

		$actions = [ 'load-edit.php', 'load-post.php' ];
		foreach ( $actions as $action ) {
			add_action( $action, function (): void {
				$screen = get_current_screen();

				if ( $screen && isset( $screen->post_type ) && 'acf-field-group' === $screen->post_type ) {
					wp_redirect( admin_url() );
					exit;
				}
			} );
		}

		return $this;
	}

}