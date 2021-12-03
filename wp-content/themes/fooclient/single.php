<?php
/**
 * Single post template.
 *
 * @package fooclient
 */

foo_template_header();
?>

	<main class="main">

		<?php
		the_post();
		the_content();
		?>

	</main> <!-- .main -->

<?php
foo_template_footer();
