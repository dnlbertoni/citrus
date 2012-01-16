<?php

class Version extends MY_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Version_model','',true);
  }
  
  function index(){
    $data['titulo'] = "";
    $this->template->write_view('contenido', 'index', $data);
    $this->template->render();
  }
}
