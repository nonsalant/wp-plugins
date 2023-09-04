<?php

// todo:     - [x] update move-files.php to just send a file like send-to-api-dir/index.php
// todo:     - [ ] test updated move-files.php
// todo:     - [ ] delete remote api folder on plugin uninstall

namespace PostsRow;

defined('ABSPATH') or die('Direct access not allowed.');

// $path_to_root = $_SERVER['DOCUMENT_ROOT'];
// $path_to_plugin = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/posts-row';
$api_path = $_SERVER['DOCUMENT_ROOT'] . '/posts-row-api/';

// Creating a map structure 
$file_paths = array(
    "index.php" => $api_path . "index.php"
    // , "loop.php" => $api_path . "loop.php"
    // , "build-query.php" => $api_path . "build-query.php"
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

// add_action('wppusher_plugin_was_updated',  __NAMESPACE__.'\'.move_files_to_api_folder($file_paths));
// // awppusher_plugin_was_installed
// // add_action('wppusher_plugin_was_updated',  move_files_to_api_folder($file_paths));
