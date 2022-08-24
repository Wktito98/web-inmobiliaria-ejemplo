<?php
Class Mensajes_m extends Model {

    public function __construct()
    {   
        parent::__construct();
    }
    /****
     * Mostramos los usuarios con los que tenemos una conversacion sin repetir 
     */
    public function verMensajes($id){
        $cadSQL="SELECT DISTINCT usuarios.id,nombre,usuario FROM usuarios INNER JOIN mensajes on 
        usuarios.id=mensajes.id_emisor or usuarios.id=mensajes.id_receptor WHERE usuarios.id!=$id and 
        (mensajes.id_receptor=$id or mensajes.id_emisor=$id)";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Enviamos un mensaje con los datos que recibimos
     */
    public function enviarMensaje($id_emisor,$id_receptor,$mensaje,$fecha,$hora){
        $cadSQL="INSERT INTO mensajes VALUES (NULL,$id_emisor,$id_receptor,'$mensaje','$fecha','$hora',0)";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Leemos las notificaciones generales
     */
    public function leerNotificaciones($idUsu){
        $cadSQL="SELECT COUNT(*) as cuantos FROM mensajes WHERE leido=0 and id_receptor=$idUsu";
        $this->consultar($cadSQL); 
        return $this->fila()['cuantos'];
    }
    /****
     * Leemos las notificaciones especificas
     */
    public function leerNotificaciones1($idEmisor,$idReceptor){
        $cadSQL="SELECT COUNT(*) as cuantos FROM mensajes WHERE leido=0 and id_emisor=$idEmisor and id_receptor=$idReceptor";
        $this->consultar($cadSQL);
        return $this->fila()['cuantos'];
    }
    /****
     * Marcamos como leido el mensaje de los usuarios recibidos
     */
    public function marcarLeido($id_emisor,$id_receptor){
        $cadSQL="UPDATE mensajes set leido=1 where id_emisor=$id_emisor and id_receptor=$id_receptor";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
}