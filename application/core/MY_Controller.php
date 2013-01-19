<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $ipDebags=array('192.168.1.2','192.168.0.8');
    $this->output->enable_profiler(in_array($_SERVER['REMOTE_ADDR'],$ipDebags));
    /*
     * defino los modulos que van en el menu
     */
    $Modulos[]=array( 'link'   => 'cuenta/',
                      'nombre' => 'Clie/Prov'
                    );
    $Modulos[]=array( 'link'   => 'pos/',
                      'nombre' => 'Puesto Vta'
                    );
    $Modulos[]=array( 'link'   => 'facturas/',
                      'nombre' => 'Facturacion'
                    );
    $Modulos[]=array( 'link'   => 'iva/',
                      'nombre' => 'I.V.A.'
                    );
    $Modulos[]=array( 'link'   => 'articulos/',
                      'nombre' => 'Articulos'
                    );
    $Modulos[]=array( 'link'   => 'carteles/',
                      'nombre' => 'Carteles'
                    );
    $Modulos[]=array( 'link'   => 'banco/',
                      'nombre' => 'Banco'
                    );
    $Modulos[]=array( 'link'   => 'ctacte/',
                      'nombre' => 'CtaCte'
                    );
    $dataM['Modulos'] = $Modulos;
    Template::set($dataM);
  }
}