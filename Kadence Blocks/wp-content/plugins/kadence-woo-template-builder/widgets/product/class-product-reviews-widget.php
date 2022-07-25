<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product reviews
 */
class kwt_product_reviews_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_reviews', 
        	'description' => __('Use this widget to add a products reviews.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_reviews', __('Woo Product: Reviews', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	echo '<div class="woocommerce-tabs-list">';
        		comments_template();
        	echo '</div>';
        }
        echo $after_widget;

    }

}