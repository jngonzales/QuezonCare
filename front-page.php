<?php
/**
 * Front Page Template (Homepage)
 *
 * @package Quezon_Care
 */

get_header();

// Get theme options with fallback
$phone = '+63 (02) 8123-4567';
if (function_exists('quezon_care_get_option')) {
    $phone = quezon_care_get_option('phone', $phone);
}
?>

<!-- Hero Section -->
<section class="hero bg-gradient-to-br from-slate-50 via-blue-50 to-teal-50" id="hero">
    <div class="hero-container max-w-7xl mx-auto px-4 md:px-8">
        <div class="hero-content">
            <div class="hero-badge backdrop-blur-xl bg-white/80 border border-white/50 shadow-lg" data-aos="fade-down" data-aos-delay="0">
                <i class="fas fa-shield-alt text-blue-600"></i>
                <span class="text-gray-700 font-medium"><?php esc_html_e('Licensed & Trusted Care', 'quezon-care'); ?></span>
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent leading-tight" data-aos="fade-up" data-aos-delay="100"><?php esc_html_e('24/7 In-Home Care You Can Trust', 'quezon-care'); ?></h1>
            
            <p class="hero-subtitle text-gray-600 text-lg md:text-xl" data-aos="fade-up" data-aos-delay="200">
                <?php esc_html_e('Professional nursing + companion care in Quezon City. Our dedicated team provides compassionate, personalized care for your loved ones in the comfort of their home.', 'quezon-care'); ?>
            </p>
            
            <div class="hero-buttons flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="300">
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="hero-btn inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-xl hover:shadow-blue-500/50 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Free Consultation', 'quezon-care'); ?>
                </a>
                <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-lg border border-gray-200 text-gray-800 px-8 py-4 rounded-2xl font-semibold text-lg shadow-lg hover:shadow-xl hover:bg-white transition-all duration-300">
                    <?php esc_html_e('Our Services', 'quezon-care'); ?>
                </a>
            </div>
            
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                    <span class="stat-number">10+</span>
                    <span class="stat-label"><?php esc_html_e('Years Experience', 'quezon-care'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label"><?php esc_html_e('Families Served', 'quezon-care'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label"><?php esc_html_e('Care Specialists', 'quezon-care'); ?></span>
                </div>
            </div>
        </div>
        
        <div class="hero-image" data-aos="fade-left" data-aos-delay="200">
            <img src="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?w=600&h=500&fit=crop&crop=faces" alt="<?php esc_attr_e('Professional caregiver with elderly patient', 'quezon-care'); ?>">
            
            <!-- Floating Cards -->
            <div class="hero-floating-card card-1 animate-float" data-aos="zoom-in" data-aos-delay="600">
                <i class="fas fa-star" style="color: #FFC107;"></i>
                <strong>4.9/5</strong>
                <span><?php esc_html_e('Client Rating', 'quezon-care'); ?></span>
            </div>
            
            <div class="hero-floating-card card-2">
                <i class="fas fa-check-circle" style="color: #38A169;"></i>
                <strong><?php esc_html_e('24/7', 'quezon-care'); ?></strong>
                <span><?php esc_html_e('Support Available', 'quezon-care'); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section section py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50" id="services">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="section-header text-center mb-16" data-aos="fade-up">
            <span class="section-label inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4"><?php esc_html_e('Our Services', 'quezon-care'); ?></span>
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-4"><?php esc_html_e('Comprehensive Home Care Solutions', 'quezon-care'); ?></h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto"><?php esc_html_e('We offer a wide range of professional care services tailored to meet your unique needs and ensure the well-being of your loved ones.', 'quezon-care'); ?></p>
        </div>
        
        <div class="services-grid grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $services = function_exists('quezon_care_get_services') ? quezon_care_get_services(4) : null;
            $service_index = 0;
            
            if ($services && $services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                    $icon = $icon ? $icon : 'fa-heart';
                    $delay = $service_index * 100;
                    ?>
                    <div class="service-card glass-card bg-white/70 backdrop-blur-xl border border-white/50 rounded-3xl p-8 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="service-icon w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <i class="fas <?php echo esc_attr($icon); ?> text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors"><?php the_title(); ?></h3>
                        <p class="text-gray-600 mb-4 leading-relaxed"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="service-link inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
                            <?php esc_html_e('Learn More', 'quezon-care'); ?>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php
                    $service_index++;
                endwhile;
                wp_reset_postdata();
            else :
                // Default services if none exist
                $default_services = array(
                    array(
                        'icon'  => 'fa-stethoscope',
                        'title' => 'Nursing Care',
                        'desc'  => 'Professional RN/LPN care for medical needs, medication management, and health monitoring.',
                        'link'  => '/services/nursing-care/',
                    ),
                    array(
                        'icon'  => 'fa-users',
                        'title' => 'Elderly Companion',
                        'desc'  => 'Daily support and activities to keep your loved ones engaged, active, and happy.',
                        'link'  => '/services/elderly-companion/',
                    ),
                    array(
                        'icon'  => 'fa-heart',
                        'title' => 'Post-Surgery Recovery',
                        'desc'  => '24-hour recovery assistance to ensure a safe and comfortable healing process.',
                        'link'  => '/services/post-surgery/',
                    ),
                    array(
                        'icon'  => 'fa-brain',
                        'title' => 'Dementia Care',
                        'desc'  => 'Specialized memory care with trained professionals for Alzheimer\'s and dementia patients.',
                        'link'  => '/services/dementia-care/',
                    ),
                );
                
                $default_index = 0;
                foreach ($default_services as $service) :
                    $delay = $default_index * 100;
                    ?>
                    <div class="service-card glass-card bg-white/70 backdrop-blur-xl border border-white/50 rounded-3xl p-8 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="service-icon w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <i class="fas <?php echo esc_attr($service['icon']); ?> text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors"><?php echo esc_html($service['title']); ?></h3>
                        <p class="text-gray-600 mb-4 leading-relaxed"><?php echo esc_html($service['desc']); ?></p>
                        <a href="<?php echo esc_url(home_url($service['link'])); ?>" class="service-link inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
                            <?php esc_html_e('Learn More', 'quezon-care'); ?>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php
                    $default_index++;
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section section py-24 bg-white" id="about">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="about-grid grid md:grid-cols-2 gap-16 items-center">
            <div class="about-image" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&h=600&fit=crop" alt="<?php esc_attr_e('Our caring team', 'quezon-care'); ?>">
                <div class="about-experience animate-float">
                    <span class="years">10+</span>
                    <span><?php esc_html_e('Years of Excellence', 'quezon-care'); ?></span>
                </div>
            </div>
            
            <div class="about-content" data-aos="fade-left" data-aos-delay="200">
                <span class="section-label"><?php esc_html_e('Why Choose Us', 'quezon-care'); ?></span>
                <h2><?php esc_html_e('Dedicated to Providing the Best Care', 'quezon-care'); ?></h2>
                <p><?php esc_html_e('At Quezon Home Care, we understand that choosing a care provider for your loved one is one of the most important decisions you\'ll make. Our team of licensed professionals is committed to delivering exceptional care with compassion and dignity.', 'quezon-care'); ?></p>
                
                <div class="about-features">
                    <div class="about-feature" data-aos="fade-up" data-aos-delay="300">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('Licensed Professionals', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('All RNs and LPNs are fully licensed', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="about-feature" data-aos="fade-up" data-aos-delay="400">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('Background Checked', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Thorough screening for your safety', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="about-feature" data-aos="fade-up" data-aos-delay="500">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('Personalized Care Plans', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Tailored to individual needs', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="about-feature" data-aos="fade-up" data-aos-delay="600">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('24/7 Support', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Always here when you need us', 'quezon-care'); ?></p>
                        </div>
                    </div>
                </div>
                
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Learn More About Us', 'quezon-care'); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section section py-24 bg-gradient-to-r from-teal-500/5 to-blue-500/5" id="testimonials">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="section-header text-center mb-16" data-aos="fade-up">
            <span class="section-label inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4"><?php esc_html_e('Testimonials', 'quezon-care'); ?></span>
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-4"><?php esc_html_e('What Our Clients Say', 'quezon-care'); ?></h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto"><?php esc_html_e('Don\'t just take our word for it. Hear from families who have trusted us with their loved ones\' care.', 'quezon-care'); ?></p>
        </div>
        
        <div class="testimonials-slider" id="testimonials-slider" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonials-track">
                <?php
                $testimonials = function_exists('quezon_care_get_testimonials') ? quezon_care_get_testimonials(3) : null;
                
                if ($testimonials && $testimonials->have_posts()) :
                    while ($testimonials->have_posts()) : $testimonials->the_post();
                        $position = get_post_meta(get_the_ID(), '_testimonial_position', true);
                        $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                        $rating = $rating ? $rating : 5;
                        ?>
                        <div class="testimonial-card">
                            <div class="testimonial-content glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-10 shadow-xl text-center">
                                <p class="testimonial-quote text-lg text-gray-700 italic leading-relaxed mb-8"><?php the_content(); ?></p>
                                <div class="testimonial-author flex items-center justify-center gap-4">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('testimonial-avatar', array('class' => 'testimonial-avatar w-16 h-16 rounded-full object-cover ring-4 ring-blue-100')); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(QUEZON_CARE_URI . '/assets/images/avatar-placeholder.svg'); ?>" alt="" class="testimonial-avatar w-16 h-16 rounded-full">
                                    <?php endif; ?>
                                    <div class="testimonial-info text-left">
                                        <h4 class="font-semibold text-gray-900"><?php the_title(); ?></h4>
                                        <?php if ($position) : ?>
                                            <span class="text-gray-500 text-sm"><?php echo esc_html($position); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="testimonial-rating mt-4 text-yellow-400">
                                    <?php for ($i = 0; $i < $rating; $i++) : ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Default testimonials
                    $default_testimonials = array(
                        array(
                            'quote'  => 'Excellent care for my mother. Nurses are professional & kind. They treated her like family and gave us peace of mind.',
                            'name'   => 'Maria D.',
                            'age'    => 72,
                            'rating' => 5,
                        ),
                        array(
                            'quote'  => 'Booked within 2 hours. Best decision we made. The care coordinator was responsive and matched us with the perfect caregiver.',
                            'name'   => 'Juan M.',
                            'age'    => 58,
                            'rating' => 5,
                        ),
                        array(
                            'quote'  => 'Affordable and trustworthy. Highly recommend! After trying other agencies, Quezon Care exceeded all our expectations.',
                            'name'   => 'Rosa T.',
                            'age'    => 80,
                            'rating' => 5,
                        ),
                    );
                    
                    foreach ($default_testimonials as $testimonial) :
                        ?>
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p class="testimonial-quote"><?php echo esc_html($testimonial['quote']); ?></p>
                                <div class="testimonial-author">
                                    <img src="<?php echo esc_url(QUEZON_CARE_URI . '/assets/images/avatar-placeholder.svg'); ?>" alt="" class="testimonial-avatar">
                                    <div class="testimonial-info">
                                        <h4><?php echo esc_html($testimonial['name']); ?></h4>
                                        <span><?php echo esc_html($testimonial['age']); ?> <?php esc_html_e('years old', 'quezon-care'); ?></span>
                                    </div>
                                </div>
                                <div class="testimonial-rating">
                                    <?php for ($i = 0; $i < $testimonial['rating']; $i++) : ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
            
            <div class="testimonials-dots">
                <button class="dot active" data-slide="0" aria-label="<?php esc_attr_e('Go to slide 1', 'quezon-care'); ?>"></button>
                <button class="dot" data-slide="1" aria-label="<?php esc_attr_e('Go to slide 2', 'quezon-care'); ?>"></button>
                <button class="dot" data-slide="2" aria-label="<?php esc_attr_e('Go to slide 3', 'quezon-care'); ?>"></button>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section py-24 bg-gradient-to-br from-slate-50 via-blue-50 to-teal-50" id="cta">
    <div class="container max-w-4xl mx-auto px-4 md:px-8" data-aos="zoom-in" data-aos-duration="600">
        <div class="cta-box glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-12 shadow-2xl text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-teal-400 to-orange-400"></div>
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-4" data-aos="fade-up" data-aos-delay="100"><?php esc_html_e('Ready to Get Started?', 'quezon-care'); ?></h2>
            <p class="text-gray-600 text-lg mb-8 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200"><?php esc_html_e('Book a free consultation today and let us create a personalized care plan for your loved one. No obligation, just compassionate guidance.', 'quezon-care'); ?></p>
            
            <div class="cta-features flex flex-wrap justify-center gap-4 mb-8" data-aos="fade-up" data-aos-delay="300">
                <div class="cta-feature inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full font-medium">
                    <i class="fas fa-check-circle"></i>
                    <span><?php esc_html_e('Free Assessment', 'quezon-care'); ?></span>
                </div>
                <div class="cta-feature inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full font-medium">
                    <i class="fas fa-check-circle"></i>
                    <span><?php esc_html_e('No Obligation', 'quezon-care'); ?></span>
                </div>
                <div class="cta-feature inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full font-medium">
                    <i class="fas fa-check-circle"></i>
                    <span><?php esc_html_e('Response Within 24 Hours', 'quezon-care'); ?></span>
                </div>
            </div>
            
            <div class="hero-buttons flex flex-wrap justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="hero-btn inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-xl hover:shadow-blue-500/50 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Free Consultation', 'quezon-care'); ?>
                </a>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="inline-flex items-center gap-2 bg-white border-2 border-gray-200 text-gray-800 px-8 py-4 rounded-2xl font-semibold text-lg shadow-lg hover:shadow-xl hover:border-blue-300 transition-all duration-300">
                    <i class="fas fa-phone-alt text-blue-600"></i>
                    <?php echo esc_html($phone); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
