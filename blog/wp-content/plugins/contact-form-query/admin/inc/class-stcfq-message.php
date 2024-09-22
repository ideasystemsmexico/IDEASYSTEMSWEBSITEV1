<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

class STCFQ_Message {
	public static function load_more() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! wp_verify_nonce( $_POST['security'], 'paginate-messages' ) ) {
			die();
		}

		global $wpdb;

		$current_page   = isset( $_POST['cpage'] ) ? absint( $_POST['cpage'] ) : 1;
		$nonce_verified = true;
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/query.php';
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/load.php';
		die();
	}

	public static function delete() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		try {
			ob_start();
			global $wpdb;

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if ( ! wp_verify_nonce( $_POST[ 'delete-message-' . $id ], 'delete-message-' . $id ) ) {
				die();
			}

			// Checks if message exists.
			$message = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}stcfq_queries WHERE ID = %d", $id ) );

			if ( ! $message ) {
				throw new Exception( esc_html__( 'Message not found.', 'contact-form-query' ) );
			}

		} catch ( Exception $exception ) {
			$buffer = ob_get_clean();
			if ( ! empty( $buffer ) ) {
				$response = $buffer;
			} else {
				$response = $exception->getMessage();
			}
			wp_send_json_error( $response );
		}

		try {
			$success = $wpdb->delete( "{$wpdb->prefix}stcfq_queries", array( 'ID' => $id ) );
			$message = esc_html__( 'Message deleted successfully.', 'contact-form-query' );

			$exception = ob_get_clean();
			if ( ! empty( $exception ) ) {
				throw new Exception( $exception );
			}

			if ( false === $success ) {
				throw new Exception( $wpdb->last_error );
			}

			STCFQ_Helper::cache_unanswered_messages_count();

			wp_send_json_success( array( 'message' => $message ) );
		} catch ( Exception $exception ) {
			wp_send_json_error( $exception->getMessage() );
		}
	}

	public static function bulk_action() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! wp_verify_nonce( $_POST[ 'bulk-action' ], 'bulk-action' ) ) {
			die();
		}

		$action = isset( $_POST['bulk_action'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_action'] ) ) : '';
		$ids    = isset( $_POST['ids'] ) ? sanitize_text_field( wp_unslash( $_POST['ids'] ) ) : '';

		$ids = json_decode( $ids );

		if ( 'delete' === $action ) {
			try {
				ob_start();
				global $wpdb;

				if ( ! $ids || ! is_array( $ids ) ) {
					throw new Exception( esc_html__( 'Messages not found.', 'contact-form-query' ) );
				}

				$ids = array_map( 'absint', $ids );

			} catch ( Exception $exception ) {
				$buffer = ob_get_clean();
				if ( ! empty( $buffer ) ) {
					$response = $buffer;
				} else {
					$response = $exception->getMessage();
				}
				wp_send_json_error( $response );
			}

			try {
				$place_holders_ids = ( '%d' . str_repeat( ',%d', ( count( $ids ) - 1 ) ) );

				$ids_string = implode( ',', $ids );

				$success = $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}stcfq_queries WHERE ID IN (" . $place_holders_ids . ')', $ids ) );

				$message = esc_html__( 'Messages deleted successfully.', 'contact-form-query' );

				$exception = ob_get_clean();
				if ( ! empty( $exception ) ) {
					throw new Exception( $exception );
				}

				if ( false === $success ) {
					throw new Exception( $wpdb->last_error );
				} elseif ( 0 === $success ) {
					throw new Exception( esc_html__( 'Messages not found.', 'contact-form-query' ) );
				}

				STCFQ_Helper::cache_unanswered_messages_count();

				wp_send_json_success( array( 'message' => $message ) );
			} catch ( Exception $exception ) {
				wp_send_json_error( $exception->getMessage() );
			}
		}

		wp_send_json_error( esc_html__( 'Bulk action is not valid.', 'contact-form-query' ) );
	}

	public static function save_note() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		try {
			ob_start();
			global $wpdb;

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if ( ! wp_verify_nonce( $_POST[ 'save-note-' . $id ], 'save-note-' . $id ) ) {
				die();
			}

			// Checks if message exists.
			$message = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}stcfq_queries WHERE ID = %d", $id ) );

			if ( ! $message ) {
				throw new Exception( esc_html__( 'Message not found.', 'contact-form-query' ) );
			}

			$answered = isset( $_POST['answered'] ) ? (bool) $_POST['answered'] : false;
			$note     = isset( $_POST['note'] ) ? sanitize_text_field( $_POST['note'] ) : '';

		} catch ( Exception $exception ) {
			$buffer = ob_get_clean();
			if ( ! empty( $buffer ) ) {
				$response = $buffer;
			} else {
				$response = $exception->getMessage();
			}
			wp_send_json_error( $response );
		}

		try {
			$data = array(
				'answered'   => $answered,
				'note'       => $note,
				'updated_at' => STCFQ_Helper::now(),
			);

			$success = $wpdb->update( "{$wpdb->prefix}stcfq_queries", $data, array( 'ID' => $id ) );
			$message = esc_html__( 'Message status updated.', 'contact-form-query' );

			$buffer = ob_get_clean();
			if ( ! empty( $buffer ) ) {
				throw new Exception( $buffer );
			}

			if ( false === $success ) {
				throw new Exception( $buffer );
			}

			STCFQ_Helper::cache_unanswered_messages_count();

			wp_send_json_success( array( 'message' => $message ) );
		} catch ( Exception $exception ) {
			wp_send_json_error( $exception->getMessage() );
		}
	}

	public static function latest_messages() {
		if ( current_user_can( 'manage_options' ) ) {
			wp_add_dashboard_widget(
				'stcfq_latest_messages',
				esc_html__( 'Contact Form Latest Messages', 'contact-form-query' ),
				array( 'STCFQ_Message', 'latest_messages_widget' )
			);
		}
	}

	public static function latest_messages_widget() {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/latest.php';
	}

	public static function admin_enqueue_scripts() {
		if ( current_user_can( 'manage_options' ) ) {
			wp_register_style( 'stcfq-admin-dashboard', STCFQ_PLUGIN_URL . 'assets/css/stcfq-admin-dashboard.css', array(), STCFQ_PLUGIN_VERSION, 'all' );
			wp_enqueue_style( 'stcfq-admin-dashboard' );
			wp_style_add_data( 'stcfq-admin-dashboard', 'rtl', 'replace' );
		}
	}
}
