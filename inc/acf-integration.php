<?php
/**
 * ACF (Advanced Custom Fields) Integration for Quezon Care Theme
 * 
 * Provides a fallback system that works with or without ACF plugin
 * Demonstrates professional theme development practices
 *
 * @package Quezon_Care
 * @since 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if ACF is active
 */
function quezon_care_is_acf_active() {
    return class_exists('ACF');
}

/**
 * Register ACF Options Pages when ACF Pro is active
 */
function quezon_care_acf_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    
    // Main Theme Options Page
    acf_add_options_page(array(
        'page_title'    => __('Theme Settings', 'quezon-care'),
        'menu_title'    => __('Theme Settings', 'quezon-care'),
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-customizer',
        'position'      => 59,
    ));
    
    // Sub-pages
    acf_add_options_sub_page(array(
        'page_title'    => __('Hero Section', 'quezon-care'),
        'menu_title'    => __('Hero Section', 'quezon-care'),
        'parent_slug'   => 'theme-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => __('Contact Information', 'quezon-care'),
        'menu_title'    => __('Contact Info', 'quezon-care'),
        'parent_slug'   => 'theme-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => __('Social Media', 'quezon-care'),
        'menu_title'    => __('Social Media', 'quezon-care'),
        'parent_slug'   => 'theme-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => __('Footer Settings', 'quezon-care'),
        'menu_title'    => __('Footer', 'quezon-care'),
        'parent_slug'   => 'theme-settings',
    ));
}
add_action('acf/init', 'quezon_care_acf_options_pages');

/**
 * Register ACF Field Groups programmatically
 * This ensures fields are always available even without saving to JSON
 */
function quezon_care_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Hero Section Fields
    acf_add_local_field_group(array(
        'key' => 'group_hero_section',
        'title' => 'Hero Section Settings',
        'fields' => array(
            array(
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Professional Home Care Services',
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Compassionate, licensed nurses and caregivers providing quality home care in Quezon City and Metro Manila.',
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Hero Background Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_cta_text',
                'label' => 'CTA Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'default_value' => 'Book Free Consultation',
            ),
            array(
                'key' => 'field_hero_cta_url',
                'label' => 'CTA Button URL',
                'name' => 'hero_cta_url',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-hero-section',
                ),
            ),
        ),
    ));
    
    // Contact Information Fields
    acf_add_local_field_group(array(
        'key' => 'group_contact_info',
        'title' => 'Contact Information',
        'fields' => array(
            array(
                'key' => 'field_phone',
                'label' => 'Phone Number',
                'name' => 'contact_phone',
                'type' => 'text',
                'default_value' => '+63 (02) 8123-4567',
            ),
            array(
                'key' => 'field_phone_secondary',
                'label' => 'Secondary Phone',
                'name' => 'contact_phone_secondary',
                'type' => 'text',
            ),
            array(
                'key' => 'field_email',
                'label' => 'Email Address',
                'name' => 'contact_email',
                'type' => 'email',
                'default_value' => 'care@quezonhomecare.ph',
            ),
            array(
                'key' => 'field_address',
                'label' => 'Address',
                'name' => 'contact_address',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => '123 Katipunan Ave, Quezon City, Philippines',
            ),
            array(
                'key' => 'field_hours',
                'label' => 'Operating Hours',
                'name' => 'contact_hours',
                'type' => 'text',
                'default_value' => '24/7 Service Available',
            ),
            array(
                'key' => 'field_map_embed',
                'label' => 'Google Maps Embed Code',
                'name' => 'contact_map_embed',
                'type' => 'textarea',
                'rows' => 4,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-contact-info',
                ),
            ),
        ),
    ));
    
    // Social Media Fields
    acf_add_local_field_group(array(
        'key' => 'group_social_media',
        'title' => 'Social Media Links',
        'fields' => array(
            array(
                'key' => 'field_facebook',
                'label' => 'Facebook URL',
                'name' => 'social_facebook',
                'type' => 'url',
            ),
            array(
                'key' => 'field_instagram',
                'label' => 'Instagram URL',
                'name' => 'social_instagram',
                'type' => 'url',
            ),
            array(
                'key' => 'field_twitter',
                'label' => 'Twitter/X URL',
                'name' => 'social_twitter',
                'type' => 'url',
            ),
            array(
                'key' => 'field_linkedin',
                'label' => 'LinkedIn URL',
                'name' => 'social_linkedin',
                'type' => 'url',
            ),
            array(
                'key' => 'field_youtube',
                'label' => 'YouTube URL',
                'name' => 'social_youtube',
                'type' => 'url',
            ),
            array(
                'key' => 'field_tiktok',
                'label' => 'TikTok URL',
                'name' => 'social_tiktok',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-social-media',
                ),
            ),
        ),
    ));
    
    // Footer Settings Fields
    acf_add_local_field_group(array(
        'key' => 'group_footer',
        'title' => 'Footer Settings',
        'fields' => array(
            array(
                'key' => 'field_footer_logo',
                'label' => 'Footer Logo',
                'name' => 'footer_logo',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_footer_tagline',
                'label' => 'Footer Tagline',
                'name' => 'footer_tagline',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Providing compassionate home care services since 2010.',
            ),
            array(
                'key' => 'field_copyright_text',
                'label' => 'Copyright Text',
                'name' => 'footer_copyright',
                'type' => 'text',
                'default_value' => '© 2026 Quezon Home Care. All rights reserved.',
            ),
            array(
                'key' => 'field_footer_cta',
                'label' => 'Footer CTA Text',
                'name' => 'footer_cta',
                'type' => 'text',
                'default_value' => 'Ready to Get Started?',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-footer',
                ),
            ),
        ),
    ));
    
    // Service Custom Fields
    acf_add_local_field_group(array(
        'key' => 'group_service_details',
        'title' => 'Service Details',
        'fields' => array(
            array(
                'key' => 'field_service_icon',
                'label' => 'Icon Class',
                'name' => 'service_icon',
                'type' => 'text',
                'instructions' => 'Font Awesome icon class (e.g., fa-heart)',
                'placeholder' => 'fa-heart',
            ),
            array(
                'key' => 'field_service_price',
                'label' => 'Starting Price',
                'name' => 'service_price',
                'type' => 'number',
                'prepend' => '₱',
                'append' => '/hour',
            ),
            array(
                'key' => 'field_service_features',
                'label' => 'Features',
                'name' => 'service_features',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Feature',
                'sub_fields' => array(
                    array(
                        'key' => 'field_feature_text',
                        'label' => 'Feature',
                        'name' => 'feature_text',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_service_popular',
                'label' => 'Popular Service',
                'name' => 'service_popular',
                'type' => 'true_false',
                'ui' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ),
            ),
        ),
    ));
    
    // Testimonial Custom Fields
    acf_add_local_field_group(array(
        'key' => 'group_testimonial_details',
        'title' => 'Testimonial Details',
        'fields' => array(
            array(
                'key' => 'field_client_relation',
                'label' => 'Relation to Patient',
                'name' => 'client_relation',
                'type' => 'text',
                'placeholder' => 'e.g., Daughter of patient',
            ),
            array(
                'key' => 'field_testimonial_rating',
                'label' => 'Rating',
                'name' => 'testimonial_rating',
                'type' => 'select',
                'choices' => array(
                    5 => '5 Stars',
                    4 => '4 Stars',
                    3 => '3 Stars',
                    2 => '2 Stars',
                    1 => '1 Star',
                ),
                'default_value' => 5,
            ),
            array(
                'key' => 'field_testimonial_service',
                'label' => 'Service Used',
                'name' => 'testimonial_service',
                'type' => 'post_object',
                'post_type' => array('service'),
                'return_format' => 'object',
            ),
            array(
                'key' => 'field_testimonial_featured',
                'label' => 'Featured Testimonial',
                'name' => 'testimonial_featured',
                'type' => 'true_false',
                'ui' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonial',
                ),
            ),
        ),
    ));
    
    // Staff Custom Fields
    acf_add_local_field_group(array(
        'key' => 'group_staff_details',
        'title' => 'Staff Details',
        'fields' => array(
            array(
                'key' => 'field_staff_position',
                'label' => 'Position/Title',
                'name' => 'staff_position',
                'type' => 'text',
                'placeholder' => 'e.g., Senior Nurse',
            ),
            array(
                'key' => 'field_staff_license',
                'label' => 'License Number',
                'name' => 'staff_license_number',
                'type' => 'text',
            ),
            array(
                'key' => 'field_staff_experience',
                'label' => 'Years of Experience',
                'name' => 'staff_years_experience',
                'type' => 'number',
                'append' => 'years',
            ),
            array(
                'key' => 'field_staff_specialties',
                'label' => 'Specialties',
                'name' => 'staff_specialties',
                'type' => 'checkbox',
                'choices' => array(
                    'elderly-care' => 'Elderly Care',
                    'dementia' => 'Dementia/Alzheimer\'s',
                    'post-surgery' => 'Post-Surgery Recovery',
                    'physical-therapy' => 'Physical Therapy',
                    'palliative' => 'Palliative Care',
                    'pediatric' => 'Pediatric Care',
                ),
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_staff_rating',
                'label' => 'Rating',
                'name' => 'staff_rating',
                'type' => 'number',
                'min' => 1,
                'max' => 5,
                'step' => 0.1,
            ),
            array(
                'key' => 'field_staff_reviews',
                'label' => 'Number of Reviews',
                'name' => 'staff_reviews_count',
                'type' => 'number',
            ),
            array(
                'key' => 'field_staff_availability',
                'label' => 'Currently Available',
                'name' => 'staff_available',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'staff',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'quezon_care_register_acf_fields');

/**
 * Helper function to get ACF field with fallback to theme_mod
 */
function quezon_care_get_field($field_name, $post_id = false, $default = '') {
    // If ACF is active, try to get the field
    if (quezon_care_is_acf_active()) {
        if ($post_id === 'option') {
            $value = get_field($field_name, 'option');
        } elseif ($post_id) {
            $value = get_field($field_name, $post_id);
        } else {
            $value = get_field($field_name);
        }
        
        if ($value) {
            return $value;
        }
    }
    
    // Fallback to post meta
    if ($post_id && $post_id !== 'option') {
        $value = get_post_meta($post_id, '_' . $field_name, true);
        if ($value) {
            return $value;
        }
    }
    
    // Fallback to theme mod
    $theme_mod = get_theme_mod('quezon_care_' . $field_name);
    if ($theme_mod) {
        return $theme_mod;
    }
    
    return $default;
}

/**
 * Helper function to get repeater field with fallback
 */
function quezon_care_get_repeater($field_name, $post_id = false) {
    if (quezon_care_is_acf_active() && function_exists('have_rows')) {
        $items = array();
        
        if (have_rows($field_name, $post_id === 'option' ? 'option' : $post_id)) {
            while (have_rows($field_name, $post_id === 'option' ? 'option' : $post_id)) {
                the_row();
                $items[] = get_row();
            }
        }
        
        if (!empty($items)) {
            return $items;
        }
    }
    
    return array();
}

/**
 * Add admin notice if ACF is not installed
 */
function quezon_care_acf_admin_notice() {
    if (quezon_care_is_acf_active()) {
        return;
    }
    
    $screen = get_current_screen();
    if ($screen && $screen->id === 'themes') {
        ?>
        <div class="notice notice-info is-dismissible">
            <p>
                <strong><?php _e('Quezon Home Care Theme:', 'quezon-care'); ?></strong>
                <?php _e('For the best experience, install the free ACF (Advanced Custom Fields) plugin. This enables easy editing of all theme content from the WordPress admin.', 'quezon-care'); ?>
                <a href="<?php echo admin_url('plugin-install.php?s=advanced+custom+fields&tab=search&type=term'); ?>"><?php _e('Install Now', 'quezon-care'); ?></a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'quezon_care_acf_admin_notice');

/**
 * Save ACF JSON to theme folder
 */
function quezon_care_acf_json_save_point($path) {
    return get_template_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'quezon_care_acf_json_save_point');

/**
 * Load ACF JSON from theme folder
 */
function quezon_care_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'quezon_care_acf_json_load_point');
