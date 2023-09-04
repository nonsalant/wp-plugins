<?php 
/**
 * Endpoint for raw HTML 
 * 
 * Receives a query via URL parameters.
 * Outputs HTML for a number of separate items.
 */

namespace PostsRow;

// Allow CORS -- used for local dev
include_once('validation/allow-cors.php');

/* Validation */
require('validation/api-validation.php');

/// lib
$path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';
require($path_to_plugin . '/v5/common/load-lib.php');

/* Setup */

// require($config_location); // $remote_atts[] is set here
$config = require($config_location);
$remote_atts = $config['remote_atts'];

array_push($remote_atts, 'paged');
// ? endpoint is not at 4 by default? setting this doesn't fix it: $remote_atts['posts-per-page'] = 4;
$posts_per_page = 4;

/* Execution */
// uses $remote_atts[] and $posts_per_page
// require('build-query.php');
require($path_to_plugin_api_folder . 'build-query.php');
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
// require('loop.php');
require($path_to_plugin_api_folder . 'loop.php');
// renders html for all items in $the_query
wp_reset_postdata();