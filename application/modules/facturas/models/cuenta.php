<?php
class Cuenta extends MY_Controller {
	function __construct(){
		parent::MY_Controller();
		$this->load->model('Cuenta_model','',TRUE);
		$this->template->write('title', 'Modulo Cuentas');
		// panel de tareas Regulares
		$datos['tareasSet']=true;
		$datos['tareas'][] = array('cuenta/crear', 'Agregar');
		$this->template->write_view('tareas','_tareas', $datos); // panel de tareas
	}

    //firephp 
    /*
    $a = "test";
    $array = array("a" => "1", "b" => "2"); 
    //$this->firephp->log($a, 'ERROR');
    //$this->firephp->log($a, 'ERROR'); 
    $this->fb->setEnabled(true); 
    $this->fb->info($array, "info");
    $this->fb->warn($array, "warn");
    $this->fb->error($array, "error");
    $this->fb->group('Test Group');
    $this->fb->log('Hello World');
    $this->fb->groupEnd();
// firephp
     * */  

	
	function index(){
	  $this->template->add_js('cuenta/index'); //agrego las funciones de Jquery
	  $limite=20;
		$data['cuentas'] = $this->Cuenta_model->muestroTodos($limite);
//    $this->load->view('cuenta/index', $data);
		$this->template->write_view('contenido', 'cuenta/index', $data);
		$this->template->render();
	}
	
	function crear(){
    // activar las propiedades de validacion
    $this->_set_fields();
    
    // set configurar varaibles comunes 
    $data['title'] = 'Agregar Cuenta';
    $data['message'] = '';
    $data['action'] = site_url('cuenta/crearDo');
    $data['link_back'] = 'cuenta/index/';
    // load view
    $cuenta_data = array( 'condiva_id' => 1,
                          'nombre'     => '', 
                          'cuit'       => 0, 
                          'tipdoc'     => 1, 
                          'direccion'  => '', 
                          'telefono'   => '', 
                          'email'      => '',
                          'tipo'       => 1, 
                          'estado'     => 1,
                          'letra'      => 'B');
    $data['cuenta'] = (object) $cuenta_data;
    $this->load->model('Condiva_model','',true);
    $data['condiva']= $this->Condiva_model->toDropDown();
    $this->template->add_js('cuenta/editar');
    $this->template->write_view('contenido', 'cuenta/editar', $data);
    $this->template->render();
	}
	
       function crearDo(){
    // set common properties
    $data['title'] = 'Agregar Cuenta';
    $data['action'] = site_url('cuenta/crear');
    $data['link_back'] = anchor('cuenta/index/','Volver a la Lista de Cuentas');
    // activar las propiedades de validacion
    $this->_set_fields();
    $this->_set_rules();
    // validar
    if ($this->validation->run() == FALSE){
        $data['message'] = '';
    }else{
        // save data
        $datos = array('condiva_id' => $this->input->post('condiva_id'),
                       'nombre'     => strtoupper($this->input->post('nombre')),
                       'cuit'       => $this->input->post('cuit'),
                       'tipdoc'     => $this->input->post('tipdoc'),
                       'direccion'  => strtoupper($this->input->post('direccion')),
                       'telefono'   => $this->input->post('telefono'),
                       'email'      => strtolower($this->input->post('email')),
                       'tipo'       => $this->input->post('tipo'),
                       'letra'      => $this->input->post('letra'),
                       'estado'     => $this->input->post('estado'));
        $id = $this->Cuenta_model->save($datos);
 
        // set form input name="id"
        $this->validation->id = $id;
        $data['cuenta'] = (object) $datos;
        $this->load->model('Condiva_model','',true);
        $data['condiva']= $this->Condiva_model->toDropDown();        
        // set user message
        $data['message'] = '<div class="success">Nueva Cuenta Creada Con exito</div>';
    }
    // load view
    /*
    $this->template->write_view('contenido', 'cuenta/editar', $data);
    $this->template->render();
     * */
    $this->index();
  }
  
  
  function editar($id){
    $cuenta = $this->Cuenta_model->getId($id);
    $data['condiva']= $this->Condiva_model->toDropDown();
    $this->template->add_js('cuenta/editar');
    $this->template->write_view('contenido', 'cuenta/editar', $data);
    $this->template->render();
  }
	
	function ver(){
		
	}
	
	function borrar(){
	
	}
	function buscoCuit(){
	  $valor=$this->input->post('cuit');
    $data['valor']=$this->input->post('cuit');
	  $data['cuentas'] = $this->Cuenta_model->buscoCuit($valor);
    $data['valor'] = $valor;
    //$this->fb->log($data['cuentas']);
    $this->template->add_js('cuenta/autofiltro'); // script de funciones jQuery
    $this->template->write_view('contenido', 'cuenta/autofiltro', $data);
    $this->template->render();
	}
  function buscoNombreAjax(){
    $valor = $this->input->post('nombreTXT');
    if(is_numeric($valor)){
      $valor = intval($valor);
      $data['cuentas'] = $this->Cuenta_model->getById($valor);   
      $data['valor'] = $valor;      
      $data['byId']    = true;   
    }else{
      $valor = strtoupper(trim($valor));
      $data['cuentas'] = $this->Cuenta_model->ListadoFiltradoNombre($valor);
      $data['valor'] = $valor;      
      $data['byId']    = false;   
    }
    //$this->fb->log($data['cuentas']);
     $this->load->view('cuenta/nombreAjax', $data);
  }
  
  function muestroAjax(){
    $valor = $this->input->post('nombreTXT');
    if(is_numeric($valor)){
      $valor = intval($valor);
      $data['datos'] = $this->Cuenta_model->getById($valor);   
      $data['valor']   = $valor; 
      $data['byId']    = true;   
    }else{
      $valor = strtoupper(trim($valor));
      $data['datos'] = $this->Cuenta_model->ListadoFiltradoNombre($valor);
      $data['valor']   = $valor;      
      $data['byId']    = false;   
    }
    $this->load->view('cuenta/muestroAjax', $data);
  }
  
  
  // campos de validacion
  function _set_fields(){
    $campos['id'] = 'id';
    $campos['nombre'] = 'name';
    $campos['condiva_id'] = 'condiva_id';
    $campos['direccion'] = 'direccion';
    $campos['telefono'] = 'id';
    $campos['email'] = 'name';
    $campos['cuit'] = 'condiva_id';
    $campos['tipdoc'] = 'direccion';
  
    $this->validation->set_fields($campos);
  }

  // reglas de validacion
  function _set_rules(){
    $rules['nombre'] = 'trim|required';
    /*
    $rules['gender'] = 'trim|required';
    $rules['dob'] = 'trim|required|callback_valid_date';
    */
    $this->validation->set_rules($rules);
 
    $this->validation->set_message('required', '* required');
    $this->validation->set_message('isset', '* required');
    $this->validation->set_error_delimiters('<p class="error">', '</p>');
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