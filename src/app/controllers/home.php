<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/sleepy/bootstrap.php';

use Sleepy\MVC\Controller;
use Sleepy\MVC\Model;
use Sleepy\MVC\Route;
use Sleepy\MVC\View;
use Sleepy\Core\SM;

/**
 * The default controller
 */
class Home extends Controller {
  /**
   * Loads the view based on controller-action.php pattern
   */
  public function index(Route $route) : View {
    // Getting route info
    $controller = $route->params['controller'];
    $action     = $route->params['action'];
    $id         = $route->params['id'];
    $view       = "{$controller}-{$action}";

    // Create a model to pass to the view
    $model = new Model();
    $model->title = "SleepyMUSTACHE - Home page";
    $model->description = "The model is passed into the View and can be accessed using \$model";
    $model->keywords = "blog, sleepy mustache, framework";
    $model->header = "sleepy<span>MUSTACHE</span>";
    $model->teasers = array(
      array(
        "title" => "Getting Started",
        "link" => 'http://www.sleepymustache.com/',
        "author" => "Jaime A. Rodriguez",
        "date" => date('m/d/Y', time()),
        "description" => "
          Congratulations on successfully installing sleepyMUSTACHE! You can visit the <a href=\"http://www.sleepymustache.com/documentation/index.html\">documentation page</a> to learn more or hit the ground running by viewing the <a href=\"http://www.sleepymustache.com/#getting-started\">getting started</a> section.",
        "tags" => array(
          array(
            'name' => "Configuration",
            'link' => "http://www.sleepymustache.com/#getting-started"
          )
        )
      ), array(
        "title" => "Sample Modules",
        "link" => "#",
        "author" => "Jaime A. Rodriguez",
        "date" => date('m/d/Y', time() - 30 * 24 * 60 * 60),
        "description" => "
          By default there are 2 sample modules included with the
          framework. These modules demonstrate how to create your own
          modules, and implement existing functionality. You may safely
          delete them.",
        "tags" => array(
          array(
            'name' => "modules",
            'link' => "http://www.sleepymustache.com/#default-modules"
          ),
          array(
            'name' => "fixes",
            'link' => "https://github.com/jaimerod/sleepy-mustache/commits/master"
          )
        )
      )
    );

    // Render the page using the homepage template and the $model
    return new View($model, "homepage"); 
  }

  /**
   * Page not found
   */
  public function pageNotFound(Route $route) : View {
    http_response_code(404);

    $model = new Model();
    $model->title = "SleepyMUSTACHE - Page Not Found";
    $model->error = "Page Not Found";

    return new View($model, '404');
  }

  /**
   * Oops, there is an error of some kind.
   */
  public function error(Route $route) : View {
    http_response_code(500);

    $model = new Model();
    $model->title = "SleepyMUSTACHE - Error";

    // Only show errors in the Live environment
    if (SM::isLive()) {
      $model->error = $route->params['error']->getMessage();
    }

    return new View($model, 'error');
  }
}