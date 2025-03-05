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
use Sleepy\MVC\Router;
use Sleepy\MVC\View;
use Sleepy\Core\SM;
use \Module\DB\Connection;
use \Module\DB\Record;
use \Module\DB\RecordList;


class TodoRecord extends Record
{
    public $table = "todos";
}

/**
 * Home Controller
 *
 * @category Controller
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class Todo extends Controller
{

    public $db;

    public function __construct()
    {
        parent::__construct();

        DB::$dbhost = 'localhost';
        DB::$dbname = 'db';
        DB::$dbuser = 'username';
        DB::$dbpass = 'itsmeopenup';
        
        $this->db = C::Connection();
      
        // $todos = new \Module\DB\RecordList(new Todo());
        // foreach ($todos as $t) {
        //     $t->columns['active'] = 0;
        //     $t->save();
        // }
    }

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

        $todos = new RecordList(new TodoRecord());

        foreach ($todos as $t) {
            echo $t->columns['description'];
        }

        // Render the page using the homepage template and the content stored
        // inside of the Homepage Model
        return new View(new \Model\Todo(), $view );
    }

    /**
     * Loads the view based on controller-action.php pattern
     *
     * @param Route $route The route
     *
     * @return View
     */
    public function add(Route $route) : View
    {
        // Getting route info
        $controller = $route->params["controller"];
        $action     = $route->params["action"];
        $id         = $route->params["id"];
        $view       = "{$controller}-{$action}";

        $u = new TodoRecord();
        $u->columns['description'] = $_POST['item'];
        $u->save();

        header('Location: /todo');
        return new View(new \Model\Todo(), $view);
    }
}
