<?php

/*
Template Name: Voorbeeld layout
Template Post Type: page
*/

$blogname = get_option( 'blogname' );

?>

<style>
	h1 {
		margin: 0;
		font-size: clamp(60px, calc(1rem + (1vw - 640px / 100) * (.234375 * 100)), 90px);
		line-height: 1.15;
		font-weight: 800;
	}

	a {
		color: var(--wp--preset--color--blue);
		text-decoration: none;
		margin-top: 40px;
	}

	.layout {
		min-height: calc(100vh - 32px);
		padding: 2.5rem;
		display: flex;
		align-items: center;
		flex-direction: column;
		justify-content: center;
	}

	.container {
		text-align: center;
	}
</style>

<div class="layout">
	<div class="container">
		<h1>
			Welcome to the<br/>
			<?php get_template_part( 'templates/components/link', null, [
				'title'   => "{$blogname} on GitHub",
				'content' => "{$blogname}!",
				'href'    => "github.com/jos-broers/wp-skeleton",
				'target'  => '_blank',
			] ) ?>
		</h1>
		<div>
			<?php get_template_part( 'templates/components/link', null, [
				'class'   => 'btn btn--with-arrow',
				'title'   => 'View on GitHub',
				'content' => 'View on GitHub',
				'icon'    => 'arrow.svg',
				'href'    => "github.com/jos-broers/wp-skeleton",
				'target'  => '_blank',
			] ) ?>
		</div>
	</div>
</div>
