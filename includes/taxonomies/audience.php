<?php
/**
 * Register an Audience taxonomy.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function create_audience_taxonomy() {
	$labels = array(
		'name'              => _x( 'Audience', 'taxonomy general name', 'csu-hcfw-resources' ),
		'singular_name'     => _x( 'Audience', 'taxonomy singular name', 'csu-hcfw-resources' ),
		'menu_name'         => __( 'Audiences', 'csu-hcfw-resources' ),
		'all_items'         => __( 'All Audiences', 'csu-hcfw-resources' ),
		'edit_item'         => __( 'Edit Audience', 'csu-hcfw-resources' ),
		'view_item'         => __( 'View Audience', 'csu-hcfw-resources' ),
		'update_item'       => __( 'Update Audience', 'csu-hcfw-resources' ),
		'add_new_item'      => __( 'Add New Audience', 'csu-hcfw-resources' ),
		'new_item_name'     => __( 'New Audience Name', 'csu-hcfw-resources' ),
		'search_items'      => __( 'Search Audiences', 'csu-hcfw-resources' ),
		'parent_item'       => __( 'Parent Audience', 'csu-hcfw-resources' ),
		'parent_item_colon' => __( 'Parent Audience:', 'csu-hcfw-resources' )
	);

	$args = array(
		'public'            => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'rewrite'           => array( 'slug' => 'audience' )
	);

	register_taxonomy( 'hcfw_event_audience', array( 'hcfw_event' ), $args );
}
add_action( 'init', 'create_audience_taxonomy', 0 );
