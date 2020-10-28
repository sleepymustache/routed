<?php
namespace Model;

use \Sleepy\MVC\Model;

class Homepage extends Model {
  public $title = "SleepyMUSTACHE - Home page";
  public $description = "The model is passed into the View and can be accessed using \$model";
  public $keywords = "blog, sleepy mustache, framework";
  public $header =  "sleepy<span>MUSTACHE</span>";
  public $teasers = [[
    "title" => "Getting Started",
    "image"   => "https://unsplash.com/photos/cUJc1mb3KVg/download?w=320",
    "link" => 'http://www.sleepymustache.com/',
    "author" => "Jaime A. Rodriguez",
    "date" => "04/11/1984",
    "description" => "
      Congratulations on successfully installing sleepyMUSTACHE! You can visit the <a 
      href=\"http://www.sleepymustache.com/documentation/index.html\">documentation page</a> to learn more or hit the 
      ground running by viewing the <a href=\"http://www.sleepymustache.com/#getting-started\">getting started</a> 
      section.",
    "tags" => [[
      'name' => "Configuration",
      'link' => "http://www.sleepymustache.com/#getting-started"
    ]]
  ], [
    "title" => "Sample Modules",
    "image"   => "https://unsplash.com/photos/cUJc1mb3KVg/download?w=320",
    "link" => "#",
    "author" => "Jaime A. Rodriguez",
    "date" => "07/31/2020",
    "description" => "
      By default there are 2 sample modules included with the framework.
      These modules demonstrate how to create your own modules, and
     implement existing functionality. You may safely delete them.",
    "tags" => [[
      'name' => "modules",
      'link' => "http://www.sleepymustache.com/#default-modules"
    ], [
      'name' => "fixes",
      'link' => "https://github.com/jaimerod/sleepy-mustache/commits/master"
    ]]
  ]];
}