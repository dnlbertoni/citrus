<div class="post">
  <h1><?php echo $tit ?></h1>
  <div id="detalleArticulo" class="ui-widget">
    <table width="100%">
      <tr>
        <th>Codigo Barra</th>
        <td class="reqTXT" id="CB"><?php echo $articulo->CODIGOBARRA_ARTICULO?></td>
        <td></td>
        <th>Descripcion</th>
        <td class="reqTXT"><?php echo $articulo->DESCRIPCION_ARTICULO?></td>
      </tr>
      <tr>
        <th>Subrubro</th>
        <td>
          (<span class="reqNUM"><?php echo $articulo->ID_SUBRUBRO ?></span>)
          <?php echo $articulo->DESCRIPCION_SUBRUBRO?>
        </td>
        <td></td>
        <th>Rubro</th>
        <td>
          (<span class="reqNUM"><?php echo $articulo->ID_RUBRO ?></span>)
          <?php echo $articulo->DESCRIPCION_RUBRO?>
        </td>
      </tr>
      <tr>
        <th>Submarca</th>
        <td>
          (<span class="reqNUM"><?php echo $articulo->ID_SUBMARCA ?></span>)
          <?php echo $articulo->DETALLE_SUBMARCA?>
        </td>
        <td></td>
        <th>Marca</th>
        <td>
          (<span class="reqNUM"><?php echo $articulo->ID_MARCA ?></span>)
          <?php echo $articulo->DETALLE_MARCA?>
        </td>
      </tr>
      <tr>
        <th>Espedificacion</th>
        <td class="reqTXT"><?php echo $articulo->especificacion?></td>
        <td></td>
        <th>Medida</th>
        <td class="reqTXT"><?php echo $articulo->medida?></td>
      </tr>
      <tr>
        <th>Nombre Final</th>
        <td colspan="4" class="reqTXT"><?php echo $articulo->detalle?></td>
      </tr>
      <tr>
        <th>Precio</th>
        <td ><span class="reqNUM"><?php echo $articulo->PRECIOVTA_ARTICULO?></span></td>
        <td></td>
        <th>Tasa Iva</th>
        <td>
          <div id="radio-iva">
            <?php echo form_label('21%', 'iva1');?><?php echo form_radio('TASAIVA_ARTICULO', 21, ($articulo->TASAIVA_ARTICULO==21)?true:false,'id="iva1"')?>
            <?php echo form_label('10.5%', 'iva2');?><?php echo form_radio('TASAIVA_ARTICULO', 10.50, ($articulo->TASAIVA_ARTICULO==10.50)?true:false,'id="iva2"')?>
            <?php echo form_label('OTRO', 'iva3');?><?php echo form_radio('TASAIVA_ARTICULO', 21, ($articulo->TASAIVA_ARTICULO==0)?true:false,'id="iva3"')?>
          </div>
        </td>
      </tr>
    </table>
  </div>
  <p>&nbsp;</p>
  <div id="asignar" class="ui-widget">
    <h2 class="ui-widget-header"><span class="ui-icon ui-icon-circle-plus" style="display: inline-block;"></span>Asignar...</h2>
    <div id="resultado" class="ui-widget-content">
      <?php echo form_open($accion, 'id="wizard"', $ocultos)?>
      <?php echo $textoAsignar?>
      <div id="botonBack">Atras</div>
      <div id="botonNext">Continuar</div>
      <div id="botonSkip">Salta Paso</div>
      <?php echo form_close();?>
    </div>
  </div>
  <p>&nbsp;</p>
  <?php echo Template::block('sugeridos');?>
  <p>&nbsp;</p>
  <?php echo Template::block('todos');?>
  <p>&nbsp;</p>
  <?php echo Template::block('ninguno');?>
<script>
$(document).ready(function(){
  $(".ui-widget-header").click(function(){
    $(this).next().toggle();
  });
  $(".ui-widget-header").next().hide();
  $("#resultado").show();
  $("#radio-iva").buttonset();
  $(".reqTXT").each(function(){
    valor=$(this).text().trim();
    if(valor.length<1){
      $(this).addClass('est_0');
    }else{
      $(this).addClass('est_1');
    };
  });
  $(".reqNUM").each(function(){
    valor=parseFloat($(this).text());
    if(valor>0){
      $(this).parent().addClass('est_1');
    }else{
      $(this).parent().addClass('est_0');
    };
  });
  $("#botonBack").button({icons:{primary:'ui-icon-seek-prev'}});
  $("#botonSkip").button({icons:{primary:'ui-icon-seek-next'}});
  $("#botonNext").button({icons:{primary:'ui-icon-play'}});
  $("#botonNext").click(function(){
    valor=$("#asignar>#resultado>#wizard>#codigo").text();
    $('input[name="valor"]').val(valor);
    $("#wizard").submit();
  });
});
</script>