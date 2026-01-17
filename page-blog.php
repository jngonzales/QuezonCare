<?php
/**
 * Template Name: Blog
 * Description: Blog listing page with sidebar
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Hero Section -->
<section class="page-hero bg-gradient-to-r from-blue-600/90 to-teal-600/90 text-white py-32 -mt-24 pt-40 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-teal-500 opacity-90"></div>
    <div class="container max-w-7xl mx-auto px-4 md:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up"><?php esc_html_e('Care Tips & Resources', 'quezon-care'); ?></h1>
        <p class="text-white/90 text-lg max-w-xl mx-auto mb-4" data-aos="fade-up" data-aos-delay="100"><?php esc_html_e('Expert advice, health tips, and caregiving resources for families', 'quezon-care'); ?></p>
        <nav class="breadcrumb flex justify-center gap-2 text-white/80" data-aos="fade-up" data-aos-delay="200">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span class="separator">/</span>
            <span class="current text-white"><?php esc_html_e('Blog', 'quezon-care'); ?></span>
        </nav>
    </div>
</section>

<!-- Blog Section -->
<section class="section blog-section py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="container max-w-7xl mx-auto px-4 md:px-8">
        <div class="blog-layout grid lg:grid-cols-4 gap-12">
            <!-- Main Content -->
            <div class="blog-main lg:col-span-3">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                $blog_query = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 6,
                    'paged'          => $paged,
                ));
                
                $blog_index = 0;
                if ($blog_query->have_posts()) : ?>
                    <div class="blog-grid grid md:grid-cols-2 gap-8">
                        <?php while ($blog_query->have_posts()) : $blog_query->the_post(); 
                            $blog_delay = $blog_index * 100;
                        ?>
                            <article class="blog-card glass-card bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $blog_delay; ?>">
                                <div class="blog-image relative h-48 overflow-hidden">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500')); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>"  class="block w-full h-full bg-gradient-to-br from-blue-100 to-teal-100">
                                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=600&h=400&fit=crop" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php 
                                    $categories = get_the_category();
                                    if (!empty($categories)) : ?>
                                        <span class="blog-category"><?php echo esc_html($categories[0]->name); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-date">
                                            <i class="far fa-calendar-alt"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <span class="blog-author">
                                            <i class="far fa-user"></i>
                                            <?php the_author(); ?>
                                        </span>
                                    </div>
                                    
                                    <h2 class="blog-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    
                                    <div class="blog-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php esc_html_e('Read More', 'quezon-care'); ?>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        <?php 
                            $blog_index++;
                        endwhile; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="blog-pagination">
                        <?php
                        echo paginate_links(array(
                            'total'     => $blog_query->max_num_pages,
                            'current'   => $paged,
                            'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'quezon-care'),
                            'next_text' => __('Next', 'quezon-care') . ' <i class="fas fa-chevron-right"></i>',
                        ));
                        ?>
                    </div>
                    
                <?php else : ?>
                    <div class="no-posts-message">
                        <i class="fas fa-newspaper"></i>
                        <h3><?php esc_html_e('No Posts Yet', 'quezon-care'); ?></h3>
                        <p><?php esc_html_e('We are working on bringing you valuable content. Check back soon!', 'quezon-care'); ?></p>
                    </div>
                <?php endif; wp_reset_postdata(); ?>
            </div>
            
            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Search Widget -->
                <div class="sidebar-widget search-widget">
                    <h4><?php esc_html_e('Search', 'quezon-care'); ?></h4>
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-form">
                            <input type="search" name="s" placeholder="<?php esc_attr_e('Search articles...', 'quezon-care'); ?>" value="<?php echo get_search_query(); ?>">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                
                <!-- Categories Widget -->
                <div class="sidebar-widget categories-widget">
                    <h4><?php esc_html_e('Categories', 'quezon-care'); ?></h4>
                    <ul class="category-list">
                        <?php
                        $categories = get_categories(array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'hide_empty' => true,
                        ));
                        
                        foreach ($categories as $category) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                    <?php echo esc_html($category->name); ?>
                                    <span class="count"><?php echo esc_html($category->count); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Recent Posts Widget -->
                <div class="sidebar-widget recent-posts-widget">
                    <h4><?php esc_html_e('Recent Posts', 'quezon-care'); ?></h4>
                    <ul class="recent-posts-list">
                        <?php
                        $recent_posts = new WP_Query(array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                        ));
                        
                        while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                            <li class="recent-post-item">
                                <div class="recent-post-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=80&h=80&fit=crop" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="recent-post-content">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <span class="recent-post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
                
                <!-- CTA Widget -->
                <div class="sidebar-widget cta-widget">
                    <h4><?php esc_html_e('Need Care Assistance?', 'quezon-care'); ?></h4>
                    <p><?php esc_html_e('Our care coordinators are ready to help you find the perfect care solution for your family.', 'quezon-care'); ?></p>
                    <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-primary btn-block">
                        <?php esc_html_e('Free Consultation', 'quezon-care'); ?>
                    </a>
                    <div class="cta-phone">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:+63281234567">+63 (02) 8123-4567</a>
                    </div>
                </div>
                
                <!-- Tags Widget -->
                <div class="sidebar-widget tags-widget">
                    <h4><?php esc_html_e('Popular Topics', 'quezon-care'); ?></h4>
                    <div class="tag-cloud">
                        <?php
                        $tags = get_tags(array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
                            'number'  => 10,
                        ));
                        
                        if (!empty($tags)) :
                            foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-link">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach;
                        else :
                            // Default tags if none exist
                            $default_tags = array('Elderly Care', 'Dementia', 'Caregiving', 'Health Tips', 'Family Support');
                            foreach ($default_tags as $tag) : ?>
                                <span class="tag-link"><?php echo esc_html($tag); ?></span>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="section section-alt newsletter-section">
    <div class="container">
        <div class="newsletter-box">
            <div class="newsletter-content">
                <i class="fas fa-envelope-open-text"></i>
                <h3><?php esc_html_e('Subscribe to Our Newsletter', 'quezon-care'); ?></h3>
                <p><?php esc_html_e('Get the latest caregiving tips, health advice, and resources delivered to your inbox.', 'quezon-care'); ?></p>
            </div>
            <form class="newsletter-form" action="#" method="post">
                <input type="email" name="email" placeholder="<?php esc_attr_e('Enter your email address', 'quezon-care'); ?>" required>
                <button type="submit" class="btn btn-primary">
                    <?php esc_html_e('Subscribe', 'quezon-care'); ?>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
