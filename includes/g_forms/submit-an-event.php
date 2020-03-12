<?php
function submit_an_event( $entry, $form ) {
	if ( strtolower($form['title']) != 'submit an event' ) {
		return;
	}

	$event_to_add = array(
		'post_type'    => 'hcfw_event',
		'post_content' => ''
	);

	$event_meta = array();

	foreach ( $form['fields'] as $field ) {
		$input_val = '';

		if ( $field['adminLabel'] == '_hcfw_event_name' ) {
			$event_to_add['post_title'] = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == '_hcfw_event_desc' ) {
			$event_to_add['post_content'] = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == 'hcfw_event_location' ) {
			$event_location = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == 'location_name' ) {
			$location_name = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == 'location_address' ) {
			$location_address = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == 'hcfw_event_organization' ) {
			$event_organization = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == 'organization_name' ) {
			$organization_name = sanitize_text_field( $entry[$field['id']] );
		} elseif ( $field['adminLabel'] == 'hcfw_event_audience' ) {
			$audiences = array();
			$selections = $field['inputs'];
			foreach( $selections as $selection ) {
				if ( $value = $entry[$selection['id']] ) {
					$audiences[] = sanitize_text_field( $value );
				}
			}
		} elseif ( $field['adminLabel'] == '_hcfw_event_reunion' ) {
			$reunion = ( $entry[$field['id']] == 'Yes' ) ? true : false;
		} elseif ( $field['adminLabel'] == '_hcfw_event_all_day' ) {
			$all_day = ( $entry[$field['id']] == 'Yes' ) ? true : false;
		} elseif ( $field['type'] == 'time' ) {
			if ( !empty( $time = $entry[$field['id']] ) ) {
				$input_val = date( "H:i", strtotime( $time ) );
			}
		} elseif ( $field['type'] == 'textarea' ) {
			$input_val = sanitize_textarea_field( $entry[$field['id']] );
		} elseif ( $field['type'] == 'email' ) {
			$input_val = sanitize_email( $entry[$field['id']] );
		} else {
			$input_val = sanitize_text_field( $entry[$field['id']] );
		}

		if ( !empty($input_val) ) {
			$event_meta[$field['adminLabel']] = $input_val;
		}
	}

	$event_to_add['meta_input'] = $event_meta;

	$event_id = wp_insert_post( $event_to_add );
	if ( !is_wp_error( $event_id ) ) {
		// update checkbox meta fields
		update_post_meta( $event_id, '_hcfw_event_reunion', $reunion );
		update_post_meta( $event_id, '_hcfw_event_all_day', $all_day );

		if ( $all_day ) {
			update_post_meta( $event_id, '_hcfw_event_start_time', date( "H:i", strtotime('00:00') ) );
			update_post_meta( $event_id, '_hcfw_event_end_time', '' );
		}

		// set Organization
		if ( $event_organization == 'add-new' ) {
			$organization = wp_set_object_terms( $event_id, $organization_name, 'hcfw_event_organization' );
		} else {
			wp_set_object_terms( $event_id, $event_organization, 'hcfw_event_organization' );
		}

		// set Location
		if ( $event_location == 'add-new' ) {
			$location = wp_set_object_terms( $event_id, $location_name, 'hcfw_event_location' );

			if ( !is_wp_error( $location ) && !empty( $location_address ) ) {
				update_term_meta( $location[0], '_location_address', $location_address );
			}
		} else {
			wp_set_object_terms( $event_id, $event_location, 'hcfw_event_location' );
		}

		// set Audience
		wp_set_object_terms( $event_id, $audiences, 'hcfw_event_audience' );
	}
}
add_action( 'gform_after_submission', 'submit_an_event', 10, 2 );
