<?php 
/** Endpoint for raw HTML.
 */


/* Connections to the Plugin and WP */

$path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';
$path_to_root = $_SERVER['DOCUMENT_ROOT'];
$template_single_item_location = $path_to_plugin . '/v5/php-templates/single.php';
// $path_to_root = '..'; // if api 📁 is inside wp-content/plugins/posts-row
// $template_single_item_location = '../wp-content/plugins/posts-row/v5/php-templates/single.php';
$config_location = $path_to_plugin . '/v5/php-backend/config.php';


/* Validation */

// allow direct access to this file:
define('WP_USE_THEMES', false);
require_once($path_to_root . '/wp-load.php');

// but only if the plugin is active: 
require_once($path_to_root . '/wp-admin/includes/plugin.php');
if (!is_plugin_active('posts-row/posts-row.php')) {
    http_response_code(503);
    echo '<p>the plugin is inactive.</p>';
    return;
}


/* Setup */

// $remote_atts = ['ids','slugs','cat','tag','excerpt','paginate'];
require($config_location);
// $remote_atts[] is set here
// $allowed_origins[] is set here

array_push($remote_atts, 'paged');
$posts_per_page = 4;


/* Execution */

// uses $remote_atts[] and $posts_per_page
require('the-query-from-remote-atts.php');
// $the_query is set here

// return with a 404 response code if there are no posts in $the_query
if (!$the_query->have_posts()) {
    http_response_code(404); 
    echo '<p>no posts found.</p>';
    return;
}
http_response_code(200);

// make the total number of pages available in the DOM
$totalpages = $the_query->max_num_pages;
echo '<input type="hidden" data-totalpages="' . $totalpages . '">';

// uses $the_query
require('loop.php');
// renders html for all items in $the_query

wp_reset_postdata();

?>