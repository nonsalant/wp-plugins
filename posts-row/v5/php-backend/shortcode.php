<?php

// [posts-row] shortcode setup

$row_id = 0;

add_action('init', function () {
	add_shortcode('posts-row', 'posts_row_shortcode');
});

function posts_row_shortcode($atts = []) {

    global $row_id;
    
    // $remote_atts = ['ids','slugs','cat','tag','excerpt','paginate'];
    require('config.php');
    // $remote_atts[] is set here

    $local_atts = ['heading','button','link','paginate'];
    $available_atts = array_fill_keys(array_merge($remote_atts, $local_atts), null);

    $available_atts['heading'] = 'Featured Posts';

    // atts to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    $posts_row_atts = shortcode_atts($available_atts, $atts);

    // get var names from $local_atts[]
    foreach ($local_atts as &$attribute) {
        $$attribute = $posts_row_atts[$attribute] ? $posts_row_atts[$attribute] : null; 
    }

    // remove spaces from comma-separated values
    $posts_row_atts['ids'] = posts_row_remove_spaces($posts_row_atts['ids']);
    $posts_row_atts['slugs'] = posts_row_remove_spaces($posts_row_atts['slugs']);

    // uses $remote_atts[], $row_id, var names from $local_atts[]
    require('remote-request.php'); 
    // $initial_content is set here.

    return $initial_content;
}

function posts_row_remove_spaces($value) {
    return str_replace(' ', '', $value);
}
