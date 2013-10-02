<?php
use Phpwalk\Core\Dispatcher;
use Phpwalk\Core\Config;

$app_path = __DIR__.'/';
require_once $app_path.'../env.php';

$config = require_once $app_path . 'config/' . (($environment == '') ? '' : $environment.'/') .  'config.php';
Config::init($config);
Config::set('app_path',$app_path);


$path_info = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'';
$dispatcher = new Dispatcher($path_info);
$dispatcher->dispatch();