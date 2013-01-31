<div class="post">
<h1>Paso 1 - Definicion del Rubro</h1>
<div id="detalleArticulo" class="ui-widget">
  Muestro los datos del articulo que ya tengo
</div>

<?php echo form_open($accion, "id='wizardPaso1-form'", $ocultos);?>
<?php echo form_close();?>
<div class="ui-widget">
  <h3 class="ui-widget-header">Rubros Sugeridos</h3>
  <div class="ui-widget-content">
    <div id="tabs">
      <ul>
      <?php $aux="";?>
      <?php foreach($rubrosEmpresa as $rubro):?>
              <?php if($rubro->rubroNombre!=$aux):?>
                      <?php $aux=$rubro->rubroNombre;?>
                      <li><?php print("<a href='#$rubro->rubroId'>$rubro->rubroNombre</a>") ?></li>
              <?php endif;?>
      <?php endforeach;?>
      </ul>
      <?php
      $aux="";
      $vez=0;?>
      <?php foreach($rubrosEmpresa as $rubro):?>
          <?php if($rubro->rubroNombre!=$aux):?>
              <?php if($vez>0):?>
                      </div>
              <?php endif;?>
              <?php $vez++;?>
              <?php $aux=$rubro->rubroNombre;?>
              <div id="<?php echo $rubro->rubroId?>">
          <?php endif;?>
          <span class="boton" id="<?php echo $rubro->subrubroId?>"><?php echo $rubro->subrubroNombre?></span>
      <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<div>&nbsp;</div>
<div class="ui-widget">
  <h3 class="ui-widget-header">Todos los rubros</h3>
  <div class="ui-widget-content">
    <div id="tabs2">
      <ul>
      <?php $aux="";?>
      <?php foreach($rubrosMarca as $rubro):?>
              <?php if($rubro->rubroNombre!=$aux):?>
                      <?php $aux=$rubro->rubroNombre;?>
                      <li><a href="#<?php echo $rubro->rubroId?>"><?php echo $rubro->rubroNombre?></a></li>
              <?php endif;?>
      <?php endforeach;?>
      </ul>
      <?php
      $aux="";
      $vez=0;?>
      <?php foreach($rubrosMarca as $rubro):?>
          <?php if($rubro->rubroNombre!=$aux):?>
              <?php if($vez>0):?>
                      </div>
              <?php endif;?>
              <?php $vez++;?>
              <?php $aux=$rubro->rubroNombre;?>
              <div id="<?php echo $rubro->rubroId?>">
          <?php endif;?>
          <span class="boton" id="<?php echo $rubro->subrubroId?>"><?php echo $rubro->subrubroNombre?></span>
      <?php endforeach;?>
      </div>
    </div>
  </div>
</div>

<div id="botBuscoSubrubro">Buscar Rubro</div>
<div id="botSel" class="boton botSel"></div>
<div id="resultadoAjaxPaso1"></div>
<div id="searchSubrubro"></div>


</div>

<script>
$(document).ready(function(){
  $("#tabs").tabs();
  $(".ui-widget-content").css('padding','5px');
  $("#tabs2").tabs();
  $(".boton").button();
  $(".botSel").hide();
  $("#botBuscoSubrubro").button();
  $(".boton").click(function(){
    var valor = $(this).attr('id');
    $('[name="id_subrubro"]').val(valor);
    $("#wizardPaso1-form").submit();
  });
  $("#botBuscoSubrubro").click(function(){
    buscoSubrubro();
  });
});
function buscoSubrubro(){
$('.bolSel').hide();
var dialogOpts = {
	modal: true,
	bgiframe: true,
	autoOpen: false,
	height: 300,
	width: 500,
	title: "Busco Subrubro",
	draggable: true,
	resizeable: true,
	close: function(data){
	  var texto = $("#resultadoAjaxPaso1 >.detalle").text();
	  var id    = $("#resultadoAjaxPaso1 >.codigo").html();
	  $(".botSel").html(texto);
	  $(".botSel").show();
	  $(".botSel").attr('id',id);
	  $('#searchSubrubro').dialog("destroy");
	}
 };
$('#searchSubrubro').dialog(dialogOpts);
$("#searchSubrubro").load(<?php echo $urlSearchSubrubro;?>, [], function(){
			 $("#searchSubrubro").dialog("open");
		  }
	   );
}
</script>
