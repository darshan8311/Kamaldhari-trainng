<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_product_single_category_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_product_single_category', 
        	'description' => __('Use this widget to add the primary category name to the output', 'ascend')
        );
        parent::__construct('widget_kwt_product_single_cat', __('Woo Product: Single Category', 'ascend'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if( is_product() ) {
        	global $post;
        	echo '<div class="product_title_cat">';
        		// check if yoast category set and there is a primary
              	if (class_exists('WPSEO_Primary_Term') ) {
              		$WPSEO_term = new WPSEO_Primary_Term('product_cat', $post->ID);
					$WPSEO_term = $WPSEO_term->get_primary_term();
					$WPSEO_term = get_term($WPSEO_term);
					if (is_wp_error($WPSEO_term)) { 
						if ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
							$main_term = $terms[0];
						}
					} else {
						$main_term = $WPSEO_term;
					}
					echo $main_term->name;
				} else if ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
					$main_term = $terms[0];
					echo $main_term->name;
				}
			echo '</div>';
        }
        echo $after_widget;

    }

}