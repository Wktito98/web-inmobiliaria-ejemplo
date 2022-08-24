<?php
class Router {

    // Propiedades de la clase
    private $uri; // Array que contiene las diferentes partes de la URI
    private $controller;
    private $method;
    private $params;

    public function __construct(){
        $this->setUri();
        $this->setController();
        $this->setMethod();
        $this->setParams();
    }

    ////////////// Metodos Setters
    public function setUri(){
        $this->uri=explode("/",$_SERVER['REQUEST_URI']);
    }
    public function setController(){
        $this->controller=$this->uri[2]=="" ? DEFAULT_CONTROLLER : $this->uri[2];
    }
    public function setMethod(){
        $this->method=empty($this->uri[3]) ? "index" : $this->uri[3];
    }
    public function setParams(){
        for ($ind=4;$ind<count($this->uri); $ind++){
            $this->params[]=!isset($this->uri[$ind]) ? "" : $this->uri[$ind];
        }
    }
    ///////////////// Metodos Getters
    public function getUri(){
        return $this->uri;
    }
    public function getController(){
        return $this->controller;
    }
    public function getMethod(){
        return $this->method;
    }
    public function getParams(){
        return $this->params;
    }
}