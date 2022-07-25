<?php
/*
 * Plugin Name: Kadence WooCommerce SiteOrigin Builder
 * Description: Page builder for woocommerce. This plugin adds templates to create custom product, archive and checkout pages using Page Builder by SiteOrigin.
 * Version: 1.1.7
 * Author: Kadence WP
 * Author URI: http://kadencewp.com/
 * License: GPLv2 or later
 * WC requires at least: 3.2.0
 * WC tested up to: 3.7.1
 */

function kwt_activation() {
	if ( class_exists( 'SiteOrigin_Panels_Settings' ) ) {
		$types = SiteOrigin_Panels_Settings::single()->get( 'post-types' );
		$types[] = 'kt-product-template';
		$types[] = 'kt-product-archive';
		$types[] = 'kt-checkout';
		$types[] = 'product';
		SiteOrigin_Panels_Settings::single()->set( 'post-types', $types );
	}
}
register_activation_hook( __FILE__, 'kwt_activation' );

function kwt_deactivation() {
}
register_deactivation_hook(__FILE__, 'kwt_deactivation');

// Define constants
define( 'KADENCE_WOO_TEMPLATE_PATH', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR );
define( 'KADENCE_WOO_TEMPLATE_URL', plugin_dir_url(__FILE__) );
define( 'KADENCE_WOO_TEMPLATE_VERSION', '1.1.7' );

// redux
require_once(KADENCE_WOO_TEMPLATE_PATH. 'admin/admin_options.php');

// CMB
require_once(KADENCE_WOO_TEMPLATE_PATH. 'admin/cmb/init.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'admin/class-taxonomy-meta.php');

// prebuilt
require_once(KADENCE_WOO_TEMPLATE_PATH. 'prebuilt_layouts.php');

// Product Widgets
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-title-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-short-description-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-description-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-meta-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-add-to-cart-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-price-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-rating-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-related-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-reviews-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-tabs-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-title-widget.php');
require_once KADENCE_WOO_TEMPLATE_PATH . 'widgets/product/class-kwt-product-navigation-arrows-widget.php';
//require_once KADENCE_WOO_TEMPLATE_PATH . 'widgets/product/class-product-entire-summary-action-widget.php';
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-upsell-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-gallery-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-additional-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-kadence-related-widget.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/product/class-product-single-category-widget.php');

// Archive Widgets
require_once KADENCE_WOO_TEMPLATE_PATH . 'widgets/archive/class-archive-main-loop.php';
require_once KADENCE_WOO_TEMPLATE_PATH . 'widgets/archive/class-kwt-archive-description-widget.php';

// Checkout Widgets
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/checkout/class-checkout-billing.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/checkout/class-checkout-shipping.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/checkout/class-checkout-additional-fields.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/checkout/class-checkout-order-review.php');
require_once(KADENCE_WOO_TEMPLATE_PATH. 'widgets/checkout/class-checkout-payment.php');

function kwt_theme_is_kadence() {
	if(class_exists('kt_api_manager')) {
		return true;
	}
	return false;
}
class Kadence_Woo_Template_Builder {
	protected static $instance = null;
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'check_for_builder_woo') );
		add_action( 'admin_menu', array( $this, 'single_product_page_menu'));
		add_action( 'init',  array( $this, 'template_post_init' ), 1 );
		add_action( 'current_screen',  array($this, 'builder_check' ) );
		add_filter( 'hidden_meta_boxes', array($this, 'hide_meta_box' ), 10, 2);
		add_filter( 'cmb2_admin_init', array($this, 'template_metaboxes' ) );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueues' ) );
		add_action( 'wp_enqueue_scripts', array($this, 'enqueues' ) );
		add_action( 'admin_head', array($this, 'post_css' ) );
		add_action( 'admin_init', array($this, 'archive_template_meta' ) );
		add_action( 'wp_head', array( $this, 'print_inline_css' ), 10 );
		// Add widgets.
		add_action('widgets_init', array($this, 'widgets_init'));
		add_filter('siteorigin_panels_widgets', array($this, 'add_recommended_widgets' ) );
		add_filter('siteorigin_panels_widget_dialog_tabs', array($this, 'add_widgets_dialog_tabs'), 30);
		// filter product page.
		add_filter(	'wc_get_template_part', array( $this, 'single_product_page_template'), 101, 3 );
		add_action('kt_woocommerce_product_builder', array( $this, 'product_template' ) );
		add_action('kt_woocommerce_product_builder', array( $this, 'product_schema' ), 20 );

		add_filter( 'body_class', array($this, 'product_builder_body_class' ));
		// Filter shop and archive pages.
		add_filter( 'template_include', array( $this, 'archive_template_loader' ), 101 );
		add_action( 'kt_woocommerce_archive_builder', array( $this, 'archive_template' ) );
		// Filter Checkout Pages.
		add_filter(	'wc_get_template', array( $this, 'checkout_page_template'), 101, 3);
		add_action('kt_woocommerce_checkout_builder', array( $this, 'checkout_template'));
	}
	public function product_schema() {
			WC()->structured_data->generate_product_data();
	}
	public function checkout_page_template($located, $name, $args){
		if($name ==='checkout/form-checkout.php'):
			global $kadence_woo_templates;
			if ( isset( $kadence_woo_templates['checkout_default'] ) && !empty($kadence_woo_templates['checkout_default']) && $kadence_woo_templates['checkout_default'] != 'default') {
				$located = KADENCE_WOO_TEMPLATE_PATH . 'templates/form-checkout.php';
			}
		endif;

		return $located;
	}
	public function checkout_template(){
		global $kadence_woo_templates;
		echo siteorigin_panels_render($kadence_woo_templates['checkout_default']);
	}
	public function archive_template_loader($template){
		if ( is_embed() ) {
			return $template;
		}
		if ( is_product_taxonomy() ) {
			global $kadence_woo_templates;
			$cat_term_id = get_queried_object()->term_id;
			$meta = get_option('kwtb_archive');
			if (empty($meta)) $meta = array();
			if (!is_array($meta)) $meta = (array) $meta;
			$meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
			if(isset($meta['kwtb_archive_template'])) {
				$new_template = $meta['kwtb_archive_template'];
			}
			if(is_product_category()){
				if(isset($new_template) && !empty($new_template) && $new_template != 'default' ) {
					$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/archive-product.php';
				} elseif(isset($kadence_woo_templates['category_product_default']) && !empty($kadence_woo_templates['category_product_default']) && $kadence_woo_templates['category_product_default'] != 'default') {
					$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/archive-product.php';
				}
			} else if(is_product_tag()) {
				if(isset($new_template) && !empty($new_template) && $new_template != 'default' ) {
					$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/archive-product.php';
				} elseif(isset($kadence_woo_templates['tag_product_default']) && !empty($kadence_woo_templates['tag_product_default']) && $kadence_woo_templates['tag_product_default'] != 'default') {
					$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/archive-product.php';
				}
			}
		} else if( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			global $kadence_woo_templates;
			if(isset($kadence_woo_templates['shop_product_default']) && !empty($kadence_woo_templates['shop_product_default']) && $kadence_woo_templates['shop_product_default'] != 'default') {
				$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/archive-product.php';
			}
		}

		return $template;
	}
	public function posts_with_default( $query_args ) {

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
	public function archive_template_meta() {
		if ( !class_exists( 'Kadence_Taxonomy_Meta' ) )
			return;

		$meta_sections = array();

		$meta_sections[] = array(
			'title'      => __('Product Archive template', 'kadence-woo-template-builder'), 
			'taxonomies' => array('product_cat', 'product_tag'),
			'id'         => 'kwtb_archive',

			'fields' => array(
				array(
					'name' => __('Product archive template', 'kadence-woo-template-builder'),
					'desc' => __('Choose a builder template', 'kadence-woo-template-builder'),
					'id'   => 'kwtb_archive_template',
					'type'    => 'select',
					'options' => $this->posts_with_default(array( 'post_type' => 'kt-product-archive', 'numberposts' => -1 ) ),
				),
			),
		);

		foreach ( $meta_sections as $meta_section ) { 
			new Kadence_Taxonomy_Meta( $meta_section );
		}
	}
	public function archive_template(){
		if ( is_product_taxonomy() ) {
			global $kadence_woo_templates;
			$cat_term_id = get_queried_object()->term_id;
			$meta = get_option('kwtb_archive');
			if (empty($meta)) $meta = array();
			if (!is_array($meta)) $meta = (array) $meta;
			$meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
			if(isset($meta['kwtb_archive_template'])) {
				$template = $meta['kwtb_archive_template'];
			}
			if(is_product_category()){
				if(isset($template) && !empty($template) && $template != 'default' ) {
					echo siteorigin_panels_render($template);
				} else {
					echo siteorigin_panels_render($kadence_woo_templates['category_product_default']);
				}
			} else if(is_product_tag()) {
				if(isset($template) && !empty($template) && $template != 'default' ) {
					echo siteorigin_panels_render($template);
				} else {
					echo siteorigin_panels_render($kadence_woo_templates['tag_product_default']);
				}
			}
		} else if( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			global $kadence_woo_templates;
			if(isset($kadence_woo_templates['shop_product_default']) && !empty($kadence_woo_templates['shop_product_default'])) {
				echo siteorigin_panels_render($kadence_woo_templates['shop_product_default']);
			}
		}
	}
	public function product_template( $post ){
		global $kadence_woo_templates;
		$template = get_post_meta($post->ID,'_kwt_product_template', true );
		if(isset($template) && !empty($template) && $template != 'default' && $template != 'pagebuilder' ) {
			echo siteorigin_panels_render($template);
		} else if (isset($template) && !empty($template) && $template != 'default' && $template == 'pagebuilder' ) {
			echo siteorigin_panels_render($post->ID);
		} else {
			echo siteorigin_panels_render($kadence_woo_templates['single_product_default']);
		}
	}
	public function builder_check() {
		$current_screen = get_current_screen();
		if(isset($current_screen) && !empty($current_screen)) {
			if( $current_screen->id === "toplevel_page_kadence_woo_template_builder" ) {
			    if(class_exists('SiteOrigin_Panels_Settings')) {
					$types = SiteOrigin_Panels_Settings::single()->get('post-types');
					if(!in_array('kt-product-template', $types)) {
						$types[] = 'kt-product-template';
						SiteOrigin_Panels_Settings::single()->set('post-types', $types);
					}
					if(!in_array('kt-product-archive', $types)) {
						$types[] = 'kt-product-archive';
						SiteOrigin_Panels_Settings::single()->set('post-types', $types);
					}
					if(!in_array('kt-checkout', $types)) {
						$types[] = 'kt-checkout';
						SiteOrigin_Panels_Settings::single()->set('post-types', $types);
					}
					if(!in_array('product', $types)) {
						$types[] = 'product';
						SiteOrigin_Panels_Settings::single()->set('post-types', $types);
					}
				}
			}
		}
	}
	public function check_for_builder_woo() {
		if ( ! current_user_can( 'manage_options' ) ) {
           		return;
            }
	    if(!class_exists('SiteOrigin_Panels_Settings')) {
	    	?>
			 <div id="message" class="error">
                <p><?php echo 'For Kadence Woo Template Builder to work you much install/activate SiteOrigin Pagebuilder';?></p>
            </div>
            <?php
		} elseif (!class_exists('woocommerce')) {
	    	?>
			 <div id="message" class="error">
                <p><?php echo 'For Kadence Woo Template Builder to work you much install/activate Woocommerce';?></p>
            </div>
            <?php
		}
	}
	public function print_inline_css() {
		if( is_product() ) {
			global $kadence_woo_templates, $post;
			$custom_template = get_post_meta($post->ID,'_kwt_product_template', true );
			if ( ! isset( $custom_template ) || empty( $custom_template ) || $custom_template == 'default' ) {
				if ( isset( $kadence_woo_templates[ 'single_product_default' ] ) && ! empty( $kadence_woo_templates[ 'single_product_default' ] ) &&  'default' != $kadence_woo_templates[ 'single_product_default' ] ){
					$css = SiteOrigin_Panels::renderer()->generate_css( $kadence_woo_templates[ 'single_product_default' ] );
					echo '<style type="text/css" media="all" id="kt-builder-siteorigin-panels-layouts-head">'.$css.'</style>';
				}
			} else if ( $custom_template != 'pagebuilder' ) {
				$css = SiteOrigin_Panels::renderer()->generate_css( $custom_template );
				echo '<style type="text/css" media="all" id="kt-builder-siteorigin-panels-layouts-head">'.$css.'</style>';
			}
		}
	}
	public function post_css() {
	  echo '<style>
	    body.post-type-kt-product-template #post-body #normal-sortables, body.post-type-kt-product-archive #post-body #normal-sortables, body.post-type-kt-checkout #post-body #normal-sortables {
	      min-height:0;
	    } 
	  </style>';
	}
	public static function admin_enqueues($hook) {
		 	if($hook != 'toplevel_page_kadence_woo_template_builder_overview' ) {
                return;
        	}
			wp_enqueue_style('kadence-woo-template-builder-admin', KADENCE_WOO_TEMPLATE_URL . 'css/kadence-woo-template-admin.css', false, KADENCE_WOO_TEMPLATE_VERSION);
		
	}
	public static function enqueues() {
		wp_enqueue_style('kadence-woo-template-builder', KADENCE_WOO_TEMPLATE_URL . 'css/kadence-woo-template.css', false, KADENCE_WOO_TEMPLATE_VERSION);
		if(is_product()) {
			global $kadence_woo_templates, $post;
			$custom_template = get_post_meta($post->ID,'_kwt_product_template', true );
			if ( ! isset( $custom_template ) || empty( $custom_template ) || $custom_template == 'default' ) {
				if ( isset( $kadence_woo_templates[ 'single_product_default' ] ) && ! empty( $kadence_woo_templates[ 'single_product_default' ] ) &&  'default' != $kadence_woo_templates[ 'single_product_default' ] ){
					wp_enqueue_style( 'siteorigin-panels-front' );
				}
			} else if ( $custom_template != 'pagebuilder' ) {
				wp_enqueue_style( 'siteorigin-panels-front' );
			}
		}
	}
	public function widgets_init () {
		if ( class_exists( 'woocommerce' ) ) {
			register_widget( 'kwt_product_title_widget' );
			register_widget( 'kwt_product_short_description_widget' );
			register_widget( 'kwt_product_description_widget' );
			register_widget( 'kwt_product_price_widget' );
			register_widget( 'kwt_product_rating_widget' );
			register_widget( 'kwt_product_add_to_cart_widget' );
			register_widget( 'kwt_product_meta_widget' );
			register_widget( 'kwt_product_reviews_widget' );
			register_widget( 'kwt_product_gallery_widget' );
			register_widget( 'kwt_product_related_widget' );
			register_widget( 'kwt_product_upsell_widget' );
			register_widget( 'kwt_product_tabs_widget' );
			register_widget( 'kwt_product_additional_widget' );
			register_widget( 'kwt_product_single_category_widget' );
			//register_widget( 'kwt_product_entire_summary_action_widget' );
			//register_widget( 'kwt_product_navigation_arrows_widget' );
			if ( class_exists( 'Kadence_Related_Content' ) ) {
				register_widget( 'kwt_product_kadence_related_widget' );
			}

			register_widget( 'kwt_product_archive_mainloop_widget' );
			register_widget( 'kwt_archive_description_widget' );

			register_widget( 'kwt_checkout_billing_widget' );
			register_widget( 'kwt_checkout_shipping_widget' );
			register_widget( 'kwt_checkout_additional_widget' );
			register_widget( 'kwt_checkout_payment_widget' );
			register_widget( 'kwt_checkout_order_review_widget' );
	    }
	}
	public function hide_meta_box($hidden, $screen) {
	    //make sure we are dealing with the correct screen
	    if ( ('post' == $screen->base) && ('kt-product-template' == $screen->id) || ('post' == $screen->base) && ('kt-product-archive' == $screen->id) || ('post' == $screen->base) && ('kt-checkout' == $screen->id) ){
	    	if(in_array('so-panels-panels', $hidden)) {
	    		foreach ($hidden as $key => $value) {
	    			if($value == 'so-panels-panels') {
	    				unset($hidden[$key]);
	    			}
	    		}
	    	}
	    	if(!in_array('revisionsdiv', $hidden)) {
	    		$hidden[] = 'revisionsdiv';
	    	}
	    }
	    return $hidden;
	}
	public function single_product_page_template($template, $slug, $name){
		if($slug === 'content' && $name ==='single-product' ):
			global $kadence_woo_templates, $post;
			$custom_template = get_post_meta($post->ID,'_kwt_product_template', true );
			if( isset( $custom_template ) && !empty( $custom_template ) && $custom_template != 'default' ) {
				$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/product-builder.php';
			} elseif(isset($kadence_woo_templates['single_product_default']) && !empty($kadence_woo_templates['single_product_default']) && $kadence_woo_templates['single_product_default'] != 'default') {
				$template = KADENCE_WOO_TEMPLATE_PATH . 'templates/product-builder.php';
			}
		endif;

		return $template;
	}
	public function product_builder_body_class($classes) {
		if(is_product()) {
			global $kadence_woo_templates, $post;
			$custom_template = get_post_meta($post->ID,'_kwt_product_template', true );
			if(isset($custom_template) && !empty($custom_template) && $custom_template != 'default' ) {
				$classes[] = 'kwt-woo-builder-product';
				$classes[] = 'siteorigin-panels';
				$classes[] = 'siteorigin-panels-before-js';

				add_action( 'wp_footer', array( $this, 'strip_before_js' ), 99 );
			} elseif(isset($kadence_woo_templates['single_product_default']) && !empty($kadence_woo_templates['single_product_default']) && $kadence_woo_templates['single_product_default'] != 'default') {
				$classes[] = 'kwt-woo-builder-product';
				$classes[] = 'kwt-woo-builder-product';
				$classes[] = 'siteorigin-panels';
				$classes[] = 'siteorigin-panels-before-js';

				add_action( 'wp_footer', array( $this, 'strip_before_js' ), 99 );
			}
		}

		return $classes;
	}
	public function strip_before_js(){
		?><script type="text/javascript">document.body.className = document.body.className.replace("siteorigin-panels-before-js","");</script><?php
	}
	public function add_recommended_widgets($widgets){
		$kwt_widgets = array(
			'kwt_product_title_widget',
		  	'kwt_product_short_description_widget',
		  	'kwt_product_description_widget',
		  	'kwt_product_price_widget',
	    	'kwt_product_rating_widget',
	    	'kwt_product_add_to_cart_widget',
	    	'kwt_product_meta_widget',
	    	'kwt_product_reviews_widget',
	    	'kwt_product_gallery_widget',
	    	'kwt_product_related_widget',
	    	'kwt_product_upsell_widget',
	    	'kwt_product_tabs_widget',
	    	'kwt_product_additional_widget',
	    	'kwt_product_single_category_widget',
	    	'kwt_product_kadence_related_widget',
	    	'kwt_product_entire_summary_action_widget',
	    	'kwt_size_chart_widget'
	  	);
	  	$kwt_archive_widgets = array(
			'kwt_product_archive_mainloop_widget',
			'kwt_archive_description_widget',
	  	);

	  	$kwt_checkout_widgets = array(
			'kwt_checkout_billing_widget',
	    	'kwt_checkout_shipping_widget',
	    	'kwt_checkout_additional_widget',
	    	'kwt_checkout_payment_widget',
	    	'kwt_checkout_order_review_widget',
	  	);

		foreach($kwt_widgets as $kwt_widget) {
			if( isset( $widgets[$kwt_widget] ) ) {
				$widgets[$kwt_widget]['groups'] = array('woo_template_product');
				$widgets[$kwt_widget]['icon'] = 'dashicons dashicons-products';
			}
		}
		foreach($kwt_archive_widgets as $kwt_archive_widget) {
			if( isset( $widgets[$kwt_archive_widget] ) ) {
				$widgets[$kwt_archive_widget]['groups'] = array('woo_template_archive');
				$widgets[$kwt_archive_widget]['icon'] = 'dashicons dashicons-screenoptions';
			}
		}
		foreach($kwt_checkout_widgets as $kwt_checkout_widget) {
			if( isset( $widgets[$kwt_checkout_widget] ) ) {
				$widgets[$kwt_checkout_widget]['groups'] = array('woo_template_checkout');
				$widgets[$kwt_checkout_widget]['icon'] = 'dashicons dashicons-cart';
			}
		}
		return $widgets;
	}
	public function add_widgets_dialog_tabs($tabs){

		$tabs['woo_template_product'] = array(
			'title' => __('Single Product Page', 'kadence-woo-template-builder'),
			'filter' => array(
				'groups' => array('woo_template_product')
			)
		);
		$tabs['woo_template_archive'] = array(
			'title' => __('Shop Archives', 'kadence-woo-template-builder'),
			'filter' => array(
				'groups' => array('woo_template_archive')
			)
		);
		$tabs['woo_template_checkout'] = array(
			'title' => __('Checkout Page', 'kadence-woo-template-builder'),
			'filter' => array(
				'groups' => array('woo_template_checkout')
			)
		);
		
		return $tabs;
	}
	public function template_post_init() {
	  	$templatelabels = array(
		    'name' =>  __('Woo Product Template', 'kadence-woo-template-builder'),
		    'singular_name' => __('Woo Product Template Item', 'kadence-woo-template-builder'),
		    'add_new' => __('Add New', 'kadence-woo-template-builder'),
		    'add_new_item' => __('Add New Woo Product Template Item', 'kadence-woo-template-builder'),
		    'edit_item' => __('Edit Woo Product Template Item', 'kadence-woo-template-builder'),
		    'new_item' => __('New Woo Product Template Item', 'kadence-woo-template-builder'),
		    'all_items' => __('All Woo Product Template', 'kadence-woo-template-builder'),
		    'view_item' => __('View Woo Product Template Item', 'kadence-woo-template-builder'),
		    'search_items' => __('Search Woo Product Template', 'kadence-woo-template-builder'),
		    'not_found' =>  __('No Woo Product Template Item found', 'kadence-woo-template-builder'),
		    'not_found_in_trash' => __('No Woo Product Template Items found in Trash', 'kadence-woo-template-builder'),
		    'parent_item_colon' => '',
		    'menu_name' => __('Woo Product Template', 'kadence-woo-template-builder'),
	  	);

		$templateargs = array(
			'labels' => $templatelabels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => false, 
			'query_var' => true,
			'rewrite'  => false,
			'has_archive' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'revisions')
		);

	  	register_post_type( 'kt-product-template', $templateargs);

	  	$archivelabels = array(
		    'name' =>  __('Woo Archive Template', 'kadence-woo-template-builder'),
		    'singular_name' => __('Woo Archive Template Item', 'kadence-woo-template-builder'),
		    'add_new' => __('Add New', 'kadence-woo-template-builder'),
		    'add_new_item' => __('Add New Woo Archive Template Item', 'kadence-woo-template-builder'),
		    'edit_item' => __('Edit Woo Archive Template Item', 'kadence-woo-template-builder'),
		    'new_item' => __('New Woo Archive Template Item', 'kadence-woo-template-builder'),
		    'all_items' => __('All Woo Archive Template', 'kadence-woo-template-builder'),
		    'view_item' => __('View Woo Archive Template Item', 'kadence-woo-template-builder'),
		    'search_items' => __('Search Woo Archive Template', 'kadence-woo-template-builder'),
		    'not_found' =>  __('No Woo Archive Template Item found', 'kadence-woo-template-builder'),
		    'not_found_in_trash' => __('No Woo Archive Template Items found in Trash', 'kadence-woo-template-builder'),
		    'parent_item_colon' => '',
		    'menu_name' => __('Woo Archive Template', 'kadence-woo-template-builder'),
	  	);

		$archiveargs = array(
			'labels' => $archivelabels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => false, 
			'query_var' => true,
			'rewrite'  => false,
			'has_archive' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'revisions')
		);

	  register_post_type( 'kt-product-archive', $archiveargs);

	  	$checkoutlabels = array(
		    'name' =>  __('Woo Checkout Template', 'kadence-woo-template-builder'),
		    'singular_name' => __('Woo Checkout Template Item', 'kadence-woo-template-builder'),
		    'add_new' => __('Add New', 'kadence-woo-template-builder'),
		    'add_new_item' => __('Add New Woo Checkout Template Item', 'kadence-woo-template-builder'),
		    'edit_item' => __('Edit Woo Checkout Template Item', 'kadence-woo-template-builder'),
		    'new_item' => __('New Woo Checkout Template Item', 'kadence-woo-template-builder'),
		    'all_items' => __('All Woo Checkout Template', 'kadence-woo-template-builder'),
		    'view_item' => __('View Woo Checkout Template Item', 'kadence-woo-template-builder'),
		    'search_items' => __('Search Woo Checkout Template', 'kadence-woo-template-builder'),
		    'not_found' =>  __('No Woo Checkout Template Item found', 'kadence-woo-template-builder'),
		    'not_found_in_trash' => __('No Woo Checkout Template Items found in Trash', 'kadence-woo-template-builder'),
		    'parent_item_colon' => '',
		    'menu_name' => __('Woo Checkout Template', 'kadence-woo-template-builder'),
	  	);

		$checkoutargs = array(
			'labels' => $checkoutlabels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => false, 
			'query_var' => true,
			'rewrite'  => false,
			'has_archive' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'revisions')
		);

	  register_post_type( 'kt-checkout', $checkoutargs);
	}
	/**
	 * Add the admin menu entries
	 */
	public function single_product_page_menu(){
		add_menu_page('Woo Templates',
			'Woo Templates',
			'edit_pages',
			'kadence_woo_template_builder_overview',
			array( $this,'woo_template_overview'), 
			'dashicons-products'
		);
	}
	public function woo_template_overview(){
		?>
		<div class="wrap" style="height:0;overflow:hidden;"><h2></h2></div>
		
		<div class="wrap kwt-admin-page kwt-admin">	
			<?php 
			$post_loop = null; 
			$post_loop = new WP_Query();
			$post_loop->query(array(
				'orderby' => 'DESC',
				'order' => 'date',
				'post_type' => 'kt-product-template',
				'posts_per_page' => '-1'));
			if ($post_loop ) : ?>
			<div class="kwt-templates-list kwt-products kwt-table kwt-clearfix">
				<div class="kwt-table-title">
					<h3>
						<?php _e('Single Product Templates', 'kadence-woo-template-builder'); ?>
					</h3>
				</div>
				<div class="kwt_table_body kwt-clearfix">
					<div class="kwt-table-header kwt-clearfix">
						<div class="kwt-table-column kwt_column_01"><?php _e('Name', 'kadence-woo-template-builder'); ?></div>
						<div class="kwt-table-column kwt_column_02"><?php _e('Actions', 'kadence-woo-template-builder'); ?></div>
					</div>

					<?php 
			 		if (!$post_loop->have_posts()) : ?>
				        <div class="kwt-no-temlplates">
							<?php echo __('No Templates found. Please add a new one.', 'kadence-woo-template-builder'); ?>
						</div>
	       			<?php 
        			endif;

					while ($post_loop->have_posts() ) :$post_loop->the_post();
					global $post;
					?>
						<div class="kwt_table_content kwt_table_row kwt-clearfix">
							<div class="kwt-table-column kwt_column_01"><a href="<?php echo esc_url(get_edit_post_link($post->ID));?>"><?php echo get_the_title();?></a></div>
							<div class="kwt-table-column kwt_column_02">
								<a class="kwt-edit-template kwt-button kwt-button kwt-is-success" href="<?php echo get_edit_post_link($post->ID);?>"><?php echo __('Edit Template', 'kadence-woo-template-builder');?></a>
								<a class="kwt-delete-template kwt-button kwt-button kwt-is-danger" href="<?php echo get_delete_post_link($post->ID);?>"><?php echo __('Delete Template', 'kadence-woo-template-builder');?></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

			<?php endif; 
				wp_reset_query();
			?>
			<a class="kwt-button kwt-is-primary kwt-add-template" href="<?php echo admin_url( "post-new.php?post_type=kt-product-template" );?>"><?php _e('Add Single Product Template', 'kadence-woo-template-builder'); ?></a>
			<?php 
				$post_loop = null; 
				$post_loop = new WP_Query();
				$post_loop->query(array(
					'orderby' => 'DESC',
					'order' => 'date',
					'post_type' => 'kt-product-archive',
					'posts_per_page' => '-1'));
				if ( $post_loop ) : ?>
			<div class="kwt-templates-list kwt-archives kwt-table kwt-clearfix">
				<div class="kwt-table-title">
					<h3>
						<?php _e('Product Archive Templates', 'kadence-woo-template-builder'); ?>
					</h3>
				</div>
				<div class="kwt_table_body kwt-clearfix">
					<div class="kwt-table-header kwt-clearfix">
						<div class="kwt-table-column kwt_column_01"><?php _e('Name', 'kadence-woo-template-builder'); ?></div>
						<div class="kwt-table-column kwt_column_02"><?php _e('Actions', 'kadence-woo-template-builder'); ?></div>
					</div>

					<?php 
			 		if (!$post_loop->have_posts()) : ?>
				        <div class="kwt-no-temlplates">
							<?php echo __('No Templates found. Please add a new one.', 'kadence-woo-template-builder'); ?>
						</div>
	       			<?php 
        			endif;

					while ( $post_loop->have_posts() ) : $post_loop->the_post();
					global $post;
					?>
						<div class="kwt_table_content kwt_table_row kwt-clearfix">
							<div class="kwt-table-column kwt_column_01"><a href="<?php echo esc_url(get_edit_post_link($post->ID));?>"><?php echo get_the_title();?></a></div>
							<div class="kwt-table-column kwt_column_02">
								<a class="kwt-edit-template kwt-button kwt-button kwt-is-success" href="<?php echo get_edit_post_link($post->ID);?>"><?php echo __('Edit Template', 'kadence-woo-template-builder');?></a>
								<a class="kwt-delete-template kwt-button kwt-button kwt-is-danger" href="<?php echo get_delete_post_link($post->ID);?>"><?php echo __('Delete Template', 'kadence-woo-template-builder');?></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

			<?php endif; 
			wp_reset_query();
			?>
			<a class="kwt-button kwt-is-primary kt-product-archive" href="<?php echo admin_url( "post-new.php?post_type=kt-product-archive" );?>"><?php _e('Add Product Archive Template', 'kadence-woo-template-builder'); ?></a>
			<?php 
			$post_loop = null; 
			$post_loop = new WP_Query();
			$post_loop->query(array(
				'orderby' => 'DESC',
				'order' => 'date',
				'post_type' => 'kt-checkout',
				'posts_per_page' => '-1'));
			if ( $post_loop ) : ?>
			<div class="kwt-templates-list kwt-checkout kwt-table kwt-clearfix">
				<div class="kwt-table-title">
					<h3>
						<?php _e('Checkout Templates', 'kadence-woo-template-builder'); ?>
					</h3>
				</div>
				<div class="kwt_table_body kwt-clearfix">
					<div class="kwt-table-header kwt-clearfix">
						<div class="kwt-table-column kwt_column_01"><?php _e('Name', 'kadence-woo-template-builder'); ?></div>
						<div class="kwt-table-column kwt_column_02"><?php _e('Actions', 'kadence-woo-template-builder'); ?></div>
					</div>

				<?php 
			 	if (!$post_loop->have_posts()) : ?>
			        <div class="kwt-no-temlplates">
						<?php echo __('No Templates found. Please add a new one.', 'kadence-woo-template-builder'); ?>
					</div>
		       <?php 
	        	endif;
		
				while ( $post_loop->have_posts() ) : $post_loop->the_post();
				global $post;
				?>
					<div class="kwt_table_content kwt_table_row kwt-clearfix">
						<div class="kwt-table-column kwt_column_01"><a href="<?php echo esc_url(get_edit_post_link($post->ID));?>"><?php echo get_the_title();?></a></div>
						<div class="kwt-table-column kwt_column_02">
							<a class="kwt-edit-template kwt-button kwt-button kwt-is-success" href="<?php echo get_edit_post_link($post->ID);?>"><?php echo __('Edit Template', 'kadence-woo-template-builder');?></a>
							<a class="kwt-delete-template kwt-button kwt-button kwt-is-danger" href="<?php echo get_delete_post_link($post->ID);?>"><?php echo __('Delete Template', 'kadence-woo-template-builder');?></a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

		<?php endif; 
		wp_reset_query();
		?>
		<a class="kwt-button kwt-is-primary kt-product-archive" href="<?php echo admin_url( "post-new.php?post_type=kt-checkout" );?>"><?php _e('Add Checkout Template', 'kadence-woo-template-builder'); ?></a>
	</div>
	<?php 
	}
	public function template_metaboxes() {
		$prefix = '_kwt_';
		$kt_woo_template  = new_cmb2_box( array(
            'id'            => $prefix . 'product_template_setting',
            'title'         => __( 'Product Template', 'kadence-woo-template-builder' ),
            'object_types'  => array('product', ),
            'context'    => 'side',
            'priority'   => 'low',
        ) );
       $kt_woo_template ->add_field( array(
            'name'          => __( 'Assign Product Template', 'kadence-woo-template-builder' ),
            'desc'      => __( 'Choose a template or leave on default.', 'kadence-woo-template-builder' ),
            'id'            => $prefix . 'product_template',
            'type'          => 'select',
            'default'       => 'default',
            'options_cb'    => 'kwt_product_posts_options',
        ) );
	}

	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	
}
add_action( 'plugins_loaded', array( 'Kadence_Woo_Template_Builder', 'get_instance' ) );

function kwt_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => -1,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}
function kwt_product_posts_options() {
	$posts = kwt_get_post_options( array( 'post_type' => 'kt-product-template', 'numberposts' => -1 ) );
	$posts['default'] = __('Default', 'kadence-woo-template-builder');
	$posts['pagebuilder'] = __('Use this products Page Builder', 'kadence-woo-template-builder');
	return $posts;
}


// Plugin Updates
add_action( 'after_setup_theme', 'kwt_updating', 1 );
function kwt_updating() {
	require_once 'wp-updates-plugin.php';
	require_once KADENCE_WOO_TEMPLATE_PATH . 'admin/kadence-activation/kadence-plugin-api-manager.php';
	if ( get_option( 'kt_api_manager_kadence_woo_template_builder_activated' ) == 'Activated' ) {
		$kadence_woo_template_builder_updater = new PluginUpdateChecker_2_0( 'https://kernl.us/api/v1/updates/595d3eb4757ee910957bd1f5/', __FILE__, 'kadence-woo-template-builder', 1 );
		$kadence_woo_template_builder_updater->purchaseCode = "kt-member";
	}
}
/* text-domain */
function kwt_textdomain() {
  	load_plugin_textdomain( 'kadence-woo-template-builder', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'kwt_textdomain' );

function kwtb_remove_description_tab($tabs) {
	unset( $tabs['description'] );      	// Remove the description tab
	return $tabs;
}

function testsiteorigin_panels_dump(){
	echo "<!--\n\n";
	echo "// Page Builder Data\n\n";

	if(isset($_GET['page']) && $_GET['page'] == 'so_panels_home_page') {
		var_export( get_option( 'siteorigin_panels_home_page', null ) );
	}
	else{
		global $post;
		var_export( get_post_meta($post->ID, 'panels_data', true));
	}
	echo "\n\n-->";
}
//add_action('siteorigin_panels_metabox_end', 'testsiteorigin_panels_dump');