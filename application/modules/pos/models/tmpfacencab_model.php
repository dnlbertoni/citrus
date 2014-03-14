<?php
class Tmpfacencab_model extends MY_Model{
  function  __construct() {
    parent::__construct();
    $this->setTable("tmp_facencab");
  }
  function inicializo($puesto, $numero, $tipcom, $cuenta){
    $this->db->set('tipcom_id', $tipcom);
    $this->db->set('puesto', $puesto);
    $this->db->set('numero', $numero);
    $this->db->set('cuenta_id', $cuenta);
    $this->db->insert($this->getTable());
    return $this->db->insert_id(); 
  }
  function save($datos){
    $this->db->insert($this->getTable(), $datos);
    $q = $this->db->insert_id();
    return $q;
  }
  function getDatosUltimo($puesto){
    $this->db->select_max('id');
    $this->db->from($this->getTable());
    $this->db->where('puesto', $puesto);
    $q = $this->db->get();
    if($q->num_rows()>0){
      $idencab = $q->row()->id;
      //$this->db->_reset_select();
      $this->db->from($this->getTable());
      $this->db->where('puesto', $puesto);
      $this->db->where('id', $idencab);
      $this->db->limit(1);
      return $this->db->get()->row();
    }else{
      return false;
    };
  }
  function getComprobante($id){
    $this->db->select('puesto');
    $this->db->select('numero');
    $this->db->select('cuenta_id');
    $this->db->select('cuenta.nombre as cuenta_nombre',false);
    $this->db->from($this->getTable());
    $this->db->join('cuenta', 'cuenta.id=tmp_facencab.cuenta_id', 'inner');
    $this->db->where('tmp_facencab.id', $id);
    return $this->db->get()->row();
  }
  function updateTotales($id, $importe){
    $this->db->select('importe');
    $this->db->from($this->getTable());
    $this->db->where('tmpfacencab_id', $id);
    $importeAnterior = $this->db->get()->row()->importe;
    $this->db->_reset_select();  
    
    $importeDiferencia = $importe - $importeAnterior;
    
    $this->db->set('importe', $importe);
    $this->db->where('tmpfacencab_id', $id);
    $this->db->update($this->getTable());
    $this->db->_reset_select();
    // busco todas  las formas de pago vigentes
    $this->db->from('tmp_fpagos');
    $fpagos = $this->db->get()->result();
    $this->db->where('tmpfacencab_id', $id);
    $this->db->_reset_select();
    foreach ($fpagos as $fp){
      $nuevo[$fp->id] = ( ( $fp->monto / $importeAnterior ) * $importeDiferencia ) + $fp->monto;
    }
    /* actualizo fpagos */
    foreach ($nuevo as $$n) {
      $this->db->set('importe', $importe);
      $this->db->update($this->getTable());
      $this->db->where('id', $n->id);
      $this->db->_reset_select();      
    }
  }
}
