<?php

namespace PostsRow;

while ( $the_query->have_posts() ) { $the_query->the_post();
    // $img_size = 'pixelgrade_hero_image';
    $img_size = 'large';
    $img = get_the_post_thumbnail_url( get_the_ID(), $img_size );
    $title = get_the_title();
    $uri = get_permalink();
    $excerpt = $excerpt ? get_the_excerpt() : null;
    $img_id = get_post_thumbnail_id();
    $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', TRUE);
    if (!$img_alt) { $img_alt = "Read more: ".$title; }
    // $img_src = wp_get_attachment_image_src($img_id, $size)[0];

    // sanitize global vars 
    // (props used in template components)
    sanitizeIfAvailable([
        'uri',
        'title',
        'img',
        'img_alt',
        'excerpt',
        'morelink'
    ]);

    // uses var names from $remote_atts[]
    require($template_single_location); 
    // $single_item is set here.

    echo $single_item;
}