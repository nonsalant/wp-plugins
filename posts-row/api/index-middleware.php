<?php
foreach ($remote_atts as &$attribute) {
    $$attribute =  isset($_GET[$attribute]) ? sanitize_text_field($_GET[$attribute]) : null;
}

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
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish'
));

$the_query = new WP_Query($query_array);
    
if(!$the_query->have_posts()) {
    http_response_code(404);
    echo '<p>no posts found.</p>';
    return;
}
http_response_code(200);

echo '<input type="hidden" data-totalpages="'.$the_query->max_num_pages.'">';

#region The Loop
while ( $the_query->have_posts() ) { $the_query->the_post();
    $img_size = 'pixelgrade_hero_image';
    $img = get_the_post_thumbnail_url( get_the_ID(), $img_size );
    $title = get_the_title();
    $uri = get_permalink();
    $excerpt = $excerpt ? get_the_excerpt() : null;

    // uses var names from $remote_atts[]
    require('../templates/single_item.php'); 
    // $single_item is set here.

    echo $single_item;

} // end while
#endregion The Loop

wp_reset_postdata();