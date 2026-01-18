<?php
/**
 * Internationalization (i18n) & Language Switcher for Quezon Care Theme
 * 
 * Provides multi-language support with English/Spanish switcher
 * Works with or without WPML/Polylang plugins
 *
 * @package Quezon_Care
 * @since 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define available languages
 */
define('QUEZON_CARE_LANGUAGES', array(
    'en' => array(
        'name'   => 'English',
        'native' => 'English',
        'flag'   => '🇺🇸',
        'locale' => 'en_US',
    ),
    'es' => array(
        'name'   => 'Spanish',
        'native' => 'Español',
        'flag'   => '🇪🇸',
        'locale' => 'es_ES',
    ),
    'zh' => array(
        'name'   => 'Chinese',
        'native' => '中文',
        'flag'   => '🇨🇳',
        'locale' => 'zh_CN',
    ),
));

/**
 * Check if WPML is active
 */
function quezon_care_is_wpml_active() {
    return defined('ICL_SITEPRESS_VERSION');
}

/**
 * Check if Polylang is active
 */
function quezon_care_is_polylang_active() {
    return function_exists('pll_current_language');
}

/**
 * Load theme textdomain for translations
 */
function quezon_care_load_textdomain() {
    load_theme_textdomain('quezon-care', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'quezon_care_load_textdomain');

/**
 * Get current language code
 */
function quezon_care_get_current_language() {
    // Check WPML first
    if (quezon_care_is_wpml_active()) {
        return ICL_LANGUAGE_CODE;
    }
    
    // Check Polylang
    if (quezon_care_is_polylang_active()) {
        return pll_current_language();
    }
    
    // Fallback to session/cookie based language
    if (isset($_COOKIE['quezon_care_lang'])) {
        $lang = sanitize_text_field($_COOKIE['quezon_care_lang']);
        $available = array_keys(QUEZON_CARE_LANGUAGES);
        if (in_array($lang, $available)) {
            return $lang;
        }
    }
    
    // Default to English
    return 'en';
}

/**
 * Set language via cookie (for custom language switcher)
 */
function quezon_care_set_language() {
    if (isset($_GET['lang'])) {
        $lang = sanitize_text_field($_GET['lang']);
        $available = array_keys(QUEZON_CARE_LANGUAGES);
        
        if (in_array($lang, $available)) {
            setcookie('quezon_care_lang', $lang, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
            
            // If not using WPML/Polylang, redirect to remove query string
            if (!quezon_care_is_wpml_active() && !quezon_care_is_polylang_active()) {
                $redirect_url = remove_query_arg('lang');
                wp_safe_redirect($redirect_url);
                exit;
            }
        }
    }
}
add_action('init', 'quezon_care_set_language', 1);

/**
 * Load locale based on selected language
 */
function quezon_care_switch_locale($locale) {
    $lang = quezon_care_get_current_language();
    $languages = QUEZON_CARE_LANGUAGES;
    
    if (isset($languages[$lang])) {
        return $languages[$lang]['locale'];
    }
    
    return $locale;
}
// Only apply custom locale filter if not using WPML/Polylang
function quezon_care_maybe_switch_locale() {
    if (!quezon_care_is_wpml_active() && !quezon_care_is_polylang_active()) {
        add_filter('locale', 'quezon_care_switch_locale');
    }
}
add_action('init', 'quezon_care_maybe_switch_locale', 2);

/**
 * Get language switcher HTML
 */
function quezon_care_language_switcher($args = array()) {
    $defaults = array(
        'style'         => 'dropdown', // dropdown, inline, flags
        'show_flags'    => true,
        'show_names'    => true,
        'show_native'   => false,
        'class'         => '',
    );
    
    $args = wp_parse_args($args, $defaults);
    $current_lang = quezon_care_get_current_language();
    $languages = QUEZON_CARE_LANGUAGES;
    
    $output = '';
    
    // If using WPML
    if (quezon_care_is_wpml_active()) {
        $output = do_shortcode('[wpml_language_selector_widget]');
        return $output;
    }
    
    // If using Polylang
    if (quezon_care_is_polylang_active() && function_exists('pll_the_languages')) {
        ob_start();
        pll_the_languages(array(
            'show_flags' => $args['show_flags'],
            'show_names' => $args['show_names'],
        ));
        return ob_get_clean();
    }
    
    // Custom language switcher
    $current = isset($languages[$current_lang]) ? $languages[$current_lang] : $languages['en'];
    
    switch ($args['style']) {
        case 'dropdown':
            $output = quezon_care_dropdown_switcher($current_lang, $languages, $args);
            break;
        case 'inline':
            $output = quezon_care_inline_switcher($current_lang, $languages, $args);
            break;
        case 'flags':
            $output = quezon_care_flags_switcher($current_lang, $languages, $args);
            break;
        default:
            $output = quezon_care_dropdown_switcher($current_lang, $languages, $args);
    }
    
    return $output;
}

/**
 * Dropdown style language switcher
 */
function quezon_care_dropdown_switcher($current_lang, $languages, $args) {
    $current = $languages[$current_lang];
    $current_url = home_url(add_query_arg(array()));
    
    $output = '<div class="language-switcher language-dropdown relative ' . esc_attr($args['class']) . '">';
    $output .= '<button type="button" class="lang-toggle flex items-center gap-2 px-3 py-2 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 text-gray-700 hover:bg-white/20 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500" aria-expanded="false" aria-haspopup="true">';
    
    if ($args['show_flags']) {
        $output .= '<span class="lang-flag text-lg">' . $current['flag'] . '</span>';
    }
    if ($args['show_names']) {
        $name = $args['show_native'] ? $current['native'] : $current['name'];
        $output .= '<span class="lang-name text-sm font-medium">' . esc_html($name) . '</span>';
    }
    $output .= '<i class="fas fa-chevron-down text-xs transition-transform"></i>';
    $output .= '</button>';
    
    $output .= '<ul class="lang-menu absolute top-full right-0 mt-2 py-2 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible translate-y-2 transition-all z-50 min-w-[140px]">';
    
    foreach ($languages as $code => $lang) {
        $url = add_query_arg('lang', $code, $current_url);
        $active = $code === $current_lang ? ' active' : '';
        
        $output .= '<li class="lang-item' . $active . '">';
        $output .= '<a href="' . esc_url($url) . '" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-50 transition-colors' . ($active ? ' bg-blue-50 text-blue-600' : ' text-gray-700') . '">';
        
        if ($args['show_flags']) {
            $output .= '<span class="lang-flag text-lg">' . $lang['flag'] . '</span>';
        }
        if ($args['show_names']) {
            $name = $args['show_native'] ? $lang['native'] : $lang['name'];
            $output .= '<span class="lang-name text-sm">' . esc_html($name) . '</span>';
        }
        if ($active) {
            $output .= '<i class="fas fa-check text-xs ml-auto"></i>';
        }
        
        $output .= '</a></li>';
    }
    
    $output .= '</ul>';
    $output .= '</div>';
    
    return $output;
}

/**
 * Inline style language switcher
 */
function quezon_care_inline_switcher($current_lang, $languages, $args) {
    $current_url = home_url(add_query_arg(array()));
    
    $output = '<ul class="language-switcher language-inline flex items-center gap-2 ' . esc_attr($args['class']) . '">';
    
    foreach ($languages as $code => $lang) {
        $url = add_query_arg('lang', $code, $current_url);
        $active = $code === $current_lang;
        $class = $active ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600';
        
        $output .= '<li class="lang-item">';
        $output .= '<a href="' . esc_url($url) . '" class="flex items-center gap-1 px-2 py-1 rounded transition-colors ' . $class . '">';
        
        if ($args['show_flags']) {
            $output .= '<span class="lang-flag">' . $lang['flag'] . '</span>';
        }
        if ($args['show_names']) {
            $output .= '<span class="lang-code text-sm uppercase">' . esc_html($code) . '</span>';
        }
        
        $output .= '</a></li>';
        
        // Add separator except for last item
        if ($code !== array_key_last($languages)) {
            $output .= '<li class="text-gray-300">|</li>';
        }
    }
    
    $output .= '</ul>';
    
    return $output;
}

/**
 * Flags only style language switcher
 */
function quezon_care_flags_switcher($current_lang, $languages, $args) {
    $current_url = home_url(add_query_arg(array()));
    
    $output = '<ul class="language-switcher language-flags flex items-center gap-1 ' . esc_attr($args['class']) . '">';
    
    foreach ($languages as $code => $lang) {
        $url = add_query_arg('lang', $code, $current_url);
        $active = $code === $current_lang;
        $class = $active ? 'ring-2 ring-blue-500 ring-offset-2' : 'opacity-70 hover:opacity-100';
        
        $output .= '<li class="lang-item">';
        $output .= '<a href="' . esc_url($url) . '" class="block text-2xl rounded transition-all ' . $class . '" title="' . esc_attr($lang['name']) . '">';
        $output .= $lang['flag'];
        $output .= '</a></li>';
    }
    
    $output .= '</ul>';
    
    return $output;
}

/**
 * Add language switcher to nav menu
 */
function quezon_care_add_language_to_menu($items, $args) {
    if ($args->theme_location !== 'primary') {
        return $items;
    }
    
    $switcher = quezon_care_language_switcher(array(
        'style'      => 'dropdown',
        'show_flags' => true,
        'show_names' => true,
        'class'      => 'ml-4',
    ));
    
    $items .= '<li class="menu-item language-menu-item">' . $switcher . '</li>';
    
    return $items;
}
add_filter('wp_nav_menu_items', 'quezon_care_add_language_to_menu', 20, 2);

/**
 * Add language switcher JavaScript
 */
function quezon_care_language_switcher_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Language dropdown toggle - using 'active' class
        const langSwitchers = document.querySelectorAll('.language-dropdown');
        
        langSwitchers.forEach(function(switcher) {
            const toggle = switcher.querySelector('.lang-toggle');
            const menu = switcher.querySelector('.lang-menu');
            const chevron = toggle ? toggle.querySelector('.fa-chevron-down') : null;
            
            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isOpen = switcher.classList.contains('active');
                    
                    // Close all other dropdowns first
                    document.querySelectorAll('.language-dropdown').forEach(function(s) {
                        s.classList.remove('active');
                    });
                    
                    // Toggle current dropdown
                    if (!isOpen) {
                        switcher.classList.add('active');
                        toggle.setAttribute('aria-expanded', 'true');
                    } else {
                        switcher.classList.remove('active');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.language-dropdown')) {
                document.querySelectorAll('.language-dropdown').forEach(function(switcher) {
                    switcher.classList.remove('active');
                    const toggle = switcher.querySelector('.lang-toggle');
                    if (toggle) toggle.setAttribute('aria-expanded', 'false');
                });
            }
        });
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.language-dropdown').forEach(function(switcher) {
                    switcher.classList.remove('active');
                    const toggle = switcher.querySelector('.lang-toggle');
                    if (toggle) toggle.setAttribute('aria-expanded', 'false');
                });
            }
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'quezon_care_language_switcher_script');

/**
 * Shortcode for language switcher
 */
function quezon_care_language_switcher_shortcode($atts) {
    $atts = shortcode_atts(array(
        'style'       => 'dropdown',
        'show_flags'  => 'true',
        'show_names'  => 'true',
        'show_native' => 'false',
        'class'       => '',
    ), $atts);
    
    return quezon_care_language_switcher(array(
        'style'       => $atts['style'],
        'show_flags'  => $atts['show_flags'] === 'true',
        'show_names'  => $atts['show_names'] === 'true',
        'show_native' => $atts['show_native'] === 'true',
        'class'       => $atts['class'],
    ));
}
add_shortcode('language_switcher', 'quezon_care_language_switcher_shortcode');

/**
 * Get translated string with fallback
 */
function quezon_care_translate($string, $translations = array()) {
    $current_lang = quezon_care_get_current_language();
    
    // If translation exists for current language, return it
    if (isset($translations[$current_lang])) {
        return $translations[$current_lang];
    }
    
    // Fallback to default string
    return $string;
}

/**
 * Common translated strings
 */
function quezon_care_get_translations() {
    return array(
        'book_consultation' => array(
            'en' => 'Book Free Consultation',
            'es' => 'Reservar Consulta Gratis',
            'zh' => '预约免费咨询',
        ),
        'learn_more' => array(
            'en' => 'Learn More',
            'es' => 'Más Información',
            'zh' => '了解更多',
        ),
        'contact_us' => array(
            'en' => 'Contact Us',
            'es' => 'Contáctenos',
            'zh' => '联系我们',
        ),
        'our_services' => array(
            'en' => 'Our Services',
            'es' => 'Nuestros Servicios',
            'zh' => '我们的服务',
        ),
        'about_us' => array(
            'en' => 'About Us',
            'es' => 'Sobre Nosotros',
            'zh' => '关于我们',
        ),
        'home' => array(
            'en' => 'Home',
            'es' => 'Inicio',
            'zh' => '首页',
        ),
        'call_now' => array(
            'en' => 'Call Now',
            'es' => 'Llamar Ahora',
            'zh' => '立即致电',
        ),
        'read_more' => array(
            'en' => 'Read More',
            'es' => 'Leer Más',
            'zh' => '阅读更多',
        ),
        'view_all' => array(
            'en' => 'View All',
            'es' => 'Ver Todo',
            'zh' => '查看全部',
        ),
    );
}

/**
 * Helper function to get a translated string
 */
function __qc($key) {
    $translations = quezon_care_get_translations();
    $current_lang = quezon_care_get_current_language();
    
    if (isset($translations[$key][$current_lang])) {
        return $translations[$key][$current_lang];
    }
    
    // Fallback to English
    if (isset($translations[$key]['en'])) {
        return $translations[$key]['en'];
    }
    
    // Last resort - return the key
    return $key;
}

/**
 * Echo translated string
 */
function _eqc($key) {
    echo esc_html(__qc($key));
}
