<?php
/**
 * REST API Integration for Quezon Care Theme
 * 
 * Custom REST API endpoints for services, testimonials, and AJAX filtering
 * Demonstrates advanced WordPress development skills
 *
 * @package Quezon_Care
 * @since 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom REST API routes
 */
function quezon_care_register_rest_routes() {
    $namespace = 'quezon-care/v1';
    
    // Services endpoint
    register_rest_route($namespace, '/services', array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'quezon_care_get_services_api',
        'permission_callback' => '__return_true',
        'args'                => array(
            'category' => array(
                'type'              => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'per_page' => array(
                'type'              => 'integer',
                'default'           => 10,
                'sanitize_callback' => 'absint',
            ),
        ),
    ));
    
    // Single service endpoint
    register_rest_route($namespace, '/services/(?P<id>\d+)', array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'quezon_care_get_single_service_api',
        'permission_callback' => '__return_true',
        'args'                => array(
            'id' => array(
                'type'              => 'integer',
                'required'          => true,
                'sanitize_callback' => 'absint',
            ),
        ),
    ));
    
    // Testimonials endpoint
    register_rest_route($namespace, '/testimonials', array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'quezon_care_get_testimonials_api',
        'permission_callback' => '__return_true',
        'args'                => array(
            'per_page' => array(
                'type'              => 'integer',
                'default'           => 6,
                'sanitize_callback' => 'absint',
            ),
            'rating' => array(
                'type'              => 'integer',
                'sanitize_callback' => 'absint',
            ),
        ),
    ));
    
    // Staff endpoint
    register_rest_route($namespace, '/staff', array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'quezon_care_get_staff_api',
        'permission_callback' => '__return_true',
        'args'                => array(
            'specialty' => array(
                'type'              => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'available' => array(
                'type'              => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ),
        ),
    ));
    
    // Contact form submission endpoint
    register_rest_route($namespace, '/contact', array(
        'methods'             => WP_REST_Server::CREATABLE,
        'callback'            => 'quezon_care_submit_contact_api',
        'permission_callback' => function() {
            return wp_verify_nonce($_SERVER['HTTP_X_WP_NONCE'] ?? '', 'wp_rest');
        },
        'args'                => array(
            'name' => array(
                'type'              => 'string',
                'required'          => true,
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'email' => array(
                'type'              => 'string',
                'required'          => true,
                'sanitize_callback' => 'sanitize_email',
            ),
            'phone' => array(
                'type'              => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'message' => array(
                'type'              => 'string',
                'required'          => true,
                'sanitize_callback' => 'sanitize_textarea_field',
            ),
        ),
    ));
    
    // Pricing calculator endpoint
    register_rest_route($namespace, '/pricing/calculate', array(
        'methods'             => WP_REST_Server::CREATABLE,
        'callback'            => 'quezon_care_calculate_pricing_api',
        'permission_callback' => '__return_true',
        'args'                => array(
            'service' => array(
                'type'              => 'string',
                'required'          => true,
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'hours_per_day' => array(
                'type'              => 'integer',
                'required'          => true,
                'sanitize_callback' => 'absint',
            ),
            'days_per_week' => array(
                'type'              => 'integer',
                'required'          => true,
                'sanitize_callback' => 'absint',
            ),
        ),
    ));
}
add_action('rest_api_init', 'quezon_care_register_rest_routes');

/**
 * Get services API callback
 */
function quezon_care_get_services_api(WP_REST_Request $request) {
    $category = $request->get_param('category');
    $per_page = $request->get_param('per_page');
    
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => $per_page,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    // Filter by category if provided
    if ($category) {
        $args['meta_query'] = array(
            array(
                'key'     => '_service_category',
                'value'   => $category,
                'compare' => 'LIKE',
            ),
        );
    }
    
    $services = new WP_Query($args);
    $data = array();
    
    if ($services->have_posts()) {
        while ($services->have_posts()) {
            $services->the_post();
            $data[] = array(
                'id'          => get_the_ID(),
                'title'       => get_the_title(),
                'slug'        => get_post_field('post_name'),
                'excerpt'     => get_the_excerpt(),
                'content'     => get_the_content(),
                'link'        => get_permalink(),
                'image'       => get_the_post_thumbnail_url(get_the_ID(), 'service-thumbnail'),
                'price'       => get_post_meta(get_the_ID(), '_service_price', true),
                'icon'        => get_post_meta(get_the_ID(), '_service_icon', true),
                'features'    => array_filter(explode("\n", get_post_meta(get_the_ID(), '_service_features', true))),
            );
        }
        wp_reset_postdata();
    }
    
    return new WP_REST_Response(array(
        'success' => true,
        'data'    => $data,
        'total'   => $services->found_posts,
    ), 200);
}

/**
 * Get single service API callback
 */
function quezon_care_get_single_service_api(WP_REST_Request $request) {
    $id = $request->get_param('id');
    $post = get_post($id);
    
    if (!$post || $post->post_type !== 'service') {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => __('Service not found', 'quezon-care'),
        ), 404);
    }
    
    $data = array(
        'id'          => $post->ID,
        'title'       => $post->post_title,
        'slug'        => $post->post_name,
        'excerpt'     => get_the_excerpt($post),
        'content'     => apply_filters('the_content', $post->post_content),
        'link'        => get_permalink($post),
        'image'       => get_the_post_thumbnail_url($post->ID, 'full'),
        'price'       => get_post_meta($post->ID, '_service_price', true),
        'icon'        => get_post_meta($post->ID, '_service_icon', true),
        'features'    => array_filter(explode("\n", get_post_meta($post->ID, '_service_features', true))),
    );
    
    return new WP_REST_Response(array(
        'success' => true,
        'data'    => $data,
    ), 200);
}

/**
 * Get testimonials API callback
 */
function quezon_care_get_testimonials_api(WP_REST_Request $request) {
    $per_page = $request->get_param('per_page');
    $rating = $request->get_param('rating');
    
    $args = array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $per_page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    // Filter by rating if provided
    if ($rating) {
        $args['meta_query'] = array(
            array(
                'key'     => '_testimonial_rating',
                'value'   => $rating,
                'compare' => '>=',
                'type'    => 'NUMERIC',
            ),
        );
    }
    
    $testimonials = new WP_Query($args);
    $data = array();
    
    if ($testimonials->have_posts()) {
        while ($testimonials->have_posts()) {
            $testimonials->the_post();
            $data[] = array(
                'id'         => get_the_ID(),
                'client'     => get_the_title(),
                'content'    => get_the_content(),
                'excerpt'    => get_the_excerpt(),
                'image'      => get_the_post_thumbnail_url(get_the_ID(), 'testimonial-avatar'),
                'rating'     => (int) get_post_meta(get_the_ID(), '_testimonial_rating', true),
                'client_age' => get_post_meta(get_the_ID(), '_client_age', true),
            );
        }
        wp_reset_postdata();
    }
    
    return new WP_REST_Response(array(
        'success' => true,
        'data'    => $data,
        'total'   => $testimonials->found_posts,
    ), 200);
}

/**
 * Get staff API callback
 */
function quezon_care_get_staff_api(WP_REST_Request $request) {
    $specialty = $request->get_param('specialty');
    $available = $request->get_param('available');
    
    $args = array(
        'post_type'      => 'staff',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    
    $meta_query = array();
    
    if ($specialty) {
        $meta_query[] = array(
            'key'     => '_staff_specialties',
            'value'   => $specialty,
            'compare' => 'LIKE',
        );
    }
    
    if ($available) {
        $meta_query[] = array(
            'key'     => '_staff_available',
            'value'   => $available,
            'compare' => '=',
        );
    }
    
    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }
    
    $staff = new WP_Query($args);
    $data = array();
    
    if ($staff->have_posts()) {
        while ($staff->have_posts()) {
            $staff->the_post();
            $data[] = array(
                'id'          => get_the_ID(),
                'name'        => get_the_title(),
                'title'       => get_post_meta(get_the_ID(), '_staff_title', true),
                'bio'         => get_the_content(),
                'image'       => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_post_meta(get_the_ID(), '_staff_image', true),
                'license'     => get_post_meta(get_the_ID(), '_staff_license', true),
                'experience'  => get_post_meta(get_the_ID(), '_staff_experience', true),
                'specialties' => array_map('trim', explode(',', get_post_meta(get_the_ID(), '_staff_specialties', true))),
                'rating'      => (float) get_post_meta(get_the_ID(), '_staff_rating', true),
                'reviews'     => (int) get_post_meta(get_the_ID(), '_staff_reviews', true),
                'available'   => get_post_meta(get_the_ID(), '_staff_available', true) === 'yes',
            );
        }
        wp_reset_postdata();
    }
    
    return new WP_REST_Response(array(
        'success' => true,
        'data'    => $data,
        'total'   => $staff->found_posts,
    ), 200);
}

/**
 * Submit contact form API callback
 */
function quezon_care_submit_contact_api(WP_REST_Request $request) {
    $name = $request->get_param('name');
    $email = $request->get_param('email');
    $phone = $request->get_param('phone');
    $message = $request->get_param('message');
    
    // Validate email
    if (!is_email($email)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => __('Invalid email address', 'quezon-care'),
        ), 400);
    }
    
    // Save as custom post type or send email
    $admin_email = get_option('admin_email');
    $subject = sprintf(__('New Contact from %s - Quezon Home Care', 'quezon-care'), $name);
    $body = sprintf(
        "Name: %s\nEmail: %s\nPhone: %s\n\nMessage:\n%s",
        $name,
        $email,
        $phone,
        $message
    );
    
    $sent = wp_mail($admin_email, $subject, $body);
    
    if ($sent) {
        return new WP_REST_Response(array(
            'success' => true,
            'message' => __('Thank you! We will contact you soon.', 'quezon-care'),
        ), 200);
    }
    
    return new WP_REST_Response(array(
        'success' => false,
        'message' => __('Failed to send message. Please try again.', 'quezon-care'),
    ), 500);
}

/**
 * Calculate pricing API callback
 */
function quezon_care_calculate_pricing_api(WP_REST_Request $request) {
    $service = $request->get_param('service');
    $hours_per_day = $request->get_param('hours_per_day');
    $days_per_week = $request->get_param('days_per_week');
    
    // Base rates per hour (in PHP peso)
    $rates = array(
        'nursing-care'       => 350,
        'elderly-companion'  => 250,
        'post-surgery'       => 400,
        'dementia-care'      => 450,
        'physical-therapy'   => 500,
        'palliative-care'    => 400,
    );
    
    $base_rate = isset($rates[$service]) ? $rates[$service] : 300;
    
    // Calculate costs
    $daily_cost = $base_rate * $hours_per_day;
    $weekly_cost = $daily_cost * $days_per_week;
    $monthly_cost = $weekly_cost * 4;
    
    // Apply discounts for longer commitments
    $discount_percent = 0;
    if ($hours_per_day >= 12) {
        $discount_percent = 15; // 15% for 12+ hours
    } elseif ($hours_per_day >= 8) {
        $discount_percent = 10; // 10% for 8+ hours
    }
    
    $discount_amount = ($monthly_cost * $discount_percent) / 100;
    $final_monthly = $monthly_cost - $discount_amount;
    
    return new WP_REST_Response(array(
        'success' => true,
        'data'    => array(
            'service'          => $service,
            'base_rate'        => $base_rate,
            'hours_per_day'    => $hours_per_day,
            'days_per_week'    => $days_per_week,
            'daily_cost'       => $daily_cost,
            'weekly_cost'      => $weekly_cost,
            'monthly_cost'     => $monthly_cost,
            'discount_percent' => $discount_percent,
            'discount_amount'  => $discount_amount,
            'final_monthly'    => $final_monthly,
            'currency'         => 'PHP',
            'formatted'        => array(
                'daily'   => '₱' . number_format($daily_cost),
                'weekly'  => '₱' . number_format($weekly_cost),
                'monthly' => '₱' . number_format($final_monthly),
            ),
        ),
    ), 200);
}

/**
 * Add AJAX handlers for frontend filtering
 */
function quezon_care_ajax_filter_services() {
    check_ajax_referer('quezon-care-nonce', 'nonce');
    
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    if ($search) {
        $args['s'] = $search;
    }
    
    $services = new WP_Query($args);
    $html = '';
    
    if ($services->have_posts()) {
        while ($services->have_posts()) {
            $services->the_post();
            
            $icon = get_post_meta(get_the_ID(), '_service_icon', true);
            $price = get_post_meta(get_the_ID(), '_service_price', true);
            
            $html .= '<div class="service-card glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-8 shadow-xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up">';
            $html .= '<div class="service-icon w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-teal-400 flex items-center justify-center text-white text-2xl mb-6"><i class="fas ' . esc_attr($icon ?: 'fa-heart') . '"></i></div>';
            $html .= '<h3 class="text-xl font-bold text-gray-900 mb-3">' . get_the_title() . '</h3>';
            $html .= '<p class="text-gray-600 mb-4">' . get_the_excerpt() . '</p>';
            if ($price) {
                $html .= '<p class="text-blue-600 font-semibold">Starting at ₱' . esc_html($price) . '/hr</p>';
            }
            $html .= '<a href="' . get_permalink() . '" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700 font-medium">' . __('Learn More', 'quezon-care') . ' <i class="fas fa-arrow-right ml-2"></i></a>';
            $html .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $html = '<div class="col-span-full text-center py-12"><p class="text-gray-500 text-lg">' . __('No services found matching your criteria.', 'quezon-care') . '</p></div>';
    }
    
    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_filter_services', 'quezon_care_ajax_filter_services');
add_action('wp_ajax_nopriv_filter_services', 'quezon_care_ajax_filter_services');

/**
 * AJAX handler for staff filtering
 */
function quezon_care_ajax_filter_staff() {
    check_ajax_referer('quezon-care-nonce', 'nonce');
    
    $specialty = isset($_POST['specialty']) ? sanitize_text_field($_POST['specialty']) : '';
    $available = isset($_POST['available']) ? sanitize_text_field($_POST['available']) : '';
    
    $args = array(
        'post_type'      => 'staff',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    
    $meta_query = array();
    
    if ($specialty) {
        $meta_query[] = array(
            'key'     => '_staff_specialties',
            'value'   => $specialty,
            'compare' => 'LIKE',
        );
    }
    
    if ($available === 'yes') {
        $meta_query[] = array(
            'key'     => '_staff_available',
            'value'   => 'yes',
            'compare' => '=',
        );
    }
    
    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }
    
    $staff = new WP_Query($args);
    $html = '';
    
    if ($staff->have_posts()) {
        while ($staff->have_posts()) {
            $staff->the_post();
            
            $title = get_post_meta(get_the_ID(), '_staff_title', true);
            $rating = get_post_meta(get_the_ID(), '_staff_rating', true);
            $image = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_post_meta(get_the_ID(), '_staff_image', true);
            $is_available = get_post_meta(get_the_ID(), '_staff_available', true) === 'yes';
            
            $html .= '<div class="staff-card glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl overflow-hidden shadow-xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up">';
            $html .= '<div class="relative">';
            $html .= '<img src="' . esc_url($image ?: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400') . '" alt="' . esc_attr(get_the_title()) . '" class="w-full h-64 object-cover">';
            if ($is_available) {
                $html .= '<span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">' . __('Available', 'quezon-care') . '</span>';
            }
            $html .= '</div>';
            $html .= '<div class="p-6">';
            $html .= '<h3 class="text-xl font-bold text-gray-900 mb-1">' . get_the_title() . '</h3>';
            $html .= '<p class="text-blue-600 font-medium mb-2">' . esc_html($title) . '</p>';
            if ($rating) {
                $html .= '<div class="flex items-center gap-1 text-yellow-400 mb-3">';
                for ($i = 1; $i <= 5; $i++) {
                    $html .= '<i class="fas fa-star' . ($i <= $rating ? '' : '-o') . '"></i>';
                }
                $html .= '<span class="text-gray-600 text-sm ml-2">(' . $rating . ')</span>';
                $html .= '</div>';
            }
            $html .= '<a href="' . get_permalink() . '" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">' . __('View Profile', 'quezon-care') . ' <i class="fas fa-arrow-right ml-2"></i></a>';
            $html .= '</div>';
            $html .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $html = '<div class="col-span-full text-center py-12"><p class="text-gray-500 text-lg">' . __('No staff found matching your criteria.', 'quezon-care') . '</p></div>';
    }
    
    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_filter_staff', 'quezon_care_ajax_filter_staff');
add_action('wp_ajax_nopriv_filter_staff', 'quezon_care_ajax_filter_staff');

/**
 * Enqueue REST API scripts for frontend
 */
function quezon_care_rest_api_scripts() {
    wp_localize_script('quezon-care-main', 'quezonCareAPI', array(
        'root'  => esc_url_raw(rest_url('quezon-care/v1/')),
        'nonce' => wp_create_nonce('wp_rest'),
    ));
}
add_action('wp_enqueue_scripts', 'quezon_care_rest_api_scripts', 20);
