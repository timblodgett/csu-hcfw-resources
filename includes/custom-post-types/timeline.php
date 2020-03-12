<?php
function register_homecoming_timeline_post_types() {
	$labels = array(
		'name'                  => _x( 'Timeline Events', 'post type general name', 'csu-hcfw' ),
		'menu_name'             => _x( 'Timeline', 'admin menu', 'csu-hcfw' ), // Default is the same as `name`.
		'singular_name'         => _x( 'Timeline Event', 'post type singular name', 'csu-hcfw' ),
		'name_admin_bar'        => _x( 'Timeline Event', 'add new on admin bar', 'csu-hcfw' ), // Default is the same as `singular_name`.
		'add_new'               => _x( 'Add New', 'timeline event', 'csu-hcfw' ),
		'add_new_item'          => __( 'Add New Timeline Event', 'csu-hcfw' ),
		'edit_item'             => __( 'Edit Timeline Event', 'csu-hcfw' ),
		'new_item'              => __( 'New Timeline Event', 'csu-hcfw' ),
		'view_item'             => __( 'View Timeline Event', 'csu-hcfw' ),
		'view_items'            => __( 'View Timeline Events', 'csu-hcfw' ),
		'search_items'          => __( 'Search Timeline Events', 'csu-hcfw' ),
		'all_items'             => __( 'All Timeline Events', 'csu-hcfw' ),
		'archives'              => __( 'Timeline Event Archives', 'csu-hcfw' ),
		'attributes'            => __( 'Timeline Event Attributes', 'csu-hcfw' ),
		'insert_into_item'      => __( 'Insert into timeline event', 'csu-hcfw' ),
		'uploaded_to_this_item' => __( 'Uploaded to this timeline event', 'csu-hcfw' ),
		'not_found'             => __( 'No timeline events found.', 'csu-hcfw' ),
		'not_found_in_trash'    => __( 'No timeline events found in Trash.', 'csu-hcfw' )
	);

	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'menu_position' => null, // Default: null - defaults to below Comments
		'menu_icon'     => 'dashicons-list-view', // Example: 'dashicons-video-alt'
		'supports'      => array( 'title', 'editor', 'thumbnail' ), // Default: title and editor
	);

	register_post_type( 'timeline', $args );
}
add_action( 'init', 'register_homecoming_timeline_post_types' );
