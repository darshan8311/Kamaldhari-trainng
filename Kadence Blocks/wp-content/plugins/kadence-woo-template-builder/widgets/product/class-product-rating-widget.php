<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product short description
 */
class kwt_product_rating_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_rating', 
        	'description' => __('Use this widget to add a products rating.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_rating', __('Woo Product: Rating', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	woocommerce_template_single_rating();
        }
        echo $after_widget;

    }

}