<?php

use vendor\befew\Db;

define('DEBUG', true);
define('CACHE_TWIG', 'cache' . DIRECTORY_SEPARATOR . 'twig');
define('STYLES_FOLDER', 'css');
define('TEMPLATES_FOLDER', 'twig');
define('SCRIPTS_FOLDER', 'js');

if(DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    Db::getInstance()->setDebugMode(true);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    Db::getInstance()->setDebugMode(false);
}
