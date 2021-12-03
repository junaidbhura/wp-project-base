<?php
/**
 * Archive template.
 *
 * @package fooclient
 */

foo_template_header();
?>

	<main class="main">

		<?php
		foo_component(
			'accordion',
			[
				'title'   => 'Item 1',
				'content' => '<p>Accordion Content 1</p>',
			]
		);
		?>

		<?php
		foo_component(
			'accordion',
			[
				'title'   => 'Item 2',
				'content' => '<p>Accordion Content 2</p>',
			]
		);
		?>

	</main> <!-- .main -->

<?php
foo_template_footer();
