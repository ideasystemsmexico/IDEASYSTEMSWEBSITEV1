<?php
/**
 * Footer functions.
 *
 * @package ShuttleThemes
 */

/* ----------------------------------------------------------------------------------
	FOOTER WIDGETS LAYOUT
---------------------------------------------------------------------------------- */

/* Assign function for widget area 1 */
function shuttle_input_footerw1() {
	echo	'<div id="footer-col1" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w1' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 1.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 2 */
function shuttle_input_footerw2() {
	echo	'<div id="footer-col2" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w2' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 2.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 3 */
function shuttle_input_footerw3() {
	echo	'<div id="footer-col3" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w3' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 3.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 4 */
function shuttle_input_footerw4() {
	echo	'<div id="footer-col4" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w4' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 4.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 5 */
function shuttle_input_footerw5() {
	echo	'<div id="footer-col5" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w5' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 5.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 6 */
function shuttle_input_footerw6() {
	echo	'<div id="footer-col6" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w6' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 6.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}


/* Add Custom Footer Layout */
function shuttle_input_footerlayout() {	

// Get theme options values.
$shuttle_footer_layout       = shuttle_var ( 'shuttle_footer_layout' );
$shuttle_footer_widgetswitch = shuttle_var ( 'shuttle_footer_widgetswitch' );

	if ( $shuttle_footer_widgetswitch != "1" and ! empty( $shuttle_footer_layout )  ) {
		echo	'<div id="footer">';
			if ( $shuttle_footer_layout == "option1" ) {
				echo	'<div id="footer-core" class="option1">';
						shuttle_input_footerw1();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option2" ) {
				echo	'<div id="footer-core" class="option2">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option3" ) {
				echo	'<div id="footer-core" class="option3">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option4" ) {
				echo	'<div id="footer-core" class="option4">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option5" ) {
				echo	'<div id="footer-core" class="option5">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
						shuttle_input_footerw5();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option6" ) {
				echo	'<div id="footer-core" class="option6">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
						shuttle_input_footerw5();
						shuttle_input_footerw6();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option7" ) {
				echo	'<div id="footer-core" class="option7">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option8" ) {
				echo	'<div id="footer-core" class="option8">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option9" ) {
				echo	'<div id="footer-core" class="option9">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option10" ) {
				echo	'<div id="footer-core" class="option10">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option11" ) {
				echo	'<div id="footer-core" class="option11">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option12" ) {
				echo	'<div id="footer-core" class="option12">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option13" ) {
				echo	'<div id="footer-core" class="option13">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option14" ) {
				echo	'<div id="footer-core" class="option14">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option15" ) {
				echo	'<div id="footer-core" class="option15">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option16" ) {
				echo	'<div id="footer-core" class="option16">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option17" ) {
				echo	'<div id="footer-core" class="option17">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
						shuttle_input_footerw5();
				echo	'</div>';
			} else if ( $shuttle_footer_layout == "option18" ) {
				echo	'<div id="footer-core" class="option18">';
						shuttle_input_footerw1();
						shuttle_input_footerw2();
						shuttle_input_footerw3();
						shuttle_input_footerw4();
						shuttle_input_footerw5();

				echo	'</div>';
			}
		echo	'</div>';
	}
}


/* ----------------------------------------------------------------------------------
	SUB-FOOTER WIDGETS LAYOUT
---------------------------------------------------------------------------------- */

/* Assign function for widget area 1 */
function shuttle_input_subfooterw1() {
	echo	'<div id="sub-footer-col1" class="widget-area">';
	if ( ! dynamic_sidebar( 'sub-footer-w1' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 1.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 2 */
function shuttle_input_subfooterw2() {
	echo	'<div id="sub-footer-col2" class="widget-area">';
	if ( ! dynamic_sidebar( 'sub-footer-w2' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'shuttle') . '</h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 2.', 'shuttle') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'shuttle' ) . '">' . __( 'Click here to go to Widget area.', 'shuttle') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Add Custom Sub-Footer Layout */
function shuttle_input_subfooterlayout() {	

// Get theme options values.
$shuttle_subfooter_layout       = shuttle_var ( 'shuttle_subfooter_layout' );
$shuttle_subfooter_widgetswitch = shuttle_var ( 'shuttle_subfooter_widgetswitch' );
$shuttle_subfooter_widgetclose  = shuttle_var ( 'shuttle_subfooter_widgetclose' );

	if ( $shuttle_subfooter_widgetswitch !== "1" and ! empty( $shuttle_subfooter_layout )  ) {

		// Output sub-footer widgets close button
		if ( $shuttle_subfooter_widgetclose == '1' ) {
			echo '<div id="sub-footer-close"><div id="sub-footer-close-core"></div></div>';	
		}
		
		// Output sub-footer widgets
		if ( $shuttle_subfooter_layout == "option1" ) {
			echo	'<div id="sub-footer-widgets" class="option1">';
					shuttle_input_subfooterw1();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option2" ) {
			echo	'<div id="sub-footer-widgets" class="option2">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option3" ) {
			echo	'<div id="sub-footer-widgets" class="option3">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option4" ) {
			echo	'<div id="sub-footer-widgets" class="option4">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option5" ) {
			echo	'<div id="sub-footer-widgets" class="option5">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option6" ) {
			echo	'<div id="sub-footer-widgets" class="option6">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option7" ) {
			echo	'<div id="sub-footer-widgets" class="option7">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		} else if ( $shuttle_subfooter_layout == "option8" ) {
			echo	'<div id="sub-footer-widgets" class="option8">';
					shuttle_input_subfooterw1();
					shuttle_input_subfooterw2();
			echo	'</div>';
		}
	}
}


/* ----------------------------------------------------------------------------------
	SCROLL TO TOP
---------------------------------------------------------------------------------- */
function shuttle_input_footerscroll( $classes ) {

// Get theme options values.
$shuttle_footer_scroll = shuttle_var ( 'shuttle_footer_scroll' );

	if ( $shuttle_footer_scroll == '1' ) {
		$classes[] = 'scrollup-on';
	}
	return $classes;
}
add_action( 'body_class', 'shuttle_input_footerscroll');


/* ----------------------------------------------------------------------------------
	COPYRIGHT TEXT
---------------------------------------------------------------------------------- */

function shuttle_input_copyright() {

	printf( __( 'Developed by %1$s. Powered by %2$s.', 'shuttle' ) , '<a href="https://shuttlethemes.com/" target="_blank">Shuttle Themes</a>', '<a href="//www.wordpress.org/" target="_blank">WordPress</a>'); 
}


?>