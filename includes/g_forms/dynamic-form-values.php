<?php
function hcfw_select_location( $form ) {
	if ( strtolower($form['title']) != 'submit an event' ) {
		return $form;
	}

	foreach ( $form['fields'] as $field ) {
		if ( $field->type != 'select' || strpos( $field->cssClass, 'select-location' ) === false ) {
			continue;
		}

		$terms = get_terms( array(
			'taxonomy'   => 'hcfw_event_location',
			'hide_empty' =>  false
		) );

		$choices = array();

		foreach ( $terms as $term ) {
			$choices[] = array(
				'text'  => $term->name,
				'value' => $term->slug
			);
		}

		$choices[] = array(
			'text'  => 'Add New Location',
			'value' => 'add-new'
		);

		$field->placeholder = 'Select a Location';
		$field->choices = $choices;
	}

	return $form;
}
add_filter( 'gform_pre_render', 'hcfw_select_location' );
add_filter( 'gform_pre_validation', 'hcfw_select_location' );
add_filter( 'gform_pre_submission_filter', 'hcfw_select_location' );
add_filter( 'gform_admin_pre_render', 'hcfw_select_location' );


function hcfw_select_organization( $form ) {
	if ( strtolower($form['title']) != 'submit an event' ) {
		return $form;
	}

	foreach ( $form['fields'] as $field ) {
		if ( $field->type != 'select' || strpos( $field->cssClass, 'select-organization' ) === false ) {
			continue;
		}

		$terms = get_terms( array(
			'taxonomy'   => 'hcfw_event_organization',
			'hide_empty' =>  false
		) );

		$choices = array();

		foreach ( $terms as $term ) {
			$choices[] = array(
				'text'  => $term->name,
				'value' => $term->slug
			);
		}

		$choices[] = array(
			'text'  => 'Add New Organization',
			'value' => 'add-new'
		);

		$field->placeholder = 'Select an Organization';
		$field->choices = $choices;
	}

	return $form;
}
add_filter( 'gform_pre_render', 'hcfw_select_organization' );
add_filter( 'gform_pre_validation', 'hcfw_select_organization' );
add_filter( 'gform_pre_submission_filter', 'hcfw_select_organization' );
add_filter( 'gform_admin_pre_render', 'hcfw_select_organization' );


function hcfw_select_audience( $form ) {
	if ( strtolower($form['title']) != 'submit an event' ) {
		return $form;
	}

	foreach ( $form['fields'] as $field ) {
		if ( $field->type != 'checkbox' || strpos( $field->cssClass, 'select-audience' ) === false ) {
			continue;
		}

		$terms = get_terms( array(
			'taxonomy'   => 'hcfw_event_audience',
			'hide_empty' =>  false
		) );

		$choices = array();

		foreach ( $terms as $term ) {
			$choices[] = array(
				'text'  => $term->name,
				'value' => $term->slug
			);
		}

		$field->choices = $choices;
	}

	return $form;
}
add_filter( 'gform_pre_render', 'hcfw_select_audience' );
add_filter( 'gform_pre_validation', 'hcfw_select_audience' );
add_filter( 'gform_pre_submission_filter', 'hcfw_select_audience' );
add_filter( 'gform_admin_pre_render', 'hcfw_select_audience' );
