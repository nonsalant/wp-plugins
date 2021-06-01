<?php

#region set up
// default atts (overriden by user atts)
$posts_row_atts = shortcode_atts(
    array(
        'ids' => '',
        'slugs' => '',
        'cat' => '',
        'tag' => '',
        'heading' => 'Featured Posts',
        'link' => '',
        'button' => '',
        'excerpt' => 0
    ), $atts
);

global $row_id;
$row_id++;

$ids    = $posts_row_atts['ids'];
$slugs  = $posts_row_atts['slugs'];
$cat    = $posts_row_atts['cat'];
$tag    = $posts_row_atts['tag'];
$heading= $posts_row_atts['heading'];
$button = $posts_row_atts['button'];
$link   = $posts_row_atts['link'];


$site_url = get_site_url();
$ssr_location = "/wp-content/plugins/posts-row/ssr.php";
$ssr_params = "?ids=$ids";
    $ssr_params .= "&slugs=$slugs";
    $ssr_params .= "&cat=$cat";
    $ssr_params .= "&tag=$tag";
if ( ( 1 == $posts_row_atts['excerpt']) ) {
    $ssr_params .= "&excerpt";
}

ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11) AppleWebKit/601.1.56 (KHTML, like Gecko) Version/9.0 Safari/601.1.56');
$full_ssr_location = $site_url . $ssr_location . $ssr_params;
$ssr = file_get_contents( $full_ssr_location ); 
#endregion set up

$initial_content = <<<HTML
<div id="posts-row-wrapper-{$row_id}" class="widget-area">
    <section id="featured-posts-grid-123" class="widget widget--full widget_featured_posts_grid">
        <h2 class="widget__title">
            <span>{$heading}</span>
        </h2>
        <div data-ssr_location="{$full_ssr_location}" data-pagination="1" class="featured-posts-grid o-grid o-grid--4col-@small aspect-ratio-landscape 
        featured-posts--show-readmore">
            <!-- from ssr.php endpoint -->
            {$ssr}
            <!-- /from ssr.php endpoint -->
        </div>
        <div class="featured-posts__footer">
            <a class="featured-posts__more" href="{$link}">
                {$button}
            </a>
        </div>
    </section>

    <style>
        .page-of {
            text-align: center;
            margin-top: 1.5rem;
            padding-bottom: .5rem;
            padding-bottom: .45rem;
            color: #444;
        }
    </style>
    <p class="page-of hidden">
        <span>
            <span style="font-size:1.2em;">
                <em>page</em> 
                <b class="page-of--current">1</b> 
                <em>of</em> 
            </span>
            <button>
                <span class="page-of--total">multiple</span>
            </button> 
        </span>
        <br>
        <button class="go-to-page-1 hidden">
            <svg style="max-width: 1.25ex;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <div>
                <span>back</span>
                to <b>1<sup>st</sup></b>
            </div>
        </button>
    </p>
    <nav>
        <button title="Previous" class="previous-page hidden" disabled>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </button>
        <button title="Next" class="next-page hidden" disabled>
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </nav>
</div>
HTML;
?>
