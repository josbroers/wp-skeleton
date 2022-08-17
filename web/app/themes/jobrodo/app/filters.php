<?php

namespace Jobrodo\Theme\App\Filters;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter( 'excerpt_more', function () {
	return sprintf( ' &hellip; <a href="%s">%s</a>', get_permalink(), __( 'Continued', 'jobrodo-theme' ) );
} );

/**
 * Add `<body>` classes.
 */
add_filter( 'body_class', function ( array $classes ): array {
	// Add page slug if it doesn't exist.
	if ( is_single() || ( is_page() && ! is_front_page() ) ) {
		if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	return $classes;
} );
