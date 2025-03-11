<?php get_header(); ?>

<main class="max-w-3xl mx-auto px-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class('mb-12'); ?>>
            <header class="mb-6">
                <h2 class="text-3xl font-bold mb-2">
                    <a href="<?php the_permalink(); ?>" class="hover:text-indigo-600">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="text-gray-600">
                    Posted on <?php the_date(); ?> by <?php the_author(); ?>
                </div>
            </header>

            <div class="prose prose-lg max-w-none">
                <?php the_excerpt(); ?>
            </div>

            <footer class="mt-4">
                <a href="<?php the_permalink(); ?>" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Read More
                </a>
            </footer>
        </article>
    <?php endwhile; ?>

    <div class="flex justify-between items-center mt-8">
        <?php posts_nav_link(' ', 
            '<span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">← Newer Posts</span>', 
            '<span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Older Posts →</span>'
        ); ?>
    </div>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
