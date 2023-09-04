<?php
/* Connections to the Plugin and WP Core */

namespace PostsRow;

$path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';

$config_location = $path_to_plugin . '/v5/common/config.php';
$path_to_plugin_api_folder = $path_to_plugin . '/v5/api/';

$lib_location = $path_to_plugin . '/v5/common/lib/';
$tmpl_func_location = $path_to_plugin . '/v5/common/lib/template-functions.php';

$template_single_location = $path_to_plugin . '/v5/templates/single/single.php';
// $template_single_location = '../wp-content/plugins/posts-row/v5/templates/single/single.php'; // if api 📁 is inside wp-content/plugins/posts-row
$template_listing_location = $path_to_plugin . '/v5/templates/listing/listing.php';