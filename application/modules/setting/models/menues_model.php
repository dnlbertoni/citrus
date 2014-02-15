<?php
/**
 * Description of menues_model
 *
 * @author dnl
 */
class Menues_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('menu');
  }
  function getAll() {
    $this->db->select('menu.id as id');
    $this->db->select('modulos.nombre as nombreModulo');
    $this->db->select('menu.nombre as nombre');
    $this->db->select('IF(ISNULL(menu.clase),"",menu.clase) as clase',FALSE);
    $this->db->select('menu.link as link');
    $this->db->select('menu.target as target');
    $this->db->from($this->getTable());
    $this->db->join('modulos', 'menu.modulo_id=modulos.id', 'inner');
    $this->db->order_by('nombreModulo');
    return $this->db->get()->result();
  }
}
