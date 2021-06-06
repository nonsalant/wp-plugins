<?php

$non_null_remote_atts = [];
foreach ($remote_atts as &$attribute) {
    if ($posts_row_atts[$attribute])
        $non_null_remote_atts[$attribute] = $posts_row_atts[$attribute];
}
$remote_params = http_build_query($non_null_remote_atts);
$remote_location = plugins_url('/api/', __FILE__).'?'.$remote_params;

// set fake user agent
ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11) AppleWebKit/601.1.56 (KHTML, like Gecko) Version/9.0 Safari/601.1.56'); //otherwise file_get_contents doesn't work with absolute URL on some hosts like BlueHost

$remote_content = file_get_contents( $remote_location );

$row_id++;

// uses var names from $local_atts[], $row_id, $remote_location
require('templates/posts_row.php'); 
// $posts_row is set here

$initial_content = $posts_row;