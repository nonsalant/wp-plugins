<?php
/** 
 * Endpoint for raw HTML.
 */

require('setup.php');

// $posts_row_template = 'default';
//$posts_row_template = 'blocksy';
require('../templates/template-settings.php');

$posts_row_single_item_template_file = '../templates/'.$posts_row_template.'/single_item.php';

// uses $remote_atts[]
require( 'build-query.php' );
// $the_query is set here

echo '<input type="hidden" data-totalpages="'.$the_query->max_num_pages.'">';

// uses $the_query, $posts_row_single_item_template_file
require( 'loop.php' );
// echoes all items

?>