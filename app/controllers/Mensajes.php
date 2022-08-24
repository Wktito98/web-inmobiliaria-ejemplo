<?php
defined("BASEPATH") or die("No se permite la entrada directa a este script");
class Mensajes extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Cargamos las vistas del inicio de los mensajes
     */
    public function index(){
        $this->load_view("plantilla/cabeceraLogin");
        $this->load_view("mensajes_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Marcamos los mensajes del las conversaciones de los usuarios que recibimos por post como leido
     */
    public function leido(){
        $mensajes_m=$this->load_model("Mensajes_m");
        $mensajes_m->marcarLeido($_POST['receptor'],$_SESSION['usuario']['id']);
    }
    /****
     * Generamos Los nombres con las personas que tenemos una conversacion abierta
     */
    public function generarMensajes(){
        $mensajes_m=$this->load_model("Mensajes_m");
        $id=$_SESSION['usuario']['id'];
        $mensajes=$mensajes_m->verMensajes($id);
        if (empty($mensajes)) {
            ?>
            <h1 class="text-white">No tienes Mensajes...</h1>
            <?php
        }else{
        foreach ($mensajes as $men) { 
        $notificaciones=$mensajes_m->leerNotificaciones1($men['id'],$_SESSION['usuario']['id']);
        ?>
        <div class="row justify-content-md-center m-4">
            <div class="col-4 bg-dark persona position-relative nombresChat" data-id="<?php echo $men['id']?>">
            <?php
              if(isset($notificaciones) && $notificaciones!=0){
                ?>
                <span class="position-absolute top-0 start-70 translate-middle badge rounded-pill bg-danger">
                      <?php echo $notificaciones?></span>
                <?php
              }
              ?>
                <h1 class="text-white text-center"><?php echo $men['usuario']?></h1>
            </div>
        </div>
        <?php 
        }}
    }
    /****
     * Eviamos el mensaje con al usuario que recibimos por post y le ponemos la fecha y hora del momento que se envie
     */
    public function enviarMensaje(){
        $mensajes_m=$this->load_model("Mensajes_m");
        $id_receptor=$_POST['id_receptor'];
        $mensaje=$_POST['mensaje'];
        ini_set('date.timezone','Europe/Madrid');
        $fecha= date('Y/m/d',time());
        $hora= date('H:i:s',time());
        $id_emisor=$_SESSION['usuario']['id'];
        $mensajes_m->enviarMensaje($id_emisor,$id_receptor,$mensaje,$fecha,$hora);
    }
}
?>