<?php
/**
 * Home Controller
 *
 * PHP version 7.0.0
 *
 * @category Controller
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/sleepy/bootstrap.php";

use Sleepy\MVC\Controller;
use Sleepy\MVC\Model;
use Sleepy\MVC\Route;
use Sleepy\MVC\View;
use Sleepy\Core\SM;

/**
 * Home Controller
 *
 * @category Controller
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class Home extends Controller
{
    /**
     * Loads the view based on controller-action.php pattern
     *
     * @param Route $route The route
     *
     * @return View
     */
    public function index(Route $route) : View
    {
        // Getting route info
        $controller = $route->params["controller"];
        $action     = $route->params["action"];
        $id         = $route->params["id"];
        $view       = "{$controller}-{$action}";

        // Render the page using the homepage template and the content stored
        // inside of the Homepage Model
        return new View(new \Model\Homepage(), "homepage");
    }

    /**
     * Page not found
     *
     * @param Route $route The route
     *
     * @return View
     */
    public function pageNotFound(Route $route) : View
    {
        http_response_code(404);

        // You can define models using this shorthand
        return new View(
            new Model(
                [
                    "title"  => "SleepyMUSTACHE - Page not found",
                    "header" => "We've looked high and low",
                    "error"  => "We're unable to locate the page you requested.
                        Please try again later/"
                ]
            ),
            "error"
        );
    }

    /**
     * Oops, there is an error of some kind.
     *
     * @param Route $route The route
     *
     * @return View
     */
    public function error(Route $route) : View
    {
        http_response_code(500);

        // This way is pretty flexible
        $model = new Model();
        $model->title  = "SleepyMUSTACHE - Error";
        $model->header = "Something is broken...";

        // Only show errors in the Live environment
        if (SM::isLive()) {
            $model->error = "The website encounted and error. Please try again
                later.";
        } else {
            $model->error = $route->params["error"]->getMessage();
        }

        return new View($model, "error");
    }
}
