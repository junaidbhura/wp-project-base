<?php
/**
 * Template Part: Header.
 *
 * @package fooclient
 */

?>
<header class="header">
	<a href="<?php bloginfo( 'url' ); ?>" class="header__logo">
		<?php
		if ( has_custom_logo() ) {
			echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' );
		} else {
			bloginfo( 'name' );
		}
		?>
	</a>
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'main',
		]
	);
	?>
</header> <!-- .header -->
