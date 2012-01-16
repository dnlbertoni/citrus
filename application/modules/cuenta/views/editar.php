
<h1><?php echo (isset($ocultos))?'Cuenta Nro: '.$ocultos['id']:'Crear Cuenta'?></h1>

<?php echo form_open($accion ,array('id'=>'cuentaAdd', 'name' => 'cuentaAdd'),(isset($ocultos))?$ocultos:'');?>
<div id="datos">Razon Social:
<?php 
$datainput = array( 'id'    => 'nombre', 
                    'name'  => 'nombre',
                    'size'  => 60,  
                    'value' => $cuenta->nombre );
echo form_input($datainput);?>
</div>
<div id="datos">Condicion de IVA:
<?php 
echo form_dropdown('condiva_id', $condiva, $cuenta->condiva_id, 'id="condiva_id"');?>
</div>
<div id="datos">CUIT/DNI:
<?php 
$datainput = array( 'id'    => 'cuit', 
                    'name'  => 'cuit', 
                    'value' => $cuenta->cuit );
echo form_input($datainput);?><span id ="CuitOK"><div id="bot_CuitOK">Comprobar Cuit</div></span>
</div>
<div id="datos">Tipo de Documento:
<?php 
echo form_dropdown('tipdoc', array('1'=>'DNI', '2'=>'CUIT'), $cuenta->tipdoc, 'id="tipdoc"');?>
</div>
<div id="datos">Direccion:
<?php 
$datainput = array( 'id'    => 'direccion', 
                    'name'  => 'direccion', 
                    'value' => $cuenta->direccion );
echo form_input($datainput);?>
</div>
<div id="datos">Telefono:
<?php 
$datainput = array( 'id'    => 'telefono', 
                    'name'  => 'telefono', 
                    'value' => $cuenta->telefono );
echo form_input($datainput);?>
</div>
<div id="datos">E-mail:
<?php 
$datainput = array( 'id'    => 'email', 
                    'name'  => 'email', 
                    'value' => $cuenta->email );
echo form_input($datainput);?>
</div>
<div id="ctacte">
<?php echo form_label('Contado', 'ctacte1');?><?php echo form_radio('ctacte', '0', ($cuenta->ctacte==0)?true:false,'id="ctacte1"')?>
<?php echo form_label('Cta. Cte.', 'ctacte2');?><?php echo form_radio('ctacte', '1', ($cuenta->ctacte==1)?true:false,'id="ctacte2"')?>
</div>
<div id="tipo">
<?php echo form_label('Cliente ', 'tipo1');?><?php echo form_radio('tipo', '1', ($cuenta->tipo==1)?true:false,'id="tipo1"')?>
<?php echo form_label('Proveedor ', 'tipo2');?><?php echo form_radio('tipo', '2', ($cuenta->tipo==2)?true:false,'id="tipo2"')?>
</div>
<div id="datos">Letra: <span id="valorLetra"><?php echo $cuenta->letra?></span>
<input type="hidden" id="letra" name="letra" value="<?php echo $cuenta->letra?>" />
<input type="hidden" id="estado" name="estado" value="<?php echo $cuenta->estado?>" />
</div>
<?php echo form_close();?>
<?php if (isset($ocultos)):?>
<div id="info">
  Cantidad Comprobantes <?php echo $totComp?>
  <br />
  Importe Facturado <?php echo $totFact?>
</div>
<?php endif;?>

<div id="botAccion">Guardar</div>
<?php
echo anchor($link_back,'Volver a la Lista de Cuentas', 'id="botBack"');
