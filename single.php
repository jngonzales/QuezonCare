<?php
/**
 * Single Post Template
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php esc_html_e('Blog', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php the_title(); ?></span>
        </div>
    </div>
</div>

<!-- Post Content -->
<section class="section">
    <div class="container">
        <div class="service-detail-grid">
            <!-- Main Content -->
            <article id="post-<?php the_ID(); ?>" <?php post_class('service-content'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-featured-image">
                        <?php the_post_thumbnail('hero-image'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="post-meta" style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem; color: var(--text-light); font-size: 0.95rem;">
                    <span><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                    <span><i class="fas fa-user"></i> <?php the_author(); ?></span>
                    <?php if (has_category()) : ?>
                        <span><i class="fas fa-folder"></i> <?php the_category(', '); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="post-content" style="font-size: 1.1rem; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
                
                <?php if (has_tag()) : ?>
                    <div class="post-tags" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                        <strong><?php esc_html_e('Tags:', 'quezon-care'); ?></strong>
                        <?php the_tags(' ', ', ', ''); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Post Navigation -->
                <div class="post-navigation" style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between;">
                    <div>
                        <?php previous_post_link('%link', '<i class="fas fa-arrow-left"></i> %title'); ?>
                    </div>
                    <div>
                        <?php next_post_link('%link', '%title <i class="fas fa-arrow-right"></i>'); ?>
                    </div>
                </div>
                
                <?php
                // Comments
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article>
            
            <!-- Sidebar -->
            <aside class="service-sidebar">
                <!-- Search -->
                <div class="sidebar-card">
                    <h3><?php esc_html_e('Search', 'quezon-care'); ?></h3>
                    <?php get_search_form(); ?>
                </div>
                
                <!-- Categories -->
                <?php if (get_categories()) : ?>
                    <div class="sidebar-card">
                        <h3><?php esc_html_e('Categories', 'quezon-care'); ?></h3>
                        <ul style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <?php
                            $categories = get_categories();
                            foreach ($categories as $category) :
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" style="color: var(--text-medium); display: flex; justify-content: space-between;">
                                        <?php echo esc_html($category->name); ?>
                                        <span>(<?php echo esc_html($category->count); ?>)</span>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <!-- Recent Posts -->
                <div class="sidebar-card">
                    <h3><?php esc_html_e('Recent Posts', 'quezon-care'); ?></h3>
                    <div class="related-services">
                        <?php
                        $recent_posts = new WP_Query(array(
                            'posts_per_page' => 3,
                            'post__not_in'   => array(get_the_ID()),
                        ));
                        
                        if ($recent_posts->have_posts()) :
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="related-service-card">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('thumbnail', array('style' => 'width: 50px; height: 50px; object-fit: cover; border-radius: 8px;')); ?>
                                    <?php endif; ?>
                                    <div>
                                        <h4 style="font-size: 0.95rem;"><?php the_title(); ?></h4>
                                        <span><?php echo get_the_date(); ?></span>
                                    </div>
                                </a>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                
                <!-- CTA Card -->
                <div class="sidebar-card" style="background: var(--primary-color); color: var(--bg-white);">
                    <h3 style="color: var(--bg-white); border-color: rgba(255,255,255,0.2);"><?php esc_html_e('Need Care Services?', 'quezon-care'); ?></h3>
                    <p style="color: rgba(255,255,255,0.9);"><?php esc_html_e('Book a free consultation with our care coordinator.', 'quezon-care'); ?></p>
                    <a href="<?php echo esc_url(home_url('/book-consultation/')); ?>" class="btn btn-white" style="width: 100%;">
                        <i class="fas fa-calendar-check"></i>
                        <?php esc_html_e('Book Now', 'quezon-care'); ?>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
