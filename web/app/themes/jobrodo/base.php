<?php

use Jobrodo\Theme\Lib\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'templates/header' ); ?>

<main>

</main>

<?php get_template_part( 'templates/footer' ); ?>
</body>
</html>
