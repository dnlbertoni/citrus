<?php 
class Pos extends MY_Controller{
  var $puesto;
  function __construct(){
    parent::__construct();
    /*
     * cargo libreria del controlador fiscal
     */
    $this->puesto = PUESTO;
    $this->load->library('hasar');

    $this->load->model('Facencab_model','',true);
    $this->load->model('Tipcom_model','',true);
    $this->template->write('title','Puesto de Venta');

    $datos['tareas'][] = array( 'pos/factura/presupuesto/', '>> Ticket <<');
    $datos['tareas'][] = array( 'pos/cierreJournal' , 'Cierre Jornada');
    $this->template->write_view('tareas','_tareas', $datos); // panel de tareas    
  }
  function index(){
    $this->template->add_js('pos/index');
    $this->template->write_view('contenido', 'pos/index');
    $this->template->render();
  }
  function cierreJournal(){
    $fechoy = getdate();
    $data['opciones'] = array('X' => 'Cierre X', 
                              'Z' => 'Cierre Z' );
    $data ['fecha'] = $fechoy['mday'] . '/'. $fechoy['mon'] . '/'. $fechoy['year'];
    $this->template->write_view('contenido', 'pos/cierreJournal', $data);
    $this->template->render();
  }
  function cierreJournalDo(){
    $tipo=$this->input->post('tipo');
    $this->hasar->setPuesto($this->puesto);
    $comprobante = "cierre";
    $nom_archiv = $comprobante . $tipo;
    $this->hasar->nombres($nom_archiv);
    if ($tipo=='Z'){
      $respuesta = $this->hasar->CierreJournal($tipo);
      $total = floatval($this->hasar->importe_cierre);
      $neto  = floatval($this->hasar->importe_cierre) - floatval($this->hasar->iva_cierre);
      $porcentaje = 0.90;
      $ivamax = ( $neto * $porcentaje * 0.21 );
      $ivamin = ( $neto * ( 1 - $porcentaje ) * 0.105 );
      $diff = floatval($this->hasar->iva_cierre) - ( $ivamax + $ivamin );
      $porcDiff = $diff / floatval($this->hasar->iva_cierre);
      $vez =0;
      while($vez != 30 ){
        $porcentaje += $porcDiff;
        $ivamax = round(( $neto * $porcentaje * 0.21 ),2);
        $ivamin = round(( $neto * ( 1 - $porcentaje ) * 0.105 ),2);
        $diff = floatval($this->hasar->iva_cierre) - ( $ivamax + $ivamin );
        $porcDiff = ($diff / floatval($this->hasar->iva_cierre));
        //echo $diff ,"<br />";
        $vez++;
      };
      // compilo del objeto de carga
      $fechoy = getdate();
      $periva = $fechoy['year']*100 + $fechoy['mon'];
      $periva = intval($periva);
      $fecha  = $fechoy['year'] .'-'. $fechoy['mon'].'-'.$fechoy['mday'];
      $datos = array('tipcom_id' => 4,
                     'puesto'    => 3,
                     'numero'    => $this->hasar->numero_cierre,
                     'letra'     => 'Z',
                     'fecha'     => $fecha,
                     'cuenta_id' => 1,
                     'importe'   => $this->hasar->importe_cierre,
                     'neto'      => $neto,
                     'ivamin'    => $ivamin,
                     'ivamax'    => $ivamax,
                     'ingbru'    => 0,
                     'impint'    => $this->hasar->impint_cierre,
                     'percep'    => 0,
                     'periva'    => $periva,
                     'estado'    => 1 );
      $data['datos']=$datos;
      $id = $this->Facencab_model->save($datos);
      $data ['fac']           = $this->Facencab_model->getRegistro($id);
      $data ['tipcom_nombre'] = $this->Tipcom_model->getNombre($tipcom);
      $this->template->add_js('pos/muestroZ');
      $this->template->write_view('contenido','pos/muestroZ', $data);
      $this->template->render();
    }else{
     $this->index();
    };
  }
}
