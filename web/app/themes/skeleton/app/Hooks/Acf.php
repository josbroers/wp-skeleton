<?php

namespace Skeleton\Theme\Hooks;

use Skeleton\Theme\Hooks\Acf\Options;
use Skeleton\Theme\Hooks\Acf\Settings;
use WP_Theme;

class Acf {

	public Settings $settings;
	public Options  $options;

	public function __construct() {
		add_action( 'after_switch_theme', [ $this, 'action__after_switch_theme' ], 10, 2 );

		if ( ! class_exists( 'acf' ) ) {
			return;
		}

		$this->settings = new Settings();
		$this->options  = new Options();
	}

	/**
	 * Check if ACF is activated when switching to theme
	 */
	public function action__after_switch_theme( string $old_theme_name, WP_Theme $old_theme ): void {
		if ( ! class_exists( 'acf' ) ) : ?>
            <div class="notice notice-error is-dismissible">
                <p style="font-size: 2em;">
					<?= wp_sprintf( '<b>%s</b> %s', __( 'NOTE:', 'skeleton-theme' ), __( 'First activate the ACF plugin.', 'skeleton-theme' ) ) ?>
                </p>
            </div>
			<?php switch_theme( $old_theme->get_stylesheet() ); ?>
		<?php endif;
	}

}
