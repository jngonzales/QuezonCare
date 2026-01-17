<?php
/**
 * Header Template
 *
 * @package Quezon_Care
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Tailwind CSS CDN (must load before config) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind CSS Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#0077B6',
                        'primary-dark': '#005A8D',
                        'primary-light': '#00B4D8',
                        'accent': '#FF6B35',
                    },
                    boxShadow: {
                        'glass': '0 8px 32px rgba(0, 0, 0, 0.08)',
                        'glass-hover': '0 16px 48px rgba(0, 0, 0, 0.12)',
                        'glow': '0 0 40px rgba(0, 119, 182, 0.3)',
                    },
                    backdropBlur: {
                        'glass': '20px',
                    }
                }
            }
        }
    </script>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to main content for accessibility -->
<a class="skip-link sr-only" href="#main-content"><?php esc_html_e('Skip to main content', 'quezon-care'); ?></a>

<!-- Mobile Menu Overlay -->
<div class="mobile-overlay" id="mobile-overlay"></div>

<!-- Site Header -->
<header class="site-header" id="site-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="site-logo-text">Quezon<span>Care</span></span>
            <?php endif; ?>
        </a>
        
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle navigation menu', 'quezon-care'); ?>" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <!-- Main Navigation -->
        <nav class="main-nav" id="main-nav" role="navigation" aria-label="<?php esc_attr_e('Primary navigation', 'quezon-care'); ?>">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'walker'         => new Quezon_Care_Nav_Walker(),
                ));
            } else {
                // Default menu items if no menu is set
                ?>
                <ul class="nav-menu">
                    <li class="<?php echo is_front_page() ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
                    </li>
                    <li class="<?php echo is_post_type_archive('service') || is_singular('service') ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php esc_html_e('Services', 'quezon-care'); ?></a>
                    </li>
                    <li class="<?php echo is_page('about') ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('About Us', 'quezon-care'); ?></a>
                    </li>
                    <li class="<?php echo is_page('contact') ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact', 'quezon-care'); ?></a>
                    </li>
                </ul>
                <?php
            }
            ?>
            
            <!-- Header CTA -->
            <div class="header-cta">
                <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i>
                    <?php esc_html_e('Book Free Consultation', 'quezon-care'); ?>
                </a>
            </div>
        </nav>
    </div>
</header>

<!-- Main Content Wrapper -->
<main id="main-content" class="site-main">
