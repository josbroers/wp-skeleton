<?php

namespace Jobrodo\Plugin\Settings;

class Uploads {

	public function __construct() {
		add_filter( 'wp_check_filetype_and_ext', [ $this, 'filter__wp_check_filetype_and_ext' ], 10, 4 );
		add_filter( 'upload_mimes', [ $this, 'filter__upload_mimes' ] );
	}

	/**
	 * Set the real file type of SVGs.
	 *
	 * @param $types
	 * @param $file
	 * @param $filename
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public function filter__wp_check_filetype_and_ext( $types, $file, $filename, $mimes ) {
		if ( str_contains( $filename, '.svg' ) ) {
			$types['ext']  = 'svg';
			$types['type'] = 'image/svg+xml';
		}

		return $types;
	}

	/**
	 * Add SVG to allowed file uploads.
	 *
	 * @param $mime_types
	 *
	 * @return mixed
	 */
	public function filter__upload_mimes( $mime_types ) {
		$mime_types['svg'] = 'image/svg+xml';

		return $mime_types;
	}

}