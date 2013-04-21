  <h2 class="ui-widget-header">Sugeridos</h2>
  <div id="sug">
      <?php
      $aux=false;
      $primero=true;
      ?>
      <?php foreach($sugeridos as $s):?>
        <?php if($aux!=$s->{$idMaster}):?>
            <?php if(!$primero):?>
                <?php echo "</p></div>\n"?>
            <?php endif;?>
            <h3><?php echo $s->{$nombreMaster}?>&nbsp;<?php echo $s->aciertoMarca?></h3>
            <?php echo "<div><p>\n";?>
            <?php
            $aux=$s->{$idMaster};
            $primero=false;
            ?>
            <div id="sm_<?php echo $s->{$idMov}?>"class="boton"><?php echo $s->{$nombreMov}?>&nbsp;<?php echo $s->aciertoSubmarca?></div>
        <?php else:?>
            <div id="sm_<?php echo $s->{$idMov}?>"class="boton"><?php echo $s->{$nombreMov}?>&nbsp;<?php echo $s->aciertoSubmarca?></div>
        <?php endif;?>
      <?php endforeach;?>
     <?php // ya salimos hay que acomodar el div
      echo "</p></div>";
     ?>
    </div>
  </div>

<script>
$(document).ready(function(){
  $("#sug").accordion({
    collapsible:true,
    icons:{header: "ui-icon-circle-plus", activeHeader: "ui-icon-circle-minus"},
    heightStyle: "fill"
  });
  $(".boton").button();
  $("#sug > h3").css('padding', '5px 5px 5px 25px');
  $(".boton").click(function(){
    $("#seleccion").text($(this).attr('id'));
  });
});
</script>
