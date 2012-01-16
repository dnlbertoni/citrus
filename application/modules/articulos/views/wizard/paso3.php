<h1><?php echo $articulo->codigobarra?></h1>
<h2><?php echo $articulo->descripcion?></h2>
<h2><?php echo $articulo->empresa?></h2>
<h2><?php echo $articulo->id_subrubro?></h2>
<h2><?php echo $articulo->id_submarca?></h2>

<?php echo form_open($accion,'id="wizardPaso3-form"', $ocultos)?>
<?php echo form_label('Especificacion','especificacion')?>
<?php echo form_input('especificacion','','id="especificacion"')?>
<br />
<?php echo form_label('Medida','medida')?>
<?php echo form_input('medida','','id="medida"')?>
<?php echo form_close()?>
<div id="back">Anterior</div><div id="next">Siguiente</div>

<script>
$(document).ready(function(){
  $("#next").button({icons :{primary : 'ui-icon-next'}});
  $("#back").button({icons :{primary : 'ui-icon-back'}});
  $("#next").click(function(){
      $("#wizardPaso3-form").submit();
  });
  $("#back").click(function(){
      $("#wizardPaso3-form").attr('action',<?php echo $accionBack?>);
      $("#wizardPaso3-form").submit();
  });  
 });
</script>
