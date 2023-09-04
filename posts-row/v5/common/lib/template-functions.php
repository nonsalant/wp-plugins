<?php

namespace PostsRow;

/**
 * Conditional function designed for template use.
 *
 * This function provides a concise way to conditionally output content in templates.
 * Usage example: $if(true, "<h1>Hello $name</h1>");
 * Usage example: $if(true, '<h1>Hello '.$name.'</h1>');
 * 
 *
 * @param bool $condition The condition to evaluate.
 * @param string $thenString The string to return if the condition is true.
 * @param string|null $elseString The string to return if the condition is false (optional).
 *
 * @return string The resulting string based on the condition.
 */
if (!isset($if)) $if = function (
    $condition, $thenString, $elseString = null
) {
    if ($condition) return $thenString;
    else return $elseString;
};
