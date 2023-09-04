<?php

namespace PostsRow;

return function () {
    global $morelink;
    if (!$morelink) return;
    $readmore__safe = function () {
        global $uri, $title;
        $sr_only__safe = function () {
            global $title;
            return createElement(
                'span',
                [
                    '&nbsp;', 'about', '&nbsp;', 
                    $title
                ],
                ['class' => 'sr-only'],
                true // forceSafe
            );
        };
        return createElement(
            'a',
            ['read more', $sr_only__safe()],
            ['class' => 'prel-action', 'href' => $uri, 'title' => $title]
        );
    };
    return createElement(
        'footer',
        [$readmore__safe()],
        'prel-footer'
    );
};
