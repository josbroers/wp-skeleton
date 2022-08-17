<?php

namespace Jobrodo\Plugin;

use WP_Theme;

class Acf {

	public function __construct() {
		if ( ! class_exists( 'acf' ) ) {
			return;
		}

		$this->add_options_page();

		add_action( 'after_switch_theme', [ $this, 'action__after_switch_theme' ], 10, 2 );

		if ( defined( 'WP_ENV' ) && WP_ENV !== 'development' ) {
			// Switch ACF_LITE on if it's not needed to edit ACF fields.
			add_filter( 'acf/settings/show_admin', '__return_false', 999 );

			add_action( 'load-edit.php', [ $this, 'action__intercept_acf_edit_pages' ] );
			add_action( 'load-post.php', [ $this, 'action__intercept_acf_edit_pages' ] );
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
				'page_title' => 'Site options',
				'menu_title' => __( 'Opties', 'jobrodo-plugin' ),
				'menu_slug'  => 'site-options',
				'capability' => 'edit_posts',
				'redirect'   => false,
			] );
		}
	}

	/**
	 * Intercept ACF edit pages and redirect to admin dashboard.
	 *
	 * @return void
	 */
	public function action__intercept_acf_edit_pages(): void {
		$screen = get_current_screen();

		if ( $screen && isset( $screen->post_type ) && 'acf-field-group' === $screen->post_type ) {
			wp_redirect( admin_url() );
			exit;
		}
	}

	/**
	 * Check if ACF is activated, else display a warning.
	 *
	 * @param          $old_theme_name
	 * @param WP_Theme $old_theme
	 *
	 * @return void
	 */
	public function action__after_switch_theme( $old_theme_name, WP_Theme $old_theme ): void {
		if ( ! class_exists( 'acf' ) ) : ?>
			<div class="notice notice-error is-dismissible">
				<p style="font-size: 2em;"><b>LET OP:</b> Activeer eerst de plugin ACF.</p>
			</div>
			<?php switch_theme( $old_theme->get_stylesheet() ); ?>
		<?php endif;
	}

}