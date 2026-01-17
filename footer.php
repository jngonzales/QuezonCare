<?php
/**
 * Footer Template
 *
 * @package Quezon_Care
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get theme options
$phone = quezon_care_get_option('phone', '+63 (02) 8123-4567');
$email = quezon_care_get_option('email', 'care@quezonhomecare.ph');
$address = quezon_care_get_option('address', '123 Katipunan Ave, Quezon City, Philippines');
$hours = quezon_care_get_option('hours', '24/7 Service Available');

$facebook = quezon_care_get_option('facebook', '#');
$instagram = quezon_care_get_option('instagram', '#');
$twitter = quezon_care_get_option('twitter', '#');
$linkedin = quezon_care_get_option('linkedin', '#');
?>

</main><!-- #main-content -->

<!-- Site Footer -->
<footer class="site-footer" role="contentinfo">
    <div class="container">
        <!-- Footer Main Content -->
        <div class="footer-main">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                    <span class="footer-logo-text">Quezon<span>Care</span></span>
                </a>
                <p><?php esc_html_e('Providing compassionate, professional home care services to families in Quezon City. Your loved ones deserve the best care possible.', 'quezon-care'); ?></p>
                
                <!-- Social Links -->
                <div class="footer-social">
                    <?php if ($facebook) : ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Facebook', 'quezon-care'); ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($instagram) : ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Instagram', 'quezon-care'); ?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($twitter) : ?>
                        <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Twitter', 'quezon-care'); ?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($linkedin) : ?>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('LinkedIn', 'quezon-care'); ?>">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-column">
                <h4><?php esc_html_e('Quick Links', 'quezon-care'); ?></h4>
                <nav class="footer-links" aria-label="<?php esc_attr_e('Footer navigation', 'quezon-care'); ?>">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
                    <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php esc_html_e('Our Services', 'quezon-care'); ?></a>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('About Us', 'quezon-care'); ?></a>
                    <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>"><?php esc_html_e('Book Consultation', 'quezon-care'); ?></a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact Us', 'quezon-care'); ?></a>
                </nav>
            </div>
            
            <!-- Services -->
            <div class="footer-column">
                <h4><?php esc_html_e('Our Services', 'quezon-care'); ?></h4>
                <nav class="footer-links" aria-label="<?php esc_attr_e('Services navigation', 'quezon-care'); ?>">
                    <?php
                    $services = quezon_care_get_services(4);
                    if ($services->have_posts()) :
                        while ($services->have_posts()) : $services->the_post();
                            ?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Default services if none exist
                        ?>
                        <a href="#"><?php esc_html_e('Nursing Care', 'quezon-care'); ?></a>
                        <a href="#"><?php esc_html_e('Elderly Companion', 'quezon-care'); ?></a>
                        <a href="#"><?php esc_html_e('Post-Surgery Recovery', 'quezon-care'); ?></a>
                        <a href="#"><?php esc_html_e('Dementia Care', 'quezon-care'); ?></a>
                        <?php
                    endif;
                    ?>
                </nav>
            </div>
            
            <!-- Contact Info -->
            <div class="footer-column">
                <h4><?php esc_html_e('Contact Us', 'quezon-care'); ?></h4>
                
                <div class="footer-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span><?php echo esc_html($phone); ?></span>
                </div>
                
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo esc_html($email); ?></span>
                </div>
                
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo esc_html($address); ?></span>
                </div>
                
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <span><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'quezon-care'); ?></p>
            
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'quezon-care'); ?></a>
                <a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>"><?php esc_html_e('Terms of Service', 'quezon-care'); ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Action Buttons -->
<div class="floating-actions">
    <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>" class="floating-btn phone-btn" aria-label="<?php esc_attr_e('Call Us', 'quezon-care'); ?>">
        <i class="fas fa-phone-alt"></i>
        <span class="floating-tooltip"><?php esc_html_e('Call Now', 'quezon-care'); ?></span>
    </a>
    <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="floating-btn book-btn" aria-label="<?php esc_attr_e('Book Consultation', 'quezon-care'); ?>">
        <i class="fas fa-calendar-check"></i>
        <span class="floating-tooltip"><?php esc_html_e('Book Now', 'quezon-care'); ?></span>
    </a>
</div>

<!-- Back to Top Button -->
<button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'quezon-care'); ?>">
    <i class="fas fa-chevron-up"></i>
</button>

<?php wp_footer(); ?>
</body>
</html>
