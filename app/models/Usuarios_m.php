<?php
class Usuarios_m extends Model {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Leemos los usuarios que coincidan con el usuario
     */
    public function leerUsuario($usu){
        $cadSQL="SELECT * FROM usuarios WHERE usuario=:usu";
        $this->consultar($cadSQL);
        $this->enlazar(":usu",$usu);
        return $this->fila();
    }
    /****
     * Insertamos los datos del nuevo usuario
     */
    public function insertar($datos){
        $cadSQL="INSERT INTO usuarios VALUES (NULL,:nombre,:apellidos,:telefono,:email,:usuario,:clave,:admin)";
        $this->consultar($cadSQL);
        $this->enlazar(":nombre",$datos['nombre']);
        $this->enlazar(":apellidos",$datos['apellidos']);
        $this->enlazar(":telefono",$datos['telefono']);
        $this->enlazar(":email",$datos['email']);
        $this->enlazar(":usuario",$datos['usuario']);
        $this->enlazar(":clave",$datos['clave']);
        $this->enlazar(":admin",0);
        return $this->ejecutar();
    }
    /**** 
     * Comprobamos que los datos que recibimos no existen
    */
    public function comprobarDatosRegistro($usuemailtel){
        $cadSQL="SELECT * FROM usuarios WHERE usuario=:usuemailtel OR email=:usuemailtel OR telefono=:usuemailtel";
        $this->consultar($cadSQL);
        $this->enlazar(":usuemailtel",$usuemailtel);
        return $this->fila();
    }
}