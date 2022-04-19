<?php
session_start();
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/_configs/config.php';
require_once dirname(__DIR__) . '/_helpers/functions.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/*
 * CONSTANTES
 */
define('ROOT', dirname(__DIR__));
define('URL', str_replace("/public/index.php", "", $_SERVER['SERVER_PROTOCOL'] === 'https' ? 'https' : 'http' . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

use App\Router;

$router = new Router();