<?php

// allow use of WordPress functions inside /api/index.php:
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php'); 

// only allow access if the plugin is active: 
require_once('../../../../wp-admin/includes/plugin.php'); 
if ( ! is_plugin_active('query-block-navigation/query-block-navigation.php') ) {
    http_response_code(503);
    echo '<p>the plugin is inactive.</p>';
    return;
}

echo file_get_contents('block-templates/escaped.txt');

?>