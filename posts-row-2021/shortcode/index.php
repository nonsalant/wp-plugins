<?php

// enqueue scripts & styles
include('assets.php');

require('shortcode-posts-row.php');
// this could be used just for edit: func
require('shortcode-posts-row-inner.php');


function posts_row_remove_spaces($value) {
    return str_replace(' ', '', $value);
}

// change how "shortcode preview" blocks are displayed 
// inside the "shortcode with preview block" (3rd party) plugin
add_action( 'admin_footer', function() { ?>
    <!-- shortcode-preview block -->
    <style>
    [data-type="shortcode-preview/shortcode-preview"] {
        background: linear-gradient(
    179deg, rgba(250,235,215,1) -1rem, rgb(250 235 215 / 15%) 10rem);
        border-radius: 0.5rem 0.5rem 0 0;
        border: dashed 1px rgb(0 0 0 / 25%);
        /* border-top: none; */
    }
    [data-type="shortcode-preview/shortcode-preview"] .swp-rnk-main {
        background: none;
        border: none;
        min-height: unset;
        border-radius: 0.5rem 0.5rem 0 0;
        border: solid 1px rgba(250,235,215,1);
        box-shadow: 0 2px 6px 0 rgb(130 108 78 / 50%);
    }
    /* make card header more compact */
    [data-type="shortcode-preview/shortcode-preview"] .swp-rnk-main {
        display: flex;
        flex-direction: row;
        gap: 1rem;
        align-items: center;
    }
    [data-type="shortcode-preview/shortcode-preview"] .components-placeholder__label {
        margin-bottom: unset;
        min-width: 10ch;
    }

    [data-type="shortcode-preview/shortcode-preview"] .swp-rnk-preview .swp-rnk-preview {
        transform: scale(98%);
    }
    </style>
<?php } );