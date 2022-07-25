<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_checkout_order_review_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_checkout_order_review', 
        	'description' => __('Shows Order Review fields for checkout.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_checkout_order_review', __('Woo Checkout: Order Review', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);
        $instance['widget_title'] 	= empty( $instance['widget_title'] ) ? __( 'Your order', 'kadence-woo-template-builder' ) : apply_filters( 'widget_title', $instance['widget_title'], $instance );
        echo $before_widget;
        if(is_checkout()) { 
        	if ( ! empty( $instance['widget_title'] ) ) : ?>
        		<h3 class="kwt-order-review-title">
					<?php echo wp_kses_post( $instance['widget_title'] ); ?>
				</h3>
			<?php
			endif; 
        	woocommerce_order_review();
        }
        echo $after_widget;

    }
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['widget_title'] = sanitize_text_field( $new_instance['widget_title'] );

        return $instance;
    }
    public function form($instance){

  			$widget_title = ! empty( $instance['widget_title'] ) ? $instance['widget_title'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php esc_html_e( 'Widget title:', 'ascend' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
		</p>

		<?php 
		}

}