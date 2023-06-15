<?php

include(__DIR__ . '/../lib/template-functions.php');

include(__DIR__ . '/../config/remote_atts.php');
foreach ($remote_atts as &$attribute) {
    // set used atts as variables
    $$attribute =  isset($_GET[$attribute]) ? sanitize_text_field($_GET[$attribute]) : null;
}


// uses $ids,$slugs,$tag,$cat
include(__DIR__ . '/../lib/build-query.php');
// $query_array[] is set here

//  if no posts found, set 404 & exit
if (!$the_query->have_posts()) {
    http_response_code(404);
    echo '<p>no posts found.</p>';

    return;
}

// uses $the_query, $posts_row_single_item_template_file
require(__DIR__ . '/../lib/loop.php');
// $remote_content is set here

http_response_code(200);
echo $remote_content;

// wp_reset_query();
// wp_reset_postdata();