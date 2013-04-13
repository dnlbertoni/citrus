<div style="text-align:center;">
<h1>Subrubros</h1>
<table>
  <thead>
	<th>Codigo</th>
	<th>Nombre</th>
	<th>Rubro</th>
	<th>nombre para el Producto</th>
	<th colspan="2">&nbsp;</th>
  </thead>
  <?php foreach($subrubros as $subrubro):?>
    <tr>
		<td><?php echo $subrubro->ID_SUBRUBRO?></td>
		<td><?php echo $subrubro->DESCRIPCION_SUBRUBRO?></td>
		<td><?php echo $subrubro->rubro?></td>
		<td><?php echo $subrubro->ALIAS_SUBRUBRO?></td>
		<td><?php echo anchor('articulos/subrubros/editar/'.$subrubro->ID_SUBRUBRO, 'Editar', "class='boton'");?></td>
		<td><?php echo anchor('articulos/subrubros/borrar/'.$subrubro->ID_SUBRUBRO, 'Borrar', 'class="boton"')?></td>
    </tr>
  <?php endforeach;?>
</table>
<?php echo anchor('articulos/subrubros/agregar', "Agregar", "class='boton'");?>
<?php echo anchor('articulos/', 'Menu Articulos', "class='boton'");?>
</div>


<script>
  $(document).ready(function(){
    $(".boton").button();
    $(".boton").css('margin-right', '5px');
    $(".boton").css('margin-left', '5px');
  });
</script>
