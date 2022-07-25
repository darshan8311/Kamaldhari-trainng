<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_checkout_shipping_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_checkout_shipping', 
        	'description' => __('Shows shipping fields for checkout.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_checkout_shipping', __('Woo Checkout: Shipping Fields', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);

        echo $before_widget;
        if(is_checkout()) {
        	$checkout = WC()->checkout();
        	if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
        		<div class="woocommerce-shipping-fields">
				<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

					<h3 id="ship-to-different-address">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
							<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php _e( 'Ship to a different address?', 'kadence-woo-template-builder' ); ?></span>
						</label>
					</h3>

					<div class="shipping_address">

						<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

						<div class="woocommerce-shipping-fields__field-wrapper">
							<?php
								$fields = $checkout->get_checkout_fields( 'shipping' );

								foreach ( $fields as $key => $field ) {
									if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
										$field['country'] = $checkout->get_value( $field['country_field'] );
									}
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
							?>
						</div>

						<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

					</div>

				<?php endif; ?>
			</div>
			<?php 
        	endif;
        }
        echo $after_widget;

    }

}