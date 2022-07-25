<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Product Title
 */
class kwt_product_archive_mainloop_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array(
        	'classname' => 'widget_kwt_product_archive_mainloop', 
        	'description' => __('Product archive main loop. For example on a category page it would show the products.', 'kadence-woo-template-builder')
        );
        parent::__construct('widget_kwt_product_title', __('Woo Archive: Main Loop', 'kadence-woo-template-builder'), $widget_ops);
    }

    public function widget($args, $instance) {

        extract($args);
		if(isset($instance['column']) && !empty($instance['column']) && $instance['column'] != 'default' ){
		  	if ( version_compare( WC_VERSION, '3.3', '>' ) ) {
				wc_set_loop_prop( 'columns',  $instance['column'] );
			} else {
				global $woocommerce_loop;
				$woocommerce_loop['columns'] = $instance['column'];
			}
		}
		if(isset($instance['show_count_and_ordering']) && !empty($instance['show_count_and_ordering']) && $instance['show_count_and_ordering'] == 'true' ){
		  	echo '<div class="clearfix kt_shop_top_container">';
		  		woocommerce_result_count();
		  		if( function_exists( 'kt_woocommerce_page_title_toggle') ) {
		  			kt_woocommerce_page_title_toggle();
		  		}
		  		woocommerce_catalog_ordering();
		  	echo '</div>';
		}
        echo $before_widget;
        if( is_shop() || is_product_category() || is_product_tag() ) {
        	if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				if(isset($instance['show_count_and_ordering']) && !empty($instance['show_count_and_ordering']) && $instance['show_count_and_ordering'] == 'true' ){

				}
				woocommerce_product_loop_start();

					if ( version_compare( WC_VERSION, '3.3', '>' ) ) {
						if(isset($instance['column']) && !empty($instance['column']) && $instance['column'] != 'default' ){
							wc_set_loop_prop( 'columns',  $instance['column'] );
						}
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}
					} else  {
						woocommerce_product_subcategories(); 
						// reset columns encase categories changed them.
						if(isset($instance['column']) && !empty($instance['column']) && $instance['column'] != 'default' ){
				        	global $woocommerce_loop;
				        	$woocommerce_loop['columns'] = $instance['column'];
				        }

						while ( have_posts() ) : the_post();

							wc_get_template_part( 'content', 'product' ); 

						endwhile; // end of the loop. 

					}
				woocommerce_product_loop_end();


				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			
			else :
				if ( version_compare( WC_VERSION, '3.3', '<' ) ) {
					if ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {
						wc_get_template( 'loop/no-products-found.php' );
					}
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );

				}
			endif;

        }

        echo $after_widget;

    }

	public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['column'] = sanitize_text_field( $new_instance['column'] );
        $instance['show_count_and_ordering'] = sanitize_text_field( $new_instance['show_count_and_ordering'] );

        return $instance;
    }
    public function form($instance){
    		$column = ! empty( $instance['column'] ) ? $instance['column'] : 'default';
    		$show_count_and_ordering = ! empty( $instance['show_count_and_ordering'] ) ? $instance['show_count_and_ordering'] : 'false';
    		$column_array = array();
    		$count_array = array();
  			$column_options = array(array("slug" => "default", "name" => __('Default', 'kadence-woo-template-builder')), array("slug" => "1", "name" => __('1', 'kadence-woo-template-builder')), array("slug" => "2", "name" => __('2', 'kadence-woo-template-builder')), array("slug" => "3", "name" => __('3', 'kadence-woo-template-builder')), array("slug" => "4", "name" => __('4', 'kadence-woo-template-builder')), array("slug" => "5", "name" => __('5', 'kadence-woo-template-builder')));
  			$count_options = array(array("slug" => "false", "name" => __('False', 'kadence-woo-template-builder')), array("slug" => "true", "name" => __('True', 'kadence-woo-template-builder')) );
  			foreach ($column_options as $column_option) {
		      	if ($column == $column_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$column_array[] = '<option value="' . $column_option['slug'] .'"' . $selected . '>' . $column_option['name'] . '</option>';
		    }
		    foreach ($count_options as $count_option) {
		      	if ($show_count_and_ordering == $count_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
		      	$count_array[] = '<option value="' . $count_option['slug'] .'"' . $selected . '>' . $count_option['name'] . '</option>';
		    }
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>"><?php esc_html_e( 'Product columns:', 'kadence-woo-template-builder' ); ?></label>
			<select id="<?php echo $this->get_field_id('column'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('column'); ?>"><?php echo implode('', $column_array);?></select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count_and_ordering' ) ); ?>"><?php esc_html_e( 'Force add results and orderby above loop:', 'kadence-woo-template-builder' ); ?></label>
			<select id="<?php echo $this->get_field_id('show_count_and_ordering'); ?>" style="width:100%; max-width:230px;" name="<?php echo $this->get_field_name('show_count_and_ordering'); ?>"><?php echo implode('', $count_array);?></select>
		</p>

		<?php 
		}
	}