<?php
class Facencab_model extends MY_Model{
  private $tabla = "facencab";
  function __construct(){
    parent::__construct();
  }
  function ActualizoPeriva($periodo, $fac_id){
    $this->db->_reset_select();
    $this->db->trans_begin();
    
   //activo solo las facturas que estan seleccionadas
    foreach($fac_id as $key=>$valor){
      $this->db->set('ivapass', $valor);
      $this->db->set('periva', ($valor==0)?0:$periodo);
      $this->db->where('id', $key);
      $this->db->update($this->tabla);      
    //echo $this->db->last_query();
    }
    if($this->db->trans_status()){
      $this->db->trans_commit();
      $estado = true;
    }else{
      $this->db->trans_rollback();
      $estado=false;
    };
    return $estado;
  }
  function verificoCierreZ($numero){
    $this->db->_reset_select();
    $this->db->from($this->tabla);
    $this->db->where('numero', $numero);
    $this->db->where('tipcom_id', 4);
    $this->db->where('puesto', 3);
    $this->db->where('letra', 'Z');
    $q = $this->db->get();
    if($q->num_rows()>0){
      return true;
    }else{
      return false;
    }
  }
  function PeriodosToDropDown(){
    $this->db->_reset_select();
    $this->db->distinct();
    $this->db->select('periva');
    $this->db->from($this->tabla);
    $this->db->where('periva IS NOT NULL', null, false);
    $this->db->where('periva !=', 0);
    $this->db->order_by('periva', 'desc');
    $q = $this->db->get()->result();
    foreach($q as $item){
      $linea [$item->periva] = $item->periva;
    };
    return (object) $linea;
  }
  function save($datos){
    $this->db->insert($this->tabla, $datos);
    $q = $this->db->insert_id();
    return $q;
  }
  function getRegistro($id){
    $this->db->_reset_select();
    $this->db->from($this->tabla);
    $this->db->where('id', $id);
    return $this->db->get()->row();
  }
  function getCierreZ($numero){
    $this->db->_reset_select();
    $this->db->from($this->tabla);
    $this->db->where('numero', $numero);
    $this->db->where('tipcom_id', 4);
    $this->db->where('puesto', 3);
    $this->db->where('letra', 'Z');
    return $this->db->get()->row();
  }
}
