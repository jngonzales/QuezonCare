<?php
/**
 * 404 Error Page Template
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- 404 Section -->
<section class="section" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="thank-you-content" style="text-align: center; max-width: 600px; margin: 0 auto;">
            <div style="font-size: 8rem; font-weight: 700; color: var(--primary-light); line-height: 1; margin-bottom: 1rem;">
                404
            </div>
            
            <h1><?php esc_html_e('Page Not Found', 'quezon-care'); ?></h1>
            <p><?php esc_html_e('Oops! The page you\'re looking for doesn\'t exist or has been moved. Don\'t worry, let\'s get you back on track.', 'quezon-care'); ?></p>
            
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-home"></i>
                    <?php esc_html_e('Go to Homepage', 'quezon-care'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-outline btn-lg">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Consultation', 'quezon-care'); ?>
                </a>
            </div>
            
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                <h3 style="margin-bottom: 1rem;"><?php esc_html_e('Popular Pages', 'quezon-care'); ?></h3>
                <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" style="color: var(--primary-color);">
                        <i class="fas fa-heart"></i> <?php esc_html_e('Our Services', 'quezon-care'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color: var(--primary-color);">
                        <i class="fas fa-users"></i> <?php esc_html_e('About Us', 'quezon-care'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color: var(--primary-color);">
                        <i class="fas fa-envelope"></i> <?php esc_html_e('Contact', 'quezon-care'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
