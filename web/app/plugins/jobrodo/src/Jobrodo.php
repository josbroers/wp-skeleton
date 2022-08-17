<?php

namespace Jobrodo\Plugin;

class Jobrodo {
	private static $instance = null;

	public Acf      $acf;
	public Logger   $logger;
	public Settings $settings;
	public Wrapper  $wrapper;

	public function __construct() {
		$this->load_textdomain();

		$this->logger   = new Logger( 'jobrodo-plugin' );
		$this->acf      = new Acf();
		$this->settings = new Settings();
		$this->wrapper  = new Wrapper();

		add_filter( 'template_include', [ $this->wrapper, 'filter__template_include' ], 109 );
	}

	/**
	 * @return Jobrodo|null
	 */
	public static function get(): ?Jobrodo {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Loads a plugin’s translated strings.
	 * @link https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
	 *
	 * @return void
	 */
	private function load_textdomain(): void {
		load_plugin_textdomain( 'jobrodo-plugin', false, plugin_basename( JOBRODO_PLUGIN_DIR ) . '/languages/' );
	}
}