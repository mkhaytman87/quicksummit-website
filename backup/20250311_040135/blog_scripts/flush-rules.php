<?php
require_once('wp-load.php');
global $wp_rewrite;
$wp_rewrite->flush_rules(true);
echo "Rewrite rules flushed successfully!";
?>
