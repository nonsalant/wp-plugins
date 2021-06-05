<?php 
/** Endpoint for raw HTML.
 */

// allow direct access to this file:
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php'); 

// but only if the plugin is active: 
require_once('../../../../wp-admin/includes/plugin.php'); 
if ( ! is_plugin_active('posts-row/posts-row.php') ) {
    http_response_code(503);
    echo '<p>the plugin is inactive.</p>';
    return;
}
#endregion Endpoint Setup

$remote_atts = ['ids','slugs','cat','tag','excerpt','paged'];
$posts_per_page = 4;

// uses $remote_atts[]
require('index-middleware.php'); 

?>