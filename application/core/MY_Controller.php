<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

/**
 * Description of my_controller
 *
 * @author Administrator
 */
class MY_Controller extends MX_Controller {

    function __construct() {
        parent::__construct();
        //default title
        $this->template->write('title', 'Roy Tutorials', TRUE);
        //default meta description
        $this->template->add_meta('description', 'An example of a page description.');
        //it is better to include header and footer here because these will be used by every page
        $this->template->write_view('header', 'templates/snippets/header');
        $this->template->write_view('footer', 'templates/snippets/footer');
    }

}

class MY_Controller1 extends MX_Controller {
    function __construct() {
        parent::__construct();
        /*
        if (version_compare(CI_VERSION, '2.1.0', '<')) {
            $this->load->library('security');
        }
        */
        $this->output->enable_profiler(ENVIRONMENT==='desarrollo');
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
        setlocale(LC_MONETARY, 'es_AR');
  }
}
class Admin_Controller extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('Modulos_model');
    $this->load->model('Menues_model');
    $this->output->enable_profiler(ENVIRONMENT==='desarrollo');
    /*
     * defino los modulos que van en el menu
     */
    $modulos = $this->Modulos_model->getAll(ACTIVO);
    $barra   = $this->Menues_model->getAll(ACTIVO);
    Template::set_theme('citrus/');
    Template::set("menu",$barra);
    Template::set("modulos",$modulos);
    setlocale(LC_MONETARY, 'es_AR');
  }
}
class POS_Controller extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('Modulos_model');
    $this->load->model('Menues_model');
    $this->load->model('Cfgpuestos_model');
    $this->output->enable_profiler(ENVIRONMENT==='desarrollo');
    /*
     * defino los modulos que van en el menu
     */
    $modulos = $this->Modulos_model->getAll(ACTIVO);
    $barra   = $this->Menues_model->getAll(ACTIVO);
    Template::set_theme('citrus/');
    Template::set("menu",$barra);
    Template::set("modulos",$modulos);
    setlocale(LC_MONETARY, 'es_AR');
  }
}