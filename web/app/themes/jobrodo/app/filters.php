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
