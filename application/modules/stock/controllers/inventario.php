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
        $estado = "No existen inventarios Realizados Aun";
        if(isset($last->estado)){
            switch($last->estado){
                case 1:
                    $estado = "Abierto";
                    break;
                case 2:
                    $estado = "Cerrado";
                    break;
            }
        }
        Template::set('estadoUltimo', $estado);
        Template::render();
    }
    function open(){
        Assets::add_js('datetimepicker');
        Template::render();
    }
} 