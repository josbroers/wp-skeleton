<?php

use Skeleton\Theme\Lib\Assets;

?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=block"
		rel="stylesheet">
	<?php try { ?>
		<link rel="preload" href="<?= ( new Assets() )->asset_path( 'ts/main.ts' ) ?>" as="script">
		<link rel="preload" href="<?= ( new Assets() )->asset_path( 'scss/main.scss' ) ?>" as="style">
	<?php } catch ( JsonException $e ) {
		throw new RuntimeException( $e );
	} ?>
</head>
