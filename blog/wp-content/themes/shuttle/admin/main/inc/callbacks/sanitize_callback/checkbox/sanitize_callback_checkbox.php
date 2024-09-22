<?php
/**
 * Custom sanitisation callback - Checkbox.
 *
 * @package ShuttleThemes
 */

function shuttle_customizer_callback_sanitize_checkbox( $value ) {

	return ( ( isset( $value ) && true == $value ) ? true : false );
}