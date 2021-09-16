<?php

/**
 * Function sp_po_insert_protocol
 *
 * @param  mixed $args
 * @return int|WP_Error
 */
function sp_po_insert_protocol( $args = array() ) {
	global $wpdb;

	if ( empty( $args['name'] ) ) {
		return new \WP_Error( 'no-name', __( 'You must provide a name', 'sponsor-portal' ) );
	}

	$defaults = array(
		'name'       => '',
		'address'    => '',
		'phone'      => '',
		'created_by' => get_current_user_id(),
		'created_at' => current_time( 'mysql' ),
	);
	$data     = wp_parse_args( $args, $defaults );
	$format   = array( '%s', '%s', '%s', '%d', '%s' );

	if ( isset( $data['id'] ) ) {
		$id      = $data['id'];
		$updated = $wpdb->update(
			"{$wpdb->prefix}sponsor_protocol",
			$data,
			array( 'id' => $id ),
			$format,
			array( '%d' )
		);
		return $updated;
	} else {
		$inserted = $wpdb->insert(
			"{$wpdb->prefix}sponsor_protocol",
			$data,
			$format
		);

		if ( ! $inserted ) {
			return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'sponsor-portal' ) );
		}
	}

	return $wpdb->insert_id;
}


function sp_po_get_protocols( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'number'  => 20,
		'offset'  => 0,
		'orderby' => 'id',
		'order'   => 'ASC',
	);

	$args = wp_parse_args( $args, $defaults );

	$items = $wpdb->get_results(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sponsor_protocol ORDER BY {$args['orderby']} {$args['order']} LIMIT %d, %d", $args['offset'], $args['number'] )
	);

	return $items;
}

function sp_po_protocol_count() {
	global $wpdb;
	return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}sponsor_protocol" );
}

function sp_po_get_protocol( $id ) {
	global $wpdb;
	return $wpdb->get_row(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sponsor_protocol WHERE id = %d", $id )
	);
}

function sp_po_delete_protocol( $id ) {
	global $wpdb;
	return $wpdb->delete( $wpdb->prefix . 'sponsor_protocol', array( 'id' => $id ), array( '%d' ) );
}
