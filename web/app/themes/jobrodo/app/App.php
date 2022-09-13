<?php

namespace Jobrodo\Theme;

use Jobrodo\Theme\Hooks\Acf;
use Jobrodo\Theme\Hooks\Feeds;
use Jobrodo\Theme\Hooks\Media;
use Jobrodo\Theme\Hooks\Theme;
use Jobrodo\Theme\Lib\Wrapper;
use Jobrodo\Theme\Hooks\Enqueue;
use Jobrodo\Theme\Hooks\Widgets;
use Jobrodo\Theme\Hooks\PostTypes;
use Jobrodo\Theme\Hooks\Taxonomies;

class App {

	public Acf        $acf;
	public Enqueue    $enqueue;
	public Theme      $theme;
	public Media      $media;
	public PostTypes  $post_type;
	public Taxonomies $taxonomies;
	public Feeds      $feeds;
	public Widgets    $widgets;

	public function __construct() {
		$this->acf        = new Acf();
		$this->enqueue    = new Enqueue();
		$this->theme      = new Theme();
		$this->media      = new Media();
		$this->post_type  = new PostTypes();
		$this->taxonomies = new Taxonomies();
		$this->feeds      = new Feeds();
		$this->widgets    = new Widgets();

		( new Wrapper() )->template_include();
	}

}
