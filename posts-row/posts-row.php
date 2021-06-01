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

define('DISALLOW_FILE_EDIT', false); // enable plugin & theme editors

$row_id = 0;

add_action( 'init', function () {
	add_shortcode( 'posts-row', 'posts_row_shortcode' );
});
function posts_row_shortcode( $atts = [], $content = null) {
    // atts to lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );
    
    // $initial_content is set here.
    require('posts-row-wrapper.php'); 
    
    return $initial_content;
}

#region Script and Style 
# - conditional inclusions
# - cache busting
##########

function posts_row_conditional_logic() {
    // when to inlude the plugin script and style
    if ( is_page() ) { return true; } 
    return false;
}
$cache_buster = substr(md5(microtime()),rand(0,26),8);
/** ⚠️ disable on production */
// $cache_buster = 0;

add_action('wp_head', 'posts_row_header');
function posts_row_header() {
    global $cache_buster;
    if (posts_row_conditional_logic()) {
        ?>
        <link rel="stylesheet" href="<?php
		    echo plugins_url('', __FILE__ );
        ?>/style.css?cache-buster=<?php
        echo $cache_buster;
        ?>" />
        <?php
    } // end if()
} // end posts_row_header()

add_action('wp_footer', 'posts_row_footer');
function posts_row_footer() {
    global $cache_buster;
    // enable arrows only on pages
    if (posts_row_conditional_logic()) {
        ?>
        <script src="<?php
        echo plugins_url('', __FILE__ );
        ?>/script.js?cache-buster=<?php
        echo $cache_buster;
        ?>"></script>
        <?php
    } // end if()
} // end posts_row_footer()

##########
#endregion Script and Style

?>
