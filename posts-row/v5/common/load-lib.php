<?php

namespace PostsRow;

$path_to_paths = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row/v5/common/paths.php';
require($path_to_paths);

// lib
if (!function_exists(__NAMESPACE__ . '\createElement')) require($lib_location . 'create-element.php');
if (!function_exists(__NAMESPACE__ . '\sanitize'))      require($lib_location . 'sanitize.php');
if (!function_exists(__NAMESPACE__ . '\sanitizeHTML'))  require($lib_location . 'sanitize-html/sanitize-html.php');
require($tmpl_func_location); // $if($condition, $html)
