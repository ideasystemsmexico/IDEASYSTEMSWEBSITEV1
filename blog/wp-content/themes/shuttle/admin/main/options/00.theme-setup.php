<?php
/**
 * Theme setup functions.
 *
 * @package ShuttleThemes
 */

/* ----------------------------------------------------------------------------------
	BACKWARD COMPATIBILITY FOR WORDPRESS CORE FUNCTIONS
---------------------------------------------------------------------------------- */

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM HOOKS
//----------------------------------------------------------------------------------

// Used at top of header.php
function shuttle_hook_header() { 
	do_action('shuttle_hook_header');
}

// Used at top of header.php within the body tag
function shuttle_bodystyle() { 
	do_action('shuttle_bodystyle');
}

// Used after <body> tag in header.php
function shuttle_hook_bodyhtml() { 
	do_action('shuttle_hook_bodyhtml');
}



/* ----------------------------------------------------------------------------------
	ADD THEME PLUGINS - CREDIT ATTRIBUTABLE TO http://tgmpluginactivation.com/
---------------------------------------------------------------------------------- */

require_once( get_template_directory() . '/lib/plugins/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'shuttle_theme_register_required_plugins' );

function shuttle_theme_register_required_plugins() {

	// Array of plugin arrays. Required keys are name and slug.
	$plugins = array(
		array(
			'name'     => 'JustFeedback',
			'slug'     => 'feedfocal',
			'required' => false
		),
    );

	// Array of configuration settings. Amend each line as needed.
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}


//----------------------------------------------------------------------------------
//	ADD PAGE TITLE
//----------------------------------------------------------------------------------

function shuttle_title_select() {
	global $post;

	if ( is_page() ) {
		printf( '<span>%s</span>', esc_html( get_the_title() ) );
	} elseif ( is_attachment() ) {
		printf( '<span>' . __( 'Blog Post Image: ', 'shuttle' ) . '</span>' . '%s', esc_html( get_the_title( $post->post_parent ) ) );
	} else if ( is_single() ) {
		printf( '<span>%s</span>', html_entity_decode( esc_html( get_the_title() ) ) );
	} else if ( is_search() ) {
		printf( '<span><span>' . __( 'Search Results: ', 'shuttle' ) . '</span>' . '%s</span>', esc_html( get_search_query() ) );
	} else if ( is_404() ) {
		printf( '<span>' . __( 'Page Not Found', 'shuttle' ) . '</span>' );
	} elseif ( is_archive() ) {
		printf( get_the_archive_title() );
	} elseif ( is_tax() ) {
		printf( get_queried_object()->name );
	} elseif ( shuttle_check_isblog() ) {
		printf( '<span>' . __( 'Blog', 'shuttle' ) . '</span>' );
	} else {
		printf( '<span>%s</span>', html_entity_decode( esc_html( get_the_title() ) ) );
	}
}

// Remove "archive" text from custom post type archive pages
function shuttle_title_select_cpt($title) {
    if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'shuttle_title_select_cpt' );


//----------------------------------------------------------------------------------
//	ADD BREADCRUMBS FUNCTIONALITY
//----------------------------------------------------------------------------------

function shuttle_input_breadcrumb() {
global $post;

	$output           = NULL;
	$count_loop       = NULL;
	$count_categories = NULL;

	$delimiter = '<span class="delimiter">/</span>';

	$delimiter_inner   =   '<span class="delimiter_core"> &bull; </span>';
	$main              =   __( 'Home', 'shuttle' );
	$maxLength         =   30;

	/* Archive variables */
	$arc_year       =   get_the_time('Y');
	$arc_month      =   get_the_time('F');
	$arc_day        =   get_the_time('d');
	$arc_day_full   =   get_the_time('l');  

	/* URL variables */
	$url_year    =   get_year_link($arc_year);
	$url_month   =   get_month_link($arc_year,$arc_month);

	/* Display breadcumbs if NOT the home page */
	if ( ! is_front_page() ) {
		$output .= '<div id="breadcrumbs"><div id="breadcrumbs-core">';
		global $post, $cat;
		$homeLink = home_url( '/' );
		$output .= '<a href="' . esc_url( $homeLink ) . '">' . esc_html( $main ) . '</a>' . $delimiter;    

		/* Display breadcrumbs for single post */
		if ( is_single() ) {
			$category = get_the_category();
			$num_cat = count($category);
			if ($num_cat <=1) {
				$output .= ' ' . html_entity_decode( esc_html( get_the_title() ) );
			} else {

				// Count Total categories
				foreach( get_the_category() as $category) {
					$count_categories++;
				}
				
				// Output Categories
				foreach( get_the_category() as $category) {
					$count_loop++;

					if ( $count_loop < $count_categories ) {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>' . $delimiter_inner; 
					} else {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>'; 
					}
				}
				
				if (strlen(get_the_title()) >= $maxLength) {
					$output .=  ' ' . $delimiter . esc_html( trim( substr( get_the_title(), 0, $maxLength ) ) ) . ' &hellip;';
				} else {
					$output .=  ' ' . $delimiter . esc_html( get_the_title() );
				}
			}
		} elseif ( is_search() ) {
			$output .= __( 'Search Results for: ', 'shuttle' ) . esc_html( get_search_query() ) . '"';
		} elseif ( is_page() && !$post->post_parent ) {
			$output .=  esc_html( get_the_title() );
		} elseif ( is_page() && $post->post_parent ) {
			$post_array = get_post_ancestors( $post );
			krsort( $post_array ); 
			foreach( $post_array as $key=>$postid ){
				$post_ids = get_post( $postid );
				$title = $post_ids->post_title;
				$output  .= '<a href="' . esc_url( get_permalink( $post_ids ) ) . '">' . esc_html( $title ) . '</a>' . $delimiter;
			}
			$output .= esc_html( get_the_title() );
		} elseif ( is_404() ) {
			$output .= __( 'Error 404 - Not Found.', 'shuttle' );
		} elseif ( is_archive() ) {
			$output .= get_the_archive_title();
		} elseif( is_tax() ) {
			$output .= esc_html( get_queried_object()->name );
		} elseif ( shuttle_check_isblog() ) {
			$output .= __( 'Blog', 'shuttle' );
		} else {
			$output .= html_entity_decode( esc_html( get_the_title() ) );
		}

		$output .=  '</div></div>';

		return $output;
    }
}


/* ----------------------------------------------------------------------------------
	ADD MENU DESCRIPTION FEATURE
---------------------------------------------------------------------------------- */

class shuttle_menudescription extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		global $wp_query;
		
		$item_output = NULL;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-' . esc_attr( $item->ID ) . '"' . $value . $class_names . '>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : ' href="' . esc_url( get_permalink( $item->ID ) ) . '"';

        // Insert title for top level
		if ( has_nav_menu( 'header_menu' ) ) {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' : apply_filters( 'the_title', $item->title, $item->ID );
		} else {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', get_the_title($item->ID), $item->ID ) . '</span>' : apply_filters( 'the_title', get_the_title($item->ID), $item->ID );
		}

        // Structure of output
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $title;
		$item_output .= '</a>';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM FEATURED IMAGE SIZES
//----------------------------------------------------------------------------------

if ( ! function_exists( 'shuttle_input_addimagesizes' ) ) {
	function shuttle_input_addimagesizes() {

		/* 1 Column Layout */
		add_image_size( 'shuttle-column1-1/3', 1140, 380, true );
		add_image_size( 'shuttle-column1-1/4', 1140, 285, true );

		/* 2 Column Layout */
		add_image_size( 'shuttle-column2-1/2', 570, 285, true );
		add_image_size( 'shuttle-column2-2/3', 570, 380, true );

		/* 3 Column Layout */
		add_image_size( 'shuttle-column3-1/3', 380, 107, true );
		add_image_size( 'shuttle-column3-2/3', 380, 254, true );

		/* 4 Column Layout */
		add_image_size( 'shuttle-column4-2/3', 285, 190, true );
	}
	add_action( 'after_setup_theme', 'shuttle_input_addimagesizes' );
}

if ( ! function_exists( 'shuttle_input_showimagesizes' ) ) {	 
	function shuttle_input_showimagesizes($sizes) {

		// 1 Column Layout
		$sizes['shuttle-column1-1/3'] = __( 'Full - 1:3', 'shuttle' );
		$sizes['shuttle-column1-1/4'] = __( 'Full - 1:4', 'shuttle' );

		// 2 Column Layout
		$sizes['shuttle-column2-1/2'] = __( 'Half - 1:2', 'shuttle' );
		$sizes['shuttle-column2-2/3'] = __( 'Half - 2:3', 'shuttle' );

		// 3 Column Layout
		$sizes['shuttle-column3-1/3'] = __( 'Third - 1:3', 'shuttle' );
		$sizes['shuttle-column3-2/3'] = __( 'Third - 2:3', 'shuttle' );

		// 4 Column Layout
		$sizes['shuttle-column4-2/3'] = __( 'Quarter - 2:3', 'shuttle' );

		return $sizes;
	}
	add_filter('image_size_names_choose', 'shuttle_input_showimagesizes');
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM COMMENTS POP UP LINK FUNCTION - Credit to http://www.thescubageek.com/code/wordpress-code/add-get_comments_popup_link-to-wordpress/
//----------------------------------------------------------------------------------

// Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
function shuttle_input_commentspopuplink( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments','shuttle' );
    if ( false === $one ) $one = __( '1 Comment','shuttle' );
    if ( false === $more ) $more = __( '% Comments','shuttle' );
    if ( false === $none ) $none = __( 'Comments Off','shuttle' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','shuttle');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= esc_url( get_permalink() ) . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="' . esc_attr( $css_class ) . '" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','shuttle'), $title ) ) . '">';
    $str .= shuttle_comments_returnstring( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}
 
// Modifies WordPress's built-in comments_number() function to return string instead of echo
function shuttle_comments_returnstring( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __( '% Comments', 'shuttle' ) : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __( 'No Comments', 'shuttle' ) : $zero;
    else // must be one
        $output = ( false === $one ) ? __( '1 Comment', 'shuttle' ) : $one;
 
    return apply_filters('comments_number', $output, $number);
}


//----------------------------------------------------------------------------------
//	CHANGE FALLBACK WP_PAGE_MENU CLASSES TO MATCH WP_NAV_MENU CLASSES
//----------------------------------------------------------------------------------

function shuttle_input_menuclass( $ulclass ) {

	// Add menu class to list
	$ulclass = preg_replace( '/<ul>/', '<ul class="menu">', $ulclass, 1 );
	$ulclass = str_replace( 'children', 'sub-menu', $ulclass );

	// Remove div wrapper
	$ulclass = str_replace( '<div class="menu">', '', $ulclass );
	$ulclass = str_replace( '</div>', '', $ulclass );

	return preg_replace('/<div (.*)>(.*)<\/div>/iU', '$2', $ulclass );
}
add_filter( 'wp_page_menu', 'shuttle_input_menuclass' );


//----------------------------------------------------------------------------------
//	DETERMINE IF THE PAGE IS A BLOG - USEFUL FOR HOMEPAGE BLOG.
//----------------------------------------------------------------------------------

// Credit to: http://www.poseidonwebstudios.com/web-development/wordpress-is_blog-function/
function shuttle_check_isblog() {
 
    global $post;
 
    //Post type must be 'post'.
    $post_type = get_post_type($post);
 
    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() )
        && ($post_type == 'post')
    ) ? true : false ;
 
}


//----------------------------------------------------------------------------------
//	ADD GOOGLE FONT - OPEN SANS. (http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/)
//----------------------------------------------------------------------------------

function shuttle_googlefonts_url() {
    $fonts_url = '';

    // Translators: Translate this to 'off' if there are characters in your language that are not supported by Open Sans
    $font_translate = _x( 'on', 'Open Sans font: on or off', 'shuttle' );
 
    if ( 'off' !== $font_translate ) {
        $font_families = array();
  
        if ( 'off' !== $font_translate ) {
            $font_families[] = 'Open Sans:300,400,600,700';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function shuttle_googlefonts_scripts() {
   wp_enqueue_style( 'shuttle-google-fonts', shuttle_googlefonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'shuttle_googlefonts_scripts' );


//----------------------------------------------------------------------------------
//	FIX JETPACK PHOTON IMAGE LOAD ISSUE - DISABLE CACHING FOR SPECIFIC IMAGES 
//----------------------------------------------------------------------------------

function shuttle_photon_exception( $val, $src, $tag ) {
        if ( $src == get_template_directory_uri() . '/images/transparent.png' ) {
                return true;
        }
        return $val;
}
add_filter( 'jetpack_photon_skip_image', 'shuttle_photon_exception', 10, 3 );


//----------------------------------------------------------------------------------
//	FEEDBACK REQUEST
//----------------------------------------------------------------------------------

/* Add Custom Sidebar css */
function shuttle_class_body_admin($classes) {
	return $classes . ' theme-active-' . get_stylesheet();
}
add_filter( 'admin_body_class', 'shuttle_class_body_admin' );

