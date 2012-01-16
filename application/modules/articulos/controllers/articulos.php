<?php
class Articulos extends MY_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Articulos_model','',true);
    $this->load->model('Rubros_model', '', TRUE);
    $this->load->model('Subrubros_model', '', TRUE);
    $this->load->model('Marcas_model', '', TRUE);
    $this->load->model('Submarcas_model', '', TRUE);
    $this->template->write('title', 'Modulo Articulos');
  }
  function index(){
    //panel de tareas
    $datos['tareas'][] = array('articulos/precios/', 'Cambio Precios');
    $datos['tareas'][] = array('articulos/rubros/', 'Rubros');
    $datos['tareas'][] = array('articulos/rubros/agregar/ajax', 'Agregar Rubros');    
    $datos['tareas'][] = array('articulos/subrubros/', 'Subrubros');
    $datos['tareas'][] = array('articulos/subrubros/agregar/ajax', 'Agregar Subrubros', 'class="ajaxLoad"');    
    $datos['tareas'][] = array('articulos/marcas/', 'Marcas');
    $datos['tareas'][] = array('articulos/marcas/agregar/ajax', 'Agregar Marcas', 'class="ajaxLoad"');    
    $datos['tareas'][] = array('articulos/submarcas/', 'Submarcas');
    $datos['tareas'][] = array('articulos/submarcas/agregar/ajax', 'Agregar Submarcas', 'class="ajaxLoad"');    
    $datos['tareas'][] = array('articulos/estadisticas', 'Estadisticas');    
    $this->template->write_view('tareas','_tareas', $datos); // panel de tareas

    $articulos = $this->Articulos_model->getAllMod(50);
    $data['progressbarDetalle'] = $this->Articulos_model->nivelNormalizacionDetalle();
    $data['articulos'] = $articulos;
    $data['rubrosSel']  = $this->Rubros_model->ListaSelect();
    $data['subrubrosSel']  = $this->Subrubros_model->ListaSelect();
    $data['marcasSel']  = $this->Marcas_model->ListaSelect();
    $data['submarcasSel']  = $this->Submarcas_model->ListaSelect();
    $data['subrubrosDep']  = $this->Subrubros_model->ListaSelectDependiente();
    $data['submarcasDep']  = $this->Submarcas_model->ListaSelectDependiente();
    $this->template->add_js('ui-tableFilter');
    $this->template->write_view('contenido', 'articulos/index',$data);
    $this->template->render();
  }
  function buscoDescripcion(){
    $articulos = $this->Articulos_model->buscoNombre($this->input->post('nombreTXT'));
    $data['vacio']      = (!$articulos)?true:false;
    $data['articulos'] = $articulos;
    $data['total'] = count($articulos);
    $this->load->view('articulos/listadoAjax', $data);
  }
  function busquedaAvanzada(){
    //$this->output->enable_profiler(TRUE);
    $submarca = ($this->input->post('submarca')=='null')?false:$this->input->post('submarca');
    $subrubro = ($this->input->post('subrubro')=='null')?false:$this->input->post('subrubro');
    $articulos = $this->Articulos_model->searchAvanzada($submarca, $subrubro);
    $data['vacio']      = (!$articulos)?true:false;
    $data['articulos'] = $articulos;
    $data['total'] = count($articulos);
    $this->load->view('articulos/listadoAjax', $data);
  }
  function busquedaGlobal(){
    //$this->output->enable_profiler(TRUE);
    $marca = ($this->input->post('marca')=='S')?false:$this->input->post('marca');
    $rubro = ($this->input->post('rubro')=='S')?false:$this->input->post('rubro');
    $articulos = $this->Articulos_model->searchGlobal($marca, $rubro);
    $data['vacio']      = (!$articulos)?true:false;
    $data['articulos'] = $articulos;
    $data['total'] = count($articulos);
    $this->load->view('articulos/listadoAjax', $data);
  }
  function buscoPorMarca(){
    $articulos = $this->Articulos_model->buscoPorMarca($this->input->post('submarca'));
    $data['vacio']      = (!$articulos)?true:false;
    $data['articulos'] = $articulos;
    $data['total'] = count($articulos);
    $this->load->view('articulos/listadoAjax', $data);
  }
  function buscoPorRubro(){
    $articulos = $this->Articulos_model->buscoPorRubro($this->input->post('subrubro'));
    $data['vacio']      = (!$articulos)?true:false;
    $data['articulos'] = $articulos;
    $data['total'] = count($articulos);
    $this->load->view('articulos/listadoAjax', $data);
  }
  function ver($id=false){
    if(trim($this->input->post('codigobarra'))!='' || $id!=false){
	  if(trim($this->input->post('codigobarra'))!=''){	
        $articulo = $this->Articulos_model->getByCodigobarra($this->input->post('codigobarra'));
      }else{
        $articulo = $this->Articulos_model->getById($id);		  
      }
      if($articulo){
        $data['Articulo']    = $articulo;
        $data['new']         = FALSE;
        $data['subrubroSel'] = $this->Subrubros_model->ListaSelect();
        $data['nombreSubrubro'] = $this->Subrubros_model->getNombre($articulo->ID_SUBRUBRO);
        $data['marcaSel']    = $this->Submarcas_model->ListaSelect();
        $data['nombreSubmarca'] = $this->Submarcas_model->getNombre($articulo->ID_MARCA);
        $data['accion']      = 'articulos/update';
        $data['primaryKey']  = array( $this->Articulos_model->primaryKey, "CODIGOBARRA_ARTICULO");
        $this->template->add_js('articulos/ver');
        $this->template->write_view('contenido', 'ver',$data);
        $this->template->render();
      }else{
      //  redirect('articulos/wizard/index/0/'.$this->input->post('codigobarra'), 'location',301);
        $this->agregar($this->input->post('codigobarra'));
      }
    }else{
      $this->index();
    };
  }
  function update(){
    $datos = array();
    foreach($_POST as $key=>$valor){
      if(!preg_match('/^(Grabar)|^(ID_ARTICULO)|^(FECHAMODIF_ARTICULO)/',$key)){
        $datos[$key]=$valor;
      };
    };
    $this->Articulos_model->updateMod($this->input->post('ID_ARTICULO'),$datos);
    $this->index();
  }
  function borrar($id){
    $this->Articulos_model->borrar($id);
    $this->index();
  }
  function agregar($codigobarra){
    $articulos = $this->Articulos_model->Inicializar();
    $articulos->CODIGOBARRA_ARTICULO = $codigobarra;
    $articulos->ID_SUBRUBRO = 44;
    $articulos->ID_MARCA = 0;
    $articulos->ID_PROVEEDOR = 1;
    $articulos->TASAIVA_ARTICULO = 21;
    $articulos->ESTADO_ARTICULO = 1;
    $data['Articulo'] = $articulos;
    $data['new'] = TRUE;
    $data['subrubroSel'] = $this->Subrubros_model->ListaSelect();
    $data['nombreSubrubro'] = $this->Subrubros_model->getNombre($articulos->ID_SUBRUBRO);
    $data['marcaSel']       = $this->Submarcas_model->ListaSelect();
    $data['nombreSubmarca'] = $this->Submarcas_model->getNombre($articulos->ID_MARCA);
    $data['accion'] = 'articulos/agregarDo';
    $data['primaryKey'] = array( $this->Articulos_model->primaryKey, "CODIGOBARRA_ARTICULO");
    $this->template->add_js('articulos/ver');
    $this->template->write_view('contenido', 'ver',$data);
    $this->template->render();
  }
  function agregarDo(){
    $datos = array();
    foreach($_POST as $key=>$valor){
      if(!preg_match('/^(Grabar)|^(ID_ARTICULO)|^(FECHACREACION_ARTICULO)/',$key)){
        $datos[$key]=$valor;
      };
    };
    $datos['DESCRIPCION_ARTICULO'] = strtoupper($datos['DESCRIPCION_ARTICULO']);
    $this->Articulos_model->agregar($this->input->post('CODIGOBARRA_ARTICULO'),$datos);
    $this->index();
  }
  function precioAjax(){
    $this->output->enable_profiler(FALSE);
    $this->load->view('muestroPrecio');
  }
  function precioAjaxDo(){
    $this->output->enable_profiler(FALSE);
    $data['articulo']=$this->Articulos_model->getDatosPrecio($this->input->post('codigobarra'));
    $data['codigobarra'] = $this->input->post('codigobarra');
    $this->load->view('muestroPrecioAjax', $data);
  }
  function cambioPrecioAjax(){
    $articulo = $this->Articulos_model->getDatosBasicos($this->input->post('id'));
    $data['articulo']=$articulo;
    $data['idArt'] = $this->input->post('id');
    $this->load->view('articulos/cambioPrecio', $data);
  }
  function cambioPrecioDo(){
    $this->Articulos_model->actualizoPrecio($this->input->post('id'), $this->input->post('precio'));
  }
  function generoNombre(){
    $this->output->enable_profiler(false);
    $producto = $this->Subrubros_model->getAlias($this->input->post('subrubro'));
    if($this->input->post('submarca')>0)
      $marca    = $this->Submarcas_model->getAlias($this->input->post('submarca'));
    else
      $marca = "";
    $distincion = strtoupper(trim($this->input->post('especif')));
    $medida     = strtoupper(trim($this->input->post('medida')));
    $nombre  = $producto;
    $nombre .= " " . $marca;
    $nombre .= ($distincion!='')?" ".$distincion:" ";
    $nombre .= ($medida!='')?" x".$medida:" ";
    echo $nombre;
  }
  function cambioMuchos(){
    $datos = array();
    foreach($_POST as $key=>$valor){
      if(!preg_match('/^(accion)/',$key)){
        $datos[]=$this->Articulos_model->getByIdFull($valor);
      };
    };
    $data['articulos'] = (object) $datos;
    switch($this->input->post('accion')){
	  case "marca":
		   $accion    = "ID_MARCA";
		   $url       = 'submarcas';
   		   $funcion   = 'searchAjax';
                   $vista     = 'articulos/cambioMuchos';
		   $titulo    = "'>> MARCAS <<'";
		   break;
	  case "rubro":
		   $accion = "ID_SUBRUBRO";
   		   $url       = 'subrubros';
   		   $funcion   = 'searchAjax';
                   $vista     = 'articulos/cambioMuchos';
		   $titulo    = "'>> RUBROS <<'";
		   break;
	  case "precio":
		   $accion    = "PRECIOVTA_ARTICULO";
   		   $url       = 'precios';
   		   $funcion   = 'masivoAjax';
                   $vista     = 'articulos/precios/cambioMuchos';
		   $titulo    = "'>> PRECIOS <<'";
		   break;
	};
    $data['accion'] = $accion;
    $data['urlBuscoAjax'] = sprintf("'%sindex.php/articulos/%s/%s/%s'", base_url(),$url,$funcion,'resultadoAjax');
    $data['titulo'] = $titulo;
    $this->template->write_view('contenido', $vista, $data);
    $this->template->render();
  }
  function cambioMuchosDo($precios=false){
    if($this->input->post('ID_MARCA')){
      $newfield = 'ID_MARCA';
    }else{
      if($this->input->post('ID_SUBRUBRO')){
        $newfield = 'ID_SUBRUBRO';
      }else{
            $newfield = '';
      }
    };
    $datos = array();
    foreach($_POST as $key=>$valor){
      if(!preg_match('/^(ID_MARCA)|^(ID_SUBRUBRO)|^(precio_)/',$key)){
        $datos[]=$valor;
      };
    };
    if(!$precios){
      $dataAdd = array($newfield => $this->input->post($newfield));
      foreach($datos as $id){
            $this->Articulos_model->update($dataAdd, $id);
      };
    }else{
      if($precios=="precios"){
        foreach($datos as $id){
          $aux    = "precio_" . $id;
          $precio = $this->input->post($aux);
          if($id > 0 && $this->input->post($aux))
            $this->Articulos_model->actualizoPrecio($id, $precio);
        };
      }
    }
    $this->index();
  }
  function borrarLote(){
    foreach($_POST as $key=>$valor){
      if(is_numeric($valor)){
        $datos[] = $valor;
      };
    };
    foreach($datos as $id){
      $this->Articulos_model->borrar($id);
    };
    //$this->template->render();
    $this->index();
  }
  function normalizacion(){
	$data['todosLosArticulos'] = $this->Articulos_model->totalRegistros();
	$estadisticas = $this->Articulos_model->datosNormalizacion();
	$data['estadisticas'] = (object) $estadisticas;
	$this->template->write_view('contenido', 'articulos/normalizacion', $data);
	$this->template->render();
  }
  function estadisticas(){
     $estados  = $this->Articulos_model->getRubrosMarcasAgrupadas();
     $activos  = $this->Articulos_model->getActivos();
     $generica = $this->Articulos_model->getConsulta("SELECT COUNT(id_articulo) AS cantidad FROM tbl_articulos WHERE id_marca = 0");
     $data['faltanGenericas'] = $generica->cantidad;
     $data['estados'] = $estados;
     $total = 0;
     foreach($estados as $numero){
	   $total += $numero->cantidad;
     }
     $data['total']  = $total;
     $data['activos'] = $activos;
     $data['suspendidos'] = $total - $activos;  
     $data['normalizacion'] = $this->Articulos_model->datosNormalizacion();
     $this->template->write_view('contenido', 'articulos/estadisticas', $data);
     $this->template->render();
  }
  function rankings($tipo="importe"){
    switch($tipo){
      case "importe":
        $numeros = $this->Articulos_model->getRankingRubrosMarcas(true);
        break;
      case "cantidad":
        $numeros = $this->Articulos_model->getRankingRubrosMarcas(false);
        break;
      case "marcas":
        $numeros  = $this->Articulos_model->getRubrosMarcasAgrupadas();
        break;
    }
    $data['numeros'] = $numeros;
    $this->template->write_view('contenido', 'articulos/agrupadas', $data);
    $this->template->render();
  }

}


/*
 * Location: controllers/articulos.php
 */
