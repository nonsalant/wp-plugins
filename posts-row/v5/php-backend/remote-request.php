<?php

$template_outer_html_location = '../php-templates/listing.php';

$non_null_remote_atts = [];
foreach ($remote_atts as &$attribute) {
    if ($posts_row_atts[$attribute])
        $non_null_remote_atts[$attribute] = $posts_row_atts[$attribute];
}
$remote_params = http_build_query($non_null_remote_atts);

$remote_location =  get_site_url(null, '/posts-row-api/') . '?' . $remote_params;
// $remote_location = plugins_url('/api/', __FILE__).'?'.$remote_params;

// instead of php's file_get_contents($remote_location)
$remote_content = wp_remote_retrieve_body(wp_remote_request($remote_location));

$row_id++;

// uses var names from $local_atts[], $row_id, $remote_location
require($template_outer_html_location);
// $posts_row is set here

$initial_content = $posts_row;
