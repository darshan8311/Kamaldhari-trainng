<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product short description
 */
class kwt_product_entire_summary_action_widget extends WP_Widget {
	private static $instance = 0;
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_kwt_entire_summary_action', 
			'description' => __( 'Use this widget to add a products summary action to the page without calling any default', 'kadence-woo-template-builder' ),
		);
		parent::__construct( 'widget_kwt_entire_summary_action', __('Woo Product: Entire Summary', 'kadence-woo-template-builder' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		if ( is_product() ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
		}
		echo $after_widget;

    }

}