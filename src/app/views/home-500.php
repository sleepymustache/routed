<?php
	// SEO
	$page->bind('title', 'Server Error');
	$page->bind('description', '');
	$page->bind('keywords', '');

	// Content
	$page->bind('header', 'sleepy<span>MUSTACHE</span>');
	$page->bindStart();
?>
	<h1>Server Error</h1>
	<p>The server has encountered an error.</p>
<?php
	if (null !== $page->get('error')) {
		?>
			<h2>Error</h2>
			<p><?=$page->get('error');?></p>
		<?php
	}

	$page->bindStop('content');