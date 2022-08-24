<?php
if (session_id() === "") {
    session_start();
}

define("BASEPATH",true);
require "system/config.php";
// Incluir las clases del core
require "system/core/autoload.php";
// Instanciar la clase Router;
$router=new Router();

$controlador=$router->getController();
$metodo=$router->getMethod();
$parametros=$router->getParams();


// Cmprobar que el controlador exista
if (!is_file(PATH_CONTROLLERS.$controlador.".php")) $controlador="ErrorPage";
// Cargar el controlador escrito en la URI
include PATH_CONTROLLERS.$controlador.".php";

// Instanciamos el controlador de la URI
$miControlador=new $controlador();

// Comprobar que esa clase controladora tenga el metodo que se quiere ejecutar

if (!method_exists($controlador,$metodo)) $metodo="index";

// Ejecutamos metodo de la URI
if (empty($parametros)){
    $miControlador->$metodo();
} else {
    $miControlador->$metodo($parametros);
}

