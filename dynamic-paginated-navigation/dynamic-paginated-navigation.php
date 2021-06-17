<?php
/**
 * Plugin Name:      Dynamic Paginated Navigation [block pattern]
 * Plugin URI:       https://csspan.com/dynamic-paginated-navigation/
 * Description:      Block pattern that adds dynamic pagination functionality to a native WP Query Block. The initial content (1st page of results) of the Query Block is still rendered on the server, but navigation is added that, when clicked, loads new content without reloading the whole page. The last part is done by loading the content in chunks at the client (browser) level, and uses vanilla JavaScript with no dependencies.
 * Version:     1.0.0
 * Author:      Stefan Matei
 * Author URI:  https:/stefanmatei.com/
 * Text Domain: dynamic-paginated-navigation
 * License:		GPL-3.0+
 * License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
 */

function dyPagNav() {

	// ! To fix: {"moreText":"Read More"} and {"wordCount":20} don't have any effect on wp:post-excerpt
	// * https://jsonformatter.org/json-escape (see index.html for unescaped gutenberg html)
	#region
	$contentDefault = "<!-- wp:query {\"queryId\":47,\"query\":{\"perPage\":4,\"pages\":0,\"offset\":0,\"postType\":\"post\",\"categoryIds\":[],\"tagIds\":[],\"order\":\"desc\",\"orderBy\":\"date\",\"author\":\"\",\"search\":\"\",\"exclude\":[],\"sticky\":\"\",\"inherit\":false},\"tagName\":\"section\",\"displayLayout\":{\"type\":\"list\",\"columns\":3}} -->\n<section class=\"wp-block-query\"><!-- wp:query-pagination {\"align\":\"center\"} -->\n<div class=\"wp-block-query-pagination aligncenter\"><!-- wp:query-pagination-previous /-->\n\n<!-- wp:query-pagination-numbers /-->\n\n<!-- wp:query-pagination-next /--></div>\n<!-- /wp:query-pagination -->\n\n<!-- wp:query-loop -->\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"25%\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:25%\"><!-- wp:post-featured-image {\"isLink\":true,\"align\":\"center\"} /--></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"75%\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:75%\"><!-- wp:post-title {\"isLink\":true} /--></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n<!-- /wp:query-loop -->\n\n<!-- wp:query-pagination {\"align\":\"center\"} -->\n<div class=\"wp-block-query-pagination aligncenter\"><!-- wp:query-pagination-previous /-->\n\n<!-- wp:query-pagination-numbers /-->\n\n<!-- wp:query-pagination-next /--></div>\n<!-- /wp:query-pagination --></section>\n<!-- /wp:query -->";
	#endregion
	$contentRow = "<!-- wp:query {\"queryId\":47,\"query\":{\"perPage\":4,\"pages\":0,\"offset\":0,\"postType\":\"post\",\"categoryIds\":[],\"tagIds\":[],\"order\":\"desc\",\"orderBy\":\"date\",\"author\":\"\",\"search\":\"\",\"exclude\":[],\"sticky\":\"\",\"inherit\":false},\"tagName\":\"section\",\"displayLayout\":{\"type\":\"list\",\"columns\":3}} -->\n<section class=\"wp-block-query\">\n\n<!-- wp:query-pagination {\"align\":\"center\"} -->\n<div class=\"wp-block-query-pagination aligncenter\"><!-- wp:query-pagination-previous /-->\n<!-- wp:query-pagination-numbers /-->\n<!-- wp:query-pagination-next /--></div>\n<!-- /wp:query-pagination -->\n\n<!-- wp:query-loop -->\n<!-- wp:post-featured-image {\"isLink\":true,\"align\":\"wide\"} /-->\n<!-- wp:post-title {\"isLink\":true} /-->\n<!-- wp:post-excerpt {\"moreText\":\"Read More\"}  {\"wordCount\":20} /-->\n<!-- wp:post-date /-->\n<!-- /wp:query-loop -->\n\n</section>\n<!-- /wp:query -->";
	$content = $contentRow;
	//$contentFromFile = file_get_contents('block-templates/escaped.txt');

	// https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/
	register_block_pattern(
		'sm-block-patterns/sm-dynamic-paginated-navigation',
		array(
			'title'       	=> __( '⬅️ Dynamic Paginated Navigation ➡️',	'sm-block-patterns' ),
			'description' 	=> _x( 'The native WP Query Block is still rendered on the server, but navigation is added that, when clicked, loads new content without reloading the whole page. The last part is done by loading the content in chunks at the client (browser) level, and uses vanilla JavaScript with no dependencies.',		'sm-block-patterns'),
			'content'		=> $content,
			'categories'	=> array( 'query' ),
			'keywords' 		=> array('arrows','ajax','api','block','query','next','previous','navigation','nav','pagination','paginate','pattern','spa','ssr'),
		)
	);

}    

add_action( 'init', 'dyPagNav' );