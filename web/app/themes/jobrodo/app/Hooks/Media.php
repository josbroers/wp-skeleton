<?php

namespace Jobrodo\Theme\Hooks;

class Media {

	public function __construct() {
		add_filter( 'upload_mimes', [ $this, 'filter__upload_mimes' ] );
		add_filter( 'wp_check_filetype_and_ext', [ $this, 'filter__wp_check_filetype_and_ext' ], 10, 3 );
	}

	public function filter__upload_mimes( array $mime_types ): array {
		$mime_types['svg'] = 'image/svg+xml';

		return $mime_types;
	}

	public function filter__wp_check_filetype_and_ext( array $types, string $file, string $filename ): array {
		if ( str_contains( $filename, ".svg" ) ) {
			$types['ext']  = 'svg';
			$types['type'] = 'image/svg+xml';
		}

		return $types;
	}

}