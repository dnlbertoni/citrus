<?php
/*
 * Controlador cabecera del modulo articulos
 * FEATURES:
 *
 *@TODO: Unificar el Template
 */
class Wizard extends MY_Controller{
  private $CB;
  private $idEmpresa;
  private $Articulo;
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
    $CB='7516195176733'; // no existe
    $CB='7506195176733'; //existe
    $articulo = $this->Articulos_model->getByCodigobarra($CB);
    if($articulo){
      $this->Articulo = $articulo;
    }else{
      $this->Articulo = $this->Articulos_model->Inicializar();
    }
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
      }else{
        $this->idEmpresa=false;
      }
      $this->definoRubro();
    }
  }
  function definoRubro(){
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
    //$this->load->view('articulos/wizard/paso1', $data);
    $data['accion'] = "articulos/wizard/definoDetalle";
    Template::set($data);
    Template::set_view('articulos/wizard/paso1');
    Template::render();
  }
  function definoMarca($CB, $empresa){
    $data['marcasEmpresa']   = $this->Empresas_model->getMarcas($marcas);
    $data['marcasCodigoB']   = $this->Empresas_model->getMarcasFromCodigobarra($empresas);
    //$marca                   = $this->Marcas_model->getById($empresa->id_marca);
    //$data['empresaNombre']   = $marca->DETALLE_MARCA;
    $data['empresaNombre']   = '';
    $data['codigobarra']     = $CB;
    $data['urlSearchSubmarcas'] = sprintf("'%sindex.php/articulos/submarcas/searchAjax/resultadoAjaxPaso2'", base_url());
    $data['ocultos']         = array('codigobarra'    =>$CB,
                                     'empresa'        => $empresa->id,
                                     'id_submarca'    => ''
                                    );
    $data['accion'] = "articulos/wizard/definoRubro";
    Template::set($data);
    Template::set_view('articulos/wizard/paso2');
    Template::render();
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
  }
