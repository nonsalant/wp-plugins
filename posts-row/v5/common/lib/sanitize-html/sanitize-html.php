<?php

namespace PostsRow;

/**
 * Sanitizes a string containing HTML content, allowing only specified tags and attributes.
 *
 * This function takes a string containing HTML content and ensures that only the tags and 
 * attributes listed in the 'allowed-html-tags.php' file are retained. 
 * If the input is a boolean value or null, it is returned unchanged.
 *
 * @param mixed $str The string containing HTML content to sanitize.
 * @return mixed The sanitized HTML content with allowed tags and attributes.
 */
function sanitizeHTML($str)
{
    if (is_bool($str)) return $str;
    if ($str === null) return null;

    // Load the list of allowed HTML tags and attributes.
    $allowedTags = include('allowed-html-tags.php');

    // Sanitize the HTML content using the list of allowed tags and attributes.
    return wp_kses($str, $allowedTags);
};
