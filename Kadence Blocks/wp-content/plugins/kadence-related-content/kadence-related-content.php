<?php
/**
 * Plugin Name:       Kadence Related Content
 * Plugin URI:        https://www.kadencewp.com/
 * Description:       A powerful plugin to add "inter content marketing" throughout a site by linking posts, products and pages together to create better interlinking throughout your site.
 * Version:           1.0.10
 * Author:            Kadence WP
 * Author URI:        https://www.kadencewp.com/
 * Text Domain:       kadence-related-content
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


/**
 * Load Translation
 */
function kt_related_content_load_textdomain() {
	load_plugin_textdomain( 'kadence-related-content', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'kt_related_content_load_textdomain' );


if ( ! defined( 'KTRC_PATH' ) ) {
	define( 'KTRC_PATH', realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR );
}
if ( ! defined( 'KTRC_URL' ) ) {
	define( 'KTRC_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'KTRC_VERSION' ) ) {
	define( 'KTRC_VERSION', '1.0.10' );
}

/*
 * INIT
 */

// Get admin panel loaded
require_once( KTRC_PATH . '/admin/admin_options.php' );
require_once( KTRC_PATH . '/admin/cmb/init.php' );
require_once( KTRC_PATH . '/admin/cmb_select2/cmb_select2.php' );
require_once( KTRC_PATH . '/classes/class-kadence-related-get-image.php' );

add_action( 'plugins_loaded', 'kt_related_content_plugin_loaded' );
function kt_related_content_plugin_loaded() {
	class Kadence_Related_Content {
		public function __construct() {
			add_filter( 'cmb2_admin_init', array( $this, 'kt_related_content_metaboxes' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'kt_related_content_enqueue_scripts' ) );
			add_action( 'init', array( $this, 'init' ) );
		}
		public function init() {
			if ( class_exists( 'Kadence_API_Manager' ) ) {
				// Blog
				add_action( 'kadence_single_post_after', array( $this, 'kt_related_content_output' ), 35 );
				add_action( 'virtue_single_post_after', array( $this, 'kt_related_content_output' ), 35 );
				add_action( 'ascend_single_post_after', array( $this, 'kt_related_content_output' ), 35 );
				// Page
				add_action( 'kadence_page_footer', array( $this, 'kt_related_content_output' ), 15 );
			} else {
				require_once( KTRC_PATH . '/classes/class-kadence-image-processing.php' );
				add_filter( 'the_content', array( $this, 'kt_related_content_output_filter' ), 100 );
			}
			// Product
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'kt_related_content_output' ), 30 );

			// Carousel Content
			add_action( 'kt_rc_item_content_image', array( $this, 'kt_rc_post_image' ), 10 );
			add_action( 'kt_rc_item_content', array( $this, 'kt_rc_post_type' ), 20 );
			add_action( 'kt_rc_item_content', array( $this, 'kt_rc_post_title' ), 30 );
			add_action( 'kt_rc_item_content', array( $this, 'kt_rc_post_meta' ), 40 );
			add_action( 'kt_rc_item_content', array( $this, 'kt_rc_post_excerpt' ), 50 );
			add_action( 'kt_rc_item_content', array( $this, 'kt_rc_post_price' ), 60 );
		}
		public function kt_rc_post_price() {
			global $post, $kt_related_content;
			if ( isset( $kt_related_content['show_post_price'] ) && $kt_related_content['show_post_price'] == 1 && get_post_type() == 'product' ) {
				echo '<div class="kt_related_content_post_price">';
					woocommerce_template_loop_price();
				echo '</div>';
			}
		}
		public function kt_rc_post_excerpt() {
			global $post, $kt_related_content;
			if ( isset( $kt_related_content['show_post_excerpt'] ) && $kt_related_content['show_post_excerpt'] == 1 ) {
				if ( isset( $kt_related_content['post_excerpt_word_count'] ) ) {
					$word_count = $kt_related_content['post_excerpt_word_count'];
				} else {
					$word_count = 16;
				}
				if ( ! empty( $kt_related_content['post_excerpt_read_more'] ) ) {
					$readmore = $kt_related_content['post_excerpt_read_more'];
				} else {
					$readmore = __( 'Read More', 'kadence-related-content' );
				}
				echo '<div class="kt_related_content_post_excerpt">';
					 echo '<p>' . $this->kt_related_excerpt( $word_count ) . ' <a href="' . get_the_permalink() . '">' . $readmore . '</a></p>';
				echo '</div>';
			}
		}
		function kt_related_excerpt( $limit ) {
			$excerpt = explode( ' ', get_the_excerpt(), $limit );
			if ( count( $excerpt ) >= $limit ) {
				array_pop( $excerpt );
				$excerpt = implode( ' ', $excerpt ) . '...';
			} else {
				$excerpt = implode( ' ', $excerpt );
			}
			$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
			return $excerpt;
		}

		public function kt_rc_post_meta() {
			global $post, $kt_related_content;
			if ( isset( $kt_related_content['show_post_meta'] ) && $kt_related_content['show_post_meta'] == 1 ) {
				if ( get_post_type() == 'product' ) {
					global $product;
					if ( $rating_count = $product->get_rating_count() ) {
						echo '<a href="' . get_the_permalink() . '">' . wc_get_rating_html( $product->get_average_rating() ) . '</a>';
					} else {
						echo "<span class='notrated'>" . __( 'not rated', 'kadence-related-content' ) . '</span>';
					}
				} elseif ( get_post_type() == 'page' ) {
					echo '<div class="kt_related_content_post_date"><time class="updated" datetime="' . get_the_modified_date( 'c' ) . '" pubdate>' . get_the_modified_date() . '</time></div>';
				} else {
					echo '<div class="kt_related_content_post_date"><time class="updated" datetime="' . get_the_time( 'c' ) . '" pubdate>' . get_the_date() . '</time></div>';
				}
			}
		}
		public function kt_rc_post_type() {
			global $post, $kt_related_content;
			if ( isset( $kt_related_content['show_post_type'] ) && $kt_related_content['show_post_type'] == 1 ) {
				$post_type = get_post_type();
				if ( 'tribe_events' ===  $post_type ) {
					$post_type = 'event';
				}
				echo '<div class="kt_related_content_post_type">' . $post_type . '</div>';
			}
		}
		public function kt_rc_post_title() {
			global $post, $kt_related_content;
			if ( isset( $kt_related_content['show_post_title'] ) && $kt_related_content['show_post_title'] == 0 ) {
				// do nothing
			} else {
				echo '<h3 class="entry-title">';
				echo '<a href="' . get_permalink( $post->ID ) . '" class="kt_related_content_title_link">';
						the_title();
				echo '</a>';
				echo '</h3>';
			}
		}
		public function kt_rc_post_image() {
			global $post, $kt_related_content, $kt_related_content_columns;
			if ( has_post_thumbnail( $post->ID ) ) {
				echo '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '" class="kt_related_content_image_link">';
				if ( class_exists( 'Kadence_Related_Get_Image' ) ) {
					if ( isset( $kt_related_content['image_ratio'] ) ) {
						$img_ratio = $kt_related_content['image_ratio'];
					} else {
						$img_ratio = 'landscape';
					}
					if ( $kt_related_content_columns == 2 ) {
						$image_width = 600;
					} else if ( $kt_related_content_columns == 3 ) {
						$image_width = 400;
					} else if ( $kt_related_content_columns == 6 ) {
						$image_width = 300;
					} else if ( $kt_related_content_columns == 5 ) {
						$image_width = 300;
					} else {
						$image_width = 400;
					}
					if ( $img_ratio == 'portrait' ) {
						$tempimgheight = $image_width * 1.35;
						$image_height = floor( $tempimgheight );
					} else if ( $img_ratio == 'landscape' ) {
						$tempimgheight = $image_width / 1.35;
						$image_height = floor( $tempimgheight );
					} else if ( $img_ratio == 'widelandscape' ) {
						$tempimgheight = $image_width / 2;
						$image_height = floor( $tempimgheight );
					} else {
						$image_height = $image_width;
					}
					$image_id = get_post_thumbnail_id( $post->ID );
					$related_get_image = Kadence_Related_Get_Image::getInstance();
					$image = $related_get_image->process( $image_id, $image_width, $image_height );

					echo '<img src="' . esc_url( $image[0] ) . '" width="' . esc_attr( $image[1] ) . '" height="' . esc_attr( $image[2] ) . '" ' . wp_kses_post( $image[3] ) . ' class="kt_related_content_image" alt="' . esc_attr( $post->post_title ) . '">';

				} else {
					echo get_the_post_thumbnail( $post->ID, 'medium' );
				}

				echo '</a>';
			}
		}

		public function kt_related_posts_options( $query_args = array() ) {
			$defaults = array(
				'posts_per_page' => -1,
			);

			$query = new WP_Query( array_replace_recursive( $defaults, $query_args ) );

			$posts = $query->get_posts();

			$post_options = array();
			if ( $posts ) {
				foreach ( $posts as $post ) {
					$post_options[ $post->ID ] = $post->post_title . ' - ' . $post->post_type;
				}
			}
			return $post_options;
		}

		public function kt_related_content_metaboxes() {
			$prefix = '_kt_rc_';
			$kt_related_content = new_cmb2_box(
				array(
					'id'            => $prefix . 'carousel_options',
					'priority'      => 'low',
					'title'         => __( 'Related Content Carousel Options', 'kadence-related-content' ),
					'object_types'  => array( 'post', 'page', 'product' ), // Post type
				)
			);
			$kt_related_content->add_field(
				array(
					'name'          => __( 'Carousel Title', 'kadence-related-content' ),
					'id'            => $prefix . 'carousel_title',
					'type'          => 'text',
				)
			);
			$kt_related_content->add_field(
				array(
					'name'    => __( 'Carousel Columns', 'kadence-related-content' ),
					'desc'    => __( 'Select how many columns you would like to show at once.', 'kadence-related-content' ),
					'id'      => $prefix . 'carousel_columns',
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'kadence-related-content' ),
						'2' => __( 'Two', 'kadence-related-content' ),
						'3' => __( 'Three', 'kadence-related-content' ),
						'4' => __( 'Four', 'kadence-related-content' ),
						'5' => __( 'Five', 'kadence-related-content' ),
						'6' => __( 'Six', 'kadence-related-content' ),
					),
				)
			);
			$kt_related_content->add_field(
				array(
					'name'    => __( 'Related Posts, Products or Pages', 'kadence-related-content' ),
					'desc'    => __( 'Select the posts you want to be added to the related content carousel', 'kadence-related-content' ),
					'id'      => $prefix . 'related_posts',
					'type'    => 'pw_multiselect',
					'options' => $this->kt_related_posts_options( array( 'post_type' => array( 'post', 'page', 'product', 'tribe_events', 'portfolio' ) ) ),
				)
			);
		}
		public function kt_related_content_output_filter( $content ) {
			if ( doing_filter( 'get_the_excerpt' ) ) {
				return $content;
			}
			if ( is_page() || is_singular( 'post' ) ) {
				ob_start();
				$this->kt_related_content_output();
				$output = ob_get_contents();
				ob_end_clean();
				$content = $content . $output;
			}
			return $content;
		}
		public function kt_related_content_output() {
			global $post, $kt_related_content, $kt_related_content_columns;
			$carousel_ids = get_post_meta( $post->ID, '_kt_rc_related_posts', true );
			if ( ! empty( $carousel_ids ) && is_array( $carousel_ids ) ) {
				// Get options
				if ( isset( $kt_related_content['text_align'] ) ) {
					$align = $kt_related_content['text_align'];
				} else {
					$align = 'kt-rc-center-align';
				}
				if ( isset( $kt_related_content['carousel_auto'] ) && $kt_related_content['carousel_auto'] == '1' ) {
					$auto = 'true';
				} else {
					$auto = 'false';
				}
				if ( isset( $kt_related_content['carousel_speed'] ) ) {
					$speed = $kt_related_content['carousel_speed'] . '000';
				} else {
					$speed = '9000';
				}
				if ( isset( $kt_related_content['carousel_scroll'] ) && ! empty( $kt_related_content['carousel_scroll'] ) ) {
					$scroll = $kt_related_content['carousel_scroll'];
				} else {
					$scroll = '1';
				}
				$carousel_title = get_post_meta( $post->ID, '_kt_rc_carousel_title', true );
				if ( empty( $carousel_title ) || $carousel_title == 'default' ) {
					if ( isset( $kt_related_content['carousel_title'] ) ) {
						$title = $kt_related_content['carousel_title'];
					} else {
						$title = __( 'You might also be interested in...', 'kadence-related-content' );
					}
				} else {
					$title = $carousel_title;
				}
				$carousel_columns = get_post_meta( $post->ID, '_kt_rc_carousel_columns', true );
				if ( empty( $carousel_columns ) || $carousel_columns == 'default' ) {
					if ( isset( $kt_related_content['carousel_columns'] ) ) {
						$columns = $kt_related_content['carousel_columns'];
					} else {
						$columns = '4';
					}
				} else {
					$columns = $carousel_columns;
				}
				$kt_related_content_columns = $columns;
				$rc = array();
				$fullwidth = apply_filters( 'kt_related_content_carousel_fullwidth', false );
				if ( $fullwidth == 'true' ) {
					if ( $columns == '2' ) {
							$itemsize = 'col-sxl-3 col-xl-4 col-md-6 col-sm-6 col-xs-12 col-ss-12';
							$rc['sxl'] = 4;
							$rc['xl'] = 3;
							$rc['md'] = 2;
							$rc['sm'] = 2;
							$rc['xs'] = 1;
							$rc['ss'] = 1;
					} else if ( $columns == '3' ) {
							$itemsize = 'col-sxl-2 col-xl-3 col-md-4 col-sm-4 col-xs-6 col-ss-12';
							$rc['sxl'] = 6;
							$rc['xl'] = 4;
							$rc['md'] = 3;
							$rc['sm'] = 3;
							$rc['xs'] = 2;
							$rc['ss'] = 1;
					} else if ( $columns == '6' ) {
							$itemsize = 'col-sxl-1 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
							$rc['sxl'] = 12;
							$rc['xl'] = 8;
							$rc['md'] = 6;
							$rc['sm'] = 4;
							$rc['xs'] = 3;
							$rc['ss'] = 2;
					} else if ( $columns == '5' ) {
							$itemsize = 'col-sxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
							$rc['sxl'] = 8;
							$rc['xl'] = 6;
							$rc['md'] = 5;
							$rc['sm'] = 4;
							$rc['xs'] = 3;
							$rc['ss'] = 2;
					} else {
							$itemsize = 'col-sxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
							$rc['sxl'] = 6;
							$rc['xl'] = 5;
							$rc['md'] = 4;
							$rc['sm'] = 3;
							$rc['xs'] = 2;
							$rc['ss'] = 1;
					}
				} else {
					if ( $columns == '2' ) {
							$itemsize = 'col-sxl-6 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
							$rc['md'] = 2;
							$rc['sm'] = 2;
							$rc['xs'] = 1;
							$rc['ss'] = 1;
					} else if ( $columns == '3' ) {
							$itemsize = 'col-sxl-4 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
							$rc['md'] = 3;
							$rc['sm'] = 3;
							$rc['xs'] = 2;
							$rc['ss'] = 1;
					} else if ( $columns == '6' ) {
							$itemsize = 'col-sxl-2 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
							$rc['md'] = 6;
							$rc['sm'] = 4;
							$rc['xs'] = 3;
							$rc['ss'] = 2;
					} else if ( $columns == '5' ) {
							$itemsize = 'col-sxl-25 col-xl-25 col-md-25 col-sm-3 col-xs-4 col-ss-6';
							$rc['md'] = 5;
							$rc['sm'] = 4;
							$rc['xs'] = 3;
							$rc['ss'] = 2;
					} else {
							$itemsize = 'col-sxl-3 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
							$rc['md'] = 4;
							$rc['sm'] = 3;
							$rc['xs'] = 2;
							$rc['ss'] = 1;
					}
					$rc['sxl'] = $rc['md'];
					$rc['xl'] = $rc['md'];
				}
				$rc = apply_filters( 'kt_related_content_carousel_columns', $rc );

				// Product Layout?
				if ( isset( $kt_related_content['product_layout'] ) && $kt_related_content['product_layout'] == '1' ) {
					$product_layout = true;
					global $woocommerce_loop;
					$woocommerce_loop['columns'] = $columns;
				} else {
					$product_layout = false;
				}
				wp_enqueue_script( 'kadence_related_content' );
				$finalids = array();
				foreach ( $carousel_ids as $key => $value ) {
					$finalids[] = $value;
				}
				if ( isset( $wp_query ) ) {
					$temp = $wp_query;
				} else {
					$temp = null;
				}
				$wp_query = null;
				$wp_query = new WP_Query();
				$wp_query->query(
					array(
						'post_type'     => array( 'post', 'page', 'product', 'portfolio', 'tribe_events' ),
						'posts_per_page' => -1,
						'ignore_sticky_posts' => 1,
						'orderby' => 'post__in',
						'post__in' => $finalids,
					)
				);
				if ( $wp_query ) :
					echo '<div id="kt_rc_carousel_outer" class="carousel_outer woocommerce">';
					echo '<h3 class="sectiontitle">' . $title . '</h3>';
					echo '<div id="kt_rc_carousel_inner" class="rowtight kt-rc-fadein-carousel">';
						echo '<ul id="kt_rc_carousel" class="kt_rc_carousel products kt-slick-carousel products kt_rc_carousel_init clearfix" data-slider-anim-speed="400" data-slider-gutter="40" data-slider-scroll="' . esc_attr( $scroll ) . '" data-slider-auto="' . esc_attr( $auto ) . '" data-slider-speed="' . esc_attr( $speed ) . '" data-columns-xxl="' . esc_attr( $rc['sxl'] ) . '" data-columns-xl="' . esc_attr( $rc['xl'] ) . '" data-columns-md="' . esc_attr( $rc['md'] ) . '" data-columns-sm="' . esc_attr( $rc['sm'] ) . '" data-columns-xs="' . esc_attr( $rc['xs'] ) . '" data-columns-ss="' . esc_attr( $rc['ss'] ) . '">';
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();
							if ( get_post_type() == 'product' && $product_layout == true ) {
								wc_get_template_part( 'content', 'product' );
							} else {
								echo '<li class="' . esc_attr( $itemsize ) . ' ' . esc_attr( $align ) . ' kt_rc_item kt_item_type_' . get_post_type() . '">';
									echo '<div class="postclass kt_rc_item_inner">';
										/**
										* @hooked kt_rc_post_image - 10
										*/
										do_action( 'kt_rc_item_content_image' );
										echo '<div class="kt_rc_item_content">';
											/**
											* @hooked kt_rc_post_type - 20
											* @hooked kt_rc_post_title - 30
											* @hooked kt_rc_post_meta - 40
											* @hooked kt_rc_post_excerpt - 50
											* @hooked kt_rc_post_price - 60
											*/
											do_action( 'kt_rc_item_content' );
										echo '</div>';
									echo '</div>';
								echo '</li>';
							}
						endwhile;
						echo '</ul>';
					echo '</div>';
					echo '</div>';
				endif;
				$wp_query = null;
				$wp_query = $temp;  // Reset.
				wp_reset_query();
			}
		}
		public function kt_related_content_enqueue_scripts() {
				wp_enqueue_style( 'kadence-slide', KTRC_URL . 'assets/css/slider.css', false, KTRC_VERSION );
				wp_enqueue_style( 'kadence_related_content', KTRC_URL . 'assets/css/related-content.css', false, KTRC_VERSION );
				//wp_register_script( 'slick_slider', KTRC_URL . 'assets/js/min/slick-slider-min.js', array( 'jquery' ), KTRC_VERSION, true );
				//wp_register_script( 'kadence_related_content_js', KTRC_URL . 'assets/js/min/kt-related-content-min.js', array( 'jquery' ), KTRC_VERSION, true );
				wp_register_script( 'kadence-slide', KTRC_URL . 'assets/js/src/tiny-slider.js', array(), KTRC_VERSION, true );
				wp_register_script( 'kadence_related_content', KTRC_URL . 'assets/js/src/related-content.js', array( 'kadence-slide' ), KTRC_VERSION, true );
				wp_script_add_data( 'kadence-slide', 'async', true );
				wp_script_add_data( 'kadence-slide', 'precache', true );
				wp_script_add_data( 'kadence_related_content', 'async', true );
				wp_script_add_data( 'kadence_related_content', 'precache', true );
		}

	}

	$GLOBALS['kadence_related_content'] = new Kadence_Related_Content();
}

/**
 * Plugin Updates
 */
function kt_related_content_updating() {
	require_once 'wp-updates-plugin.php';
	$kadence_related_content_updater = new PluginUpdateChecker_2_0( 'https://kernl.us/api/v1/updates/57bce802f1331d750396d325/', __FILE__, 'kadence-related-content', 1 );
	$kadence_related_content_updater->purchaseCode = 'kt-member';

}
add_action( 'after_setup_theme', 'kt_related_content_updating', 1 );
