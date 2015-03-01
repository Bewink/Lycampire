<?php

namespace vendor\befew;

/**
 * Class Controller
 * @package vendor\befew
 */
class Controller {
    protected static $instance = null;

    protected $request;
    protected $tplpath;
    protected $template;

    /**
     * Constructor
     * @param $url
     * @param $action
     */
    public function __construct($url, $action) {
        $action = $action . 'Action';
        $reflector = new \ReflectionClass(get_class($this));

        $fn = DIRECTORY_SEPARATOR . $reflector->getNamespaceName();
        $this->tplpath = str_replace('/', DIRECTORY_SEPARATOR, $fn) . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR;

        $this->template = new Template($this->tplpath);

        $this->request = new Request(new Path($url));

        if(method_exists($this, $action)) {
            $this->$action();
        } else {
            $this->errorAction();
        }
    }

    /**
     * @param int $code
     */
    public function errorAction($code = 404) {
        Response::throwStatus($code);
    }
}