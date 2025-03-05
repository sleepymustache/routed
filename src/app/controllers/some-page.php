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
class SomePage extends Controller
{
    /**
     * Loads the view based on controller-action.php pattern
     *
     * @param Route $route The route
     *
     * @return View
     */
    public function page(Route $route) : View
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
}
