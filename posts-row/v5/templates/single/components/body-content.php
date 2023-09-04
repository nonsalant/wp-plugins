<?php

namespace PostsRow;

return function() {
    global $morelink, $excerpt, $title;
    $title_tag = 'h3';

    $title_in_a__safe = function () {
        global $title, $uri;
        return createElement(
            'a',
            $title,
            ['class' => 'prel-action', 'href' => $uri, 'title' => $title]
        );
    };

    $excerpt_in_p__safe = function() {
        global $excerpt;
        if (!$excerpt) return;
        return createElement(
            'p',
            $excerpt,
            'excerpt'
        );
    };

    $prel_title__unsafe = function($unsafe_content, $excerpt = false, $h = 'h3') {
        // add the title (in p, or heading——if there's an excerpt)
        $tag = $excerpt ? $h : 'p';
        if (!$unsafe_content) return;
        return createElement(
            $tag,
            [$unsafe_content],
            'prel-title'
        );
    };

    if ($morelink)
        $output = $prel_title__unsafe(sanitize($title), $excerpt, $title_tag);
    else
        $output = $prel_title__unsafe($title_in_a__safe(), $excerpt, $title_tag);

    // add excerpt (in p)
    if ($excerpt) $output .= "\n				";
    $output .= $excerpt_in_p__safe();

    return $output;
};
