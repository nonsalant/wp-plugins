<?php

add_action('enqueue_block_editor_assets', 'loadPostsRowTestBlock');
function loadPostsRowTestBlock() {
    wp_enqueue_script(
        'posts-row-block-script',
        plugin_dir_url(__FILE__) . 'build/index.js',
        array('wp-blocks', 'wp-editor'),
        true
    );
}