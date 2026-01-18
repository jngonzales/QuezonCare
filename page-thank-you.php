<?php
/**
 * Template Name: Thank You Page
 * Template Post Type: page
 *
 * Thank you page after form submission
 *
 * @package Quezon_Care
 */

get_header();

$phone = '+63 (02) 8123-4567';
if (function_exists('quezon_care_get_option')) {
    $phone = quezon_care_get_option('phone', $phone);
}
?>

<!-- Thank You Section -->
<section class="thank-you-section section" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="thank-you-content">
            <div class="thank-you-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h1><?php esc_html_e('Thank You!', 'quezon-care'); ?></h1>
            <p><?php esc_html_e('Your consultation request has been submitted successfully. Our care coordinator will contact you within 24 hours to discuss your needs and create a personalized care plan.', 'quezon-care'); ?></p>
            
            <div class="next-steps">
                <h3><?php esc_html_e('What Happens Next?', 'quezon-care'); ?></h3>
                <ol>
                    <li><?php esc_html_e('A confirmation email has been sent to your inbox', 'quezon-care'); ?></li>
                    <li><?php esc_html_e('Our care coordinator will call you within 24 hours', 'quezon-care'); ?></li>
                    <li><?php esc_html_e('We\'ll schedule a free in-home assessment', 'quezon-care'); ?></li>
                    <li><?php esc_html_e('You\'ll receive a personalized care plan', 'quezon-care'); ?></li>
                </ol>
            </div>
            
            <p><?php esc_html_e('Need immediate assistance?', 'quezon-care'); ?></p>
            
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn btn-primary">
                    <i class="fas fa-phone-alt"></i>
                    <?php esc_html_e('Call Us Now', 'quezon-care'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-outline">
                    <i class="fas fa-home"></i>
                    <?php esc_html_e('Return to Homepage', 'quezon-care'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
