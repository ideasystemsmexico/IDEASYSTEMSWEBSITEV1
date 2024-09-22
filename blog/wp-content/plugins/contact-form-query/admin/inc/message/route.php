<?php
defined( 'ABSPATH' ) || die();

$action = '';
if ( isset( $_GET['action'] ) && ! empty( $_GET['action'] ) ) {
	$action = sanitize_text_field( $_GET['action'] );
}

if ( 'view' === $action && isset( $_GET['id'] ) ) {
	require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/view.php';
} else {
	require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/index.php';
}
