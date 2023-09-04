<?php

namespace PostsRow;

/**
 * List of allowed HTML tags and attributes for sanitizing remote content.
 *
 * This file defines an array of allowed HTML tags and their corresponding attributes that are
 * permitted when sanitizing remote content. Each tag is associated with an array of allowed 
 * attributes. Some attributes may have specific restrictions, such as 'href' which has a 
 * maximum length defined.
 *
 * @return array An array of allowed HTML tags and attributes for sanitizing remote content.
 */
$allowedTagsInRemoteContent = [
    'div'    => ['class' => true, 'data-*' => true],
    'ul'     => ['class' => true, 'data-*' => true],
    'ol'     => ['class' => true, 'data-*' => true],
    'li'     => ['class' => true, 'data-*' => true],
    'h1'     => ['class' => true, 'data-*' => true],
    'h2'     => ['class' => true, 'data-*' => true],
    'h3'     => ['class' => true, 'data-*' => true],
    'h4'     => ['class' => true, 'data-*' => true],
    'h5'     => ['class' => true, 'data-*' => true],
    'h6'     => ['class' => true, 'data-*' => true],
    'p'      => ['class' => true, 'data-*' => true],
    'img'    => ['class' => true, 'data-*' => true, 'title' => true, 'src' => true, 'alt' => true, 'width' => true, 'height' => true],
    'span'   => ['class' => true, 'data-*' => true],
    'a' => [
        'class' => true, 'data-*' => true, 'title' => true, 'target' => true,
        'href' => ['maxlen' => 300] // https://github.com/soosyze/kses#maxlen
        //  todo: limit maxlen fo all atts (inc class and data-*)
    ],
    'input'  => ['class' => true, 'data-*' => true, 'type' => true],
    'header' => ['class' => true, 'data-*' => true],
    'footer' => ['class' => true, 'data-*' => true]
];

$inlineTagsAndBlockquote = [
    'abbr' => ['title' => true],
    'acronym' => ['title' => true],
    'b' => [],
    'cite' => [],
    'code' => [],
    'del' => ['datetime' => true],
    'em' => [],
    'i' => [],
    'q' => ['cite' => true],
    's' => [],
    'strike' => [],
    'strong' => [],
    'blockquote' => ['cite' => true]
];

// Return the merged array of allowed HTML tags and attributes
return array_merge($inlineTagsAndBlockquote, $allowedTagsInRemoteContent);
