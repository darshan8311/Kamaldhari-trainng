<?php
/**
 * Product navigation arrows.
 *
 * @package Kadence Woo template builder.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Product navigation arrows
 */
class kwt_product_navigation_arrows_widget extends WP_Widget {
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
			'classname'   => 'widget_kwt_navigation_arrows',
			'description' => __( 'Use this widget next and previous product navigation arrows.', 'kadence-woo-template-builder' ),
		);
		parent::__construct( 'widget_kwt_navigation_arrows', __( 'Woo Product: Navigation Arrows', 'kadence-woo-template-builder' ), $widget_ops );
	}
	/**
	 * Output function
	 *
	 * @param array $args the widget args.
	 * @param array $instance the widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( is_product() ) {
			echo '<div class="ktw-product-navigation product-nav clearfix">';
				$prev_post = get_adjacent_post( true, null, true, 'product_cat' );
				if ( ! empty( $prev_post ) ) :
					echo '<div class="alignleft kad-previous-link">';
						echo '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '"><span class="kt_postlink_meta kt_color_gray">' . __( 'Previous Product', 'kadence-woo-template-builder' ) . '</span><span class="kt_postlink_title">' . esc_html( $prev_post->post_title ) . '</span></a>';
					echo '</div>';
				endif;
				$next_post = get_adjacent_post( true, null, false, 'product_cat' );
				if ( ! empty( $next_post ) ) :
					echo '<div class="alignright kad-next-link">';
						echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '"><span class="kt_postlink_meta kt_color_gray">' . __( 'Next Product', 'kadence-woo-template-builder' ) . '</span><span class="kt_postlink_title">' . esc_html( $next_post->post_title ) . '</span></a>';
					echo '</div>';
				endif;
			echo '</div> <!-- end navigation -->';
		}
	}
}