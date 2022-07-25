<?php
/**
 * Plugin Name: Kadence Widget Dock
 * Plugin URI:  https://www.kadencewp.com/product/kadence-widget-dock/
 * Description: A powerful widget dock that slides out to promote anything placed in the widget area.
 * Version:     1.0.6
 * Author:      Kadence WP
 * Author URI:  https://www.kadencewp.com/
 * Text Domain: kadence-widget-dock
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Kadence Widget Dock.
 */

/**
 * Load Translation
 */
function kt_widgetdock_load_textdomain() {
	load_plugin_textdomain( 'kadence-widget-dock', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'kt_widgetdock_load_textdomain' );


if ( ! defined( 'KTWD_PATH' ) ) {
	define( 'KTWD_PATH', realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR );
}
if ( ! defined( 'KTWD_URL' ) ) {
	define( 'KTWD_URL', plugin_dir_url( __FILE__ ) );
}
define( 'KTWD_VERSION', '1.0.6' );

/*
 * INIT
 */
require_once KTWD_PATH . '/admin/admin_options.php';

/**
 * Widget Dock init.
 */
function kt_widget_dock_plugin_loaded() {
	class Kadence_Widget_Dock {
		public function __construct() {
			$kt_widget_dock = get_option( 'kt_widget_dock' );
			if ( isset( $kt_widget_dock['enable_widget_dock'] ) && 1 == $kt_widget_dock['enable_widget_dock'] ) {
				add_action( 'widgets_init', array( $this, 'kadence_widget_dock_widget_init' ), 100 );
				add_action( 'wp_footer', array( $this, 'kadence_widget_dock_content' ) );
				add_filter( 'the_content', array( $this, 'kadence_widget_dock_after_content_span' ), 100 );
				add_action( 'wp_enqueue_scripts', array( $this, 'kadence_widget_dock_enqueue_scripts' ) );
			}
		}
		public function kadence_widget_dock_widget_init() {
			register_sidebar(
				array(
					'name'          => __( 'Widget Dock Widget Area', 'kadence-widget-dock' ),
					'id'            => 'ktwidgetdock',
					'before_widget' => '<div id="%1$s" class="widget kt-widget-dock-widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget-title kt-widget-dock-title">',
					'after_title'   => '</h5>',
				)
			);
		}
		public function kadence_widget_dock_after_content_span( $content ) {
			return $content . '<span class="kt-load-after-post"></span>';
		}
		public function kadence_widget_dock_content() {
			global $kt_widget_dock;
			if ( is_active_sidebar( 'ktwidgetdock' ) ) :
				if ( isset( $kt_widget_dock['widget_dock_target_visitor'] ) && $kt_widget_dock['widget_dock_target_visitor'] == 'loggedin' ) {
					if ( is_user_logged_in() ) {
						if ( isset( $kt_widget_dock['widget_dock_loggedin_visitors'] ) && ! empty( $kt_widget_dock['widget_dock_loggedin_visitors'] ) ) {
							global $current_user;
							$user_roles = $current_user->roles;
							if ( array_intersect( $user_roles, $kt_widget_dock['widget_dock_loggedin_visitors'] ) ) {
								 $visitor_show = true;
							} else {
								$visitor_show = false;
							}
						} else {
							$visitor_show = true;
						}
					} else {
						$visitor_show = false;
					}
				} else if ( isset( $kt_widget_dock['widget_dock_target_visitor'] ) && $kt_widget_dock['widget_dock_target_visitor'] == 'loggedout' ) {
					if ( is_user_logged_in() ) {
						$visitor_show = false;
					} else {
						$visitor_show = true;
					}
				} else {
					$visitor_show = true;
				}
				if ( apply_filters( 'kt_widget_dock_visitor', $visitor_show ) == true ) {

					if ( isset( $kt_widget_dock['widget_dock_target'] ) && $kt_widget_dock['widget_dock_target'] == 'sitewide' ) {
						$exclude_include = false;
						$show_dock = true;
					} else {
						$exclude_include = true;
						$show_dock = false;
					}
					if ( isset( $kt_widget_dock['widget_dock_post_types'] ) && ! empty( $kt_widget_dock['widget_dock_post_types'] ) ) {
						$post_type = get_post_type();
						if ( false != $post_type ) {
							if ( in_array( $post_type, $kt_widget_dock['widget_dock_post_types'] ) ) {
								$show_dock = $exclude_include;
							}
						}
					}
					$kt_post_id = get_the_ID();
					if ( isset( $kt_widget_dock['widget_dock_pages'] ) && ! empty( $kt_widget_dock['widget_dock_pages'] ) ) {
						if ( false != $kt_post_id ) {
							if ( in_array( $kt_post_id, $kt_widget_dock['widget_dock_pages'] ) ) {
								 $show_dock = $exclude_include;
							}
						}
					}
					if ( isset( $kt_widget_dock['widget_dock_posts'] ) && ! empty( $kt_widget_dock['widget_dock_posts'] ) ) {
						if ( $kt_post_id != false ) {
							if ( in_array( $kt_post_id, $kt_widget_dock['widget_dock_posts'] ) ) {
								$show_dock = $exclude_include;
							}
						}
					}
					if ( isset( $kt_widget_dock['widget_dock_custom_ids'] ) && ! empty( $kt_widget_dock['widget_dock_custom_ids'] ) ) {
						if ( $kt_post_id != false ) {
							$custom_id_array = explode( ',', $kt_widget_dock['widget_dock_custom_ids'] );
							if ( in_array( $kt_post_id, $custom_id_array ) ) {
								 $show_dock = $exclude_include;
							}
						}
					}
					if ( is_404() || is_search() ) {
						$show_dock = false;
					}
					if ( apply_filters( 'kt_widget_dock_show', $show_dock ) == true ) {

						if ( isset( $kt_widget_dock['enable_widget_dock_desktop'] ) && $kt_widget_dock['enable_widget_dock_desktop'] == 0 ) {
							$desktop_class = 'kt_dock_hide_desktop';
						} else {
							$desktop_class = '';
						}
						if ( isset( $kt_widget_dock['enable_widget_dock_tablet'] ) && $kt_widget_dock['enable_widget_dock_tablet'] == 0 ) {
							$tablet_class = 'kt_dock_hide_tablet';
						} else {
							$tablet_class = '';
						}
						if ( isset( $kt_widget_dock['enable_widget_dock_mobile'] ) && $kt_widget_dock['enable_widget_dock_mobile'] == 0 ) {
							$mobile_class = 'kt_dock_hide_mobile';
						} else {
							$mobile_class = '';
						}
						if ( isset( $kt_widget_dock['widget_dock_cookie_length'] ) ) {
							$cookie_length = $kt_widget_dock['widget_dock_cookie_length'];
						} else {
							$cookie_length = 30;
						}
						if ( isset( $kt_widget_dock['widget_dock_cookie_length_unit'] ) ) {
							$cookie_length_unit = $kt_widget_dock['widget_dock_cookie_length_unit'];
						} else {
							$cookie_length_unit = 'days';
						}
						if ( 'center' == $kt_widget_dock['widget_dock_position'] ) {
							$maginleft = -floor( $kt_widget_dock['widget_dock_width'] / 2 );
						} else {
							$maginleft = 0;
						}
						if ( $kt_widget_dock['enable_widget_dock_cookies'] == '1' ) {
							$cookie = 'true';
						} else {
							$cookie = 'false';
						}
						if ( ! empty( $kt_widget_dock['widget_dock_cookie_slug'] ) ) {
							$cookie_slug = $kt_widget_dock['widget_dock_cookie_slug'];
						} else {
							$cookie_slug = 'kt_widget_dock';
						}
						echo '<div id="kt-widget-dock" data-slidein="' . esc_attr( $kt_widget_dock['widget_dock_trigger'] ) . '" data-slidein-delay="' . esc_attr( $kt_widget_dock['widget_dock_trigger_seconds'] ) . '000" data-slidein-scroll="' . esc_attr( $kt_widget_dock['widget_dock_trigger_scroll'] ) . '" data-usecookie="' . esc_attr( $cookie ) . '" data-cookie-slug="' . esc_attr( $cookie_slug ) . '" data-cookie-length="' . esc_attr( $cookie_length ) . '" data-cookie-length-unit="' . esc_attr( $cookie_length_unit ) . '" class="kt-widget-dock-widget-area kt-widget-dock-position-' . $kt_widget_dock['widget_dock_position'] . ' ' . $mobile_class . ' ' . $tablet_class . ' ' . $desktop_class . '" style="width:' . $kt_widget_dock['widget_dock_width'] . 'px; padding:' . $kt_widget_dock['widget_dock_padding'] . 'px; background:' . $kt_widget_dock['widget_dock_background'] . '; border-color:' . $kt_widget_dock['widget_dock_border_color'] . '; border-top-width:' . $kt_widget_dock['widget_dock_border_top_width'] . 'px; border-left-width:' . $kt_widget_dock['widget_dock_border_left_width'] . 'px; border-right-width:' . $kt_widget_dock['widget_dock_border_right_width'] . 'px; border-bottom-width:' . $kt_widget_dock['widget_dock_border_bottom_width'] . 'px; border-radius:' . $kt_widget_dock['widget_dock_border_radius'] . 'px; margin-left:' . $maginleft . 'px;">';
							echo '<div class="kt-widget-dock-close"><span class="kt-widget-close">x</span></div>';
							dynamic_sidebar( 'ktwidgetdock' );
						echo '</div>';
					}
				}
			endif;
		}

		public function kadence_widget_dock_enqueue_scripts() {
			wp_enqueue_style( 'kadence_widget_dock_css', KTWD_URL . 'assets/css/kt-widget-dock.css', false, KTWD_VERSION );
			wp_register_script( 'kadence_widget_dock_js', KTWD_URL . 'assets/js/kt-widget-dock-min.js', array( 'jquery' ), KTWD_VERSION, true );
			wp_enqueue_script( 'kadence_widget_dock_js' );
		}

	}

	$GLOBALS['kadence_widget_dock'] = new Kadence_Widget_Dock();
}
add_action( 'plugins_loaded', 'kt_widget_dock_plugin_loaded' );

/**
 * Plugin Updates
 */
function kadence_widget_dock_updating() {
	require_once KTWD_PATH . 'kadence-update-checker/kadence-update-checker.php';
	$kadence_widget_dock_updater = Kadence_Update_Checker::buildUpdateChecker(
		'https://kernl.us/api/v1/updates/57af970d7f334ccf27b1648b/',
		__FILE__,
		'kadence-widget-dock'
	);

}
add_action( 'after_setup_theme', 'kadence_widget_dock_updating', 1 );

