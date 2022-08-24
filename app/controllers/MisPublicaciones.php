<?php
defined("BASEPATH") or die("No se permite la entrada directa a este script");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require ROOT.'app/assets/libs/PHPMailer/src/Exception.php';
require ROOT.'app/assets/libs/PHPMailer/src/PHPMailer.php';
require ROOT.'app/assets/libs/PHPMailer/src/SMTP.php';
class MisPublicaciones extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Cargamos las vistas del inicio de las publicaciones del usuario
     * tambien vemos si tenemos notificaciones
     */
    public function index(){
        $mensajes_m = $this->load_model('Mensajes_m');
        $datos['notificaciones']=$mensajes_m->leerNotificaciones($_SESSION['usuario']['id']);
        $this->load_view("plantilla/cabeceraLogin",$datos);
        $this->load_view("misPublicaciones_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Enviamos los datos de los select a la vista de publicar anuncio
     */
    public function publicar(){
        $grupos_m=$this->load_model("Grupos_m");
        $datos['planta']=$grupos_m->leerPlanta();
        $datos['tipo']=$grupos_m->leerTipo();
        $this->load_view("plantilla/cabeceraLogin");
        $this->load_view("publicar_v",$datos);
        $this->load_view("plantilla/pie");
    }
    /****
     * Insertamos la publicacion que recibimos del usuario
     */
    public function insertarPublicacion(){
        //este metodo recibe los datos del registro para insertarlos en la bbdd
        $misPublicaciones_m = $this->load_model('MisPublicaciones_m');
        //Generamos un codigo para añadirlo a la vivienda y poder diferenciarla del resto
        $bytes = random_bytes(5);
        $num=bin2hex($bytes);
        $cod="";
        $cod="COD".$num;
        $misPublicaciones_m->insertar($_POST,$cod);
        $vivienda=$misPublicaciones_m->buscarIdVivienda($cod);
        $fecha=date("Y-m-d",time());
        $misPublicaciones_m->crearPublicacion($vivienda['id'], $_SESSION['usuario']['id'],$fecha);
        if (isset($_FILES['imagenes'])){    
            // Subir las imagenes a la carpeta de imagenes
            $files = array(); 
            foreach ($_FILES['imagenes'] as $clave => $fichero) {
                foreach ($fichero as $indice => $valor) {
                    if (!array_key_exists($indice, $files))
                    $files[$indice] = array();
                    $files[$indice][$clave] = $valor;
                }
            } 
            $datos['mensaje']=array();
            $nimage=0;  
            foreach ($files as $file) {
                $uploader=new Uploader();
                $uploader->setDir(ROOT.'img/');
                $uploader->setExtensions(array('jpg','jpeg'));  //lista de extensiones permitidas
                $uploader->setMaxSize(3);//Poner tamaño maximo permitido
                
                if($uploader->uploadFile($file)){   //$file es cada fichero subido 
                    $misPublicaciones_m->insertarImagen($vivienda['id'],"img/".$uploader->getUploadName(),$nimage==0 ? 1 : 0);
                    $nimage++;
                } else {//upload failed
                    $datos['mensaje'][]=$uploader->getMessage(); //Obtener el error si lo hay   
                }
            }
        }
        $notificaciones_m= $this->load_model('Notificaciones_m');
        $preferencias=$notificaciones_m->buscarPreferencias($_POST['venta_alquiler'],$_POST['precio']);
        header('Location: '.BASE_URL.'MisPublicaciones');
        foreach ($preferencias as $pref) {
            $this->enviarCorreoNotificaciones($pref['email']);
        }
    }
    /**Aqui enviamos el correo de las notificaciones al email de la persona con las que coincidan con sus preferencias */
    private function enviarCorreoNotificaciones($email){
        //Creamos una instancia del PHPMailer; pasando un true habilitamos las excepciones
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'hellohomesupp@gmail.com';                     //SMTP username
            $mail->Password   = 'segadbrbtmfg';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('hellohomesupp@gmail.com', 'HelloHome');
            $mail->addAddress($email, 'HelloHome');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Nuevas Publicaciones';
            $mail->Body    = '<h2>Hay Nuevas Publicaciones en nuestra Web que se ajustan a Ti. http://localhost/Inmobiliaria/</h2>';
            $mail->AltBody = 'Notificacion, Una Nueva Publicacion';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    /****
     * Cambia el estado de la publicacion de publico o privado
     */
    public function cambiarEstado(){
        $misPublicaciones_m = $this->load_model('MisPublicaciones_m');
        $cod=$_POST['cod'];
        $vivienda=$misPublicaciones_m->buscarIdVivienda($cod);
        $misPublicaciones_m->cambiarActivo($vivienda['id'],$_POST['activo']);
    }
    /****
     * Eliminamos la publicacion del codigo que recibimos por post
     */
    public function elimimnarPublicacion(){
        $misPublicaciones_m = $this->load_model('MisPublicaciones_m');
        $cod=$_POST['cod'];
        $misPublicaciones_m->eliminarPubli($cod);
    }
    /****
     * Cargamos la vista de editor de la vivienda que recibimos por parametro de la url
     */
    public function editar($datos=[]){
        $codigoVivienda=$datos[0];
        $misPublicaciones_m = $this->load_model('MisPublicaciones_m');
        $datos=$misPublicaciones_m->buscarIdVivienda($codigoVivienda);
        $grupos_m=$this->load_model("Grupos_m");
        $datos['plantas']=$grupos_m->leerPlanta();
        $datos['tipos']=$grupos_m->leerTipo();
       $this->load_view("plantilla/cabeceraLogin");
       $this->load_view("editarPublicacion_v",$datos);
       $this->load_view("plantilla/pie");
    }
    /****
     * Editamos la vivienda con los datos que recibimos por post
     */
    public function editarPublicacion(){
        $misPublicaciones_m = $this->load_model('MisPublicaciones_m');
        $misPublicaciones_m->editarPublicacion($_POST);
        $this->load_view("plantilla/cabeceraLogin");
        $this->load_view("misPublicaciones_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Generamos las catacteristicas que tienen las publicaciones para mostrarlas
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
     * Generamos la lista de publicaciones del usuario
     */
    public function genMisPublicaciones(){
        // Obtener los articulos
        $misPublicaciones_m=$this->load_model("MisPublicaciones_m");
        $publicaciones=$misPublicaciones_m->buscarMisPublicaciones($_SESSION['usuario']['id']);
        foreach ($publicaciones as $publ) { 
            $caracteristicas=$this->generarCaracteristicas($publ);
            $publ['precio']=number_format($publ['precio'],0, ',', '.');
            $activo=$publ['activo']?"checked":"";
            ?>
            <div class="col-12">
                <div class="card text-white bg-dark mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?php echo BASE_URL.$publ['camino'];?>" class="card-img img-fluid" alt="ImagenCasa" width="300px" height="300px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $publ['precio'] ?> €<small> /mes</small></h5>
                                <p class="card-text"><?php echo $publ['provincia']." - ".$publ['localidad']?></p>
                                <p class="card-text"><small><?php echo $caracteristicas?></small></p>
                                <p class="card-text scroll" style="height: 75px; overflow: auto;"><small><?php echo $publ['descripcion']?></small></p>
                            </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="button" class="btn btn-info editar"
                            data-id="<?php echo $publ['codigoVivienda']?>">
                            <i class="bi bi-pencil-square"></i> Editar</button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-danger eliminar" 
                            data-id="<?php echo $publ['codigoVivienda']?>">
                            <i class="bi bi-trash"></i> Eliminar</button>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-switch switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    data-id="<?php echo $publ['codigoVivienda']?>"
                                    id="activo"
                                    <?php echo $activo?>
                                />
                                <label class="form-check-label" for="activo">Visible</label>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }
   }
}