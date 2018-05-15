<?php
/**
 * Theme Header.
 *
 * @package FooCient
 * @subpackage Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="manifest" href="<?php bloginfo( 'template_url' ); ?>/site.webmanifest">
		<link rel="apple-touch-icon" href="<?php bloginfo( 'template_url' ); ?>/icon.png">
		<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
