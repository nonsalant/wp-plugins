<?php 

namespace PostsRow;
// sanitization is done in posts-row-atts.php (📁core)

// components
$posts_row_header ??= include('components/header.php');
$posts_row_content ??= include('components/content.php');
$posts_row_footer ??= include('components/footer.php');

// layout
return <<<HTML

<div data-paginate="{$paginate}" class="posts-row-wrapper first-page">
	{$posts_row_header()}
	{$posts_row_content()}
	{$posts_row_footer()}
</div><!--.posts-row-wrapper-->
HTML;
