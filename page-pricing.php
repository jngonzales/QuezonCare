<?php
/**
 * Template Name: Pricing Packages
 * Template Post Type: page
 *
 * Displays WooCommerce service packages with pricing
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Page Header -->
<div class="page-header bg-gradient-to-r from-blue-600/90 to-teal-600/90 text-white py-32 -mt-24 pt-40 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-teal-500 opacity-90"></div>
    <div class="container max-w-7xl mx-auto px-4 md:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up"><?php esc_html_e('Care Packages & Pricing', 'quezon-care'); ?></h1>
        <div class="breadcrumb flex justify-center gap-2 text-white/80" data-aos="fade-up" data-aos-delay="100">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span class="text-white"><?php esc_html_e('Pricing', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- Pricing Section -->
<section class="pricing-section section py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="section-header text-center mb-16" data-aos="fade-up">
            <span class="section-label inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4"><?php esc_html_e('Affordable Care', 'quezon-care'); ?></span>
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-4"><?php esc_html_e('Transparent Pricing, No Hidden Fees', 'quezon-care'); ?></h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto"><?php esc_html_e('Choose the care package that best fits your needs. All packages include our quality guarantee and 24/7 support.', 'quezon-care'); ?></p>
        </div>

        <div class="pricing-grid grid md:grid-cols-3 gap-8 items-start">
            <?php
            // Get WooCommerce products
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
                'orderby'        => 'meta_value_num',
                'meta_key'       => '_price',
                'order'          => 'ASC',
            );
            
            $products = new WP_Query($args);
            
            $index = 0;
            $featured_index = 1; // Middle package is featured
            
            if ($products->have_posts()) :
                while ($products->have_posts()) : $products->the_post();
                    global $product;
                    $is_featured = ($index === $featured_index);
                    $delay = $index * 150;
                    $index++;
                    ?>
                    <div class="pricing-card glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden <?php echo $is_featured ? 'featured ring-2 ring-blue-500 scale-105' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <?php if ($is_featured) : ?>
                            <div class="popular-badge absolute top-4 right-4 bg-gradient-to-r from-orange-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full"><?php esc_html_e('Most Popular', 'quezon-care'); ?></div>
                        <?php endif; ?>
                        
                        <div class="pricing-header bg-gradient-to-r from-blue-500 to-blue-600 text-white p-8 text-center">
                            <h3 class="text-2xl font-bold mb-2"><?php the_title(); ?></h3>
                            <div class="pricing-amount flex items-baseline justify-center gap-1">
                                <span class="currency text-xl">₱</span>
                                <span class="price text-5xl font-bold"><?php echo number_format($product->get_price()); ?></span>
                                <span class="period text-sm opacity-80">/month</span>
                            </div>
                            <p class="pricing-subtitle mt-2 text-sm opacity-90"><?php echo esc_html($product->get_short_description()); ?></p>
                        </div>
                        
                        <div class="pricing-features p-8">
                            <?php
                            $description = $product->get_description();
                            // Parse description for features
                            $features = explode('.', $description);
                            foreach ($features as $feature) :
                                $feature = trim($feature);
                                if (!empty($feature)) :
                                    ?>
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span><?php echo esc_html($feature); ?></span>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                        
                        <div class="pricing-action">
                            <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn <?php echo $is_featured ? 'btn-secondary' : 'btn-primary'; ?> btn-lg btn-block">
                                <?php esc_html_e('Get Started', 'quezon-care'); ?>
                            </a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <!-- Fallback static pricing if no products -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3><?php esc_html_e('Basic Package', 'quezon-care'); ?></h3>
                        <div class="pricing-amount">
                            <span class="currency">₱</span>
                            <span class="price">8,000</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>40 hours/week</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>10 hrs/day coverage</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Nursing assessment</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Daily care assistance</span></div>
                    </div>
                    <div class="pricing-action">
                        <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-lg btn-block">Get Started</a>
                    </div>
                </div>
                
                <div class="pricing-card featured">
                    <div class="popular-badge"><?php esc_html_e('Most Popular', 'quezon-care'); ?></div>
                    <div class="pricing-header">
                        <h3><?php esc_html_e('Premium Package', 'quezon-care'); ?></h3>
                        <div class="pricing-amount">
                            <span class="currency">₱</span>
                            <span class="price">12,000</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>56 hours/week</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>24 hrs, 3 days/week</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Nursing assessment</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Medication management</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Priority support</span></div>
                    </div>
                    <div class="pricing-action">
                        <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-secondary btn-lg btn-block">Get Started</a>
                    </div>
                </div>
                
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3><?php esc_html_e('Luxury Package', 'quezon-care'); ?></h3>
                        <div class="pricing-amount">
                            <span class="currency">₱</span>
                            <span class="price">20,000</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>168 hours (24/7)</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>On-call availability</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Everything included</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Monthly doctor consultation</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Dedicated care manager</span></div>
                    </div>
                    <div class="pricing-action">
                        <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-lg btn-block">Get Started</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pricing Note -->
        <div class="pricing-note">
            <p><i class="fas fa-info-circle"></i> <?php esc_html_e('All prices are in Philippine Pesos (₱). Custom packages available upon request. Contact us for a personalized quote.', 'quezon-care'); ?></p>
        </div>
    </div>
</section>

<!-- Hourly Rates Section -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?php esc_html_e('Flexible Options', 'quezon-care'); ?></span>
            <h2><?php esc_html_e('Hourly Care Rates', 'quezon-care'); ?></h2>
            <p><?php esc_html_e('Need flexible care? We also offer hourly rates for all our services.', 'quezon-care'); ?></p>
        </div>
        
        <div class="services-grid">
            <?php
            $hourly_services = array(
                array('name' => 'Nursing Care', 'price' => '500', 'icon' => 'fa-user-nurse'),
                array('name' => 'Elderly Companion', 'price' => '350', 'icon' => 'fa-heart'),
                array('name' => 'Post-Surgery Care', 'price' => '450', 'icon' => 'fa-hospital'),
                array('name' => 'Dementia Care', 'price' => '550', 'icon' => 'fa-brain'),
            );
            
            foreach ($hourly_services as $service) :
                ?>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas <?php echo esc_attr($service['icon']); ?>"></i>
                    </div>
                    <h3><?php echo esc_html($service['name']); ?></h3>
                    <div class="hourly-price">
                        <span class="price-tag">₱<?php echo esc_html($service['price']); ?></span>
                        <span class="price-unit">/hour</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="service-link">
                        <?php esc_html_e('Book Now', 'quezon-care'); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section">
    <div class="container">
        <div class="cta-box">
            <h2><?php esc_html_e('Not Sure Which Package Is Right?', 'quezon-care'); ?></h2>
            <p><?php esc_html_e('Book a free consultation and our care coordinator will help you choose the perfect plan for your needs.', 'quezon-care'); ?></p>
            
            <div class="hero-buttons" style="justify-content: center;">
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Free Consultation', 'quezon-care'); ?>
                </a>
                <a href="tel:+63281234567" class="btn btn-white btn-lg">
                    <i class="fas fa-phone-alt"></i>
                    <?php esc_html_e('Call Us Now', 'quezon-care'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
