<?php
/**
 * Register a Location taxonomy.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function create_location_taxonomy() {
	$labels = array(
		'name'              => _x( 'Location', 'taxonomy general name', 'csu-hcfw-resources' ),
		'singular_name'     => _x( 'Location', 'taxonomy singular name', 'csu-hcfw-resources' ),
		'menu_name'         => __( 'Locations', 'csu-hcfw-resources' ),
		'all_items'         => __( 'All Locations', 'csu-hcfw-resources' ),
		'edit_item'         => __( 'Edit Location', 'csu-hcfw-resources' ),
		'view_item'         => __( 'View Location', 'csu-hcfw-resources' ),
		'update_item'       => __( 'Update Location', 'csu-hcfw-resources' ),
		'add_new_item'      => __( 'Add New Location', 'csu-hcfw-resources' ),
		'new_item_name'     => __( 'New Location Name', 'csu-hcfw-resources' ),
		'search_items'      => __( 'Search Locations', 'csu-hcfw-resources' ),
		'parent_item'       => __( 'Parent Location', 'csu-hcfw-resources' ),
		'parent_item_colon' => __( 'Parent Location:', 'csu-hcfw-resources' )
	);

	$args = array(
		'public'            => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'rewrite'           => array( 'slug' => 'location' )
	);

	register_taxonomy( 'hcfw_event_location', array( 'hcfw_event' ), $args );
}
add_action( 'init', 'create_location_taxonomy', 0 );


function add_hcfw_event_location_form_fields( $term ) {
?>
	<div class="form-field">
		<label for="location_address">Address</label>
		<input type="text" id="location_address" name="location_address">
		<p>Street Address, City, State ZIP</p>
	</div>
<?php
}
add_action( 'hcfw_event_location_add_form_fields', 'add_hcfw_event_location_form_fields', 10, 2 );


function edit_hcfw_event_location_form_fields( $term ) {
	$address = get_term_meta( $term->term_id, '_location_address', true );
?>
	<tr class="form-field">
		<th>
			<label for="location_address">Address</label>
		</th>
		<td>
			<input type="text" id="location_address" name="location_address" value="<?php echo esc_attr( $address ); ?>">
			<p class="description">Street Address, City, State ZIP</p>
		</td>
	</tr>
<?php
}
add_action( 'hcfw_event_location_edit_form_fields', 'edit_hcfw_event_location_form_fields', 10, 2 );


function save_hcfw_event_location_form_fields( $term_id ) {
	if ( isset( $_POST['location_address'] ) ) {
		update_term_meta(
			$term_id,
			'_location_address',
			sanitize_text_field( $_POST['location_address'] )
		);
	}
}
add_action( 'created_hcfw_event_location', 'save_hcfw_event_location_form_fields', 10, 2 );
add_action( 'edited_hcfw_event_location', 'save_hcfw_event_location_form_fields', 10, 2 );
