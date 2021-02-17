<?php
/**
 * PHPUnit Unit Tests
 *
 * Unit tests for \Sleep\Core\Template
 *
 * php version 7.0.0
 *
 * @category Test
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

require_once dirname(__FILE__) . '/../sleepy/core/Loader.php';

use PHPUnit\Framework\TestCase;
use Sleepy\Core\Hook;
use Sleepy\Core\Loader;
use Sleepy\Core\SM;
use Sleepy\Core\Template;

Loader::register();
Loader::addNamespace('Sleepy', dirname(__FILE__) . '/../sleepy');
Loader::addNamespace('Sleepy\Core', dirname(__FILE__) . '/../sleepy/core');

require_once dirname(__FILE__) . '/../../settings.php';

/**
 * Template Unit Test
 *
 * @category Test
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class TemplateTest extends TestCase
{
    /**
     * Replace placeholder with bind, make sure placeholders are case insensitive,
     * trim whitespace
     *
     * @return void
     * 
     * @covers Template::bind()
     */
    public function testBind()
    {
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('bind');
        $t->bind('   naMe ', 'Sleepy Mustache!');
        ob_start();
        $t->show();
        $name = ob_get_clean();
        $this->assertEquals($name, 'Sleepy Mustache!');
    }

    /**
     * Bind multiple placeholders with an array
     *
     * @return void
     * 
     * @covers Template::bind()
     */
    function testArrayBind()
    {
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('bind');
        $t->bind(
            array(
                'fake' => 'Framework: ',
                'name' => 'Sleepy Mustache!'
            )
        );
        ob_start();
        $t->show();
        $name = ob_get_clean();
        $this->assertEquals($name, 'Framework: Sleepy Mustache!');
    }

    /**
     * Bind large chunks w/ bindStart/bindEnd
     *
     * @return void
     * 
     * @covers Template::bindStart()
     * @covers Template::bindStop()
     */
    function testBindChunk()
    {
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('bind');
        $t->bindStart();
        ?>
        Sleepy Mustache!
        <?php
        $t->bindStop('NaMe ');
        ob_start();
        $t->show();
        $name = ob_get_clean();
        $this->assertEquals(trim($name), 'Sleepy Mustache!');
    }

    /**
     * Test #include placeholder
     * Test hooks inside of included Templates
     *
     * @return void
     * 
     * @covers Template::setTemplate()
     */
    function testInclude()
    {
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('include');
        $t->bind('   naMe ', 'Sleepy Mustache!');
        ob_start();
        $t->show();
        $name = ob_get_clean();

        $this->assertEquals($name, "<h1>Header</h1>\nSleepy Mustache!");
    }

    /**
     * Test placeholder hooks
     *
     * @return void
     * 
     * @covers Template::bind()
     */
    function testPlaceholderHooks()
    {
        /**
         * Function to run if filter works
         *
         * @param string $x The unfiltered content
         *
         * @return string The filtered content
         * 
         * @covers Template::bind()
         */
        function render_placeholder_filter($x)
        {
            return $x . '!';
        }

        Hook::applyFilter('render_placeholder_name', 'render_placeholder_filter');

        // lets capture what the Template
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('bind');
        $t->bind('   naMe ', 'Sleepy Mustache!');
        ob_start();
        $t->show();
        $name = ob_get_clean();

        // test if the extra bang was added
        $this->assertEquals($name, 'Sleepy Mustache!!');
    }

    /**
     * Test placeholder hooks w/ parameters
     *
     * @return void
     * 
     * @covers Template::bind()
     */
    function testPlaceholderHookParameters()
    {
        /**
         * Function to run if filter works
         *
         * @param string $x The unfiltered string
         *
         * @return string The filtered string
         * 
         * @covers Template::show()
         */
        function render_placeholder_parameter($x)
        {
            $colors = array();

            foreach (func_get_args() as $fruit) {
                switch ($fruit) {
                case 'apple':
                    $colors[] = 'Red';
                    break;
                case 'banana':
                    $colors[] = 'Yellow';
                    break;
                }
            }

            return implode(' ', $colors);
        }

        Hook::applyFilter(
            'render_placeholder_colorof',
            'render_placeholder_parameter'
        );

        // lets capture what the Template
        $t = new Template();
        $t->directory = dirname(__FILE__) . "/assets/templates/";
        $t->setTemplate('parameters');
        ob_start();
        $t->show();
        $color = ob_get_clean();

        // test if the extra bang was added
        $this->assertEquals($color, 'Yellow Red');
    }

    /**
     * Test #each placeholder
     *
     * @return void
     * 
     * @covers Template::bind()
     */
    function testEach()
    {
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('each');
        $t->bind(
            'poem',
            array(
                array(
                    'number' => 1,
                    'text'   => 'Roses are red.'
                ), array(
                    'number' => 2,
                    'text'   => 'Violets are blue.'
                ), array(
                    'number' => 3,
                    'text'   => 'Sugar is sweet,'
                ), array(
                    'number' => 4,
                    'text'   => 'and so are you!'
                )
            )
        );
        ob_start();
        $t->show();
        $poem = ob_get_clean();
        $this->assertMatchesRegularExpression(
            '/1. Roses are red(.*)?2. Violets are blue/is',
            $poem
        );
    }

    /**
     * Test inline placeholders
     *
     * @return void
     * 
     * @covers Template::bind()
     */
    function testTwoInline()
    {
        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('two-inline');
        $t->bind('firstname', 'Jaime');
        $t->bind('lastname', 'Rodriguez');
        ob_start();
        $t->show();
        $name = ob_get_clean();

        $this->assertEquals(trim($name), 'Jaime Rodriguez');
    }

    /**
     * Test if Template doesn't exist
     *
     * @return void
     * 
     * @covers Template::setTemplate()
     */
    function testTempl1ateMissing()
    {
        $this->expectExceptionMessageMatches(
            "/Template(.*)missing.tpl' does not exist./"
        );

        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('missing');
        $t->show();
    }

    /**
     * Test in #include doesn't exist
     *
     * @return void
     * 
     * @covers Template::setTemplate()
     */
    function testIncludeMissing()
    {
        $this->expectExceptionMessageMatches(
            "/Template(.*)binding.tpl' does not exist./"
        );

        $t = new Template();
        $t->directory = dirname(__FILE__) . '/assets/templates/';
        $t->setTemplate('binding');
        $t->show();
    }
}