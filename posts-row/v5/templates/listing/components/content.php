<?php

namespace PostsRow;
// die($remote_location);
return function () use ($remote_location, $remote_content) {
	return <<<HTML
<ul 
        class="posts-row" 
		data-remote_location="{$remote_location}" 
        data-pagination="1"
	>
	<!-- from API endpoint -->
		{$remote_content}
	<!-- /from API endpoint -->
	</ul>
HTML;
};

// $posts_row_content = function() use ($remote_location, $remote_content) 
// {
//     return createElement(
//         'ul',
//         [
//             "\n		<!-- from API endpoint -->\n		",
//             $remote_content,
//             "\n		<!-- /from API endpoint -->\n	"
//         ],
//         [
//             'class' => 'posts-row',
//             'data-remote_location' => $remote_location,
//             'data-pagination' => 1
//         ]
//     );
// };
