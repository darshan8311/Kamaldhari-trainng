<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_product_title_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_product_title', 
        	'description' => __('Use this widget to add a product title', 'ascend')
        );
        parent::__construct('widget_kwt_product_title', __('Woo Product: Product Title', 'ascend'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);

        echo $before_widget;
        if(is_product()) {
        	woocommerce_template_single_title();
        }
        echo $after_widget;

    }

}