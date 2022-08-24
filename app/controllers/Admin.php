<?php

class Admin extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Generamos el Inicio del modo administrador
     * si el usuario es administrador cargamos su cabecera especifica
     * y si no hacemos un location a inicio para evitar que se entre en modo administrador poniendolo en la url
     */
    public function index(){
        if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['admin']==1){
                $this->load_view("admin/cabeceraAdmin");
            }else{
                header("location:".BASE_URL."Inicio/index");
            }
        }else{
            $this->load_view("plantilla/cabecera");
        }
        $this->load_view("admin/administrar_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Generamos el string de las caracteristicas de las viviendas
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
     * Gestionamos la eliminacion del Administrador cuando seleccione la vivienda que desea eliminar
     */
    public function eliminarPublicacion(){
        $admin_m=$this->load_model("Admin_m");
        $admin_m->eliminarPublicacion($_POST['cod']);
    }
    /****
     * Genera todas las publicaciones para el administrador
     */
    public function genPublicaciones(){
        // Obtener los articulos
        $admin_m=$this->load_model("Admin_m");
        $publicaciones=$admin_m->buscarTodo();
        foreach ($publicaciones as $publ) { 
            //Guardamos en una variable cual es el propietario de la publicacion
            $usuarioPublicacion=$admin_m->buscarUsu($publ['id_usuario']);
            $caracteristicas=$this->generarCaracteristicas($publ);
            //Gestionamos el tipo de pago dependiendo de si es alquiler o venta
            if($publ['venta_alquiler']=="V"){
                $mes="";
            }else{
                $mes=" /mes";
            }
            //Generamos las publicaciones
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
                                <h4 class="card-title">Usuario: <?php echo $usuarioPublicacion['usuario']?></h4>
                                <h5 class="card-title"><?php echo $publ['precio'] ?> €<small><?php echo $mes?></small></h5>
                                <p class="card-text"><?php echo $publ['provincia']." - ".$publ['localidad']?></p>
                                <p class="card-text"><small><?php echo $caracteristicas?></small></p>
                                <p class="card-text scroll" style="height: 110px; overflow: auto;"><small><?php echo $publ['descripcion']?></small></p>
                                <button class="btn btn-danger eliminar" data-cod="<?php echo $publ['codigoVivienda']?>">Eliminar Publicacion</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }   
   } 
}
?>