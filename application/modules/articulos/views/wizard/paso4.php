<h1>Precio</h1>
<h2>Codigo Barra:<?php echo $articulo->codigobarra?></h2>
<h3>Empresa:     <?php echo $articulo->empresa?></h3>
<h3>Producto:<?php echo $subrubroNombre?></h3>
<h3>Marca:<?php echo $submarcaNombre?></h3>
<h3>Detalle:<?php echo $articulo->especificacion?></h3>
<h3>Unidad/Medida:<?php echo $articulo->medida?></h3>

<?php echo form_open($accion,'id="wizardPaso4-form"', $ocultos)?>
<?php echo form_label('Descripcion:','descripcion')?><?php echo form_input('descripcion',$descripcion,'id="descripcion" size="60"');?>
<br />
<?php echo form_label('Precio','precio')?><?php echo form_input('precio','','id="precio"')?>
<div id="IVA">
  <?php echo form_label('21%', 'iva1')?><?php echo form_radio('tasaiva', '21',true,'id=iva1')?>
  <?php echo form_label('10.5%', 'iva2')?><?php echo form_radio('tasaiva', '10.5',false,'id=iva2')?>
</div>
<?php echo form_close()?>
<div id="back">Anterior</div><div id="next">Terminar</div>

<script>
$(document).ready(function(){
  $("#next").button({icons :{primary : 'ui-icon-next'}});
  $("#back").button({icons :{primary : 'ui-icon-back'}});
  $("#precio").focus();
  $("#IVA").buttonset();
  $("#next").click(function(){
      $("#wizardPaso4-form").submit();
  });
  $("#back").click(function(){
      $("#wizardPaso4-form").attr('action',<?php echo $accionBack?>);
      $("#wizardPaso4-form").submit();
  });
 });
</script>
