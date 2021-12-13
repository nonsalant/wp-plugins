<?php

// skip enqueueing if only using aux sc in the "update:" function
// or don't if not, and add:... || has_shortcode($content,'posts-row-inner')
// enqueue scripts & styles
// include('assets.php');

// [posts-row-inner] shortcode setup

add_action('init', function () {
	add_shortcode('posts-row-inner', 'posts_row_inner_shortcode');
});

function posts_row_inner_shortcode($atts = []) {

    include(__DIR__ . '/../config/config.php');
    include(__DIR__ . '/../config/remote_atts.php');
    //$remote_atts = ['ids','slugs','cat','tag','excerpt','paged','offset','simple'];
            
    //$local_atts = ['heading','button','link'];
    $available_atts = array_fill_keys($remote_atts, null);
    
    // atts to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    $posts_row_atts = shortcode_atts($available_atts, $atts);

    // remove spaces from comma-separated values
    $posts_row_atts['ids'] = posts_row_remove_spaces($posts_row_atts['ids']);
    $posts_row_atts['slugs'] = posts_row_remove_spaces($posts_row_atts['slugs']);

    // uses $remote_atts[], var names from $local_atts[], $posts_row_template_single_item_file
    require('ssr-request-inner.php'); // require('remote-request.php'); 
    // $initial_content is set here.

    return $initial_content;
}
