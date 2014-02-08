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
  }
  
  /**
   * muestra el index de las configuraciones
   */
  function index(){
    Template::render();
  }
}
