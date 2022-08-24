<?php
Class Notificaciones_m extends Model {

    public function __construct()
    {   
        parent::__construct();
    }
    /****
     * Modificamos las preferencias del usuario con los nuevos datos
     */
    public function modificarNotificaciones($id_usuario,$precio,$tipo,$notificaciones){
        $cadSQL="UPDATE preferencias SET precio = $precio, tipo = '$tipo', notificaciones = $notificaciones WHERE id_usuario=$id_usuario";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Consultamos cuales son las preferencias del usuario
     */
    public function buscarMisNotificaciones($usuario){
        $cadSQL="SELECT * FROM preferencias WHERE id_usuario=$usuario";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscamos los emails de las personas que coincidan sus preferencias con la nueva publicacion
     */
    public function buscarPreferencias($tipo,$precio){
        $cadSQL="SELECT email FROM `usuarios` LEFT JOIN preferencias on usuarios.id=preferencias.id_usuario WHERE preferencias.notificaciones=1 and preferencias.tipo='$tipo' and preferencias.precio>=$precio";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
}