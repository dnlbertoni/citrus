<?php
/**
 * Description of facencab_model
 *
 * @author dnl
 */
class Facencab_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('facencab');
  }
  function getAnosCTACTE(){
    $this->db->distinct();
    $this->db->select('DATE_FORMAT(fecha, "%Y") as ano', false);
    $this->db->from($this->getTable());
    $this->db->where('estado', 9);
    $q = $this->db->get()->result();
    if(count($q)>0){
      foreach ($q as $anio) {
        $dato[]=$anio->ano;
      }
      return $dato;
    }else{
      return false;
    }
  }
}
