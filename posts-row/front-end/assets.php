<?php

// force file-last-modified-time based cache busting 
// even when a version number is set
$posts_row_force_asset_busting = 1;

// include assets only if the [posts-row] shortcode is used inside the content (+ on the 1st page of categories)
add_filter( 'the_content', 'posts_row_filter_the_content', 1 );
function posts_row_filter_the_content( $content ) {
    if ( (is_category() && ! is_paged()) || has_shortcode($content,'posts-row') ) {
        /*  If you don't set a version number/cache-busting string as the second parameter, a filemtime() will be performed on each visit check if the cached asset can still be used. */
        posts_row_enqueue('style.css', '0.1.2');
        posts_row_enqueue('nav.css');
        posts_row_enqueue('script.js', '0.1.0');
    }
    return $content;
}

function posts_row_enqueue($filename=null, $ver=null) {
    $handle = pathinfo($filename, PATHINFO_FILENAME);
    $suffix = pathinfo($filename, PATHINFO_EXTENSION);
    global $posts_row_template; // felt

    global $posts_row_force_asset_busting;
    if ($posts_row_force_asset_busting) $ver = null;
    $ver = $ver ?: posts_row_cache_buster(__DIR__.'/../templates/'.$posts_row_template.'/'.$suffix.'/'.$handle.'.'.$suffix);;
    
    $template_folder = '../templates/'.$posts_row_template;
    $file__relative_path = $template_folder.'/'.$suffix.'/'.$handle.'.'.$suffix;
    
    if ($suffix == 'css') {
        posts_row_enqueue_style($handle, $file__relative_path, $ver);
        return;
    }
    if ($suffix == 'js') {
        posts_row_enqueue_script($handle, $file__relative_path, $ver);
        return;
    }
    return;
}

// hide posts-row if it exists but its assets weren't enqueued (eg: 2nd page of a category) -- shouldn't happen if the shortcode is used inside the content
add_action('wp_head', function(){
    if ( (is_category() && is_paged()) ) {
        wp_register_style('hide-posts-row',false);
        wp_enqueue_style('hide-posts-row');
        wp_add_inline_style('hide-posts-row', 
            "[id^='posts-row-wrapper'] { display: none; }"
        );
    }
});

function posts_row_enqueue_style($handle, $file__relative_path, $cache_buster) {
    wp_enqueue_style('posts-row-'.$handle , plugins_url($file__relative_path, __FILE__), [], $cache_buster);
}

function posts_row_enqueue_script($handle, $file__relative_path, $cache_buster) {
    wp_enqueue_script('posts-row-'.$handle , plugins_url($file__relative_path, __FILE__), [], $cache_buster, true);
}

// cache busting based on the time the file was last modified
function posts_row_cache_buster($file) {
    if (file_exists($file)) return filemtime($file); 
    else return '0.0.0';
}