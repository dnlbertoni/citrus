<?php

class Marcas extends MY_Controller{
  function  __construct() {
    parent::__construct();
    $this->load->model("Marcas_model", "", TRUE);
    $this->load->model("Submarcas_model", "", TRUE);
    /*panel de tareas
    $datos['tareas'][] = array('articulos/precios/', '');
    $datos['tareas'][] = array('articulos/marcas/', '');
    $datos['tareas'][] = array('articulos/rubros/', 'Rubros');
    $this->template->write_view('tareas','_tareas', $datos); // panel de tareas */
  }
  function index(){
    $marcas = $this->Marcas_model->getAll('DETALLE_MARCA');
    $data['marcas'] = $marcas;
    $this->template->add_js('ui-tableFilter');    
    $this->template->write_view('contenido', 'articulos/marcas/index', $data);
    $this->template->render();
  }
  function submarcas($marca){
	$data['submarcas'] = $this->Submarcas_model->getFromMarca($rubro);
	$data['generales']   = $this->Submarcas_model->getFromMarca(1);
	$this->template->write_view('contenido', 'articulos/marcas/mezcla', $data);
	$this->template->render();
  }
  function agregar($metodo="html"){
    $data['accion'] = 'articulos/marcas/agregarDo';
    $marca = array( 'DETALLE_MARCA' => '',
                    'ABRE_MARCA'    => ''
                   );
    $data['marca'] = (object) $marca;
    $data['ocultos'] = array('id'=>'');
    $data['cancelar']  = $metodo;    
    if($metodo=="html"){
      $this->template->write_view('contenido', 'articulos/marcas/ver', $data);
      $this->template->render();
    }else{
      $data['accion'] .= '/ajax';
      $this->load->view('articulos/marcas/ver', $data);
    }
  }
  function agregarDo($metodo="html"){
	  $datos = array( 'DETALLE_MARCA' => strtoupper($this->input->post('descripcion')),
					  'ABRE_MARCA'    => strtoupper($this->input->post('alias'))
					);
	  $id = $this->Marcas_model->add($datos);
	  $datosSub = array( 'DETALLE_SUBMARCA' => strtoupper($this->input->post('descripcion')),
				         'ALIAS_SUBMARCA'   => strtoupper($this->input->post('alias')),
				         'ID_MARCA'         => $id, 
				         'ESTADO_SUBMARCA'  => $this->input->post('estado')
					    );
	  $idSub = $this->Submarcas_model->add($datosSub);
	  if($metodo=="html"){
	    $this->index();
	  }else{
		echo "<div class='codigo'>$idSub</div>";
	  };
  }
  function editar($id, $metodo="html"){
	$data['accion'] = 'articulos/marcas/editarDo';
	$data['marca']  = $this->Marcas_model->getById($id);
	$data['ocultos'] = array('id'=>$id);
    $data['cancelar']  = $metodo;    
	if($metodo=="html"){
		$this->template->write_view('contenido', 'articulos/marcas/ver', $data);
		$this->template->render();
	}else{
		$data['accion'] .= '/ajax';
		$this->load->view('articulos/marcas/ver', $data);
	}
  }
  function editarDo($metodo="html"){
	  $datos = array( 'DETALLE_MARCA' => strtoupper($this->input->post('descripcion')),
					  'ABRE_MARCA'  => strtoupper($this->input->post('alias'))
					);
	  $id = $this->input->post('id');
	  $this->Marcas_model->update($datos, $id);
	  if($metodo=="html"){
		$this->index();
	  };
  }
  function borrar($id){
	  $this->Marcas_model->borrar($id);
	  $this->index();
  }
}
