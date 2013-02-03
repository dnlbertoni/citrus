<div id="sugeridos" class="ui-widget">
  <div id="rubros">
    <?php $sugAux=false;?>
    <?php $vez=0;?>
    <?php foreach($sugeridos as $su):?>
      <?php if($sugAux!=$su->rubroId):?>
        <?php if($vez > 0){
          echo "</div>";
        };?>
        <h3><?php echo $su->rubroNombre;?></h3>
        <?php $sugAux = $su->rubroId;?>
        <?php echo "<div>";?>
      <?php endif;?>
      <div id="<?php echo $su->subrubroId;?>" class="boton"><?php echo $su->subrubroNombre;?></div>
      <?php $vez++;?>
    <?php endforeach;?>
    <?php echo "</div>";?>
  </div>
  <div>&nbsp;</div>
  <div id="nextSug">Mas Opciones...</div>
</div>
<div>&nbsp;</div>
<div id="todos" class="ui-widget">
  <div id="rubros2">
    <?php $sugAux=false;?>
    <?php $vez=0;?>
    <?php foreach($todos as $su):?>
      <?php if($sugAux!=$su->rubroId):?>
        <?php if($vez > 0){
          echo "</div>";
        };?>
        <h3><?php echo $su->rubroNombre;?></h3>
        <?php $sugAux = $su->rubroId;?>
        <?php echo "<div>";?>
      <?php endif;?>
      <div id="<?php echo $su->subrubroId;?>" class="boton"><?php echo $su->subrubroNombre;?></div>
      <?php $vez++;?>
    <?php endforeach;?>
    <?php echo "</div>";?>
  </div>
  <div>&nbsp;</div>
  <div id="nextNew">No existe el rubro...</div>
</div>

<script>
$(document).ready(function(){
  /* estetica y definiciones */
  $("#rubros").accordion({
      heightStyle: "content",
      icons: { "header": "ui-icon-circle-plus", "headerSelected": "ui-icon-circle-minus" }
    });
  $("#rubros2").accordion({
      heightStyle: "content",
      icons: { "header": "ui-icon-circle-plus", "headerSelected": "ui-icon-circle-minus" }
    });
  $("h3").css('padding','10px 10px 10px 30px');
  $("#nextSug").button();
  $("#nextNew").button();
  $(".boton").button();
  $("#botBuscoSubrubro").button();
  $("#todos").hide();
  $("#ninguno").hide();
  url=<?php echo $urlAddSubrubro;?>;
  $("#ninguno").load(url, [], function(){
    alert("cargo");
  });
  /* eventos y consecuencias */
  $("#nextSug").click(function(){
    $("#sugeridos").hide();
    $("#todos").show();
    $("#ninguno").hide();
  });
  $("#nextNew").click(function(){
    $("#sugeridos").hide();
    $("#todos").hide();
    $("#ninguno").show();
  });
});
</script>
