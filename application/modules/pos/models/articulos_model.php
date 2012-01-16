<?php
class Articulos_model extends MY_Model{
  var $tabla = "tbl_articulos";
  function  __construct() {
    parent::__construct();
    $this->setTable('tbl_articulos');
  }
  function getDatosPresupuesto($codigobarra){
    if(trim($codigobarra) != ''){
      $this->db->select('codigobarra_articulo as id');
      $this->db->select('descripcion_articulo as nombre');
      $this->db->select('preciovta_articulo as precio');
      $this->db->select('tasaiva_articulo as iva');
      $this->db->from($this->tabla);
      $this->db->where('codigobarra_articulo',$codigobarra);
      $this->db->limit(1);
      return $this->db->get()->row();
    }else{
      return false;
    }
  }
}