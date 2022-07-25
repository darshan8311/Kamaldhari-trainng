<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product additional
 */
class kwt_product_kadence_related_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_kadence_related', 
        	'description' => __('Use this widget to add a the Kadence Related Carousel to your product page.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_kadence_related', __('Woo Product: Kadence Related Carousel', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	global $product;
        	echo '<div class="woocommerce-kt-related-content">';
        		Kadence_Related_Content::kt_related_content_output();
        	echo '</div>';
        }
        echo $after_widget;

    }

}