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
    $this->db->select('tmp_fpagos.id');
    $this->db->select('fpagos_id');
    $this->db->select('fpagos.nombre as pagoNombre');
    $this->db->select('monto');
    $this->db->from($this->getTable());
    $this->db->join('fpagos', 'tmp_fpagos.fpagos_id=fpagos.id', 'inner');
    $this->db->where('tmpfacencab_id',$id);
    return $this->db->get()->result();
  }
  function cambiarFpFull($id, $estado){
    $this->db->set('fpagos_id', $estado);
    $this->db->where('tmpfacencab_id',$id);
    $this->db->update($this->getTable());
    return true;
  }  
  function vacio($id){
    $this->db->where('tmpfacencab_id', $id);
    $this->db->delete($this->getTable());
    return true;
  }  
}
