<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product short description
 */
class kwt_product_short_description_widget extends WP_Widget {
	private static $instance = 0;
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_kwt_short_description', 
			'description' => __('Use this widget to add a products short description', 'kadence-woo-template-builder')
		);
		parent::__construct('widget_kwt_short_description', __('Woo Product: Short Description', 'kadence-woo-template-builder'), $widget_ops);
	}

    public function widget($args, $instance) {
		extract($args);
		echo $before_widget;
		if( is_product() ) {
			woocommerce_template_single_excerpt();
		}
		echo $after_widget;

    }

}