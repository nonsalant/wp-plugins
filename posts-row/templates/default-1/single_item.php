<?php

//$excerpt_container = "<div class='excerpt'>$excerpt</div>";

$single_item = <<<HTML
<article class="posts-row-item">
        <div class="">
            <a class="thumb" href="{$uri}" >
                <img width="450" height="360" src="{$img}" class="posts-row-thumb">
            </a>
        </div>
        <div class="">
            <h3 class="title">
                <a class="" href="{$uri}" >{$title}</a>
            </h3>

            {$if($excerpt, // $excerpt_container
                "<div class='excerpt'>$excerpt</div>"
            )}
            
            <div class="">
                <a class="readmore" href="{$uri}" >READ MORE</a> 
            </div>
        </div>
</article>
HTML;