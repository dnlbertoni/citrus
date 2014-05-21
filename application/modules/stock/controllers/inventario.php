<?php
/**
 * Created by PhpStorm.
 * User: dnl
 * Date: 18/05/14
 * Time: 18:07
 */

class Inventario extends MY_Controller{
    function __construct(){
        parent::__construct();
        Template::set_theme('citrus/'); // TODO sacar e unificar
        $this->load->model('Articulos_model');
        $this->load->model('Stkinvmae_model');
    }
    function index(){
        $last=$this->Stkinvmae_model->getUltimo();
        $estado = "No existen inventarios Realizados aun";
        if(isset($last->estado)){
            switch($last->estado){
                case 1:
                    $estado  = "<p>Abierto el dia ". $last->fecha_inicio . "<p>";
                    $estado .= "<p>Modificado por ultima vez el " .$last->ultima_actualizacion ."</p>" ;
                    break;
                case 2:
                    $estado  = "<p>Cerrado el dia ". $last->fecha_final . "<p>";
                    $estado .= "<p>Modificado por ultima vez el " .$last->ultima_actualizacion ."</p>" ;
                    break;
            }
        }
        Template::set('last',$last);
        Template::set('estadoUltimo', $estado);
        Template::render();
    }
    function open(){
        $last=$this->Stkinvmae_model->getUltimo();
        $permitido = (!isset($last->estado))?!isset($last->estado):true;
        Template::set('permitido',$permitido );
        Template::render();
    }
    function openDo(){
        $this->Stkinvmae_model->inicioInventario();
        Template::redirect('stock/inventario/');
    }
    function close(){
        $last=$this->Stkinvmae_model->getUltimo();
        Template::set('last', $last);
        Template::render();
    }
    function closeDo(){
        $this->Stkinvmae_model->cierroInventario();
        Template::redirect('stock/inventario/');
    }
    function conteo($deposito, $inventario){
        switch ($deposito){
            case 'dpc1':
                $depositoNombre="Primer Sector del Deposito Principal";
                break;
            case 'dpc2':
                $depositoNombre="Segundo Sector del Deposito Principal";
                break;
            case 'dpc3':
                $depositoNombre="Garage y demas sectores";
                break;
            case 'salon':
                $depositoNombre="Salon de ventas y gondolas";
                break;
        }
        Template::set('paginaAjaxDatosArticulo','"'. base_url().'index.php/stock/inventario/datosArticulo"');
        Template::set('depositoNombre', $depositoNombre);
        Template::render();
    }
    function agregoAlConteo(){
        $CB         = $this->input->post('CB');
        $cantidad   = $this->input->post('cantidad');
        $inventario = $this->input->post('inventario');
        $deposito   = $this->input->post('deposito');
    }
    function datosArticulo($CB){
        $this->output->enable_profiler(false);
        $articulo=$this->Articulos_model->getDatosInventario($CB);
        $datos=array('nombre'=>$articulo->nombre);
        echo json_encode($datos);
    }
}