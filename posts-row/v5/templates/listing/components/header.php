<?php

namespace PostsRow;

$header_paged = function () {
    return <<<HTML
    <input data-slot="page-of-wrapper" type="hidden"/>
            <nav class="posts-row-ui-arrows">
                <button title="Previous" class="previous-page arrow" type="button" disabled>
                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <use href="#arrow-left"></use>
                    </svg>
                </button>
                <button title="Next" class="next-page arrow" type="button">
                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <use href="#arrow-right"></use>
                    </svg>
                </button>
            </nav>
    HTML;
};

return function () use ($heading, $paginate, $if, $header_paged) {
    
	return <<<HTML
<header class="posts-row-header">
        {$if(
            $heading,
            '<h2' . $if(!$paginate, ' style="margin-block-end: var(--gap);"') . '>' . $heading . '</h2>'
        )}
        {$if($paginate, $header_paged())}
    </header>
HTML;
};

// <style>.margin-block-end { margin-block-end: var(--gap); }</style>
// '<h2 ' . $if(!$paginate, ' style="margin-block-end: var(--gap);"') . ' >' . $heading . '</h2>'