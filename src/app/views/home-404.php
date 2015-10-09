<?php
	// SEO
	$page->bind('title', 'Page not found');
	$page->bind('description', '');
	$page->bind('keywords', '');

	// Content
	$page->bindStart();
?>
	<h1>Page not found</h1>
	<p>The page you have requested does not exist. Please try another page, or
	use the search functionality above.</p>
<?php
	if (\Sleepy\SM::isDev() && isset($error)) {
		?>
			<h2>Error</h2>
			<p><?=$error?></p>
		<?php
	}

	$page->bindStop('content');