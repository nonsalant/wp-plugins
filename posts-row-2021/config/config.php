<?php

// used im front-end/index.php, front-end/assets.php, api/index.php

$posts_row_template = 'default';

$posts_row_template_file = __DIR__ . '/../templates/' . $posts_row_template . '/index.php';

$posts_row_single_item_template_file = __DIR__ . '/../templates/' . $posts_row_template . '/single_item.php';

// this doesn't work (needs __DIR__/ in front)
// //$posts_row_single_item_template_file = '../templates/' . $posts_row_template . '/single_item.php';
