<?php
/**
 * Quezon Home Care - Page Setup Script
 * Upload this to your WordPress root and visit it once
 * Then DELETE this file!
 */

require_once('wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You must be an admin to run this script.');
}

echo "<h1>Creating Quezon Home Care Pages...</h1>";

// Pages to create with their templates
$pages = [
    ['title' => 'Home', 'slug' => 'home', 'template' => 'front-page.php'],
    ['title' => 'About Us', 'slug' => 'about', 'template' => 'page-about.php'],
    ['title' => 'Services', 'slug' => 'services', 'template' => 'archive-service.php'],
    ['title' => 'Pricing', 'slug' => 'pricing', 'template' => 'page-pricing.php'],
    ['title' => 'Book Consultation', 'slug' => 'booking', 'template' => 'page-booking.php'],
    ['title' => 'Contact', 'slug' => 'contact', 'template' => 'page-contact.php'],
    ['title' => 'Our Team', 'slug' => 'our-team', 'template' => 'page-staff.php'],
    ['title' => 'Blog', 'slug' => 'blog', 'template' => 'page-blog.php'],
    ['title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'template' => 'page-privacy-policy.php'],
    ['title' => 'Terms of Service', 'slug' => 'terms-of-service', 'template' => 'page-terms-of-service.php'],
];

$home_page_id = 0;
$blog_page_id = 0;

foreach ($pages as $page) {
    // Check if page exists
    $existing = get_page_by_path($page['slug']);
    
    if ($existing) {
        echo "<p>Page '{$page['title']}' already exists (ID: {$existing->ID})</p>";
        if ($page['slug'] === 'home') $home_page_id = $existing->ID;
        if ($page['slug'] === 'blog') $blog_page_id = $existing->ID;
        continue;
    }
    
    // Create the page
    $page_id = wp_insert_post([
        'post_title'    => $page['title'],
        'post_name'     => $page['slug'],
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_content'  => '',
    ]);
    
    if ($page_id) {
        // Set page template
        update_post_meta($page_id, '_wp_page_template', $page['template']);
        echo "<p style='color:green;'>✅ Created: {$page['title']} (ID: {$page_id})</p>";
        
        if ($page['slug'] === 'home') $home_page_id = $page_id;
        if ($page['slug'] === 'blog') $blog_page_id = $page_id;
    } else {
        echo "<p style='color:red;'>❌ Failed to create: {$page['title']}</p>";
    }
}

// Set homepage settings
if ($home_page_id) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_page_id);
    echo "<p style='color:blue;'>📌 Set '{$home_page_id}' as homepage</p>";
}

if ($blog_page_id) {
    update_option('page_for_posts', $blog_page_id);
    echo "<p style='color:blue;'>📌 Set '{$blog_page_id}' as blog page</p>";
}

// Create menu
echo "<h2>Creating Navigation Menu...</h2>";

$menu_name = 'Primary Menu';
$menu_exists = wp_get_nav_menu_object($menu_name);

if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($menu_name);
    
    // Add pages to menu
    $menu_pages = ['Home', 'About Us', 'Services', 'Pricing', 'Book Consultation', 'Our Team', 'Blog', 'Contact'];
    
    foreach ($menu_pages as $order => $page_title) {
        $page = get_page_by_title($page_title);
        if ($page) {
            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title'     => $page_title === 'About Us' ? 'About' : $page_title,
                'menu-item-object-id' => $page->ID,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $order + 1,
            ]);
        }
    }
    
    // Assign menu to location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
    
    echo "<p style='color:green;'>✅ Created and assigned Primary Menu</p>";
} else {
    echo "<p>Menu already exists</p>";
}

echo "<h2 style='color:green;'>✅ Setup Complete!</h2>";
echo "<p><strong>IMPORTANT: Delete this file now!</strong></p>";
echo "<p><a href='" . home_url() . "'>View your site</a></p>";
echo "<p><a href='" . admin_url() . "'>Go to admin</a></p>";
