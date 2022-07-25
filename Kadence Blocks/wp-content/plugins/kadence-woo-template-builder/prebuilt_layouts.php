<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function kwt_prebuilt_layouts($layouts){
    $layouts['product-default'] = array(
        'name' => __('WOO Builder: Single Product Default', 'kadence-woo-template-builder'),    // Required
        'description' => __('Basic setup for product page', 'kadence-woo-template-builder'),  
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/builder_defualt-min.jpg',    // Optional
        'widgets' => 
	  array (
	    0 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_gallery_widget',
	        'grid' => 0,
	        'cell' => 0,
	        'id' => 0,
	        'widget_id' => 'f8a21675-fc02-4d35-a161-9a57919568e7',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    1 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_title_widget',
	        'grid' => 0,
	        'cell' => 1,
	        'id' => 1,
	        'widget_id' => '309b7b54-d9d5-40a9-93f7-399fc8f7042a',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    2 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_rating_widget',
	        'grid' => 0,
	        'cell' => 1,
	        'id' => 2,
	        'widget_id' => '9c27d70d-fee7-48c1-af45-040269692501',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    3 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_price_widget',
	        'grid' => 0,
	        'cell' => 1,
	        'id' => 3,
	        'widget_id' => '56824b10-c2f6-4e32-aed0-b690dd5c8fe3',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    4 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_short_description_widget',
	        'grid' => 0,
	        'cell' => 1,
	        'id' => 4,
	        'widget_id' => '171b435a-7dd7-41b8-aa8b-8163de422000',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    5 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_add_to_cart_widget',
	        'grid' => 0,
	        'cell' => 1,
	        'id' => 5,
	        'widget_id' => '326961ee-35ba-4eda-b74a-e2dfaffbc853',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    6 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_meta_widget',
	        'grid' => 0,
	        'cell' => 1,
	        'id' => 6,
	        'widget_id' => 'ae0c1375-048a-4ede-a51e-2da23adb023b',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    7 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_tabs_widget',
	        'grid' => 1,
	        'cell' => 0,
	        'id' => 7,
	        'widget_id' => 'e22e87e4-15f6-48ce-b915-6a2735f58545',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	    8 => 
	    array (
	      'panels_info' => 
	      array (
	        'class' => 'kwt_product_related_widget',
	        'grid' => 2,
	        'cell' => 0,
	        'id' => 8,
	        'widget_id' => '7e7b1f3d-9ad7-41da-9f19-1d3cf4c2733b',
	        'style' => 
	        array (
	          'background_image_attachment' => false,
	          'background_display' => 'tile',
	        ),
	      ),
	    ),
	  ),
	  'grids' => 
	  array (
	    0 => 
	    array (
	      'cells' => 2,
	      'style' => 
	      array (
	        'cell_alignment' => 'flex-start',
	        'background_image_position' => 'center top',
	        'background_image_style' => 'cover',
	        'row_separator' => 'none',
	      ),
	    ),
	    1 => 
	    array (
	      'cells' => 1,
	      'style' => 
	      array (
	      ),
	    ),
	    2 => 
	    array (
	      'cells' => 1,
	      'style' => 
	      array (
	      ),
	    ),
	  ),
	  'grid_cells' => 
	  array (
	    0 => 
	    array (
	      'grid' => 0,
	      'index' => 0,
	      'weight' => 0.314135101806193584028648047024034895002841949462890625,
	      'style' => 
	      array (
	      ),
	    ),
	    1 => 
	    array (
	      'grid' => 0,
	      'index' => 1,
	      'weight' => 0.685864898193806471482503184233792126178741455078125,
	      'style' => 
	      array (
	      ),
	    ),
	    2 => 
	    array (
	      'grid' => 1,
	      'index' => 0,
	      'weight' => 1,
	      'style' => 
	      array (
	      ),
	    ),
	    3 => 
	    array (
	      'grid' => 2,
	      'index' => 0,
	      'weight' => 1,
	      'style' => 
	      array (
	      ),
	    ),
	  ),
    );

    $layouts['product-archive-sidebar'] = array(
        'name' => __('WOO Builder: Product Archive Multiple sidebars', 'kadence-woo-template-builder'),    // Required
        'description' => __('Adds sidebars to either side of archive content', 'kadence-woo-template-builder'),  
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/builder_archive-min.jpg',    // Optional
        'widgets' => 
	  array (
     0 => 
    array (
      'title' => '',
      'panels_info' => 
      array (
        'class' => 'WC_Widget_Product_Search',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => '734934a7-9c57-4eb2-a5d5-b14134eeb1b9',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => 'Filter by price',
      'panels_info' => 
      array (
        'class' => 'WC_Widget_Price_Filter',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 1,
        'widget_id' => '46900f75-4636-4ee6-b727-9080ac456d23',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    2 => 
    array (
      'title' => 'Product categories',
      'orderby' => 'name',
      'hierarchical' => 1,
      'dropdown' => 0,
      'count' => 0,
      'show_children_only' => 0,
      'hide_empty' => 0,
      'panels_info' => 
      array (
        'class' => 'WC_Widget_Product_Categories',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 2,
        'widget_id' => '6df1ad9c-a83b-48d6-8f3a-8d9b18e7c523',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => 'ON SALE',
      'number' => 5,
      'show' => 'onsale',
      'orderby' => 'date',
      'order' => 'desc',
      'hide_free' => 0,
      'show_hidden' => 0,
      'panels_info' => 
      array (
        'class' => 'WC_Widget_Products',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 3,
        'widget_id' => '534d82e1-51d4-4238-82ae-cea853658994',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'panels_data' => 
      array (
        'widgets' => 
        array (
          0 => 
          array (
            'panels_data' => 
            array (
              'widgets' => 
              array (
                0 => 
                array (
                  'abovetitle' => 'experience the wild',
                  'atsize' => 20,
                  'atsmallsize' => 16,
                  'atcolor' => '#ffffff',
                  'atweight' => 'default',
                  'title' => 'ADVENTURE T-SHIRTS',
                  'tsize' => 60,
                  'tsmallsize' => 40,
                  'tcolor' => '#ffffff',
                  'title_html_tag' => 'h2',
                  'tweight' => 'default',
                  'subtitle' => '',
                  'ssize' => 30,
                  'ssmallsize' => 0,
                  'scolor' => '',
                  'sweight' => 'default',
                  'align' => 'center',
                  'btn_text' => '',
                  'btn_link' => '',
                  'btn_target' => 'false',
                  'btn_color' => '',
                  'btn_background' => '',
                  'btn_border' => '',
                  'btn_border_radius' => '',
                  'btn_border_color' => '',
                  'btn_hover_color' => '',
                  'btn_hover_background' => '',
                  'btn_hover_border_color' => '',
                  'btn_size' => 'large',
                  'panels_info' => 
                  array (
                    'class' => 'kad_calltoaction_widget',
                    'grid' => 0,
                    'cell' => 0,
                    'id' => 0,
                    'widget_id' => '2b37744a-d2b0-4c8a-bab5-d882c1334ec7',
                    'style' => 
                    array (
                      'id' => '',
                      'class' => '',
                      'widget_css' => '',
                      'mobile_css' => '',
                      'padding' => '',
                      'mobile_padding' => '',
                      'background' => '',
                      'background_image_attachment' => '0',
                      'background_display' => 'tile',
                      'border_color' => '',
                      'font_color' => '',
                      'link_color' => '',
                      'kt_animation_type' => 'fadeInUp',
                      'kt_animation_duration' => '900',
                      'kt_animation_delay' => 'none',
                    ),
                  ),
                ),
              ),
              'grids' => 
              array (
                0 => 
                array (
                  'cells' => 1,
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'cell_class' => '',
                    'row_css' => '',
                    'mobile_css' => '',
                    'bottom_margin' => '0px',
                    'gutter' => '',
                    'vertical_gutter' => 'default',
                    'padding' => '100px 0px 100px 0px',
                    'mobile_padding' => '',
                    'row_stretch' => '',
                    'collapse_behaviour' => '',
                    'collapse_order' => '',
                    'cell_alignment' => 'center',
                    'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_walking-min.jpg',
                    'background_image' => '',
                    'background' => '',
                    'background_image_style' => 'cover',
                    'background_image_position' => 'center center',
                    'border_top' => '',
                    'border_top_color' => '',
                    'border_bottom' => '',
                    'border_bottom_color' => '',
                    'row_separator' => 'none',
                    'next_row_background_color' => 'none',
                  ),
                ),
              ),
              'grid_cells' => 
              array (
                0 => 
                array (
                  'grid' => 0,
                  'index' => 0,
                  'weight' => 1,
                  'style' => 
                  array (
                  ),
                ),
              ),
            ),
            'builder_id' => '597a818222b6a',
            'panels_info' => 
            array (
              'class' => 'SiteOrigin_Panels_Widgets_Layout',
              'grid' => 0,
              'cell' => 0,
              'id' => 0,
              'widget_id' => '8ae7f23d-eb89-4146-8ca2-44b334fc5cb6',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          1 => 
          array (
            'column' => '3',
            'panels_info' => 
            array (
              'class' => 'kwt_product_archive_mainloop_widget',
              'raw' => false,
              'grid' => 0,
              'cell' => 0,
              'id' => 1,
              'widget_id' => '5b36d20d-3667-4ea4-ab73-2045345572d6',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          2 => 
          array (
            'panels_data' => 
            array (
              'widgets' => 
              array (
                0 => 
                array (
                  'info_icon' => 'kt-icon-shield2',
                  'image_uri' => '',
                  'image_id' => '',
                  'title' => 'Secure Ordering',
                  'description' => 'The best in security',
                  'background' => '',
                  'tcolor' => '',
                  'size' => 0,
                  'style' => 'none',
                  'iconbackground' => '',
                  'color' => '',
                  'link' => '',
                  'target' => '_self',
                  'panels_info' => 
                  array (
                    'class' => 'kad_infobox_widget',
                    'grid' => 0,
                    'cell' => 0,
                    'id' => 0,
                    'widget_id' => '5bf2635f-2b83-4260-961c-692a29efb626',
                    'style' => 
                    array (
                      'id' => '',
                      'class' => '',
                      'widget_css' => '',
                      'mobile_css' => '',
                      'padding' => '',
                      'mobile_padding' => '',
                      'background' => '',
                      'background_image_attachment' => '0',
                      'background_display' => 'tile',
                      'border_color' => '',
                      'font_color' => '',
                      'link_color' => '',
                      'kt_animation_type' => '',
                      'kt_animation_duration' => 'default',
                      'kt_animation_delay' => 'default',
                    ),
                  ),
                ),
                1 => 
                array (
                  'info_icon' => 'kt-icon-support',
                  'image_uri' => '',
                  'image_id' => '',
                  'title' => 'Top Support',
                  'description' => 'We have you covered.',
                  'background' => '',
                  'tcolor' => '',
                  'size' => 0,
                  'style' => 'none',
                  'iconbackground' => '',
                  'color' => '',
                  'link' => '',
                  'target' => '_self',
                  'panels_info' => 
                  array (
                    'class' => 'kad_infobox_widget',
                    'grid' => 0,
                    'cell' => 1,
                    'id' => 1,
                    'widget_id' => 'e560f3c6-4ed0-4024-9cd2-359d2046797f',
                    'style' => 
                    array (
                      'id' => '',
                      'class' => '',
                      'widget_css' => '',
                      'mobile_css' => '',
                      'padding' => '',
                      'mobile_padding' => '',
                      'background' => '',
                      'background_image_attachment' => '0',
                      'background_display' => 'tile',
                      'border_color' => '',
                      'font_color' => '',
                      'link_color' => '',
                      'kt_animation_type' => '',
                      'kt_animation_duration' => 'default',
                      'kt_animation_delay' => 'default',
                    ),
                  ),
                ),
              ),
              'grids' => 
              array (
                0 => 
                array (
                  'cells' => 2,
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'cell_class' => '',
                    'row_css' => '',
                    'mobile_css' => '',
                    'bottom_margin' => '',
                    'gutter' => '',
                    'mobile_padding' => '',
                    'padding_top' => '',
                    'padding_bottom' => '',
                    'padding_left' => '',
                    'padding_right' => '',
                    'row_stretch' => '',
                    'collapse_behaviour' => '',
                    'collapse_order' => '',
                    'cell_alignment' => 'flex-start',
                    'background_image' => '0',
                    'background_image_url' => '',
                    'background' => '',
                    'background_image_style' => 'cover',
                    'background_image_position' => 'center top',
                    'border_top' => '',
                    'border_top_color' => '',
                    'border_bottom' => '',
                    'border_bottom_color' => '',
                  ),
                ),
              ),
              'grid_cells' => 
              array (
                0 => 
                array (
                  'grid' => 0,
                  'index' => 0,
                  'weight' => 0.5,
                  'style' => 
                  array (
                    'id' => '',
                    'class' => '',
                    'cell_css' => '',
                    'mobile_css' => '',
                    'padding' => '',
                    'mobile_padding' => '',
                    'vertical_alignment' => 'auto',
                    'background' => '',
                    'background_image_attachment' => '0',
                    'background_display' => 'tile',
                    'border_color' => '',
                    'font_color' => '',
                    'link_color' => '',
                  ),
                ),
                1 => 
                array (
                  'grid' => 0,
                  'index' => 1,
                  'weight' => 0.5,
                  'style' => 
                  array (
                  ),
                ),
              ),
            ),
            'builder_id' => '597a802874217',
            'panels_info' => 
            array (
              'class' => 'SiteOrigin_Panels_Widgets_Layout',
              'raw' => false,
              'grid' => 0,
              'cell' => 0,
              'id' => 2,
              'widget_id' => 'bd716f3a-c8ca-495c-b458-910e6f81a89a',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
          3 => 
          array (
            'title' => 'Featured Products',
            'number' => 5,
            'show' => 'featured',
            'orderby' => 'date',
            'order' => 'desc',
            'hide_free' => 0,
            'show_hidden' => 0,
            'panels_info' => 
            array (
              'class' => 'WC_Widget_Products',
              'raw' => false,
              'grid' => 0,
              'cell' => 1,
              'id' => 3,
              'widget_id' => 'f41c34b3-5c56-4056-84c9-8ddea6ad92bf',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
              ),
            ),
          ),
          4 => 
          array (
            'title' => 'Product tags',
            'panels_info' => 
            array (
              'class' => 'WC_Widget_Product_Tag_Cloud',
              'raw' => false,
              'grid' => 0,
              'cell' => 1,
              'id' => 4,
              'widget_id' => '4ddf00f2-d5dc-4ec8-8c2a-3dc0ef6d2d43',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
              ),
            ),
          ),
          5 => 
          array (
            'image_uri' => 'http://themes.kadencethemes.com/virtue-bold/wp-content/uploads/2016/07/falls_01-min.jpg',
            'height' => 220,
            'height_setting' => 'normal',
            'title' => 'HOODIES',
            'description' => 'SHOP NOW',
            'link' => '#',
            'target' => 'false',
            'image_id' => 0,
            'subtitle' => 'SHOP NOW',
            'align' => 'left',
            'valign' => 'center',
            'panels_info' => 
            array (
              'class' => 'kad_imgmenu_widget',
              'grid' => 0,
              'cell' => 1,
              'id' => 5,
              'widget_id' => '0e0ecc3a-7fdb-4d84-8727-4a029a383c76',
              'style' => 
              array (
                'id' => '',
                'class' => '',
                'widget_css' => '',
                'mobile_css' => '',
                'padding' => '',
                'mobile_padding' => '',
                'background' => '',
                'background_image_attachment' => '0',
                'background_display' => 'tile',
                'border_color' => '',
                'font_color' => '',
                'link_color' => '',
                'kt_animation_type' => '',
                'kt_animation_duration' => 'default',
                'kt_animation_delay' => 'default',
              ),
            ),
          ),
        ),
        'grids' => 
        array (
          0 => 
          array (
            'cells' => 2,
            'style' => 
            array (
              'id' => '',
              'class' => '',
              'cell_class' => '',
              'row_css' => '',
              'mobile_css' => '',
              'bottom_margin' => '',
              'gutter' => '',
              'mobile_padding' => '',
              'padding_top' => '',
              'padding_bottom' => '',
              'padding_left' => '',
              'padding_right' => '',
              'row_stretch' => '',
              'collapse_behaviour' => '',
              'collapse_order' => '',
              'cell_alignment' => 'flex-start',
              'background_image' => '0',
              'background_image_url' => '',
              'background' => '',
              'background_image_style' => 'cover',
              'background_image_position' => 'center top',
              'border_top' => '',
              'border_top_color' => '',
              'border_bottom' => '',
              'border_bottom_color' => '',
            ),
          ),
        ),
        'grid_cells' => 
        array (
          0 => 
          array (
            'grid' => 0,
            'index' => 0,
            'weight' => 0.74973375931842001218541327034472487866878509521484375,
            'style' => 
            array (
            ),
          ),
          1 => 
          array (
            'grid' => 0,
            'index' => 1,
            'weight' => 0.25026624068157998781458672965527512133121490478515625,
            'style' => 
            array (
            ),
          ),
        ),
      ),
      'builder_id' => '597a818222b2a',
      'panels_info' => 
      array (
        'class' => 'SiteOrigin_Panels_Widgets_Layout',
        'grid' => 0,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '99c36f28-338c-4033-9964-28de5f224e56',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'collapse_order' => 'right-top',
        'cell_alignment' => 'flex-start',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.2004199640998400033797821606640354730188846588134765625,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.79958003590016002437579345496487803757190704345703125,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
  ),
);
    return $layouts;

}
add_filter('siteorigin_panels_prebuilt_layouts','kwt_prebuilt_layouts', 99);
add_action('init', 'kwt_custom_prebuilt');
function kwt_custom_prebuilt() {
	 $the_theme = wp_get_theme();
	if( $the_theme->get( 'Name' ) == 'Pinnacle Premium' || $the_theme->get( 'Template') == 'pinnacle_premium' || $the_theme->get( 'Name' ) == 'Virtue - Premium' || $the_theme->get( 'Template') == 'virtue_premium' ) {
		add_filter('siteorigin_panels_prebuilt_layouts','kwt_pack_virtue_prebuilt_layout', 99);
	} else {
		add_filter('siteorigin_panels_prebuilt_layouts','kwt_pack_prebuilt_layout', 99);
	}
}

function kwt_pack_prebuilt_layout($layouts) {
	 $layouts['product-pack-example'] = array(
        'name' => __('WOO Builder: Single Product "Pack" Example', 'kadence-woo-template-builder'),    // Required
        'description' => __('Unique Backpack Product Page', 'kadence-woo-template-builder'),  
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/builder_pack-min.jpg',    // Optional
        'widgets' => 
	  array (
    0 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => '<b>ULTI BACKPACK</b></br>THE EVERYONE,</br>EVERYDAY PACK.',
      'tsize' => 80,
      'tsmallsize' => 60,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h1',
      'tweight' => '300',
      'subtitle' => '$49.99',
      'ssize' => 30,
      'ssmallsize' => 24,
      'scolor' => '#ffffff',
      'sweight' => '600',
      'align' => 'left',
      'btn_text' => 'BUY NOW',
      'btn_link' => '#purchase_info',
      'btn_target' => 'false',
      'btn_color' => '#ffffff',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#ffffff',
      'btn_hover_color' => '#444444',
      'btn_hover_background' => '#ffffff',
      'btn_hover_border_color' => '#ffffff',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 0,
        'widget_id' => '5a9d5061-02e3-4ea6-92e9-797497be176d',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'slideInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    1 => 
    array (
      'abovetitle' => 'ULTI QUALITY',
      'atsize' => 20,
      'atsmallsize' => 0,
      'atcolor' => '#555555',
      'atweight' => '300',
      'title' => 'WE <b>GUARANTEE</b> EACH STICH',
      'tsize' => 60,
      'tsmallsize' => 40,
      'tcolor' => '#333333',
      'title_html_tag' => 'h1',
      'tweight' => '300',
      'subtitle' => 'Vivamus scelerisque est at viverra mollis. Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam. ',
      'ssize' => 24,
      'ssmallsize' => 20,
      'scolor' => '#555555',
      'sweight' => '300',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '#ffffff',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#ffffff',
      'btn_hover_color' => '#444444',
      'btn_hover_background' => '#ffffff',
      'btn_hover_border_color' => '#ffffff',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'grid' => 1,
        'cell' => 1,
        'id' => 1,
        'widget_id' => '0ee79aea-9c64-4b95-b0dc-6e29637cb2ab',
        'style' => 
        array (
          'mobile_padding' => '0px 20px 0px 20px',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    2 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => 'TAKE IT <b>ALL</b> WITH YOU',
      'tsize' => 60,
      'tsmallsize' => 40,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => 'AVAILABLE IN THREE PRO SIZES',
      'ssize' => 24,
      'ssmallsize' => 20,
      'scolor' => '#ffffff',
      'sweight' => '600',
      'align' => 'left',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '#555555',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#555555',
      'btn_hover_color' => '#ffffff',
      'btn_hover_background' => '#555555',
      'btn_hover_border_color' => '#555555',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 2,
        'widget_id' => '2d44a755-cbaf-48b1-9bf8-5e4ba2bd4521',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInLeftBig',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    3 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_wearable-min.jpg',
      'image_id' => '',
      'image_shape' => 'square',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'none',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 3,
        'widget_id' => 'ac8ac463-0c89-4957-af83-2e52d6313adf',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    4 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h3>Comfortable means wearable in every day situations.</h3>
[space  size="20px"]
<strong>Vivamus scelerisque est at viverra mollis.</strong> </br> Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam.

<strong>Nullam nec eros sed urna euismod ultricies at vitae nibh.</strong></br> Vivamus scelerisque est at viverra mollis.',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 3,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '629251c9-9cb3-4442-9459-c36d3690ba30',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    5 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h3>Durable, lasts through everyday use and abuse.</h3>
[space  size="20px"]
<strong>Vivamus scelerisque est at viverra mollis.</strong> </br>Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam. Nullam nec eros sed urna euismod ultricies at vitae nibh.

<strong>Nullam nec eros sed urna euismod ultricies at vitae nibh.</strong> </br>Vivamus scelerisque est at viverra mollis. Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam.',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 4,
        'cell' => 0,
        'id' => 5,
        'widget_id' => '3f788a5a-997b-4754-9398-5dcff85a76fb',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    6 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_wearable_02-min.jpg',
      'image_id' => '',
      'image_shape' => 'square',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'none',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 4,
        'cell' => 1,
        'id' => 6,
        'widget_id' => '90c57b5f-8d94-4041-a18c-1386f2d1702c',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    7 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_product-min.png',
      'image_id' => '',
      'image_shape' => 'standard',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'kad_image_widget',
        'raw' => false,
        'grid' => 5,
        'cell' => 0,
        'id' => 7,
        'widget_id' => '34dddf81-1906-48d3-b43c-c4dfd3db2f84',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    8 => 
    array (
      'type' => 'visual',
      'title' => '',
      'text' => '<h2>PURCHASE ULTI BACKPACK</h2><h4>$49.99</h4><ul><li>Three available sizes</li><li>Lifetime Warranty</li><li>Free Shipping</li></ul>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 5,
        'cell' => 1,
        'id' => 8,
        'widget_id' => 'a64deebe-101c-497f-9a13-36884bb8bd7b',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    9 => 
    array (
      'panels_info' => 
      array (
        'class' => 'kwt_product_add_to_cart_widget',
        'grid' => 5,
        'cell' => 1,
        'id' => 9,
        'widget_id' => 'c1e01bdd-a3cb-4ac4-bf02-3e84a3caf089',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '120px 0px 120px 0px',
        'row_stretch' => 'full-stretched',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_walking-min.jpg',
        'background_image_position' => 'right center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    1 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding' => '120px 0px 120px 0px',
        'row_stretch' => 'full-stretched',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'right center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'padding' => '200px 0px 200px 0px',
        'mobile_padding' => '100px 0px 100px 0px',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_everything-min.jpg',
        'background_image_position' => 'center center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    3 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '80px 0px 0px 0px',
        'mobile_padding' => '30px 0px 0px 0px',
        'bottom_margin' => '0px',
        'gutter' => '80px',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    4 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding' => '80px 0px 80px 0px',
        'mobile_padding' => '30px 0px 30px 0px',
        'bottom_margin' => '0px',
        'gutter' => '80px',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    5 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'id' => 'purchase_info',
        'padding' => '100px 0px 100px 0px',
        'background' => '#f9f9f9',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'border_top' => '1px',
        'border_top_color' => '#eeeeee',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.1002624671916010345995573516120202839374542236328125,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.4994750656167978863919643117696978151798248291015625,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 0,
      'index' => 2,
      'weight' => 0.400262467191601079008478336618281900882720947265625,
      'style' => 
      array (
      ),
    ),
    3 => 
    array (
      'grid' => 1,
      'index' => 0,
      'weight' => 0.200262467191601067906248090366716496646404266357421875,
      'style' => 
      array (
      ),
    ),
    4 => 
    array (
      'grid' => 1,
      'index' => 1,
      'weight' => 0.5994750656167979752098062817822210490703582763671875,
      'style' => 
      array (
      ),
    ),
    5 => 
    array (
      'grid' => 1,
      'index' => 2,
      'weight' => 0.200262467191601067906248090366716496646404266357421875,
      'style' => 
      array (
      ),
    ),
    6 => 
    array (
      'grid' => 2,
      'index' => 0,
      'weight' => 1,
      'style' => 
      array (
      ),
    ),
    7 => 
    array (
      'grid' => 3,
      'index' => 0,
      'weight' => 0.400105570425622170116497500202967785298824310302734375,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    8 => 
    array (
      'grid' => 3,
      'index' => 1,
      'weight' => 0.59989442957437777437235126853920519351959228515625,
      'style' => 
      array (
      ),
    ),
    9 => 
    array (
      'grid' => 4,
      'index' => 0,
      'weight' => 0.59987514590732249342153181714820675551891326904296875,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    10 => 
    array (
      'grid' => 4,
      'index' => 1,
      'weight' => 0.40012485409267750657846818285179324448108673095703125,
      'style' => 
      array (
      ),
    ),
    11 => 
    array (
      'grid' => 5,
      'index' => 0,
      'weight' => 0.499968475278169843800668559197220019996166229248046875,
      'style' => 
      array (
      ),
    ),
    12 => 
    array (
      'grid' => 5,
      'index' => 1,
      'weight' => 0.5000315247218301006881802095449529588222503662109375,
      'style' => 
      array (
      ),
    ),
  ),
);
return $layouts;
}

function kwt_pack_virtue_prebuilt_layout($layouts) {
	 $layouts['product-pack-example'] = array(
        'name' => __('WOO Builder: Single Product "Pack" Example', 'kadence-woo-template-builder'),    // Required
        'description' => __('Unique Backpack Product Page', 'kadence-woo-template-builder'),  
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/builder_pack-min.jpg',    // Optional
        'widgets' => 
	  array (
    0 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => '<b>ULTI BACKPACK</b></br>THE EVERYONE,</br>EVERYDAY PACK.',
      'tsize' => 80,
      'tsmallsize' => 60,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h1',
      'tweight' => '300',
      'subtitle' => '$49.99',
      'ssize' => 30,
      'ssmallsize' => 24,
      'scolor' => '#ffffff',
      'sweight' => '600',
      'align' => 'left',
      'btn_text' => 'BUY NOW',
      'btn_link' => '#purchase_info',
      'btn_target' => 'false',
      'btn_color' => '#ffffff',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#ffffff',
      'btn_hover_color' => '#444444',
      'btn_hover_background' => '#ffffff',
      'btn_hover_border_color' => '#ffffff',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 0,
        'widget_id' => '5a9d5061-02e3-4ea6-92e9-797497be176d',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'slideInLeft',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    1 => 
    array (
      'abovetitle' => 'ULTI QUALITY',
      'atsize' => 20,
      'atsmallsize' => 0,
      'atcolor' => '#555555',
      'atweight' => '300',
      'title' => 'WE <b>GUARANTEE</b> EACH STICH',
      'tsize' => 60,
      'tsmallsize' => 40,
      'tcolor' => '#333333',
      'title_html_tag' => 'h1',
      'tweight' => '300',
      'subtitle' => 'Vivamus scelerisque est at viverra mollis. Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam. ',
      'ssize' => 24,
      'ssmallsize' => 20,
      'scolor' => '#555555',
      'sweight' => '300',
      'align' => 'center',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '#ffffff',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#ffffff',
      'btn_hover_color' => '#444444',
      'btn_hover_background' => '#ffffff',
      'btn_hover_border_color' => '#ffffff',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'grid' => 1,
        'cell' => 1,
        'id' => 1,
        'widget_id' => '0ee79aea-9c64-4b95-b0dc-6e29637cb2ab',
        'style' => 
        array (
          'mobile_padding' => '0px 20px 0px 20px',
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    2 => 
    array (
      'abovetitle' => '',
      'atsize' => 16,
      'atsmallsize' => 0,
      'atcolor' => '',
      'atweight' => 'default',
      'title' => 'TAKE IT <b>ALL</b> WITH YOU',
      'tsize' => 60,
      'tsmallsize' => 40,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h2',
      'tweight' => '300',
      'subtitle' => 'AVAILABLE IN THREE PRO SIZES',
      'ssize' => 24,
      'ssmallsize' => 20,
      'scolor' => '#ffffff',
      'sweight' => '600',
      'align' => 'left',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => 'false',
      'btn_color' => '#555555',
      'btn_background' => 'transparent',
      'btn_border' => '2px',
      'btn_border_radius' => '2px',
      'btn_border_color' => '#555555',
      'btn_hover_color' => '#ffffff',
      'btn_hover_background' => '#555555',
      'btn_hover_border_color' => '#555555',
      'btn_size' => 'large',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 2,
        'widget_id' => '2d44a755-cbaf-48b1-9bf8-5e4ba2bd4521',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInLeftBig',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    3 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_wearable-min.jpg',
      'image_id' => '',
      'image_shape' => 'square',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'none',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'Simple_About_With_Image',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 3,
        'widget_id' => 'ac8ac463-0c89-4957-af83-2e52d6313adf',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    4 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h3>Comfortable means wearable in every day situations.</h3>
[space  size="20px"]
<strong>Vivamus scelerisque est at viverra mollis.</strong> </br> Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam.

<strong>Nullam nec eros sed urna euismod ultricies at vitae nibh.</strong></br> Vivamus scelerisque est at viverra mollis.',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 3,
        'cell' => 1,
        'id' => 4,
        'widget_id' => '629251c9-9cb3-4442-9459-c36d3690ba30',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    5 => 
    array (
      'type' => 'html',
      'title' => '',
      'text' => '<h3>Durable, lasts through everyday use and abuse.</h3>
[space  size="20px"]
<strong>Vivamus scelerisque est at viverra mollis.</strong> </br>Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam. Nullam nec eros sed urna euismod ultricies at vitae nibh.

<strong>Nullam nec eros sed urna euismod ultricies at vitae nibh.</strong> </br>Vivamus scelerisque est at viverra mollis. Nullam nec eros sed urna euismod ultricies at vitae nibh. Integer ut elementum diam.',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 4,
        'cell' => 0,
        'id' => 5,
        'widget_id' => '3f788a5a-997b-4754-9398-5dcff85a76fb',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => '300',
        ),
      ),
    ),
    6 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_wearable_02-min.jpg',
      'image_id' => '',
      'image_shape' => 'square',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'none',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'Simple_About_With_Image',
        'raw' => false,
        'grid' => 4,
        'cell' => 1,
        'id' => 6,
        'widget_id' => '90c57b5f-8d94-4041-a18c-1386f2d1702c',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_type' => 'fadeInUp',
          'kt_animation_duration' => '900',
          'kt_animation_delay' => 'none',
        ),
      ),
    ),
    7 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_product-min.png',
      'image_id' => '',
      'image_shape' => 'standard',
      'image_size' => 'full',
      'width' => 0,
      'height' => 0,
      'image_link_open' => 'lightbox',
      'image_link' => '',
      'box_shadow' => 'none',
      'text' => '',
      'panels_info' => 
      array (
        'class' => 'Simple_About_With_Image',
        'raw' => false,
        'grid' => 5,
        'cell' => 0,
        'id' => 7,
        'widget_id' => '34dddf81-1906-48d3-b43c-c4dfd3db2f84',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    8 => 
    array (
      'type' => 'visual',
      'title' => '',
      'text' => '<h2>PURCHASE ULTI BACKPACK</h2><h4>$49.99</h4><ul><li>Three available sizes</li><li>Lifetime Warranty</li><li>Free Shipping</li></ul>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Black_Studio_TinyMCE',
        'raw' => false,
        'grid' => 5,
        'cell' => 1,
        'id' => 8,
        'widget_id' => 'a64deebe-101c-497f-9a13-36884bb8bd7b',
        'style' => 
        array (
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
    9 => 
    array (
      'panels_info' => 
      array (
        'class' => 'kwt_product_add_to_cart_widget',
        'grid' => 5,
        'cell' => 1,
        'id' => 9,
        'widget_id' => 'c1e01bdd-a3cb-4ac4-bf02-3e84a3caf089',
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
          'kt_animation_duration' => 'default',
          'kt_animation_delay' => 'default',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding_top'               => '120px',
        'padding_bottom'            => '120px',
        'row_stretch' => 'full-stretched',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_walking-min.jpg',
        'background_image_position' => 'right center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    1 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'padding_top'               => '120px',
        'padding_bottom'            => '120px',
        'row_stretch' => 'full-stretched',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'right center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'padding_top'               => '200px',
        'padding_bottom'            => '200px',
        'mobile_padding' => '100px 0px 100px 0px',
        'bottom_margin' => '0px',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/pack_everything-min.jpg',
        'background_image_position' => 'center center',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    3 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding_top'               => '80px',
        'padding_bottom'            => '0px',
        'mobile_padding' => '30px 0px 0px 0px',
        'bottom_margin' => '0px',
        'gutter' => '80px',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    4 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'padding_top'               => '80px',
        'padding_bottom'            => '80px',
        'mobile_padding' => '30px 0px 30px 0px',
        'bottom_margin' => '0px',
        'gutter' => '80px',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'row_separator' => 'none',
      ),
    ),
    5 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'id' => 'purchase_info',
        'padding_top'               => '100px',
        'padding_bottom'            => '100px',
        'background' => '#f9f9f9',
        'row_stretch' => 'full',
        'cell_alignment' => 'center',
        'vertical_gutter' => 'default',
        'background_image_position' => 'center top',
        'background_image_style' => 'cover',
        'border_top' => '1px',
        'border_top_color' => '#eeeeee',
        'row_separator' => 'none',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'index' => 0,
      'weight' => 0.1002624671916010345995573516120202839374542236328125,
      'style' => 
      array (
      ),
    ),
    1 => 
    array (
      'grid' => 0,
      'index' => 1,
      'weight' => 0.4994750656167978863919643117696978151798248291015625,
      'style' => 
      array (
      ),
    ),
    2 => 
    array (
      'grid' => 0,
      'index' => 2,
      'weight' => 0.400262467191601079008478336618281900882720947265625,
      'style' => 
      array (
      ),
    ),
    3 => 
    array (
      'grid' => 1,
      'index' => 0,
      'weight' => 0.200262467191601067906248090366716496646404266357421875,
      'style' => 
      array (
      ),
    ),
    4 => 
    array (
      'grid' => 1,
      'index' => 1,
      'weight' => 0.5994750656167979752098062817822210490703582763671875,
      'style' => 
      array (
      ),
    ),
    5 => 
    array (
      'grid' => 1,
      'index' => 2,
      'weight' => 0.200262467191601067906248090366716496646404266357421875,
      'style' => 
      array (
      ),
    ),
    6 => 
    array (
      'grid' => 2,
      'index' => 0,
      'weight' => 1,
      'style' => 
      array (
      ),
    ),
    7 => 
    array (
      'grid' => 3,
      'index' => 0,
      'weight' => 0.400105570425622170116497500202967785298824310302734375,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    8 => 
    array (
      'grid' => 3,
      'index' => 1,
      'weight' => 0.59989442957437777437235126853920519351959228515625,
      'style' => 
      array (
      ),
    ),
    9 => 
    array (
      'grid' => 4,
      'index' => 0,
      'weight' => 0.59987514590732249342153181714820675551891326904296875,
      'style' => 
      array (
        'background_display' => 'tile',
        'vertical_alignment' => 'auto',
      ),
    ),
    10 => 
    array (
      'grid' => 4,
      'index' => 1,
      'weight' => 0.40012485409267750657846818285179324448108673095703125,
      'style' => 
      array (
      ),
    ),
    11 => 
    array (
      'grid' => 5,
      'index' => 0,
      'weight' => 0.499968475278169843800668559197220019996166229248046875,
      'style' => 
      array (
      ),
    ),
    12 => 
    array (
      'grid' => 5,
      'index' => 1,
      'weight' => 0.5000315247218301006881802095449529588222503662109375,
      'style' => 
      array (
      ),
    ),
  ),
);
return $layouts;
}
