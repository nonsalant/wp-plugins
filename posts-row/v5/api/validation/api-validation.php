<?php

namespace PostsRow;

$path_to_root = $_SERVER['DOCUMENT_ROOT'];
// $path_to_root = '..'; // if api 📁 is inside wp-content/plugins/posts-row

// Allow direct access to this file:
define('WP_USE_THEMES', false);
require_once($path_to_root . '/wp-load.php');

// ...but only if the plugin is active: 
require_once($path_to_root . '/wp-admin/includes/plugin.php');
if (!is_plugin_active('posts-row/posts-row.php')) {
    http_response_code(503);
    echo '<p>the plugin is inactive.</p>';
    return;
}