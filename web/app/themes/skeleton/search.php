<div class="container">
	<?php if ( ! have_posts() ) : ?>
		<div>
			<?= __( 'Sorry, no results found.', 'skeleton-theme' ) ?>
		</div>

		<?php get_search_form(); ?>
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); endwhile; ?>
	<?php the_posts_navigation(); ?>
</div>
