<?php
/**
 * Register an Event post type.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 */

function hcfw_event_cpt() {
	$labels = array(
		'name'                  => _x( 'Events', 'post type general name', 'csu-hcfw-resources' ),
		'singular_name'         => _x( 'Event', 'post type singular name', 'csu-hcfw-resources' ),
		'add_new'               => _x( 'Add New', 'event', 'csu-hcfw-resources' ),
		'add_new_item'          => __( 'Add New Event', 'csu-hcfw-resources' ),
		'edit_item'             => __( 'Edit Event', 'csu-hcfw-resources' ),
		'new_item'              => __( 'New Event', 'csu-hcfw-resources' ),
		'view_item'             => __( 'View Event', 'csu-hcfw-resources' ),
		'view_items'            => __( 'View Events', 'csu-hcfw-resources' ),
		'search_items'          => __( 'Search Events', 'csu-hcfw-resources' ),
		'all_items'             => __( 'All Events', 'csu-hcfw-resources' ),
		'archives'              => __( 'Event Archives', 'csu-hcfw-resources' ),
		'attributes'            => __( 'Event Attributes', 'csu-hcfw-resources' ),
		'insert_into_item'      => __( 'Insert into event', 'csu-hcfw-resources' ),
		'uploaded_to_this_item' => __( 'Uploaded to this event', 'csu-hcfw-resources' ),
		'not_found'             => __( 'No events found.', 'csu-hcfw-resources' ),
		'not_found_in_trash'    => __( 'No events found in Trash.', 'csu-hcfw-resources' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'menu_position'       => null, // Default: null - defaults to below Comments
		'menu_icon'           => 'dashicons-calendar-alt',
		'supports'            => array( 'title', 'editor' ),
		'has_archive'         => false, // Default: false
		'rewrite'             => array( 'slug' => 'events' )
	);

	register_post_type( 'hcfw_event', $args );
}
add_action( 'init', 'hcfw_event_cpt' );


/* Add Meta Boxes */
function hcfw_event_add_meta_boxes() {
	add_meta_box(
		'hcfw_event_details', // Unique ID
		'Event Details', // Box title
		'hcfw_event_details_html', // Content callback, must be of type callable
		'hcfw_event', // Post type
		'normal' // context (normal, side, advanced)
	);

	add_meta_box(
		'hcfw_event_day_time', // Unique ID
		'Day and Time', // Box title
		'hcfw_event_day_time_html', // Content callback, must be of type callable
		'hcfw_event', // Post type
		'normal' // context (normal, side, advanced)
	);

	add_meta_box(
		'hcfw_event_links', // Unique ID
		'Event Links', // Box title
		'hcfw_event_links_html', // Content callback, must be of type callable
		'hcfw_event', // Post type
		'normal' // context (normal, side, advanced)
	);

	add_meta_box(
		'hcfw_event_submitter', // Unique ID
		'Submitted By', // Box title
		'hcfw_event_submitter_html', // Content callback, must be of type callable
		'hcfw_event', // Post type
		'normal' // context (normal, side, advanced)
	);

	add_meta_box(
		'hcfw_event_type', // Unique ID
		'Event Type', // Box title
		'hcfw_event_type_html', // Content callback, must be of type callable
		'hcfw_event', // Post type
		'side' // context (normal, side, advanced)
	);
}
add_action( 'add_meta_boxes', 'hcfw_event_add_meta_boxes' );


/* Event Details */
function hcfw_event_details_html( $post ) {
	$subtitle = get_post_meta( $post->ID, '_hcfw_event_subtitle', true );
	// $desc = get_post_meta( $post->ID, '_hcfw_event_desc', true );
	$room = get_post_meta( $post->ID, '_hcfw_event_room', true );
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="hcfw_event_subtitle">Subtitle</label>
				</th>
				<td>
					<input name="hcfw_event_subtitle" id="hcfw_event_subtitle" type="text" class="regular-text" value="<?php echo esc_attr( $subtitle ); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hcfw_event_room">Room</label>
				</th>
				<td>
					<input name="hcfw_event_room" id="hcfw_event_room" type="text" class="regular-text" value="<?php echo esc_attr( $room ); ?>">
				</td>
			</tr>
		</tbody>
	</table>
<?php
}

function hcfw_event_save_details_postdata( $post_id ) {
	if ( isset( $_POST['hcfw_event_subtitle'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_subtitle',
			sanitize_text_field( $_POST['hcfw_event_subtitle'] )
		);
	}

	if ( isset( $_POST['hcfw_event_room'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_room',
			sanitize_text_field( $_POST['hcfw_event_room'] )
		);
	}
}
add_action( 'save_post', 'hcfw_event_save_details_postdata' );


/* Event Day and Time */
function hcfw_event_day_time_html( $post ) {
	$event_date = get_post_meta( $post->ID, '_hcfw_event_date', true );
	$all_day = get_post_meta( $post->ID, '_hcfw_event_all_day', true );
	$start_time = get_post_meta( $post->ID, '_hcfw_event_start_time', true );
	$end_time = get_post_meta( $post->ID, '_hcfw_event_end_time', true );
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="hcfw_event_date"><?php _e( 'Date', 'csu-hcfw-resources' ); ?></label>
				</th>
				<td>
					<input name="hcfw_event_date" id="hcfw_event_date" type="date" value="<?php echo esc_attr( $event_date ); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="hcfw_event_all_day"><?php _e( 'All Day Event', 'csu-hcfw-resources' ); ?></label></th>
				<td>
					<input type="checkbox" id="hcfw_event_all_day" name="hcfw_event_all_day" <?php checked( $all_day ); ?>>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hcfw_event_start_time"><?php _e( 'Start Time', 'csu-hcfw-resources' ); ?></label>
				</th>
				<td>
					<input name="hcfw_event_start_time" id="hcfw_event_start_time" type="time" value="<?php echo esc_attr( $start_time ); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hcfw_event_end_time"><?php _e( 'End Time', 'csu-hcfw-resources' ); ?></label>
				</th>
				<td>
					<input name="hcfw_event_end_time" id="hcfw_event_end_time" type="time" value="<?php echo esc_attr( $end_time ); ?>">
				</td>
			</tr>
		</tbody>
	</table>
<?php
}

function hcfw_event_save_day_time_postdata( $post_id ) {
	if ( isset( $_POST['hcfw_event_date'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_date',
			sanitize_text_field( $_POST['hcfw_event_date'] )
		);
	}

	if ( isset( $_POST['hcfw_event_all_day'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_all_day',
			true
		);

		update_post_meta(
			$post_id,
			'_hcfw_event_start_time',
			'00:00'
		);

		update_post_meta(
			$post_id,
			'_hcfw_event_end_time',
			''
		);
	} else {
		update_post_meta(
			$post_id,
			'_hcfw_event_all_day',
			false
		);

		if ( isset( $_POST['hcfw_event_start_time'] ) ) {
			update_post_meta(
				$post_id,
				'_hcfw_event_start_time',
				sanitize_text_field( $_POST['hcfw_event_start_time'] )
			);
		}

		if ( isset( $_POST['hcfw_event_end_time'] ) ) {
			update_post_meta(
				$post_id,
				'_hcfw_event_end_time',
				sanitize_text_field( $_POST['hcfw_event_end_time'] )
			);
		}
	}
}
add_action( 'save_post', 'hcfw_event_save_day_time_postdata' );


/* Event Links */
function hcfw_event_links_html( $post ) {
	$website = get_post_meta( $post->ID, '_hcfw_event_website', true );
	$tickets = get_post_meta( $post->ID, '_hcfw_event_tickets', true );
	$register = get_post_meta( $post->ID, '_hcfw_event_register', true );
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="hcfw_event_website"><?php _e( 'Website', 'csu-hcfw-resources' ); ?></label>
				</th>
				<td>
					<input name="hcfw_event_website" id="hcfw_event_website" type="url" class="regular-text" value="<?php echo esc_url( $website ); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hcfw_event_tickets"><?php _e( 'Tickets', 'csu-hcfw-resources' ); ?></label>
				</th>
				<td>
					<input name="hcfw_event_tickets" id="hcfw_event_tickets" type="url" class="regular-text" value="<?php echo esc_url( $tickets ); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hcfw_event_register"><?php _e( 'Registration', 'csu-hcfw-resources' ); ?></label>
				</th>
				<td>
					<input name="hcfw_event_register" id="hcfw_event_register" type="url" class="regular-text" value="<?php echo esc_url( $register ); ?>">
				</td>
			</tr>
		</tbody>
	</table>
<?php
}

function hcfw_event_save_links_postdata( $post_id ) {
	if ( isset( $_POST['hcfw_event_website'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_website',
			sanitize_text_field( $_POST['hcfw_event_website'] )
		);
	}

	if ( isset( $_POST['hcfw_event_tickets'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_tickets',
			$_POST['hcfw_event_tickets']
		);
	}

	if ( isset( $_POST['hcfw_event_register'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_register',
			$_POST['hcfw_event_register']
		);
	}
}
add_action( 'save_post', 'hcfw_event_save_links_postdata' );


/* Event Submitter */
function hcfw_event_submitter_html( $post ) {
	$eID = get_post_meta( $post->ID, '_hcfw_submit_name', true );
	$dept = get_post_meta( $post->ID, '_hcfw_submit_dept', true );
	$email = get_post_meta( $post->ID, '_hcfw_submit_email', true );
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><?php _e( 'eID', 'csu-hcfw-resources' ); ?></th>
				<td><?php echo esc_attr( $eID ); ?></td>
			</tr>
			<tr>
				<th scope="row"><?php _e( 'Department', 'csu-hcfw-resources' ); ?></th>
				<td><?php echo esc_attr( $dept ); ?></td>
			</tr>
			<tr>
				<th scope="row"><?php _e( 'Email', 'csu-hcfw-resources' ); ?></th>
				<td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></td>
			</tr>
		</tbody>
	</table>
<?php
}


/* Event Type */
function hcfw_event_type_html( $post ) {
	$reunion = get_post_meta( $post->ID, '_hcfw_event_reunion', true );
?>
	<table>
		<tr>
			<td>
				<input type="checkbox" id="hcfw_event_reunion" name="hcfw_event_reunion" <?php checked( $reunion ); ?>>
				<label for="hcfw_event_reunion"><?php _e( 'Reunion', 'csu-hcfw-resources' ); ?></label>
			</td>
		</tr>
	</table>
<?php
}

function hcfw_event_save_type_postdata( $post_id ) {
	if ( isset( $_POST['hcfw_event_reunion'] ) ) {
		update_post_meta(
			$post_id,
			'_hcfw_event_reunion',
			true
		);
	} else {
		update_post_meta(
			$post_id,
			'_hcfw_event_reunion',
			false
		);
	}
}
add_action( 'save_post', 'hcfw_event_save_type_postdata' );


function hcfw_metabox_order( $order ) {
	return array(
		'normal' => join( ",", array(
			'hcfw_event_details',
			'hcfw_event_day_time',
			'hcfw_event_links',
			'hcfw_event_submitter'
		) )
	);
}
add_filter( 'get_user_option_meta-box-order_hcfw_event', 'hcfw_metabox_order' );






function set_custom_edit_hcfw_event_columns( $columns ) {
	// remove Date column from current position
	$date = $columns['date'];
	unset( $columns['date'] );

	// add custom columns
	$columns['reunion'] = __( 'Event Type', 'csu-hcfw-resources' );
	$columns['event_date'] = __( 'Event Date', 'csu-hcfw-resources' );

	// reinsert Date column at final position
	$columns['date'] = $date;

	return $columns;
}
add_filter( 'manage_hcfw_event_posts_columns', 'set_custom_edit_hcfw_event_columns' );


function custom_hcfw_event_column( $column, $post_id ) {
  	switch ( $column ) {
		// display a list of the custom taxonomy terms assigned to the post
		case 'reunion' :
			$reunion = get_post_meta( $post_id, '_hcfw_event_reunion', true );
			echo ( $reunion ) ? 'Reunion' : '—';
			break;
		case 'event_date' :
			$event_date = get_post_meta( $post_id, '_hcfw_event_date', true );
			echo ( $event_date ) ? date( 'Y/m/d', strtotime( $event_date ) ) : '—';
			break;
	}
}
add_action( 'manage_hcfw_event_posts_custom_column' , 'custom_hcfw_event_column', 10, 2 );


function set_custom_hcfw_event_sortable_columns( $columns ) {
	$columns['reunion'] = 'reunion';
	$columns['event_date'] = 'event_date';

	return $columns;
}
add_filter( 'manage_edit-hcfw_event_sortable_columns', 'set_custom_hcfw_event_sortable_columns' );


function hcfw_event_custom_orderby( $query ) {
	if ( ! is_admin() ) return;

	$orderby = $query->get( 'orderby');

	if ( 'reunion' == $orderby ) {
		$query->set( 'meta_key', '_hcfw_event_reunion' );
		$query->set( 'orderby', 'meta_value_num' );
	}
}
add_action( 'pre_get_posts', 'hcfw_event_custom_orderby' );
