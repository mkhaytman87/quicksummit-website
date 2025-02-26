<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    
    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WR44D96CMZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-WR44D96CMZ');
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/style.css" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('min-h-screen bg-white'); ?>>
<?php
// Check if the shared header plugin exists by checking for its file
$plugin_path = WP_PLUGIN_DIR . '/quicksummit-shared-header/quicksummit-shared-header.php';
$shared_header_active = file_exists($plugin_path);

// Only show the theme's header if the shared header plugin is not active
if (!$shared_header_active):
?>
    <header class="fixed w-full bg-white/95 backdrop-blur-sm z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="/logo.svg" alt="QuickSummit Logo" class="h-8 w-auto" />
                        <span class="ml-2 text-xl font-bold text-gray-900">QuickSummit</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-gray-900">Home</a>
                    <a href="/services" class="text-gray-700 hover:text-gray-900">Services</a>
                    <a href="/blog" class="text-gray-700 hover:text-gray-900">Blog</a>
                    <a href="/about" class="text-gray-700 hover:text-gray-900">About</a>
                    <a href="/contact" class="text-gray-700 hover:text-gray-900">Contact</a>
                    <a href="/consultation" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Book a Free Consultation
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>
<?php endif; ?>
    <div class="wp-content pt-24"><!-- Added padding-top to account for fixed header -->
