<?php

namespace Skeleton\Theme\Lib;

class Titles {

	public function title(): mixed {
		if ( is_home() ) {
			if ( get_option( 'page_for_posts', true ) ) {
				return get_the_title( get_option( 'page_for_posts', true ) );
			}

			return __( 'Latest posts', 'skeleton-theme' );
		}

		if ( is_archive() ) {
			return get_the_archive_title();
		}

		if ( is_search() ) {
			return wp_sprintf( __( 'Search results for %s', 'skeleton-theme' ), get_search_query() );
		}

		if ( is_404() ) {
			return __( 'Not found', 'skeleton-theme' );
		}

		return get_the_title();
	}

}
