<?php

namespace APIModule\Framework;

use RuntimeException;

class Router {

    public $RequestMethod;
    public $Endpoint;
    public $Status;
    public $Routes;
    public $ClassName;
    public $Method;

    public function __construct(string $RequestMethod, string $Endpoint) {

        if (!defined('ROOT_PATH'))
            throw new RuntimeException('ROOT_PATH variable not defined.');

        $this->RequestMethod = $RequestMethod;
        $this->Endpoint = $Endpoint;
        $this->Routes = include(ROOT_PATH . '/config/routes.php');

        $this->Status = $this->checkRoute();

        if ($this->Status) {
            $this->ClassName = $this->getClass();
            $this->Method = $this->getMethod();
        }
    }

    public function checkRoute() {
        return isset($this->Routes[$this->RequestMethod][$this->Endpoint]);
    }

    public function getClass() {
        return new $this->Routes[$this->RequestMethod][$this->Endpoint]['Class'];
    }

    public function getMethod() {
        return $this->Routes[$this->RequestMethod][$this->Endpoint]['Method'];
    }
}