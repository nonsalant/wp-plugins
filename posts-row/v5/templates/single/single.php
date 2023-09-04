<?php

namespace PostsRow;

// sanitization is done in loop.php (📁api)

// components
$prel_header ??= include('components/header.php');
$prel_body_content ??= include('components/body-content.php');
$prel_footer ??= include('components/footer.php');

// layout
// todo: wrap all inside .prel (header and body) in <div class="prel-container">
return <<<HTML

		<li class="prel">
			{$prel_header()}
			<div class="prel-body">
				{$prel_body_content()}
				{$prel_footer()}
			</div>
		</li>
HTML;