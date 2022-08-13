<div class="container">
	<?php while ( have_posts() ) : the_post(); ?>
		<h1><?= get_the_title() ?></h1>
		<?php get_template_part( 'templates/content', 'page' ); ?>
	<?php endwhile; ?>
</div>
