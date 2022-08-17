<?php

/**
 * @var array $args
 */

$default_args = [
	'class'   => '',
	'title'   => '',
	'href'    => '',
	'content' => '',
	'target'  => '',
	'icon'    => false,
];

$args = wp_parse_args( array_filter( $args ), $default_args );

?>

<a href="<?= $args['href'] ?>" class="<?= $args['class'] ?>" title="<?= $args['title'] ?>"
	<?php
	// Add target property when not empty.
	echo ! empty( $args['target'] ) ? "target='{$args['target']}'" : '';

	// Add rel property when target is blank.
	echo $args['target'] === '_blank' ? 'rel="noopener noreferrer"' : '';
	?>
>
	<?php
	echo $args['content'];

	// Add icon support.
	if ( ! empty( $args['icon'] ) ):
		echo file_get_contents( get_theme_file_path( "public/icons/{$args['icon']}" ) );
	endif;
	?>
</a>
