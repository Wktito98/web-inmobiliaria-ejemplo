<?php
defined("BASEPATH") or die("No se permite la entrada directa a este script");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require ROOT.'app/assets/libs/PHPMailer/src/Exception.php';
require ROOT.'app/assets/libs/PHPMailer/src/PHPMailer.php';
require ROOT.'app/assets/libs/PHPMailer/src/SMTP.php';
class Inicio extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Generamos el index del Inicio que carga la pagina principal y las distintas cabeceras dependiendo si
     * estamos logeados o no y de si somos admin.
     * Tambien leemos si tenemos notificaciones pendientes y se la enviamos a la cabecera
     */
    public function index(){
        $admin_m=$this->load_model('Admin_m');
        $visitas=$admin_m->verVisitas();
        $admin_m->actualizarVisitas($visitas['valor']+1);
        $publicaciones_m = $this->load_model('Publicaciones_m');
        $datos['nuevas']=$publicaciones_m->buscarNuevas();
        if(isset($_SESSION['usuario'])){
            $mensajes_m = $this->load_model('Mensajes_m');
            $datos['notificaciones']=$mensajes_m->leerNotificaciones($_SESSION['usuario']['id']);
            $datos['provincias']=$publicaciones_m->buscarProvincias();
            if($_SESSION['usuario']['admin']==1){
                $this->load_view("admin/cabeceraAdmin");
            }else{
                $this->load_view("plantilla/cabeceraLogin",$datos);
            }
        }else{
            $this->load_view("plantilla/cabecera");
        }
        if(isset($provincias)){
            $this->load_view("inicio_v",$datos);
        }else{
            $this->load_view("inicio_v",$datos);
        }
        $this->load_view("plantilla/pie");
    }
    /****
     * Cargamos las vistas para hacer login
     */
    public function login() {
        $this->load_view("plantilla/cabecera");
        $this->load_view("login_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Cargamos las vistas para registrarse
     */
    public function registro() {
        $this->load_view("plantilla/cabecera");
        $this->load_view("registro_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Recibimos por post los datos del registro y los insertamos en la base de datos,
     * Encriptamos la clave antes de guardarla, 
     * y enviamos un correo de bienvenida
     */
    public function insertarUsuario() {
        $usuarios_m = $this->load_model('Usuarios_m');
        $_POST['clave']=password_hash($_POST['clave'],PASSWORD_DEFAULT);
        $usuarios_m->insertar($_POST);
        $this->enviarCorreo($_POST['email']);
        header('Location:'.BASE_URL);
    }
    /****
     * Recibimos por post los datos de inicio de session y comprobamos si son correctos o no,
     * si lo son iniciamos sesion, por lo contrario volveremos a pedir los datos correctos
     */
    public function comprobarlogin() {
        $usuarios_m  = $this->load_model('Usuarios_m');
        $usuario = $usuarios_m->leerUsuario($_POST['usuario']);
        if ($usuario) {
            if (password_verify($_POST['clave'],$usuario['clave'])) {
                //Correcto
                //Crear una variable se session son los datos del usuario qie nos convengan 
                //para usar en cualquier sitio de la aplicacion
                $_SESSION['usuario']=["id"=>$usuario['id'],
                                      "nombreUsu"=>$usuario['usuario'],
                                      "telefono"=>$usuario['telefono'],
                                      "email"=>$usuario['email'],
                                      "admin"=>$usuario['admin']];
                //Redirigimos de nuevo a inicio/index o al admin dependiendo de si somos admin o no
                if($usuario['admin']==1){
                    header("location:".BASE_URL."Dashboard");
                }else{
                    header("location:".BASE_URL."Inicio/index");
                }
            } else {
                $datos['mensaje']="error. Usuario o contraseña no validos";
            }
        }else{
            $datos['mensaje']="error. Usuario o contraseña no validos";
        }
        $this->load_view("plantilla/cabecera");
        $this->load_view("login_v",$datos);
        $this->load_view("plantilla/pie");
    }
    /****
     * Hacemos el cierre de sesion
     */
    public function logout(){
        session_destroy();
        header("location:".BASE_URL."Inicio/index");
    }
    /****
     * Enviamos el correo de bienvenida
     */
    private function enviarCorreo($email){
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
            $mail->Subject = 'Registro en HelloHome';
            $mail->Body    = '
            <h2>Enhorabuena</h2>Acabas de registrarte en HelloHome, haz click aqui http://localhost/Inmobiliaria/ para visitar nuestra pagina 
            ';
            $mail->AltBody = 'Enhorabuena, Acabas de registrarte en HelloHome';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    /****
     * Comprobamos que los datos de registro que recibimos por post no existan ya en la BBDD
     */
    public function comprobarDatosRegistro(){
        $usuarios_m=$this->load_model("Usuarios_m");
        $usuario=$usuarios_m->comprobarDatosRegistro($_POST['usuemailtel']);
       if ($usuario){
           // EL usuario existe
           echo "1";
       } else {
           echo "0";
       }
   }
}