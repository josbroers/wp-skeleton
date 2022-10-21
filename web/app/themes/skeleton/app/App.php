<?php

namespace Skeleton\Theme;

use Skeleton\Theme\Hooks\Hooks;
use Skeleton\Theme\Lib\Lib;
use Skeleton\Theme\Queries\Query;

class App {

	public Hooks $hooks;
	public Lib   $lib;
	public Query $query;

	public function __construct() {
		$this->hooks = new Hooks();
		$this->lib   = new Lib();
		$this->query = new Query();
	}

}
