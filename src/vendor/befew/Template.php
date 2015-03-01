<?php

namespace vendor\befew;

/**
 * Class Template
 * @package vendor\befew
 */
class Template {
    private $twig;
    private $path;
    private $styles;
    private $scripts;
    private $footScripts;
    private $datas;

    /**
     * Constructor
     * @param $path
     */
    public function __construct($path) {
        $this->styles = [];
        $this->scripts = [];
        $this->path = new Path($path);

        $loader = new \Twig_Loader_Filesystem(realpath($_SERVER["DOCUMENT_ROOT"]));
        $this->twig = new \Twig_Environment($loader, [
            'cache' => CACHE_TWIG,
            'debug' => DEBUG
        ]);

        $this->datas = [
            'errors' => [],
            'warnings' => [],
            'infos' => []
        ];
    }

    /**
     * @param $level
     * @param $string
     */
    public function addMessage($level, $string) {
        if(!in_array($level, ['error', 'warning', 'info'])) {
            $level = 'info';
        }

        $this->datas[$level . 's'][] = $string;
    }

    /**
     * @param $path
     */
    public function addCSS($path) {
        array_push($this->styles, $this->path->getPathWithWebSeparators() . STYLES_FOLDER . '/' . $path);
    }

    /**
     * @param $path
     * @param bool $head
     */
    public function addJS($path, $head = true) {
        if($head) {
            $this->scripts[] = $this->path->getPathWithWebSeparators() . SCRIPTS_FOLDER . '/' . $path;
        } else {
            $this->footScripts[] = $this->path->getPathWithWebSeparators() . SCRIPTS_FOLDER . '/' . $path;
        }
    }

    /**
     * @param $file
     * @param array $vars
     */
    public function render($file, $vars = []) {
        echo $this->twig->render(
            $this->path . TEMPLATES_FOLDER . DIRECTORY_SEPARATOR . $file,
            array_merge(
                $vars,
                $this->datas,
                [
                    'styles' => $this->styles,
                    'scripts' => $this->scripts,
                    'footScripts' => $this->footScripts
                ]
            )
        );
    }
}