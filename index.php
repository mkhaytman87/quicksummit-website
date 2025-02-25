<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the requested URI
$request_uri = $_SERVER['REQUEST_URI'];

// Remove query string if present
$request_uri = strtok($request_uri, '?');

// Remove trailing slash if present
$request_uri = rtrim($request_uri, '/');

// Debug log
error_log("Request URI: " . $request_uri);

// Map of routes to their corresponding HTML files
$routes = [
    '' => 'index.html',
    '/services' => 'services.html',
];

// Get the static file path
$static_path = __DIR__ . '/static/';

error_log("Static path: " . $static_path);

// Check if route exists in our map
if (isset($routes[$request_uri])) {
    $file = $static_path . $routes[$request_uri];
    error_log("Route found in map, file path: " . $file);
} else {
    // Check if file exists directly in static directory
    $file = $static_path . ltrim($request_uri, '/');
    error_log("Route not in map, trying direct file: " . $file);
}

error_log("Final file path: " . $file);
error_log("File exists check: " . (file_exists($file) ? "true" : "false"));

// If file exists, serve it with appropriate content type
if (file_exists($file)) {
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    
    // Set content type based on file extension
    switch ($extension) {
        case 'html':
            header('Content-Type: text/html');
            break;
        case 'css':
            header('Content-Type: text/css');
            break;
        case 'js':
            header('Content-Type: application/javascript');
            break;
        case 'svg':
            header('Content-Type: image/svg+xml');
            break;
        // Add more content types as needed
    }
    
    readfile($file);
} else {
    // If no matching route or file found, serve the 404 page or index
    header('HTTP/1.0 404 Not Found');
    error_log("File not found, serving 404");
    readfile($static_path . 'index.html');
}
