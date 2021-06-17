<?php 
$if = function ($condition, $thenString, $elseString=null) { 
    return $condition ? $thenString : $elseString; 
};

$header = "<h2 class='posts-row-wrapper-header'>$heading</h2>";
$footer = "<div class='posts-row-wrapper-footer'><a class='item-read-more' href='$link'>$button</a></div>";

$posts_row = <<<HTML
<section id="posts-row-wrapper-{$row_id}" class="posts-row-wrapper">
    <div class="main">

        {$if( $heading, $header )}
        
        <div class="posts-row" data-remote_location="{$remote_location}" data-pagination="1" >
            <!-- from /api/ endpoint -->
            {$remote_content}
            <!-- /from /api/ endpoint -->
        </div>

        {$if( $link, $footer )}

    </div>

<style>
    .page-of {
        text-align: center;
        margin-top: 1.5rem;
        padding-bottom: .5rem;
        padding-bottom: .45rem;
        color: #444;
    }
</style>

<nav>
    <button title="Previous" class="previous-page hidden" disabled>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </button>
    <button title="Next" class="next-page hidden" disabled>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
</nav>

<p class="page-of hidden">
    <span>
        <span>
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
        <svg style="width: 1.25ex; height:1.25ex; margin-right:1ch;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <div>
            <span>back</span>
            to <b>1<sup>st</sup></b>
        </div>
    </button>
</p>

</section>

HTML;