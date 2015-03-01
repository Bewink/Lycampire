<?php

namespace vendor\befew;

/**
 * Class Path
 * @package vendor\befew
 */
class Path {
    private $path;

    /**
     * Constructor
     * @param $path
     */
    public function __construct($path) {
        $this->path = (string)$path;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getPath();
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPathWithWebSeparators() {
        return str_replace('\\', '/', $this->getPath());
    }

    /**
     * @return mixed
     */
    public function withWebSeparators() {
        $this->setPath($this->getPathWithWebSeparators());
    }

    /**
     * @return string
     */
    public function getPathWithoutTrailingSlash() {
        return rtrim($this->getPath(), '\\/');
    }

    /**
     * @return string
     */
    public function removeTrailingSlash() {
        $this->setPath($this->getPathWithoutTrailingSlash());
    }
}