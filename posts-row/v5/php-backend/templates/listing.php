<?php $posts_row = <<<HTML
<div class="posts-row-wrapper first-page" 
	data-paginate="{$paginate}"
>
	<header class="posts-row-header">
		<h2>{$heading}</h2>
		<input data-slot="page-of-wrapper" type="hidden"/>
		<nav class="posts-row-ui-arrows">
			<button title="Previous" class="previous-page arrow" type="button" disabled>
				<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<use href="#arrow-left"></use>
				</svg>
			</button>
			<button title="Next" class="next-page arrow" type="button">
				<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<use href="#arrow-right"></use>
				</svg>
			</button>
		</nav>
	</header>
	<ul class="posts-row" data-pagination="1"
		data-remote_location="{$remote_location}" 
	>
		<!-- from API endpoint -->
		{$remote_content}
		<!-- /from API endpoint -->
	</ul>
	<footer class="posts-row-footer">
		<nav class="posts-row-ui-arrows">
			<button title="Previous" class="previous-page arrow" type="button" disabled>
				<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<use href="#arrow-left"></use>
				</svg>
			</button>
			<div class="width-100">
				<a href="{$link}" 
					class="posts-row-footer-cta button"
					>{$button}</a>
			</div>
			<button title="Next" class="next-page arrow" type="button">
				<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<use href="#arrow-right"></use>
				</svg>
			</button>
		</nav>
	</footer>
</div><!--.posts-row-wrapper-->
HTML;