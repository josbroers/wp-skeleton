<?php

namespace Skeleton\Theme\Hooks;

class Taxonomies {

	public function __construct() {
		add_filter( 'register_post_type_args', [ $this, 'filter__register_post_type_args' ], 10, 2 );
		add_action( 'init', [ $this, 'action__init' ], PHP_INT_MAX );
	}

	public function filter__register_post_type_args( array $args, mixed $taxonomy ): array {
		if ( in_array( $taxonomy, [ 'category', 'post_tag' ], true ) ) {
			$args['rewrite']           = false;
			$args['public']            = false;
			$args['show_in_rest']      = false;
			$args['show_ui']           = false;
			$args['show_admin_column'] = false;
		}

		return $args;
	}

	public function action__init(): void {
		unregister_taxonomy_for_object_type( 'category', 'post' );
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	}

}
