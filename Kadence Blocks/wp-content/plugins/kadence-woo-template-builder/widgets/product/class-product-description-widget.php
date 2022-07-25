<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product short description
 */
class kwt_product_description_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_description', 
        	'description' => __('Use this widget to add a products made content area', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_description', __('Woo Product: Description', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {
    	extract($args);
        echo $before_widget;
        if(is_product()) {
        	global $post;
        	$template = get_post_meta($post->ID,'_kwt_product_template', true );
			if (isset($template) && !empty($template) && $template != 'default' && $template == 'pagebuilder' ) {
	        	echo '<!-- Save from endless Loop -->';
	        } else {
	        	the_content();
	        }
	    }
        echo $after_widget;

    }

}