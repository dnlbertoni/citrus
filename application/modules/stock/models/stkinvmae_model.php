<?php
/**
 * Created by PhpStorm.
 * User: dnl
 * Date: 18/05/14
 * Time: 18:11
 */

class Stkinvmae_model extends MY_Model{
    function __construct(){
        parent::__construct();
        $this->setTable('stk_invmae');
    }

    function inicioInventario(){
        $last = $this->getUltimo();
        if( $last->estado == 2 ){
            $datos = array(
                'fecha_inicio' => 'NOW()',
                'estado_dpc1'  => 0,
                'estado_dpc2'  => 0,
                'estado_dpc3'  => 0,
                'estado_salon' => 0,
                'estado'       => 1 // 1 - abierto | 2 - cerrado
            );
            $this->db->insert($this->getTable(),$datos);
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    function getUltimo(){
        $this->db->from($this->getTable());
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->row();
    }
} 