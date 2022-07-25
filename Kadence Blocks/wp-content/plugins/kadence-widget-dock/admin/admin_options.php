<?php
/**
 *
 */
add_action( 'after_setup_theme', 'kt_widget_dock_run_redux', 1 );
function kt_widget_dock_run_redux() {
	if ( class_exists( 'Redux' ) ) {
		return;
	}
	require_once KTWD_PATH . '/admin/redux/framework.php';
}
add_action( 'after_setup_theme', 'kt_widget_dock_add_sections', 2 );
function kt_widget_dock_add_sections() {
	if ( ! class_exists( 'Redux' ) ) {
		return;
	}

	$opt_name = 'kt_widget_dock';
	$args     = array(
		'opt_name'             => $opt_name,
		'display_name'         => 'Kadence Widget Dock',
		'display_version'      => '',
		'menu_type'            => 'menu',
		'allow_sub_menu'       => true,
		'menu_title'           => __( 'Widget Dock', 'kadence-widget-dock' ),
		'page_title'           => __( 'Kadence Widget Dock', 'kadence-widget-dock' ),
		'google_api_key'       => 'AIzaSyALkgUvb8LFAmrsczX56ZGJx-PPPpwMid0',
		'google_update_weekly' => false,
		'async_typography'     => false,
		'admin_bar'            => false,
		'dev_mode'             => false,
		'use_cdn'              => false,
		'update_notice'        => false,
		'customizer'           => false,
		'forced_dev_mode_off'  => true,
		'page_permissions'     => 'edit_pages',
		'menu_icon'            => 'dashicons-welcome-widgets-menus',
		'show_import_export'   => false,
		'save_defaults'        => true,
		'page_slug'            => 'ktwidgetdockpoptions',
		'ajax_save'            => true,
		'default_show'         => false,
		'default_mark'         => '',
		'footer_credit'        => __( 'Thank you for using Kadence Widget Dock by <a href="https://kadencewp.com/" target="_blank">Kadence WP</a>.', 'kadence-widget-dock' ),
		'hints'                => array(
			'icon'          => 'kt-icon-question',
			'icon_position' => 'right',
			'icon_color'    => '#444',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'dark',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		),
	);

	// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
	$args['share_icons'][] = array(
		'url' => 'https://www.facebook.com/KadenceWP',
		'title' => 'Follow Kadence WP on Facebook',
		'icon' => 'dashicons dashicons-facebook',
	);
	$args['share_icons'][] = array(
		'url' => 'https://www.twitter.com/KadenceWP',
		'title' => 'Follow Kadence WP on Twitter',
		'icon' => 'dashicons dashicons-twitter',
	);
	$args['share_icons'][] = array(
		'url' => 'https://www.instagram.com/KadenceWP',
		'title' => 'Follow Kadence WP on Instagram',
		'icon' => 'dashicons dashicons-format-image',
	);
	$args['share_icons'][] = array(
		'url' => 'http://www.youtube.com/c/KadenceWP',
		'title' => 'Follow Kadence WP on YouTube',
		'icon' => 'dashicons dashicons-video-alt3',
	);

	// Add content after the form.
	// $args['footer_text'] = '';

	Redux::setArgs( $opt_name, $args );
	Redux::setSection(
		$opt_name,
		array(
			'icon'       => 'dashicons-admin-generic',
			'icon_class' => 'dashicons',
			'id'         => 'kt_widget_dock_settings',
			'title'      => __( 'Widget Dock Options', 'kadence-slider' ),
			'desc'       => '',
			'fields'     => array(
				array(
					'id'         => 'enable_widget_dock',
					'type'       => 'switch',
					'customizer' => false,
					'title'      => __( 'Enable Widget Dock', 'kadence-widget-dock' ),
					'subtitle'   => __( 'Once Enabled you will see a new widget area in appearance > widgets', 'kadence-widget-dock' ),
					'default'    => 1,
				),
				array(
					'id'   => 'widget_dock_trigger_info',
					'type' => 'info',
					'desc' => __( 'Choose when widget box appears', 'kadence-widget-dock' ),
				),
				array(
					'id'      => 'widget_dock_trigger',
					'type'    => 'select',
					'title'   => __( 'Slide in Trigger', 'kadence-widget-dock' ),
					'options' => array(
						'delay'  => __( 'After a few seconds', 'kadence-widget-dock' ),
						'scroll' => __( 'After visitor scrolls', 'kadence-widget-dock' ),
						'after'  => __( 'After page/post content', 'kadence-widget-dock' ),
					),
					'default' => 'delay',
					'width'   => 'width:60%',
				),
				array(
					'id'       => 'widget_dock_trigger_seconds',
					'type'     => 'slider',
					'title'    => __( 'Choose how many seconds', 'kadence-widget-dock' ),
					'default'  => '4',
					'min'      => '1',
					'step'     => '1',
					'max'      => '20',
					'required' => array( 'widget_dock_trigger', '=', 'delay' ),
				),
				array(
					'id'       => 'widget_dock_trigger_scroll',
					'type'     => 'slider',
					'title'    => __( 'Choose how many pixels for scroll', 'kadence-widget-dock' ),
					'default'  => '500',
					'min'      => '0',
					'step'     => '5',
					'max'      => '2000',
					'required' => array( 'widget_dock_trigger', '=', 'scroll' ),
				),
				array(
					'id'   => 'widget_dock_repeat_info',
					'type' => 'info',
					'desc' => __( 'Choose repeat options', 'kadence-widget-dock' ),
				),
				array(
					'id'         => 'enable_widget_dock_cookies',
					'type'       => 'switch',
					'customizer' => false,
					'title'      => __( 'Enable Widget Dock Cookies', 'kadence-widget-dock' ),
					'subtitle'   => __( 'Enabled to allow plugin to track if user has closed box', 'kadence-widget-dock' ),
					'default'    => 1,
				),
				array(
					'id'       => 'widget_dock_cookie_length',
					'type'     => 'slider',
					'title'    => __( 'Choose how long cookie should last', 'kadence-widget-dock' ),
					'default'  => '30',
					'min'      => '5',
					'step'     => '1',
					'max'      => '120',
					'required' => array( 'enable_widget_dock_cookies', '=', '1' ),
				),
				array(
					'id'      => 'widget_dock_cookie_length_unit',
					'type'    => 'select',
					'title'   => __( 'Choose length unit for Cookie Expiration', 'kadence-widget-dock' ),
					'options' => array(
						'days'    => __( 'Days', 'kadence-widget-dock' ),
						'hours'   => __( 'Hours', 'kadence-widget-dock' ),
						'minutes' => __( 'Minutes', 'kadence-widget-dock' ),
					),
					'default' => 'days',
					'width'   => 'width:60%',
				),
				array(
					'id'         => 'widget_dock_cookie_slug',
					'type'       => 'text',
					'customizer' => false,
					'title'      => __( 'Unique slug for cookie', 'kadence-widget-dock' ),
					'subtitle'   => __( 'If you change your widget content you can change this to clear all user saved cookies', 'kadence-widget-dock' ),
					'validate'   => 'str_replace',
					'str'        => array(
						'search'      => ' ',
						'replacement' => '_',
					),
					'required'   => array( 'enable_widget_dock_cookies', '=', '1' ),
				),
				array(
					'id'   => 'widget_dock_target_info',
					'type' => 'info',
					'desc' => __( 'Target Pages/Posts', 'kadence-widget-dock' ),
				),
				array(
					'id'       => 'widget_dock_target',
					'type'     => 'select',
					'title'    => __( 'Choose basis for Target pages', 'kadence-widget-dock' ),
					'options'  => array(
						'sitewide' => __( 'Show on complete site, except:', 'kadence-widget-dock' ),
						'specific' => __( 'Show only on:', 'kadence-widget-dock' ),
					),
					'subtitle' => __( 'By default widget dock will not show on 404 or search pages.', 'kadence-widget-dock' ),
					'default'  => 'sitewide',
					'width'    => 'width:60%',
				),
				array(
					'id'       => 'widget_dock_post_types',
					'type'     => 'select',
					'multi'    => true,
					'title'    => __( 'These post-types', 'kadence-widget-dock' ),
					'subtitle' => __( 'This would exclude all single and archive pages for the post type.', 'kadence-widget-dock' ),
					'data'     => 'post_types',
					'default'  => '',
					'width'    => 'width:60%',
				),
				array(
					'id'      => 'widget_dock_pages',
					'type'    => 'select',
					'multi'   => true,
					'title'   => __( 'These pages', 'kadence-widget-dock' ),
					'data'    => 'pages',
					'default' => '',
					'width'   => 'width:60%',
				),
				array(
					'id'      => 'widget_dock_posts',
					'type'    => 'select',
					'multi'   => true,
					'title'   => __( 'These posts', 'kadence-widget-dock' ),
					'data'    => 'posts',
					'default' => '',
					'width'   => 'width:60%',
				),
				array(
					'id'         => 'widget_dock_custom_ids',
					'type'       => 'text',
					'customizer' => false,
					'title'      => __( 'These custom ids', 'kadence-widget-dock' ),
					'subtitle'   => __( 'Seperate by comma, no spaces', 'kadence-widget-dock' ),
					'validate'   => 'str_replace',
					'str'        => array(
						'search'      => ' ',
						'replacement' => '',
					),
				),

				array(
					'id'   => 'widget_dock_visitor_info',
					'type' => 'info',
					'desc' => __( 'Target Visitors', 'kadence-widget-dock' ),
				),
				array(
					'id'      => 'widget_dock_target_visitor',
					'type'    => 'select',
					'title'   => __( 'Choose which type of visitor', 'kadence-widget-dock' ),
					'options' => array(
						'everyone'  => __( 'Everyone', 'kadence-widget-dock' ),
						'loggedin'  => __( 'Logged in only', 'kadence-widget-dock' ),
						'loggedout' => __( 'Logged out only', 'kadence-widget-dock' ),
					),
					'default' => 'everyone',
					'width'   => 'width:60%',
				),
				array(
					'id'       => 'widget_dock_loggedin_visitors',
					'type'     => 'select',
					'multi'    => true,
					'title'    => __( 'These logged in roles', 'kadence-widget-dock' ),
					'subtitle' => __( 'Leave blank for all logged in roles.', 'kadence-widget-dock' ),
					'data'     => 'roles',
					'default'  => '',
					'width'    => 'width:60%',
					'required' => array( 'widget_dock_target_visitor', '=', 'loggedin' ),
				),
				array(
					'id'   => 'widget_dock_device_info',
					'type' => 'info',
					'desc' => __( 'Target Devices', 'kadence-widget-dock' ),
				),
				array(
					'id'         => 'enable_widget_dock_desktop',
					'type'       => 'switch',
					'customizer' => false,
					'title'      => __( 'Enable for Desktop', 'kadence-widget-dock' ),
					'default'    => 1,
				),
				array(
					'id'         => 'enable_widget_dock_tablet',
					'type'       => 'switch',
					'customizer' => false,
					'title'      => __( 'Enable for tablet', 'kadence-widget-dock' ),
					'default'    => 1,
				),
				array(
					'id'         => 'enable_widget_dock_mobile',
					'type'       => 'switch',
					'customizer' => false,
					'title'      => __( 'Enable for mobile', 'kadence-widget-dock' ),
					'default'    => 0,
				),
			),
		)
	);
	Redux::setSection(
		$opt_name,
		array(
			'icon'       => 'dashicons-art',
			'icon_class' => 'dashicons',
			'id'         => 'kt_widget_dock_design',
			'title'      => __( 'Widget Dock Design', 'kadence-slider' ),
			'desc'       => '',
			'fields'     => array(
				array(
					'id'      => 'widget_dock_position',
					'type'    => 'select',
					'title'   => __( 'Widget Dock Position', 'kadence-widget-dock' ),
					'options' => array(
						'left'   => __( 'Bottom Left', 'kadence-widget-dock' ),
						'right'  => __( 'Bottom Right', 'kadence-widget-dock' ),
						'center' => __( 'Bottom Center', 'kadence-widget-dock' ),
					),
					'default' => 'left',
					'width'   => 'width:60%',
				),
				array(
					'id'      => 'widget_dock_width',
					'type'    => 'slider',
					'title'   => __( 'Choose the widget dock width', 'kadence-widget-dock' ),
					'default' => '400',
					'min'     => '200',
					'step'    => '5',
					'max'     => '770',
				),
				array(
					'id'      => 'widget_dock_padding',
					'type'    => 'slider',
					'title'   => __( 'Choose the widget dock padding', 'kadence-widget-dock' ),
					'default' => '30',
					'min'     => '0',
					'step'    => '1',
					'max'     => '100',
				),
				array(
					'id'   => 'widget_dock_background_info',
					'type' => 'info',
					'desc' => __( 'Widget Dock Background', 'kadence-widget-dock' ),
				),
				array(
					'id'          => 'widget_dock_background',
					'type'        => 'color',
					'title'       => __( 'Background', 'kadence-widget-dock' ),
					'transparent' => false,
					'default'     => '#ffffff',
					'validate'    => 'color',
				),
				array(
					'id'   => 'widget_dock_border_info',
					'type' => 'info',
					'desc' => __( 'Widget Dock Border', 'kadence-widget-dock' ),
				),
				array(
					'id'          => 'widget_dock_border_color',
					'type'        => 'color',
					'title'       => __( 'Border color', 'kadence-widget-dock' ),
					'transparent' => false,
					'default'     => '#ffffff',
					'validate'    => 'color',
				),
				array(
					'id'      => 'widget_dock_border_top_width',
					'type'    => 'slider',
					'title'   => __( 'Border top width', 'kadence-widget-dock' ),
					'default' => '0',
					'min'     => '0',
					'step'    => '1',
					'max'     => '30',
				),
				array(
					'id'      => 'widget_dock_border_left_width',
					'type'    => 'slider',
					'title'   => __( 'Border left width', 'kadence-widget-dock' ),
					'default' => '0',
					'min'     => '0',
					'step'    => '1',
					'max'     => '30',
				),
				array(
					'id'      => 'widget_dock_border_right_width',
					'type'    => 'slider',
					'title'   => __( 'Brder right width', 'kadence-widget-dock' ),
					'default' => '0',
					'min'     => '0',
					'step'    => '1',
					'max'     => '30',
				),
				array(
					'id'      => 'widget_dock_border_bottom_width',
					'type'    => 'slider',
					'title'   => __( 'Border bottom width', 'kadence-widget-dock' ),
					'default' => '0',
					'min'     => '0',
					'step'    => '1',
					'max'     => '30',
				),
				array(
					'id'   => 'widget_dock_border_radius_info',
					'type' => 'info',
					'desc' => __( 'Widget Dock Border Radius', 'kadence-widget-dock' ),
				),
				array(
					'id'      => 'widget_dock_border_radius',
					'type'    => 'slider',
					'title'   => __( 'Border radius', 'kadence-widget-dock' ),
					'default' => '0',
					'min'     => '0',
					'step'    => '1',
					'max'     => '30',
				),
			),
		)
	);

	Redux::setExtensions( 'kt_widget_dock', KTWD_PATH . '/admin/options_assets/extensions/' );
}
function kt_widget_dock_override_redux_css() {
	wp_dequeue_style( 'redux-admin-css' );
	wp_register_style( 'ksp-redux-custom-css', KTWD_URL . '/admin/options_assets/css/style.css', false, 101 );
	wp_enqueue_style( 'ksp-redux-custom-css' );
	// wp_dequeue_style( 'select2-css');
	wp_dequeue_style( 'redux-elusive-icon' );
	wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action( 'redux-enqueue-kt_widget_dock', 'kt_widget_dock_override_redux_css' );
