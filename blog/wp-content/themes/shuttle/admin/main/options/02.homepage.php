<?php
/**
 * Homepage functions.
 *
 * @package ShuttleThemes
 */

/* ----------------------------------------------------------------------------------
	ENABLE SLIDER - HOMEPAGE & INNER-PAGES
---------------------------------------------------------------------------------- */

// Add full width slider class to body
function shuttle_input_sliderclass($classes){

// Get theme options values.
$shuttle_homepage_sliderswitch      = shuttle_var ( 'shuttle_homepage_sliderswitch' );
$shuttle_homepage_sliderpresetwidth = shuttle_var ( 'shuttle_homepage_sliderpresetwidth' );

	if ( is_front_page() ) {
		if ( empty( $shuttle_homepage_sliderswitch ) or $shuttle_homepage_sliderswitch == 'option1' or $shuttle_homepage_sliderswitch == 'option4' ) {
			if ( empty( $shuttle_homepage_sliderpresetwidth ) or $shuttle_homepage_sliderpresetwidth == '1' ) {
				$classes[] = 'slider-full';
			} else {
				$classes[] = 'slider-boxed';
			}
		}
	}
	return $classes;
}
add_action( 'body_class', 'shuttle_input_sliderclass');


/* ----------------------------------------------------------------------------------
	ENABLE HOMEPAGE SLIDER
---------------------------------------------------------------------------------- */

// Content for slider layout - Standard
function shuttle_input_sliderhomepage() {

// Get theme options values.
$shuttle_homepage_sliderimage1_info  = shuttle_var ( 'shuttle_homepage_sliderimage1_info' );
$shuttle_homepage_sliderimage1_image = shuttle_var ( 'shuttle_homepage_sliderimage1_image', 'url' );
$shuttle_homepage_sliderimage1_title = shuttle_var ( 'shuttle_homepage_sliderimage1_title' );
$shuttle_homepage_sliderimage1_desc  = shuttle_var ( 'shuttle_homepage_sliderimage1_desc' );
$shuttle_homepage_sliderimage1_link  = shuttle_var ( 'shuttle_homepage_sliderimage1_link' );
$shuttle_homepage_sliderimage2_info  = shuttle_var ( 'shuttle_homepage_sliderimage2_info' );
$shuttle_homepage_sliderimage2_image = shuttle_var ( 'shuttle_homepage_sliderimage2_image', 'url' );
$shuttle_homepage_sliderimage2_title = shuttle_var ( 'shuttle_homepage_sliderimage2_title' );
$shuttle_homepage_sliderimage2_desc  = shuttle_var ( 'shuttle_homepage_sliderimage2_desc' );
$shuttle_homepage_sliderimage2_link  = shuttle_var ( 'shuttle_homepage_sliderimage2_link' );
$shuttle_homepage_sliderimage3_info  = shuttle_var ( 'shuttle_homepage_sliderimage3_info' );
$shuttle_homepage_sliderimage3_image = shuttle_var ( 'shuttle_homepage_sliderimage3_image', 'url' );
$shuttle_homepage_sliderimage3_title = shuttle_var ( 'shuttle_homepage_sliderimage3_title' );
$shuttle_homepage_sliderimage3_desc  = shuttle_var ( 'shuttle_homepage_sliderimage3_desc' );
$shuttle_homepage_sliderimage3_link  = shuttle_var ( 'shuttle_homepage_sliderimage3_link' );

	// Set output variable to avoid php errors
	$slide1_link = NULL;
	$slide2_link = NULL;
	$slide3_link = NULL;

	// Get url of featured images in slider pages
	$slide1_image_url = $shuttle_homepage_sliderimage1_image;
	$slide2_image_url = $shuttle_homepage_sliderimage2_image;
	$slide3_image_url = $shuttle_homepage_sliderimage3_image;

	// Get titles of slider pages
	$slide1_title = $shuttle_homepage_sliderimage1_title;
	$slide2_title = $shuttle_homepage_sliderimage2_title;
	$slide3_title = $shuttle_homepage_sliderimage3_title;

	// Get descriptions (excerpt) of slider pages
	$slide1_desc = $shuttle_homepage_sliderimage1_desc;
	$slide2_desc = $shuttle_homepage_sliderimage2_desc;
	$slide3_desc = $shuttle_homepage_sliderimage3_desc;

	// Get url of slider pages
	if( ! empty( $shuttle_homepage_sliderimage1_link ) ) {
		$slide1_link = get_permalink( $shuttle_homepage_sliderimage1_link );
	}
	if( ! empty( $shuttle_homepage_sliderimage2_link ) ) {
		$slide2_link = get_permalink( $shuttle_homepage_sliderimage2_link );
	}
	if( ! empty( $shuttle_homepage_sliderimage3_link ) ) {
		$slide3_link = get_permalink( $shuttle_homepage_sliderimage3_link );
	}

	// Create array for slider content
	$shuttle_homepage_sliderpage = array(
		array(
			'slide_image_url'   => $slide1_image_url,
			'slide_title'       => $slide1_title,
			'slide_desc'        => $slide1_desc,
			'slide_link'        => $slide1_link
		),
		array(
			'slide_image_url'   => $slide2_image_url,
			'slide_title'       => $slide2_title,
			'slide_desc'        => $slide2_desc,
			'slide_link'        => $slide2_link
		),
		array(
			'slide_image_url'   => $slide3_image_url,
			'slide_title'       => $slide3_title,
			'slide_desc'        => $slide3_desc,
			'slide_link'        => $slide3_link
		),
	);

	foreach ($shuttle_homepage_sliderpage as $slide) {

		if ( ! empty( $slide['slide_image_url'] ) ) {

			// Get url of background image or set video overlay image
			$slide_image = 'background: url(' . esc_url( $slide['slide_image_url'] ) . ') no-repeat center; background-size: cover;';

			// Used for slider image alt text
			if ( ! empty( $slide['slide_title'] ) ) {
				$slide_alt = $slide['slide_title'];
			} else {
				$slide_alt = __( 'Slider Image', 'shuttle' );
			}

			echo '<li>',
				 '<img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="' . esc_attr( $slide_image ) . '" alt="' . esc_attr( $slide_alt ) . '" />',
				 '<div class="rslides-content">',
				 '<div class="wrap-safari">',
				 '<div class="rslides-content-inner">',
				 '<div class="featured">';

				if ( ! empty( $slide['slide_title'] ) ) {

					// Wrap text in <span> tags
					$slide['slide_title'] = '<span>' . esc_html( $slide['slide_title'] ) . '</span>';
					$slide['slide_title'] = str_replace( '<br />', '</span><br /><span>', $slide['slide_title'] );
					$slide['slide_title'] = str_replace( '<br/>', '</span><br/><span>', $slide['slide_title'] );

					echo '<div class="featured-title">',
						 $slide['slide_title'],
						 '</div>';
				}
				if ( ! empty( $slide['slide_desc'] ) ) {
					$slide_desc = '<p><span>' . esc_html( wp_strip_all_tags( $slide['slide_desc'] ) ) . '</span></p>';

					// Wrap text in <span> tags
					$slide_desc = str_replace( '<br />', '</span><br /><span>', $slide_desc );
					$slide_desc = str_replace( '<br/>', '</span><br/><span>', $slide_desc );

					echo '<div class="featured-excerpt">',
						 $slide_desc,
						 '</div>';
				}
				if ( ! empty( $slide['slide_link'] ) ) {

					if ( empty( $slide['slide_button'] ) ) {
						$slide['slide_button'] = __( 'Read More', 'shuttle' );
					}

					echo '<div class="featured-link">',
						 '<a href="' . esc_url( $slide['slide_link'] ) . '"><span>' . esc_html( $slide['slide_button'] ) . '</span></a>',
						 '</div>';
				}

			echo '</div>',
				  '</div>',
				  '</div>',
				  '</div>',
				  '</li>';
		}
	}
}

// Add Slider - Homepage
function shuttle_input_sliderhome() {

// Get theme options values.
$shuttle_homepage_sliderswitch       = shuttle_var ( 'shuttle_homepage_sliderswitch' );
$shuttle_homepage_sliderimage1_image = shuttle_var ( 'shuttle_homepage_sliderimage1_image', 'url' );
$shuttle_homepage_sliderimage2_image = shuttle_var ( 'shuttle_homepage_sliderimage2_image', 'url' );
$shuttle_homepage_sliderimage3_image = shuttle_var ( 'shuttle_homepage_sliderimage3_image', 'url' );

$shuttle_class_fullwidth = NULL;
$slide_image             = NULL;
$slider_default          = NULL;

	if ( is_front_page() ) {

		// Set default slider
		$slider_default .= '<li><img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="background: url(' . esc_url( get_stylesheet_directory_uri() ) . '/images/slideshow/slide_demo1.png) no-repeat center; background-size: cover;" alt="' . esc_attr__( 'Demo Image', 'shuttle' ) . '" /></li>';
		$slider_default .= '<li><img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png) no-repeat center; background-size: cover;" alt="' . esc_attr__( 'Demo Image', 'shuttle' ) . '" /></li>';
		$slider_default .= '<li><img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png) no-repeat center; background-size: cover;" alt="' . esc_attr__( 'Demo Image', 'shuttle' ) . '" /></li>';

		if ( ( current_user_can( 'edit_theme_options' ) and empty( $shuttle_homepage_sliderswitch ) ) or $shuttle_homepage_sliderswitch == 'option1' ) {

			echo '<div id="slider"><div id="slider-core">';
			echo '<div class="rslides-container"><div class="rslides-inner"><ul class="slides">';
				echo $slider_default;
			echo '</ul></div></div>';
			echo '</div></div>';

		} else if ( $shuttle_homepage_sliderswitch == 'option4' ) {

			// Check if page slider has been set
			if( empty( $shuttle_homepage_sliderimage1_image ) and empty( $shuttle_homepage_sliderimage2_image ) and empty( $shuttle_homepage_sliderimage3_image ) ) {

				echo '<div id="slider"><div id="slider-core">';
				echo '<div class="rslides-container"><div class="rslides-inner"><ul class="slides">';
					echo $slider_default;
				echo '</ul></div></div>';
				echo '</div></div>';

			} else {

				echo '<div id="slider"><div id="slider-core">';
				echo '<div class="rslides-container"><div class="rslides-inner"><ul class="slides">';
					shuttle_input_sliderhomepage();
				echo '</ul></div></div>';
				echo '</div></div>';
				
			}
		}
	}
}

// Add ShuttleSlider Height - Homepage
function shuttle_input_sliderhomeheight() {

// Get theme options values.
$shuttle_homepage_sliderswitch       = shuttle_var ( 'shuttle_homepage_sliderswitch' );
$shuttle_homepage_sliderpresetheight = shuttle_var ( 'shuttle_homepage_sliderpresetheight' );

	if ( empty( $shuttle_homepage_sliderpresetheight ) ) $shuttle_homepage_sliderpresetheight = '350';

	if ( is_front_page() ) {
		if ( empty( $shuttle_homepage_sliderswitch ) or $shuttle_homepage_sliderswitch == 'option1' or $shuttle_homepage_sliderswitch == 'option4' ) {
		echo 	"\n" .'<style type="text/css">' . "\n",
			'#slider .rslides, #slider .rslides li { height: ' . esc_attr( $shuttle_homepage_sliderpresetheight ) . 'px; max-height: ' . esc_attr( $shuttle_homepage_sliderpresetheight ) . 'px; }' . "\n",
			'#slider .rslides img { height: 100%; max-height: ' . esc_attr( $shuttle_homepage_sliderpresetheight ) . 'px; }' . "\n",
			'</style>' . "\n";
		}
	}
}
add_action( 'wp_head','shuttle_input_sliderhomeheight', '13' );


//----------------------------------------------------------------------------------
//	ENABLE HOMEPAGE CONTENT
//----------------------------------------------------------------------------------

function shuttle_input_homepagesection() {

// Get theme options values.
$shuttle_homepage_sectionswitch  = shuttle_var ( 'shuttle_homepage_sectionswitch' );
$shuttle_homepage_section1_image = shuttle_var ( 'shuttle_homepage_section1_image', 'id' );
$shuttle_homepage_section1_title = shuttle_var ( 'shuttle_homepage_section1_title' );
$shuttle_homepage_section1_desc  = shuttle_var ( 'shuttle_homepage_section1_desc' );
$shuttle_homepage_section1_link  = shuttle_var ( 'shuttle_homepage_section1_link' );
$shuttle_homepage_section2_image = shuttle_var ( 'shuttle_homepage_section2_image', 'id' );
$shuttle_homepage_section2_title = shuttle_var ( 'shuttle_homepage_section2_title' );
$shuttle_homepage_section2_desc  = shuttle_var ( 'shuttle_homepage_section2_desc' );
$shuttle_homepage_section2_link  = shuttle_var ( 'shuttle_homepage_section2_link' );
$shuttle_homepage_section3_image = shuttle_var ( 'shuttle_homepage_section3_image', 'id' );
$shuttle_homepage_section3_title = shuttle_var ( 'shuttle_homepage_section3_title' );
$shuttle_homepage_section3_desc  = shuttle_var ( 'shuttle_homepage_section3_desc' );
$shuttle_homepage_section3_link  = shuttle_var ( 'shuttle_homepage_section3_link' );
$shuttle_homepage_section4_image = shuttle_var ( 'shuttle_homepage_section4_image', 'id' );
$shuttle_homepage_section4_title = shuttle_var ( 'shuttle_homepage_section4_title' );
$shuttle_homepage_section4_desc  = shuttle_var ( 'shuttle_homepage_section4_desc' );
$shuttle_homepage_section4_link  = shuttle_var ( 'shuttle_homepage_section4_link' );

	// Set default values for images
	if ( ! empty( $shuttle_homepage_section1_image ) )
		$shuttle_homepage_section1_image = wp_get_attachment_image_src($shuttle_homepage_section1_image, 'shuttle-column3-2/3');

	if ( ! empty( $shuttle_homepage_section2_image ) )
		$shuttle_homepage_section2_image = wp_get_attachment_image_src($shuttle_homepage_section2_image, 'shuttle-column3-2/3');

	if ( ! empty( $shuttle_homepage_section3_image ) )
		$shuttle_homepage_section3_image = wp_get_attachment_image_src($shuttle_homepage_section3_image, 'shuttle-column3-2/3');

	if ( ! empty( $shuttle_homepage_section4_image ) )
		$shuttle_homepage_section4_image = wp_get_attachment_image_src($shuttle_homepage_section4_image, 'shuttle-column3-2/3');

	// Set default values for titles
	if ( empty( $shuttle_homepage_section1_title ) ) $shuttle_homepage_section1_title = __( 'Step 1 &#45; Theme Options', 'shuttle' );
	if ( empty( $shuttle_homepage_section2_title ) ) $shuttle_homepage_section2_title = __( 'Step 2 &#45; Setup Slider', 'shuttle' );
	if ( empty( $shuttle_homepage_section3_title ) ) $shuttle_homepage_section3_title = __( 'Step 3 &#45; Create Homepage', 'shuttle' );
	if ( empty( $shuttle_homepage_section4_title ) ) $shuttle_homepage_section4_title = __( 'Step 4 &#45; Add Content', 'shuttle' );

	// Set default values for descriptions
	if ( empty( $shuttle_homepage_section1_desc ) ) 
	$shuttle_homepage_section1_desc = __( 'To begin customizing your site go to Appearance &#8594; Customizer and select Theme Options. Use the options to build your site.', 'shuttle' );

	if ( empty( $shuttle_homepage_section2_desc ) ) 
	$shuttle_homepage_section2_desc = __( 'Go to Theme Options &#8594; Homepage and choose image slider. Simply add an image, title and text to create stunning slides.', 'shuttle' );

	if ( empty( $shuttle_homepage_section3_desc ) ) 
	$shuttle_homepage_section3_desc = __( 'Go to Theme Options &#8594; Homepage (Featured) and turn the switch on then add the content you want for each section.', 'shuttle' );

	if ( empty( $shuttle_homepage_section4_desc ) ) 
	$shuttle_homepage_section4_desc = __( 'To start adding page content go to Pages -> Add New in your WordPress admin area. You can add content as you normally would. Have fun!', 'shuttle' );

	// Get page names for links
	if ( !empty( $shuttle_homepage_section1_link ) ) $shuttle_homepage_section1_link = get_permalink( $shuttle_homepage_section1_link );
	if ( !empty( $shuttle_homepage_section2_link ) ) $shuttle_homepage_section2_link = get_permalink( $shuttle_homepage_section2_link );
	if ( !empty( $shuttle_homepage_section3_link ) ) $shuttle_homepage_section3_link = get_permalink( $shuttle_homepage_section3_link );
	if ( !empty( $shuttle_homepage_section4_link ) ) $shuttle_homepage_section4_link = get_permalink( $shuttle_homepage_section4_link );

	// Determine whether 3 column or 4 column layout should be used
	if ( empty( $shuttle_homepage_section4_image ) ) {
		$class_three_col1 = ' one_third';
		$class_three_col2 = ' one_third';
		$class_three_col3 = ' one_third last';

		$class_four_col1 = NULL;
		$class_four_col2 = NULL;
		$class_four_col3 = NULL;
		$class_four_col4 = NULL;
	} else {
		$class_three_col1 = NULL;
		$class_three_col2 = NULL;
		$class_three_col3 = NULL;

		$class_four_col1 = ' one_fourth';
		$class_four_col2 = ' one_fourth';
		$class_four_col3 = ' one_fourth';
		$class_four_col4 = ' one_fourth last';
	}

	if ( is_front_page() ) {
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $shuttle_homepage_sectionswitch ) ) or $shuttle_homepage_sectionswitch == '1' ) {

		echo '<div id="section-home"><div id="section-home-inner">';

			echo '<article class="section1' . $class_three_col1 . $class_four_col1 . '">',
					'<div class="services-builder style1">',
					'<div class="iconimage">';
					if ( empty( $shuttle_homepage_section1_image ) ) {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image 1', 'shuttle') . '" />';
					} else {
						if ( ! empty( $shuttle_homepage_section1_link ) ) {
							echo '<a href="' . esc_url( $shuttle_homepage_section1_link ) . '"><img src="' . esc_url( $shuttle_homepage_section1_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section1_title ) . '" /></a>';
						} else {
							echo '<img src="' . esc_url( $shuttle_homepage_section1_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section1_title ) . '" />';
						}
					}
			echo	'</div>',
					'<div class="iconmain">',
					'<h3>' . esc_html( $shuttle_homepage_section1_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $shuttle_homepage_section1_desc ) ) );
					if ( ! empty( $shuttle_homepage_section1_link ) ) {
						echo '<p class="iconurl"><a class="" href="' . esc_url( $shuttle_homepage_section1_link ) . '">' . __( 'Read More', 'shuttle' ) . '</a></p>';
					}
			echo	'</div>',
					'</div>',
				'</article>';

			echo '<article class="section2' . $class_three_col2 . $class_four_col2 . '">',
					'<div class="services-builder style1">',
					'<div class="iconimage">';
					if ( empty( $shuttle_homepage_section2_image ) ) {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image 2', 'shuttle') . '" />';
					} else {
						if ( ! empty( $shuttle_homepage_section2_link ) ) {
							echo '<a href="' . esc_url( $shuttle_homepage_section2_link ) . '"><img src="' . esc_url( $shuttle_homepage_section2_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section2_title ) . '" /></a>';
						} else {
							echo '<img src="' . esc_url( $shuttle_homepage_section2_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section2_title ) . '" />';
						}
					}
			echo	'</div>',
					'<div class="iconmain">',
					'<h3>' . esc_html( $shuttle_homepage_section2_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $shuttle_homepage_section2_desc ) ) );
					if ( ! empty( $shuttle_homepage_section2_link ) ) {
						echo '<p class="iconurl"><a class="" href="' . esc_url( $shuttle_homepage_section2_link ) . '">' . __( 'Read More', 'shuttle' ) . '</a></p>';
					}
			echo	'</div>',
					'</div>',
				'</article>';

			echo '<article class="section3' . $class_three_col3 . $class_four_col3 . '">',
					'<div class="services-builder style1">',
					'<div class="iconimage">';
					if ( empty( $shuttle_homepage_section3_image ) ) {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image 3', 'shuttle') . '" />';
					} else {
						if ( ! empty( $shuttle_homepage_section3_link ) ) {
							echo '<a href="' . esc_url( $shuttle_homepage_section3_link ) . '"><img src="' . esc_url( $shuttle_homepage_section3_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section3_title ) . '" /></a>';
						} else {
							echo '<img src="' . esc_url( $shuttle_homepage_section3_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section3_title ) . '" />';
						}
					}
			echo	'</div>',
					'<div class="iconmain">',
					'<h3>' . esc_html( $shuttle_homepage_section3_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $shuttle_homepage_section3_desc ) ) );
				if ( ! empty( $shuttle_homepage_section3_link ) ) {
					echo '<p class="iconurl"><a class="" href="' . esc_url( $shuttle_homepage_section3_link ) . '">' . __( 'Read More', 'shuttle' ) . '</a></p>';
				}
			echo	'</div>',
					'</div>',
				'</article>';

			if ( ! empty( $class_four_col4 ) ) {
				echo '<article class="section4' . $class_four_col4 . '">',
						'<div class="services-builder style1">',
						'<div class="iconimage">';
						if ( empty( $shuttle_homepage_section4_image ) ) {
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image 4', 'shuttle') . '" />';
						} else {
							if ( ! empty( $shuttle_homepage_section4_link ) ) {
								echo '<a href="' . esc_url( $shuttle_homepage_section4_link ) . '"><img src="' . esc_url( $shuttle_homepage_section4_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section4_title ) . '" /></a>';
							} else {
								echo '<img src="' . esc_url( $shuttle_homepage_section4_image[0] ) . '" alt="' . esc_attr( $shuttle_homepage_section4_title ) . '" />';
							}
						}
				echo	'</div>',
						'<div class="iconmain">',
						'<h3>' . esc_html( $shuttle_homepage_section4_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $shuttle_homepage_section4_desc ) ) );
					if ( ! empty( $shuttle_homepage_section4_link ) ) {
						echo '<p class="iconurl"><a class="" href="' . esc_url( $shuttle_homepage_section4_link ) . '">' . __( 'Read More', 'shuttle' ) . '</a></p>';
					}
				echo	'</div>',
						'</div>',
					'</article>';
			}

		echo '<div class="clearboth"></div></div></div>';
		}
	}
}

/* ----------------------------------------------------------------------------------
	CALL TO ACTION - INTRO
---------------------------------------------------------------------------------- */

function shuttle_input_ctaintro() {

// Get theme options values.
$shuttle_homepage_introswitch        = shuttle_var ( 'shuttle_homepage_introswitch' );
$shuttle_homepage_introaction        = shuttle_var ( 'shuttle_homepage_introaction' );
$shuttle_homepage_introactionteaser  = shuttle_var ( 'shuttle_homepage_introactionteaser' );
$shuttle_homepage_introactiontext1   = shuttle_var ( 'shuttle_homepage_introactiontext1' );
$shuttle_homepage_introactionlink1   = shuttle_var ( 'shuttle_homepage_introactionlink1' );
$shuttle_homepage_introactionpage1   = shuttle_var ( 'shuttle_homepage_introactionpage1' );
$shuttle_homepage_introactioncustom1 = shuttle_var ( 'shuttle_homepage_introactioncustom1' );

	if ( $shuttle_homepage_introswitch == '1' and is_front_page() and ! empty( $shuttle_homepage_introaction ) ) {

		echo '<div id="introaction"><div id="introaction-core">';

			echo '<div class="action-message three_fourth">';

			echo '<div class="action-text">',
				 '<h3>' . esc_html( $shuttle_homepage_introaction ) . '</h3>',
				 '</div>';

			echo '<div class="action-teaser">',
				 wpautop( wp_kses_post( $shuttle_homepage_introactionteaser ) ),
				 '</div>';

			echo '</div>';

			if ( ( !empty( $shuttle_homepage_introactionlink1) and $shuttle_homepage_introactionlink1 !== 'option3' ) ) {

				// Set default value of buttons to "Read more"
				if( empty( $shuttle_homepage_introactiontext1 ) ) { $shuttle_homepage_introactiontext1 = __( 'Read More', 'shuttle' ); }
				
				echo '<div class="action-link one_fourth last">';
					// Add call to action button 1
					if ( $shuttle_homepage_introactionlink1 == 'option1' ) {
						echo '<a class="themebutton" href="' . esc_url( get_permalink( $shuttle_homepage_introactionpage1 ) ) . '">',
						esc_html( $shuttle_homepage_introactiontext1 ),
						'</a>';
					} else if ( $shuttle_homepage_introactionlink1 == 'option2' ) {
						echo '<a class="themebutton" href="' . esc_url( $shuttle_homepage_introactioncustom1 ) . '">',
						esc_html( $shuttle_homepage_introactiontext1 ),
						'</a>';
					}
				echo '</div>';
			}

		echo '</div></div>';
	}
}


?>