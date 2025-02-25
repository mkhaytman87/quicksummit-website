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
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-expanded="false" id="mobile-menu-button">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Home</a>
                    <a href="/services" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Services</a>
                    <a href="/blog" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Blog</a>
                    <a href="/about" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">About</a>
                    <a href="/contact" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Contact</a>
                    <a href="/consultation" class="block px-3 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md">Book a Free Consultation</a>
                </div>
            </div>
        </div>
    </header>

    <div class="wp-content pt-24"><!-- Added padding-top to account for fixed header -->
