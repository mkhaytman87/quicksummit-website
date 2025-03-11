<?php
/*
Plugin Name: QuickSummit Shared Header
Description: Injects the shared header from the main site
Version: 1.0
Author: QuickSummit
*/

function quicksummit_inject_shared_header() {
    ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { padding-top: 80px !important; }
        #wpadminbar { top: 80px !important; }
    </style>
    
    <header class="fixed w-full bg-white/95 backdrop-blur-sm z-50 shadow-sm" style="top: 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="https://quicksummit.net" class="flex items-center">
                        <img src="https://quicksummit.net/logo.svg" alt="QuickSummit.net" class="h-8 w-auto" style="min-width: 120px;" />
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="https://quicksummit.net" class="text-gray-700 hover:text-gray-900">Home</a>
                    <a href="https://quicksummit.net/services" class="text-gray-700 hover:text-gray-900">Services</a>
                    <a href="https://quicksummit.net/blog" class="text-gray-700 hover:text-gray-900">Blog</a>
                    <a href="https://quicksummit.net/about" class="text-gray-700 hover:text-gray-900">About</a>
                    <a href="https://quicksummit.net/contact" class="text-gray-700 hover:text-gray-900">Contact</a>
                    <a href="https://quicksummit.net/consultation" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Book a Free Consultation
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-expanded="false" id="qs-mobile-menu-button">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div class="md:hidden hidden" id="qs-mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="https://quicksummit.net" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Home</a>
                    <a href="https://quicksummit.net/services" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Services</a>
                    <a href="https://quicksummit.net/blog" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Blog</a>
                    <a href="https://quicksummit.net/about" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">About</a>
                    <a href="https://quicksummit.net/contact" class="block px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">Contact</a>
                    <a href="https://quicksummit.net/consultation" class="block px-3 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md">Book a Free Consultation</a>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Mobile menu toggle
        document.getElementById('qs-mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('qs-mobile-menu')?.classList.toggle('hidden');
        });
    </script>
    <?php
}

// Hook into WordPress to inject the header
add_action('wp_head', 'quicksummit_inject_shared_header');
