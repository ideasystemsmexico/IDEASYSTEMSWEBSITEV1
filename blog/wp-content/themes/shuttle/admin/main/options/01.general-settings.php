<?php
/**
 * General settings functions.
 *
 * @package ShuttleThemes
 */

/* ----------------------------------------------------------------------------------
	Logo Settings
---------------------------------------------------------------------------------- */

function shuttle_custom_logo() {

	$output = NULL;

    // Get logo image url if image has been assigned.
	$check_logoset = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

	if ( ! empty( $check_logoset[0] ) ) {
	   if ( function_exists( 'the_custom_logo' ) ) {
			$output = get_custom_logo();
		}
	} else {
		$output .= '<a rel="home" href="' . esc_url( home_url( '/' ) ) . '">';
		$output .= '<h1 rel="home" class="site-title" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</h1>';
		$output .= '<h2 class="site-description" title="' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '">' . esc_html( get_bloginfo( 'description' ) ) . '</h2>';
		$output .= '</a>';
	}

	// Output logo is set
	if ( ! empty( $output ) ) {
		return $output;
	}
}


/* ----------------------------------------------------------------------------------
	Page Layout
---------------------------------------------------------------------------------- */

/* Add Custom Sidebar css */
function shuttle_sidebar_css($classes) {

// Get theme options values.
$shuttle_homepage_layout = shuttle_var ( 'shuttle_homepage_layout' );
$shuttle_general_layout  = shuttle_var ( 'shuttle_general_layout' );
$shuttle_blog_layout     = shuttle_var ( 'shuttle_blog_layout' );
$shuttle_post_layout     = shuttle_var ( 'shuttle_post_layout' );

	$class_sidebar = NULL;

	if ( is_front_page() ) {
		if ( $shuttle_homepage_layout == "option1" or empty( $shuttle_homepage_layout ) ) {		
			$class_sidebar = '';
		} else if ( $shuttle_homepage_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $shuttle_homepage_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		}
	} else if ( is_page() and ! is_page_template( 'template-blog.php' ) ) {	
		if ( $shuttle_general_layout == "option1" or empty( $shuttle_general_layout ) ) {		
			$class_sidebar = '';
		} else if ( $shuttle_general_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $shuttle_general_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		}
	} else if ( shuttle_check_isblog() and ! is_single() ) {
		if ( $shuttle_blog_layout == "option1" or empty( $shuttle_blog_layout ) ) {		
			$class_sidebar = '';
		} else if ( $shuttle_blog_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $shuttle_blog_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		}
	} else if ( is_singular( 'post' ) ) {
		if ( $shuttle_post_layout == "option1" or empty( $shuttle_post_layout ) ) {		
			$class_sidebar = '';
		} else if ( $shuttle_post_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $shuttle_post_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		} else {
			$class_sidebar = '';
		}
	} else if ( is_search() ) {
		if ( $shuttle_general_layout == "option1" or empty( $shuttle_general_layout ) ) {		
			$class_sidebar = '';
		} else if ( $shuttle_general_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ($shuttle_general_layout == "option3") {
			$class_sidebar = 'layout-sidebar-right';
		}
	}

	// Output sidebar class
	if( ! empty( $class_sidebar ) ) {
		$classes[] = $class_sidebar;
	} else {
		$classes[] = 'layout-sidebar-none';
	}
	return $classes;
}
add_action( 'body_class', 'shuttle_sidebar_css' );

/* Add Custom Sidebar html */
function shuttle_sidebar_html() {

// Get theme options values.
$shuttle_homepage_layout = shuttle_var ( 'shuttle_homepage_layout' );
$shuttle_general_layout  = shuttle_var ( 'shuttle_general_layout' );
$shuttle_blog_layout     = shuttle_var ( 'shuttle_blog_layout' );
$shuttle_post_layout     = shuttle_var ( 'shuttle_post_layout' );

do_action('shuttle_sidebar_html');

	if ( is_front_page() ) {	
		if ( $shuttle_homepage_layout == "option1" or empty( $shuttle_homepage_layout ) ) {		
				echo '';
		} else if ( $shuttle_homepage_layout == "option2" ) {
				echo get_sidebar(); 
		} else if ( $shuttle_homepage_layout == "option3" ) {
				echo get_sidebar();
		}
	} else if ( is_page() ) {	
		if ( $shuttle_general_layout == "option1" or empty( $shuttle_general_layout ) ) {		
			echo '';
		} else if ( $shuttle_general_layout == "option2" ) {
			echo get_sidebar();
		} else if ( $shuttle_general_layout == "option3" ) {
			echo get_sidebar();
		}
	} else if ( shuttle_check_isblog() and ! is_single() ) {
		if ( $shuttle_blog_layout == "option1" or empty( $shuttle_blog_layout ) ) {		
			echo '';
		} else if ( $shuttle_blog_layout == "option2" ) {
			echo get_sidebar();
		} else if ( $shuttle_blog_layout == "option3" ) {
			echo get_sidebar();
		}
	} else if ( is_singular( 'post' ) ) {
		if ( $shuttle_post_layout == "option1" or empty( $shuttle_post_layout ) ) {
			echo '';
		} else if ( $shuttle_post_layout == "option2" ) {
			echo get_sidebar();
		} else if ( $shuttle_post_layout == "option3" ) {
			echo get_sidebar();
		} else {
			echo '';
		}
	} else if ( is_search() ) {	
		if ( $shuttle_general_layout == 'option1' or empty( $shuttle_general_layout ) ) {		
			echo '';
		} else if ( $shuttle_general_layout == "option2" ) {
			get_sidebar();
		} else if ( $shuttle_general_layout == "option3" ) {
			get_sidebar();
		}
	}
}


/* ----------------------------------------------------------------------------------
	Select a Sidebar
---------------------------------------------------------------------------------- */

/* Add Selected Sidebar To Specific Pages */
function shuttle_input_sidebars() {

// Get theme options values.
$shuttle_general_sidebars  = shuttle_var ( 'shuttle_general_sidebars' );
$shuttle_homepage_sidebars = shuttle_var ( 'shuttle_homepage_sidebars' );
$shuttle_blog_sidebars     = shuttle_var ( 'shuttle_blog_sidebars' );
$shuttle_post_sidebars     = shuttle_var ( 'shuttle_post_sidebars' );

	if ( is_front_page() ) {
		$output = esc_attr( $shuttle_homepage_sidebars );
	} else if ( is_page() and ! is_page_template( 'template-blog.php' ) ) {
		$output = $shuttle_general_sidebars;
	} else if ( is_page_template( 'template-blog.php' ) ) {
		$output = $shuttle_blog_sidebars;
	} else if ( shuttle_check_isblog() and ! is_single() ) {
		$output = $shuttle_blog_sidebars;
	} else if ( is_singular( 'post' ) ) {
		$output = $shuttle_post_sidebars;
	} else if ( is_search() ) {	
		$output = $shuttle_general_sidebars;
	}

	if ( empty( $output ) or $output == 'Select a sidebar:' ) {
		$output = 'Sidebar';
	}

	return $output;
}


/* ----------------------------------------------------------------------------------
	Intro Default options
---------------------------------------------------------------------------------- */

/* Add custom intro section [Extend for more options in future update] */
function shuttle_custom_intro() {

// Get theme options values.
$shuttle_general_introswitch      = shuttle_var ( 'shuttle_general_introswitch' );
$shuttle_general_breadcrumbswitch = shuttle_var ( 'shuttle_general_breadcrumbswitch' );

$class_intro = NULL;

	if ( ! is_front_page() ) {

		// Determine if breadcrumb is enables. Ensures table-cells align correctly with css
		if ( $shuttle_general_breadcrumbswitch == '1' ) {
			$class_intro = 'option2';
		} else {
			$class_intro = 'option1';	
		}

		// If no breadcrumbs are available on current page then change intro class to option1
		if ( shuttle_input_breadcrumbswitch() == '' ) { 
			$class_intro = 'option1'; 
		}

		// Output intro with breadcrumbs if set
		if ( empty( $shuttle_general_introswitch ) or $shuttle_general_introswitch == '1' ) {
			echo	'<div id="intro" class="' . esc_attr( $class_intro ) . '"><div class="wrap-safari"><div id="intro-core">',
					'<h1 class="page-title">',
					shuttle_title_select(),
					'</h1>',
					shuttle_input_breadcrumbswitch(),
					'</div></div></div>';
		}
	}
}

//Output header above slider - Experon specific
function shuttle_custom_introabove() {

// Get theme options values.
$shuttle_header_styleswitch    = shuttle_var ( 'shuttle_header_styleswitch' );
$shuttle_header_locationswitch = shuttle_var ( 'shuttle_header_locationswitch' );

	if ( ( empty( $shuttle_header_styleswitch ) or $shuttle_header_styleswitch == 'option1' ) and $shuttle_header_locationswitch == 'option2' ) {
		return;
	} else {
		shuttle_custom_intro();	
	}
}

//Output header below slider - Experon specific
function shuttle_custom_introbelow() {

// Get theme options values.
$shuttle_header_styleswitch    = shuttle_var ( 'shuttle_header_styleswitch' );
$shuttle_header_locationswitch = shuttle_var ( 'shuttle_header_locationswitch' );

	if ( ( empty( $shuttle_header_styleswitch ) or $shuttle_header_styleswitch == 'option1' ) and $shuttle_header_locationswitch == 'option2' ) {
		shuttle_custom_intro();	
	}
}

/* Add custom intro class - Determine whether intro is enabled or disabled */
function shuttle_custom_introclass($classes) {

	if ( ! is_front_page() ) {
		$classes[] = 'intro-on';
	}

	return $classes;
}
add_action( 'body_class', 'shuttle_custom_introclass');


/* ----------------------------------------------------------------------------------
	Enable Breadcrumbs
---------------------------------------------------------------------------------- */

/* Toggle Breadcrumbs */
function shuttle_input_breadcrumbswitch() {

// Get theme options values.
$shuttle_general_breadcrumbswitch = shuttle_var ( 'shuttle_general_breadcrumbswitch' );

	if( ! is_front_page() ) {
		if ( $shuttle_general_breadcrumbswitch == '0' or empty( $shuttle_general_breadcrumbswitch ) ) {
			return '';
		} else if ( $shuttle_general_breadcrumbswitch == '1' ) {
			return shuttle_input_breadcrumb();
		}
	}
}


/* ----------------------------------------------------------------------------------
	Enable Responsive Layout
---------------------------------------------------------------------------------- */

/* http://wordpress.stackexchange.com/questions/27497/how-to-use-wp-nav-menu-to-create-a-select-menu-dropdown */
class shuttle_nav_menu_responsive extends Walker_Nav_Menu{

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="res-menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) .'"' : '';

        // Insert title for top level
		$title = ( $depth == 0 )
			? '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' : apply_filters( 'the_title', $item->title, $item->ID );

        // Insert sub-menu titles
		if ( $depth > 0 ) {
			$title = str_repeat('&#45; ', $depth ) . $item->title;
		}

        // Structure of output
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Fallback responsive menu when custom header menu has not been set.
function shuttle_input_responsivefall() {

	$output = wp_list_pages('echo=0&title_li=');

	echo '<div id="header-responsive-inner" class="responsive-links nav-collapse collapse"><ul>',
		 $output,
		 '</ul></div>';
}

function shuttle_input_responsivehtml1() {

// Get theme options values.
$shuttle_general_fixedlayoutswitch = shuttle_var ( 'shuttle_general_fixedlayoutswitch' );

	if ( $shuttle_general_fixedlayoutswitch !== '1' ) {

		echo '<div id="header-nav">',
		     '<a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse" tabindex="0">',
		     '<span class="icon-bar"></span>',
		     '<span class="icon-bar"></span>',
		     '<span class="icon-bar"></span>',
		     '</a>',
		     '</div>';
	}
}

function shuttle_input_responsivehtml2() {

// Get theme options values.
$shuttle_general_fixedlayoutswitch = shuttle_var ( 'shuttle_general_fixedlayoutswitch' );

	if ( $shuttle_general_fixedlayoutswitch !== '1' ) {

		echo '<div id="header-responsive">',
		     wp_nav_menu( 
				array(
					'container_class' => 'responsive-links nav-collapse collapse', 
					'container_id'    => 'header-responsive-inner', 
					'menu_class'      => '', 
					'theme_location'  => 'header_menu', 
					'walker'          => new shuttle_nav_menu_responsive(), 
					'fallback_cb'     => 'shuttle_input_responsivefall',
				)
			 ),
		     '</div>';
	}
}

function shuttle_input_responsivecss() {

// Get theme options values.
$shuttle_general_fixedlayoutswitch = shuttle_var ( 'shuttle_general_fixedlayoutswitch' );
	
	if ( $shuttle_general_fixedlayoutswitch !== '1' ) {
		wp_enqueue_style ( 'shuttle-responsive' );
	}
}
add_action( 'wp_enqueue_scripts', 'shuttle_input_responsivecss', '12' );

function shuttle_input_responsiveclass($classes){

// Get theme options values.
$shuttle_general_fixedlayoutswitch = shuttle_var ( 'shuttle_general_fixedlayoutswitch' );

	if ( $shuttle_general_fixedlayoutswitch == '1' ) {
		$classes[] = 'layout-fixed';
	} else {
		$classes[] = 'layout-responsive';	
	}
	return $classes;
}
add_action( 'body_class', 'shuttle_input_responsiveclass');


?>