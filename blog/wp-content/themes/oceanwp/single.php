<?php
/**
 * The template for displaying single posts
 */

get_header(); ?>

<div class="single-post">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="single-post__header">
                <h1 class="single-post__title"><?php the_title(); ?></h1>
                <div class="single-post__meta">
                    <span class="single-post__date"><?php the_date(); ?></span>
                    <span class="single-post__author">by <?php the_author(); ?></span>
                    <?php if (has_category()) : ?>
                        <span class="single-post__categories"><?php the_category(', '); ?></span>
                    <?php endif; ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="single-post__featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="single-post__content">
                <?php the_content(); ?>
            </div>

            <?php if (has_tag()) : ?>
                <div class="single-post__tags">
                    <span class="tags-title">Tags:</span>
                    <?php the_tags('', ', ', ''); ?>
                </div>
            <?php endif; ?>

            <div class="post-navigation">
                <div class="post-navigation__prev">
                    <?php previous_post_link('%link', '<span class="post-navigation__label">Previous Post</span><span class="post-navigation__title">%title</span>'); ?>
                </div>
                <div class="post-navigation__next">
                    <?php next_post_link('%link', '<span class="post-navigation__label">Next Post</span><span class="post-navigation__title">%title</span>'); ?>
                </div>
            </div>
        </article>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>