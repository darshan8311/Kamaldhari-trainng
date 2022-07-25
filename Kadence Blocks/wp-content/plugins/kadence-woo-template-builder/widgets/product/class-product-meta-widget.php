<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product short description
 */
class kwt_product_meta_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_meta', 
        	'description' => __('Use this widget to add a products meta, like categories, tags and sku.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_meta', __('Woo Product: Meta', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	woocommerce_template_single_meta();
        }
        echo $after_widget;

    }

}