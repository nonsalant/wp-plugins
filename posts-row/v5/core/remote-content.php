<?php

namespace PostsRow;

$posts_row_atts = require('posts-row-atts.php');

$non_null_remote_atts = [];
foreach ($remote_atts as &$attribute) {
    // global $remote_atts;
    // echo ($posts_row_atts[$attribute].'<br>');
    if (isset($posts_row_atts[$attribute])) {
        $non_null_remote_atts[$attribute] = $posts_row_atts[$attribute];
    }
}
// dd($remote_atts);
$remote_params = http_build_query($non_null_remote_atts);
$remote_location =  get_site_url(null, '/posts-row-api/') . '?' . $remote_params;
// $remote_location = plugins_url('/api/', __FILE__).'?'.$remote_params;

// instead of php's file_get_contents()
$remote_response = wp_remote_request($remote_location);
$remote_content = wp_remote_retrieve_body($remote_response);

return sanitizeHTML($remote_content);