<?php $urlBuscoAjax = "'".base_url()."index.php/articulos/submarcas/searchAjax/resultadoAjax"."'";?>
<div style="text-align:center;">
<div id="botSearch" class="boton">Buscar</div><div id="resultadoAjax"></div>
<h1>Submarcas</h1>
<div>Filtrar <?php echo form_input('filtro', '', 'id="filtro"');?></div>
<table id="datos">
  <thead>
	<th>Codigo</th>
	<th>Nombre</th>
	<th>Marca</th>
	<th colspan="2">&nbsp;</th>
  </thead>
  <tbody>
  <?php foreach($submarcas as $submarca):?>
    <tr>
		<td><?php echo $submarca->submarcaId?></td>
		<td><?php echo $submarca->submarcaNombre?></td>
		<td><?php echo $submarca->marcaNombre?></td>
		<td><?php echo anchor('articulos/submarcas/editar/'.$submarca->submarcaId, 'Editar', "class='boton'");?></td>
		<td><?php echo anchor('articulos/submarcas/borrar/'.$submarca->submarcaId, 'Borrar', 'class="boton"')?></td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>
<?php echo anchor('articulos/submarcas/agregar', "Agregar", "class='boton'");?>
<?php echo anchor('articulos/', 'Menu Articulos', "class='boton'");?>
</div>
<div id="searchSubmarca"></div>

<script>
  $(document).ready(function(){
	var theTable = $("#datos");
    $("#filtro").keyup(function() {
		$.uiTableFilter( theTable, this.value );
	});
    $(".boton").button();
    $(".boton").css('margin-right', '5px');
    $(".boton").css('margin-left', '5px');
    $("#botSearch").click(function(){buscoSubmarca();});
  });
function buscoSubmarca(){
var dialogOpts = {
	modal: true,
	bgiframe: true,
	autoOpen: false,
	height: 300,
	width: 500,
	title: "Busco Marca",
	draggable: true,
	resizeable: true,
	close: function(data){
	  $('#searchSubmarca').dialog("destroy");
	}
 };
$('#searchSubmarca').dialog(dialogOpts);	
$("#searchSubmarca").load(<?php echo $urlBuscoAjax;?>, [], function(){
			 $("#searchSubmarca").dialog("open");
		  }
	   );
}
</script>
