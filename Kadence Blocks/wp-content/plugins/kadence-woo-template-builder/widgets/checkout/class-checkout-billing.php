<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_checkout_billing_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_checkout_billing', 
        	'description' => __('Shows billing fields for checkout.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_checkout_billing', __('Woo Checkout: Billing Fields', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);

        echo $before_widget;
		if(is_checkout()) {
			$checkout = WC()->checkout();
			if ( sizeof( $checkout->checkout_fields ) > 0 ) :
				do_action( 'woocommerce_checkout_billing' ); 
			endif;
		}
        echo $after_widget;

    }

}