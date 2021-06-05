<?php 
/** Endpoint for raw HTML.
 */

#region Endpoint Setup
// allow direct access to this file:
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php'); 
// but only if the plugin is active: 
require_once('../../../../wp-admin/includes/plugin.php'); 
if ( ! is_plugin_active('posts-row/posts-row.php') ) {
    http_response_code(503);
    echo '<p>the plugin is inactive.</p>';
    return;
}
#endregion Endpoint Setup

posts_row_ssr();
function posts_row_ssr() {
    
    #region set up
    $remote_atts = ['ids','slugs','cat','tag','excerpt','pagination'];
    $limit = 4;

    foreach ($remote_atts as &$attribute) {
        $$attribute =  isset($_GET[$attribute]) ? sanitize_text_field($_GET[$attribute]) : null;
    }
    $excerpt_flag = $excerpt ? 1 : 0;

    // uses var names from $remote_atts[]
    // $query_array is set here.
    require('query_array.php');
    $the_query = new WP_Query($query_array);
    
    if(!$the_query->have_posts()) {
        http_response_code(404);
        echo '<p>no posts found.</p>';
        return;
    }
    http_response_code(200);
    $totalPages = $the_query->max_num_pages;

    #endregion set up

    echo '<input type="hidden" data-totalpages="'.$totalPages.'">';

    #region The Loop
    while ( $the_query->have_posts() ) { $the_query->the_post();
        $img_size = 'pixelgrade_hero_image';
        $img = get_the_post_thumbnail_url( get_the_ID(), $img_size );
        $title = get_the_title();
        $uri = get_permalink();
        $excerpt = $excerpt_flag ? get_the_excerpt() : null;

        // uses var names from $remote_atts[]
        // $singleItemTemplate is set here.
        require('../templates/singleItemTemplate.php');
        echo $singleItemTemplate;

    } // end while
    #endregion The Loop

    wp_reset_postdata();

} // posts_row_ssr()

?>