<?php

namespace src\Home;

use vendor\befew\Controller;

/**
 * Class HomeController
 * @package src\Home
 */
class HomeController extends Controller {
    public function indexAction() {
        $this->template->addCSS('screen.css');
        $this->template->addJS('main.js');
        $this->template->render('index.html.twig');
    }
}