<div class="container">
	<?php if ( ! have_posts() ) : ?>
		<div>
			<?php _e( 'Sorry, geen resultaten gevonden.', 'seatsandsofas-theme' ); ?>
		</div>
		<?php get_search_form(); ?>
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); endwhile; ?>

	<?php the_posts_navigation(); ?>
</div>
