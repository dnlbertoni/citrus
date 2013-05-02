<style>
  .boxCont{
    width:25%;
    float:left;
    text-align: center;
  }
</style>
<h2 >Todos</h2>
  <div id="resto" >
      <?php
      $aux=false;
      $primero=true;
      $y=0;
      ?>
      <?php foreach($todos as $s):?>
          <?php if($aux!=$s->{$idMaster}):?>
            <?php if(!$primero):?>
              <?php echo "</div></div>";?>
            <?php endif;?>
              <div <?php echo "id='master_".$s->{$idMaster}."'"."class='boxCont'"?>  >
              <h3><?php echo substr($s->{$nombreMaster},0,20)?></h3>
              <div <?php echo "id='mov_".$s->{$idMaster}."'"."class='boxMov'"?>>
            <?php
            $aux=$s->{$idMaster};
            $y=($y<3)?$y += 1:0;
            $primero=false;
            ?>
            <div id="sm_<?php echo $s->{$idMov}?>"class="boton"><?php echo $s->{$nombreMov}?></div>
        <?php else:?>
            <div id="sm_<?php echo $s->{$idMov}?>"class="boton"><?php echo $s->{$nombreMov}?></div>
        <?php endif;?>
      <?php endforeach;?>
      <?php echo "</div></div>";?>
  </div>

</div>

<script>
$(document).ready(function(){
  $(".boxCont").addClass('ui-widget');
  $(".boxMov").addClass('ui-widget-content');
  $(".boxMov").hide();
  $(".boxCont > h3").addClass('ui-widget-header');
  $(".boxCont").click(function(){
    $(this).children().show();
  });
  $(".boton").button();
  $(".boton").click(function(){
    $("#seleccion").text($(this).attr('id'));
  });
});
</script>
