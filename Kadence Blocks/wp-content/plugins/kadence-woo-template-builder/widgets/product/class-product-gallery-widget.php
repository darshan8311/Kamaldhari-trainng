<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product gallery
 */
class kwt_product_gallery_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_gallery', 
        	'description' => __('Use this widget to add a products gallery.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_gallery', __('Woo Product: Gallery', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	echo '<div class="product-img-case" style="width:auto;">';
			global $kt_product_gallery, $kt_woo_extras; 
			if(isset($kt_woo_extras['product_gallery']) && $kt_woo_extras['product_gallery'] == 1) {
				woocommerce_show_product_sale_flash();
				$kt_product_gallery->kt_woo_product_gallery();
			} else {
				woocommerce_show_product_sale_flash();
				woocommerce_show_product_images();
			}
	        echo '</div>';
	    }
        echo $after_widget;

    }

}