<?php

while ( $the_query->have_posts() ) { $the_query->the_post();
    // $img_size = 'pixelgrade_hero_image';
    $img_size = 'large';
    $img = get_the_post_thumbnail_url( get_the_ID(), $img_size );
    $title = get_the_title();
    $uri = get_permalink();
    $excerpt = $excerpt ? get_the_excerpt() : null;

    /// 4 jun ~20
    $img_id = get_post_thumbnail_id();
    $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', TRUE);
    if (!$img_alt) { $img_alt = "Read more: ".$title; }
    // //$size = 'my-size'; // Defaults to 'thumbnail' if omitted.
    // $img_src = wp_get_attachment_image_src($img_id, $size)[0];

    // uses var names from $remote_atts[]
    require($template_single_item_location); 
    // $single_item is set here.

    echo $single_item;

}