<?php
/**
 * @var array $args
 */

$default_args = [
	'class'     => '',
	'id'        => '',
	'title'     => '',
	'href'      => '',
	'content'   => '',
	'target'    => '',
	'icon'      => false,
	'icon_path' => 'dist/icons/',
	'rel'       => '',
];

$args = wp_parse_args( array_filter( $args ), $default_args );

?>

<a
	href="<?= $args['href'] ?>"
	class="<?= $args['class'] ?>"
	title="<?= $args['title'] ?>"
	<?= ! empty( $args['target'] ) ? "target='{$args['target']}'" : '' ?>

	<?= ! empty( $args['id'] ) ? "id='{$args['id']}'" : '' ?>

	<?php if ( $args['target'] === '_blank' && empty( $args['rel'] ) ) : ?>
		<?= 'rel="noopener noreferrer"' ?>
	<?php elseif ( ! empty( $args['rel'] ) ): ?>
		<?= "rel='{$args['rel']}'" ?>
	<?php endif; ?>
>
	<?= $args['content'] ?>

	<?php if ( ! empty( $args['icon'] ) ): ?>
		<?= file_get_contents( get_theme_file_path( "{$args['icon_path']}{$args['icon']}" ) ) ?>
	<?php endif; ?>
</a>
