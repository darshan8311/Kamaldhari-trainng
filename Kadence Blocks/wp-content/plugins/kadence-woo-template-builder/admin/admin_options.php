<?php 
/**
* 
*/
add_action( "after_setup_theme", 'kwt_run_redux', 1);
function kwt_run_redux() {
   	if ( class_exists( 'Redux' ) ) {
      return;
    }
    require_once( KADENCE_WOO_TEMPLATE_PATH . 'admin/redux/framework.php');
}
function kwt_get_posts_with_default( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => -1,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    $post_options['default'] = __('Woocommerce Default', 'kadence-woo-template-builder');
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[$post->ID] = $post->post_title;
        }
    }

    return $post_options;
}

add_action( "after_setup_theme", 'kwt_add_sections', 2);
function kwt_add_sections() {
    if ( ! class_exists( 'Redux' ) ) {
      return;
    }
    if( is_admin() ) {
	    $ptemplates = kwt_get_posts_with_default( array( 'post_type' => 'kt-product-template', 'numberposts' => -1 ) );
	    $patemplates = kwt_get_posts_with_default( array( 'post_type' => 'kt-product-archive', 'numberposts' => -1 ) );
	    $checktemplates = kwt_get_posts_with_default( array( 'post_type' => 'kt-checkout', 'numberposts' => -1 ) );
	} else {
		$ptemplates = array( 'default' => __('Woocommerce Default', 'kadence-woo-template-builder') );
		$patemplates = array( 'default' => __('Woocommerce Default', 'kadence-woo-template-builder') );
		$checktemplates = array( 'default' => __('Woocommerce Default', 'kadence-woo-template-builder') );
	}
    $opt_name = "kadence_woo_templates";

    $theme = wp_get_theme();
    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => 'Kadence Woo Templates',
        'display_version'      => '',
        'menu_type'            => 'submenu',
        'page_parent'          => 'kadence_woo_template_builder_overview',
        'allow_sub_menu'       => true,
        'menu_title'           => __('Template Settings', 'kadence-woo-template-builder'),
        'page_title'           => __('Kadence Woo Template Settings', 'kadence-woo-template-builder'),
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
        'menu_icon'            => '',
        'show_import_export'   => false,
        'save_defaults'        => true,
        'show_options_object'  => false,
        'page_slug'            => 'kwtoptions',
        'ajax_save'            => true,
        'default_show'         => false,
        'default_mark'         => '',
        'footer_credit' => __('Thank you for using the Kadence Woo Template Builder by <a href="http://kadencethemes.com/" target="_blank">Kadence Themes</a>.', 'kadence-woo-template-builder'),
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

   $args['share_icons'][] = array(
        'url' => 'https://www.facebook.com/KadenceThemes',
        'title' => 'Follow Kadence Themes on Facebook', 
        'icon' => 'dashicons dashicons-facebook',
    );
    $args['share_icons'][] = array(
        'url' => 'https://www.twitter.com/KadenceThemes',
        'title' => 'Follow Kadence Themes on Twitter', 
        'icon' => 'dashicons dashicons-twitter',
    );
    $args['share_icons'][] = array(
        'url' => 'https://www.instagram.com/KadenceThemes',
        'title' => 'Follow Kadence Themes on Instagram', 
        'icon' => 'dashicons dashicons-format-image',
    );


    // Add content after the form.
    //$args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );
    Redux::setSection( $opt_name, array(
    'icon' => 'kt-icon-font-size',
    'icon_class' => 'icon-large',
    'id' => 'kwt_template_settings',
    'title' => __('Template Settings', 'kadence-woo-template-builder'),
    'desc' => "",
    'fields' => array(
	    	array(
	            'id'=>'single_product_default_info',
	            'type' => 'info', 
	            'title' => __('Single Product Settings', 'kadence-woo-template-builder'),
	        ),
	      	array(
	            'id'=>'single_product_default',
	            'type' => 'select', 
	            'title' => __('Select Default Template', 'kadence-woo-template-builder'),
	            'default' => 'default',
	            'width' => 'width:60%',
	            'options' => $ptemplates,
	        ),
	    	array(
	            'id'=>'archive_product_default_info',
	            'type' => 'info', 
	            'title' => __('Archive Product Settings', 'kadence-woo-template-builder'),
	        ),
	      	array(
	            'id'=>'shop_product_default',
	            'type' => 'select', 
	            'title' => __('Select Default Template for shop page', 'kadence-woo-template-builder'),
	            'default' => 'default',
	            'width' => 'width:60%',
	            'options' => $patemplates,
	        ),
	      	array(
	            'id'=>'category_product_default',
	            'type' => 'select', 
	            'title' => __('Select Default Template for Category Archives', 'kadence-woo-template-builder'),
	            'default' => 'default',
	            'width' => 'width:60%',
	            'options' => $patemplates,
	        ),
	        array(
	            'id'=>'tag_product_default',
	            'type' => 'select', 
	            'title' => __('Select Default Template for Tag Archives', 'kadence-woo-template-builder'),
	            'default' => 'default',
	            'width' => 'width:60%',
	            'options' => $patemplates,
	        ),
	        array(
	            'id'=>'checkout_default_info',
	            'type' => 'info', 
	            'title' => __('Checkout Settings', 'kadence-woo-template-builder'),
	        ),
	      	array(
	            'id'=>'checkout_default',
	            'type' => 'select', 
	            'title' => __('Select Default Template', 'kadence-woo-template-builder'),
	            'default' => 'default',
	            'width' => 'width:60%',
	            'options' => $checktemplates,
	        ),
      	),
      ) );

    Redux::setExtensions( 'kadence_woo_templates', KADENCE_WOO_TEMPLATE_PATH . 'admin/extensions/' );
  }
function kwt_override_redux_css() {
	  wp_dequeue_style( 'redux-admin-css' );
	  wp_register_style('kwt-redux-custom-css', KADENCE_WOO_TEMPLATE_URL . 'admin/css/admin-options.css', false, 152);    
	  wp_enqueue_style('kwt-redux-custom-css');
	  wp_dequeue_style( 'redux-elusive-icon' );
	  wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action('redux-enqueue-kadence_woo_templates', 'kwt_override_redux_css');

