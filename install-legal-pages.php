<?php
/**
 * Create Privacy Policy and Terms of Service pages
 * Run this script once via: http://quezon-homecare.local/wp-content/themes/quezon-care/install-legal-pages.php
 */

// Load WordPress
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You need admin privileges to run this script.');
}

echo '<h1>Installing Legal Pages...</h1>';

// Privacy Policy page content
$privacy_content = '
<p>This is our Privacy Policy. The complete policy is displayed using the "Privacy Policy" page template.</p>
<p>For questions about our privacy practices, please contact us at privacy@quezonhomecare.ph</p>
';

// Terms of Service page content
$tos_content = '
<p>These are our Terms of Service. The complete terms are displayed using the "Terms of Service" page template.</p>
<p>For questions about our terms, please contact us at legal@quezonhomecare.ph</p>
';

// Check if Privacy Policy page exists
$privacy_page = get_page_by_path('privacy-policy');
if (!$privacy_page) {
    $privacy_id = wp_insert_post(array(
        'post_title'    => 'Privacy Policy',
        'post_name'     => 'privacy-policy',
        'post_content'  => $privacy_content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
    ));
    
    if ($privacy_id && !is_wp_error($privacy_id)) {
        update_post_meta($privacy_id, '_wp_page_template', 'page-privacy-policy.php');
        echo '<p style="color: green;">✓ Privacy Policy page created (ID: ' . $privacy_id . ')</p>';
    } else {
        echo '<p style="color: red;">✗ Failed to create Privacy Policy page</p>';
    }
} else {
    // Update existing page to use the template
    update_post_meta($privacy_page->ID, '_wp_page_template', 'page-privacy-policy.php');
    echo '<p style="color: blue;">→ Privacy Policy page already exists (ID: ' . $privacy_page->ID . '), template updated</p>';
}

// Check if Terms of Service page exists
$tos_page = get_page_by_path('terms-of-service');
if (!$tos_page) {
    $tos_id = wp_insert_post(array(
        'post_title'    => 'Terms of Service',
        'post_name'     => 'terms-of-service',
        'post_content'  => $tos_content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
    ));
    
    if ($tos_id && !is_wp_error($tos_id)) {
        update_post_meta($tos_id, '_wp_page_template', 'page-terms-of-service.php');
        echo '<p style="color: green;">✓ Terms of Service page created (ID: ' . $tos_id . ')</p>';
    } else {
        echo '<p style="color: red;">✗ Failed to create Terms of Service page</p>';
    }
} else {
    // Update existing page to use the template
    update_post_meta($tos_page->ID, '_wp_page_template', 'page-terms-of-service.php');
    echo '<p style="color: blue;">→ Terms of Service page already exists (ID: ' . $tos_page->ID . '), template updated</p>';
}

// Set WordPress Privacy Policy setting
$privacy_page = get_page_by_path('privacy-policy');
if ($privacy_page) {
    update_option('wp_page_for_privacy_policy', $privacy_page->ID);
    echo '<p style="color: green;">✓ WordPress Privacy Policy setting updated</p>';
}

echo '<h2>✅ Legal Pages Setup Complete!</h2>';
echo '<p>You can now visit:</p>';
echo '<ul>';
echo '<li><a href="' . home_url('/privacy-policy/') . '" target="_blank">Privacy Policy</a></li>';
echo '<li><a href="' . home_url('/terms-of-service/') . '" target="_blank">Terms of Service</a></li>';
echo '</ul>';
echo '<p style="margin-top: 20px; color: #666;"><em>You can delete this script after use.</em></p>';
