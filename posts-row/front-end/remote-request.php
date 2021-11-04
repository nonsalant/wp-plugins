<?php

$non_null_remote_atts = [];
foreach ($remote_atts as &$attribute) {
    if ($posts_row_atts[$attribute])
        $non_null_remote_atts[$attribute] = $posts_row_atts[$attribute];
}

$remote_params = http_build_query($non_null_remote_atts);
$remote_location = plugins_url('../api/', __FILE__).'?'.$remote_params;

$remote_content = wp_remote_retrieve_body(wp_remote_request($remote_location));
//$remote_content = wp_remote_request($remote_location)['body'];

$row_id++;

// $posts_row_template_file = __DIR__.'/../templates/'.$posts_row_template.'/index.php';
global $posts_row_template_file;

// uses var names from $local_atts[], $row_id, $remote_location
require($posts_row_template_file);
// $posts_row is set here

$initial_content = $posts_row;