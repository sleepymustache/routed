<?php
	// initialize sleepyMUSTACHE
	require_once($_SERVER['DOCUMENT_ROOT'] . '/app/core/sleepy.php');

	// basic routing with defaults
	\Sleepy\Router::mvc([
		'{{ controller }}/{{ action }}/{{ id }}',
		'{{ controller }}/{{ action }}',
		'{{ controller }}',
		'/'
	]);

	// If the route throws an exception, show the 404 page
	try {
		\Sleepy\Router::start();
	} catch (\Sleepy\RouteNotFound $e) {
		\Sleepy\Router::redirect('home', 'pageNotFound', array(
			'error' => $e
		));
	} catch (\Exception $e) {
		\Sleepy\Router::redirect('home', 'error', array(
			'error' => $e
		));
	}