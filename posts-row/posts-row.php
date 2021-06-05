<?php
/*
Plugin Name: Posts Row
Plugin URI: https://stefanmatei.com
Description: Adds a row of featured content. (Select items by tag, category, or ID's.) Useful for customizing archive or other navigational pages. Default styles integrated with the Felt Theme.
Version: 1.0.0
Author: Stefan Matei
Author URI: https://stefanmatei.com/posts-row
Text Domain: posts-row
Released under the GNU General Public License (GPL)
http://www.gnu.org/licenses/gpl.txt
*/

#region Script and Style 
# - conditional inclusions
# - cache busting
##########

function posts_row_conditional_logic() {
    // when to inlude the plugin script and style
    if ( is_page() ) { return true; } 
    return false;
}
add_action('wp_enqueue_scripts', function() {
    $cache_buster = '1.0';
    //$cache_buster = substr(md5(microtime()),rand(0,26),8); /** ⚠️ don't use this on production */
    wp_enqueue_script('posts-row-script', plugins_url('/script.js', __FILE__), [], $cache_buster, true);
    wp_enqueue_style('posts-row-style', plugins_url('/style.css', __FILE__), [], $cache_buster);
});


##########
#endregion Script and Style

$row_id = 0;
function posts_row_remove_spaces($value) {
    return str_replace(' ', '', $value);
}

function posts_row_shortcode( $atts = [], $content = null) {

    $remote_atts = ['ids','slugs','cat','tag','excerpt'];
    $local_atts = ['heading','button','link'];
    
    $available_atts = array_merge($remote_atts, $local_atts);
    $available_atts = array_fill_keys($available_atts,'');
    // atts to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    $posts_row_atts = shortcode_atts($available_atts, $atts);
    // remove spaces from comma-separated values
    $posts_row_atts['ids'] = posts_row_remove_spaces($posts_row_atts['ids']);
    $posts_row_atts['slugs'] = posts_row_remove_spaces($posts_row_atts['slugs']);
    
    $heading= $posts_row_atts['heading'] ?: 'Featured Posts';
    $button = $posts_row_atts['button'];
    $link   = $posts_row_atts['link'];
    
    global $row_id;
    $row_id++;
    // $initial_content is set here.
    require('posts-row-wrapper.php'); 
    return $initial_content;
}
add_action( 'init', function () {
	add_shortcode( 'posts-row', 'posts_row_shortcode' );
});



?>