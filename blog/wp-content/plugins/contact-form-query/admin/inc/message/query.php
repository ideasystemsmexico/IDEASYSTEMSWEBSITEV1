<?php
defined( 'ABSPATH' ) || die();

/* Search and filters */
$filter             = '';
$filter_items_count = 0;
$place_vars         = array();
if ( ( isset( $nonce_verified ) || ( isset( $_POST['apply-filter'] ) && wp_verify_nonce( $_POST['apply-filter'], 'apply-filter' ) ) ) && isset( $_POST['search_key'] ) && isset( $_POST['search_value'] ) ) {
	if ( is_array( $_POST['search_key'] ) ) {
		$search_key = array_map( 'sanitize_text_field', $_POST['search_key'] );
		$search_key = array_intersect( $search_key, STCFQ_Helper::filter_list() );
	} else {
		$search_key = array();
	}

	$filter_items_count = count( $search_key );
	if ( $filter_items_count ) {
		$filter .= ' WHERE ';
		foreach ( $search_key as $key => $value ) {
			$search_field = sanitize_text_field( $value );
			$search_value = isset( $_POST['search_value'][ $key ] ) ? sanitize_text_field( $_POST['search_value'][ $key ] ) : '';

			if ( 'subject' === $search_field ) {
				if ( isset( $filter_subject_exist ) ) {
					$filter_subject .= ' OR subject LIKE %s';
				} else {
					$filter_subject       = 'subject LIKE %s';
					$filter_subject_exist = true;
				}
				$place_vars['subject'] = ( '%' . $wpdb->esc_like( $search_value ) . '%' );
			} elseif ( 'name' === $search_field ) {
				if ( isset( $filter_name_exist ) ) {
					$filter_name .= ' OR name LIKE %s';
				} else {
					$filter_name       = 'name LIKE %s';
					$filter_name_exist = true;
				}
				$place_vars['name'] = ( '%' . $wpdb->esc_like( $search_value ) . '%' );
			} elseif ( 'email' === $search_field ) {
				if ( isset( $filter_email_exist ) ) {
					$filter_email .= ' OR email LIKE %s';
				} else {
					$filter_email       = 'email LIKE %s';
					$filter_email_exist = true;
				}
				$place_vars['email'] = ( '%' . $wpdb->esc_like( $search_value ) . '%' );
			} elseif ( 'message' === $search_field ) {
				if ( isset( $filter_message_exist ) ) {
					$filter_message .= ' OR message LIKE %s';
				} else {
					$filter_message       = 'message LIKE %s';
					$filter_message_exist = true;
				}
				$place_vars['message'] = ( '%' . $wpdb->esc_like( $search_value ) . '%' );
			} elseif ( 'answered' === $search_field ) {
				if ( preg_match( '/^y/', strtolower( $search_value ) ) ) {
					$search_value = 1;
				} else {
					$search_value = 0;
				}

				if ( isset( $filter_answered_exist ) ) {
					$filter_answered .= ' OR answered = %d';
				} else {
					$filter_answered       = 'answered = %d';
					$filter_answered_exist = true;
				}
				$place_vars['answered'] = $search_value;
			} elseif ( 'note' === $search_field ) {
				if ( isset( $filter_note_exist ) ) {
					$filter_note .= ' OR note LIKE %s';
				} else {
					$filter_note       = 'note LIKE %s';
					$filter_note_exist = true;
				}
				$place_vars['note'] = ( '%' . $wpdb->esc_like( $search_value ) . '%' );
			}
		}

		$filter_queries = array();
		if ( isset( $filter_subject ) ) {
			array_push( $filter_queries, $filter_subject );
		}
		if ( isset( $filter_name ) ) {
			array_push( $filter_queries, $filter_name );
		}
		if ( isset( $filter_email ) ) {
			array_push( $filter_queries, $filter_email );
		}
		if ( isset( $filter_message ) ) {
			array_push( $filter_queries, $filter_message );
		}
		if ( isset( $filter_answered ) ) {
			array_push( $filter_queries, $filter_answered );
		}
		if ( isset( $filter_note ) ) {
			array_push( $filter_queries, $filter_note );
		}

		$filter .= implode(
			'AND',
			array_map(
				function ( $filter_query_string ) {
					return " ($filter_query_string) ";
				},
				$filter_queries
			)
		);
	}
}
/* End search and filters */

$query = "SELECT ID, subject, message, name, email, answered, created_at FROM {$wpdb->prefix}stcfq_queries$filter";
if ( count( $place_vars ) > 0 ) {
	$filtered   = array_intersect( array( 'subject', 'name', 'email', 'message', 'answered', 'note' ), array_keys( $place_vars ) );
	$place_vars = array_replace( array_flip( $filtered ), $place_vars );
	$query      = $wpdb->prepare( $query, $place_vars );
}
$total          = $wpdb->get_var( "SELECT COUNT(1) FROM ({$query}) AS combined_table" ); // This query is already prepared above.
$items_per_page = 25;
$offset         = ( $current_page * $items_per_page ) - $items_per_page;
$messages       = $wpdb->get_results( $wpdb->prepare( ( $query . ' ORDER BY ID DESC LIMIT %d, %d' ), $offset, $items_per_page ) );
$total_pages    = ceil( $total / $items_per_page );
