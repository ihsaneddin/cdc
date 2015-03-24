<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$CI = & get_instance();
$CI->load->database();
$config = $CI->db;

$capsule = new Capsule;

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => $config->hostname,
	'database' => $config->database,
	'username' => $config->username,
	'password' => $config->password,
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' =>'',
]);

$capsule->getContainer()->bind('paginator', function() {
    // View initialization
    $views = __DIR__ . '/views';
    $cache = __DIR__ . '/cache';
    $blade = new \Philo\Blade\Blade($views, $cache);

    return new \Illuminate\Pagination\Factory(
        // Initialize and setup Request
        \Illuminate\Http\Request::createFromGlobals(),
        // Get ViewFactory instance
        $blade->view(),
        // Initialize Translator
        new \Symfony\Component\Translation\Translator('en')
    );
});

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();