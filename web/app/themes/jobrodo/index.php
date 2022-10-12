<?php if ( ! have_posts() ) : ?>
	<div>
		<?= __( 'Sorry, no results found.', 'jobrodo-theme' ) ?>
	</div>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php

while ( have_posts() ) : the_post();
	get_template_part( 'templates/content' );
endwhile; ?>

the_posts_navigation();