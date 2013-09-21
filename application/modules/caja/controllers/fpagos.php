<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fpagos
 *
 * @author dnl
 */
class Fpagos extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Fpagos_model');
  }
  function index(){
    $this->load->library('table');
    $fpagos = $this->Fpagos_model->getAll();
    foreach ($fpagos as $forma) {
      $tit= array_keys($forma);
    }
    $this->table->set_heading($tit);
    $tabla = $this->table->generate($fpagos);
    Template::set('tabla', $tabla);
    Template::render();
  }
}
