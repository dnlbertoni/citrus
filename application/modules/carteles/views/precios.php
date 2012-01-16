<?php
/*
 * Vista del controlador de carteles  funcion de precios
 * 
 */
for($i=0;$i<11;$i++){
  $opciones [$i] = $i;  
}
?>
<div class="boton" id="all">Imprimir Todo</div>
<?php echo form_open($accion,"id='listado'");?>
<table width="85%">
<tr>
  <th>ID</th>
  <th>Descripcion</th>
  <th>Subrubro</th>
  <th colspan="2">Precio</th>
</tr> 
<?php $renglon=0;?>
<?php foreach($articulos as $articulo):?>
<tr>
  <td><?php echo $articulo->id?></td>
  <td><?php echo $articulo->Descripcion?></td>
  <td><?php echo $articulo->Subrubro?></td>
  <td><?php echo $articulo->Precio?></td>
  <td>
    <div class="radio">
      <?php echo form_label('Imprimir', $articulo->id.'p')?>
      <?php echo form_radio($articulo->id, 'p', ($articulo->Precio==0)?false:true, 'id="'.$articulo->id.'p" class="print"')?>
      <?php echo form_label('No Imprimir', $articulo->id.'s')?>
      <?php echo form_radio($articulo->id, 's', ($articulo->Precio==0)?true:false, 'id="'.$articulo->id.'s"  class="save"')?>
    </div>
  </td>
</tr> 
<?php endforeach;?>
<tr><td colspan="4"><?php echo form_submit('','Imprimir');?></td></tr>
</table>
<?php echo form_close();?>
<script>
$(document).ready(function(){
  $("#all").button();
  $("#all").click(function(){  
    $(".print").each(function(){
      $(this).attr('checked','checked');
    });
    $(".radio").buttonset("refresh");
  });
  $(".radio").buttonset();
  $(".print").button({icons:{primary:'ui-icon-print'},text:false});
  $(".save").button({icons:{primary:'ui-icon-disk'},text:false});
});
</script>
