<?php
/**
 * Index Template (Fallback)
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><?php esc_html_e('Latest Updates', 'quezon-care'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php esc_html_e('Blog', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2rem;">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('service-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail" style="display: block; margin: -1.5rem -1.5rem 1.5rem; overflow: hidden; border-radius: 12px 12px 0 0;">
                                <?php the_post_thumbnail('service-thumbnail', array('style' => 'width: 100%; height: 200px; object-fit: cover;')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <h3 style="margin-bottom: 0.5rem;">
                            <a href="<?php the_permalink(); ?>" style="color: inherit;"><?php the_title(); ?></a>
                        </h3>
                        
                        <div class="post-meta" style="font-size: 0.875rem; color: var(--text-light); margin-bottom: 1rem;">
                            <span><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                        </div>
                        
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        
                        <a href="<?php the_permalink(); ?>" class="service-link">
                            <?php esc_html_e('Read More', 'quezon-care'); ?>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination" style="margin-top: 3rem; text-align: center;">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ));
                ?>
            </div>
            
        <?php else : ?>
            <div class="no-posts" style="text-align: center; padding: 4rem 0;">
                <h2><?php esc_html_e('No posts found', 'quezon-care'); ?></h2>
                <p><?php esc_html_e('It looks like nothing was found at this location.', 'quezon-care'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Return Home', 'quezon-care'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
