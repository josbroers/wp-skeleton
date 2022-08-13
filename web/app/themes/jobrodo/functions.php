<?php

$includes = [
	'assets',
	'filters',
	'setup',
];

// Register the theme files
foreach ( $includes as $file ) {
	if ( ! locate_template( $file = "app/{$file}.php", true ) ) {
		wp_die( sprintf( __( 'Error locating <code>%s</code> for inclusion.', 'jobrodo-theme' ), $file ) );
	}
}
