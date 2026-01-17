<?php
/**
 * Search Results Template
 *
 * @package Quezon_Care
 */

get_header();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>
            <?php
            printf(
                esc_html__('Search Results for: %s', 'quezon-care'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'quezon-care'); ?></a>
            <span>/</span>
            <span><?php esc_html_e('Search', 'quezon-care'); ?></span>
        </div>
    </div>
</div>

<!-- Search Results -->
<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <p style="margin-bottom: 2rem; color: var(--text-light);">
                <?php
                printf(
                    esc_html(_n('Found %d result', 'Found %d results', $wp_query->found_posts, 'quezon-care')),
                    $wp_query->found_posts
                );
                ?>
            </p>
            
            <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2rem;">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('service-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail" style="display: block; margin: -1.5rem -1.5rem 1.5rem; overflow: hidden; border-radius: 12px 12px 0 0;">
                                <?php the_post_thumbnail('service-thumbnail', array('style' => 'width: 100%; height: 200px; object-fit: cover;')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <span style="display: inline-block; background: var(--primary-light); color: var(--primary-dark); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; margin-bottom: 0.75rem;">
                            <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                        </span>
                        
                        <h3 style="margin-bottom: 0.5rem;">
                            <a href="<?php the_permalink(); ?>" style="color: inherit;"><?php the_title(); ?></a>
                        </h3>
                        
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
            <div class="no-results" style="text-align: center; padding: 4rem 0;">
                <h2><?php esc_html_e('No results found', 'quezon-care'); ?></h2>
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'quezon-care'); ?></p>
                
                <div style="max-width: 400px; margin: 2rem auto;">
                    <?php get_search_form(); ?>
                </div>
                
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top: 1rem;">
                    <?php esc_html_e('Return Home', 'quezon-care'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
