<?php
/**
 * WooCommerce Integration for Quezon Care Theme
 * 
 * This file adds WooCommerce support and customizes the shop appearance
 * to match the theme's glassmorphism design.
 *
 * @package Quezon_Care
 * @since 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if WooCommerce is active
 */
function quezon_care_is_woocommerce_active() {
    return class_exists('WooCommerce');
}

/**
 * Add WooCommerce theme support
 */
function quezon_care_woocommerce_setup() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 400,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 6,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ),
    ));
    
    // Gallery features
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'quezon_care_woocommerce_setup');

/**
 * WooCommerce specific scripts and styles
 */
function quezon_care_woocommerce_scripts() {
    if (!quezon_care_is_woocommerce_active()) {
        return;
    }
    
    // WooCommerce custom styles
    wp_enqueue_style(
        'quezon-care-woocommerce',
        get_template_directory_uri() . '/assets/css/woocommerce.css',
        array('quezon-care-style'),
        QUEZON_CARE_VERSION
    );
}
add_action('wp_enqueue_scripts', 'quezon_care_woocommerce_scripts');

/**
 * Remove default WooCommerce wrapper
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Custom wrapper start
 */
function quezon_care_woocommerce_wrapper_start() {
    ?>
    <div class="woocommerce-wrapper bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen pt-8 pb-24">
        <div class="container max-w-7xl mx-auto px-4 md:px-8">
    <?php
}
add_action('woocommerce_before_main_content', 'quezon_care_woocommerce_wrapper_start', 10);

/**
 * Custom wrapper end
 */
function quezon_care_woocommerce_wrapper_end() {
    ?>
        </div>
    </div>
    <?php
}
add_action('woocommerce_after_main_content', 'quezon_care_woocommerce_wrapper_end', 10);

/**
 * Remove WooCommerce sidebar
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Customize products per page
 */
function quezon_care_products_per_page($cols) {
    return 12;
}
add_filter('loop_shop_per_page', 'quezon_care_products_per_page');

/**
 * Customize products per row
 */
function quezon_care_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'quezon_care_loop_columns');

/**
 * Related products per page
 */
function quezon_care_related_products_args($args) {
    $args['posts_per_page'] = 3;
    $args['columns'] = 3;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'quezon_care_related_products_args');

/**
 * Custom product loop wrapper
 */
function quezon_care_product_loop_start() {
    echo '<div class="products-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">';
}
add_filter('woocommerce_product_loop_start', 'quezon_care_product_loop_start');

/**
 * Customize product thumbnail
 */
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'quezon_care_product_thumbnail', 10);

function quezon_care_product_thumbnail() {
    global $product;
    
    // Healthcare product placeholder images
    $healthcare_placeholders = array(
        'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop', // Pills/medication
        'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=400&h=400&fit=crop', // Medical device
        'https://images.unsplash.com/photo-1603398938378-e54eab446dde?w=400&h=400&fit=crop', // First aid
        'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&h=400&fit=crop', // Medical equipment
        'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?w=400&h=400&fit=crop', // Healthcare items
        'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop', // Medical supplies
    );
    
    // Select a consistent placeholder based on product ID
    $placeholder_index = $product->get_id() % count($healthcare_placeholders);
    $placeholder = $healthcare_placeholders[$placeholder_index];
    
    $image_id = $product->get_image_id();
    
    if ($image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
    } else {
        $image_url = $placeholder;
    }
    
    echo '<div class="product-thumbnail-wrapper relative overflow-hidden rounded-2xl mb-4 aspect-square">';
    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">';
    
    // Sale badge
    if ($product->is_on_sale()) {
        echo '<span class="absolute top-4 right-4 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">' . esc_html__('SALE', 'quezon-care') . '</span>';
    }
    
    // Out of stock badge
    if (!$product->is_in_stock()) {
        echo '<span class="absolute top-4 left-4 bg-gray-800 text-white text-xs font-bold px-3 py-1.5 rounded-full">' . esc_html__('Out of Stock', 'quezon-care') . '</span>';
    }
    
    echo '</div>';
}

/**
 * Customize Add to Cart button
 */
function quezon_care_add_to_cart_text($text, $product) {
    if ($product->is_type('simple')) {
        return '<i class="fas fa-shopping-cart mr-2"></i>' . __('Add to Cart', 'quezon-care');
    }
    return $text;
}
add_filter('woocommerce_product_add_to_cart_text', 'quezon_care_add_to_cart_text', 10, 2);

/**
 * Customize cart icon in menu
 */
function quezon_care_add_cart_icon($items, $args) {
    if (!quezon_care_is_woocommerce_active()) {
        return $items;
    }
    
    if ($args->theme_location === 'primary') {
        $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
        $cart_url = wc_get_cart_url();
        
        $cart_icon = '<li class="menu-item cart-icon-wrapper">';
        $cart_icon .= '<a href="' . esc_url($cart_url) . '" class="wc-cart-icon" title="' . esc_attr__('View Cart', 'quezon-care') . '">';
        $cart_icon .= '<i class="fas fa-shopping-cart"></i>';
        if ($cart_count > 0) {
            $cart_icon .= '<span class="wc-cart-count">' . esc_html($cart_count) . '</span>';
        }
        $cart_icon .= '</a>';
        $cart_icon .= '</li>';
        
        $items .= $cart_icon;
    }
    
    return $items;
}
add_filter('wp_nav_menu_items', 'quezon_care_add_cart_icon', 10, 2);

/**
 * Mini cart AJAX update
 */
function quezon_care_cart_fragments($fragments) {
    if (!quezon_care_is_woocommerce_active()) {
        return $fragments;
    }
    
    $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    
    ob_start();
    ?>
    <span class="wc-cart-count"><?php echo esc_html($cart_count); ?></span>
    <?php
    $fragments['.wc-cart-count'] = ob_get_clean();
    
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'quezon_care_cart_fragments');

/**
 * Custom breadcrumbs for WooCommerce
 */
function quezon_care_wc_breadcrumb_defaults($args) {
    return array(
        'delimiter'   => '<span class="mx-2 text-gray-400">/</span>',
        'wrap_before' => '<nav class="woocommerce-breadcrumb flex items-center text-sm text-gray-600 mb-8" data-aos="fade-down">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => __('Home', 'quezon-care'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'quezon_care_wc_breadcrumb_defaults');

/**
 * Create sample care products on theme activation
 */
function quezon_care_create_sample_products() {
    if (!quezon_care_is_woocommerce_active()) {
        return;
    }
    
    // Only run once
    if (get_option('quezon_care_products_created')) {
        return;
    }
    
    $products = array(
        array(
            'name'        => 'Medical Bed Rails',
            'description' => 'Adjustable safety bed rails for elderly patients. Provides security and prevents falls during sleep.',
            'price'       => '2500',
            'category'    => 'Safety Equipment',
            'image'       => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=600',
        ),
        array(
            'name'        => 'Blood Pressure Monitor',
            'description' => 'Digital automatic blood pressure monitor with memory function. Easy to use at home.',
            'price'       => '1800',
            'category'    => 'Monitoring Devices',
            'image'       => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=600',
        ),
        array(
            'name'        => 'Pulse Oximeter',
            'description' => 'Fingertip pulse oximeter for measuring oxygen saturation and pulse rate.',
            'price'       => '800',
            'category'    => 'Monitoring Devices',
            'image'       => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600',
        ),
        array(
            'name'        => 'Walking Cane',
            'description' => 'Adjustable aluminum walking cane with ergonomic grip. Lightweight and sturdy.',
            'price'       => '650',
            'category'    => 'Mobility Aids',
            'image'       => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=600',
        ),
        array(
            'name'        => 'Wheelchair Cushion',
            'description' => 'Premium memory foam wheelchair cushion for maximum comfort and pressure relief.',
            'price'       => '1200',
            'category'    => 'Comfort Items',
            'image'       => 'https://images.unsplash.com/photo-1541435469104-7e7b8d4c8aac?w=600',
        ),
        array(
            'name'        => 'First Aid Kit',
            'description' => 'Complete 120-piece first aid kit for home care. Includes bandages, antiseptics, and more.',
            'price'       => '950',
            'category'    => 'First Aid',
            'image'       => 'https://images.unsplash.com/photo-1603398938378-e54eab446dde?w=600',
        ),
    );
    
    foreach ($products as $product_data) {
        $product = new WC_Product_Simple();
        $product->set_name($product_data['name']);
        $product->set_description($product_data['description']);
        $product->set_short_description(wp_trim_words($product_data['description'], 15));
        $product->set_regular_price($product_data['price']);
        $product->set_status('publish');
        $product->set_catalog_visibility('visible');
        $product->set_stock_status('instock');
        $product->save();
    }
    
    update_option('quezon_care_products_created', true);
}
add_action('init', 'quezon_care_create_sample_products', 20);

/**
 * Add Shop link to nav menu
 */
function quezon_care_add_shop_to_menu($items, $args) {
    if (!quezon_care_is_woocommerce_active()) {
        return $items;
    }
    
    if ($args->theme_location === 'primary') {
        // Find position before Book Consultation
        $shop_url = get_permalink(wc_get_page_id('shop'));
        $shop_item = '<li class="menu-item"><a href="' . esc_url($shop_url) . '">' . __('Shop', 'quezon-care') . '</a></li>';
        
        // Insert shop before the last CTA button
        $items = str_replace('class="menu-item cta-button"', 'class="menu-item shop-link">' . $shop_item . '</li><li class="menu-item cta-button"', $items);
    }
    
    return $items;
}
// add_filter('wp_nav_menu_items', 'quezon_care_add_shop_to_menu', 5, 2);
