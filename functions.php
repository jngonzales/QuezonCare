<?php
/**
 * Quezon Care Theme Functions
 *
 * @package Quezon_Care
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define theme constants
 */
define('QUEZON_CARE_VERSION', '1.0.0');
define('QUEZON_CARE_DIR', get_template_directory());
define('QUEZON_CARE_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function quezon_care_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add image sizes
    add_image_size('service-thumbnail', 600, 400, true);
    add_image_size('hero-image', 1200, 800, true);
    add_image_size('testimonial-avatar', 100, 100, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'quezon-care'),
        'footer'    => __('Footer Menu', 'quezon-care'),
    ));
}
add_action('after_setup_theme', 'quezon_care_setup');

/**
 * Enqueue Scripts and Styles
 */
function quezon_care_scripts() {
    // Note: Tailwind CSS CDN is loaded directly in header.php before config
    // to avoid "tailwind is not defined" error
    
    // Google Fonts - Inter (agency perfect) + Poppins
    wp_enqueue_style(
        'quezon-care-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );
    
    // Theme stylesheet
    wp_enqueue_style(
        'quezon-care-style',
        get_stylesheet_uri(),
        array(),
        QUEZON_CARE_VERSION
    );
    
    // Custom CSS
    wp_enqueue_style(
        'quezon-care-custom',
        QUEZON_CARE_URI . '/assets/css/custom.css',
        array('quezon-care-style'),
        QUEZON_CARE_VERSION
    );
    
    // Main JavaScript
    wp_enqueue_script(
        'quezon-care-main',
        QUEZON_CARE_URI . '/assets/js/main.js',
        array('jquery'),
        QUEZON_CARE_VERSION,
        true
    );
    
    // Smooth Animations JS (inline - zero HTTP requests)
    wp_add_inline_script('quezon-care-main', '
        // SMOOTH SCROLL (all anchor links)
        document.querySelectorAll(\'a[href^="#"]\').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                const targetId = this.getAttribute("href");
                if (targetId !== "#" && document.querySelector(targetId)) {
                    e.preventDefault();
                    document.querySelector(targetId).scrollIntoView({ behavior: "smooth" });
                }
            });
        });
        
        // INTERSECTION OBSERVER (fade-in stagger)
        const animateObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add("animate-fadeInUp");
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                    }, index * 100);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });
        
        document.querySelectorAll(".shadcn-animate").forEach(el => animateObserver.observe(el));
        
        // Add stagger effect to card grids
        document.querySelectorAll(".shadcn-card").forEach((card, index) => {
            card.style.transitionDelay = (index * 0.1) + "s";
            animateObserver.observe(card);
        });
    ');
    
    // Localize script for AJAX
    wp_localize_script('quezon-care-main', 'quezonCare', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('quezon-care-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'quezon_care_scripts');

/**
 * Register Custom Post Type: Services
 */
function quezon_care_register_services_cpt() {
    $labels = array(
        'name'                  => _x('Services', 'Post Type General Name', 'quezon-care'),
        'singular_name'         => _x('Service', 'Post Type Singular Name', 'quezon-care'),
        'menu_name'             => __('Services', 'quezon-care'),
        'name_admin_bar'        => __('Service', 'quezon-care'),
        'archives'              => __('Service Archives', 'quezon-care'),
        'attributes'            => __('Service Attributes', 'quezon-care'),
        'parent_item_colon'     => __('Parent Service:', 'quezon-care'),
        'all_items'             => __('All Services', 'quezon-care'),
        'add_new_item'          => __('Add New Service', 'quezon-care'),
        'add_new'               => __('Add New', 'quezon-care'),
        'new_item'              => __('New Service', 'quezon-care'),
        'edit_item'             => __('Edit Service', 'quezon-care'),
        'update_item'           => __('Update Service', 'quezon-care'),
        'view_item'             => __('View Service', 'quezon-care'),
        'view_items'            => __('View Services', 'quezon-care'),
        'search_items'          => __('Search Service', 'quezon-care'),
        'not_found'             => __('Not found', 'quezon-care'),
        'not_found_in_trash'    => __('Not found in Trash', 'quezon-care'),
        'featured_image'        => __('Service Image', 'quezon-care'),
        'set_featured_image'    => __('Set service image', 'quezon-care'),
        'remove_featured_image' => __('Remove service image', 'quezon-care'),
        'use_featured_image'    => __('Use as service image', 'quezon-care'),
    );
    
    $args = array(
        'label'                 => __('Service', 'quezon-care'),
        'description'           => __('Home care services', 'quezon-care'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-heart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'services',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'services'),
    );
    
    register_post_type('service', $args);
}
add_action('init', 'quezon_care_register_services_cpt');

/**
 * Register Custom Post Type: Testimonials
 */
function quezon_care_register_testimonials_cpt() {
    $labels = array(
        'name'                  => _x('Testimonials', 'Post Type General Name', 'quezon-care'),
        'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'quezon-care'),
        'menu_name'             => __('Testimonials', 'quezon-care'),
        'all_items'             => __('All Testimonials', 'quezon-care'),
        'add_new_item'          => __('Add New Testimonial', 'quezon-care'),
        'add_new'               => __('Add New', 'quezon-care'),
        'edit_item'             => __('Edit Testimonial', 'quezon-care'),
    );
    
    $args = array(
        'label'                 => __('Testimonial', 'quezon-care'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-format-quote',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('testimonial', $args);
}
add_action('init', 'quezon_care_register_testimonials_cpt');

/**
 * Register Custom Post Type: Staff (Nurses/Caregivers)
 */
function quezon_care_register_staff_cpt() {
    $labels = array(
        'name'                  => _x('Staff', 'Post Type General Name', 'quezon-care'),
        'singular_name'         => _x('Staff Member', 'Post Type Singular Name', 'quezon-care'),
        'menu_name'             => __('Staff', 'quezon-care'),
        'all_items'             => __('All Staff', 'quezon-care'),
        'add_new_item'          => __('Add New Staff Member', 'quezon-care'),
        'add_new'               => __('Add New', 'quezon-care'),
        'edit_item'             => __('Edit Staff Member', 'quezon-care'),
        'view_item'             => __('View Staff Member', 'quezon-care'),
        'search_items'          => __('Search Staff', 'quezon-care'),
        'not_found'             => __('No staff found', 'quezon-care'),
    );
    
    $args = array(
        'label'                 => __('Staff', 'quezon-care'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'our-team',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'team'),
    );
    
    register_post_type('staff', $args);
}
add_action('init', 'quezon_care_register_staff_cpt');

/**
 * Add Staff Meta Boxes
 */
function quezon_care_add_staff_meta_boxes() {
    add_meta_box(
        'staff_details',
        __('Staff Details', 'quezon-care'),
        'quezon_care_staff_meta_box_callback',
        'staff',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'quezon_care_add_staff_meta_boxes');

/**
 * Staff Meta Box Callback
 */
function quezon_care_staff_meta_box_callback($post) {
    wp_nonce_field('quezon_care_staff_meta_box', 'quezon_care_staff_meta_box_nonce');
    
    $title = get_post_meta($post->ID, '_staff_title', true);
    $license = get_post_meta($post->ID, '_staff_license', true);
    $experience = get_post_meta($post->ID, '_staff_experience', true);
    $specialties = get_post_meta($post->ID, '_staff_specialties', true);
    $image = get_post_meta($post->ID, '_staff_image', true);
    $rating = get_post_meta($post->ID, '_staff_rating', true);
    $reviews = get_post_meta($post->ID, '_staff_reviews', true);
    $available = get_post_meta($post->ID, '_staff_available', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="staff_title"><?php _e('Job Title', 'quezon-care'); ?></label></th>
            <td><input type="text" id="staff_title" name="staff_title" value="<?php echo esc_attr($title); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="staff_license"><?php _e('License Number', 'quezon-care'); ?></label></th>
            <td><input type="text" id="staff_license" name="staff_license" value="<?php echo esc_attr($license); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="staff_experience"><?php _e('Experience', 'quezon-care'); ?></label></th>
            <td><input type="text" id="staff_experience" name="staff_experience" value="<?php echo esc_attr($experience); ?>" class="regular-text" placeholder="e.g., 10 years"></td>
        </tr>
        <tr>
            <th><label for="staff_specialties"><?php _e('Specialties', 'quezon-care'); ?></label></th>
            <td><input type="text" id="staff_specialties" name="staff_specialties" value="<?php echo esc_attr($specialties); ?>" class="regular-text" placeholder="e.g., Elderly Care, Post-Surgery"></td>
        </tr>
        <tr>
            <th><label for="staff_image"><?php _e('Profile Image URL', 'quezon-care'); ?></label></th>
            <td><input type="url" id="staff_image" name="staff_image" value="<?php echo esc_url($image); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="staff_rating"><?php _e('Rating (1-5)', 'quezon-care'); ?></label></th>
            <td><input type="number" id="staff_rating" name="staff_rating" value="<?php echo esc_attr($rating); ?>" step="0.1" min="1" max="5" style="width: 80px;"></td>
        </tr>
        <tr>
            <th><label for="staff_reviews"><?php _e('Number of Reviews', 'quezon-care'); ?></label></th>
            <td><input type="number" id="staff_reviews" name="staff_reviews" value="<?php echo esc_attr($reviews); ?>" min="0" style="width: 80px;"></td>
        </tr>
        <tr>
            <th><label for="staff_available"><?php _e('Currently Available', 'quezon-care'); ?></label></th>
            <td>
                <select id="staff_available" name="staff_available">
                    <option value="yes" <?php selected($available, 'yes'); ?>><?php _e('Yes', 'quezon-care'); ?></option>
                    <option value="no" <?php selected($available, 'no'); ?>><?php _e('No', 'quezon-care'); ?></option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Staff Meta Box Data
 */
function quezon_care_save_staff_meta_box($post_id) {
    if (!isset($_POST['quezon_care_staff_meta_box_nonce'])) return;
    if (!wp_verify_nonce($_POST['quezon_care_staff_meta_box_nonce'], 'quezon_care_staff_meta_box')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    $fields = array('staff_title', 'staff_license', 'staff_experience', 'staff_specialties', 'staff_image', 'staff_rating', 'staff_reviews', 'staff_available');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_staff', 'quezon_care_save_staff_meta_box');

/**
 * Register Widget Areas
 */
function quezon_care_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'quezon-care'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here.', 'quezon-care'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'quezon-care'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here.', 'quezon-care'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Sidebar', 'quezon-care'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'quezon-care'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'quezon_care_widgets_init');

/**
 * Add Service Meta Boxes
 */
function quezon_care_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __('Service Details', 'quezon-care'),
        'quezon_care_service_meta_box_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'quezon_care_add_service_meta_boxes');

/**
 * Service Meta Box Callback
 */
function quezon_care_service_meta_box_callback($post) {
    wp_nonce_field('quezon_care_service_meta', 'quezon_care_service_meta_nonce');
    
    $price = get_post_meta($post->ID, '_service_price', true);
    $icon = get_post_meta($post->ID, '_service_icon', true);
    $features = get_post_meta($post->ID, '_service_features', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="service_price"><?php _e('Starting Price (₱/hour)', 'quezon-care'); ?></label></th>
            <td>
                <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="service_icon"><?php _e('Font Awesome Icon Class', 'quezon-care'); ?></label></th>
            <td>
                <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="regular-text" placeholder="e.g., fa-stethoscope">
                <p class="description"><?php _e('Enter Font Awesome icon class (e.g., fa-stethoscope, fa-users, fa-heart, fa-brain)', 'quezon-care'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="service_features"><?php _e('Features (one per line)', 'quezon-care'); ?></label></th>
            <td>
                <textarea id="service_features" name="service_features" rows="5" class="large-text"><?php echo esc_textarea($features); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Service Meta
 */
function quezon_care_save_service_meta($post_id) {
    if (!isset($_POST['quezon_care_service_meta_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['quezon_care_service_meta_nonce'], 'quezon_care_service_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['service_price'])) {
        update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
    }
    
    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
    
    if (isset($_POST['service_features'])) {
        update_post_meta($post_id, '_service_features', sanitize_textarea_field($_POST['service_features']));
    }
}
add_action('save_post_service', 'quezon_care_save_service_meta');

/**
 * Add Testimonial Meta Boxes
 */
function quezon_care_add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'quezon-care'),
        'quezon_care_testimonial_meta_box_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'quezon_care_add_testimonial_meta_boxes');

/**
 * Testimonial Meta Box Callback
 */
function quezon_care_testimonial_meta_box_callback($post) {
    wp_nonce_field('quezon_care_testimonial_meta', 'quezon_care_testimonial_meta_nonce');
    
    $client_age = get_post_meta($post->ID, '_client_age', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="client_age"><?php _e('Client Age', 'quezon-care'); ?></label></th>
            <td>
                <input type="number" id="client_age" name="client_age" value="<?php echo esc_attr($client_age); ?>" class="small-text">
            </td>
        </tr>
        <tr>
            <th><label for="testimonial_rating"><?php _e('Rating (1-5)', 'quezon-care'); ?></label></th>
            <td>
                <select id="testimonial_rating" name="testimonial_rating">
                    <?php for ($i = 5; $i >= 1; $i--) : ?>
                        <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?> Stars</option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Testimonial Meta
 */
function quezon_care_save_testimonial_meta($post_id) {
    if (!isset($_POST['quezon_care_testimonial_meta_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['quezon_care_testimonial_meta_nonce'], 'quezon_care_testimonial_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['client_age'])) {
        update_post_meta($post_id, '_client_age', absint($_POST['client_age']));
    }
    
    if (isset($_POST['testimonial_rating'])) {
        update_post_meta($post_id, '_testimonial_rating', absint($_POST['testimonial_rating']));
    }
}
add_action('save_post_testimonial', 'quezon_care_save_testimonial_meta');

/**
 * Get Services for Display
 */
function quezon_care_get_services($count = -1) {
    return new WP_Query(array(
        'post_type'      => 'service',
        'posts_per_page' => $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
}

/**
 * Get Testimonials for Display
 */
function quezon_care_get_testimonials($count = 3) {
    return new WP_Query(array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}

/**
 * Custom Walker for Primary Navigation
 */
class Quezon_Care_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= '<li' . $class_names . '>';
        
        $atts = array(
            'title'  => !empty($item->attr_title) ? $item->attr_title : '',
            'target' => !empty($item->target) ? $item->target : '',
            'rel'    => !empty($item->xfn) ? $item->xfn : '',
            'href'   => !empty($item->url) ? $item->url : '',
        );
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Customizer Settings
 */
function quezon_care_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('quezon_care_contact', array(
        'title'    => __('Contact Information', 'quezon-care'),
        'priority' => 30,
    ));
    
    // Phone Number
    $wp_customize->add_setting('quezon_care_phone', array(
        'default'           => '+63 (02) 8123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('quezon_care_phone', array(
        'label'   => __('Phone Number', 'quezon-care'),
        'section' => 'quezon_care_contact',
        'type'    => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('quezon_care_email', array(
        'default'           => 'care@quezonhomecare.ph',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('quezon_care_email', array(
        'label'   => __('Email Address', 'quezon-care'),
        'section' => 'quezon_care_contact',
        'type'    => 'email',
    ));
    
    // Address
    $wp_customize->add_setting('quezon_care_address', array(
        'default'           => '123 Katipunan Ave, Quezon City, Philippines',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('quezon_care_address', array(
        'label'   => __('Address', 'quezon-care'),
        'section' => 'quezon_care_contact',
        'type'    => 'textarea',
    ));
    
    // Operating Hours
    $wp_customize->add_setting('quezon_care_hours', array(
        'default'           => '24/7 Service Available',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('quezon_care_hours', array(
        'label'   => __('Operating Hours', 'quezon-care'),
        'section' => 'quezon_care_contact',
        'type'    => 'text',
    ));
    
    // Social Media Section
    $wp_customize->add_section('quezon_care_social', array(
        'title'    => __('Social Media', 'quezon-care'),
        'priority' => 35,
    ));
    
    $social_networks = array('facebook', 'instagram', 'twitter', 'linkedin');
    
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('quezon_care_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('quezon_care_' . $network, array(
            'label'   => ucfirst($network) . ' URL',
            'section' => 'quezon_care_social',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'quezon_care_customize_register');

/**
 * Get Theme Mod with Default
 */
function quezon_care_get_option($option, $default = '') {
    return get_theme_mod('quezon_care_' . $option, $default);
}

/**
 * Excerpt Length
 */
function quezon_care_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'quezon_care_excerpt_length');

/**
 * Excerpt More
 */
function quezon_care_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'quezon_care_excerpt_more');

/**
 * Add body classes
 */
function quezon_care_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    if (is_singular('service')) {
        $classes[] = 'single-service-page';
    }
    
    return $classes;
}
add_filter('body_class', 'quezon_care_body_classes');

/**
 * Calculate reading time for blog posts
 */
function quezon_care_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 words per minute
    return max(1, $reading_time);
}

/**
 * Flush rewrite rules on theme activation
 */
function quezon_care_rewrite_flush() {
    quezon_care_register_services_cpt();
    quezon_care_register_testimonials_cpt();
    quezon_care_register_staff_cpt();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'quezon_care_rewrite_flush');
