<?php
class Subrubros extends MY_Controller{
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
    
    $subrubros = $this->Subrubros_model->getAllConRubros();
    $data['subrubros'] = $subrubros;
    $this->template->write_view('contenido', 'articulos/subrubros/index', $data);
    $this->template->render();
  }
  function agregar($metodo="html"){
    $subrubro = array( 'DESCRIPCION_SUBRUBRO' => '',
                       'ALIAS_SUBRUBRO'       => '',
                       'ID_RUBRO'             => 1,
                       'ESTADO_SUBRUBRO'         => 1
                     );
    $data['subrubro'] = (object) $subrubro;
    $data['ocultos'] = array('id'=>'');
    $data['rubroSel'] = $this->Rubros_model->ListaSelect();
    $data['cancelar'] = $metodo;
    if($metodo=="html"){
      $data['accionSub'] = 'articulos/subrubros/agregarDo';
      $this->template->write_view('contenido', 'articulos/subrubros/ver', $data);
      $this->template->render();
    }else{
      $data['accionSub'] = 'articulos/subrubros/agregarDo/ajax';
      $this->load->view('articulos/subrubros/ver', $data);
    }
  }
  function agregarDo($metodo="html"){
    if($this->input->post('otro')=="SI"){
      $datosRub = array( 'DESCRIPCION_RUBRO' => strtoupper($this->input->post('descripcion')),
                         'ALIAS_RUBRO'       => strtoupper($this->input->post('alias')),
                         'ESTADO_RUBRO'      => $this->input->post('estado')
                       );
      $rubro    = $this->Rubros_model->add($datosRub);
    }else{
      $rubro = $this->input->post('rubro');
    };
    $datos = array( 'DESCRIPCION_SUBRUBRO' => strtoupper($this->input->post('descripcion')),
                    'ALIAS_SUBRUBRO'       => strtoupper($this->input->post('alias')),
                    'ID_RUBRO'             => $rubro,
                    'ESTADO_SUBRUBRO'      => $this->input->post('estado')
                   );
    $id = $this->Subrubros_model->add($datos);
    if($metodo=="html"){
          $this->index();
    }else{
      echo "<span class='codigo'>",$id,"</span>";
    }
    $this->template->render();
  }
  function editar($id, $metodo="html"){
	$data['subrubro']  = $this->Subrubros_model->getById($id);
	$data['ocultos'] = array('id'=>$id);
	$data['rubroSel'] = $this->Rubros_model->ListaSelect();
        $data['cancelar'] = $metodo;
        if($metodo=="html"){
          $data['accionSub'] = 'articulos/subrubros/editarDo';
          $this->template->write_view('contenido', 'articulos/subrubros/ver', $data);
          $this->template->render();
        }else{
          $data['accionSub'] = 'articulos/subrubros/editarDo/ajax';
          $this->load->view('articulos/subrubros/ver', $data);
        };
  }
  function editarDo($metodo="html"){
    $datos = array( 'DESCRIPCION_SUBRUBRO' => strtoupper($this->input->post('descripcion')),
                    'ALIAS_SUBRUBRO'       => strtoupper($this->input->post('alias')),
                    'ID_RUBRO'             => $this->input->post('rubro'),
                    'ESTADO_SUBRUBRO'      => $this->input->post('estado')
                  );
    $id = $this->input->post('id');
    $this->Subrubros_model->update($datos, $id);
    if($metodo=="html"){
      $this->index();
    };
  }
  function borrar($id){
	  $this->Subrubros_model->borrar($id);
	  $this->index();
  }
  function combosubrubros(){
    $id = $this->input->post("id");
    $rpta = '';
    $subrubros = $this->Subrubros_model->getFromRubro($id);
    $cant=0;
    foreach($subrubros AS $sub){
      $rpta .= sprintf("<option value='%s'%s>%s</option>", $sub->id,($cant>0)?'':"selected='selected'", $sub->nombre);
      $cant++;
    };
    echo $rpta;
  }
  function searchAjax($target){
    $data['target'] = $target;
    $this->load->view('articulos/subrubros/searchForm', $data);
  }
  function searchAjaxDo(){
    $valor = strtoupper(trim($this->input->post('subrubroTXT')));
    $subrubros = $this->Subrubros_model->buscoNombre($valor);
    $data['subrubroTXT'] = $valor;
    $data['subrubros'] = $subrubros;
    $data['vacio'] = ($subrubros)?false:true;
    $data['target']    = $this->input->post('destino');
    $data['targetRubro'] = sprintf("'%sindex.php/articulos/subrubros/agregar/ajax'", base_url());
    $this->load->view('articulos/subrubros/listadoAjax', $data);
  }
}
