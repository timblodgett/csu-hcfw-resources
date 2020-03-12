<?php
function register_event_year_taxonomy() {
	$labels = array(
		'name'                       => 'Year',
		'singular_name'              => 'Year',
		'menu_name'                  => 'Years',
		'all_items'                  => 'All Years',
		'edit_item'                  => 'Edit Year',
		'view_item'                  => 'View Year',
		'update_item'                => 'Update Year',
		'add_new_item'               => 'Add New Year',
		'new_item_name'              => 'New Year Name',
		'search_items'               => 'Search Years',
		'popular_items'              => 'Popular Years',
		'separate_items_with_commas' => '',
		'add_or_remove_items'        => 'Add or remove years',
		'choose_from_most_used'      => '',
		'not_found'                  => 'No Years Found'
	);

	$args = array(
		'labels'            => $labels,
		'query_var'         => 'event_year',
	);

	register_taxonomy( 'event_year', array( 'timeline' ), $args );
}
add_action( 'init', 'register_event_year_taxonomy' );
