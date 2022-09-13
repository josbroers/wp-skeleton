<?php

namespace Skeleton\Theme;

use Skeleton\Theme\Hooks\Acf;
use Skeleton\Theme\Hooks\Feeds;
use Skeleton\Theme\Hooks\Media;
use Skeleton\Theme\Hooks\Theme;
use Skeleton\Theme\Lib\Wrapper;
use Skeleton\Theme\Hooks\Enqueue;
use Skeleton\Theme\Hooks\Widgets;
use Skeleton\Theme\Hooks\PostTypes;
use Skeleton\Theme\Hooks\Taxonomies;

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
