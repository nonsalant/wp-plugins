<?php
defined('ABSPATH') or die('Direct access not allowed.');

// $path_to_root = $_SERVER['DOCUMENT_ROOT'];
// $path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';
$api_path = $_SERVER['DOCUMENT_ROOT'] . '/posts-row-api/';

// Creating a map structure 
$file_paths = array(
    "index.php" => $api_path . "index.php",
    "loop.php" => $api_path . "loop.php",
    "the-query-from-remote-atts.php" => $api_path . "the-query-from-remote-atts.php"
);

function move_files_to_api_folder($file_paths)
{
    foreach ($file_paths as $source_file => $destination_file) {
        $source_path = dirname(__FILE__) . '/' . $source_file;
        // Move the file to the destination folder
        if (file_exists($source_path)) {
            rename($source_path, $destination_file);

            $log_file_name = $source_file . '.log';
            $log_file_content = $source_path . " --> " . $destination_file;
            $log_file_path = dirname(__FILE__) . '/' . $log_file_name;
            file_put_contents($log_file_path, $log_file_content);
        }
    }
}

add_action('wppusher_plugin_was_updated',  move_files_to_api_folder($file_paths));
// add_action('wppusher_plugin_was_installed',move_files_to_api_folder($file_paths));
