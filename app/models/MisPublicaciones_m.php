<?php
Class MisPublicaciones_m extends Model {

    public function __construct()
    {   
        parent::__construct();
    }
    /****
     * Insertamos los datos de la vivienda
     */
    public function insertar($datos,$cod){
        $cadSQL="INSERT INTO vivienda VALUES (NULL,:codigoVivienda,:direccion,:numero,:cp,:precio,:pais,:provincia,:localidad,:metros,:venta_alquiler,:planta,
        :tipo,:habitaciones,:banios,:descripcion,:piscina,:aire_acondicionado,:armarios_empotrados,:ascensor,:terraza,:trastero,:garaje,:jardin)";
        $this->consultar($cadSQL);
        $this->enlazar(":codigoVivienda",$cod);
        $this->enlazar(":direccion",$datos['direccion']);
        $this->enlazar(":numero",$datos['numero']);
        $this->enlazar(":cp",$datos['cp']);
        $this->enlazar(":precio",$datos['precio']);
        $this->enlazar(":pais",$datos['pais']);
        $this->enlazar(":provincia",$datos['provincia']);
        $this->enlazar(":localidad",$datos['localidad']);
        $this->enlazar(":metros",$datos['metros']);
        $this->enlazar(":venta_alquiler",$datos['venta_alquiler']);
        $this->enlazar(":planta",$datos['planta']);
        $this->enlazar(":tipo",$datos['tipo']);
        $this->enlazar(":habitaciones",$datos['habitaciones']);
        $this->enlazar(":banios",$datos['banios']);
        $this->enlazar(":descripcion",$datos['descripcion']);
        $this->enlazar(":piscina",isset($datos['piscina'])?1:0);
        $this->enlazar(":aire_acondicionado",isset($datos['aire_acondicionado'])?1:0);
        $this->enlazar(":armarios_empotrados",isset($datos['armarios_empotrados'])?1:0);
        $this->enlazar(":ascensor",isset($datos['ascensor'])?1:0);
        $this->enlazar(":terraza",isset($datos['terraza'])?1:0);
        $this->enlazar(":trastero",isset($datos['trastero'])?1:0);
        $this->enlazar(":garaje",isset($datos['garaje'])?1:0);
        $this->enlazar(":jardin",isset($datos['jardin'])?1:0);
        return $this->ejecutar();
    }
    /****
     * Insertamos la direccion de las imagenes de las viviendas y si es la principal 
     */
    public function insertarImagen($id_vivienda,$camino,$prin){
        $cadSQL="INSERT INTO vivienda_img VALUES(null,$id_vivienda,'$camino',$prin)";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * buscamos la vivienda por el codigo recibido
     */
    public function buscarIdVivienda($cod){
        $cadSQL="SELECT * FROM vivienda WHERE codigoVivienda='$cod'";
        $this->consultar($cadSQL);
        return $this->fila();
    }
    /****
     * Creamos una publicacion
     */
    public function crearPublicacion($id_vivienda,$id_usuario,$fecha){
        $cadSQL="INSERT INTO publicacion VALUES(null,0,$id_usuario,$id_vivienda,'$fecha')";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * buscamos las publicaciones que pertenecen al usuario recibido
     */
    public function buscarMisPublicaciones($idUsuario){
        $cadSQL="SELECT * FROM vista_vivienda_publicaciones_imagenes WHERE principal=1 and(id_usuario=$idUsuario)";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Cambiamos el estado de la publicacion
     */
    public function cambiarActivo($id,$activo){
        $cadSQL="UPDATE publicacion SET activo = $activo WHERE id_vivienda=$id";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Eliminamos la publicacion que se corresponda con el codigo
     */
    public function eliminarPubli($cod){
        $cadSQL="DELETE FROM vivienda WHERE codigoVivienda='$cod'";
        $this->consultar($cadSQL);
        return $this->ejecutar();
    }
    /****
     * Actualizamos los datos de la vivienda con los datos recibidos
     */
    public function editarPublicacion($viviendas){
        $cod=$viviendas['cod'];
        $cadSQL="UPDATE vivienda SET direccion=:direccion,numero=:numero,cp=:cp,precio=:precio,pais=:pais,provincia=:provincia,
        localidad=:localidad,metros=:metros,venta_alquiler=:venta_alquiler,planta=:planta,tipo=:tipo,habitaciones=:habitaciones,
        banios=:banios,descripcion=:descripcion,piscina=:piscina,aire_acondicionado=:aire_acondicionado,armarios_empotrados=:armarios_empotrados,
        ascensor=:ascensor,terraza=:terraza,trastero=:trastero,garaje=:garaje,jardin=:jardin where codigoVivienda='$cod'";
        $this->consultar($cadSQL);
        $this->enlazar(":direccion",$viviendas['direccion']);
        $this->enlazar(":numero",$viviendas['numero']);
        $this->enlazar(":cp",$viviendas['cp']);
        $this->enlazar(":precio",$viviendas['precio']);
        $this->enlazar(":pais",$viviendas['pais']);
        $this->enlazar(":provincia",$viviendas['provincia']);
        $this->enlazar(":localidad",$viviendas['localidad']);
        $this->enlazar(":metros",$viviendas['metros']);
        $this->enlazar(":venta_alquiler",$viviendas['venta_alquiler']);
        $this->enlazar(":planta",$viviendas['planta']);
        $this->enlazar(":tipo",$viviendas['tipo']);
        $this->enlazar(":habitaciones",$viviendas['habitaciones']);
        $this->enlazar(":banios",$viviendas['banios']);
        $this->enlazar(":descripcion",$viviendas['descripcion']);
        $this->enlazar(":piscina",isset($viviendas['piscina'])?1:0);
        $this->enlazar(":aire_acondicionado",isset($viviendas['aire_acondicionado'])?1:0);
        $this->enlazar(":armarios_empotrados",isset($viviendas['armarios_empotrados'])?1:0);
        $this->enlazar(":ascensor",isset($viviendas['ascensor'])?1:0);
        $this->enlazar(":terraza",isset($viviendas['terraza'])?1:0);
        $this->enlazar(":trastero",isset($viviendas['trastero'])?1:0);
        $this->enlazar(":garaje",isset($viviendas['garaje'])?1:0);
        $this->enlazar(":jardin",isset($viviendas['jardin'])?1:0);
        return $this->ejecutar();
    }
}