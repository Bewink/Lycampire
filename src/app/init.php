<?php
use vendor\befew\Db;

require_once('vendor/twig/twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

if(!class_exists('PDO')) {
    exit('FATAL ERROR: PDO isn\'t enabled on this server');
}

/**
 * Autoloader for spl_autoload_register
 *
 * @param $classname
 */
function autoloader($classname) {
    $classname = str_replace("_", "\\", $classname);
    $classname = ltrim($classname, '\\');
    $filename = '';
    $lastNsPos = strripos($classname, '\\');
    if ($lastNsPos) {
        $namespace = substr($classname, 0, $lastNsPos);
        $classname = substr($classname, $lastNsPos + 1);
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $filename .= str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';

    require $filename;
}

spl_autoload_register('autoloader');

Db::getInstance()->init();