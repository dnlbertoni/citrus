<?php
class Facturas extends MY_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('Facencab_model','',true);
    $this->load->model('Tipcom_model','',true);

    Template::set('title','Modulo de Facturas');
    $datos['tareas'][] = array( 'facturas/add/10', 'Agregar Fac Cpras');
    $datos['tareas'][] = array( 'facturas/add/13', 'Agregar N/C Cpras');
    $datos['tareas'][] = array( 'facturas/cierresZmanual', 'Agregar Cierre Z Manual');
    $datos['tareas'][] = array( 'facturas/addCierresZ', 'Agregar Cierre Z Controlador');
    Template::set('tareas',$datos['tareas']);
    Template::set_block('sidebar','_tareas'); // panel de tareas    
  }
  function index(){
    Assets::add_js('facturas/index');
    Template::render();
  }
  function add($tipcom=0,$cuenta_id=0){
    $data ['tipcom_nombre']    = $this->Tipcom_model->getNombre($tipcom);
    $data ['ocultos']['tipcom_id'] = $tipcom;
    $data ['cuenta_id']    = $cuenta_id;
    $data ['cuenta_nombre']= '';
    $data ['agregaCuenta'] = ($cuenta_id==0)?true:false;
    $data ['claseTitulo']  = ($tipcom==13 || $tipcom==3)?"ui-state-error":"ui-state-default";
    $data ['target']       = "cuentaAjax";
    $data ['targetCuenta'] = sprintf("'%sindex.php/cuenta/searchAjax%s'", base_url(),'/cuentaAjax');
    $this->template->write_view('contenido', 'facturas/add', $data);      
    $this->template->render();
  }
  function cierresZmanual($tipcom=4,$cuenta_id=1){
    $data ['tipcom_nombre']    = $this->Tipcom_model->getNombre($tipcom);
    $data ['ocultos']['tipcom_id'] = $tipcom;
    $data ['cuenta_id']    = $cuenta_id;
    $data ['cuenta_nombre']= 'Consumidor Final';
    $data ['agregaCuenta'] = ($cuenta_id==0)?true:false;
    $this->template->add_css('colorbox'); //agrego estilos para colorbox
    $this->template->add_js('jquery.colorbox-min'); //agrego el core para colorbox
    $this->template->add_js('facturas/cierresZmanual'); //agrego script de la pantalla
    $this->template->write_view('contenido', 'facturas/cierresZmanual', $data);      
    $this->template->render();
  }
  function addDo(){
  // activar las propiedades de validacion
    $this->_set_fields();
    $this->_set_rules();
    // validar
    if ($this->validation->run() == FALSE){
        $data['message'] = '';
    }else{
        // save data
        $coef = ($this->input->post('tipcom_id')==3 || $this->input->post('tipcom_id')==13 )? -1 : 1;
        // calculo el  periva
        $auxper = explode("-",$this->input->post('fecha'));
        $periva = $auxper[0] . $auxper[1];
        $tipcom = $this->Tipcom_model->getById($this->input->post('tipcom_id'));
        if( $tipcom->libroiva == 2 ){
          $periva=0;          
        }
        // compilo del objeto de carga
        $datos = array('tipcom_id' => $this->input->post('tipcom_id'),
                       'puesto'    => $this->input->post('puesto'),
                       'numero'    => $this->input->post('numero'),
                       'letra'     => $this->input->post('letra'),
                       'fecha'     => $this->input->post('fecha'),
                       'cuenta_id' => $this->input->post('cuenta_id'),
                       'importe'   => $this->input->post('importe')* $coef,
                       'neto'      => $this->input->post('neto')   * $coef,
                       'ivamin'    => $this->input->post('ivamin') * $coef,
                       'ivamax'    => $this->input->post('ivamax') * $coef,
                       'ingbru'    => $this->input->post('ingbru') * $coef,
                       'impint'    => $this->input->post('impint') * $coef,
                       'percep'    => $this->input->post('percep') * $coef,
                       'periva'    => $periva,
                       'estado'    => 1 );
        $id = $this->Facencab_model->save($datos);
        $this->load->library('fb');
        $this->fb->error($periva, "error");
        // set form input name="id"
        //$this->validation->id = $id;
 
        // set user message
        //$data['message'] = '<div class="success">Nueva Cuenta Creada Con exito</div>';
    };
    if($this->input->post('tipcom_id')==4){
      $this->cierresZmanual();    
    }else{
      $this->add($this->input->post('tipcom_id'),0);      
    }
  }
  // campos de validacion
  function _set_fields(){
    $campos['letra'] = 'letra';
    $campos['puesto'] = 'puesto';
    $campos['numero'] = 'numero';

  
    $this->validation->set_fields($campos);
  }
  function addCierresZ(){
    $data['formulario'] = true;
    $this->template->write_view('contenido', 'facturas/cierresZ', $data);
    $this->template->render();
  }
  function addCierresZDo(){
    $this->load->library('hasar');
    $this->hasar->setPuesto(3);
    $cierreZ= sprintf("%04.0f",$this->input->post('numeroCierre'));
    $tipo="Z";
    $respuesta = $this->hasar->GetDailyReport($cierreZ,$tipo);
    $data['hasar']['respuesta']=$respuesta;
    if($this->hasar->Estado == "OK" ){
      $data['hasar']['neto'] = $this->hasar->importe_cierre - ($this->hasar->iva_cierre + $this->hasar->impint_cierre);
      $data['hasar']['numero']=$this->hasar->numero_cierre;
      $aux = explode("/", $this->hasar->fecha_cierre);
      $data['hasar']['fecha']= $aux[2]. '-' . $aux[1] . '-' . $aux[0];
      $data['hasar']['periva']= $aux[2] . $aux[1];
      $data['hasar']['tkt']=$this->hasar->tkt_cierre;
      $data['hasar']['fac']=$this->hasar->fac_cierre;
      $data['hasar']['importe']=$this->hasar->importe_cierre;
      $data['hasar']['iva']=$this->hasar->iva_cierre;
      $total = floatval($this->hasar->importe_cierre);
      $neto = floatval($this->hasar->importe_cierre) - floatval($this->hasar->iva_cierre);
      $porcentaje = 0.90;
      $ivamax = ( $neto * $porcentaje * 0.21 );
      $ivamin = ( $neto * ( 1 - $porcentaje ) * 0.105 );
      $diff = floatval($this->hasar->iva_cierre) - ( $ivamax + $ivamin );
      if( $this->hasar->iva_cierre > 0 ){
        $porcDiff = $diff / floatval($this->hasar->iva_cierre);        
      }else{
        $porcDiff = 0;
      };
      $vez =0;
      while( $vez != 30 && $porcDiff != 0 ){
        $porcentaje += $porcDiff;
        $ivamax = round(( $neto * $porcentaje * 0.21 ),2);
        $ivamin = round(( $neto * ( 1 - $porcentaje ) * 0.105 ),2);
        $diff = floatval($this->hasar->iva_cierre) - ( $ivamax + $ivamin );
        $porcDiff = ($diff / floatval($this->hasar->iva_cierre));
        $vez++;
      };
      $data['hasar']['ivamin']=$ivamin;
      $data['hasar']['ivamax']=$ivamax;
      $data['hasar']['diff'] = $diff;
      $data['hasar']['porcDiff'] = $porcDiff;
      $data['hasar']['impint']=$this->hasar->impint_cierre;      
    };
    $data['formulario']=false;
    $this->template->write_view('contenido','facturas/cierresZ', $data);
    $this->template->render();
  }
  function graboCierreZ(){
    if( !$this->Facencab_model->verificoCierreZ($this->input->post('numero')) ){
      $datos = array('tipcom_id' => 4,
                     'puesto'    => 3,
                     'numero'    => $this->input->post('numero'),
                     'letra'     => 'Z',
                     'fecha'     => $this->input->post('fecha'),
                     'cuenta_id' => 1,
                     'importe'   => $this->input->post('importe'),
                     'neto'      => $this->input->post('neto'),
                     'ivamin'    => $this->input->post('ivamin'),
                     'ivamax'    => $this->input->post('ivamax'),
                     'ingbru'    => 0,
                     'impint'    => $this->input->post('impint'),
                     'percep'    => 0,
                     'periva'    => $this->input->post('periva'),
                     'estado'    => 1 );
      $data ['datos'] = $datos;
      $id             = $this->Facencab_model->save($datos);
      $data ['fac']   = $this->Facencab_model->getRegistro($id);
    }else{
      $data ['fac']   = $this->Facencab_model->getCierreZ($this->input->post('numero'));
    };
    $this->template->add_js('pos/muestroZ');
    $this->template->write_view('contenido','pos/muestroZ', $data);
    $this->template->render();
  }
  function estado(){
    $this->load->library('hasar');
    $data['respuesta']=$this->hasar->Estado();
  }
  // reglas de validacion
  function _set_rules(){
    $rules['letra'] = 'trim|required';
    $rules['puesto'] = 'val|required';
    $rules['numero'] = 'val|required';
 
    $this->validation->set_rules($rules);
 
    $this->validation->set_message('required', '* required');
    $this->validation->set_message('isset', '* required');
    $this->validation->set_error_delimiters('<p class="ui-state-error">', '</p>');
  }
  // date_validation callback
  function valid_date($str){
    if(!ereg("^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})$", $str)){
      $this->validation->set_message('valid_date', 'Formato de fecha Invalido. dd-mm-yyyy');
      return false;
    }else{
      return true;
    }
  }  
}
