<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * Contact page template with form and map
 *
 * @package Quezon_Care
 */

/**
 * Display contact form
 */
if (!function_exists('quezon_care_display_contact_form')) {
    function quezon_care_display_contact_form() {
        ?>
        <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <input type="hidden" name="action" value="quezon_care_contact">
            <?php wp_nonce_field('quezon_care_contact_nonce', 'contact_nonce'); ?>
            
            <div class="form-group">
                <label for="contact_name"><?php esc_html_e('Your Name', 'quezon-care'); ?> <span class="required">*</span></label>
                <input type="text" id="contact_name" name="contact_name" placeholder="Your Name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
            </div>
            
            <div class="form-group">
                <label for="contact_email"><?php esc_html_e('Email Address', 'quezon-care'); ?> <span class="required">*</span></label>
                <input type="email" id="contact_email" name="contact_email" placeholder="your@email.com" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
            </div>
            
            <div class="form-group">
                <label for="contact_subject"><?php esc_html_e('Subject', 'quezon-care'); ?></label>
                <input type="text" id="contact_subject" name="contact_subject" placeholder="How can we help?" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
            </div>
            
            <div class="form-group">
                <label for="contact_message"><?php esc_html_e('Message', 'quezon-care'); ?> <span class="required">*</span></label>
                <textarea id="contact_message" name="contact_message" rows="5" placeholder="Tell us about your needs..." required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"></textarea>
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold py-4 px-8 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-paper-plane mr-2"></i>
                <?php esc_html_e('Send Message', 'quezon-care'); ?>
            </button>
        </form>
        <?php
    }
}

get_header();

// Get options safely with fallbacks
$phone = '+63 (02) 8123-4567';
$email = 'care@quezonhomecare.ph';
$address = '123 Katipunan Ave, Quezon City, Philippines';
$hours = '24/7 Service Available';

if (function_exists('quezon_care_get_option')) {
    $phone = quezon_care_get_option('phone', $phone);
    $email = quezon_care_get_option('email', $email);
    $address = quezon_care_get_option('address', $address);
    $hours = quezon_care_get_option('hours', $hours);
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><?php esc_html_e('Contact Us', 'quezon-care'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php esc_html_e('Contact', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="contact-section section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Information -->
            <div class="contact-info">
                <h2><?php esc_html_e('Get In Touch', 'quezon-care'); ?></h2>
                <p><?php esc_html_e('We\'re here to help and answer any questions you might have. Reach out to us and we\'ll respond as soon as we can.', 'quezon-care'); ?></p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('Phone', 'quezon-care'); ?></h4>
                            <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('Email', 'quezon-care'); ?></h4>
                            <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('Address', 'quezon-care'); ?></h4>
                            <p><?php echo esc_html($address); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('Hours', 'quezon-care'); ?></h4>
                            <p><?php echo esc_html($hours); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Links -->
                <div style="margin-top: 2rem;">
                    <h4 style="margin-bottom: 1rem;"><?php esc_html_e('Follow Us', 'quezon-care'); ?></h4>
                    <div class="footer-social">
                        <?php
                        $social_links = array(
                            'facebook'  => 'fab fa-facebook-f',
                            'instagram' => 'fab fa-instagram',
                            'twitter'   => 'fab fa-twitter',
                            'linkedin'  => 'fab fa-linkedin-in',
                        );
                        
                        foreach ($social_links as $network => $icon) :
                            $url = function_exists('quezon_care_get_option') ? quezon_care_get_option($network) : '';
                            if ($url) :
                                ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                </a>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form / Map -->
            <div class="contact-form-area">
                <div class="booking-form-wrapper">
                    <h3><?php esc_html_e('Send Us a Message', 'quezon-care'); ?></h3>
                    <p><?php esc_html_e('Have a question? Fill out the form below and we\'ll get back to you within 24 hours.', 'quezon-care'); ?></p>
                    
                    <?php
                    // Check if Contact Form 7 is active
                    if (function_exists('wpcf7_contact_form')) {
                        $args = array(
                            'post_type'      => 'wpcf7_contact_form',
                            'posts_per_page' => 1,
                            'title'          => 'Contact Form',
                        );
                        $forms = get_posts($args);
                        
                        if (!empty($forms)) {
                            echo do_shortcode('[contact-form-7 id="' . $forms[0]->ID . '"]');
                        } else {
                            quezon_care_display_contact_form();
                        }
                    } else {
                        quezon_care_display_contact_form();
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Map Section -->
        <div class="contact-map" style="margin-top: 3rem;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61726.39119621477!2d121.01890255!3d14.633370850000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b7be8e5b2f2f%3A0x738ed7dcbeea5e2e!2sQuezon%20City%2C%20Metro%20Manila%2C%20Philippines!5e0!3m2!1sen!2sus!4v1704326400000!5m2!1sen!2sus" 
                width="100%" 
                height="450" 
                style="border:0; border-radius: var(--radius-lg);" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<?php
get_footer();
?>
