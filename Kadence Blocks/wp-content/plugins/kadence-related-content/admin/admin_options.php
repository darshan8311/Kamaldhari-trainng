<?php 
/**
* 
*/
add_action( "after_setup_theme", 'kt_related_content_run_redux', 1);
function kt_related_content_run_redux() {
   if ( class_exists( 'Redux' ) ) {
      return;
    }
    require_once( KTRC_PATH . '/admin/redux/framework.php');
}
add_action( "after_setup_theme", 'kt_related_content_add_sections', 2);
function kt_related_content_add_sections() {
    if ( ! class_exists( 'Redux' ) ) {
      return;
    }

    $opt_name = "kt_related_content";
    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => 'Kadence Related Content',
        'display_version'      => '',
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => __('Related Content', 'kadence-related-content'),
        'page_title'           => __('Kadence Related Content', 'kadence-related-content'),
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
        'menu_icon'            => 'dashicons-share',
        'show_import_export'   => false,
        'save_defaults'        => true,
        'page_slug'            => 'ktrelatedcontent',
        'ajax_save'            => true,
        'default_show'         => false,
        'default_mark'         => '',
        'footer_credit' => __('Thank you for using Kadence Related Content by <a href="https://kadencethemes.com/" target="_blank">Kadence Themes</a>.', 'kadence-related-content'),
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
    //$args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );
    Redux::setSection( $opt_name, array(
    'icon' => 'dashicons-share',
    'icon_class' => 'dashicons',
    'id' => 'kt_related_content_settings',
    'title' => __('Related Content Options', 'kadence-slider'),
    'desc' => "",
    'fields' => array(
        array(
            'id'=>'carousel_title',
            'type' => 'text',
            'customizer' => false,
            'default'=> 'You might also be interested in…',
            'title' => __('Default title for carousel.', 'kadence-related-content'),
            ),
        array(
            'id'=>'carousel_columns',
            'type' => 'slider', 
            'title' => __('Choose default carousel columns', 'kadence-related-content'),
            "default"       => "4",
            "min"       => "2",
            "step"      => "1",
            "max"       => "6",
            ),
        array(
            'id'=>'carousel_auto',
            'type' => 'switch',
            'title' => __('Auto play carousel?', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'carousel_speed',
            'type' => 'slider', 
            'title' => __('Carousel auto play speed (seconds)', 'kadence-related-content'),
            "default"       => "9",
            "min"       => "2",
            "step"      => "1",
            "max"       => "15",
            'required' => array('carousel_auto','=','1'),
            ),
        array(
            'id'=>'carousel_scroll',
            'type' => 'select',
            'title' => __('Carousel Scroll', 'kadence-related-content'),
            'options' => array('1' => __('1 Item', 'kadence-related-content'),'all' => __('Paginated', 'kadence-related-content')),
            'default' => '1',
            'width' => 'width:60%',
            ),
        array(
            'id'=>'carousel_style_info',
            'type' => 'info', 
            'desc' => __('Carousel Style', 'kadence-related-content'),
        ),
        array(
            'id'=>'product_layout',
            'type' => 'switch',
            'title' => __('Use woocommerce product loop for product output', 'kadence-related-content'),
            'subtitle'=> __('All options past this will not effect products if enabled.', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'text_align',
            'type' => 'select',
            'title' => __('Align text', 'kadence-related-content'),
            'options' => array('kt-rc-left-align' => __('Left', 'kadence-related-content'),'kt-rc-center-align' => __('Center', 'kadence-related-content'),'kt-rc-right-align' => __('Right', 'kadence-related-content')),
            'default' => 'kt-rc-left-align',
            'width' => 'width:60%',
            ),
        array(
            'id'=>'show_post_image',
            'type' => 'switch',
            'title' => __('Show Post image?', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'show_post_type',
            'type' => 'switch',
            'title' => __('Show post type?', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'show_post_title',
            'type' => 'switch',
            'title' => __('Show post title?', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'show_post_meta',
            'type' => 'switch',
            'title' => __('Show post date?', 'kadence-related-content'),
            'subtitle'=> __('For products this shows rating if enabled.', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'show_post_excerpt',
            'type' => 'switch',
            'title' => __('Show post excerpt?', 'kadence-related-content'),
            "default" => 1,
        ),
        array(
            'id'=>'post_excerpt_word_count',
            'type' => 'slider', 
            'title' => __('Post excerpt word count', 'kadence-related-content'),
            "default"       => "16",
            "min"       => "5",
            "step"      => "1",
            "max"       => "40",
            'required' => array('show_post_excerpt','=','1'),
        ),
        array(
            'id'=>'post_excerpt_read_more',
            'type' => 'text', 
            'title' => __('Post excerpt "Read More" text', 'kadence-related-content'),
            "default"       => "Read More",
            'required' => array('show_post_excerpt','=','1'),
        ),
        array(
            'id'=>'show_product_price',
            'type' => 'switch',
            'title' => __('Show post price?', 'kadence-related-content'),
            "default" => 0,
            'required' => array('product_layout','=','0'),
        ),
    ),
    )
    );

    Redux::setExtensions( 'kt_related_content', KTRC_PATH . '/admin/options_assets/extensions/' );
  }
function kt_related_content_override_redux_css() {
  wp_dequeue_style( 'redux-admin-css' );
  wp_register_style('krc-redux-custom-css', KTRC_URL . '/admin/options_assets/css/style.css', false, 101);    
  wp_enqueue_style('krc-redux-custom-css');
  //wp_dequeue_style( 'select2-css');
  wp_dequeue_style( 'redux-elusive-icon' );
  wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action('redux-enqueue-kt_related_content', 'kt_related_content_override_redux_css');