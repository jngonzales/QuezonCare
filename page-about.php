<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * About us page template
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><?php esc_html_e('About Us', 'quezon-care'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php esc_html_e('About Us', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- About Section -->
<section class="about-section section about-page">
    <div class="container">
        <div class="about-grid">
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&h=600&fit=crop" alt="<?php esc_attr_e('Our caring team', 'quezon-care'); ?>">
                <div class="about-experience">
                    <span class="years">10+</span>
                    <span><?php esc_html_e('Years of Excellence', 'quezon-care'); ?></span>
                </div>
            </div>
            
            <div class="about-content">
                <span class="section-label"><?php esc_html_e('Our Story', 'quezon-care'); ?></span>
                <h2><?php esc_html_e('Caring for Your Loved Ones Like Family', 'quezon-care'); ?></h2>
                <p><?php esc_html_e('Quezon Home Care was founded with a simple mission: to provide exceptional, compassionate care that allows seniors and individuals with health challenges to live safely and comfortably in their own homes.', 'quezon-care'); ?></p>
                <p><?php esc_html_e('We understand that choosing a care provider is one of the most important decisions a family can make. That\'s why we\'ve built our agency on a foundation of trust, professionalism, and genuine care for the people we serve.', 'quezon-care'); ?></p>
                
                <div class="about-features" style="margin-top: 2rem;">
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('Licensed Professionals', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('All RNs and LPNs are fully licensed and verified', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('Rigorous Screening', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Comprehensive background checks for your peace of mind', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('Personalized Care', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Custom care plans tailored to individual needs', 'quezon-care'); ?></p>
                        </div>
                    </div>
                    
                    <div class="about-feature">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4><?php esc_html_e('24/7 Support', 'quezon-care'); ?></h4>
                            <p><?php esc_html_e('Round-the-clock assistance whenever you need it', 'quezon-care'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?php esc_html_e('Our Values', 'quezon-care'); ?></span>
            <h2><?php esc_html_e('What Drives Us Every Day', 'quezon-care'); ?></h2>
        </div>
        
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3><?php esc_html_e('Compassion', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('We treat every client with the same love and respect we would show our own family members.', 'quezon-care'); ?></p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3><?php esc_html_e('Excellence', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('We strive for the highest standards in everything we do, from hiring to daily care delivery.', 'quezon-care'); ?></p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3><?php esc_html_e('Integrity', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('We operate with complete transparency and honesty in all our interactions with families.', 'quezon-care'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); color: var(--bg-white);">
    <div class="container">
        <div class="hero-stats" style="justify-content: center; gap: 6rem; border: none; padding: 0;">
            <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label"><?php esc_html_e('Families Served', 'quezon-care'); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label"><?php esc_html_e('Care Specialists', 'quezon-care'); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number">10+</span>
                <span class="stat-label"><?php esc_html_e('Years Experience', 'quezon-care'); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number">4.9</span>
                <span class="stat-label"><?php esc_html_e('Client Rating', 'quezon-care'); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section">
    <div class="container">
        <div class="cta-box">
            <h2><?php esc_html_e('Ready to Experience Our Care?', 'quezon-care'); ?></h2>
            <p><?php esc_html_e('Book a free consultation today and discover how we can help your family.', 'quezon-care'); ?></p>
            
            <div class="hero-buttons" style="justify-content: center;">
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Free Consultation', 'quezon-care'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-outline btn-lg">
                    <?php esc_html_e('Contact Us', 'quezon-care'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
