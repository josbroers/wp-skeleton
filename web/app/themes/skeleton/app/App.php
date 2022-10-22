<?php

namespace Skeleton\Theme;

use Skeleton\Theme\Hooks\Hooks;
use Skeleton\Theme\Lib\Lib;
use Skeleton\Theme\Queries\Query;

class App {

	private static ?App $instance = null;

	public Hooks $hooks;
	public Lib   $lib;
	public Query $query;

	public function __construct() {
		$this->hooks = new Hooks();
		$this->lib   = new Lib();
		$this->query = new Query();
	}

	public static function get(): ?App {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}
