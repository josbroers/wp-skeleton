<?php

namespace Skeleton\Theme\Lib;

use JsonException;
use RuntimeException;

class Assets {

	/**
	 * @throws JsonException
	 */
	public function asset_path( string $filename ): string {
		$get_template_directory_path = get_template_directory();
		$get_template_directory_uri  = get_template_directory_uri();
		$dist_path                   = "{$get_template_directory_path}/dist";

		static $manifest;

		if ( ! $manifest ) {
			$manifestPath = trailingslashit( $dist_path ) . 'manifest.json';

			if ( ! file_exists( $manifestPath ) ) {
				throw new RuntimeException( 'The manifest does not exist. Did you build the assets?' );
			}

			$manifest = json_decode( file_get_contents( $manifestPath ), true, 512, JSON_THROW_ON_ERROR );
		}

		if ( ! array_key_exists( $filename, $manifest ) ) {
			throw new RuntimeException( "Unable to locate file: {$filename}." );
		}

		return "{$get_template_directory_uri}/dist/{$manifest[ $filename ]['file']}";
	}

}
