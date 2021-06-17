<?php

// the loop

while ( $the_query->have_posts() ) { $the_query->the_post();
    $img_size = 'pixelgrade_hero_image';
    $img = get_the_post_thumbnail_url( get_the_ID(), $img_size );
    $title = get_the_title();
    $uri = get_permalink();
    $excerpt = $excerpt ? get_the_excerpt() : null;

    // uses var names from $remote_atts[]
    require( $posts_row_single_item_template_file ); 
    // $single_item is set here.

    echo $single_item;

}

wp_reset_postdata();