<?php
/**
 * Template Name: Our Team
 * Description: Display staff/nurses directory
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Hero Section -->
<section class="page-hero bg-gradient-to-r from-blue-600/90 to-teal-600/90 text-white py-32 -mt-24 pt-40 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-teal-500 opacity-90"></div>
    <div class="container max-w-7xl mx-auto px-4 md:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up"><?php esc_html_e('Meet Our Care Team', 'quezon-care'); ?></h1>
        <p class="text-white/90 text-lg max-w-xl mx-auto mb-4" data-aos="fade-up" data-aos-delay="100"><?php esc_html_e('Dedicated professionals committed to providing exceptional home care', 'quezon-care'); ?></p>
        <nav class="breadcrumb flex justify-center gap-2 text-white/80" data-aos="fade-up" data-aos-delay="200">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span class="separator">/</span>
            <span class="current text-white"><?php esc_html_e('Our Team', 'quezon-care'); ?></span>
        </nav>
    </div>
</section>

<!-- Team Intro Section -->
<section class="section section-alt py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="section-header text-center mb-12" data-aos="fade-up">
            <span class="section-label inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4"><?php esc_html_e('Professional Caregivers', 'quezon-care'); ?></span>
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-4"><?php esc_html_e('Licensed, Experienced & Compassionate', 'quezon-care'); ?></h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto"><?php esc_html_e('Every member of our team is carefully selected, thoroughly vetted, and continuously trained to provide the highest quality of care.', 'quezon-care'); ?></p>
        </div>
        
        <div class="team-stats grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-item glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-2xl p-6 text-center shadow-lg" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-number text-4xl font-bold text-blue-600 mb-1" data-count="50">50+</div>
                <div class="stat-label text-gray-600 text-sm"><?php esc_html_e('Care Professionals', 'quezon-care'); ?></div>
            </div>
            <div class="stat-item glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-2xl p-6 text-center shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number text-4xl font-bold text-blue-600 mb-1" data-count="100">100%</div>
                <div class="stat-label text-gray-600 text-sm"><?php esc_html_e('Licensed & Verified', 'quezon-care'); ?></div>
            </div>
            <div class="stat-item glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-2xl p-6 text-center shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number text-4xl font-bold text-blue-600 mb-1" data-count="10">10+</div>
                <div class="stat-label text-gray-600 text-sm"><?php esc_html_e('Years Avg Experience', 'quezon-care'); ?></div>
            </div>
            <div class="stat-item glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-2xl p-6 text-center shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number text-4xl font-bold text-blue-600 mb-1">4.9</div>
                <div class="stat-label text-gray-600 text-sm"><?php esc_html_e('Average Rating', 'quezon-care'); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Staff Directory -->
<section class="section staff-section py-20 bg-white">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="section-header text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-3"><?php esc_html_e('Our Healthcare Professionals', 'quezon-care'); ?></h2>
            <p class="text-gray-600 text-lg"><?php esc_html_e('Get to know the caring individuals who will be supporting your family', 'quezon-care'); ?></p>
        </div>
        
        <?php
        $staff_query = new WP_Query(array(
            'post_type'      => 'staff',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ));
        
        $staff_index = 0;
        if ($staff_query->have_posts()) : ?>
            <div class="staff-grid">
                <?php while ($staff_query->have_posts()) : $staff_query->the_post();
                    $title = get_post_meta(get_the_ID(), '_staff_title', true);
                    $license = get_post_meta(get_the_ID(), '_staff_license', true);
                    $experience = get_post_meta(get_the_ID(), '_staff_experience', true);
                    $specialties = get_post_meta(get_the_ID(), '_staff_specialties', true);
                    $image = get_post_meta(get_the_ID(), '_staff_image', true);
                    $rating = get_post_meta(get_the_ID(), '_staff_rating', true);
                    $staff_delay = $staff_index * 100;
                    $reviews = get_post_meta(get_the_ID(), '_staff_reviews', true);
                    $available = get_post_meta(get_the_ID(), '_staff_available', true);
                    
                    // Default image if not set
                    if (empty($image)) {
                        $image = 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face';
                    }
                    ?>
                    <div class="staff-card <?php echo $available === 'yes' ? 'available' : 'unavailable'; ?>" data-aos="fade-up" data-aos-delay="<?php echo $staff_delay; ?>">
                        <div class="staff-image">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            <?php if ($available === 'yes') : ?>
                                <span class="availability-badge available"><?php esc_html_e('Available', 'quezon-care'); ?></span>
                            <?php else : ?>
                                <span class="availability-badge unavailable"><?php esc_html_e('Fully Booked', 'quezon-care'); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="staff-info">
                            <h3><?php the_title(); ?></h3>
                            <?php if ($title) : ?>
                                <p class="staff-title"><?php echo esc_html($title); ?></p>
                            <?php endif; ?>
                            
                            <div class="staff-rating">
                                <div class="stars">
                                    <?php 
                                    $rating_num = floatval($rating);
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= floor($rating_num)) {
                                            echo '<i class="fas fa-star"></i>';
                                        } elseif ($i - 0.5 <= $rating_num) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <span class="rating-text"><?php echo esc_html($rating); ?> (<?php echo esc_html($reviews); ?> reviews)</span>
                            </div>
                            
                            <div class="staff-meta">
                                <?php if ($experience) : ?>
                                    <div class="meta-item">
                                        <i class="fas fa-briefcase"></i>
                                        <span><?php echo esc_html($experience); ?> experience</span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($license) : ?>
                                    <div class="meta-item">
                                        <i class="fas fa-id-card"></i>
                                        <span><?php echo esc_html($license); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($specialties) : ?>
                                <div class="staff-specialties">
                                    <?php 
                                    $specialty_arr = array_map('trim', explode(',', $specialties));
                                    foreach ($specialty_arr as $specialty) : ?>
                                        <span class="specialty-tag"><?php echo esc_html($specialty); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="staff-bio">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <?php if ($available === 'yes') : ?>
                                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-sm">
                                    <?php esc_html_e('Request This Caregiver', 'quezon-care'); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-secondary btn-sm">
                                    <?php esc_html_e('Join Waitlist', 'quezon-care'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php 
                    $staff_index++;
                endwhile; ?>
            </div>
        <?php else : ?>
            <div class="no-staff-message">
                <i class="fas fa-users"></i>
                <h3><?php esc_html_e('Our Team is Growing', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('We are currently updating our staff directory. Please check back soon or contact us directly.', 'quezon-care'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary"><?php esc_html_e('Contact Us', 'quezon-care'); ?></a>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>

<!-- Why Our Team Section -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?php esc_html_e('Quality Assurance', 'quezon-care'); ?></span>
            <h2><?php esc_html_e('Why Our Caregivers Stand Out', 'quezon-care'); ?></h2>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <h3><?php esc_html_e('Rigorous Screening', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('Every caregiver undergoes thorough background checks, reference verification, and skills assessment before joining our team.', 'quezon-care'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3><?php esc_html_e('Continuous Training', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('Our team participates in ongoing education programs to stay current with the latest care techniques and best practices.', 'quezon-care'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3><?php esc_html_e('Licensed Professionals', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('All nurses hold valid PRC licenses and our companion caregivers are certified in their respective specializations.', 'quezon-care'); ?></p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3><?php esc_html_e('Compassion First', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('Beyond skills and qualifications, we select caregivers who genuinely care about making a difference in peoples lives.', 'quezon-care'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Join Our Team CTA -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-box">
            <h2><?php esc_html_e('Join Our Team of Caregivers', 'quezon-care'); ?></h2>
            <p><?php esc_html_e('Are you a licensed nurse or experienced caregiver looking for rewarding work? We are always looking for compassionate professionals to join our team.', 'quezon-care'); ?></p>
            <div class="hero-buttons" style="justify-content: center;">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-white btn-lg">
                    <i class="fas fa-envelope"></i>
                    <?php esc_html_e('Apply Now', 'quezon-care'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
