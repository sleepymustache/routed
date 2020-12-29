<!DOCTYPE html>
<html class="{{ urlClass }}" lang="en">
<head>
  <!-- META DATA -->
  <meta charset="utf-8">
  <meta name="keywords" content="{{ keywords }}">
  <meta name="description" content="{{ description }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ title }}</title>

  <!-- FRAME BUSTING -->
  <style>html {display:none}</style>
  <script>(self == top) ?	document.documentElement.style.display = 'block' : top.location = self.location;</script>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="/css/main.css">

  <!-- JAVASCRIPT -->
  <script async src="/js/main.bundle.js"></script>

  <!-- FAVICON -->
  <link rel="apple-touch-icon" href="/images/icons/favicon-96x96.png">
  <link rel="icon" href="/images/icons/favicon.ico">
  <!--[if IE]><link rel="shortcut icon" href="/favicon.ico"><![endif]-->
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/images/icons/favicon-96x96.png">
</head>
<body>
  <header>
    <div class="wrapper">
      {{ #include components/top-menu }}
      <h1>{{ header }}</h1>
    </div>
    {{ #include components/main-menu }}
  </header>
  <main>
    <div class="wrapper">