<?php
/**
 * Endpoint for raw HTML 
 * 
 * Receives a query via URL parameters.
 * Outputs html for a number of separate items.
 */

namespace PostsRow;

/* Connections to the Plugin and WP Core */
$path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';
$api_from_plugin_location = $path_to_plugin . '/v5/api/api.php';

include($api_from_plugin_location);
