<?php

$query_array = [];

if ($ids) {
    $ids_array = explode(',', $ids);
    $query_array =  array(
        'post_type' => array('post', 'page'),
        'post__in' => $ids_array,
        'orderby' => 'post__in'
    );
} else if ($slugs) {
    $slugs_array = explode(',', $slugs);
    $query_array =  array(
        'post_type' => array('post', 'page'),
        'post_name__in' => $slugs_array,
        'orderby' => 'post_name__in'
    );
} else {
    if ($tag) {
        $query_array = ['tag' => $tag];
    }
    if ($cat) {
        $query_array = ['category_name' => $cat];
    }
}

if ($posts_per_page) {
    if ($posts_per_page > 24) {
        $posts_per_page = 24;
    }
} else {
    $posts_per_page = 4;
}

$query_array = array_merge($query_array, array(
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish',
    'offset' => $offset,
    'no_found_rows' => $simple
));

$the_query = new WP_Query($query_array);
