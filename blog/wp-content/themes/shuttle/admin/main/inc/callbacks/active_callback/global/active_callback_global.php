<?php
/**
 * The active callbacks used for theme options.
 *
 * @package ShuttleThemes
 */
 
function shuttle_customizer_callback_active_global( $control ) {

	global $shuttle_prefix;

	$prefix_name = $shuttle_prefix;
	$control_id  = $control->id;

	// ==========================================================================================
	// 1. CALLBACK SECTION - GET DEPENDENT VALUES
	// ==========================================================================================

	// General Settings
	$shuttle_general_layout            = $control->manager->get_setting('shuttle_redux_variables[shuttle_general_layout]')->value();
	$shuttle_general_breadcrumbswitch  = $control->manager->get_setting('shuttle_redux_variables[shuttle_general_breadcrumbswitch]')->value();

	// Homepage
	$shuttle_homepage_layout           = $control->manager->get_setting('shuttle_redux_variables[shuttle_homepage_layout]')->value();
	$shuttle_homepage_sliderswitch     = $control->manager->get_setting('shuttle_redux_variables[shuttle_homepage_sliderswitch]')->value();
	$shuttle_homepage_introactionlink1 = $control->manager->get_setting('shuttle_redux_variables[shuttle_homepage_introactionlink1]')->value();

	// Social Media
	$shuttle_header_facebookswitch      = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_facebookswitch]')->value();
	$shuttle_header_twitterswitch       = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_twitterswitch]')->value();
	$shuttle_header_googleswitch        = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_googleswitch]')->value();
	$shuttle_header_instagramswitch     = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_instagramswitch]')->value();
	$shuttle_header_tumblrswitch        = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_tumblrswitch]')->value();
	$shuttle_header_linkedinswitch      = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_linkedinswitch]')->value();
	$shuttle_header_flickrswitch        = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_flickrswitch]')->value();
	$shuttle_header_pinterestswitch     = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_pinterestswitch]')->value();
	$shuttle_header_xingswitch          = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_xingswitch]')->value();
	$shuttle_header_paypalswitch        = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_paypalswitch]')->value();
	$shuttle_header_vimeoswitch         = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_vimeoswitch]')->value();
	$shuttle_header_youtubeswitch       = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_youtubeswitch]')->value();
	$shuttle_header_rssswitch           = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_rssswitch]')->value();
	$shuttle_header_emailswitch         = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_emailswitch]')->value();

	// Blog
	$shuttle_blog_layout               = $control->manager->get_setting('shuttle_redux_variables[shuttle_blog_layout]')->value();
	$shuttle_post_layout               = $control->manager->get_setting('shuttle_redux_variables[shuttle_post_layout]')->value();


	// ==========================================================================================
	// 2. CALLBACK CONTROLS - SHOW / HIDE CONTROLS
	// ==========================================================================================

	// General Settings - Page Layout
	if ( ( $shuttle_general_layout == 'option2' or $shuttle_general_layout == 'option3' ) and 
			$control_id == 'shuttle_general_sidebars' ) {
		return true;
	}

	// General Settings - Enable Breadcrumbs
	if ( $shuttle_general_breadcrumbswitch == '1' and
			$control_id == 'shuttle_general_breadcrumbdelimeter' ) {
		return true;
	}

	// Homepage - Homepage Layout
	if ( ( $shuttle_homepage_layout == 'option2' or $shuttle_homepage_layout == 'option3' ) and 
			$control_id == 'shuttle_homepage_sidebars' ) {
		return true;
	}

	// Homepage - Choose Homepage Slider
	if ( $shuttle_homepage_sliderswitch == 'option4' and
			( $control_id == 'shuttle_homepage_sliderimage1_info' or 
			  $control_id == 'shuttle_homepage_sliderimage1_image' or 
			  $control_id == 'shuttle_homepage_sliderimage1_title' or 
			  $control_id == 'shuttle_homepage_sliderimage1_desc' or 
			  $control_id == 'shuttle_homepage_sliderimage1_link' or 
			  $control_id == 'shuttle_homepage_sliderimage2_info' or 
			  $control_id == 'shuttle_homepage_sliderimage2_image' or 
			  $control_id == 'shuttle_homepage_sliderimage2_title' or 
			  $control_id == 'shuttle_homepage_sliderimage2_desc' or 
			  $control_id == 'shuttle_homepage_sliderimage2_link' or 
			  $control_id == 'shuttle_homepage_sliderimage3_info' or 
			  $control_id == 'shuttle_homepage_sliderimage3_image' or 
			  $control_id == 'shuttle_homepage_sliderimage3_title' or 
			  $control_id == 'shuttle_homepage_sliderimage3_desc' or 
			  $control_id == 'shuttle_homepage_sliderimage3_link' or 
			  $control_id == 'shuttle_homepage_sliderpageinfo' or 
			  $control_id == 'shuttle_homepage_sliderpresetheight' or
			  $control_id == 'shuttle_homepage_sliderpresetwidth' ) ) {
		return true;
	}

	// Homepage - Call To Action - Intro
	if ( $shuttle_homepage_introactionlink1 == 'option1' and
			$control_id == 'shuttle_homepage_introactionpage1' ) {
		return true;
	} else if ( $shuttle_homepage_introactionlink1 == 'option2' and
			$control_id == 'shuttle_homepage_introactioncustom1' ) {
		return true;
	}

// ====================================================================================================
// ====================================================================================================
// ====================================================================================================
// ====================================================================================================
// ====================================================================================================

	// Social Media - Facebook
	if ( $shuttle_header_facebookswitch == '1' and
			( $control_id == 'shuttle_header_facebooklink' or 
			  $control_id == 'shuttle_header_facebookiconswitch' or
			  $control_id == 'shuttle_header_facebookcustomicon' ) ) {
		return true;
	}

	// Social Media - Twitter
	if ( $shuttle_header_twitterswitch == '1' and
			( $control_id == 'shuttle_header_twitterlink' or 
			  $control_id == 'shuttle_header_twittericonswitch' or
			  $control_id == 'shuttle_header_twittercustomicon' ) ) {
		return true;
	}

	// Social Media - Google
	if ( $shuttle_header_googleswitch == '1' and
			( $control_id == 'shuttle_header_googlelink' or 
			  $control_id == 'shuttle_header_googleiconswitch' or
			  $control_id == 'shuttle_header_googlecustomicon' ) ) {
		return true;
	}

	// Social Media - Instagram
	if ( $shuttle_header_instagramswitch == '1' and
			( $control_id == 'shuttle_header_instagramlink' or 
			  $control_id == 'shuttle_header_instagramiconswitch' or
			  $control_id == 'shuttle_header_instagramcustomicon' ) ) {
		return true;
	}

	$shuttle_header_tumblrswitch        = $control->manager->get_setting('shuttle_redux_variables[shuttle_header_tumblrswitch]')->value();
	// Social Media - Tumblr
	if ( $shuttle_header_tumblrswitch == '1' and
			( $control_id == 'shuttle_header_tumblrlink' or 
			  $control_id == 'shuttle_header_tumblriconswitch' or
			  $control_id == 'shuttle_header_tumblrcustomicon' ) ) {
		return true;
	}

	// Social Media - LinkedIn
	if ( $shuttle_header_linkedinswitch == '1' and
			( $control_id == 'shuttle_header_linkedinlink' or 
			  $control_id == 'shuttle_header_linkediniconswitch' or
			  $control_id == 'shuttle_header_linkedincustomicon' ) ) {
		return true;
	}

	// Social Media - Flickr
	if ( $shuttle_header_flickrswitch == '1' and
			( $control_id == 'shuttle_header_flickrlink' or 
			  $control_id == 'shuttle_header_flickriconswitch' or
			  $control_id == 'shuttle_header_flickrcustomicon' ) ) {
		return true;
	}

	// Social Media - Pinterest
	if ( $shuttle_header_pinterestswitch == '1' and
			( $control_id == 'shuttle_header_pinterestlink' or 
			  $control_id == 'shuttle_header_pinteresticonswitch' or
			  $control_id == 'shuttle_header_pinterestcustomicon' ) ) {
		return true;
	}

	// Social Media - Xing
	if ( $shuttle_header_xingswitch == '1' and
			( $control_id == 'shuttle_header_xinglink' or 
			  $control_id == 'shuttle_header_xingiconswitch' or
			  $control_id == 'shuttle_header_xingcustomicon' ) ) {
		return true;
	}

	// Social Media - PayPal
	if ( $shuttle_header_paypalswitch == '1' and
			( $control_id == 'shuttle_header_paypallink' or 
			  $control_id == 'shuttle_header_paypaliconswitch' or
			  $control_id == 'shuttle_header_paypalcustomicon' ) ) {
		return true;
	}

	// Social Media - Vimeo
	if ( $shuttle_header_vimeoswitch == '1' and
			( $control_id == 'shuttle_header_vimeolink' or 
			  $control_id == 'shuttle_header_vimeoiconswitch' or
			  $control_id == 'shuttle_header_vimeocustomicon' ) ) {
		return true;
	}

	// Social Media - YouTube
	if ( $shuttle_header_youtubeswitch == '1' and
			( $control_id == 'shuttle_header_youtubelink' or 
			  $control_id == 'shuttle_header_youtubeiconswitch' or
			  $control_id == 'shuttle_header_youtubecustomicon' ) ) {
		return true;
	}

	// Social Media - RSS
	if ( $shuttle_header_rssswitch == '1' and
			( $control_id == 'shuttle_header_rsslink' or 
			  $control_id == 'shuttle_header_rssiconswitch' or
			  $control_id == 'shuttle_header_rsscustomicon' ) ) {
		return true;
	}

	// Social Media - Email
	if ( $shuttle_header_emailswitch == '1' and
			( $control_id == 'shuttle_header_emaillink' or 
			  $control_id == 'shuttle_header_emailiconswitch' or
			  $control_id == 'shuttle_header_emailcustomicon' ) ) {
		return true;
	}

	// Blog - Blog Layout
	if ( ( $shuttle_blog_layout == 'option2' or $shuttle_blog_layout == 'option3' ) and 
			$control_id == 'shuttle_blog_sidebars' ) {
		return true;
	}

	// Blog - Post Layout
	if ( ( $shuttle_post_layout == 'option2' or $shuttle_post_layout == 'option3' ) and 
			$control_id == 'shuttle_post_sidebars' ) {
		return true;
	}

	return false;
}