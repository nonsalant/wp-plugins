<?php

namespace PostsRow;

$button_prev = function () {
return <<<HTML

            <button title="Previous" class="previous-page arrow" type="button" disabled>
                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <use href="#arrow-left"></use>
                </svg>
            </button>

HTML;
};

$button_next = function () {
return <<<HTML

            <button title="Next" class="next-page arrow" type="button">
                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <use href="#arrow-right"></use>
                </svg>
            </button>
        
HTML;
};

$button_cta = function () {
    global $link, $button;
    if(!$link || !$button) return;
    return <<<HTML
            <div class="width-100">
                <a href="{$link}" class="posts-row-footer-cta button">{$button}</a>
            </div>
HTML;
};

$footer_nav = function()  use (
    $button_next,
    $button_cta,
    $button_prev,
    $link,
    $button,
    $paginate,
    $if
) {
    // if all 3 buttons are missing
    if( !$paginate && (!$link || !$button) ) return; 

    return createElement(
        'nav',
        [
            $if($paginate, $button_prev()),
            $if($link && $button, $button_cta()),
            $if($paginate, $button_next())
        ],
        'posts-row-ui-arrows'
    );
};

return function() { 
    global $footer_nav;
    if (!$footer_nav) return;
return <<<HTML
<footer class="posts-row-footer">
        {$footer_nav()}
    </footer>
HTML; };
