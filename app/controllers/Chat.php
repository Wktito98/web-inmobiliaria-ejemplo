<?php
defined("BASEPATH") or die("No se permite la entrada directa a este script");
class Chat extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Generamos el Inicio del Chat y recojemos por la url con quien es la conversacion
     */
    public function index($persona=[]){
        $datos['receptor']=$persona[0];
        $chat_m  = $this->load_model('Chat_m');
        $nombre=$chat_m->buscarPersona($persona[0]);
        $datos['nombreUsuario']=$nombre['usuario'];
        $this->load_view("plantilla/cabeceraLogin");
        $this->load_view("chat_v",$datos);
        $this->load_view("plantilla/pie");
    }
    /****
     * Generamos el chat
     */
    public function genChat(){
        $idReceptor=$_POST['receptor'];
        $chat_m  = $this->load_model('Chat_m');
        $mensajes = $chat_m->leerChat($_SESSION['usuario']['id'],$idReceptor);
        foreach($mensajes as $men){
            //Elegimos la ubicacion del mensaje (Izquierda o Derecha)
            if($men['id_emisor']==$_SESSION['usuario']['id']){
                $ubicacion="globoDer";
            }else{
                $ubicacion="globoIz";
            }
        ?>
            <div class="<?php echo $ubicacion?>">
                <p class="mensaje"><?php echo $men['mensaje']?><br><small class="fecha <?php echo $ubicacion?>"><?php echo $men['fecha']?> - <?php echo $men['hora']?></small></p>
            </div>
        <?php
        }
    }
}
?>