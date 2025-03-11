<?php
/*
Plugin Name: QuickSummit Analytics
Description: Adds Google Analytics tracking code to all pages
Version: 1.0
Author: QuickSummit
*/

function quicksummit_add_analytics() {
    ?>
    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WR44D96CMZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-WR44D96CMZ');
    </script>
    <?php
}
add_action('wp_head', 'quicksummit_add_analytics');
