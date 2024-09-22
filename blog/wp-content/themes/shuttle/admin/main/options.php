<?php
/**
 * Setup theme options used in customizer.
 *
 * @package ShuttleThemes
 */

function shuttle_customizer_theme_options( $wp_customize ) {

	global $shuttle_prefix;

	$prefix_name = $shuttle_prefix;

	// ==========================================================================================
	// 1. ADD PANELS / SECTIONS
	// ==========================================================================================

	// Add Upgrade Section
	$wp_customize->add_section(
		new shuttle_customizer_customswitch_button_link(
			$wp_customize,
			'shuttle_customizer_section_upgrade_top',
			array(
				'title'        => __( 'Shuttle Pro', 'shuttle' ),
				'priority'     => 1,
				'button_text' => __( 'Upgrade Now', 'shuttle' ),
				'button_url'  => 'https://shuttlethemes.com/features/',
				'button_class' => 'button-primary',
			)
		)
	);

	// Add Theme Options Panel
	$wp_customize->add_panel(
		'shuttle_customizer_section_themeoptions',
		array(
			'title'       => __( 'Theme Options', 'shuttle' ),
			'description' => __( 'Use the options below to customize your theme!', 'shuttle' ),
			'priority'    => 2,
		)
	);

//	// Add Hire Section
//	$wp_customize->add_section(
//		new shuttle_customizer_customswitch_button_link(
//			$wp_customize,
//			'shuttle_customizer_section_docs',
//			array(
//				'title'        => __( 'Need help with your site?', 'shuttle' ),
//				'priority'     => 1,
//				'button_text'  => __( 'Hire a Developer', 'shuttle' ),
//				'button_url'   => 'https://www.thinkupthemes.com/hire/',
//				'button_class' => 'button-secondary',
//				'panel'        => 'shuttle_customizer_section_themeoptions',
//			)
//		)
//	);

	// Add Documentation Section
	$wp_customize->add_section(
		new shuttle_customizer_customswitch_button_link(
			$wp_customize,
			'shuttle_customizer_section_docs',
			array(
				'title'        => __( 'Documentation', 'shuttle' ),
				'priority'     => 1,
				'button_text'  => __( 'View Docs', 'shuttle' ),
				'button_url'   => admin_url( 'themes.php?page=shuttle-setup&tab=page_docs' ),
				'button_class' => 'button-text',
				'panel'        => 'shuttle_customizer_section_themeoptions',
			)
		)
	);

	// Add General Settings Section
	$wp_customize->add_section(
		'shuttle_customizer_section_generalsettings',
		array(
			'title'    => __( 'General Settings', 'shuttle' ),
			'priority' => 10,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Homepage Section
	$wp_customize->add_section(
		'shuttle_customizer_section_homepage',
		array(
			'title'    => __( 'Homepage', 'shuttle' ),
			'priority' => 20,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Homepage (Featured) Section
	$wp_customize->add_section(
		'shuttle_customizer_section_homepagefeatured',
		array(
			'title'    => __( 'Homepage (Featured)', 'shuttle' ),
			'priority' => 30,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Header Section
	$wp_customize->add_section(
		'shuttle_customizer_section_header',
		array(
			'title'    => __( 'Header', 'shuttle' ),
			'priority' => 40,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Footer Section
	$wp_customize->add_section(
		'shuttle_customizer_section_footer',
		array(
			'title'    => __( 'Footer', 'shuttle' ),
			'priority' => 50,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Social Media Section
	$wp_customize->add_section(
		'shuttle_customizer_section_socialmedia',
		array(
			'title'    => __( 'Social Media', 'shuttle' ),
			'priority' => 60,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Blog Section
	$wp_customize->add_section(
		'shuttle_customizer_section_blog',
		array(
			'title'    => __( 'Blog', 'shuttle' ),
			'priority' => 70,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);

	// Add Upgrade (10% off) Section
	$wp_customize->add_section(
		'shuttle_customizer_section_upgrade_inner',
		array(
			'title'    => __( 'Upgrade (10% off)', 'shuttle' ),
			'priority' => 80,
			'panel'    => 'shuttle_customizer_section_themeoptions',
		)
	);


	// ==========================================================================================
	// 2. ADD CONTROLS
	// ==========================================================================================

	//----------------------------------------------------
	// 2.1. Add General Settings Controls
	//----------------------------------------------------

	// Add Logo Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_general_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_general_heading',
			array(
				'label'           => __( 'Logo Settings', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_generalsettings',
				'settings'        => 'shuttle_redux_variables[shuttle_section_general_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Logo Info Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_general_logosetting]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_raw(
			$wp_customize,
			'shuttle_general_logosetting',
			array(
				'label'           => __( 'Since WordPress v4.5 you can now add a site logo using the native WordPress options. To add a site logo go the "Site Identitiy" settings on the main customizer screen.', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_generalsettings',
				'settings'        => 'shuttle_redux_variables[shuttle_general_logosetting]',
				'active_callback' => '',
			)
		)
	);

	// Add General Page Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_general_page]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_general_page',
			array(
				'label'           => __( 'Page Structure', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_generalsettings',
				'settings'        => 'shuttle_redux_variables[shuttle_section_general_page]',
				'active_callback' => '',
			)
		)
	);

	// Add Page Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_general_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_radio_image(
			$wp_customize,
			'shuttle_general_layout',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_general_layout]',
				'section'		  => 'shuttle_customizer_section_generalsettings',
				'label'			  => __( 'Page Layout', 'shuttle' ),
				'description'	  => __( 'Select page layout. This will only be applied to published Pages.', 'shuttle' ),
				'choices'		  => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
				'active_callback' => '',
			)
		)
	);

	// Add General Sidebar Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_general_sidebars]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_select_sidebar',
		)
	);
	$wp_customize->add_control(
		'shuttle_general_sidebars',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_general_sidebars]',
			'section'		  => 'shuttle_customizer_section_generalsettings',
			'type'			  => 'select',
			'label'			  => __( 'Select a Sidebar', 'shuttle' ),
			'description'	  => __( 'Choose a sidebar to use with the page layout.', 'shuttle' ),
			'choices'		  => shuttle_customizer_select_array_sidebar(),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Enable Fixed Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_general_fixedlayoutswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_general_fixedlayoutswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_general_fixedlayoutswitch]',
				'section'         => 'shuttle_customizer_section_generalsettings',
				'label'           => __( 'Enable Fixed Layout', 'shuttle' ),
				'description'	  => __( '(i.e. Disable responsive layout)', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Add Enable Breadcrumbs Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_general_breadcrumbswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_general_breadcrumbswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_general_breadcrumbswitch]',
				'section'         => 'shuttle_customizer_section_generalsettings',
				'label'           => __( 'Enable Breadcrumbs', 'shuttle' ),
				'description'	  => __( 'Switch on to enable breadcrumbs.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);


	//----------------------------------------------------
	// 2.2. Homepage
	//----------------------------------------------------

	// Add Homepage Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_homepage_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_homepage_heading',
			array(
				'label'           => __( 'Control Homepage Layout', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_section_homepage_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Homepage Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_radio_image(
			$wp_customize,
			'shuttle_homepage_layout',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_homepage_layout]',
				'section'		  => 'shuttle_customizer_section_homepage',
				'label'			  => __( 'Homepage Layout', 'shuttle' ),
				'description'	  => __( 'Select page layout. This will only be applied to static homepages (front page) and not to homepage blogs.', 'shuttle' ),
				'choices'		  => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage Select a Sidebar Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sidebars]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_select_sidebar',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sidebars',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sidebars]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'select',
			'label'			  => __( 'Select a Sidebar', 'shuttle' ),
			'description'	  => __( 'Choose a sidebar to use with the layout.', 'shuttle' ),
			'choices'		  => shuttle_customizer_select_array_sidebar(),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Homepage Slider Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_homepage_slider]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_homepage_slider',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_section_homepage_slider]',
				'section'         => 'shuttle_customizer_section_homepage',
				'label'           => __( 'Homepage Slider', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Choose Homepage Slider Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderswitch]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'radio',
			'label'			  => __( 'Choose Homepage Slider', 'shuttle' ),
			'description'	  => __( 'Switch on to enable home page slider.', 'shuttle' ),
			'choices'		  => array(
				'option4' => 'Image Slider',
				'option3' => 'Disable'
			),
			'active_callback' => '',
		)
	);

	// Add Image Slide 1 - Info
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage1_info]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_raw(
			$wp_customize,
			'shuttle_homepage_sliderimage1_info',
			array(
				'label'           => __( 'Slide 1', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderimage1_info]',
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Image Slide 1 - Image
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage1_image][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_homepage_sliderimage1_image',
			array(
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderimage1_image][url]',
				'label'	          => '',
				'description'	  => __( 'Image', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Image Slide 1 - Title
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage1_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage1_title',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage1_title]',
			'type'			  => 'text',
			'label'			  => '',
			'description'	  => __( 'Title', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Image Slide 1 - Description
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage1_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage1_desc',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage1_desc]',
			'type'			  => 'text',
			'label'			  => '',
			'description'	  => __( 'Description', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Slide 1 - Page Link
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage1_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage1_link',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage1_link]',
			'type'			  => 'dropdown-pages',
			'label'			  => '',
			'description'	  => __( 'URL', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Image Slide 2 - Info
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage2_info]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_raw(
			$wp_customize,
			'shuttle_homepage_sliderimage2_info',
			array(
				'label'           => __( 'Slide 2', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderimage2_info]',
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Image Slide 2 - Image
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage2_image][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_homepage_sliderimage2_image',
			array(
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderimage2_image][url]',
				'label'	          => '',
				'description'	  => __( 'Image', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Image Slide 2 - Title
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage2_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage2_title',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage2_title]',
			'type'			  => 'text',
			'label'			  => '',
			'description'	  => __( 'Title', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Image Slide 2 - Description
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage2_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage2_desc',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage2_desc]',
			'type'			  => 'text',
			'label'			  => '',
			'description'	  => __( 'Description', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Slide 2 - Page Link
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage2_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage2_link',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage2_link]',
			'type'			  => 'dropdown-pages',
			'label'			  => '',
			'description'	  => __( 'URL', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Image Slide 3 - Info
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage3_info]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_raw(
			$wp_customize,
			'shuttle_homepage_sliderimage3_info',
			array(
				'label'           => __( 'Slide 3', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderimage3_info]',
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Image Slide 3 - Image
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage3_image][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_homepage_sliderimage3_image',
			array(
				'section'         => 'shuttle_customizer_section_homepage',
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderimage3_image][url]',
				'label'	          => '',
				'description'	  => __( 'Image', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Image Slide 3 - Title
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage3_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage3_title',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage3_title]',
			'type'			  => 'text',
			'label'			  => '',
			'description'	  => __( 'Title', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Image Slide 3 - Description
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage3_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage3_desc',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage3_desc]',
			'type'			  => 'text',
			'label'			  => '',
			'description'	  => __( 'Description', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Slide 3 - Page Link
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderimage3_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderimage3_link',
		array(
			'section'		  => 'shuttle_customizer_section_homepage',
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderimage3_link]',
			'type'			  => 'dropdown-pages',
			'label'			  => '',
			'description'	  => __( 'URL', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Enable Full-Width Slider Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderpresetwidth]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_homepage_sliderpresetwidth',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sliderpresetwidth]',
				'section'         => 'shuttle_customizer_section_homepage',
				'label'           => __( 'Enable Full-Width Slider', 'shuttle' ),
				'description'	  => __( 'Switch on to enable full-width slider.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Add Slider Height (Max) Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sliderpresetheight]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'absint',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_sliderpresetheight',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_sliderpresetheight]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'text',
			'label'			  => __( 'Slider Height (Max)', 'shuttle' ),
			'description'	  => __( 'Specify the maximum slider height (px).', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Call To Action - Intro Section Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_homepage_ctaintro]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_homepage_ctaintro',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_section_homepage_ctaintro]',
				'section'         => 'shuttle_customizer_section_homepage',
				'label'           => __( 'Call To Action - Intro', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage - Intro Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introswitch]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'checkbox',
			'label'			  => __( 'Message', 'shuttle' ),
			'description'	  => __( 'Check to enable intro on home page.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - Intro Title Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introaction]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introaction',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introaction]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'text',
			'description'	  => __( 'Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - Intro Teaser Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introactionteaser]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introactionteaser',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introactionteaser]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'textarea',
			'description'	  => __( 'Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - Intro Button Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introactiontext1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introactiontext1',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introactiontext1]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'text',
			'label'			  => __( 'Button - Text', 'shuttle' ),
			'description'	  => __( 'Specify a text for button 1.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - Intro Link Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introactionlink1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introactionlink1',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introactionlink1]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'radio',
			'label'			  => __( 'Button - Link', 'shuttle' ),
			'description'	  => __( 'Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'shuttle' ),
			'choices'		  => array(
				'option1' => __( 'Link to a Page', 'shuttle' ),
				'option2' => __( 'Specify Custom link', 'shuttle' ),
				'option3' => __( 'Disable Link', 'shuttle' ),
			),
			'active_callback' => '',
		)
	);

	// Add Homepage - Intro Page Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introactionpage1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introactionpage1',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introactionpage1]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'dropdown-pages',
			'label'			  => __( 'Button - Link to a page', 'shuttle' ),
			'description'	  => __( 'Select a target page for action button link.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Homepage - Intro Custom Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_introactioncustom1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_introactioncustom1',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_introactioncustom1]',
			'section'		  => 'shuttle_customizer_section_homepage',
			'type'			  => 'text',
			'label'			  => __( 'Button - Custom link', 'shuttle' ),
			'description'	  => __( 'Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);


	//----------------------------------------------------
	// 2.3. Homepage (Featured)
	//----------------------------------------------------

	// Add Homepage (Featured) Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_homepagefeatured_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_homepagefeatured_heading',
			array(
				'label'           => __( 'Display Pre-Designed Homepage Layout', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_homepagefeatured',
				'settings'        => 'shuttle_redux_variables[shuttle_section_homepagefeatured_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Enable Pre-Made Homepage Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_sectionswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_homepage_sectionswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_homepage_sectionswitch]',
				'section'         => 'shuttle_customizer_section_homepagefeatured',
				'label'           => __( 'Enable Pre-Made Homepage', 'shuttle' ),
				'description'	  => __( 'switch on to enable pre-designed homepage layout.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Add Content Area 1 Image Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section1_image][id]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'shuttle_homepage_section1_image',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section1_image][id]',
				'section'		  => 'shuttle_customizer_section_homepagefeatured',
				'label'	          => __( 'Content Area 1', 'shuttle' ),
				'description'	  => __( 'Add an image for the section background.', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Content Area 1 Title Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section1_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section1_title',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section1_title]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'text',
			'description'	  => __( 'Add a title to the section.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 1 Description Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section1_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section1_desc',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section1_desc]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'textarea',
			'description'	  => __( 'Add some text to featured section 1.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 1 Link Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section1_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section1_link',
		array(
			'settings'		=> 'shuttle_redux_variables[shuttle_homepage_section1_link]',
			'section'		=> 'shuttle_customizer_section_homepagefeatured',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Link to a page', 'shuttle' ),
		)
	);

	// Add Content Area 2 Image Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section2_image][id]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'shuttle_homepage_section2_image',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section2_image][id]',
				'section'		  => 'shuttle_customizer_section_homepagefeatured',
				'label'	          => __( 'Content Area 2', 'shuttle' ),
				'description'	  => __( 'Add an image for the section background.', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Content Area 2 Title Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section2_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section2_title',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section2_title]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'text',
			'description'	  => __( 'Add a title to the section.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 2 Description Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section2_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section2_desc',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section2_desc]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'textarea',
			'description'	  => __( 'Add some text to featured section 2.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 2 Link Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section2_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section2_link',
		array(
			'settings'		=> 'shuttle_redux_variables[shuttle_homepage_section2_link]',
			'section'		=> 'shuttle_customizer_section_homepagefeatured',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Link to a page', 'shuttle' ),
		)
	);

	// Add Content Area 3 Image Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section3_image][id]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'shuttle_homepage_section3_image',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section3_image][id]',
				'section'		  => 'shuttle_customizer_section_homepagefeatured',
				'label'	          => __( 'Content Area 3', 'shuttle' ),
				'description'	  => __( 'Add an image for the section background.', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Content Area 3 Title Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section3_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section3_title',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section3_title]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'text',
			'description'	  => __( 'Add a title to the section.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 3 Description Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section3_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section3_desc',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section3_desc]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'textarea',
			'description'	  => __( 'Add some text to featured section 3.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 3 Link Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section3_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section3_link',
		array(
			'settings'		=> 'shuttle_redux_variables[shuttle_homepage_section3_link]',
			'section'		=> 'shuttle_customizer_section_homepagefeatured',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Link to a page', 'shuttle' ),
		)
	);
// ==================================================
// ==================================================
// ==================================================

	// Add Content Area 4 Image Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section4_image][id]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'shuttle_homepage_section4_image',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section4_image][id]',
				'section'		  => 'shuttle_customizer_section_homepagefeatured',
				'label'	          => __( 'Content Area 4', 'shuttle' ),
				'description'	  => __( 'Add an image for the section background.', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Content Area 4 Title Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section4_title]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section4_title',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section4_title]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'text',
			'description'	  => __( 'Add a title to the section.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 4 Description Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section4_desc]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section4_desc',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_homepage_section4_desc]',
			'section'		  => 'shuttle_customizer_section_homepagefeatured',
			'type'			  => 'textarea',
			'description'	  => __( 'Add some text to featured section 4.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Content Area 4 Link Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_homepage_section4_link]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'shuttle_homepage_section4_link',
		array(
			'settings'		=> 'shuttle_redux_variables[shuttle_homepage_section4_link]',
			'section'		=> 'shuttle_customizer_section_homepagefeatured',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Link to a page', 'shuttle' ),
		)
	);


	//----------------------------------------------------
	// 2.4. Header
	//----------------------------------------------------

	// Add Header Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_header_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_header_heading',
			array(
				'label'           => __( 'Header Style', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_header',
				'settings'        => 'shuttle_redux_variables[shuttle_section_header_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Enable Search (Main Header) Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_stickyswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_stickyswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_stickyswitch]',
				'section'         => 'shuttle_customizer_section_header',
				'label'           => __( 'Sticky Header', 'shuttle' ),
				'description'	  => __( 'Switch on to fix header to top of page.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Add Control Header Content Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_header_content]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_header_content',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_section_header_content]',
				'section'         => 'shuttle_customizer_section_header',
				'label'           => __( 'Control Header Content', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Enable Search (Main Header) Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_searchswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_searchswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_searchswitch]',
				'section'         => 'shuttle_customizer_section_header',
				'label'           => __( 'Enable Search (Main Header)', 'shuttle' ),
				'description'	  => __( 'Switch on to enable header search.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);


	//----------------------------------------------------
	// 2.5. Footer
	//----------------------------------------------------

	// Add Footer Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_footer_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_footer_heading',
			array(
				'label'           => __( 'Control Footer Content', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_footer',
				'settings'        => 'shuttle_redux_variables[shuttle_section_footer_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Footer Widgets Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_footer_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_radio_image(
			$wp_customize,
			'shuttle_footer_layout',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_footer_layout]',
				'section'		  => 'shuttle_customizer_section_footer',
				'label'			  => __( 'Footer Widgets Layout', 'shuttle' ),
				'description'	  => __( 'Select footer layout. Take complete control of the footer content by adding widgets.', 'shuttle' ),
				'choices'		  => array(
					'option1'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option01.png',
					'option2'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option02.png',
					'option3'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option03.png',
					'option4'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option04.png',
					'option5'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option05.png',
					'option6'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option06.png',
					'option7'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option07.png',
					'option8'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option08.png',
					'option9'  => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option09.png',
					'option10' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option10.png',
					'option11' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option11.png',
					'option12' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option12.png',
					'option13' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option13.png',
					'option14' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option14.png',
					'option15' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option15.png',
					'option16' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option16.png',
					'option17' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option17.png',
					'option18' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option18.png',
				),
				'active_callback' => '',
			)
		)
	);

	// Add Disable Footer Widgets Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_footer_widgetswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_footer_widgetswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_footer_widgetswitch]',
			'section'		  => 'shuttle_customizer_section_footer',
			'type'			  => 'checkbox',
			'label'			  => __( 'Disable Footer Widgets', 'shuttle' ),
			'description'	  => __( 'Check to disable footer widgets.', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Enable Scroll To Top Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_footer_scroll]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_footer_scroll',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_footer_scroll]',
				'section'         => 'shuttle_customizer_section_footer',
				'label'           => __( 'Enable Scroll To Top', 'shuttle' ),
				'description'	  => __( 'Check to enable scroll to top.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Add Sub Footer Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_subfooter_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_subfooter_heading',
			array(
				'label'           => __( 'Control Sub Footer Content', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_footer',
				'settings'        => 'shuttle_redux_variables[shuttle_section_subfooter_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Post-Footer Widgets Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_subfooter_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_radio_image(
			$wp_customize,
			'shuttle_subfooter_layout',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_subfooter_layout]',
				'section'		  => 'shuttle_customizer_section_footer',
				'label'			  => __( 'Post-Footer Widgets Layout', 'shuttle' ),
				'description'	  => __( 'Select post-footer layout. Take complete control of the post-footer content by adding widgets.', 'shuttle' ),
				'choices'		  => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option08.png',
				),
				'active_callback' => '',
			)
		)
	);

	// Add Disable Post-Footer Widgets Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_subfooter_widgetswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_subfooter_widgetswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_subfooter_widgetswitch]',
			'section'		  => 'shuttle_customizer_section_footer',
			'type'			  => 'checkbox',
			'label'			  => __( 'Disable Post-Footer Widgets', 'shuttle' ),
			'description'	  => __( 'Check to disable post-footer widgets.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Enable Widget Close Button Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_subfooter_widgetclose]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_subfooter_widgetclose',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_subfooter_widgetclose]',
				'section'         => 'shuttle_customizer_section_footer',
				'label'           => __( 'Enable Widget Close Button', 'shuttle' ),
				'description'	  => __( 'Switch on to enable button to hide post-footer widgets.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	//----------------------------------------------------
	// 2.6. Social Media
	//----------------------------------------------------

	// Add Social Media Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_socialmedia_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_socialmedia_heading',
			array(
				'label'           => __( 'Social Media Control', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_socialmedia',
				'settings'        => 'shuttle_redux_variables[shuttle_section_socialmedia_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Social Media Content Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_socialswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_socialswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_socialswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Enable Social Media Links (Pre Header)', 'shuttle' ),
				'description'	  => __( 'Switch on to enable links to social media pages.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Add Enable Social Media Links (footer) Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_socialswitchfooter]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_socialswitchfooter',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_socialswitchfooter]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Enable Social Media Links (footer)', 'shuttle' ),
				'description'	  => __( 'Switch on to enable links to social media pages.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Add Social Media Content Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_header_social]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_header_social',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_section_header_social]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Social Media Content', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Social Media Display Message Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_socialmessage]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_socialmessage',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_socialmessage]',
			'section'         => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Add a message here. E.g. &#34;Follow Us&#34;.<br />(Only shown in header)', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Facebook social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_facebookswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_facebookswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_facebookswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Facebook', 'shuttle' ),
				'description'	  => __( 'Enable link to Facebook profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_facebooklink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_facebooklink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_facebooklink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Facebook page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_facebookiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_facebookiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_facebookiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Custom Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Facebook icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_facebookcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_facebookcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_facebookcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Twitter social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_twitterswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_twitterswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_twitterswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Twitter', 'shuttle' ),
				'description'	  => __( 'Enable link to Twitter profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_twitterlink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_twitterlink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_twitterlink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Twitter page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_twittericonswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_twittericonswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_twittericonswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Custom Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Twitter icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_twittercustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_twittercustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_twittercustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Google+ social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_googleswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_googleswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_googleswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Google+', 'shuttle' ),
				'description'	  => __( 'Enable link to Google+ profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_googlelink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_googlelink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_googlelink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Google+ page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_googleiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_googleiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_googleiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Custom Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Google+ icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_googlecustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_googlecustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_googlecustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Instagram social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_instagramswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_instagramswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_instagramswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Instagram', 'shuttle' ),
				'description'	  => __( 'Enable link to Instagram profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_instagramlink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_instagramlink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_instagramlink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Instagram page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_instagramiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_instagramiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_instagramiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom Instagram Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Instagram icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_instagramcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_instagramcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_instagramcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);
// ================================================================================================================================
// ================================================================================================================================
// ================================================================================================================================
// ================================================================================================================================
// ================================================================================================================================

	// Tumblr social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_tumblrswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_tumblrswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_tumblrswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Tumblr', 'shuttle' ),
				'description'	  => __( 'Enable link to Tumblr profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_tumblrlink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_tumblrlink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_tumblrlink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Tumblr page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_tumblriconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_tumblriconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_tumblriconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom Tumblr Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Tumblr icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_tumblrcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_tumblrcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_tumblrcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// LinkedIn social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_linkedinswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_linkedinswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_linkedinswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'LinkedIn', 'shuttle' ),
				'description'	  => __( 'Enable link to LinkedIn profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_linkedinlink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_linkedinlink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_linkedinlink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your LinkedIn page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_linkediniconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_linkediniconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_linkediniconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Custom Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom LinkedIn icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_linkedincustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_linkedincustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_linkedincustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Flickr social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_flickrswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_flickrswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_flickrswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Flickr', 'shuttle' ),
				'description'	  => __( 'Enable link to Flickr profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_flickrlink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_flickrlink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_flickrlink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Flickr page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_flickriconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_flickriconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_flickriconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Custom Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Flickr icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_flickrcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_flickrcustomicon',
			array(
				'settings'		=> 'shuttle_redux_variables[shuttle_header_flickrcustomicon][url]',
				'section'		=> 'shuttle_customizer_section_socialmedia',
				'description'	=> __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Pinterest social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_pinterestswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_pinterestswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_pinterestswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Pinterest', 'shuttle' ),
				'description'	  => __( 'Enable link to Pinterest profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_pinterestlink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_pinterestlink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_pinterestlink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Pinterest page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_pinteresticonswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_pinteresticonswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_pinteresticonswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom Pinterest Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Pinterest icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_pinterestcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_pinterestcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_pinterestcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Xing social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_xingswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_xingswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_xingswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Xing', 'shuttle' ),
				'description'	  => __( 'Enable link to Xing profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_xinglink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_xinglink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_xinglink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Xing page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_xingiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_xingiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_xingiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom Xing Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Xing icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_xingcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_Xingcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_xingcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// PayPal social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_paypalswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_paypalswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_paypalswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'PayPal', 'shuttle' ),
				'description'	  => __( 'Enable link to PayPal profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_paypallink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_paypallink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_paypallink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your PayPal page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_paypaliconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_paypaliconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_paypaliconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom PayPal Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom PayPal icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_paypalcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_paypalcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_paypalcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// YouTube social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_youtubeswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_youtubeswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_youtubeswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'YouTube', 'shuttle' ),
				'description'	  => __( 'Enable link to YouTube profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_youtubelink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_youtubelink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_youtubelink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'     => __( 'Input the url to your YouTube page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_youtubeiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_youtubeiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_youtubeiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Custom Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom YouTube icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_youtubecustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_youtubecustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_youtubecustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Vimeo social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_vimeoswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_vimeoswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_vimeoswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Vimeo', 'shuttle' ),
				'description'	  => __( 'Enable link to Vimeo profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_vimeolink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_vimeolink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_vimeolink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your Vimeo page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_vimeoiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_vimeoiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_vimeoiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom Vimeo Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Vimeo icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_vimeocustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_vimeocustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_vimeocustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// RSS social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_rssswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_rssswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_rssswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'RSS', 'shuttle' ),
				'description'	  => __( 'Enable link to RSS profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_rsslink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_rsslink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_rsslink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input the url to your RSS page.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_rssiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_rssiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_rssiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom RSS Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom RSS icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_rsscustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_rsscustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_rsscustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);

	// Email social settings
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_emailswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_header_emailswitch',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_header_emailswitch]',
				'section'         => 'shuttle_customizer_section_socialmedia',
				'label'           => __( 'Email', 'shuttle' ),
				'description'	  => __( 'Enable link to Email profile.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_emaillink]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_emaillink',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_emaillink]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'text',
			'description'	  => __( 'Input your email address. <strong>Note:</strong> Add mailto: as prefix to open link as email.', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_emailiconswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_header_emailiconswitch',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_header_emailiconswitch]',
			'section'		  => 'shuttle_customizer_section_socialmedia',
			'type'			  => 'checkbox',
			'label'			  => __( 'Use Custom Email Icon', 'shuttle' ),
			'description'	  => __( 'Check to use custom Email icon', 'shuttle' ),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_header_emailcustomicon][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shuttle_header_emailcustomicon',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_header_emailcustomicon][url]',
				'section'		  => 'shuttle_customizer_section_socialmedia',
				'description'	  => __( 'Add a link to the image or upload one from your desktop. The image will be resized.', 'shuttle' ),
				'active_callback' => 'shuttle_customizer_callback_active_global',
			)
		)
	);


	// -----------------------------------------------------------------------------------
	//	5.	Blog
	// -----------------------------------------------------------------------------------

	// Add Blog Heading
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_blog_heading]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_blog_heading',
			array(
				'label'           => __( 'Control Blog (Archive) Pages', 'shuttle' ),
				'section'         => 'shuttle_customizer_section_blog',
				'settings'        => 'shuttle_redux_variables[shuttle_section_blog_heading]',
				'active_callback' => '',
			)
		)
	);

	// Add Blog Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_blog_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_radio_image(
			$wp_customize,
			'shuttle_blog_layout',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_blog_layout]',
				'section'		  => 'shuttle_customizer_section_blog',
				'label'			  => __( 'Blog Layout', 'shuttle' ),
				'description'	  => __( 'Select blog page layout. Only applied to the main blog page and not individual posts.', 'shuttle' ),
				'choices'		  => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
				'active_callback' => '',
			)
		)
	);

	// Add Blog Select a Sidebar Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_blog_sidebars]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_select_sidebar',
		)
	);
	$wp_customize->add_control(
		'shuttle_blog_sidebars',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_blog_sidebars]',
			'section'		  => 'shuttle_customizer_section_blog',
			'type'			  => 'select',
			'label'			  => __( 'Select a Sidebar', 'shuttle' ),
			'description'	  => __( 'Note: Sidebars will not be applied to homepage Blog. Control sidebars on the homepage from the &#39;Home Settings&#39; option.', 'shuttle' ),
			'choices'		  => shuttle_customizer_select_array_sidebar(),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Blog Traditional Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_blog_style1layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		'shuttle_blog_style1layout',
		array(
			'settings'		=> 'shuttle_redux_variables[shuttle_blog_style1layout]',
			'section'		=> 'shuttle_customizer_section_blog',
			'type'			=> 'radio',
			'label'			=> __( 'Blog Traditional Layout', 'shuttle' ),
			'description'	=> __( 'Select a layout for your blog page. This will also be applied to all pages set using the blog template.', 'shuttle' ),
			'choices'		=> array(
				'option1' => __( 'Style 1 (Quarter Width)', 'shuttle' ),
				'option2' => __( 'Style 2 (Full Width)', 'shuttle' ),
			)
		)
	);

	// Add Blog Links Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_blog_hovercheck][option1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_blog_hovercheck_option1',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_blog_hovercheck][option1]',
			'section'		  => 'shuttle_customizer_section_blog',
			'type'			  => 'checkbox',
			'label'			  => __( 'Blog Links - Lightbox', 'shuttle' ),
			'description'	  => __( 'Check to show lightbox link', 'shuttle' ),
			'active_callback' => '',
		)
	);
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_blog_hovercheck][option2]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shuttle_blog_hovercheck_option2',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_blog_hovercheck][option2]',
			'section'		  => 'shuttle_customizer_section_blog',
			'type'			  => 'checkbox',
			'label'			  => __( 'Blog Links - Post', 'shuttle' ),
			'description'	  => __( 'Check to show post link', 'shuttle' ),
			'active_callback' => '',
		)
	);

	// Add Post Content Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_blog_postswitch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		'shuttle_blog_postswitch',
		array(
			'settings'		=> 'shuttle_redux_variables[shuttle_blog_postswitch]',
			'section'		=> 'shuttle_customizer_section_blog',
			'type'			=> 'radio',
			'label'			=> __( 'Post Content', 'shuttle' ),
			'description'	=> __( 'Control how much content you want to show from each post on the main blog page. Remember to control the full article content by using the Wordpress <a href="http://en.support.wordpress.com/splitting-content/more-tag/">more</a> tag in your post.', 'shuttle' ),
			'choices'		=> array(
				'option1' => __( 'Show excerpt', 'shuttle' ),
				'option2' => __( 'Show full article', 'shuttle' ),
				'option3' => __( 'Hide article', 'shuttle' ),
			)
		)
	);

	// Add Control Single Post Page Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_section_post_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_section(
			$wp_customize,
			'shuttle_section_post_layout',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_section_post_layout]',
				'section'         => 'shuttle_customizer_section_blog',
				'label'           => __( 'Control Single Post Page', 'shuttle' ),
				'active_callback' => '',
			)
		)
	);

	// Add Post Layout Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_post_layout]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_radio_image(
			$wp_customize,
			'shuttle_post_layout',
			array(
				'settings'		  => 'shuttle_redux_variables[shuttle_post_layout]',
				'section'		  => 'shuttle_customizer_section_blog',
				'label'			  => __( 'Post Layout', 'shuttle' ),
				'description'	  => __( 'Select blog page layout. This will only be applied to individual posts and not the main blog page.', 'shuttle' ),
				'choices'		  => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
				'active_callback' => '',
			)
		)
	);

	// Add Post Select a Sidebar Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_post_sidebars]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_select_sidebar',
		)
	);
	$wp_customize->add_control(
		'shuttle_post_sidebars',
		array(
			'settings'		  => 'shuttle_redux_variables[shuttle_post_sidebars]',
			'section'		  => 'shuttle_customizer_section_blog',
			'type'			  => 'select',
			'label'			  => __( 'Select a Sidebar', 'shuttle' ),
			'description'	  => __( 'Choose a sidebar to use with the layout.', 'shuttle' ),
			'choices'		  => shuttle_customizer_select_array_sidebar(),
			'active_callback' => 'shuttle_customizer_callback_active_global',
		)
	);

	// Add Show Author Bio Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_post_authorbio]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'shuttle_customizer_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_switch(
			$wp_customize,
			'shuttle_post_authorbio',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_post_authorbio]',
				'section'         => 'shuttle_customizer_section_blog',
				'label'           => __( 'Show Author Bio', 'shuttle' ),
				'description'	  => __( 'Check to enable the author biography.', 'shuttle' ),
				'choices'		  => array(
					'1'      => __( 'On', 'shuttle' ),
					'off'    => __( 'Off', 'shuttle' ),
				),
				'active_callback' => '',
			)
		)
	);


	//----------------------------------------------------
	// 2.8. Upgrade Section (10% off)
	//----------------------------------------------------

	// Add Upgrade Control
	$wp_customize->add_setting(
		'shuttle_redux_variables[shuttle_upgrade_content]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'wp_filter_post_kses',
		)
	);
	$wp_customize->add_control(
		new shuttle_customizer_customcontrol_upgrade_inner(
			$wp_customize,
			'shuttle_upgrade_content',
			array(
				'settings'        => 'shuttle_redux_variables[shuttle_upgrade_content]',
				'section'         => 'shuttle_customizer_section_upgrade_inner',
				'upgrade_url'     => 'https://shuttlethemes.com/features/',
				'price_discount'  => __( 'Upgrade Now (10% off)', 'shuttle' ),
				'price_normal'	  => __( 'Use coupon at checkout for 10% off.', 'shuttle' ),
				'coupon'	      => __( 'shuttle10', 'shuttle' ),
				'button'	      => __( 'Upgrade Now', 'shuttle' ),
				'title_main'	  => __( 'So&hellip; Why upgrade?', 'shuttle' ),
				'title_secondary' => __( 'We&#39;re glad you asked! Here&#39;s just some of the amazing features you&#39;ll get when you upgrade&hellip;', 'shuttle' ),
				'images'		  => array(
					'%s/admin/main/inc/controls/upgrade_inner/img/1_trusted_team.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/2_page_builder.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/3_premium_support.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/4_theme_options.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/5_shortcodes.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/6_unlimited_colors.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/7_parallax_pages.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/8_typography.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/9_backgrounds.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/10_responsive.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/11_retina_ready.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/12_site_layout.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/13_translation_ready.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/14_rtl_support.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/15_infinite_sidebars.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/16_portfolios.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/17_demo_content.png',
					'%s/admin/main/inc/controls/upgrade_inner/img/18_seo_optimized.png',
				),
				'active_callback' => '',
			)
		)
	);

}
add_action( 'customize_register', 'shuttle_customizer_theme_options' );