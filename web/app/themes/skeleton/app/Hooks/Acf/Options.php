<?php

namespace Skeleton\Theme\Hooks\Acf;

class Options {

	public function __construct() {
		$this->add_options_page();
	}

	public function add_options_page(): void {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( [
				'page_title' => __( 'Site options', 'skeleton-theme' ),
				'menu_title' => __( 'Site options', 'skeleton-theme' ),
				'menu_slug'  => 'site-options',
				'capability' => 'edit_posts',
				'redirect'   => false,
			] );
		}
	}

}
