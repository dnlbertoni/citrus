<?php
class Blog extends MY_Controller {
  function  __construct() {
    parent::__construct();
    $this->load->model('blog_model', '',true);
  }
  function index(){
    $this->template->render();
  }
  function add($modulo=FALSE){
    $data['modulo'] = $modulo;
    $this->load->view('blog/addForm', $data);
  }
}
