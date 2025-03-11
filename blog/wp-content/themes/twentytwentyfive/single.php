<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <?php echo get_the_date(); ?> by <?php the_author(); ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php if (has_category()): ?>
                    <div class="cat-links">
                        Categories: <?php the_category(', '); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (has_tag()): ?>
                    <div class="tag-links">
                        Tags: <?php the_tags('', ', ', ''); ?>
                    </div>
                    <?php endif; ?>
                </footer>
            </article>
            
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        endwhile;
        ?>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>