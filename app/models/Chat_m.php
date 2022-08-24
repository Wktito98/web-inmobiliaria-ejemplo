<?php
Class Chat_m extends Model {

    public function __construct()
    {   
        parent::__construct();
    }
    /****
     * leemos las conversaciones que tienen los usuarios que recibimos
     */
    public function leerChat($idEmisor,$idReceptor){
        $cadSQL="SELECT * FROM mensajes WHERE (id_emisor=$idEmisor and id_receptor=$idReceptor) OR
        (id_emisor=$idReceptor and id_receptor=$idEmisor)";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscar el nombre de usuario que corresponda con el id
     */
    public function buscarPersona($id){
        $cadSQL="SELECT usuario FROM usuarios WHERE id=$id";
        $this->consultar($cadSQL); 
        return $this->fila();
    }
}