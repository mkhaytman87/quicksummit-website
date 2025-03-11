<?php
// Custom router for PHP's built-in development server
// This script helps properly route requests to WordPress when using PHP's built-in server

// Debug route information
error_log("Routing request: " . $_SERVER["REQUEST_URI"]);

// Handle root URL requests
if ($_SERVER["REQUEST_URI"] == '/') {
    // Check if dist/index.html exists (for Astro builds)
    if (file_exists(__DIR__ . '/dist/index.html')) {
        require_once(__DIR__ . '/dist/index.html');
        return true;
    } 
    // Check if index.html exists in the root
    elseif (file_exists(__DIR__ . '/index.html')) {
        require_once(__DIR__ . '/index.html');
        return true;
    }
    // Default to showing directory listing if no index files found
    else {
        echo "<h1>QuickSummit</h1>";
        echo "<p>Welcome to the QuickSummit website development server.</p>";
        echo "<p><a href='/blog/'>Visit Blog</a></p>";
        return true;
    }
}

// If the request is for a file that exists, serve it directly
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $_SERVER["REQUEST_URI"])) {
    return false;
}

// Handle WordPress blog requests - now matches /blog with or without trailing slash
if (strpos($_SERVER["REQUEST_URI"], '/blog') === 0) {
    // Set working directory to the blog directory
    chdir(__DIR__ . '/blog');
    
    // Update $_SERVER variables to help WordPress generate correct URLs
    $_SERVER["SCRIPT_FILENAME"] = __DIR__ . '/blog/index.php';
    $_SERVER["SCRIPT_NAME"] = '/blog/index.php';
    $_SERVER["PHP_SELF"] = '/blog/index.php';
    
    // Load WordPress
    require_once(__DIR__ . '/blog/index.php');
    return true;
}

// Handle old /wordpress URLs (redirect to /blog)
if (strpos($_SERVER["REQUEST_URI"], '/wordpress') === 0) {
    $new_url = str_replace('/wordpress', '/blog', $_SERVER["REQUEST_URI"]);
    header("Location: $new_url", true, 301);
    return true;
}

// For all other requests that haven't been handled yet
if (file_exists(__DIR__ . '/dist' . $_SERVER["REQUEST_URI"])) {
    // Try to serve from the dist directory (for Astro builds)
    return false;
} else {
    // Show a helpful 404 page
    http_response_code(404);
    echo "<h1>Page Not Found</h1>";
    echo "<p>The requested page " . htmlspecialchars($_SERVER["REQUEST_URI"]) . " was not found.</p>";
    echo "<p><a href='/'>Return to Home</a> | <a href='/blog/'>Visit Blog</a></p>";
    return true;
}
?>
