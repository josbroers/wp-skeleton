<?php

namespace Jobrodo;

use Exception;

class Installer {

	/**
	 * Global configuration keys for WordPress.
	 *
	 * @var array|string[]
	 */
	private static array $CONFIG_KEYS = [
		'DB_NAME',
		'DB_USER',
		'DB_PASSWORD',
		'DB_HOST',
		'WP_ENV',
		'WP_HOME',
	];

	/**
	 * Salt keys for WordPress.
	 *
	 * @var array|string[]
	 */
	private static array $AUTH_KEYS = [
		'AUTH_KEY',
		'SECURE_AUTH_KEY',
		'LOGGED_IN_KEY',
		'NONCE_KEY',
		'AUTH_SALT',
		'SECURE_AUTH_SALT',
		'LOGGED_IN_SALT',
		'NONCE_SALT',
	];

	private static $root;
	private static $composer;
	private static $io;

	/**
	 * Install command for composer.
	 *
	 * @param $event
	 *
	 * @return void
	 * @throws Exception
	 */
	public static function install( $event ): void {
		self::$root     = dirname( __DIR__, 2 );
		self::$composer = $event->getComposer();
		self::$io       = $event->getIO();

		// Remove WPs default content directory with standard plugins and themes.
		self::remove_default_content_dir();

		// Create config file if IO is interactive.
		if (
			self::$io->isInteractive() &&
			self::$io->askConfirmation( '<info>Create the config file?</info> [<comment>Y,n</comment>]? ', false )
		) {
			self::create_config_file();
		}
	}

	/**
	 * Remove the default `wp-content` directory.
	 *
	 * @return void
	 */
	private static function remove_default_content_dir(): void {
		if ( ! self::$composer->getConfig()->get( 'remove-default-content-dir' ) ) {
			return;
		}

		self::rrmdir( self::$root . '/web/wp/wp-content' );
	}

	/**
	 * Remove a directory.
	 *
	 * @param $dir
	 *
	 * @return void
	 */
	private static function rrmdir( $dir ): void {
		if ( is_dir( $dir ) ) {
			$objects = scandir( $dir );

			foreach ( $objects as $object ) {
				if ( $object !== "." && $object !== ".." ) {
					if ( filetype( $dir . DIRECTORY_SEPARATOR . $object ) === "dir" ) {
						self::rrmdir( $dir . DIRECTORY_SEPARATOR . $object );
					} else {
						unlink( $dir . DIRECTORY_SEPARATOR . $object );
					}
				}
			}

			rmdir( $dir );
		}
	}

	/**
	 * Create the `.env` file.
	 *
	 * @return void
	 * @throws Exception
	 */
	private static function create_config_file(): void {
		$config_vars = array_map( static function ( $key ) {
			$input = self::$io->ask( "<fg=cyan>What is the value of {$key}?</> ", '' );

			return "{$key}={$input}";
		}, self::$CONFIG_KEYS );

		$config_vars[] = 'WP_SITEURL=${WP_HOME}/wp';
		$env_file      = self::$root . "/.env";

		/**
		 * @throws Exception
		 */
		$salts = static function ( $key ) {
			return "$key=" . self::generate_salt();
		};

		$salts = array_map( $salts, self::$AUTH_KEYS );

		if ( touch( $env_file ) ) {
			file_put_contents( $env_file, implode( PHP_EOL, $config_vars ) . PHP_EOL . PHP_EOL );
			file_put_contents( $env_file, implode( PHP_EOL, $salts ), FILE_APPEND | LOCK_EX );
		} else {
			self::$io->write( "<error>An error occured while creating your .env file</error>" );
		}
	}

	/**
	 * Salting passwords helps against tools which has stored hashed values of common dictionary strings.
	 * The added values makes it harder to crack.
	 *
	 * @throws Exception
	 */
	private static function generate_salt(): string {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$chars .= '!@#$%^&*()';
		$chars .= '-_[]{}<>~`+=,.;:/?|';
		$salt  = '';

		for ( $i = 0; $i < 64; $i ++ ) {
			$salt .= $chars[ random_int( 0, strlen( $chars ) - 1 ) ];
		}

		return $salt;
	}

	/**
	 * Update command for composer.
	 *
	 * @param $event
	 *
	 * @return void
	 */
	public static function update( $event ): void {
		self::$root     = dirname( __DIR__, 2 );
		self::$composer = $event->getComposer();
		self::$io       = $event->getIO();

		// Remove WPs default content directory with standard plugins and themes.
		self::remove_default_content_dir();
	}

}