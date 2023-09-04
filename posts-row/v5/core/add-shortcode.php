<?php

namespace PostsRow;
// die(__NAMESPACE__);

/// lib
$path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';
require($path_to_plugin.'/v5/common/load-lib.php');

// $row_id = 0;
add_action('init', function () {
    add_shortcode('posts-row', __NAMESPACE__.'\posts_row_shortcode');
});

// [posts-row] shortcode setup
function posts_row_shortcode($atts = []) {
    return require('initial-content.php'); 
}
