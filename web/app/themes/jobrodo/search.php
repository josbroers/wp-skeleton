<div class="container">
	<?php if ( ! have_posts() ) : ?>
		<div><?= __( 'Sorry, geen resultaten gevonden.', 'jobrodo-theme' ) ?></div>
		<?php get_search_form(); ?>
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); endwhile; ?>

	<?php the_posts_navigation(); ?>
</div>
