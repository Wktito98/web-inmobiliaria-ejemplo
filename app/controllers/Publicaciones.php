<?php
class Publicaciones extends Controller {

    public function __construct(){
        parent::__construct();
        
    }
    /****
     * Generamos la vista del inicio del apartado de las publicaciones
     * y si se generan filtros se los pasamos a la vista 
     */
    public function index($filter=[]) {
        if(!isset($filter[1])){
            $filter[0]="";
        }
        $datos['venta_alquiler']=$filter[0];
        $datos['provincia']=$filter[1];
        if($filter[0]){
            $datos['nuevos']="nuevo";
        }
        if(isset($_SESSION['usuario'])){
            $mensajes_m = $this->load_model('Mensajes_m');
            $datos['notificaciones']=$mensajes_m->leerNotificaciones($_SESSION['usuario']['id']);
            $this->load_view("plantilla/cabeceraLogin",$datos);
        }else{
            $this->load_view("plantilla/cabecera");
        }
        $this->load_view("publicaciones_v",$datos);
        $this->load_view("plantilla/pie");
    }
    /****
     * Generamos las caracteristicas de la vivienda 
     */
    private function generarCaracteristicas($pub){
        $caracteristicas="";
        if ($pub['habitaciones']>0 && $pub['habitaciones']==1) {
            $caracteristicas.=$pub['habitaciones']." hab - ";
        }else{
            $caracteristicas.=$pub['habitaciones']." habs - ";
        }
        if ($pub['banios']>0 && $pub['banios']==1) {
            $caracteristicas.=$pub['banios']." baño - ";
        }else{
            $caracteristicas.=$pub['banios']." baños - ";
        }
        $caracteristicas.=$pub['piscina']>0?"Piscina - ":"";
        $caracteristicas.=$pub['aire_acondicionado']>0?"Aire Acondicionado - ":"";
        $caracteristicas.=$pub['armarios_empotrados']>0?"Armarios Empotrados - ":"";
        $caracteristicas.=$pub['ascensor']>0?"Ascensor - ":"";
        $caracteristicas.=$pub['terraza']>0?"Terraza - ":"";
        $caracteristicas.=$pub['trastero']>0?"Trastero - ":"";
        $caracteristicas.=$pub['garaje']>0?"Garaje - ":"";
        $caracteristicas.=$pub['jardin']>0?"Jardin":"";
        //Si el ultimo caracter de la cadena es vacio lo eliminamos
        $ultimoCaracter=substr($caracteristicas, -1);
        if ($ultimoCaracter==" ") {
            $caracteristicas=substr($caracteristicas, 0, -3);
        }
        return $caracteristicas;
    }
    /****
     * Generamos la lista de las publicaciones si existen filtros filtramos y si no no
     */
    public function genPublicaciones(){
        // Obtener los articulos
        $publicaciones_m=$this->load_model("Publicaciones_m");
        if(isset($_POST['filtro'])){
            if(isset($_POST['habitaciones'])){
                $habitaciones=$_POST['habitaciones'];
            }else{
                $habitaciones=99;
            }
            if(isset($_POST['baños'])){
                $baños=$_POST['baños'];
            }else{
                $baños=99;
            }
            $publicaciones=$publicaciones_m->buscarInicialFilter($_POST['prov'],
            $_POST['venta_alquiler'],$_POST['tipo'],
            $_POST['precio_min'],$_POST['precio_max'],
            $_POST['tamaño_min'],$_POST['tamaño_max'],
            $habitaciones,$baños,
            $_POST['aire'],$_POST['armario'],
            $_POST['ascensor'],$_POST['garaje'],
            $_POST['jardin'],$_POST['piscina'],
            $_POST['terraza'],$_POST['trastero'],
            $_POST['bajos'],$_POST['intermedias'],
            $_POST['ultima']);
        }else{
            $publicaciones=$publicaciones_m->buscarInicial($_POST['prov'],$_POST['venta_alquiler']);
        }
        if($publicaciones){
        foreach ($publicaciones as $publ) { 
            $caracteristicas=$this->generarCaracteristicas($publ);
            $publ['precio']=number_format($publ['precio'],0, ',', '.');
            if($publ['venta_alquiler']=="V"){
                $mes="";
            }else{
                $mes=" /mes";
            }
            ?>
            <div class="col-12">
                <div class="card text-white bg-dark mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?php echo BASE_URL.$publ['camino'];?>" class="card-img imagen" 
                            data-id="<?php echo $publ['codigoVivienda']?>" 
                            alt="ImagenCasa" width="350px" height="350px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $publ['precio'] ?> €<small><?php echo $mes?></small></h3>
                                <p class="card-text"><?php echo $publ['provincia']." - ".$publ['localidad']." - ".$publ['direccion']." Nº: ".$publ['numero']?></p>
                                <p class="card-text"><small><?php echo $caracteristicas?></small></p>
                                <p class="card-text scroll" style="height: 110px; overflow: auto;"><small><?php echo $publ['descripcion']?></small></p>
                                <?php if (isset($_SESSION['usuario'])) {
                                    ?>
                                    <div class="d-flex justify-content-around align-items-center">
                                        <button class="btn btn-primary m-3 contactar"
                                        data-id="<?php echo $publ['id_usuario']?>"
                                        ><i class="bi bi-chat"></i> Enviar Mensaje</button>
                                        <p class="card-text text-center"><small>Publicada: <?php echo $publ['fechaPublicacion']?></small></p>
                                    </div>
                                    <?php
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }}else{?>
            <h1 class="text-white">No hay Resultados...</h1>
        <?php }
   }
   /****
    * Generamos la vista detallada de la publicacion recibida por parametro de URL
    */
   public function detalles($cod=[]){
       $publicaciones_m=$this->load_model("Publicaciones_m");
       $datos['vivienda']=$publicaciones_m->buscarVivienda($cod[0]);
       $idVivienda=$publicaciones_m->buscarVivienda($cod[0]);
       $datos['vivienda']['precio']=number_format($datos['vivienda']['precio'],0, ',', '.');
       $datos['imagenes']=$publicaciones_m->leerImagenesVivienda($idVivienda['id']);
       $datos['caracteristicas']=$this->generarCaracteristicas($datos['vivienda']);
       $datos['fechaPublicacion']=$publicaciones_m->buscarFecha($idVivienda['id']);
       if(isset($_SESSION['usuario'])){
       $this->load_view("plantilla/cabeceraLogin");
       }else{
       $this->load_view("plantilla/cabecera");
       }
       $this->load_view("publicacion_v",$datos);
       $this->load_view("plantilla/pie");
   }
}