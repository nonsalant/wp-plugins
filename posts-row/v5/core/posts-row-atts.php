<?php

namespace PostsRow;

$remote_atts = $config['remote_atts'];
$local_atts = $config['local_atts'];
$available_atts = array_fill_keys(
    array_merge($remote_atts, $local_atts), null
);

$available_atts['posts_per_page'] = 4;
$available_atts['heading'] = 'Featured Posts';

// atts to lowercase
$atts = array_change_key_case((array) $atts, CASE_LOWER);
$posts_row_atts = shortcode_atts($available_atts, $atts);

// get var names from $local_atts[]
foreach ($local_atts as &$attribute) {
    $$attribute = $posts_row_atts[$attribute] ?? null;
}

// remove spaces from comma-separated values
$posts_row_atts['ids'] = remove_spaces($posts_row_atts['ids']);
$posts_row_atts['slugs'] = remove_spaces($posts_row_atts['slugs']);

// return($posts_row_atts);

sanitizeIfAvailable($posts_row_atts);
return($posts_row_atts);
