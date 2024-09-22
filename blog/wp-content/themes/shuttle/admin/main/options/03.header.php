<?php
/**
 * Social media functions.
 *
 * @package ShuttleThemes
 */


/* ----------------------------------------------------------------------------------
	HEADER STYLE
---------------------------------------------------------------------------------- */
function shuttle_input_headerstyle($classes) {

// Get theme options values.
$shuttle_header_styleswitch    = shuttle_var ( 'shuttle_header_styleswitch' );
$shuttle_header_locationswitch = shuttle_var ( 'shuttle_header_locationswitch' );

	// Check which header style should be output
	if ( empty( $shuttle_header_styleswitch ) or $shuttle_header_styleswitch == 'option1' ) {
		$classes[] = 'header-style1';

			// Check whether header should be output above or below header
			if ( $shuttle_header_locationswitch == 'option2' ) {
				$classes[] = 'header-below';
			}

	} else if ( $shuttle_header_styleswitch == 'option2' ) {	
		$classes[] = 'header-style2';
	}

	return $classes;
}
add_action( 'body_class', 'shuttle_input_headerstyle');


/* ----------------------------------------------------------------------------------
	HEADER LOCATION (ALSO OUTPUTS FULL #HEADER HTML
---------------------------------------------------------------------------------- */

function shuttle_input_headerlocation() {
?>
		<div id="header">
		<div id="header-core">

			<div id="logo">
			<?php /* Custom Logo */ echo shuttle_custom_logo(); ?>
			</div>

			<div id="header-links" class="main-navigation">
			<div id="header-links-inner" class="header-links">

				<?php $walker = new shuttle_menudescription;
				wp_nav_menu(array( 'container' => false, 'theme_location'  => 'header_menu', 'walker' => new shuttle_menudescription() ) ); ?>
				
				<?php /* Header Search */ shuttle_input_headersearch(); ?>
			</div>
			</div>
			<!-- #header-links .main-navigation -->

			<?php /* Add responsive header menu */ shuttle_input_responsivehtml1(); ?>

		</div>
		</div>
		<!-- #header -->
<?php
}

// Input #header before slider
function shuttle_input_headerlocationabove() {

// Get theme options values.
$shuttle_header_styleswitch    = shuttle_var ( 'shuttle_header_styleswitch' );
$shuttle_header_locationswitch = shuttle_var ( 'shuttle_header_locationswitch' );

	if ( $shuttle_header_styleswitch == 'option1' and $shuttle_header_locationswitch == 'option2' ) {
		echo '';
	} else {
		shuttle_input_headerlocation();
	}
}

// Input #header after slider
function shuttle_input_headerlocationbelow() {

// Get theme options values.
$shuttle_header_styleswitch    = shuttle_var ( 'shuttle_header_styleswitch' );
$shuttle_header_locationswitch = shuttle_var ( 'shuttle_header_locationswitch' );

	if ( ( empty( $shuttle_header_styleswitch ) or $shuttle_header_styleswitch == 'option1' ) and $shuttle_header_locationswitch == 'option2' ) {
		shuttle_input_headerlocation();
	}
}

/* ----------------------------------------------------------------------------------
	HEADER - STICK HEADER
---------------------------------------------------------------------------------- */

function shuttle_input_headersticky() {

// Get theme options values.
$shuttle_header_stickyswitch    = shuttle_var ( 'shuttle_header_stickyswitch' );
$shuttle_general_logolinksticky = shuttle_var ( 'shuttle_general_logolinksticky' );

$output_stickylogo = NULL;

	if ( $shuttle_header_stickyswitch == '1' ) {

		// Output sticky header logo if set
		if ( ! empty( $shuttle_general_logolinksticky ) ) {
			$output_stickylogo = '<a rel="home" href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $shuttle_general_logolinksticky ) . '" alt="' . esc_attr__( 'Logo', 'shuttle' ) . '"></a>';
		} else {
			$output_stickylogo = shuttle_custom_logo();	
		}
	?>
		<div id="header-sticky">
		<div id="header-sticky-core">

			<div id="logo-sticky">
			<?php /* Custom Logo */ echo $output_stickylogo; ?>
			</div>

			<div id="header-sticky-links" class="main-navigation">
			<div id="header-sticky-links-inner" class="header-links">

				<?php $walker = new shuttle_menudescription;
				wp_nav_menu(array( 'container' => false, 'theme_location'  => 'header_menu', 'walker' => new shuttle_menudescription() ) ); ?>
				
				<?php /* Header Search */ shuttle_input_headersearch(); ?>
			</div>
			</div><div class="clearboth"></div>
			<!-- #header-sticky-links .main-navigation -->

		</div>
		</div>
		<!-- #header-sticky -->
	<?php
	}
}


/* ----------------------------------------------------------------------------------
	STICKY HEADER
---------------------------------------------------------------------------------- */
function shuttle_input_headerstickyclass($classes) {

// Get theme options values.
$shuttle_header_stickyswitch = shuttle_var ( 'shuttle_header_stickyswitch' );

	if ( $shuttle_header_stickyswitch == '1' ) {
		$classes[] = 'header-sticky';
	}
	return $classes;
}
add_action( 'body_class', 'shuttle_input_headerstickyclass' );


/* ----------------------------------------------------------------------------------
	SEARCH - DISABLE SEARCH
---------------------------------------------------------------------------------- */
function shuttle_input_headersearch() {

// Get theme options values.
$shuttle_header_searchswitch = shuttle_var ( 'shuttle_header_searchswitch' );

	if ( $shuttle_header_searchswitch == '1' ) {
		echo '<div id="header-search">',
			 '<a><div class="fa fa-search"></div></a>',
		     get_search_form(),
		     '</div>';
	}
}

/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - DISPLAY MESSAGE
---------------------------------------------------------------------------------- */

/* Message Settings */
function shuttle_input_socialmessage(){

// Get theme options values.
$shuttle_header_socialmessage   = shuttle_var ( 'shuttle_header_socialmessage' );
$shuttle_header_facebookswitch  = shuttle_var ( 'shuttle_header_facebookswitch' );
$shuttle_header_twitterswitch   = shuttle_var ( 'shuttle_header_twitterswitch' );
$shuttle_header_googleswitch    = shuttle_var ( 'shuttle_header_googleswitch' );
$shuttle_header_instagramswitch = shuttle_var ( 'shuttle_header_instagramswitch' );
$shuttle_header_tumblrswitch    = shuttle_var ( 'shuttle_header_tumblrswitch' );
$shuttle_header_linkedinswitch  = shuttle_var ( 'shuttle_header_linkedinswitch' );
$shuttle_header_flickrswitch    = shuttle_var ( 'shuttle_header_flickrswitch' );
$shuttle_header_pinterestswitch = shuttle_var ( 'shuttle_header_pinterestswitch' );
$shuttle_header_xingswitch      = shuttle_var ( 'shuttle_header_xingswitch' );
$shuttle_header_paypalswitch    = shuttle_var ( 'shuttle_header_paypalswitch' );
$shuttle_header_youtubeswitch   = shuttle_var ( 'shuttle_header_youtubeswitch' );
$shuttle_header_vimeoswitch     = shuttle_var ( 'shuttle_header_vimeoswitch' );
$shuttle_header_rssswitch       = shuttle_var ( 'shuttle_header_rssswitch' );
$shuttle_header_emailswitch     = shuttle_var ( 'shuttle_header_emailswitch' );

	if ( empty( $shuttle_header_facebookswitch ) 
		and empty( $shuttle_header_twitterswitch ) 
		and empty( $shuttle_header_googleswitch ) 
		and empty( $shuttle_header_instagramswitch ) 
		and empty( $shuttle_header_tumblrswitch ) 
		and empty( $shuttle_header_linkedinswitch ) 
		and empty( $shuttle_header_flickrswitch ) 
		and empty( $shuttle_header_pinterestswitch ) 
		and empty( $shuttle_header_xingswitch ) 
		and empty( $shuttle_header_paypalswitch ) 
		and empty( $shuttle_header_lastfmswitch ) 
		and empty( $shuttle_header_youtubeswitch ) 
		and empty( $shuttle_header_vimeoswitch ) 
		and empty( $shuttle_header_rssswitch ) 
		and empty( $shuttle_header_emailswitch ) ) {	
		return '';
	} else if ( ! empty( $shuttle_header_socialmessage ) ) {	
		return esc_attr( $shuttle_header_socialmessage );
	} else if ( empty( $shuttle_header_socialmessage ) ) {
		return '';
	}
}


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - CUSTOM ICONS
---------------------------------------------------------------------------------- */

/* Facebook - Custom Icon */
function shuttle_input_facebookicon(){

// Get theme options values.
$shuttle_header_facebookiconswitch = shuttle_var ( 'shuttle_header_facebookiconswitch' );
$shuttle_header_facebookcustomicon = shuttle_var ( 'shuttle_header_facebookcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_facebookiconswitch == '1' and ! empty( $shuttle_header_facebookcustomicon ) ) {
		
		// Output for header social media
		$output .= '#pre-header-social li.facebook a,';
		$output .= '#pre-header-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.facebook a,';
		$output .= '#post-footer-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Twitter - Custom Icon */
function shuttle_input_twittericon(){

// Get theme options values.
$shuttle_header_twittericonswitch = shuttle_var ( 'shuttle_header_twittericonswitch' );
$shuttle_header_twittercustomicon = shuttle_var ( 'shuttle_header_twittercustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_twittericonswitch == '1' and ! empty( $shuttle_header_twittercustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.twitter a,';
		$output .= '#pre-header-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.twitter a,';
		$output .= '#post-footer-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Google+ - Custom Icon */
function shuttle_input_googleicon(){

// Get theme options values.
$shuttle_header_googleiconswitch = shuttle_var ( 'shuttle_header_googleiconswitch' );
$shuttle_header_googlecustomicon = shuttle_var ( 'shuttle_header_googlecustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_googleiconswitch == '1' and ! empty( $shuttle_header_googlecustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.google-plus a,';
		$output .= '#pre-header-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.google-plus a,';
		$output .= '#post-footer-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Instagram - Custom Icon */
function shuttle_input_instagramicon(){

// Get theme options values.
$shuttle_header_instagramiconswitch = shuttle_var ( 'shuttle_header_instagramiconswitch' );
$shuttle_header_instagramcustomicon = shuttle_var ( 'shuttle_header_instagramcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_instagramiconswitch == '1' and ! empty( $shuttle_header_instagramcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.instagram a,';
		$output .= '#pre-header-social li.instagram a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_instagramcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.instagram i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.instagram a,';
		$output .= '#post-footer-social li.instagram a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_instagramcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.instagram i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Tumblr - Custom Icon */
function shuttle_input_tumblricon(){

// Get theme options values.
$shuttle_header_tumblriconswitch = shuttle_var ( 'shuttle_header_tumblriconswitch' );
$shuttle_header_tumblrcustomicon = shuttle_var ( 'shuttle_header_tumblrcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_tumblriconswitch == '1' and ! empty( $shuttle_header_tumblrcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.tumblr a,';
		$output .= '#pre-header-social li.tumblr a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_tumblrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.tumblr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.tumblr a,';
		$output .= '#post-footer-social li.tumblr a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_tumblrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.tumblr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* LinkedIn - Custom Icon */
function shuttle_input_linkedinicon(){

// Get theme options values.
$shuttle_header_linkediniconswitch = shuttle_var ( 'shuttle_header_linkediniconswitch' );
$shuttle_header_linkedincustomicon = shuttle_var ( 'shuttle_header_linkedincustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_linkediniconswitch == '1' and ! empty( $shuttle_header_linkedincustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.linkedin a,';
		$output .= '#pre-header-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.linkedin a,';
		$output .= '#post-footer-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Flickr - Custom Icon */
function shuttle_input_flickricon(){

// Get theme options values.
$shuttle_header_flickriconswitch = shuttle_var ( 'shuttle_header_flickriconswitch' );
$shuttle_header_flickrcustomicon = shuttle_var ( 'shuttle_header_flickrcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_flickriconswitch == '1' and ! empty( $shuttle_header_flickrcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.flickr a,';
		$output .= '#pre-header-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.flickr a,';
		$output .= '#post-footer-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Pinterest - Custom Icon */
function shuttle_input_pinteresticon(){

// Get theme options values.
$shuttle_header_pinteresticonswitch = shuttle_var ( 'shuttle_header_pinteresticonswitch' );
$shuttle_header_pinterestcustomicon = shuttle_var ( 'shuttle_header_pinterestcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_pinteresticonswitch == '1' and ! empty( $shuttle_header_pinterestcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.pinterest a,';
		$output .= '#pre-header-social li.pinterest a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_pinterestcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.pinterest i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.pinterest a,';
		$output .= '#post-footer-social li.pinterest a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_pinterestcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.pinterest i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Xing - Custom Icon */
function shuttle_input_xingicon(){

// Get theme options values.
$shuttle_header_xingiconswitch = shuttle_var ( 'shuttle_header_xingiconswitch' );
$shuttle_header_xingcustomicon = shuttle_var ( 'shuttle_header_xingcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_xingiconswitch == '1' and ! empty( $shuttle_header_xingcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.xing a,';
		$output .= '#pre-header-social li.xing a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_xingcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.xing i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.xing a,';
		$output .= '#post-footer-social li.xing a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_xingcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.xing i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* PayPal - Custom Icon */
function shuttle_input_paypalicon(){

// Get theme options values.
$shuttle_header_paypaliconswitch = shuttle_var ( 'shuttle_header_paypaliconswitch' );
$shuttle_header_paypalcustomicon = shuttle_var ( 'shuttle_header_paypalcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_paypaliconswitch == '1' and ! empty( $shuttle_header_paypalcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.paypal a,';
		$output .= '#pre-header-social li.paypal a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_paypalcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.paypal i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.paypal a,';
		$output .= '#post-footer-social li.paypal a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_paypalcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.paypal i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* YouTube - Custom Icon */
function shuttle_input_youtubeicon(){

// Get theme options values.
$shuttle_header_youtubeiconswitch = shuttle_var ( 'shuttle_header_youtubeiconswitch' );
$shuttle_header_youtubecustomicon = shuttle_var ( 'shuttle_header_youtubecustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_youtubeiconswitch == '1' and ! empty( $shuttle_header_youtubecustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.youtube a,';
		$output .= '#pre-header-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.youtube a,';
		$output .= '#post-footer-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Vimeo - Custom Icon */
function shuttle_input_vimeoicon(){

// Get theme options values.
$shuttle_header_vimeoiconswitch = shuttle_var ( 'shuttle_header_vimeoiconswitch' );
$shuttle_header_vimeocustomicon = shuttle_var ( 'shuttle_header_vimeocustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_vimeoiconswitch == '1' and ! empty( $shuttle_header_vimeocustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.vimeo-square a,';
		$output .= '#pre-header-social li.vimeo-square a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_vimeocustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.vimeo-square i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.vimeo-square a,';
		$output .= '#post-footer-social li.vimeo-square a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_vimeocustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.vimeo-square i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* RSS - Custom Icon */
function shuttle_input_rssicon(){

// Get theme options values.
$shuttle_header_rssiconswitch = shuttle_var ( 'shuttle_header_rssiconswitch' );
$shuttle_header_rsscustomicon = shuttle_var ( 'shuttle_header_rsscustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_rssiconswitch == '1' and ! empty( $shuttle_header_rsscustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.rss a,';
		$output .= '#pre-header-social li.rss a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_rsscustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.rss i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.rss a,';
		$output .= '#post-footer-social li.rss a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_rsscustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.rss i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Email - Custom Icon */
function shuttle_input_emailicon(){

// Get theme options values.
$shuttle_header_emailiconswitch = shuttle_var ( 'shuttle_header_emailiconswitch' );
$shuttle_header_emailcustomicon = shuttle_var ( 'shuttle_header_emailcustomicon', 'url' );

	$output = NULL;

	if ( $shuttle_header_emailiconswitch == '1' and ! empty( $shuttle_header_emailcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.envelope a,';
		$output .= '#pre-header-social li.envelope a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_emailcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 40px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.envelope i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.envelope a,';
		$output .= '#post-footer-social li.envelope a:hover {';
		$output .= 'background: url("' . esc_url( $shuttle_header_emailcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.envelope i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Input Custom Social Media Icons */
function shuttle_input_socialicon(){

	$output = NULL;
	
	$output .= shuttle_input_facebookicon();
	$output .= shuttle_input_twittericon();
	$output .= shuttle_input_googleicon();
	$output .= shuttle_input_instagramicon();
	$output .= shuttle_input_tumblricon();
	$output .= shuttle_input_linkedinicon();
	$output .= shuttle_input_flickricon();
	$output .= shuttle_input_pinteresticon();
	$output .= shuttle_input_xingicon();
	$output .= shuttle_input_paypalicon();
	$output .= shuttle_input_youtubeicon();
	$output .= shuttle_input_vimeoicon();
	$output .= shuttle_input_rssicon();
	$output .= shuttle_input_emailicon();

	if ( ! empty( $output ) ) {
		echo '<style type="text/css">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'shuttle_input_socialicon', 13 );


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - OUTPUT SOCIAL MEDIA SELECTIONS (HEADER) (ADD IN LATER)
---------------------------------------------------------------------------------- */

function shuttle_input_socialmediaheader() {

// Get theme options values.
$shuttle_header_socialswitch    = shuttle_var ( 'shuttle_header_socialswitch' );
$shuttle_header_socialmessage   = shuttle_var ( 'shuttle_header_socialmessage' );
$shuttle_header_facebookswitch  = shuttle_var ( 'shuttle_header_facebookswitch' );
$shuttle_header_facebooklink    = shuttle_var ( 'shuttle_header_facebooklink' );
$shuttle_header_twitterswitch   = shuttle_var ( 'shuttle_header_twitterswitch' );
$shuttle_header_twitterlink     = shuttle_var ( 'shuttle_header_twitterlink' );
$shuttle_header_googleswitch    = shuttle_var ( 'shuttle_header_googleswitch' );
$shuttle_header_googlelink      = shuttle_var ( 'shuttle_header_googlelink' );
$shuttle_header_instagramswitch = shuttle_var ( 'shuttle_header_instagramswitch' );
$shuttle_header_instagramlink   = shuttle_var ( 'shuttle_header_instagramlink' );
$shuttle_header_tumblrswitch    = shuttle_var ( 'shuttle_header_tumblrswitch' );
$shuttle_header_tumblrlink      = shuttle_var ( 'shuttle_header_tumblrlink' );
$shuttle_header_linkedinswitch  = shuttle_var ( 'shuttle_header_linkedinswitch' );
$shuttle_header_linkedinlink    = shuttle_var ( 'shuttle_header_linkedinlink' );
$shuttle_header_flickrswitch    = shuttle_var ( 'shuttle_header_flickrswitch' );
$shuttle_header_flickrlink      = shuttle_var ( 'shuttle_header_flickrlink' );
$shuttle_header_pinterestswitch = shuttle_var ( 'shuttle_header_pinterestswitch' );
$shuttle_header_pinterestlink   = shuttle_var ( 'shuttle_header_pinterestlink' );
$shuttle_header_xingswitch      = shuttle_var ( 'shuttle_header_xingswitch' );
$shuttle_header_xinglink        = shuttle_var ( 'shuttle_header_xinglink' );
$shuttle_header_paypalswitch    = shuttle_var ( 'shuttle_header_paypalswitch' );
$shuttle_header_paypallink      = shuttle_var ( 'shuttle_header_paypallink' );
$shuttle_header_vimeoswitch     = shuttle_var ( 'shuttle_header_vimeoswitch' );
$shuttle_header_vimeolink       = shuttle_var ( 'shuttle_header_vimeolink' );
$shuttle_header_youtubeswitch   = shuttle_var ( 'shuttle_header_youtubeswitch' );
$shuttle_header_youtubelink     = shuttle_var ( 'shuttle_header_youtubelink' );
$shuttle_header_rssswitch       = shuttle_var ( 'shuttle_header_rssswitch' );
$shuttle_header_rsslink         = shuttle_var ( 'shuttle_header_rsslink' );
$shuttle_header_emailswitch     = shuttle_var ( 'shuttle_header_emailswitch' );
$shuttle_header_emaillink       = shuttle_var ( 'shuttle_header_emaillink' );

// Reset count values used in foreach loop
$i = 0;
$j = 0;

	if ( $shuttle_header_socialswitch == '1' ) {

		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => 'Facebook',  'icon' => 'facebook',     'toggle' => $shuttle_header_facebookswitch,  'link' => $shuttle_header_facebooklink ),
			array( 'social' => 'Twitter',   'icon' => 'twitter',      'toggle' => $shuttle_header_twitterswitch,   'link' => $shuttle_header_twitterlink ),
			array( 'social' => 'Google+',   'icon' => 'google-plus',  'toggle' => $shuttle_header_googleswitch,    'link' => $shuttle_header_googlelink ),
			array( 'social' => 'Instagram', 'icon' => 'instagram',    'toggle' => $shuttle_header_instagramswitch, 'link' => $shuttle_header_instagramlink ),
			array( 'social' => 'Tumblr',    'icon' => 'tumblr',       'toggle' => $shuttle_header_tumblrswitch,    'link' => $shuttle_header_tumblrlink ),
			array( 'social' => 'LinkedIn',  'icon' => 'linkedin',     'toggle' => $shuttle_header_linkedinswitch,  'link' => $shuttle_header_linkedinlink ),
			array( 'social' => 'Flickr',    'icon' => 'flickr',       'toggle' => $shuttle_header_flickrswitch,    'link' => $shuttle_header_flickrlink ),
			array( 'social' => 'Pinterest', 'icon' => 'pinterest',    'toggle' => $shuttle_header_pinterestswitch, 'link' => $shuttle_header_pinterestlink ),
			array( 'social' => 'Xing',      'icon' => 'xing',         'toggle' => $shuttle_header_xingswitch,      'link' => $shuttle_header_xinglink ),
			array( 'social' => 'PayPal',    'icon' => 'paypal',       'toggle' => $shuttle_header_paypalswitch,    'link' => $shuttle_header_paypallink ),
			array( 'social' => 'Vimeo',     'icon' => 'vimeo-square', 'toggle' => $shuttle_header_vimeoswitch,     'link' => $shuttle_header_vimeolink ),
			array( 'social' => 'YouTube',   'icon' => 'youtube',      'toggle' => $shuttle_header_youtubeswitch,   'link' => $shuttle_header_youtubelink ),
			array( 'social' => 'RSS',       'icon' => 'rss',          'toggle' => $shuttle_header_rssswitch,       'link' => $shuttle_header_rsslink ),
			array( 'social' => 'Email',     'icon' => 'envelope',     'toggle' => $shuttle_header_emailswitch,     'link' => $shuttle_header_emaillink ),
		);


		// Output social media links if any link is set
		foreach( $social_links as $social ) {	
			if ( ! empty( $social['link'] ) and $j == 0 ) {
				echo '<div id="pre-header-social"><ul>'; $j = 1;

				if ( ! empty ( $shuttle_header_socialmessage ) ) {
					echo '<li class="social message">' . shuttle_input_socialmessage() . '</li>';
				}
			}

			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {

			echo '<li class="social ' . esc_attr( $social['icon'] ) . '">',
				 '<a href="' . esc_url( $social['link'] ) . '" data-tip="bottom" data-original-title="' . esc_attr( $social['social'] ) . '" target="_blank">',
				 '<i class="fa fa-' . esc_attr( $social['icon'] ) . '"></i>',
				 '</a>',
				 '</li>';
			}
		}

		// Close list output of social media links if any link is set
		if ( $j !== 0 ) echo '</ul></div>';
	}
}


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - OUTPUT SOCIAL MEDIA SELECTIONS (FOOTER)
---------------------------------------------------------------------------------- */

function shuttle_input_socialmediafooter() {

// Get theme options values.
$shuttle_header_socialswitchfooter = shuttle_var ( 'shuttle_header_socialswitchfooter' );
$shuttle_header_socialmessage      = shuttle_var ( 'shuttle_header_socialmessage' );
$shuttle_header_facebookswitch     = shuttle_var ( 'shuttle_header_facebookswitch' );
$shuttle_header_facebooklink       = shuttle_var ( 'shuttle_header_facebooklink' );
$shuttle_header_twitterswitch      = shuttle_var ( 'shuttle_header_twitterswitch' );
$shuttle_header_twitterlink        = shuttle_var ( 'shuttle_header_twitterlink' );
$shuttle_header_googleswitch       = shuttle_var ( 'shuttle_header_googleswitch' );
$shuttle_header_googlelink         = shuttle_var ( 'shuttle_header_googlelink' );
$shuttle_header_instagramswitch    = shuttle_var ( 'shuttle_header_instagramswitch' );
$shuttle_header_instagramlink      = shuttle_var ( 'shuttle_header_instagramlink' );
$shuttle_header_tumblrswitch       = shuttle_var ( 'shuttle_header_tumblrswitch' );
$shuttle_header_tumblrlink         = shuttle_var ( 'shuttle_header_tumblrlink' );
$shuttle_header_linkedinswitch     = shuttle_var ( 'shuttle_header_linkedinswitch' );
$shuttle_header_linkedinlink       = shuttle_var ( 'shuttle_header_linkedinlink' );
$shuttle_header_flickrswitch       = shuttle_var ( 'shuttle_header_flickrswitch' );
$shuttle_header_flickrlink         = shuttle_var ( 'shuttle_header_flickrlink' );
$shuttle_header_pinterestswitch    = shuttle_var ( 'shuttle_header_pinterestswitch' );
$shuttle_header_pinterestlink      = shuttle_var ( 'shuttle_header_pinterestlink' );
$shuttle_header_xingswitch         = shuttle_var ( 'shuttle_header_xingswitch' );
$shuttle_header_xinglink           = shuttle_var ( 'shuttle_header_xinglink' );
$shuttle_header_paypalswitch       = shuttle_var ( 'shuttle_header_paypalswitch' );
$shuttle_header_paypallink         = shuttle_var ( 'shuttle_header_paypallink' );
$shuttle_header_vimeoswitch        = shuttle_var ( 'shuttle_header_vimeoswitch' );
$shuttle_header_vimeolink          = shuttle_var ( 'shuttle_header_vimeolink' );
$shuttle_header_youtubeswitch      = shuttle_var ( 'shuttle_header_youtubeswitch' );
$shuttle_header_youtubelink        = shuttle_var ( 'shuttle_header_youtubelink' );
$shuttle_header_rssswitch          = shuttle_var ( 'shuttle_header_rssswitch' );
$shuttle_header_rsslink            = shuttle_var ( 'shuttle_header_rsslink' );
$shuttle_header_emailswitch        = shuttle_var ( 'shuttle_header_emailswitch' );
$shuttle_header_emaillink          = shuttle_var ( 'shuttle_header_emaillink' );

// Reset count values used in foreach loop
$i = 0;
$j = 0;

	if ( $shuttle_header_socialswitchfooter == '1' ) {
	
		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => 'Facebook',  'icon' => 'facebook',     'toggle' => $shuttle_header_facebookswitch,  'link' => $shuttle_header_facebooklink ),
			array( 'social' => 'Twitter',   'icon' => 'twitter',      'toggle' => $shuttle_header_twitterswitch,   'link' => $shuttle_header_twitterlink ),
			array( 'social' => 'Google+',   'icon' => 'google-plus',  'toggle' => $shuttle_header_googleswitch,    'link' => $shuttle_header_googlelink ),
			array( 'social' => 'Instagram', 'icon' => 'instagram',    'toggle' => $shuttle_header_instagramswitch, 'link' => $shuttle_header_instagramlink ),
			array( 'social' => 'Tumblr',    'icon' => 'tumblr',       'toggle' => $shuttle_header_tumblrswitch,    'link' => $shuttle_header_tumblrlink ),
			array( 'social' => 'LinkedIn',  'icon' => 'linkedin',     'toggle' => $shuttle_header_linkedinswitch,  'link' => $shuttle_header_linkedinlink ),
			array( 'social' => 'Flickr',    'icon' => 'flickr',       'toggle' => $shuttle_header_flickrswitch,    'link' => $shuttle_header_flickrlink ),
			array( 'social' => 'Pinterest', 'icon' => 'pinterest',    'toggle' => $shuttle_header_pinterestswitch, 'link' => $shuttle_header_pinterestlink ),
			array( 'social' => 'Xing',      'icon' => 'xing',         'toggle' => $shuttle_header_xingswitch,      'link' => $shuttle_header_xinglink ),
			array( 'social' => 'PayPal',    'icon' => 'paypal',       'toggle' => $shuttle_header_paypalswitch,    'link' => $shuttle_header_paypallink ),
			array( 'social' => 'Vimeo',     'icon' => 'vimeo-square', 'toggle' => $shuttle_header_vimeoswitch,     'link' => $shuttle_header_vimeolink ),
			array( 'social' => 'YouTube',   'icon' => 'youtube',      'toggle' => $shuttle_header_youtubeswitch,   'link' => $shuttle_header_youtubelink ),
			array( 'social' => 'RSS',       'icon' => 'rss',          'toggle' => $shuttle_header_rssswitch,       'link' => $shuttle_header_rsslink ),
			array( 'social' => 'Email',     'icon' => 'envelope',     'toggle' => $shuttle_header_emailswitch,     'link' => $shuttle_header_emaillink ),
		);


		// Output social media links if any link is set
		foreach( $social_links as $social ) {	
			if ( ! empty( $social['link'] ) and $j == 0 ) {
				echo '<div id="post-footer-social"><ul>'; $j = 1;

				if ( ! empty ( $shuttle_header_socialmessage ) ) {
					echo '<li class="social message">' . shuttle_input_socialmessage() . '</li>';
				}
			}

			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {

			echo '<li class="social ' . esc_attr( $social['icon'] ) . '">',
				 '<a href="' . esc_url( $social['link'] ) . '" data-tip="top" data-original-title="' . esc_attr( $social['social'] ) . '" target="_blank">',
				 '<i class="fa fa-' . esc_attr( $social['icon'] ) . '"></i>',
				 '</a>',
				 '</li>';
			}
		}

		// Close list output of social media links if any link is set
		if ( $j !== 0 ) echo '</ul></div>';
	}
}

?>