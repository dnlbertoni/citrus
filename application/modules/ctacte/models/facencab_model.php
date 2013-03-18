<?php
/**
 * Description of facencab_model
 *
 * @author dnl
 */
class Facencab_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('faencab');
  }
}
