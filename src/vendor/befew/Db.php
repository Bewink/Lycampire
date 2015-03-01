<?php

namespace vendor\befew;

/**
 * Class Db
 * @package vendor\befew
 */
class Db {
    protected static $instance;
    protected $dbh;
    protected $isInitialised = false;

    /**
     * Constructor
     */
    public function __construct() {
        if(!$this->isInitialised) {
            $this->init();
        }
    }

    /**
     * @param $method
     * @param $args
     */
    public function __call($method, $args) {
        if(!method_exists($this, $method)) {
            call_user_func_array([$this->dbh, $method], $args);
        }
    }

    /**
     * Initialisation
     */
    public function init($debug = true) {
        try {
            $this->dbh = new \PDO(DB_DRIVER.':dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD);
        } catch (\PDOException $e) {
            echo 'WARNING: Database connection error: ' . $e->getMessage();
        }

        $this->isInitialised = true;
        $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->setDebugMode($debug);
    }

    /**
     * @param bool $enabled
     */
    public function setDebugMode($enabled = false) {
        if($enabled) {
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } else {
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
        }
    }

    /**
     * @return Db
     */
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Db();
        }
        return self::$instance;
    }
}