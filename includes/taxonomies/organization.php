<?php
/**
 * Register a Organization taxonomy.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function create_organization_taxonomy() {
	$labels = array(
		'name'              => _x( 'Organization', 'taxonomy general name', 'csu-hcfw-resources' ),
		'singular_name'     => _x( 'Organization', 'taxonomy singular name', 'csu-hcfw-resources' ),
		'menu_name'         => __( 'Organizations', 'csu-hcfw-resources' ),
		'all_items'         => __( 'All Organizations', 'csu-hcfw-resources' ),
		'edit_item'         => __( 'Edit Organization', 'csu-hcfw-resources' ),
		'view_item'         => __( 'View Organization', 'csu-hcfw-resources' ),
		'update_item'       => __( 'Update Organization', 'csu-hcfw-resources' ),
		'add_new_item'      => __( 'Add New Organization', 'csu-hcfw-resources' ),
		'new_item_name'     => __( 'New Organization Name', 'csu-hcfw-resources' ),
		'search_items'      => __( 'Search Organizations', 'csu-hcfw-resources' ),
		'parent_item'       => __( 'Parent Organization', 'csu-hcfw-resources' ),
		'parent_item_colon' => __( 'Parent Organization:', 'csu-hcfw-resources' )
	);

	$args = array(
		'public'            => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'rewrite'           => array( 'slug' => 'organization' )
	);

	register_taxonomy( 'hcfw_event_organization', array( 'hcfw_event' ), $args );
}
add_action( 'init', 'create_organization_taxonomy', 0 );
