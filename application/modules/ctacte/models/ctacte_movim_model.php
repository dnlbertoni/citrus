<?php
class Ctacte_movim_model extends MY_Model{
  function  __construct() {
    parent::__construct();
    $this->setTable('ctacte_movim');
  }
  function getDetalle($cuenta, $estado){
    $this->db->select('ctacte_movim.id');
    $this->db->select('DATE_FORMAT(ctacte_movim.fecha, "%d/%m/%Y") as fecha', FALSE);
    $this->db->select('CONCAT(ctacte_movim.puesto,"-",ctacte_movim.numero) AS firmado', FALSE);
    $this->db->select('ctacte_movim.importe');
    $this->db->select("CONCAT(facencab.puesto,'-',facencab.numero) AS comprobante", FALSE);
    $this->db->from($this->getTable());
    $this->db->join('facencab', 'ctacte_movim.idencab=facencab.id', 'inner');
    $this->db->where('id_cuenta', $cuenta);
    $this->db->where('ctacte_movim.estado', $estado);
    $this->db->order_by('fecha', 'ASC');
    return $this->db->get()->result();
  }
  function getTotalesAgrupados($estado='P'){
    $this->db->select('id_cuenta as id');
    $this->db->select('nombre as nombre');
    $this->db->select('COUNT(id_cuenta) AS cantidad', FALSE);
    $this->db->select("SUM(importe) as total", FALSE);
    $this->db->from($this->getTable());
    $this->db->join('cuenta', 'id_cuenta=cuenta.id', 'inner');
    $this->db->where('ctacte_movim.estado', $estado);
    $this->db->order_by('nombre');
    $this->db->group_by('id_cuenta');
    return $this->db->get()->result();
  }
  function getFecha($tipo='min', $estado='P', $cuenta=0){
    if($tipo=='min')
      $this->db->select_min('fecha');
    else
      $this->db->select_max('fecha');
    $this->db->from($this->getTable());
    $this->db->where('estado', $estado);
    $this->db->where('id_cuenta', $cuenta);
    return $this->db->get()->row()->fecha;
  }
  function Liquidar($idLiq, $datos){
    foreach($datos as $key=>$valor){
      $this->db->set('id_liq', $idLiq);
      $this->db->set('estado', 'L');
      $this->db->where('id',$valor);
      $this->db->update($this->getTable());
    }
    return true;
  }
  function getByLiq($idLiq){
    $this->db->select('ctacte_movim.id');
    $this->db->select('DATE_FORMAT(ctacte_movim.fecha, "%d/%m/%Y") as fecha', FALSE);

    $this->db->select('CONCAT(ctacte_movim.puesto,"-",ctacte_movim.numero) AS firmado', FALSE);
    $this->db->select('ctacte_movim.importe');
    $this->db->select("CONCAT(facencab.puesto,'-',facencab.numero) AS comprobante", FALSE);
    $this->db->from($this->getTable());
    $this->db->join('facencab', 'ctacte_movim.idencab=facencab.id', 'inner');
    $this->db->where('id_liq', $idLiq);
    $this->db->order_by('fecha', 'ASC');
    return $this->db->get()->result();
  }
  function cobroFac($idLiq, $idRec){
    $this->db->set('estado','C');
    $this->db->set('id_rec', $idRec);
    $this->db->where('id_liq', $idLiq);
    $this->db->update($this->getTable());
    return true;
  }
  function getLast($l=20,$date=false){
    $this->db->select('ctacte_movim.id');
    $this->db->select('date_format(fecha," %H:%i") as date', false);
    $this->db->select('CONCAT(id_cuenta," - ", cuenta.nombre) as cliente', false);
    $this->db->join('cuenta', 'cuenta.id=ctacte_movim.id_cuenta', 'inner');
    $this->db->select('importe');
    $this->db->from($this->getTable());
    if($date){
        $this->db->where('fecha >',$date);
    }
    $this->db->order_by('fecha', 'DESC');
    $this->db->limit($l);
    return $this->db->get()->result();
  }
}
