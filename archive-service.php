<?php
/**
 * Archive Template for Services
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><?php esc_html_e('Our Services', 'quezon-care'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php esc_html_e('Services', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- Services Grid -->
<section class="services-section section">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?php esc_html_e('What We Offer', 'quezon-care'); ?></span>
            <h2><?php esc_html_e('Comprehensive Home Care Solutions', 'quezon-care'); ?></h2>
            <p><?php esc_html_e('We provide a wide range of professional care services tailored to meet your unique needs. Each service is delivered by trained, compassionate caregivers.', 'quezon-care'); ?></p>
        </div>
        
        <?php if (have_posts()) : ?>
            <div class="services-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));">
                <?php while (have_posts()) : the_post(); 
                    $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                    $icon = $icon ? $icon : 'fa-heart';
                    $price = get_post_meta(get_the_ID(), '_service_price', true);
                    ?>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas <?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <?php if ($price) : ?>
                            <p class="service-price" style="color: var(--primary-color); font-weight: 600; margin-bottom: 0.5rem;">
                                <?php printf(esc_html__('Starting at ₱%s/hour', 'quezon-care'), esc_html($price)); ?>
                            </p>
                        <?php endif; ?>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="service-link">
                            <?php esc_html_e('Learn More', 'quezon-care'); ?>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination" style="margin-top: 3rem; text-align: center;">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ));
                ?>
            </div>
            
        <?php else : ?>
            <div class="no-services" style="text-align: center; padding: 4rem 0;">
                <h2><?php esc_html_e('No services found', 'quezon-care'); ?></h2>
                <p><?php esc_html_e('We are currently updating our services. Please check back soon.', 'quezon-care'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Return Home', 'quezon-care'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section">
    <div class="container">
        <div class="cta-box">
            <h2><?php esc_html_e('Not Sure Which Service You Need?', 'quezon-care'); ?></h2>
            <p><?php esc_html_e('Book a free consultation and let our care coordinators help you find the perfect care solution for your loved one.', 'quezon-care'); ?></p>
            
            <div class="hero-buttons" style="justify-content: center;">
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Free Consultation', 'quezon-care'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
