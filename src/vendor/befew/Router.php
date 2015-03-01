<?php

namespace vendor\befew;

/**
 * Class Router
 * @package vendor\befew
 */
class Router {
    public static function dispatch() {
        $routeFound = false;
        $url = Request::getGet('page', 'index', true);
        $routes = yaml_parse_file(dirname(dirname(dirname(__FILE__))) . '/app/routes.yml');

        foreach($routes as $key => $path) {
            if(strpos($url, $key) === 0) {
                $class = '\\src\\' . str_replace('/', '\\', substr($routes[$key]['file'], 0, strpos($routes[$key]['file'], '.')));
                new $class($url, $routes[$key]['action']);
                $routeFound = true;
                break;
            }
        }

        if($routeFound == false) {
            Response::throwStatus(404);
        }
    }
}