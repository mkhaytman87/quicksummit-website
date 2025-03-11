<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header">
        <div class="header-inner">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) :
                    the_custom_logo();
                else :
                ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-toggle-icon"></span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'quicksummit'); ?></span>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                ));
                ?>
            </nav>

            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <?php if (is_home() || is_archive()) : ?>
    <div class="blog-header">
        <div class="blog-header__content">
            <h1 class="blog-header__title">
                <?php
                if (is_home() && is_front_page()) {
                    echo 'Blog';
                } elseif (is_home()) {
                    single_post_title();
                } elseif (is_archive()) {
                    the_archive_title();
                }
                ?>
            </h1>
            <?php
            if (is_archive()) {
                the_archive_description('<div class="blog-header__description">', '</div>');
            }
            ?>
        </div>
    </div>
    <?php endif; ?>
