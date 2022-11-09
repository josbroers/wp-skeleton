<div class="flexible-content" id="flexible-content">
	<?php if ( have_rows( 'content' ) ): ?>
		<?php while ( have_rows( 'content' ) ) : the_row(); ?>
			<?php $flexible_content_classes = [
				'flexible-content-wrapper',
				'flexible-content-wrapper--' . get_row_layout(),
			]; ?>

			<div class="<?= implode( ' ', $flexible_content_classes ) ?>">
				<?php get_template_part( 'templates/flexible-content/' . get_row_layout() ); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
