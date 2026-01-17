<?php
/**
 * Single Service Template
 *
 * @package Quezon_Care
 */

get_header();

$phone = quezon_care_get_option('phone', '+63 (02) 8123-4567');

// Get service meta
$price = get_post_meta(get_the_ID(), '_service_price', true);
$icon = get_post_meta(get_the_ID(), '_service_icon', true);
$features = get_post_meta(get_the_ID(), '_service_features', true);

// Parse features into array
$features_array = array();
if ($features) {
    $features_array = array_filter(array_map('trim', explode("\n", $features)));
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php esc_html_e('Services', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php the_title(); ?></span>
        </div>
    </div>
</div>

<!-- Service Detail -->
<section class="service-detail section">
    <div class="container">
        <div class="service-detail-grid">
            <!-- Main Content -->
            <div class="service-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-featured-image">
                        <?php the_post_thumbnail('hero-image'); ?>
                    </div>
                <?php else : ?>
                    <?php
                    // Default service images from Unsplash
                    $default_images = array(
                        'nursing-care' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&h=400&fit=crop',
                        'elderly-companion' => 'https://images.unsplash.com/photo-1581579438747-1dc8d17bbce4?w=800&h=400&fit=crop',
                        'post-surgery' => 'https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=800&h=400&fit=crop',
                        'dementia-care' => 'https://images.unsplash.com/photo-1493894473891-10fc1e5dbd22?w=800&h=400&fit=crop',
                    );
                    $slug = get_post_field('post_name', get_the_ID());
                    $image_url = isset($default_images[$slug]) ? $default_images[$slug] : 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?w=800&h=400&fit=crop';
                    ?>
                    <div class="service-featured-image">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                <?php endif; ?>
                
                <?php if ($price) : ?>
                    <div class="service-price-badge">
                        <i class="fas fa-tag"></i>
                        <?php printf(esc_html__('Starting at ₱%s/hour', 'quezon-care'), esc_html($price)); ?>
                    </div>
                <?php endif; ?>
                
                <div class="service-description">
                    <?php the_content(); ?>
                </div>
                
                <?php if (!empty($features_array)) : ?>
                    <div class="service-features">
                        <h3><?php esc_html_e('What\'s Included', 'quezon-care'); ?></h3>
                        <div class="feature-list">
                            <?php foreach ($features_array as $feature) : ?>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span><?php echo esc_html($feature); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="service-cta" style="margin-top: 2rem; padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg);">
                    <h3 style="margin-bottom: 1rem;"><?php esc_html_e('Ready to Get Started?', 'quezon-care'); ?></h3>
                    <p style="margin-bottom: 1.5rem;"><?php esc_html_e('Book a free consultation to discuss your care needs with our experienced team.', 'quezon-care'); ?></p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary">
                            <i class="fas fa-calendar-check"></i>
                            <?php esc_html_e('Book This Service', 'quezon-care'); ?>
                        </a>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn btn-outline">
                            <i class="fas fa-phone-alt"></i>
                            <?php esc_html_e('Call Us', 'quezon-care'); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <aside class="service-sidebar">
                <!-- Book Now Card -->
                <div class="sidebar-card" style="background: var(--primary-color); color: var(--bg-white);">
                    <h3 style="color: var(--bg-white); border-color: rgba(255,255,255,0.2);"><?php esc_html_e('Book Now', 'quezon-care'); ?></h3>
                    <p style="color: rgba(255,255,255,0.9);"><?php esc_html_e('Schedule a free consultation with our care coordinator.', 'quezon-care'); ?></p>
                    <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-white" style="width: 100%; margin-bottom: 1rem;">
                        <i class="fas fa-calendar-check"></i>
                        <?php esc_html_e('Free Consultation', 'quezon-care'); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" style="color: var(--bg-white); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fas fa-phone-alt"></i>
                        <?php echo esc_html($phone); ?>
                    </a>
                </div>
                
                <!-- Related Services -->
                <div class="sidebar-card">
                    <h3><?php esc_html_e('Other Services', 'quezon-care'); ?></h3>
                    <div class="related-services">
                        <?php
                        $related = new WP_Query(array(
                            'post_type'      => 'service',
                            'posts_per_page' => 3,
                            'post__not_in'   => array(get_the_ID()),
                            'orderby'        => 'rand',
                        ));
                        
                        if ($related->have_posts()) :
                            while ($related->have_posts()) : $related->the_post();
                                $rel_icon = get_post_meta(get_the_ID(), '_service_icon', true);
                                $rel_icon = $rel_icon ? $rel_icon : 'fa-heart';
                                $rel_price = get_post_meta(get_the_ID(), '_service_price', true);
                                ?>
                                <a href="<?php the_permalink(); ?>" class="related-service-card">
                                    <div class="related-service-icon">
                                        <i class="fas <?php echo esc_attr($rel_icon); ?>"></i>
                                    </div>
                                    <div>
                                        <h4><?php the_title(); ?></h4>
                                        <?php if ($rel_price) : ?>
                                            <span><?php printf(esc_html__('From ₱%s/hr', 'quezon-care'), esc_html($rel_price)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                
                <!-- Why Choose Us -->
                <div class="sidebar-card">
                    <h3><?php esc_html_e('Why Choose Us', 'quezon-care'); ?></h3>
                    <ul style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <li style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                            <span><?php esc_html_e('Licensed & Insured', 'quezon-care'); ?></span>
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                            <span><?php esc_html_e('Background Checked Staff', 'quezon-care'); ?></span>
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                            <span><?php esc_html_e('Personalized Care Plans', 'quezon-care'); ?></span>
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                            <span><?php esc_html_e('24/7 Support Available', 'quezon-care'); ?></span>
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                            <span><?php esc_html_e('Flexible Scheduling', 'quezon-care'); ?></span>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
