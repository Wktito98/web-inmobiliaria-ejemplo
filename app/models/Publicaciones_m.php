<?php
class Publicaciones_m extends Model {

    public function __construct()
    {
        parent::__construct();
    }
    /***
     * Buscamos las viviendas que coincidan con la provincia y el tipo indicado
     */
    public function buscarInicial($provincia,$venta_alquiler){
        
        $cadSQL="SELECT * FROM vista_vivienda_publicaciones_imagenes WHERE principal=1 
        and (provincia like '%$provincia%') 
        and (venta_alquiler = '$venta_alquiler') 
        and (activo=1)";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscamos las viviendas con los filtros elegidos
     */
    public function buscarInicialFilter($provincia,$venta_alquiler,
    $tipo,$precioMin,$precioMax,$tamañoMin,$tamañoMax,$habitaciones,$baños,$aire,
    $armario,$ascensor,$garaje,$jardin,$piscina,$terraza,$trastero,$bajos,$intermedias,$ultima){
        $cadFilter="";
        $cadFilter.=$tipo?" and (tipo=".$tipo.")":"";
        $cadFilter.=$precioMin?" and (precio>=".$precioMin.")":"";
        $cadFilter.=$precioMax?" and (precio<=".$precioMax.")":"";
        $cadFilter.=$tamañoMin?" and (metros>=".$tamañoMin.")":"";
        $cadFilter.=$tamañoMax?" and (precio<=".$tamañoMax.")":"";
        $cadFilter.=$habitaciones!=99?" and (habitaciones=".$habitaciones.")":"";
        $cadFilter.=$baños!=99?" and (banios=".$baños.")":"";
        $cadFilter.=$aire=="true"?" and (aire_acondicionado=1)":"";
        $cadFilter.=$armario=="true"?" and (armarios_empotrados=1)":"";
        $cadFilter.=$ascensor=="true"?" and (ascensor=1)":"";
        $cadFilter.=$garaje=="true"?" and (garaje=1)":"";
        $cadFilter.=$jardin=="true"?" and (jardin=1)":"";
        $cadFilter.=$piscina=="true"?" and (piscina=1)":"";
        $cadFilter.=$terraza=="true"?" and (terraza=1)":"";
        $cadFilter.=$trastero=="true"?" and (trastero=1)":"";
        $cadFilter.=$bajos=="true"?" and (planta=1)":"";
        $cadFilter.=$intermedias=="true"?" and (planta=2)":"";
        $cadFilter.=$ultima=="true"?" and (planta=3)":"";
        $cadSQL="SELECT * FROM vista_vivienda_publicaciones_imagenes WHERE principal=1 
        and (provincia like '%$provincia%') 
        and (venta_alquiler = '$venta_alquiler') 
        and (activo=1)".$cadFilter;
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscamos la vivienda que coincida con el codigo indicado
     */
    public function buscarVivienda($cod){
        $cadSQL="SELECT * FROM vivienda WHERE codigoVivienda='$cod'";
        $this->consultar($cadSQL);
        return $this->fila();
    }
    /****
     * buscamos las imagenes de la vivienda indicada
     */
    public function leerImagenesVivienda($id){
        $cadSQL="SELECT * FROM vivienda_img WHERE id_vivienda=$id";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscar todas las Provincias que hay
     */
    public function buscarProvincias(){
        $cadSQL="SELECT DISTINCT provincia FROM vivienda";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscamos las viviendas que se han publicado hoy
     */
    public function buscarNuevas(){
        $fecha_actual=date("Y-m-d",time());
        $cadSQL="SELECT camino,codigoVivienda FROM vista_vivienda_publicaciones_imagenes where principal=1 and fechaPublicacion='$fecha_actual' and activo=1";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
    /****
     * Buscamos la fehca de publicacion de la vivienda
     */
    public function buscarFecha($id){
        $cadSQL="SELECT fechaPublicacion FROM publicacion where id_vivienda=$id";
        $this->consultar($cadSQL);
        return $this->resultado();
    }
}