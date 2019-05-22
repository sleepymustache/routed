<?php
// initialize sleepyMUSTACHE
require_once(__DIR__ . '/app/core/sleepy.php');

use \Sleepy\Router;
use \Sleepy\RouteNotFound;

// basic routing with defaults
Router::mvc([
  '{{ controller }}/{{ action }}/{{ id }}',
  '{{ controller }}/{{ action }}',
  '{{ controller }}',
  '/'
]);

// Catch 404 or errors
try {
  Router::start();
} catch (RouteNotFound $e) {
  Router::redirect('home', 'pageNotFound');
} catch (Exception $e) {
  Router::redirect('home', 'error', array(
    'error' => $e
  ));
}