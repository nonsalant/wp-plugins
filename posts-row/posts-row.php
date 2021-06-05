<?php
/*
Plugin Name: Posts Row
Plugin URI: https://stefanmatei.com
Description: Adds a row of featured content. (Select posts and/or pages by tag, category, slugs, or ID's.) Useful for customizing archive or other navigational pages. Default styles integrated with the Felt Theme.
Version: 1.0.0
Author: Stefan Matei
Author URI: https://stefanmatei.com/posts-row
Text Domain: posts-row
Released under the GNU General Public License (GPL)
http://www.gnu.org/licenses/gpl.txt
*/

// when to inlude the plugin script and style
function posts_row_conditional_logic() {
    if ( is_page() ) { return true; } 
    return false;
}
// include script and style with ?ver= in url params
add_action('wp_enqueue_scripts', function() {
    $cache_buster = '1.0';
    //$cache_buster = substr(md5(microtime()),rand(0,26),8); /** ⚠️ don't use this on production */
    wp_enqueue_script('posts-row-script', plugins_url('/assets/script.js', __FILE__), [], $cache_buster, true);
    wp_enqueue_style('posts-row-style', plugins_url('/assets/style.css', __FILE__), [], $cache_buster);
});


function posts_row_remove_spaces($value) {
    return str_replace(' ', '', $value);
}

$row_id = 0;

function posts_row_shortcode( $atts = [], $content = null) {    
    
    $remote_atts = ['ids','slugs','cat','tag','excerpt'];
    $local_atts = ['heading','button','link'];
    $available_atts = array_fill_keys(array_merge($remote_atts, $local_atts), null);
    $available_atts['heading'] = 'Featured Posts';
    
    // atts to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    $posts_row_atts = shortcode_atts($available_atts, $atts);
    
    global $row_id; $row_id++;

    // get var names from $local_atts[]
    foreach ($local_atts as &$attribute) {
        $$attribute = $posts_row_atts[$attribute] ? $posts_row_atts[$attribute] : null; 
    }
    
    // remove spaces from comma-separated values
    $posts_row_atts['ids'] = posts_row_remove_spaces($posts_row_atts['ids']);
    $posts_row_atts['slugs'] = posts_row_remove_spaces($posts_row_atts['slugs']);

    // uses $remote_atts[]
    // $initialContent is set here.
    require('initialContent.php'); 
    return $initialContent;
}
add_action( 'init', function () {
	add_shortcode( 'posts-row', 'posts_row_shortcode' );
});