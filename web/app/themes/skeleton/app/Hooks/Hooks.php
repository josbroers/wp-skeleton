<?php

namespace Skeleton\Theme\Hooks;

class Hooks {

	public Acf        $acf;
	public Theme      $theme;
	public Media      $media;
	public Feeds      $feeds;
	public Enqueue    $enqueue;
	public PostTypes  $post_type;
	public Taxonomies $taxonomies;
	public Widgets    $widgets;

	public function __construct() {
		$this->acf        = new Acf();
		$this->theme      = new Theme();
		$this->media      = new Media();
		$this->feeds      = new Feeds();
		$this->enqueue    = new Enqueue();
		$this->post_type  = new PostTypes();
		$this->taxonomies = new Taxonomies();
		$this->widgets    = new Widgets();
	}

}
