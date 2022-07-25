<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_checkout_additional_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_checkout_additional', 
        	'description' => __('Shows additional fields for checkout.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_checkout_additional', __('Woo Checkout: Additional Fields', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);

        echo $before_widget;
        if(is_checkout()) {
        	$checkout = WC()->checkout();
        	if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
        		<div class="woocommerce-additional-fields">
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

						<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

							<h3><?php _e( 'Additional information', 'kadence-woo-template-builder' ); ?></h3>

						<?php endif; ?>

						<div class="woocommerce-additional-fields__field-wrapper">
							<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
								<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
							<?php endforeach; ?>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
				</div>
				<?php 
        	endif;
        }
        echo $after_widget;

    }

}