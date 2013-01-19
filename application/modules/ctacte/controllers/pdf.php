<?php
class Pdf extends MY_Controller{
  private $Printer = "laser03";
  function  __construct() {
    parent::__construct();
    $this->load->library('fpdf');
    $this->load->model('Ctacte_movim_model', '', TRUE);
    $this->load->model('Ctacte_liq_model'  , '', TRUE);
    $this->load->model('Cuenta_model'      , '', TRUE);
    //parametros por default
    $this->fpdf->Open();
    $this->fpdf->SetMargins(0,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetTopMargin(2);
    $this->fpdf->SetFont('Courier','', 24);
  }
  function liquidacion($idLiq){
    $liquidacion = $this->Ctacte_liq_model->getById($idLiq);
    $cuenta = $this->Cuenta_model->getById($liquidacion->id_cuenta);
    $movimientos = $this->Ctacte_movim_model->getByLiq($idLiq);
    $this->fpdf->AddPage();
    $concatCuenta = "( ".$liquidacion->id_cuenta." ) ".$cuenta->nombre;
    $this->_Encabezado('Resumen de Cuentas', $concatCuenta, $liquidacion->fecini,$liquidacion->fecfin, $idLiq);
    $y=45;
    $x=15;
    $band=0;
    //encabezado Tabla
    $this->fpdf->SetXY($x,$y+$band);
    $this->fpdf->Cell(55,7,'FECHA',1,0,'C');
    $this->fpdf->Cell(35,7,'COMP CtaCte',1,0,'C');
    $this->fpdf->Cell(35,7,'COMPRA',1,0,'C');
    $this->fpdf->Cell(35,7,'IMPORTE',1,1,'C');
    $band +=7;
    foreach($movimientos as $mov){
      $this->fpdf->SetXY($x,$y+$band);
      $this->fpdf->Cell(55,7,$mov->fecha,1,0,'J');
      $this->fpdf->Cell(35,7,$mov->firmado,1,0,'J');
      $this->fpdf->Cell(35,7,$mov->comprobante,1,0,'J');
      $this->fpdf->Cell(35,7,$mov->importe,1,1,'R');
      $band +=7;
    }
    $this->fpdf->SetXY($x,$y+$band);
    $this->fpdf->Cell(125,7,"Total-->",1,0,'C');
    $this->fpdf->Cell(35,7,$liquidacion->importe,1,1,'R');
    $file = TMP .'liquidacion.pdf';
    $this->fpdf->Output( $file,'F');
    $cmd = sprintf("lp %s -d %s", $file, $this->Printer);
    shell_exec($cmd);
    $cmd = sprintf("rm -f %s", $file);
    shell_exec($cmd);
    redirect('ctacte/', 'location', 301);
    //Template::render();
  }
  function _Encabezado($titulo='', $concatCuenta='', $fecdes='', $fechas='', $nro=0){
    $this->fpdf->Image('rsc/img/logo.png',0,0,80);
    $this->fpdf->SetXY(70,5);
    $this->fpdf->SetFont('Courier', 'B',24);
    $this->fpdf->Cell(0,10,$titulo,0,1,'C');
    $this->fpdf->SetXY(80,15);
    $this->fpdf->SetFont('Courier', 'B',16);
    $this->fpdf->Cell(110,10,$concatCuenta,0,1,'L');
    $this->fpdf->SetXY(80,25);
    $this->fpdf->SetFont('Courier', '',12);
    $this->fpdf->Cell(110,10,"Desde: ".$fecdes,0,1,'L');
    $this->fpdf->SetXY(80,35);
    $this->fpdf->Cell(110,10,"Hasta: ".$fechas,0,1,'L');
    $this->fpdf->SetXY(150,25);
    $this->fpdf->Cell(30,10,"NRO de Liquidacion: ".$nro,0,1,'R');

  }
}