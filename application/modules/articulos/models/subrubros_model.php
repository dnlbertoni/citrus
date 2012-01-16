<?php 
class Subrubros_model extends MY_Model{
  function __construct(){
          parent::__construct();
          $this->setTable("tbl_subrubros");
  }
  function ListaSelect($campoId="id_subrubro", $campoNombre="descripcion_subrubro"){
          return $this->toDropDown($campoId, $campoNombre);
  }
  function ListaSelectDependiente($campoId="id_subrubro", $campoNombre="descripcion_subrubro", $campoRelacion="id_rubro"){
          return $this->toDropDown_avanzado($campoId, $campoNombre, $campoRelacion);
  }
  function getFromRubro($id){
    $this->db->select('id_subrubro as id');
    $this->db->select('descripcion_subrubro as nombre');
    $this->db->from($this->getTable());
    $this->db->where('id_rubro', $id);
    $this->db->order_by('nombre');
    return $this->db->get()->result();
  }
  function getAllConRubros(){
    $this->db->select('ID_SUBRUBRO');
    $this->db->select('DESCRIPCION_SUBRUBRO');
    $this->db->select('DESCRIPCION_RUBRO AS rubro');
    $this->db->from($this->getTable());
    $this->db->join("tbl_rubros", "tbl_subrubros.id_rubro = tbl_rubros.id_rubro", "inner");
    $this->db->order_by('tbl_subrubros.ID_RUBRO');
    $this->db->order_by('DESCRIPCION_SUBRUBRO');
    return $this->db->get()->result();
  }
  function getAlias($id){
    $this->db->select("ALIAS_SUBRUBRO AS alias");
    $this->db->from($this->getTable());
    $this->db->where($this->getPrimaryKey(), $id);
    return $this->db->get()->row()->alias;
  }
  function getNombre($id){
    $this->db->select("DESCRIPCION_SUBRUBRO AS alias");
    $this->db->from($this->getTable());
    $this->db->where($this->getPrimaryKey(), $id);
    return $this->db->get()->row()->alias;
  }
  function buscoNombre($valor){
	$this->db->select('id_subrubro as id');
	$this->db->select('descripcion_subrubro as nombre');
	$this->db->select('descripcion_rubro as rubro');
	$this->db->from($this->getTable());
	$this->db->join('tbl_rubros', 'tbl_rubros.id_rubro = tbl_subrubros.id_rubro', 'inner');
	$this->db->like('descripcion_subrubro',$valor);
	$q = $this->db->get();
	if($q->num_rows()>0){
	  return $q->result();
	}else{
	  return false;
	}
  }  
}
