<?php

/**
 * Created by PhpStorm.
 * User: dnl
 * Date: 22/09/14
 * Time: 14:18
 */
class Facmovim_model extends MY_Model
{
  function __construct ()
  {
    parent::_construct ();
    $this->setTable ('facmovim');
  }

  function getDetalle ($idencab)
  {
    $this->db->select ('cantidad_movim');
    $this->db->select ('facmovim.id_articulo');
    $this->db->select ('descripcion_articulo');
    $this->db->select ('preciovta_movim');
    $this->db->from ($this->getTable ());
    $this->db->join ('tbl_articulos', 'tbl_articulos.id_articulo=facmovim.id_articulo', 'inner');
    $this->db->where ('facmovim.idencab', $idencab);
    return $this->db->get ()->result ();
  }
} 