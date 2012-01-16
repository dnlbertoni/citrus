<?php echo form_open($accion, 'id="wizardPaso2-form"', $ocultos);?>
<?php echo form_close();?>
<?php echo $codigobarra ?>
<h1>Empresa: <?php echo $empresaNombre?></h1>
<h2>Marcas Sugeridos</h2>

<div id="tabs2">
  <ul>
  <?php $aux="";?>
  <?php foreach($marcasCodigoB as $marca):?>
          <?php if($marca->marcaNombre!=$aux):?>
                  <?php $aux=$marca->marcaNombre;?>
                  <li><a href="#<?php echo $marca->marcaId?>"><?php echo $marca->marcaNombre?></a></li>
          <?php endif;?>
  <?php endforeach;?>
  </ul>
  <?php
   $aux="";
   $vez=0;?>
  <?php foreach($marcasCodigoB as $marca):?>
      <?php if($marca->marcaNombre!=$aux):?>
          <?php if($vez>0):?>
                  </div>
          <?php endif;?>
          <?php $vez++;?>
          <?php $aux=$marca->marcaNombre;?>
          <div id="<?php echo $marca->marcaId?>">
      <?php endif;?>
      <span class="boton" id="<?php echo $marca->submarcaId?>"><?php echo $marca->submarcaNombre?></span>
  <?php endforeach;?>
  </div>
</div>

<div id="tabs">
  <ul>
  <?php $aux="";?>
  <?php foreach($marcasEmpresa as $marca):?>
          <?php if($marca->marcaNombre!=$aux):?>
                  <?php $aux=$marca->marcaNombre;?>
                  <li><a href="#<?php echo $marca->marcaId?>"><?php echo $marca->marcaNombre?></a></li>
          <?php endif;?>
  <?php endforeach;?>
  </ul>
  <?php
   $aux="";
   $vez=0;?>
  <?php foreach($marcasEmpresa as $marca):?>
      <?php if($marca->marcaNombre!=$aux):?>
          <?php if($vez>0):?>
                  </div>
          <?php endif;?>
          <?php $vez++;?>
          <?php $aux=$marca->marcaNombre;?>
          <div id="<?php echo $marca->marcaId?>">
      <?php endif;?>
      <span class="boton" id="<?php echo $marca->submarcaId?>"><?php echo $marca->submarcaNombre?></span>
  <?php endforeach;?>
  </div>
</div>

<h3>Todos las Marcas</h3>

<div id="botBuscoSubmarca">Buscar Marca</div>
<div id="botSel" class="boton botSel"></div>
<div id="resultadoAjaxPaso2"></div>
<div id="searchSubmarcas"></div>


<script>
$(document).ready(function(){
  $("#tabs").tabs();
  $("#tabs2").tabs();
  $(".boton").button();
  $(".botSel").hide();
  $("#botBuscoSubmarca").button();
  $(".boton").click(function(){
    var valor = $(this).attr('id');
    $('[name="id_submarca"]').val(valor);
    $("#wizardPaso2-form").submit();
  });
  $("#botBuscoSubmarca").click(function(){
    buscoSubmarca();
  });
});
function buscoSubmarca(){
$('.bolSel').hide();
var dialogOpts = {
	modal: true,
	bgiframe: true,
	autoOpen: false,
	height: 300,
	width: 500,
	title: "Busco Submarca",
	draggable: true,
	resizeable: true,
	close: function(data){
	  var texto = $("#resultadoAjaxPaso2 >.detalle").text();
	  var id    = $("#resultadoAjaxPaso2 >.codigo").html();
	  $(".botSel").html(texto);
	  $(".botSel").show();
	  $(".botSel").attr('id',id);
	  $('#searchSubmarcas').dialog("destroy");
	}
 };
$('#searchSubmarcas').dialog(dialogOpts);
$("#searchSubmarcas").load(<?php echo $urlSearchSubmarcas;?>, [], function(){
			 $("#searchSubmarcas").dialog("open");
		  }
	   );
}
</script>
