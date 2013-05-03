<?php
/*
 * Controlador cabecera del modulo articulos
 * FEATURES:
 *
 */
class Wizard extends MY_Controller{
  private $CB;
  private $idEmpresa;
  private $Articulo;
  private $ruta;
  function  __construct() {
    parent::__construct();
    $this->load->model('Articulos_model');
    $this->load->model('Empresas_model');
    $this->load->model('Rubros_model');
    $this->load->model('Subrubros_model','',TRUE);
    $this->load->model('Marcas_model','',TRUE);
    $this->load->model('Submarcas_model','',TRUE);
    $this->output->enable_profiler(true);
  }
  function index($CB=false){
    //routeo los pasos del wizard
    //$CB="'".$CB."'";
    $CB='7790150260609'; // no existe -> mate cocido la virginia en saquitos
    //$CB='7506195176733'; //existe ->DETERGENT MAGISTRAL MARINA X600ML
    $CB = '7790040377806';  //existe -> CRIOLLITAS X 3 X 300 G
    $this->_getArticulo($CB);
    if($CB){
      $this->CB = $CB;
      $this->decrypCodigoBarra($this->CB);
    }else{
      if($this->input->post('codigobarra')){
        $this->CB = $this->input->post('codigobarra');
        $this->decrypCodigoBarra($this->CB);
      }else{
        $this->Cancelar();
      };
    };
  }
  function Cancelar(){
    Template::redirect('articulos/');
  }
  function decrypCodigoBarra($codigobarra){
    $CB = trim($codigobarra);
    if(strlen($CB)==13){
      $idEmpresa   = substr($CB, 0, 7);
      $empresa  = $this->Empresas_model->getById($idEmpresa);
      if($empresa){
        $this->idEmpresa=$empresa->id;
        $this->ruta=1; //camino primero por marca
        $this->definoMarca();
      }else{
        $this->idEmpresa=false;
        $this->ruta=0; //camino primero por rubro
        $this->definoRubro();
      }
    }
  }
  function definoRubro1($orden){
    $idEmpresa               = $this->idEmpresa;
    $codigobarra             = $this->CB;
    $id_submarca             = $this->input->post('id_submarca');
    $submarca                = $this->Submarcas_model->getById('id_submarca');
    $empresa                 = $this->Empresas_model->getById($idEmpresa);
    $data['rubrosEmpresa']   = $this->Empresas_model->getRubros($empresa->id_marca);
    $data['rubrosMarca']     = $this->Empresas_model->getRubrosFromSubmarcas($id_submarca);
    $marca                   = $this->Marcas_model->getById($empresa->id_marca);
    $data['empresaNombre']   = $marca->DETALLE_MARCA;
    $data['codigobarra']     = $codigobarra;
    $data['urlSearchSubrubro'] = sprintf("'%sindex.php/articulos/subrubros/searchAjax/resultadoAjaxPaso1'", base_url());
    $data['ocultos']         = array('codigobarra' => $codigobarra,
                                     'empresa'     => $empresa->id,
                                     'id_submarca' => $id_submarca,
                                     'id_subrubro' => ''
                                    );
    $data['accion'] = "articulos/wizard/definoDetalle";
    $data['tit']    = "Definicion del tipo de Producto";
    Template::set($data);
    Template::set('articulo', $this->Articulo);
    //Template::set_view('articulos/wizard/paso1');
    Template::set_view('articulos/wizard/detalle');
    Template::render();
  }
  function definoRubro(){
    $this->_setCB();
    $this->_getArticulo($this->CB);
    $CodigoB = $this->Empresas_model->getRubrosFromCodigobarra($this->idEmpresa);
    $totalSubrubro=0;
    $aux=false;
    foreach ($CodigoB as $c) {
      if($aux!=$c->rubroId){
        $totalRubro[$c->rubroId]=0;
        $aux=$c->rubroId;
        $totalRubro[$c->rubroId] += $c->cantidad;
      }else{
        $totalRubro[$c->rubroId] += $c->cantidad;
      }
      $totalSubrubro += $c->cantidad;
    }
    foreach ($CodigoB as $c) {
      $c->aciertoSubrubro = sprintf("--> %2.2f ",$c->cantidad/$totalSubrubro*100);
      $c->aciertoRubro    = sprintf("--> %2.2f ",$totalRubro[$c->rubroId]/$totalSubrubro*100);
    }
    $data['accion'] = "articulos/wizard/definoRubroDo";
    $data['ocultos']         = array('CB'       => $this->CB,
                                     'empresa'  => $this->idEmpresa,
                                     'tipo'     => 'rubro',
                                     'valor'    => $this->Articulo->ID_SUBRUBRO,
                                     'ruta'     => $this->ruta
                                    );
    $data['tit']    = "Definicion del Rubro del Producto";
    $data['sugeridos']=$CodigoB;
    $data['todos']=$this->Empresas_model->getAllConRubrosExcluidos($this->idEmpresa);
    Template::set($data);
    Template::set('articulo', $this->Articulo);
    Template::set('idMaster', 'rubroId');
    Template::set('idMov', 'subrubroId');
    Template::set('nombreMaster', 'rubroNombre');
    Template::set('nombreMov', 'subrubroNombre');
    Template::set('textoAsignar', '<span id="tipo">SUBRURBO</span> : ( <span id="codigo">'.$this->Articulo->ID_SUBRUBRO.'</span> ) <span id="nombre">'.$this->Articulo->NOMBRE_SUBRUBRO.'</span>');
    Template::set_block('sugeridos', 'articulos/wizard/sugeridos');
    Template::set_block('todos', 'articulos/wizard/todosEASY');
    Template::set_view('articulos/wizard/detalle');
    Template::render();
  }
  function definoMarca(){
    $this->CB=$this->input->post('CB');
    $this->_getArticulo($this->CB);
    $CodigoB = $this->Empresas_model->getMarcasFromCodigobarra($this->idEmpresa);
    $totalSubmarca=0;
    $aux=false;
    foreach ($CodigoB as $c) {
      if($aux!=$c->marcaId){
        $totalMarca[$c->marcaId]=0;
        $aux=$c->marcaId;
        $totalMarca[$c->marcaId] += $c->cantidad;
      }else{
        $totalMarca[$c->marcaId] += $c->cantidad;
      }
      $totalSubmarca += $c->cantidad;
    }
    foreach ($CodigoB as $c) {
      $c->aciertoSubmarca = sprintf("--> %2.2f ",$c->cantidad/$totalSubmarca*100);
      $c->aciertoMarca    = sprintf("--> %2.2f ",$totalMarca[$c->marcaId]/$totalSubmarca*100);
    }
    $data['ocultos']         = array('CB'       => $this->CB,
                                     'empresa'  => $this->idEmpresa,
                                     'tipo'     => 'id_marca',
                                     'valor'    => $this->Articulo->ID_SUBMARCA,
                                     'ruta'     => $this->ruta
                                    );
    $data['accion'] = "articulos/wizard/definoMarcaDo";
    $data['tit']    = "Definicion de la Marca del Producto";
    $data['sugeridos']=$CodigoB;
    $data['todos']=$this->Empresas_model->getAllConMarcasExcluidas($this->idEmpresa);
    Template::set($data);
    Template::set('articulo', $this->Articulo);
    Template::set('idMaster', 'marcaId');
    Template::set('idMov', 'submarcaId');
    Template::set('nombreMaster', 'marcaNombre');
    Template::set('textoAsignar', '<span id="tipo">SUBMARCA</span> : ( <span id="codigo">'.$this->Articulo->ID_SUBMARCA.'</span> ) <span id="nombre">'.$this->Articulo->DETALLE_SUBMARCA.'</span>');
    Template::set('nombreMov', 'submarcaNombre');
    Template::set_block('sugeridos', 'articulos/wizard/sugeridos');
    Template::set_block('todos', 'articulos/wizard/todosEASY');
    Template::set_view('articulos/wizard/detalle');
    Template::render();
  }
  function definoMarcaDo(){
    $this->CB=$this->input->post('CB');
    $this->idEmpresa = substr($this->CB, 0, 7);
    $this->Articulos_model->updateArticulo($this->input->post('CB'),$this->input->post('tipo'),$this->input->post('valor'));
    $this->ruta=$this->input->post('ruta');
    if($this->input->post('ruta')==1){
      $this->definoRubro();
    }else{
      $this->definoMarca();
    };
  }
  function definoDetalle(){
    $producto = $this->Subrubros_model->getAlias($this->input->post('id_subrubro'));
    $marca    = $this->Submarcas_model->getAlias($this->input->post('id_submarca'));
    $articulo = array('codigobarra' => $this->input->post('codigobarra'),
                      'descripcion' => $producto . " " . $marca,
                      'empresa'     => $this->input->post('empresa'),
                      'id_submarca' => $this->input->post('id_submarca'),
                      'id_subrubro' => $this->input->post('id_subrubro')
    );
    $data['articulo'] = (object) $articulo;
    $data['ocultos']  = $articulo;
    $data['accion']   = "articulos/wizard/definoPrecio";
    Template::set($data);
    Template::set_view('articulos/wizard/paso3');
    Template::render();
  }
  function definoPrecio(){
    $detalle = $this->input->post('especificacion');
    $medida  = $this->input->post('medida');
    $descripcion  = $this->input->post('descripcion');
    $descripcion .= ($detalle!='')?" ".$detalle:" ";
    $descripcion .= ($medida!='')?" x".$medida:" ";
    $data['descripcion'] = strtoupper($descripcion);
    $articulo = array('codigobarra'    => $this->input->post('codigobarra'),
                      'empresa'        => $this->input->post('empresa'),
                      'id_submarca'    => $this->input->post('id_submarca'),
                      'id_subrubro'    => $this->input->post('id_subrubro'),
                      'especificacion' => $this->input->post('especificacion'),
                      'medida'         => $this->input->post('medida')
    );
    $data['articulo'] = (object) $articulo;
    $data['ocultos']  = $articulo;
    $data['accion']   = "articulos/wizard/end";
    Template::set($data);
    Template::set_view('articulos/wizard/paso4');
    Template::render();
  }
  function end(){
    $articulos->CODIGOBARRA_ARTICULO = $this->input->post('codigobarra');
    $articulos->DESCRIPCION_ARTICULO = $this->input->post('descripcion');
    $articulos->ID_SUBRUBRO          = $this->input->post('id_subrubro');
    $articulos->ID_MARCA             = $this->input->post('id_submarca');
    $articulos->ID_PROVEEDOR         = 1;
    $articulos->TASAIVA_ARTICULO     = $this->input->post('tasaiva');
    $articulos->PRECIOVTA_ARTICULO   = $this->input->post('precio');
    $articulos->empresa              = $this->input->post('empresa');
    $articulos->especificacion       = $this->input->post('especificacion');
    $articulos->medida               = $this->input->post('medida');
    $articulos->detalle              = $this->input->post('descripcion');
    $articulos->ESTADO_ARTICULO      = 1;
    //$this->Articulos_model->agregar($this->input->post('codigobarra'),$articulos,$this->input->post('precio'));
    Template::redirect('articulos/');
  }
  function _getArticulo($CB){
    $arti = $this->Articulos_model->getByCodigobarra($CB);
    if($arti){
      $articulo = $this->Articulos_model->getByIdFull($arti->ID_ARTICULO);
      $this->Articulo = $articulo;
    }else{
      $this->Articulo = $this->Articulos_model->Inicializar(TRUE);
      $this->Articulo->CODIGOBARRA_ARTICULO = $CB;
    }

  }
}
