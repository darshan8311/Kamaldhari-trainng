<?php
/**
 * Product archive description widget
 *
 * @package Kadence Woo template builder.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Product archive description widget
 */
class kwt_archive_description_widget extends WP_Widget {

	/**
	 * Instance control
	 *
	 * @var = 0
	 */
	private static $instance = 0;

	/**
	 * Construct function
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_kwt_product_archive_description',
			'description' => __( 'Product archive description content.', 'kadence-woo-template-builder' ),
		);
		parent::__construct( 'widget_kwt_archive_description', __( 'Woo Archive: Description', 'kadence-woo-template-builder' ), $widget_ops );
	}

	/**
	 * Output function
	 *
	 * @param array $args the widget args.
	 * @param array $instance the widget instance.
	 */
	public function widget( $args, $instance ) {

		if ( is_product_taxonomy() || is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {

			echo '<div class="kadence-kwt-builder-archive-description">';
			/**
			 * Hook: woocommerce_archive_description.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			echo '</div>';
		}

	}
}