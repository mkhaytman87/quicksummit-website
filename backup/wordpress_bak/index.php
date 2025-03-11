<?php get_header(); ?>

<main class="site-main">
    <?php if (is_home() && !is_paged()) : ?>
        <?php
        // Featured Post
        $args = array(
            'posts_per_page' => 1,
            'meta_key' => 'featured_post',
            'meta_value' => 'yes'
        );
        $featured_query = new WP_Query($args);
        if ($featured_query->have_posts()) :
            while ($featured_query->have_posts()) : $featured_query->the_post();
        ?>
            <article class="featured-post">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-post__image-container">
                        <?php the_post_thumbnail('large', array('class' => 'featured-post__image')); ?>
                    </div>
                <?php endif; ?>
                <div class="featured-post__content">
                    <h2 class="featured-post__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="featured-post__meta">
                        <span class="featured-post__date"><?php echo get_the_date(); ?></span>
                        <span class="featured-post__author">by <?php the_author(); ?></span>
                    </div>
                    <div class="featured-post__excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="featured-post__read-more">Read More</a>
                </div>
            </article>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    <?php endif; ?>

    <div class="blog-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
            <article class="blog-card">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" class="blog-card__image-link">
                        <?php the_post_thumbnail('medium', array('class' => 'blog-card__image')); ?>
                    </a>
                <?php endif; ?>
                <div class="blog-card__content">
                    <h2 class="blog-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="blog-card__meta">
                        <span class="blog-card__date"><?php echo get_the_date(); ?></span>
                        <span class="blog-card__author">by <?php the_author(); ?></span>
                    </div>
                    <div class="blog-card__excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="blog-card__categories">
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                            foreach ($categories as $category) :
                        ?>
                            <a href="<?php echo get_category_link($category->term_id); ?>" class="category-tag">
                                <?php echo $category->name; ?>
                            </a>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </article>
        <?php
            endwhile;
        endif;
        ?>
    </div>

    <?php the_posts_pagination(array(
        'prev_text' => __('Previous', 'quicksummit'),
        'next_text' => __('Next', 'quicksummit'),
        'class' => 'pagination',
        'screen_reader_text' => ' ',
    )); ?>

    <section class="newsletter">
        <div class="newsletter__content">
            <h2 class="newsletter__title">Subscribe to Our Newsletter</h2>
            <p class="newsletter__description">Stay updated with our latest insights and articles</p>
            <form class="newsletter__form">
                <input type="email" class="newsletter__input" placeholder="Enter your email" required>
                <button type="submit" class="newsletter__button">Subscribe</button>
            </form>
        </div>
    </section>
</main>

<?php get_footer(); ?>
