<?php

namespace Jobrodo\Theme\Lib;

use RuntimeException;

class Assets {

	/**
	 * Get URL of the compiled files in dist folder if available.
	 *
	 * @param string $filename
	 *
	 * @return string
	 */
	public function asset_path( string $filename ): string {
		$get_template_directory_path = get_template_directory();
		$get_template_directory_uri  = get_template_directory_uri();

		if ( ! file_exists( "{$get_template_directory_path}/dist{$filename}" ) ) {
			throw new RuntimeException( "Unable to locate file: {$filename}." );
		}

		return "{$get_template_directory_uri}/dist{$filename}";
	}

}