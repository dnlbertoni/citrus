<?php
class Tmpmovim_model extends MY_Model{
  var $tabla = "tmp_movimientos";
  var $tablaArticulos = "tbl_articulos";
  function  __construct() {
    parent::__construct();
    $this->setTable('tmp_movimientos');
  }
  function agregoAlComprobante($id, $codigobarra, $cantidad, $precio ){
    $this->db->select('id_tmpmov');
    $this->db->from($this->getTable());
    $this->db->where('tmpfacencab_id', $id);
    $this->db->where('codigobarra_tmpmov', $codigobarra);
    $q = $this->db->get();
    $articulos = $q->result();
    if($q->num_rows()== 0 || trim($codigobarra)=='1' || trim($codigobarra)=='2' ){
      return $this->insertArticulo($id, $codigobarra, $cantidad, $precio);
    }else{
      return $this->updateArticulo($id, $codigobarra, $cantidad);
    };
  }
  function insertArticulo($id, $codigobarra, $cantidad, $precio ){
    $this->db->select('descripcion_articulo as nombre');
    $this->db->select('tasaiva_articulo as tasaiva');
    $this->db->from($this->tablaArticulos);
    $this->db->where('codigobarra_articulo', $codigobarra);
    $arti = $this->db->get()->row();
    //$this->db->_reset_select();
    $this->db->set('tmpfacencab_id',$id);
    $this->db->set('cantidad_tmpmov', $cantidad);
    $this->db->set('codigobarra_tmpmov', $codigobarra);
    $this->db->set('preciovta_tmpmov',$precio);
    $this->db->set('descripcion_tmpmov', $arti->nombre);
    $this->db->set('tasaiva_tmpmov', $arti->tasaiva);
    $this->db->insert($this->tabla);
    return $this->db->insert_id(); 
  }
  function updateArticulo($id, $codigobarra, $cantidad){
    $this->db->set('cantidad_tmpmov', 'cantidad_tmpmov + ' . $cantidad, false);
    $this->db->where('tmpfacencab_id', $id);
    $this->db->where('codigobarra_tmpmov', $codigobarra);
    $this->db->update($this->tabla);
    return $id;
  }
  function delArticulo($codmov){
    $this->db->from($this->tabla);
    $this->db->where('id_tmpmov', $codmov);
    $idencab = $this->db->get()->row()->tmpfacencab_id;
    //$this->db->_reset_select();
    $this->db->where('id_tmpmov', $codmov);
    $this->db->delete($this->tabla);
    return $idencab;
  }
  function getTotales($id){
    $this->db->select('SUM(cantidad_tmpmov*preciovta_tmpmov) AS Total',false);
    $this->db->select('COUNT(codigobarra_tmpmov) AS Bultos', false);
    $this->db->from($this->getTable());
    $this->db->where('tmpfacencab_id', $id);
    return $this->db->get()->row();
  }
  function getArticulos($id){
    $this->db->select('codigobarra_tmpmov AS Codigobarra');
    $this->db->select('descripcion_tmpmov AS Nombre');
    $this->db->select('cantidad_tmpmov AS Cantidad');
    $this->db->select('preciovta_tmpmov AS Precio');
    $this->db->select('tasaiva_tmpmov AS Tasa');
    $this->db->select('(cantidad_tmpmov * preciovta_tmpmov ) AS Importe', false);
    $this->db->select('id_tmpmov As codmov');
    $this->db->from($this->getTable());
    $this->db->where('tmpfacencab_id', $id);
    $this->db->order_by('id_tmpmov', 'DESC');
    $q = $this->db->get();
    if($q->num_rows()>0){
      return $q->result();
    }else{
      return false;
    }
  }
  function vacio($id){
    $this->db->where('tmpfacencab_id', $id);
    $this->db->delete($this->getTable());
    return true;
  }
  function itemsComprobante($idencab, $negativo=false){
    $this->db->select('descripcion_articulo as detalle');
    $this->db->select('cantidad_tmpmov      as cantidad');
    if($negativo)
      $this->db->select('(preciovta_tmpmov * -1)     as precio', false);
    else
      $this->db->select('preciovta_tmpmov     as precio');
    $this->db->select('tasaiva_articulo     as iva');
    $this->db->select('id_articulo          as id_articulo');
    $this->db->select('codigobarra_articulo as codigobarra');
    $this->db->from($this->tabla);
    $this->db->join($this->tablaArticulos, "codigobarra_articulo = codigobarra_tmpmov", "inner");
    $this->db->where("tmpfacencab_id", $idencab);
    $this->db->where("codigobarra_articulo = codigobarra_tmpmov", "",false );
    return $this->db->get()->result();
  }
  function totalComprobante($idencab){
    $this->db->select("SUM(cantidad_tmpmov * preciovta_tmpmov) as Total",false);
    $this->db->from($this->tabla);
    $this->db->where("tmpfacencab_id", $idencab);
    return $this->db->get()->row()->Total;
  }
}
