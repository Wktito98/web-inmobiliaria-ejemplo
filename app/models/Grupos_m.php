<?php
Class Grupos_m extends Model {

    public function __construct()
    {   
        parent::__construct();
    }
    /****
     * Leemos la lista de las plantas para mostrarlas en los select
     */
    public function leerPlanta(){
        $cadSQL="SELECT * FROM planta";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Leemos la lista de los tipos para mostrarlas en los select
     */
    public function leerTipo(){
        $cadSQL="SELECT * FROM tipo_vivienda";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
}