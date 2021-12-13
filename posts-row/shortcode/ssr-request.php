<?php

include(__DIR__ . '/../lib/template-functions.php');

// set all atts as variables
$available_atts = array_merge($available_atts, $posts_row_atts);
foreach ($available_atts as $key => &$value) {
    $$key = $value ? $value : null;
}

////////////////////

// uses $ids,$slugs,$tag,$cat
include(__DIR__ . '/../lib/build-query.php');
// $query_array[] is set here

//  if no posts found
if (!$the_query->have_posts()) {
    $remote_content = '<p>no posts found.</p>';
} else {
    // uses $the_query, $posts_row_single_item_template_file
    require(__DIR__ . '/../lib/loop.php');
    // $remote_content is set here
}

wp_reset_query();
wp_reset_postdata();

////////////////////////////////

$row_id++;

// build $remote_location to use as data-remote_location in the template file
$non_null_remote_atts = [];
foreach ($remote_atts as &$attribute) {
    if ($posts_row_atts[$attribute]) {
        $non_null_remote_atts[$attribute] = $posts_row_atts[$attribute];
    }
}
$remote_params = http_build_query($non_null_remote_atts);
$remote_location = plugins_url('../api/', __FILE__) . '?' . $remote_params;

// uses var names from $local_atts[], $row_id, 
// uses $remote_content, $remote_location
require($posts_row_template_file);
// $posts_row is set here

$initial_content = $posts_row;
