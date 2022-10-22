<?php

namespace Skeleton\Theme\Lib;

class Lib {

	public function __construct() {
		( new Wrapper() )->template_include();
	}

}
