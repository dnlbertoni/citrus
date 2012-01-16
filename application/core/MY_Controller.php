<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class  MY_Controller  extends MX_Controller{
    function __construct(){
        parent::__construct();
        //debug
        $ipDebags=array('192.168.1.2');
        $this->output->enable_profiler(in_array($_SERVER['REMOTE_ADDR'],$ipDebags));
        $this->load->library('fb');

        $this->template->add_css('jquery-ui');
        $this->template->add_css('sahara');

        //$this->template->add_css('vanadium');

        $this->template->add_js('jquery-1.4.4.min');
        $this->template->add_js('jquery-ui-1.8.9.min');
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
        $data['Modulos'] = $Modulos;
        $this->template->write_view('menu','_menu',$data);
   }
} 
