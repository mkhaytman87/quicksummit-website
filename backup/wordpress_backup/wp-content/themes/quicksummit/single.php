<?php get_header(); ?>

<main class="max-w-3xl mx-auto px-4">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('mb-12'); ?>>
            <header class="mb-8">
                <h1 class="text-4xl font-bold mb-4">
                    <?php the_title(); ?>
                </h1>
                <div class="text-gray-600">
                    Posted on <?php the_date(); ?> by <?php the_author(); ?>
                    <?php if (has_category()) : ?>
                        in <?php the_category(', '); ?>
                    <?php endif; ?>
                </div>
            </header>

            <div class="prose prose-lg max-w-none">
                <?php the_content(); ?>
            </div>

            <?php if (has_tag()) : ?>
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center">
                        <span class="text-gray-600 mr-2">Tags:</span>
                        <?php the_tags('<div class="flex flex-wrap gap-2">', '', '</div>'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </article>

        <nav class="flex justify-between items-center mt-8 pt-8 border-t border-gray-200">
            <div>
                <?php previous_post_link('%link', '← Previous Post'); ?>
            </div>
            <div>
                <?php next_post_link('%link', 'Next Post →'); ?>
            </div>
        </nav>

        <?php if (comments_open() || get_comments_number()) : ?>
            <div class="mt-12">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
