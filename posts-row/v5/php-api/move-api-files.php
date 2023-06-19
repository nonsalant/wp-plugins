<?php

$api_path = '../../../../../../posts-row-api/';

// Creating a map structure 
$file_paths = array(
    "index.php" => $api_path . "index.php",
    "loop.php" => $api_path . "loop.php",
    "the-query-from-remote-atts.php" => $api_path . "the-query-from-remote-atts.php"
);

function move_files_to_api_folder($file_paths)
{
    $api_folder = dirname(__FILE__) . '/../../../../../../posts-row-api/';

    foreach ($file_paths as $source_file => $destination_file) {
        $source_path = dirname(__FILE__) . '/' . $source_file;
        $destination_path = $api_folder . $destination_file;

        // Move the file to the destination folder
        if (file_exists($source_path)) {
            rename($source_path, $destination_path);
        }
    }
}

add_action('wppusher_plugin_was_updated', move_files_to_api_folder($file_paths));
add_action('wppusher_plugin_was_installed', move_files_to_api_folder($file_paths));
