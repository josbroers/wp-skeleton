<?php

namespace Jobrodo\Plugin;

use Jobrodo\Plugin\Settings\HideDefaults;
use Jobrodo\Plugin\Settings\Uploads;

class Settings {

	public HideDefaults $hide_defaults;
	public Uploads      $uploads;

	public function __construct() {
		$this->hide_defaults = new HideDefaults();
		$this->uploads       = new Uploads();
	}

}