<?php

if (!function_exists('quicksummit_setup')) {
    function quicksummit_setup() {
        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Enable support for Post Thumbnails on posts and pages
        add_theme_support('post-thumbnails');

        // Add support for responsive embeds
        add_theme_support('responsive-embeds');

        // Add support for custom logo
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        // Add support for editor styles
        add_theme_support('editor-styles');

        // Add support for HTML5 features
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Register navigation menus
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'quicksummit'),
            'footer'  => __('Footer Menu', 'quicksummit'),
        ));

        // Set content width
        if (!isset($content_width)) {
            $content_width = 1200;
        }
    }
}
add_action('after_setup_theme', 'quicksummit_setup');

// Enqueue scripts and styles
function quicksummit_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('quicksummit-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap', array(), null);

    // Enqueue main stylesheet
    wp_enqueue_style('quicksummit-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue JavaScript
    wp_enqueue_script('quicksummit-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'quicksummit_scripts');

// Register widget areas
function quicksummit_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'quicksummit'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'quicksummit'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'quicksummit'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'quicksummit'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'quicksummit_widgets_init');

// Custom excerpt length
function quicksummit_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'quicksummit_excerpt_length');

// Custom excerpt more
function quicksummit_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'quicksummit_excerpt_more');

// Add featured post meta box
function quicksummit_add_meta_box() {
    add_meta_box(
        'featured_post',
        __('Featured Post', 'quicksummit'),
        'quicksummit_meta_box_callback',
        'post'
    );
}
add_action('add_meta_boxes', 'quicksummit_add_meta_box');

function quicksummit_meta_box_callback($post) {
    $featured = get_post_meta($post->ID, 'featured_post', true);
    ?>
    <label>
        <input type="checkbox" name="featured_post" value="yes" <?php checked($featured, 'yes'); ?>>
        <?php _e('Mark as featured post', 'quicksummit'); ?>
    </label>
    <?php
}

function quicksummit_save_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($parent_id = wp_is_post_revision($post_id)) {
        $post_id = $parent_id;
    }
    
    if (isset($_POST['featured_post'])) {
        update_post_meta($post_id, 'featured_post', 'yes');
    } else {
        delete_post_meta($post_id, 'featured_post');
    }
}
add_action('save_post', 'quicksummit_save_meta_box');
