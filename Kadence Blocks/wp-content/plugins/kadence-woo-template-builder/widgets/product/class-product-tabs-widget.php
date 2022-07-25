<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Tabs
 */
class kwt_product_tabs_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_tabs', 
        	'description' => __('Use this widget to add a products tabs.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_tabs', __('Woo Product: Tabs', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	global $post;
        	$template = get_post_meta($post->ID,'_kwt_product_template', true );
			if (isset($template) && !empty($template) && $template != 'default' && $template == 'pagebuilder' ) {
	        	add_filter( 'woocommerce_product_tabs', 'kwtb_remove_description_tab', 98 );
	        }
        	woocommerce_output_product_data_tabs();
        }
        echo $after_widget;

    }

}