<?php
defined("BASEPATH") or die("No se permite acceso directo");
class ErrorPage extends Controller {

    public function __construct()
    {
        
    }

    public function index(){
        $this->load_view("errorPage");
    }
}