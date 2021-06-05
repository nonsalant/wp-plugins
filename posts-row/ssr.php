<?php 
/** Endpoint for raw HTML.
 */

#region Endpoint Setup
// allow direct access to this file:
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php'); 
// but only if the plugin is active: 
require_once('../../../wp-admin/includes/plugin.php'); 
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
    foreach ($remote_atts as &$attribute) {
        $$attribute =  isset($_GET[$attribute]) ? sanitize_text_field($_GET[$attribute]) : '';
    }
    
    //$excerpt_flag = (isset($_GET['excerpt'])) ? 1 : 0;
    $excerpt_flag = $excerpt ? 1 : 0;
    $limit = 4;

    #region query setup
    if ($ids) {
        $ids_array = explode(',', $ids);
        $query_array =  array(
            'post_type' => array('post','page'),
            'post__in' => $ids_array,
            'orderby' => 'post__in'
        );
    } else if ($slugs) {
        $slugs_array = explode(',', $slugs);
        $query_array =  array(
            'post_type' => array('post','page'),
            'post_name__in' => $slugs_array,
            'orderby' => 'post_name__in'
        );
    } else if ($tag && $cat) {
        $query_array =  array( 
            'category_name' => $cat,
            'tag' => $tag
        );
    } else if ($tag) {
        $query_array =  array( 
            'tag' => $tag
        );
    } else if ($cat) {
        $query_array =  array( 
            'category_name' => $cat
        );
    } else {
        $query_array = array(); // default query with latest posts
    }
    $query_array = array_merge($query_array, array(
        'posts_per_page' => $limit,
        'paged' => $pagination,
        'post_status' => 'publish'
    ));
    $the_query = new WP_Query($query_array);
    if(!$the_query->have_posts()) {
        http_response_code(404);
        echo '<p>no posts found.</p>';
        return;
    }
    http_response_code(200);
    $totalPages = $the_query->max_num_pages;
    #endregion query setup

    #endregion set up

    echo '<input type="hidden" data-totalpages="'.$totalPages.'">';

    #region The Loop
    while ( $the_query->have_posts() ) { $the_query->the_post();
        #region set up
        $img_size = 'pixelgrade_hero_image';
        $img = get_the_post_thumbnail_url( get_the_ID(), $img_size );
        $post_title = get_the_title();
        $post_excerpt ='';
        if ($excerpt_flag) { 
            $post_excerpt = get_the_excerpt(); 
        }
        $uri = get_permalink();
        #endregion set up
        $loopResult = <<<HTML
            <article class="post type-post status-publish format-standard has-post-thumbnail hentry u-content-bottom-spacing">
                <div class="c-card">
                    <div class="c-card__aside c-card__thumbnail-background">
                        <div class="c-card__frame">
                            <img width="450" height="360" src="{$img}" class="attachment-pixelgrade_card_image size-pixelgrade_card_image wp-post-image is-loaded">
                            <!--<span class="c-card__letter" style="font-size: 90.6617px;">-->
                            <span class="c-card__letter" style="font-size: 126px;">{$post_title[0]}</span>
                        </div>
                    </div>
                    <div class="c-card__content">
                        <h2 class="c-card__title">
                            <span>{$post_title}</span>
                        </h2>
                        <div class="c-card__excerpt">
                            {$post_excerpt}
                        </div>
                        <div class="c-card__footer">
                        <a href="{$uri}" class="c-card__action">READ MORE</a> </div>
                    </div>
                    <a class="c-card__link" href="{$uri}"></a>
                    <div class="c-card__badge"></div>
                </div>
            </article>
        HTML;
        echo $loopResult;
    } // end while
    #endregion The Loop

    wp_reset_postdata();

} // posts_row_ssr()

?>
