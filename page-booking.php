<?php
/**
 * Template Name: Booking Page
 * Template Post Type: page
 *
 * Booking consultation form page template
 *
 * @package Quezon_Care
 */

/**
 * Display default booking form when Contact Form 7 is not available
 */
if (!function_exists('quezon_care_display_default_booking_form')) {
    function quezon_care_display_default_booking_form() {
        ?>
        <form class="booking-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <input type="hidden" name="action" value="quezon_care_booking">
            <?php wp_nonce_field('quezon_care_booking_nonce', 'booking_nonce'); ?>
            
            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="full_name"><?php esc_html_e('Full Name', 'quezon-care'); ?> <span class="required">*</span></label>
                    <input type="text" id="full_name" name="full_name" placeholder="Your Full Name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email"><?php esc_html_e('Email Address', 'quezon-care'); ?> <span class="required">*</span></label>
                <input type="email" id="email" name="email" placeholder="your@email.com" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
            </div>
            
            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="phone"><?php esc_html_e('Phone Number', 'quezon-care'); ?> <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" placeholder="+63 917 123 4567" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                </div>
                <div class="form-group">
                    <label for="service"><?php esc_html_e('Service Interested In', 'quezon-care'); ?> <span class="required">*</span></label>
                    <select id="service" name="service" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                        <option value="nursing-care"><?php esc_html_e('Nursing Care', 'quezon-care'); ?></option>
                        <option value="elderly-companion"><?php esc_html_e('Elderly Companion', 'quezon-care'); ?></option>
                        <option value="post-surgery"><?php esc_html_e('Post-Surgery Recovery', 'quezon-care'); ?></option>
                        <option value="dementia-care"><?php esc_html_e('Dementia/Alzheimer\'s Care', 'quezon-care'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="start_date"><?php esc_html_e('Preferred Start Date', 'quezon-care'); ?></label>
                    <input type="date" id="start_date" name="start_date" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="frequency"><?php esc_html_e('Care Frequency', 'quezon-care'); ?></label>
                    <select id="frequency" name="frequency" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                        <option value="full-time"><?php esc_html_e('Full-time (24/7)', 'quezon-care'); ?></option>
                        <option value="part-time"><?php esc_html_e('Part-time', 'quezon-care'); ?></option>
                        <option value="weekends"><?php esc_html_e('Weekends Only', 'quezon-care'); ?></option>
                        <option value="as-needed"><?php esc_html_e('As Needed', 'quezon-care'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="notes"><?php esc_html_e('Additional Notes', 'quezon-care'); ?></label>
                <textarea id="notes" name="notes" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="<?php esc_attr_e('Tell us about your care needs, the patient\'s condition, or any questions you have...', 'quezon-care'); ?>"></textarea>
            </div>
            
            <div class="form-group" style="margin-top: 1rem;">
                <label style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="privacy" required style="margin-top: 4px;">
                    <span class="text-sm text-gray-600">
                        <?php printf(esc_html__('I agree to the %1$sPrivacy Policy%2$s and consent to be contacted *', 'quezon-care'), '<a href="' . esc_url(home_url('/privacy-policy/')) . '" class="text-blue-600 hover:underline">', '</a>'); ?>
                    </span>
                </label>
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold py-4 px-8 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 mt-6">
                <?php esc_html_e('Book My Free Consultation', 'quezon-care'); ?>
            </button>
        </form>
        <?php
    }
}

get_header();

// Get phone number safely
$phone = '+63 (02) 8123-4567';
if (function_exists('quezon_care_get_option')) {
    $phone = quezon_care_get_option('phone', '+63 (02) 8123-4567');
}
?>

<!-- Page Header -->
<div class="page-header bg-gradient-to-r from-blue-600/90 to-teal-600/90 text-white py-32 -mt-24 pt-40 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-teal-500 opacity-90"></div>
    <div class="container max-w-7xl mx-auto px-4 md:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up"><?php esc_html_e('Book Free Consultation', 'quezon-care'); ?></h1>
        <div class="breadcrumb flex justify-center gap-2 text-white/80" data-aos="fade-up" data-aos-delay="100">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span class="text-white"><?php esc_html_e('Book Consultation', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- Booking Section -->
<section class="booking-section section py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="booking-grid grid md:grid-cols-3 gap-12">
            <!-- Booking Form -->
            <div class="booking-form-wrapper md:col-span-2 glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-10 shadow-2xl" data-aos="fade-right">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3"><?php esc_html_e('Get Your Free Care Plan', 'quezon-care'); ?></h2>
                <p class="text-gray-600 mb-8"><?php esc_html_e('No obligation. Personalized in 24 hours. Fill out the form below and our care coordinator will contact you to discuss your needs.', 'quezon-care'); ?></p>
                
                <?php
                // Check if Contact Form 7 is active and display the form
                if (function_exists('wpcf7_contact_form')) {
                    // Try to get the contact form by title
                    $args = array(
                        'post_type'      => 'wpcf7_contact_form',
                        'posts_per_page' => 1,
                        'post_status'    => 'publish',
                    );
                    $forms = get_posts($args);
                    
                    if (!empty($forms)) {
                        echo do_shortcode('[contact-form-7 id="' . $forms[0]->ID . '"]');
                    } else {
                        // Display default HTML form if CF7 form not found
                        quezon_care_display_default_booking_form();
                    }
                } else {
                    // Display default HTML form if CF7 is not active
                    quezon_care_display_default_booking_form();
                }
                ?>
            </div>
            
            <!-- Sidebar -->
            <aside class="booking-sidebar" data-aos="fade-left" data-aos-delay="200">
                <!-- Trust Badges -->
                <div class="trust-badges">
                    <h3><?php esc_html_e('Why Choose Us', 'quezon-care'); ?></h3>
                    
                    <div class="trust-badge" data-aos="fade-up" data-aos-delay="300">
                        <div class="trust-badge-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('Licensed RNs', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('All nurses are fully licensed and vetted', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="trust-badge" data-aos="fade-up" data-aos-delay="400">
                        <div class="trust-badge-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('10+ Years Experience', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Trusted by hundreds of families', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="trust-badge">
                        <div class="trust-badge-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e('24/7 Support', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Always here when you need us', 'quezon-care'); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Card -->
                <div class="contact-card">
                    <h3><?php esc_html_e('Prefer to Call?', 'quezon-care'); ?></h3>
                    <p><?php esc_html_e('Speak directly with our care coordinator for immediate assistance.', 'quezon-care'); ?></p>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="contact-phone">
                        <i class="fas fa-phone-alt"></i>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn btn-white" style="width: 100%;">
                        <?php esc_html_e('Call Now', 'quezon-care'); ?>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

get_footer();
?>
