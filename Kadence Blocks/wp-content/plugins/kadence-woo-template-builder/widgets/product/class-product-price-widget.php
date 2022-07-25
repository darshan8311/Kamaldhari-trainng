<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product short description
 */
class kwt_product_price_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_price', 
        	'description' => __('Use this widget to add a products price.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_price', __('Woo Product: Price', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	echo '<div class="entry-summary">';
        		woocommerce_template_single_price();
        	echo '</div>';
        }
        echo $after_widget;

    }

}