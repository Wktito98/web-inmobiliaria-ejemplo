<?php

class Dashboard extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    /**Aqui vamos a generar las vistas del dashboard y a consultar en la BBDD la informacion de la web para mostrarla */
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
        $admin_m=$this->load_model('Admin_m');
        $visitas=$admin_m->verVisitas();
        $admin_m->actualizarVisitas($visitas['valor']+1);

        $nuevosUsuarios=$admin_m->contarUsuarios();
        $nuevasPublicaiones=$admin_m->contarPublicaciones();

        $admin_m->actualizarUsuarios($nuevosUsuarios);
        $admin_m->actualizarPublicaciones($nuevasPublicaiones);

        $dashboard['visitas']=$admin_m->verVisitas();
        $dashboard['usuarios']=$admin_m->verUsuarios();
        $dashboard['publicaciones']=$admin_m->verPublicaciones();
        $dashboard['ventas']=$admin_m->contarVentas();
        $dashboard['alquiler']=$admin_m->contarAlquileres();
        
        $this->load_view("admin/dashboardAdmin_v",$dashboard);
        $this->load_view("plantilla/pie");
    }
}