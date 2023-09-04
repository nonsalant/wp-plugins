<?php

namespace PostsRow;

/**
 * Generates an HTML element with the specified tag name
 * (p by default), children[], and attributes[]. 
 * Supports both self-closing tags and tags with content.
 *
 * @param string $tag
 * @param array|string|null $children
 *                          ⚠️ Will not be sanitized if array.
 *                          Will be sanitized if string and be
 *                          used as the text content.
 * @param array|string $attributes
 *                          Will always be sanitized.
 *                          Example attributes array: [
 *                            'class' => 'my-class',
 *                            'title' => 'My Title',
 *                            'href' => 'https://example.com'
 *                          ]
 *                          If a string is provided, (instead of an array)
 *                          it is treated as the value for the 'class' attribute.
 * @param boolean $forceSafe 
 *                          Forces sanitization on each item in the $children arr.
 * @return string The generated HTML element as a string.
 */

// if(!function_exists('createElement')) 
function createElement(
    $tag = 'p',
    $children = [],
    $attributes = [],
    $forceSafe = false
) {
    // Handle tag
    $tag = sanitize($tag);
    $selfClosingTags = ['img', 'br', 'hr', 'input', 'meta', 'area', 'base', 'col', 'embed', 'link', 'param', 'source', 'track', 'wbr'];

    // Handle children
    $output = null;
    if (is_array($children)) foreach ($children as $child) {
        if ($forceSafe) {
            $child = sanitize($child);
        }
        $output .= $child; // ⚠️ un-sanitized
    }
    if (is_string($children)) {
        $output = sanitize($children);
    }

    // Handle the attributes 
    // If $attributes is a str (not an array), sanitize & use it as the class name
    if (is_string($attributes)) {
        $attributes = ['class' => sanitize($attributes)];
    }
    $safeAttributeStr = implode(' ', array_map(
        function ($name, $value) {
            ///
            if (!$name) return;
            ///
            $name = sanitize($name);
            $value = sanitize($value);
            return "$name='$value'"; // safe attribute str
        },
        array_keys($attributes),
        $attributes
    ));

    if (in_array($tag, $selfClosingTags))
        return "<$tag $safeAttributeStr />";
    return "<$tag $safeAttributeStr>$output</$tag>";
};
