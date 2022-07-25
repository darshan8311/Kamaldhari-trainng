<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product additional
 */
class kwt_product_additional_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_additional', 
        	'description' => __('Use this widget to add a products additional information.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_additional', __('Woo Product: Additional information', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if( is_product() ) {
        	global $product;
        	echo '<div class="woocommerce-tabs-list">';
        		do_action( 'woocommerce_product_additional_information', $product );
        	echo '</div>';
        }
        echo $after_widget;

    }

}