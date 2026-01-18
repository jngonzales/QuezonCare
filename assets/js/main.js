/**
 * Quezon Care Main JavaScript
 * Enhanced with AOS animations & shadcn-style interactions
 *
 * @package Quezon_Care
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initPageLoader();
        initAOSAnimations();
        initMobileMenu();
        initStickyHeader();
        initTestimonialsSlider();
        initSmoothScroll();
        initFormValidation();
        initScrollAnimations();
        initParallaxEffects();
        initCounterAnimation();
        initFaqToggle();
        initBackToTop();
        initImageLazyLoad();
        initCardHoverEffects();
        initShadcnAnimations();
    });

    /**
     * Initialize AOS (Animate on Scroll) Library
     */
    function initAOSAnimations() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
                delay: 50,
                anchorPlacement: 'top-bottom'
            });
        }
    }

    /**
     * Shadcn-style Scroll Animations
     */
    function initShadcnAnimations() {
        const animatedElements = document.querySelectorAll('.shadcn-animate');
        
        if ('IntersectionObserver' in window && animatedElements.length) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fadeInUp');
                        animationObserver.unobserve(entry.target);
                    }
                });
            }, { 
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            animatedElements.forEach(el => animationObserver.observe(el));
        }
    }

    /**
     * Card Hover Effects (shadcn/ui style)
     */
    function initCardHoverEffects() {
        // 3D tilt effect on service cards (exclude legal pages, large content cards, and elements with no-tilt class)
        const cards = document.querySelectorAll('.glass-card:not(.legal-content .glass-card):not(.booking-form-wrapper):not(.no-tilt), .shadcn-card:not(.no-tilt), .service-card:not(.no-tilt)');
        
        cards.forEach(card => {
            // Skip large cards (likely content containers, not UI cards)
            if (card.offsetHeight > 600) return;
            
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
            });
            
            card.addEventListener('mouseleave', function() {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            });
        });

        // Ripple effect on buttons
        const buttons = document.querySelectorAll('.hero-btn, .shadcn-button-primary, .btn-primary');
        
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = button.getBoundingClientRect();
                const ripple = document.createElement('span');
                ripple.className = 'ripple-effect';
                ripple.style.left = `${e.clientX - rect.left}px`;
                ripple.style.top = `${e.clientY - rect.top}px`;
                button.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
    }

    /**
     * Page Load Animation
     */
    function initPageLoader() {
        // Add loaded class to body after page loads
        $(window).on('load', function() {
            $('body').addClass('page-loaded');
        });
        
        // Fallback if load takes too long
        setTimeout(function() {
            $('body').addClass('page-loaded');
        }, 1000);
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        const $backToTop = $('#back-to-top');
        
        if (!$backToTop.length) return;
        
        // Show/hide button based on scroll position
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 500) {
                $backToTop.addClass('visible');
            } else {
                $backToTop.removeClass('visible');
            }
        });
        
        // Scroll to top on click
        $backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 800, 'easeInOutCubic');
        });
    }

    /**
     * Lazy Load Images
     */
    function initImageLazyLoad() {
        const images = document.querySelectorAll('img[loading="lazy"]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            }, { rootMargin: '50px' });
            
            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for older browsers
            images.forEach(img => img.classList.add('loaded'));
        }
    }

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const $toggle = $('#mobile-menu-toggle');
        const $nav = $('#main-nav');
        const $overlay = $('#mobile-overlay');
        const $body = $('body');

        $toggle.on('click', function() {
            $(this).toggleClass('active');
            $nav.toggleClass('active');
            $overlay.toggleClass('active');
            $body.toggleClass('menu-open');
            
            // Update ARIA attribute
            const isExpanded = $(this).hasClass('active');
            $(this).attr('aria-expanded', isExpanded);
        });

        // Close menu when clicking overlay
        $overlay.on('click', function() {
            $toggle.removeClass('active');
            $nav.removeClass('active');
            $overlay.removeClass('active');
            $body.removeClass('menu-open');
            $toggle.attr('aria-expanded', false);
        });

        // Close menu when clicking nav links
        $nav.find('a').on('click', function() {
            if ($(window).width() <= 768) {
                $toggle.removeClass('active');
                $nav.removeClass('active');
                $overlay.removeClass('active');
                $body.removeClass('menu-open');
                $toggle.attr('aria-expanded', false);
            }
        });

        // Close menu on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $nav.hasClass('active')) {
                $toggle.removeClass('active');
                $nav.removeClass('active');
                $overlay.removeClass('active');
                $body.removeClass('menu-open');
                $toggle.attr('aria-expanded', false);
            }
        });
    }

    /**
     * Sticky Header on Scroll
     */
    function initStickyHeader() {
        const $header = $('#site-header');
        const scrollThreshold = 50;

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > scrollThreshold) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        });

        // Trigger on page load
        if ($(window).scrollTop() > scrollThreshold) {
            $header.addClass('scrolled');
        }
    }

    /**
     * Testimonials Slider
     */
    function initTestimonialsSlider() {
        const $slider = $('#testimonials-slider');
        if (!$slider.length) return;

        const $track = $slider.find('.testimonials-track');
        const $cards = $slider.find('.testimonial-card');
        const $dots = $slider.find('.dot');
        
        let currentSlide = 0;
        let autoplayInterval;
        const autoplayDelay = 5000; // 5 seconds

        // Function to go to a specific slide
        function goToSlide(index) {
            if (index < 0) index = $cards.length - 1;
            if (index >= $cards.length) index = 0;
            
            currentSlide = index;
            $track.css('transform', `translateX(-${currentSlide * 100}%)`);
            
            // Update dots
            $dots.removeClass('active');
            $dots.eq(currentSlide).addClass('active');
        }

        // Dot click handler
        $dots.on('click', function() {
            const slideIndex = $(this).data('slide');
            goToSlide(slideIndex);
            resetAutoplay();
        });

        // Autoplay
        function startAutoplay() {
            autoplayInterval = setInterval(function() {
                goToSlide(currentSlide + 1);
            }, autoplayDelay);
        }

        function resetAutoplay() {
            clearInterval(autoplayInterval);
            startAutoplay();
        }

        // Touch/Swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        $slider.on('touchstart', function(e) {
            touchStartX = e.originalEvent.changedTouches[0].screenX;
        });

        $slider.on('touchend', function(e) {
            touchEndX = e.originalEvent.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    goToSlide(currentSlide + 1);
                } else {
                    // Swipe right - previous slide
                    goToSlide(currentSlide - 1);
                }
                resetAutoplay();
            }
        }

        // Pause autoplay on hover
        $slider.on('mouseenter', function() {
            clearInterval(autoplayInterval);
        });

        $slider.on('mouseleave', function() {
            startAutoplay();
        });

        // Start autoplay
        startAutoplay();
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        // Enable smooth scroll behavior on the entire document
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Handle anchor links with offset for fixed header
        $('a[href^="#"], a[href*="/#"]').on('click', function(e) {
            let href = $(this).attr('href');
            let targetId = href;
            
            // Handle links with path + hash (like /page/#section)
            if (href.includes('/#')) {
                targetId = '#' + href.split('/#')[1];
            }
            
            if (targetId === '#' || targetId === '#!' || !targetId) return;
            
            const $target = $(targetId);
            
            if ($target.length) {
                e.preventDefault();
                
                const headerHeight = $('#site-header').outerHeight() || 80;
                const targetOffset = $target.offset().top - headerHeight - 20;
                
                $('html, body').animate({
                    scrollTop: targetOffset
                }, 800, 'easeInOutCubic');
            }
        });
        
        // Add custom easing function
        $.easing.easeInOutCubic = function(x) {
            return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2;
        };
    }

    /**
     * Form Validation Enhancement
     */
    function initFormValidation() {
        // Add visual feedback for required fields
        $('.wpcf7-form-control, .booking-form input, .booking-form select, .booking-form textarea').on('blur', function() {
            const $this = $(this);
            
            if ($this.prop('required') && !$this.val()) {
                $this.addClass('invalid');
            } else {
                $this.removeClass('invalid');
            }
        });

        // Date picker minimum date (today)
        $('input[type="date"]').each(function() {
            const today = new Date().toISOString().split('T')[0];
            $(this).attr('min', today);
        });

        // Phone number formatting
        $('input[type="tel"]').on('input', function() {
            let value = $(this).val().replace(/\D/g, '');
            
            if (value.length > 11) {
                value = value.substr(0, 11);
            }
            
            // Format as Philippine number
            if (value.startsWith('63') && value.length > 2) {
                value = '+' + value.substr(0, 2) + ' ' + value.substr(2);
            } else if (value.startsWith('0') && value.length > 4) {
                value = value.substr(0, 4) + ' ' + value.substr(4);
            }
            
            $(this).val(value);
        });
    }

    /**
     * Animate elements on scroll
     */
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll(
            '.service-card, .about-feature, .trust-badge, .testimonial-card, ' +
            '.section-header, .about-content, .about-image, .hero-stats .stat-item, ' +
            '.booking-form-wrapper, .booking-sidebar, .contact-info-item'
        );
        
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        // Add staggered delay for grid items
                        const parent = entry.target.parentElement;
                        if (parent) {
                            const siblings = Array.from(parent.children);
                            const index = siblings.indexOf(entry.target);
                            entry.target.style.transitionDelay = (index * 0.1) + 's';
                        }
                        
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -80px 0px'
            });

            animatedElements.forEach(function(el) {
                el.classList.add('animate-ready');
                observer.observe(el);
            });
        } else {
            // Fallback for older browsers
            animatedElements.forEach(function(el) {
                el.classList.add('animate-in');
            });
        }
    }
    
    /**
     * Parallax Effects for Hero Section
     */
    function initParallaxEffects() {
        const $hero = $('.hero');
        const $heroImage = $('.hero-image');
        const $floatingCards = $('.hero-floating-card');
        
        if (!$hero.length) return;
        
        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            const heroHeight = $hero.outerHeight();
            
            if (scrollTop < heroHeight) {
                const parallaxRate = scrollTop * 0.3;
                const opacityRate = 1 - (scrollTop / heroHeight);
                
                $heroImage.css({
                    'transform': 'translateY(' + (parallaxRate * 0.5) + 'px)'
                });
                
                $floatingCards.each(function(index) {
                    const rate = parallaxRate * (0.2 + (index * 0.1));
                    $(this).css('transform', 'translateY(' + rate + 'px)');
                });
            }
        });
    }
    
    /**
     * Animated Counters for Stats
     */
    function initCounterAnimation() {
        const $counters = $('.stat-number, .about-experience .years');
        
        if (!$counters.length) return;
        
        const animateCounter = function($el) {
            const text = $el.text();
            const match = text.match(/(\d+)/);
            
            if (!match) return;
            
            const target = parseInt(match[0]);
            const suffix = text.replace(/[\d,]/g, '');
            const duration = 2000;
            const steps = 60;
            const stepTime = duration / steps;
            let current = 0;
            
            const timer = setInterval(function() {
                current += target / steps;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                $el.text(Math.floor(current) + suffix);
            }, stepTime);
        };
        
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter($(entry.target));
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            $counters.each(function() {
                observer.observe(this);
            });
        }
    }

    /**
     * FAQ Toggle for Pricing Page
     */
    function initFaqToggle() {
        const $faqItems = $('.faq-item');
        
        if (!$faqItems.length) return;
        
        $('.faq-question').on('click', function() {
            const $item = $(this).closest('.faq-item');
            const wasActive = $item.hasClass('active');
            
            // Close all other items (accordion behavior)
            $faqItems.removeClass('active');
            
            // Toggle current item
            if (!wasActive) {
                $item.addClass('active');
            }
        });
        
        // Open first FAQ by default
        $faqItems.first().addClass('active');
    }

    // Initialize scroll animations after page load
    $(window).on('load', function() {
        // Add loaded class to body for initial animations
        $('body').addClass('page-loaded');
        
        // Trigger hero animations
        setTimeout(function() {
            $('.hero-content').addClass('animate-in');
            $('.hero-image').addClass('animate-in');
        }, 100);
        
        // Initialize AJAX filtering
        initAjaxFiltering();
        
        // Initialize REST API features
        initRestApiFeatures();
    });

    /**
     * AJAX Filtering for Services & Staff
     * @since 1.1.0
     */
    function initAjaxFiltering() {
        // Service search/filter
        const $serviceSearch = $('#service-search');
        const $serviceCategory = $('#service-category');
        const $servicesGrid = $('#services-grid');
        
        if ($serviceSearch.length || $serviceCategory.length) {
            let searchTimeout;
            
            // Debounced search
            $serviceSearch.on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    filterServices();
                }, 300);
            });
            
            // Category filter
            $serviceCategory.on('change', function() {
                filterServices();
            });
            
            function filterServices() {
                const search = $serviceSearch.val() || '';
                const category = $serviceCategory.val() || '';
                
                $servicesGrid.addClass('loading');
                
                $.ajax({
                    url: quezonCare.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'filter_services',
                        nonce: quezonCare.nonce,
                        search: search,
                        category: category
                    },
                    success: function(response) {
                        if (response.success) {
                            $servicesGrid.html(response.data.html);
                            // Reinitialize AOS for new elements
                            if (typeof AOS !== 'undefined') {
                                AOS.refresh();
                            }
                        }
                    },
                    complete: function() {
                        $servicesGrid.removeClass('loading');
                    }
                });
            }
        }
        
        // Staff filter
        const $staffSpecialty = $('#staff-specialty');
        const $staffAvailable = $('#staff-available');
        const $staffGrid = $('#staff-grid');
        
        if ($staffSpecialty.length || $staffAvailable.length) {
            $staffSpecialty.add($staffAvailable).on('change', function() {
                filterStaff();
            });
            
            function filterStaff() {
                const specialty = $staffSpecialty.val() || '';
                const available = $staffAvailable.val() || '';
                
                $staffGrid.addClass('loading');
                
                $.ajax({
                    url: quezonCare.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'filter_staff',
                        nonce: quezonCare.nonce,
                        specialty: specialty,
                        available: available
                    },
                    success: function(response) {
                        if (response.success) {
                            $staffGrid.html(response.data.html);
                            if (typeof AOS !== 'undefined') {
                                AOS.refresh();
                            }
                        }
                    },
                    complete: function() {
                        $staffGrid.removeClass('loading');
                    }
                });
            }
        }
    }

    /**
     * REST API Features
     * @since 1.1.0
     */
    function initRestApiFeatures() {
        // Pricing Calculator
        const $pricingCalc = $('#pricing-calculator');
        
        if ($pricingCalc.length && typeof quezonCareAPI !== 'undefined') {
            const $service = $('#calc-service');
            const $hours = $('#calc-hours');
            const $days = $('#calc-days');
            const $result = $('#pricing-result');
            
            function calculatePricing() {
                const service = $service.val();
                const hours = parseInt($hours.val()) || 8;
                const days = parseInt($days.val()) || 5;
                
                if (!service) return;
                
                $result.addClass('loading');
                
                $.ajax({
                    url: quezonCareAPI.root + 'pricing/calculate',
                    type: 'POST',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', quezonCareAPI.nonce);
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        service: service,
                        hours_per_day: hours,
                        days_per_week: days
                    }),
                    success: function(response) {
                        if (response.success) {
                            const data = response.data;
                            let html = '<div class="pricing-breakdown">';
                            html += '<div class="price-item"><span>Daily:</span> <strong>' + data.formatted.daily + '</strong></div>';
                            html += '<div class="price-item"><span>Weekly:</span> <strong>' + data.formatted.weekly + '</strong></div>';
                            html += '<div class="price-item total"><span>Monthly:</span> <strong>' + data.formatted.monthly + '</strong></div>';
                            if (data.discount_percent > 0) {
                                html += '<div class="price-discount text-green-600">You save ' + data.discount_percent + '%!</div>';
                            }
                            html += '</div>';
                            $result.html(html);
                        }
                    },
                    complete: function() {
                        $result.removeClass('loading');
                    }
                });
            }
            
            $service.add($hours).add($days).on('change input', function() {
                calculatePricing();
            });
            
            // Initial calculation
            if ($service.val()) {
                calculatePricing();
            }
        }
        
        // Load testimonials via API (for infinite scroll)
        const $testimonialsContainer = $('#testimonials-api');
        
        if ($testimonialsContainer.length && typeof quezonCareAPI !== 'undefined') {
            let page = 1;
            const perPage = 3;
            
            function loadTestimonials() {
                $.ajax({
                    url: quezonCareAPI.root + 'testimonials',
                    type: 'GET',
                    data: {
                        per_page: perPage,
                        page: page
                    },
                    success: function(response) {
                        if (response.success && response.data.length) {
                            response.data.forEach(function(testimonial) {
                                const html = createTestimonialCard(testimonial);
                                $testimonialsContainer.append(html);
                            });
                            
                            if (typeof AOS !== 'undefined') {
                                AOS.refresh();
                            }
                        }
                    }
                });
            }
            
            function createTestimonialCard(testimonial) {
                let stars = '';
                for (let i = 0; i < 5; i++) {
                    stars += i < testimonial.rating ? '<i class="fas fa-star text-yellow-400"></i>' : '<i class="far fa-star text-gray-300"></i>';
                }
                
                return `
                    <div class="testimonial-card glass-card bg-white/80 backdrop-blur-xl rounded-3xl p-8" data-aos="fade-up">
                        <div class="stars mb-4">${stars}</div>
                        <p class="text-gray-600 mb-6">"${testimonial.excerpt}"</p>
                        <div class="flex items-center gap-4">
                            <img src="${testimonial.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(testimonial.client)}" 
                                 alt="${testimonial.client}" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-gray-900">${testimonial.client}</h4>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            // Load more button
            $('#load-more-testimonials').on('click', function() {
                page++;
                loadTestimonials();
            });
        }
    }

})(jQuery);
