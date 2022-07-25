<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product upsell
 */
class kwt_product_upsell_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_upsell', 
        	'description' => __('Use this widget to add a products upsell products.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_upsell', __('Woo Product: Upsell', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	woocommerce_upsell_display();
        }
        echo $after_widget;

    }

}