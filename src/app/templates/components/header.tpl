<!DOCTYPE html>
<!--[if lt IE 9 ]>	  <html class="ie ie8 {{ urlClass }}" lang="en"> <![endif]-->
<!--[if IE 9 ]>		  <html class="ie ie9 {{ urlClass }}" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="{{ urlClass }}" lang="en"><!--<![endif]-->
<head>
	<!-- META DATA -->
	<meta charset="utf-8">
	<meta name="keywords" content="{{ keywords }}">
	<meta name="description" content="{{ description }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ title }}</title>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/css/main.css">

	<!-- JAVASCRIPT -->
	<script async data-main="{{ URLBASE }}js/main" src="{{ URLBASE }}js/require.js" ></script>

	<!-- SHIV -->
	<!--[if lt IE 9]>
		<script src="{{ URLBASE }}js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
	<div class="wrapper">
		<header>
			<h1>{{ header }}</h1>

			<nav class="top">
				<ul>
					<li>
						<a href="<?=Sitemap::link('1.1');?>"><?=Sitemap::title('1.1');?></a>
					</li>
					<li>
						<a href="<?=Sitemap::link('1.2');?>"><?=Sitemap::title('1.2');?></a>
					</li>
					<li>
						<a href="<?=Sitemap::link('1.3');?>"><?=Sitemap::title('1.3');?></a>
					</li>
				</ul>
			</nav>
		</header>
		<main class="content">