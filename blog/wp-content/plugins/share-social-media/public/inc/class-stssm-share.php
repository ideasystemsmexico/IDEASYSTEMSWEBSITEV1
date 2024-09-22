<?php
defined( 'ABSPATH' ) || die();
require_once STSSM_PLUGIN_DIR_PATH . 'includes/class-stssm-helper.php';

class STSSM_Share {
	public static function add_icons_to_content( $content ) {
		$post_type = get_post_type();

		$pages_placement = STSSM_Helper::get_pages_placement();
		$posts_placement = STSSM_Helper::get_posts_placement();

		$post_types = array();
		if ( $pages_placement['enable'] ) {
			array_push( $post_types, 'page' );
		}
		if ( $posts_placement['enable'] ) {
			array_push( $post_types, 'post' );
		}

		if ( count( $post_types ) && is_singular( $post_types ) && in_array( $post_type, $post_types, true ) ) {
			$icons_content = STSSM_Helper::get_icons_content();
			ob_start();
			echo '<ul class="stssm-social-icons stssm-content-social-icons">';
			foreach ( $icons_content as $icon => $val ) {
				echo ( '<li class="ssm-' . esc_attr( $icon ) . '"><i tabindex="0" role="button" class="' . esc_attr( $val['class'] ) . '" aria-label="' . esc_attr( $val['label'] ) . '"></i></li>' );
			}
			echo '</ul>';
			$social_icons = ob_get_clean();

			if ( is_singular( 'post' ) && ( 'post' === $post_type ) ) {
				if ( $posts_placement['after_content'] ) {
					$content .= ( '<div class="stssm-after-content">' . $social_icons . '</div>' );
				}
				if ( $posts_placement['before_content'] ) {
					$content = ( ( '<div class="stssm-before-content">' . $social_icons . '</div>' ) . $content );
				}
			} elseif ( is_singular( 'page' ) && ( 'page' === $post_type ) ) {
				if ( $pages_placement['after_content'] ) {
					$content .= ( '<div class="stssm-after-content">' . $social_icons . '</div>' );
				}
				if ( $pages_placement['before_content'] ) {
					$content = ( ( '<div class="stssm-before-content">' . $social_icons . '</div>' ) . $content );
				}
			}
		}

		return $content;
	}

	public static function enqueue_scripts() {
		$sticky_placement = STSSM_Helper::get_sticky_placement();

		$enqueue = false;

		$sticky = '0';
		if ( $sticky_placement['enable'] ) {
			$enqueue = true;
			$sticky  = '1';
		}

		$content = '0';
		if ( is_singular( 'post' ) ) {
			$posts_placement = STSSM_Helper::get_posts_placement();
			if ( $posts_placement['enable'] ) {
				$enqueue = true;
				$content = '1';
			}
		} elseif ( is_singular( 'page' ) ) {
			$pages_placement = STSSM_Helper::get_pages_placement();
			if ( $pages_placement['enable'] ) {
				$enqueue = true;
				$content = '1';
			}
		}

		if ( $enqueue ) {
			wp_register_style( 'stssm', STSSM_PLUGIN_URL . 'assets/css/stssm.min.css', array(), STSSM_PLUGIN_VERSION, 'all' );
			wp_enqueue_style( 'stssm' );
			wp_style_add_data( 'stssm', 'rtl', 'replace' );

			if ( $content || $sticky ) {
				$content_icons_design = STSSM_Helper::get_content_icons_design();

				$content_css = '';

				if ( 'square' === $content_icons_design['shape'] ) {
					$content_css .= '.stssm-content-social-icons i { border-radius: 0; }';
				}
				if ( 30 !== $content_icons_design['w'] ) {
					$content_css .= ( '.stssm-content-social-icons .ssm-fab, .stssm-content-social-icons .ssm-fas { width: ' . absint( $content_icons_design['w'] ) . 'px; }' );
				}
				if ( 30 !== $content_icons_design['h'] ) {
					$content_css .= ( '.stssm-content-social-icons .ssm-fab, .stssm-content-social-icons .ssm-fas { height: ' . absint( $content_icons_design['h'] ) . 'px; line-height: ' . absint( $content_icons_design['h'] ) . 'px; font-size: ' . absint( $content_icons_design['h'] * 0.6 ) . 'px; }' );
				}
				if ( 0 !== $content_icons_design['ml'] ) {
					$content_css .= ( '.stssm-content-social-icons li { margin-left: ' . absint( $content_icons_design['ml'] ) . 'px !important; }' );
				}
				if ( 8 !== $content_icons_design['mr'] ) {
					$content_css .= ( '.stssm-content-social-icons li { margin-right: ' . absint( $content_icons_design['mr'] ) . 'px !important; }' );
				}
				if ( 4 !== $content_icons_design['mt'] ) {
					$content_css .= ( '.stssm-content-social-icons li { margin-top: ' . absint( $content_icons_design['mt'] ) . 'px !important; }' );
				}
				if ( 4 !== $content_icons_design['mb'] ) {
					$content_css .= ( '.stssm-content-social-icons li { margin-bottom: ' . absint( $content_icons_design['mb'] ) . 'px !important; }' );
				}

				if ( $content_css ) {
					wp_add_inline_style( 'stssm', $content_css );
				}

				if ( $sticky ) {
					$sticky_icons_design = STSSM_Helper::get_sticky_icons_design();

					$sticky_css = '';

					$apply_sticky_width = ( 30 !== $sticky_icons_design['w'] );

					if ( 'square' === $sticky_icons_design['shape'] ) {
						$sticky_css .= '.stssm-sticky-social-icons i { border-radius: 0; }';
					}
					if ( $apply_sticky_width ) {
						$sticky_css .= ( '.stssm-sticky-social-icons .ssm-fab, .stssm-sticky-social-icons .ssm-fas { width: ' . absint( $sticky_icons_design['w'] ) . 'px; }' );
					}
					if ( 30 !== $sticky_icons_design['h'] ) {
						$sticky_css .= ( '.stssm-sticky-social-icons .ssm-fab, .stssm-sticky-social-icons .ssm-fas { height: ' . absint( $sticky_icons_design['h'] ) . 'px; line-height: ' . absint( $sticky_icons_design['h'] ) . 'px; font-size: ' . absint( $sticky_icons_design['h'] * 0.6 ) . 'px; }' );
					}
					if ( 6 !== $sticky_icons_design['mt'] ) {
						$sticky_css .= ( '.stssm-sticky-social-icons li:not([class*="ssm-action"]) { margin-top: ' . absint( $sticky_icons_design['mt'] ) . 'px !important; }' );
					}
					if ( 6 !== $sticky_icons_design['mb'] ) {
						$sticky_css .= ( '.stssm-sticky-social-icons li:not([class*="ssm-action"]) { margin-bottom: ' . absint( $sticky_icons_design['mb'] ) . 'px !important; }' );
					}

					if ( $sticky_css ) {
						wp_add_inline_style( 'stssm', $sticky_css );
					}

					if ( 'right' === $sticky_placement['place'] ) {
						wp_enqueue_style( 'stssm-sticky-right', STSSM_PLUGIN_URL . 'assets/css/stssm-sticky-right.css', array(), STSSM_PLUGIN_VERSION, 'all' );
						if ( $apply_sticky_width ) {
							$sticky_right_css = ( '.stssm-hide li:not(.stssm-toggle-icons) { transform: translateX(' . absint( $sticky_icons_design['w'] ) . 'px); }' );
							wp_add_inline_style( 'stssm-sticky-right', $sticky_right_css );
						}
					} else {
						wp_enqueue_style( 'stssm-sticky-left', STSSM_PLUGIN_URL . 'assets/css/stssm-sticky-left.css', array(), STSSM_PLUGIN_VERSION, 'all' );
						if ( $apply_sticky_width ) {
							$sticky_left_css = ( '.stssm-hide li:not(.stssm-toggle-icons) { transform: translateX(-' . absint( $sticky_icons_design['w'] ) . 'px); }' );
							wp_add_inline_style( 'stssm-sticky-left', $sticky_left_css );
						}
					}
				}
			}

			wp_enqueue_script( 'stssm', STSSM_PLUGIN_URL . 'assets/js/stssm.min.js', array(), STSSM_PLUGIN_VERSION, true );

			$title = '';
			$desc  = '';
			$image = '';
			if ( is_singular() ) {
				$title = get_the_title();
				$desc  = get_the_excerpt();
				$image = get_the_post_thumbnail_url();
			} elseif ( is_archive() ) {
				$title = get_the_archive_title();
				$desc  = get_the_archive_description();
			}

			if ( '' === $title ) {
				$title = get_bloginfo( 'name' );
			}

			if ( '' === $desc ) {
				$desc = get_bloginfo( 'description' );
			}

			if ( ! $image ) {
				$image = wp_get_attachment_url( get_theme_mod( 'custom_logo' ) );
			}

			$params = array(
				'sticky' => $sticky,
				'title'  => esc_html( $title ),
				'desc'   => esc_html( $desc ),
				'image'  => esc_url( $image ),
			);

			if ( $sticky ) {
				$params['iconsSticky']    = STSSM_Helper::get_icons_sticky();
				$params['iconsStickyAll'] = STSSM_Helper::get_icons_sticky_all();
				$params['label']          = array(
					'toggleIcons' => esc_attr__( 'Toggle social share buttons', 'share-social-media' ),
					'toggleModal' => esc_attr__( 'Toggle all social share buttons - modal', 'share-social-media' ),
					'closeModal'  => esc_attr__( 'Close modal - all social share buttons', 'share-social-media' ),
				);
			}

			wp_localize_script( 'stssm', 'stssm', $params );
		}
	}
}
