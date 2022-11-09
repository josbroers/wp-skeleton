<?php

use function Skeleton\Theme\Lib\template_path;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'components/header' ); ?>

<main>
	<?php include template_path(); ?>
</main>

<?php get_template_part( 'components/footer' ); ?>
</body>
</html>
