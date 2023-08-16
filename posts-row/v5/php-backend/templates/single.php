<?php
$if = function ($condition, $thenString, $elseString = null) {
	return $condition ? $thenString : $elseString;
};

$single_item = <<<HTML
<li class="prel">
	<header class="prel-header">
		<img 
			width="450" 
			height="360"
			loading="lazy" 
			src="{$img}" 
			alt="{$img_alt}"
		/>
	</header>
	<div class="prel-body">
		{$if($excerpt, "<h2>$title</h2><p class='excerpt'>$excerpt</p>")}
		{$if(!$excerpt, "<p>$title</p>")}
		<footer class="prel-footer">
			<a 
				class="prel-action" 
				href="{$uri}" 
				title="{$title}"
			>read more<span class="sr-only"> about {$title}</span>
			</a>
		</footer>
	</div>
</li>
HTML;
