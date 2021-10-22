<?php
/*
Plugin Name: Posts Row
Plugin URI: https://csspan.com/posts-row/
Description: Adds a row of featured content. (Select posts and/or pages by tag, category, slugs, or ID's.) Useful for adding a row of related posts or inside category descriptions or other navigational pages.
Version: 1.0.0
Author: Stefan Matei
Author URI: https://stefanmatei.com
Text Domain: posts-row
Released under the GNU General Public License (GPL)
http://www.gnu.org/licenses/gpl.txt
Tags: arrows, ajax, api, query, next, previous, navigation, nav, pagination, paginate, spa, ssr
*/

require('front-end/index.php');

###### testing for new aw2g front page

// change how "shortcode preview" blocks are displayed (3rd party plugin)

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




/**/
## Styles from Customizer
add_action( 'admin_footer', function() { ?>
	<!-- Styles from Customizer -->
	<!-- <link href="./wp-content/plugins/posts-row/templates/blocksy/css/style.css"> -->
<?php } );
/**/

/** 
// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');
function gutenberg_editor_assets() {
    // Load the theme styles within Gutenberg.
    wp_enqueue_style('my-gutenberg-editor-styles', '/wp-content/plugins/posts-row/templates/blocksy/css/style.css', FALSE);
}
**/