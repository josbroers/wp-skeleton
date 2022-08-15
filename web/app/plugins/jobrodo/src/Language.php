<?php

namespace Jobrodo\Plugin;

class Language {

	public function __construct() {
		$this->load_textdomain();
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