<?php
/**
 * Default Page Template
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
            <span><?php the_title(); ?></span>
        </div>
    </div>
</div>

<!-- Page Content -->
<section class="section">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-featured-image" style="margin-bottom: 2rem; border-radius: var(--radius-lg); overflow: hidden;">
                        <?php the_post_thumbnail('hero-image', array('style' => 'width: 100%; height: auto;')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="page-content" style="max-width: 800px; margin: 0 auto;">
                    <?php the_content(); ?>
                </div>
                
                <?php
                // If comments are open or there's at least one comment
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
