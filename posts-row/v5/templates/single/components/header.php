<?php

namespace PostsRow;

return function () {
    // global $title, $excerpt, $uri;
    $prel_img__safe = function () {
        global $img, $img_alt;
        if (!$img) return;
        return createElement(
            'img',
            null,
            [
                'src' => $img,
                'width' => '500',
                'height' => '725',
                'alt' => $img_alt,
                'loading' => 'lazy'
            ],
            true // forceSafe
        );
    };
    if (!$prel_img__safe) return;
    return createElement(
        'header',
        [$prel_img__safe()],
        ['class' => 'prel-header']
    );
};