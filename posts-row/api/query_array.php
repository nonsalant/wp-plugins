<?php
if ($ids) {
    $ids_array = explode(',', $ids);
    $query_array =  array(
        'post_type' => array('post','page'),
        'post__in' => $ids_array,
        'orderby' => 'post__in'
    );
} else if ($slugs) {
    $slugs_array = explode(',', $slugs);
    $query_array =  array(
        'post_type' => array('post','page'),
        'post_name__in' => $slugs_array,
        'orderby' => 'post_name__in'
    );
} else if ($tag && $cat) {
    $query_array =  array( 
        'category_name' => $cat,
        'tag' => $tag
    );
} else if ($tag) {
    $query_array =  array( 
        'tag' => $tag
    );
} else if ($cat) {
    $query_array =  array( 
        'category_name' => $cat
    );
} else {
    $query_array = array(); // default query with latest posts
}

$query_array = array_merge($query_array, array(
    'posts_per_page' => $limit,
    'paged' => $pagination,
    'post_status' => 'publish'
));