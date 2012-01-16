<?php 
class Submarcas_model extends MY_Model{
  function __construct(){
          parent::__construct();
          $this->setTable("stk_submarcas");
  }
  function ListaSelect($campoId="id_submarca", $campoNombre="detalle_submarca"){
          return $this->toDropDown($campoId, $campoNombre);
  }
  function ListaSelectDependiente($campoId="id_submarca", $campoNombre="detalle_submarca", $campoRelacion="id_marca"){
          return $this->toDropDown_avanzado($campoId, $campoNombre, $campoRelacion);
  }
  function getFromMarca($id){
    $this->db->select('id_submarca as id');
    $this->db->select('detalle_submarca as nombre');
    $this->db->from($this->getTable());
    $this->db->where('id_marca', $id);
    $this->db->order_by('nombre');
    return $this->db->get()->result();
  }
  function getAllConMarcas(){
    $this->db->select('ID_SUBMARCA');
    $this->db->select('DETALLE_SUBMARCA');
    $this->db->select('DETALLE_MARCA AS marca');
    $this->db->from($this->getTable());
    $this->db->join("stk_marcas", "stk_submarcas.id_marca = stk_marcas.id_marca", "inner");
    $this->db->order_by('stk_submarcas.ID_MARCA');
    $this->db->order_by('DETALLE_SUBMARCA');
    return $this->db->get()->result();
  }
  function getAlias($id){
    $this->db->select("ALIAS_SUBMARCA  AS alias");
    $this->db->from($this->getTable());
    $this->db->where($this->getPrimaryKey(), $id);
    return $this->db->get()->row()->alias;
  }
  function getNombre($id){
    $this->db->select("DETALLE_SUBMARCA  AS alias");
    $this->db->from($this->getTable());
    $this->db->where($this->getPrimaryKey(), $id);
    return $this->db->get()->row()->alias;
  }
  function buscoNombre($valor){
	$this->db->select('id_submarca as id');
	$this->db->select('detalle_submarca as nombre');
	$this->db->select('stk_marcas.id_marca as id_marca');
	$this->db->select('detalle_marca as marca');
	$this->db->from($this->getTable());
	$this->db->join('stk_marcas', 'stk_marcas.id_marca = stk_submarcas.id_marca', 'inner');
	$this->db->like('detalle_submarca',$valor);
	$q = $this->db->get();
	if($q->num_rows()>0){
	  return $q->result();
	}else{
	  return false;
	}
  }
}
