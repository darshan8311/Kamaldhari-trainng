<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product related
 */
class kwt_product_related_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_related', 
        	'description' => __('Use this widget to add a products related products.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_related', __('Woo Product: Related', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	woocommerce_output_related_products();
        }
        echo $after_widget;

    }

}