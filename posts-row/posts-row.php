<?php
/*
Plugin Name: Posts Row
Plugin URI: https://stefanmatei.com/posts-row
Description: Adds a row of featured content. (Select posts and/or pages by tag, category, slugs, or ID's.) Useful for customizing archive or other navigational pages. Default styles integrated with the Felt Theme.
Version: 1.0.0
Author: Stefan Matei
Author URI: https://stefanmatei.com
Text Domain: posts-row
Released under the GNU General Public License (GPL)
http://www.gnu.org/licenses/gpl.txt
*/

namespace PostsRow;

// enqueue scripts & styles
include('v5/assets/enqueue-assets.php');

// [posts-row] shortcode setup
include('v5/core/add-shortcode.php');

// // move api files to 📁posts-row-api folder in root:
// if (is_admin()) {
//     include_once('v5/api/send-api-to-root-folder/send-api-to-root-folder.php');
// }
