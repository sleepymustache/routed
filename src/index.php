<?php
/**
 * Index Page
 *
 * PHP version 7.0.0
 *
 * @category Page
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/sleepy/bootstrap.php';

use \Sleepy\MVC\Router;
use \Sleepy\MVC\RouteNotFound;

// basic routing with defaults
Router::mvc(
    [
        '{{ controller }}/{{ action }}/{{ id }}',
        '{{ controller }}/{{ action }}',
        '{{ controller }}',
        '/'
    ]
);

// Catch 404 or errors
try {
    Router::start();
} catch (RouteNotFound $e) {
    Router::redirect('home', 'pageNotFound');
} catch (Exception $e) {
    Router::redirect(
        'home',
        'error',
        [
            'error' => $e
        ]
    );
}