<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_checkout_payment_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_checkout_payment', 
        	'description' => __('Shows payment fields for checkout.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_checkout_payment', __('Woo Checkout: Payment', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);
         $instance['widget_title'] 	= empty( $instance['widget_title'] ) ? '' : apply_filters( 'widget_title', $instance['widget_title'], $instance );
        echo $before_widget;
        if(is_checkout()) {
       		if ( ! is_ajax() ):
				do_action( 'woocommerce_review_order_before_payment' );
			endif;
			if ( ! empty( $instance['widget_title'] ) ) : ?>
        		<h3 class="kwt-order-review-title">
					<?php echo wp_kses_post( $instance['widget_title'] ); ?>
				</h3>
			<?php
			endif; 
			woocommerce_checkout_payment();	
			
			if ( ! is_ajax() ):
				do_action( 'woocommerce_review_order_after_payment' );
			endif;
		}
        echo $after_widget;

    }

}