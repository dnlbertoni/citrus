<?php
/**
 * Description of caja
 *
 * @author dnl
 */
class Caja extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->module('layout');
  }
  function index(){
    $this->layout->buffer('content', 'caja/index');
    $this->layout->render();
  }
}
