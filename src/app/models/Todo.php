<?php
/**
 * Homepage Model
 *
 * PHP version 7.0.0
 *
 * @category Model
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

namespace Model;

use \Sleepy\MVC\Model;

/**
 * Homepage Class
 *
 * @category Model
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class Todo extends Model
{
    use Isi;

    public $title = "SleepyMUSTACHE - Test page";
    public $description = "The model is passed into the View and can be accessed
        using \$model";
    public $keywords = "blog, sleepy mustache, framework";
    public $header =  "sleepy<span>MUSTACHE</span>";
    public $teasers = [];
}
