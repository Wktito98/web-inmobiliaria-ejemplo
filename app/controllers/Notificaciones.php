<?php
defined("BASEPATH") or die("No se permite la entrada directa a este script");
class Notificaciones extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /****
     * Cargamos las vistas del inicio de las publicaciones del usuario
     * tambien vemos si tenemos notificaciones
     */
    public function index(){
        $this->load_view("plantilla/cabeceraLogin");
        $this->load_view("notificaciones_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Modificamos las preferencias del usuario con los nuevos datos
     */
    public function modificarPreferencias(){
        $notificaciones_m=$this->load_model("Notificaciones_m");
        $notificacion= isset($_POST['notificaciones'])?1:0;
        $notificaciones_m->modificarNotificaciones($_SESSION['usuario']['id'],$_POST['precio'],$_POST['alquiler_venta'],$notificacion);
        $this->load_view("plantilla/cabeceraLogin");
        $this->load_view("notificaciones_v");
        $this->load_view("plantilla/pie");
    }
    /****
     * Aqui Generamos el formulario de las preferencias del usuario, con sus datos guardados
     */
    public function genPreferencias(){
        $notificaciones_m=$this->load_model("Notificaciones_m");
        $notificaciones=$notificaciones_m->buscarMisNotificaciones($_SESSION['usuario']['id']);
        $habilitado=$notificaciones[0]['notificaciones']==1?"checked":" ";
        if($notificaciones[0]['tipo']=='A'){
            $alquilar="checked";
            $venta="";
        }else{
            $alquilar="";
            $venta="checked";
        }
        ?>
            <form  action="<?php echo BASE_URL?>Notificaciones/modificarPreferencias" method="post">
            <div class="d-flex align-items-center flex-column">
                <div class="form-check">
                    <input
                    class="form-check-input"
                    type="radio"
                    id="alquileres"
                    name="alquiler_venta"
                    value="A"
                    <?php echo $alquilar?>
                    />
                    <label class="form-check-label" for="alquileres">ALQUILERES</label>
                </div>
                <div class="form-check">
                    <input
                    class="form-check-input"
                    type="radio"
                    id="ventas"
                    name="alquiler_venta"
                    value="V"
                    <?php echo $venta?>
                    />
                    <label class="form-check-label" for="ventas">VENTAS</label>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="precio" class="col-form-label">Menos de: </label>
                <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio (€)" value="<?php echo $notificaciones[0]['precio']==0?"":$notificaciones[0]['precio']?>">
            </div>
            <div class="form-group mt-3">
                <div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="notificaciones" <?php echo $habilitado?>> Enviarme correo
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary" id="btnAplicar">Aplicar Ajustes</button>
            </div>
            </form>
        <?php   
    }
}
