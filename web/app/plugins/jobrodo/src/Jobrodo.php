<?php

namespace Jobrodo\Plugin;

class Jobrodo {
	private static $instance = null;

	public Language $language;
	public Wrapper  $wrapper;

	public function __construct() {
		$this->language = new Language();
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
}