<?php

namespace PostsRow;

/**
 * Sanitizes a string using WP's native sanitize_text_field().
 *
 * @param mixed $str The value to sanitize.
 * @return mixed The sanitized value.
 */
function sanitize ($str)
{
    if (is_bool($str)) return $str;
    if ($str === null) return;
    if (is_string($str)) return _sanitize_text_fields($str, true);
    // if (is_string($str)) dd('test'); // return _sanitize_text_fields($str, true);
    // if (is_array($str)) dd('test'); // return _sanitize_text_fields($str[0], true);
};

/**
 * Sanitizes variables with names matching the provided string or array of strings.
 *
 * @param mixed $arrayOrString The string or array of strings representing variable names to sanitize.
 * @return void
 */
function sanitizeIfAvailable ($arrayOrString)
{
    if (is_array($arrayOrString)) {
        foreach ($arrayOrString as $string__safe) {
            global $$string__safe;
            if (is_string($$string__safe)) $$string__safe = sanitize($$string__safe);
            // if (is_array($$string__safe)) dd(($$string__safe[0]));//$$string__safe = sanitize($$string__safe[0]);
        }
        return;
    }
    if (is_string($arrayOrString)) {
        $string__safe = $arrayOrString;
        global $$string__safe;
        if ($$string__safe) $$string__safe = sanitize($$string__safe);
        return;
    }
    if (is_bool($arrayOrString) || is_int($arrayOrString))
        return $arrayOrString;
};

/**
 * Dump and die.
 * 
 * @param mixed $value The value to dump.
 * @return void
 */
function dd ($value)
{ 
    $value ??= $_SERVER; 
    echo'<pre>'; var_dump($value); echo'</pre>'; 
    die(); 
};

// template-functions.php
if (!isset($if))
$if = function ($condition, $thenString, $elseString = null) {
    if ($condition) return $thenString;
    else return $elseString;
};
