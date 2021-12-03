<?php
/**
 * Accordion.
 *
 * @package fooclient
 */

$attributes = wp_parse_args(
	$attributes ?? [],
	[
		'title'   => '',
		'content' => '',
	]
);

if ( empty( $attributes['title'] ) || empty( $attributes['content'] ) ) {
	return;
}
?>
<foo-accordion class="accordion">
	<h3>
		<button class="accordion__handle"><?php echo esc_html( $attributes['title'] ); ?></button>
	</h3>
	<div class="accordion__content">
		<?php echo wp_kses_post( $attributes['content'] ); ?>
	</div>
</foo-accordion>
