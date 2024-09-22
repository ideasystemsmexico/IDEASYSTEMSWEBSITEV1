<?php
defined( 'ABSPATH' ) || die();

class STSSM_Helper {
	public static function icons_placement_enable_list() {
		return array(
			'sticky_icons_enable' => esc_html__( 'Enable Sticky Icons', 'share-social-media' ),
			'all_pages_enable'    => esc_html__( 'Enable on all Pages', 'share-social-media' ),
			'all_posts_enable'    => esc_html__( 'Enable on all Posts', 'share-social-media' ),
		);
	}

	public static function icons_placement_list_sticky() {
		return array(
			'left'  => esc_html__( 'Left', 'share-social-media' ),
			'right' => esc_html__( 'Right', 'share-social-media' ),
		);
	}

	public static function icons_placement_list_pages() {
		return array(
			'before_content' => esc_html__( 'Before Content', 'share-social-media' ),
			'after_content'  => esc_html__( 'After Content', 'share-social-media' ),
		);
	}

	public static function icons_placement_list_posts() {
		return array(
			'before_content' => esc_html__( 'Before Content', 'share-social-media' ),
			'after_content'  => esc_html__( 'After Content', 'share-social-media' ),
		);
	}

	public static function icons_shape_list() {
		return array(
			'square' => esc_html__( 'Square', 'share-social-media' ),
			'circle' => esc_html__( 'Circle', 'share-social-media' ),
		);
	}

	public static function icons_class() {
		return apply_filters(
			'stssm_icons_class',
			array(
				'facebook'  => array(
					'class' => 'ssm-fab ssm-fa-facebook-f',
					'label' => esc_attr__( 'Share on Facebook', 'share-social-media' ),
				),
				'twitter'   => array(
					'class' => 'ssm-fab ssm-fa-twitter',
					'label' => esc_attr__( 'Share on Twitter', 'share-social-media' ),
				),
				'linkedin'  => array(
					'class' => 'ssm-fab ssm-fa-linkedin',
					'label' => esc_attr__( 'Share on LinkedIn', 'share-social-media' ),
				),
				'pinterest' => array(
					'class' => 'ssm-fab ssm-fa-pinterest',
					'label' => esc_attr__( 'Share on Pinterest', 'share-social-media' ),
				),
				'reddit'    => array(
					'class' => 'ssm-fab ssm-fa-reddit',
					'label' => esc_attr__( 'Share on Reddit', 'share-social-media' ),
				),
				'tumblr'    => array(
					'class' => 'ssm-fab ssm-fa-tumblr',
					'label' => esc_attr__( 'Share on Tumblr', 'share-social-media' ),
				),
				'xtwitter'  => array(
					'class' => 'ssm-fab ssm-fa-x-twitter',
					'label' => esc_attr__( 'Share on X (Twitter)', 'share-social-media' ),
				),
				'blogger'   => array(
					'class' => 'ssm-fab ssm-fa-blogger',
					'label' => esc_attr__( 'Share on Blogger', 'share-social-media' ),
				),
				'evernote'  => array(
					'class' => 'ssm-fab ssm-fa-evernote',
					'label' => esc_attr__( 'Share on Evernote', 'share-social-media' ),
				),
				'flipboard' => array(
					'class' => 'ssm-fab ssm-fa-flipboard',
					'label' => esc_attr__( 'Share on Flipboard', 'share-social-media' ),
				),
				'getpocket' => array(
					'class' => 'ssm-fab ssm-fa-get-pocket',
					'label' => esc_attr__( 'Share on Pocket', 'share-social-media' ),
				),
				'wordpress' => array(
					'class' => 'ssm-fab ssm-fa-wordpress-simple',
					'label' => esc_attr__( 'Share on WordPress.com', 'share-social-media' ),
				),
				'line'      => array(
					'class' => 'ssm-fab ssm-fa-line',
					'label' => esc_attr__( 'Share on Line', 'share-social-media' ),
				),
				'whatsapp'  => array(
					'class' => 'ssm-fab ssm-fa-whatsapp',
					'label' => esc_attr__( 'Share on Whatsapp', 'share-social-media' ),
				),
				'envelope'  => array(
					'class' => 'ssm-fas ssm-fa-envelope',
					'label' => esc_attr__( 'Share via Email', 'share-social-media' ),
				),
			)
		);
	}

	public static function icons_content() {
		return array( 'facebook', 'linkedin', 'pinterest', 'reddit', 'tumblr', 'xtwitter', 'blogger', 'evernote', 'getpocket', 'wordpress', 'line', 'whatsapp', 'envelope' );
	}

	public static function icons_sticky_side() {
		return array( 'facebook', 'linkedin', 'reddit', 'xtwitter', 'whatsapp', 'envelope' );
	}

	public static function icons_sticky_all() {
		return array( 'facebook', 'linkedin', 'pinterest', 'reddit', 'tumblr', 'xtwitter', 'blogger', 'evernote', 'getpocket', 'wordpress', 'line', 'whatsapp', 'envelope' );
	}

	public static function get_sticky_placement() {
		$placement = get_option( 'stssm_sticky_placement' );
		if ( ! is_array( $placement ) ) {
			$placement = array();
		}

		if ( ! isset( $placement['enable'] ) ) {
			$placement['enable'] = true;
		}
		if ( ! isset( $placement['place'] ) ) {
			$placement['place'] = 'right';
		}

		return $placement;
	}

	public static function get_pages_placement() {
		$placement = get_option( 'stssm_pages_placement' );
		if ( ! is_array( $placement ) ) {
			$placement = array();
		}

		if ( ! isset( $placement['enable'] ) ) {
			$placement['enable'] = false;
		}
		if ( ! isset( $placement['after_content'] ) ) {
			$placement['after_content'] = true;
		}
		if ( ! isset( $placement['before_content'] ) ) {
			$placement['before_content'] = false;
		}

		return $placement;
	}

	public static function get_posts_placement() {
		$placement = get_option( 'stssm_posts_placement' );
		if ( ! is_array( $placement ) ) {
			$placement = array();
		}

		if ( ! isset( $placement['enable'] ) ) {
			$placement['enable'] = true;
		}
		if ( ! isset( $placement['after_content'] ) ) {
			$placement['after_content'] = true;
		}
		if ( ! isset( $placement['before_content'] ) ) {
			$placement['before_content'] = false;
		}

		return $placement;
	}

	public static function get_content_icons_design() {
		$design = get_option( 'stssm_content_icons_design' );
		if ( ! is_array( $design ) ) {
			$design = array();
		}

		if ( ! isset( $design['shape'] ) ) {
			$design['shape'] = 'circle';
		}
		if ( ! isset( $design['w'] ) ) {
			$design['w'] = 30;
		}
		if ( ! isset( $design['h'] ) ) {
			$design['h'] = 30;
		}
		if ( ! isset( $design['ml'] ) ) {
			$design['ml'] = 0;
		}
		if ( ! isset( $design['mr'] ) ) {
			$design['mr'] = 8;
		}
		if ( ! isset( $design['mt'] ) ) {
			$design['mt'] = 4;
		}
		if ( ! isset( $design['mb'] ) ) {
			$design['mb'] = 4;
		}

		return $design;
	}

	public static function get_sticky_icons_design() {
		$design = get_option( 'stssm_sticky_icons_design' );
		if ( ! is_array( $design ) ) {
			$design = array();
		}

		if ( ! isset( $design['shape'] ) ) {
			$design['shape'] = 'circle';
		}
		if ( ! isset( $design['w'] ) ) {
			$design['w'] = 30;
		}
		if ( ! isset( $design['h'] ) ) {
			$design['h'] = 30;
		}
		if ( ! isset( $design['mt'] ) ) {
			$design['mt'] = 6;
		}
		if ( ! isset( $design['mb'] ) ) {
			$design['mb'] = 6;
		}

		return $design;
	}

	public static function get_icons_content() {
		$icons = get_option( 'stssm_icons_content' );
		if ( ! is_array( $icons ) ) {
			$icons = array();
		}

		if ( count( $icons ) < 1 ) {
			return array_intersect_key( self::icons_class(), array_flip( self::icons_content() ) );
		}

		return array_intersect_key( self::icons_class(), array_flip( $icons ) );
	}

	public static function get_icons_sticky() {
		$icons = get_option( 'stssm_icons_sticky' );
		if ( ! is_array( $icons ) ) {
			$icons = array();
		}

		if ( count( $icons ) < 1 ) {
			return array_intersect_key( self::icons_class(), array_flip( self::icons_sticky_side() ) );
		}

		return array_intersect_key( self::icons_class(), array_flip( $icons ) );
	}

	public static function get_icons_sticky_all() {
		$icons = get_option( 'stssm_icons_sticky_all' );
		if ( ! is_array( $icons ) ) {
			$icons = array();
		}

		if ( count( $icons ) < 1 ) {
			return array_intersect_key( self::icons_class(), array_flip( self::icons_sticky_all() ) );
		}

		return array_intersect_key( self::icons_class(), array_flip( $icons ) );
	}

	public static function get_pro_detail_url() {
		return 'https://scriptstown.com/wordpress-plugins/login-security-pro/';
	}

	public static function get_pro_url() {
		return 'https://scriptstown.com/account/signup/login-security-pro';
	}
}
