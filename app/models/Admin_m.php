<?php
Class Admin_m extends Model {

    public function __construct()
    {   
        parent::__construct();
    }
    /****
     * Buscamos todas las viviendas que tengan como imagen la principal
     */
    public function buscarTodo(){
        $cadSQL="SELECT * FROM vista_vivienda_publicaciones_imagenes WHERE principal=1";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscamos el usuario que se corresponda con el id recibido
     */
    public function buscarUsu($id){
        $cadSQL="SELECT usuario FROM usuarios WHERE id=$id";
        $this->consultar($cadSQL);
        return $this->fila();
    }
    /****
     * Eliminamos la publicacion de la vivienda que coincida con el codigo
     */
    public function eliminarPublicacion($cod){
        $cadSQL="DELETE FROM vivienda WHERE codigoVivienda='$cod'";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Consultamos el numero de visitas de la web 
     */
    public function verVisitas(){
        $cadSQL="SELECT valor FROM dashboard WHERE id=1";
        $this->consultar($cadSQL);
        return $this->fila();
    }
    /****
     * Consultamos el numero de Usuarios registrados de la web 
     */
    public function verUsuarios(){
        $cadSQL="SELECT valor FROM dashboard WHERE id=2";
        $this->consultar($cadSQL);
        return $this->fila();
    }
    /****
     * Consultamos el numero de publicaciones de la web 
     */
    public function verPublicaciones(){
        $cadSQL="SELECT valor FROM dashboard WHERE id=3";
        $this->consultar($cadSQL);
        return $this->fila();
    }
    /****
     * Actualizamos el numero de visitas de la web 
     */
    public function actualizarVisitas($visitas){
        $cadSQL="UPDATE dashboard SET valor=$visitas WHERE id=1";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Actualizamos el numero de Usuarios registrados de la web 
     */
    public function actualizarUsuarios($usuarios){
        $cadSQL="UPDATE dashboard SET valor=$usuarios WHERE id=2";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Actualizamos el numero de Publicaciones de la web 
     */
    public function actualizarPublicaciones($publicaciones){
        $cadSQL="UPDATE dashboard SET valor=$publicaciones WHERE id=3";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Contamos cuantos usuarios registrados hay 
     */
    public function contarUsuarios(){
        $cadSQL="SELECT COUNT(*) as cuantos FROM usuarios";
        $this->consultar($cadSQL); 
        return $this->fila()['cuantos'];
    }
    /****
     * Contamos cuantas publicaciones hay 
     */
    public function contarPublicaciones(){
        $cadSQL="SELECT COUNT(*) as cuantos FROM publicacion";
        $this->consultar($cadSQL); 
        return $this->fila()['cuantos'];
    }
    /****
     * Contamos cuantos ventas hay 
     */
    public function contarVentas(){
        $cadSQL="SELECT COUNT(*) as cuantos FROM vivienda WHERE venta_alquiler='V'";
        $this->consultar($cadSQL); 
        return $this->fila()['cuantos'];
    }
    /****
     * Contamos cuantos alquileres hay 
     */
    public function contarAlquileres(){
        $cadSQL="SELECT COUNT(*) as cuantos FROM vivienda WHERE venta_alquiler='A'";
        $this->consultar($cadSQL); 
        return $this->fila()['cuantos'];
    }

}