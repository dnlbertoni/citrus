<div class="post">
  <table id="datos">
    <thead>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Precio</th>
    <th>Subrubro</th>
    <th>Marca</th>
    <th >&nbsp;</th>
    </thead>
    <tbody>
      Existen <?php echo count($articulos);?> articulos para revisar...
      <?php $x=0;?>
      <?php foreach($articulos as $articulo):?>
      <tr <?php echo 'id="linea_'.$articulo->id.'"'?> class="linea est_<?php echo $articulo->estado?>">
        <td><?php echo $articulo->id?></td>
        <td><?php echo $articulo->nombre?></td>
        <td><?php echo $articulo->precio?></td>
        <td><?php echo $articulo->subrubro?></td>
        <td><?php echo $articulo->marca?></td>
        <td>
          <?php echo anchor('articulos/wizard/index/'.$articulo->codigobarra, 'Asistente', 'class="botonAsistente"')?>
          <?php echo anchor('articulos/borrar/'.$articulo->id.'/1', 'Borrar', 'class="botonBorrar botonAjax"')?>
        </td>
      </tr>
      <?php $x++;
      if($x>250){
        break;
      }?>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<script>
$(document).ready(function(){
  $(".botonAsistente").button({icons:{primary:'ui-icon-star'}, text:false});
  $(".botonBorrar").button({icons:{primary:'ui-icon-trash'}, text:false});
});
</script>
