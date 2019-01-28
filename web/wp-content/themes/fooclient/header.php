<?php
/**
 * Theme Header.
 *
 * @package fooclient
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php do_action( 'foo_head_first' ); ?>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php get_template_part( 'parts/favicon' ); ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php do_action( 'foo_body_first' ); ?>
		<?php get_template_part( 'parts/header' ); ?>
