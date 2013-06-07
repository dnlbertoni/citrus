<?php

/**
 * Description of wizard_model
 *
 * @author dnl
 */
class Wizard_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('wizard');
  }
  function getWizardDias(){
    $this->db->select('DATE_FORMAT(time, "%d-%m-%Y") AS fecha', FALSE);
    $this->db->select('COUNT(id_articulo) AS cantidad');
    $this->db->from($this->getTable());
    $this->db->group_by('fecha');
    return $this->db->get()->result();
  }
}
