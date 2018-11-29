<?php
/**
 * Namespace functions.
 *
 * @package FooClient\Bar
 */

namespace FooClient\Bar;

/**
 * Bootstrap the plugin.
 *
 * Registers actions and filter required to run the plugin.
 */
function bootstrap() {
	add_action( 'init', __NAMESPACE__ . '\\post_type' );
	add_action( 'init', __NAMESPACE__ . '\\taxonomy' );

	// Autoloaded class.
	$baz = new Baz();
}

/**
 * Register 'bar' post type.
 *
 * @return void
 */
function post_type() {
	$args = array(
		'labels'              => array(
			'name'               => 'Bar',
			'singular_name'      => 'Bar',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Bar',
			'edit_item'          => 'Edit Bar',
			'new_item'           => 'New Bar',
			'view_item'          => 'View Bar',
			'search_items'       => 'Search Bars',
			'not_found'          => 'No bars found',
			'not_found_in_trash' => 'No bars found in Trash',
			'parent_item_colon'  => 'Parent Bar:',
			'menu_name'          => 'Bars',
		),
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor' ),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-admin-post',
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);

	register_post_type( 'foo_bar', $args );
}

/**
 * Register 'bars' taxonomy.
 *
 * @return void
 */
function taxonomy() {
	$args = array(
		'labels'            => array(
			'name'                       => 'Bars',
			'singular_name'              => 'Bar',
			'search_items'               => 'Search Bars',
			'popular_items'              => 'Popular Bars',
			'all_items'                  => 'All Bars',
			'parent_item'                => 'Parent Bar',
			'parent_item_colon'          => 'Parent Bar:',
			'edit_item'                  => 'Edit Bar',
			'update_item'                => 'Update Bar',
			'add_new_item'               => 'Add New Bar',
			'new_item_name'              => 'New Bar',
			'separate_items_with_commas' => 'Separate bars with commas',
			'add_or_remove_items'        => 'Add or remove bars',
			'choose_from_most_used'      => 'Choose from the most used bars',
			'menu_name'                  => 'Bars',
		),
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => true,
		'query_var'         => true,
	);

	register_taxonomy( 'foo_bars', array( 'foo_bar' ), $args );
}
