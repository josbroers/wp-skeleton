<?php

namespace Skeleton;

use JsonException;

class Installer {

	/**
	 * Global configuration keys for WordPress
	 *
	 * @var array|string[]
	 */
	private static array $KEYS = [
		'DB_NAME',
		'DB_USER',
		'DB_PASSWORD',
		'DB_HOST',
		'WP_ENV',
		'WP_HOME',
	];

	private static $root;
	private static $io;

	/**
	 * Install command for Composer and create `.env` file if:
	 * - IO is interactive
	 * - The client gave confirmation
	 *
	 * @param $event
	 *
	 * @return void
	 * @throws JsonException
	 */
	public static function post_install( $event ): void {
		self::$root = dirname( __DIR__, 2 );
		self::$io   = $event->getIO();

		if ( ! self::$io->isInteractive() ) {
			return;
		}

		if ( self::$io->askConfirmation( '<info>Create the `.env` file?</> [<comment>Y,n</>]? ', true ) ) {
			self::create_env_file();
		}
	}

	/**
	 * Create the `.env` file
	 *
	 * @return void
	 * @throws JsonException
	 */
	private static function create_env_file(): void {
		self::generate_keys();

		if ( ! self::$io->askConfirmation( '<info>Generate salts?</> [<comment>Y,n</>]? ', false ) ) {
			return;
		}

		self::generate_salts();
	}

	/**
	 * Generate the configuration keys
	 *
	 * @return void
	 */
	private static function generate_keys(): void {
		$config_vars = array_map( static function ( $key ) {
			$input = self::$io->ask( "<fg=cyan>What is the value of {$key}?</> ", '' );

			return "{$key}={$input}";
		}, self::$KEYS );

		$config_vars[] = 'WP_SITEURL=${WP_HOME}/wp';
		$env_file      = self::$root . "/.env";

		if ( ! touch( $env_file ) ) {
			self::$io->writeError( "<error>An error occured while creating your .env file</>" );
		}

		file_put_contents( $env_file, implode( PHP_EOL, $config_vars ) . PHP_EOL . PHP_EOL );
	}

	/**
	 * Generate the salts
	 *
	 * @return void
	 * @throws JsonException
	 */
	private static function generate_salts(): void {
		self::$io->write( "Checking if wp package 'aaemnnosttv/wp-cli-dotenv-command' is installed" );

		if ( ! self::check_for_dotenv() ) {
			self::$io->write( "Installing the wp package 'aaemnnosttv/wp-cli-dotenv-command'" );
			shell_exec( 'wp package install aaemnnosttv/wp-cli-dotenv-command' );
		}

		self::$io->write( 'Generating salts...' );
		shell_exec( 'wp dotenv salts generate' );

		self::$io->write( '<fg=bright-green;options=bold>Success:</> Added the salts to your `.env` file.' );
	}

	/**
	 * Check if the wp package 'aaemnnosttv/wp-cli-dotenv-command' is installed
	 *
	 * @return bool
	 * @throws JsonException
	 */
	private static function check_for_dotenv(): bool {
		$package_list         = shell_exec( 'wp package list --fields=name --format=json' );
		$package_list_decoded = json_decode( $package_list, false, 512, JSON_THROW_ON_ERROR );

		foreach ( $package_list_decoded as $object ) {
			if ( ! isset( $object->name ) || $object->name !== 'aaemnnosttv/wp-cli-dotenv-command' ) {
				continue;
			}

			return true;
		}

		return false;
	}

}
