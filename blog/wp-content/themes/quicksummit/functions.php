<?php
function quicksummit_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'quicksummit'),
        'footer' => __('Footer Menu', 'quicksummit'),
    ));
}
add_action('after_setup_theme', 'quicksummit_setup');

// Enqueue scripts and styles
function quicksummit_scripts() {
    wp_enqueue_style('quicksummit-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('quicksummit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'quicksummit_scripts');

// Add custom classes to body
function quicksummit_body_classes($classes) {
    $classes[] = 'bg-white';
    return $classes;
}
add_filter('body_class', 'quicksummit_body_classes');
