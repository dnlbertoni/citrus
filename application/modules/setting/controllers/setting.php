<?php

/**
 * controlador de las configuraciones
 *
 * @author dnl
 * @version 1
 * 
 */
class Setting extends MY_Controller{
  function __construct() {
    parent::__construct();
    Template::set_theme('moderno/');
    $this->load->model('Modulos_model');
    $this->load->model('Menues_model');
  }
  
  /**
   * muestra el index de las configuraciones
   */
  function index(){
    $modulos=$this->Modulos_model->getAll();
    $menues=$this->Menues_model->getAll();
    Template::set('modulosTable', $modulos);
    Template::set('menuTable', $menues);
    Template::render();
  }
}
