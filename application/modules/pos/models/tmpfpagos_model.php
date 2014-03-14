<?php
/**
 * Description of tmpfpagos_model
 *
 * @author dnl
 */
class Tmpfpagos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('tmp_fpagos');
  }
  function inicializo($id){
    $this->db->set('tmpfacencab_id', $id);
    $this->db->set('fpagos_id', 1);
    $this->db->insert($this->getTable());
    return $this->db->insert_id(); 
  }
  function getPagosComprobante($id){
    $this->db->from($this->getTable());
    $this->db->where('tmpfacencab_id',$id);
    return $this->db->get()->result();
  }
}
