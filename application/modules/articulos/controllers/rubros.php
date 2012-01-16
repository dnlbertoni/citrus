<?php

class Rubros extends MY_Controller{
  function  __construct() {
    parent::__construct();
    $this->load->model("Rubros_model", "", TRUE);
    $this->load->model("Subrubros_model", "", TRUE);
    /*panel de tareas
    $datos['tareas'][] = array('articulos/precios/', '');
    $datos['tareas'][] = array('articulos/marcas/', '');
    $datos['tareas'][] = array('articulos/rubros/', 'Rubros');
    $this->template->write_view('tareas','_tareas', $datos); // panel de tareas */
  }
  function index(){
    //panel de tareas
    $datos['tareas'][] = array('articulos/precios/', 'Cambio Precios');
    $datos['tareas'][] = array('articulos/rubros/', 'Rubros');
    $datos['tareas'][] = array('articulos/subrubros/', 'Subrubros');
    $datos['tareas'][] = array('articulos/marcas/', 'Marcas');
    $datos['tareas'][] = array('articulos/submarcas/', 'Submarcas');
    $this->template->write_view('tareas','_tareas', $datos); // panel de tareas
    
    $rubros = $this->Rubros_model->getAll('DESCRIPCION_RUBRO');
    $data['rubros'] = $rubros;
    $this->template->write_view('contenido', 'articulos/rubros/index', $data);
    $this->template->render();
  }
  function subrubros($rubro){
	$data['subrubros'] = $this->Subrubros_model->getFromRubro($rubro);
	$data['generales']   = $this->Subrubros_model->getFromRubro(1);
        $data['titulo']      = $this->Rubros_model->getNombre($rubro);
        $data['tituloGen']   = $this->Rubros_model->getNombre(1);
	$this->template->write_view('contenido', 'articulos/rubros/mezcla', $data);
	$this->template->render();
  }
  function agregar($metodo="html"){
	$data['accion'] = 'articulos/rubros/agregarDo';
	$rubro = array('DESCRIPCION_RUBRO' => '', 
				   'ALIAS_RUBRO'       => '', 
                   'UNIDAD_RUBRO'      => 'BUL',
				   'ESTADO_RUBRO'      => 1
						   );
	$data['rubro'] = (object) $rubro;
	$data['unidadSel'] = array('BUL' => 'BULTOS', 'PES' => 'PESO', 'LIQ'=>'LIQUIDOS');
	$data['ocultos'] = array('id'=>'');
        if($metodo=="html"){
          $this->template->write_view('contenido', 'articulos/rubros/ver', $data);
          $this->template->render();
        }else{
          $this->load->view('articulos/rubros/ver', $data);
        }
  }
  function agregarDo(){
	  $datos = array( 'DESCRIPCION_RUBRO' => strtoupper($this->input->post('descripcion')),
					  'ALIAS_RUBRO'       => strtoupper($this->input->post('alias')),
					  'UNIDAD_RUBRO'      => strtoupper($this->input->post('unidad')),
					  'ESTADO_RUBRO'      => $this->input->post('estado')
					);
	  $id = $this->Rubros_model->add($datos);
	  $this->index();
  }
  function editar($id){
	$data['accion'] = 'articulos/rubros/editarDo';
	$data['rubro']  = $this->Rubros_model->getById($id);
	$data['unidadSel'] = array('BUL' => 'BULTOS', 'PES' => 'PESO', 'LIQ'=>'LIQUIDOS');
	$data['ocultos'] = array('id'=>$id);
	$this->template->write_view('contenido', 'articulos/rubros/ver', $data);
	$this->template->render();
  }
  function editarDo(){
	  $datos = array( 'DESCRIPCION_RUBRO' => strtoupper($this->input->post('descripcion')),
					  'ALIAS_RUBRO'       => strtoupper($this->input->post('alias')),
					  'UNIDAD_RUBRO'      => strtoupper($this->input->post('unidad')),
					  'ESTADO_RUBRO'      => $this->input->post('estado')
					);
	  $id = $this->input->post('id');
	  $this->Rubros_model->update($datos, $id);
	  $this->index();
  }
  function borrar($id){
	  $this->Rubros_model->borrar($id);
	  $this->index();
  }
}
