<?php

namespace Jobrodo\Plugin;

class Titles {

	/**
	 * Page titles.
	 *
	 * @return string|void
	 */
	public function title() {
		if ( is_home() ) {
			if ( get_option( 'page_for_posts', true ) ) {
				return get_the_title( get_option( 'page_for_posts', true ) );
			}

			return __( 'Laatste berichten', 'jobrodo-plugin' );
		}

		if ( is_archive() ) {
			return get_the_archive_title();
		}

		if ( is_search() ) {
			return sprintf( __( 'Zoekresultaten voor %s', 'jobrodo-plugin' ), get_search_query() );
		}

		if ( is_404() ) {
			return __( 'Niet gevonden', 'jobrodo-plugin' );
		}

		return get_the_title();
	}

}