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
          (<span class="reqNUM" id="ID_SUBRUBRO"><?php echo $articulo->ID_SUBRUBRO ?></span>)
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
          (<span class="reqNUM" id="ID_MARCA"><?php echo $articulo->ID_SUBMARCA ?></span>)
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
      <div>
          <?php echo form_label('Detalles y especificaiones:','especificacion')?>
          <?php echo form_input('especificacion', $articulo->especificacion, 'id="especificacion" size="20"');?>
          <div style="width: 80%;margin:auto;">
            <h5>Palabras normalmente usadas</h5>
            <?php foreach ($palabrasClaves as $clave):?>
              <div class="wordkey"><?php echo $clave?></div>
            <?php endforeach;?>
          </div>
        <p>&nbsp;</p>
        <div style="width: 80%;margin:auto;">
          <h5>Palabras mas usadas en el Tipo de Producto</h5>
            <?php foreach ($palabrasClavesRubro as $clave):?>
              <div class="wordkey"><?php echo $clave?></div>
            <?php endforeach;?>
        </div>
      </div>
      <p>&nbsp;</p>
      <div>
        <?php echo form_label('Peso / Unidades ', 'medida');?>
        <?php echo form_input('medida',$articulo->medida,'id="medida" size="8"');?>
        <?php foreach ($medidas as $clave):?>
            <div class="wordkeymedidas"><?php echo $clave?></div>
        <?php endforeach;?>
        <div style="width: 80%;margin:auto;">
          <h5>Peso y medias mas usados en el Tipo de Producto</h5>
          <?php foreach ($palabrasClavesMedida as $clave):?>
            <div class="wordkeyunit"><?php echo $clave?></div>
          <?php endforeach;?>
        </div>
      </div>
      Nombre Generado:
      <?php echo form_input('detalle', '', 'id="detalle" size="50" disabled="disabled"');?>
      <br />
      <div id="botonBack">Atras</div>
      <div id="botonNext">Continuar</div>
      <?php echo anchor('articulos/wizard/end/1', 'Salir Asistente', 'id="botonSkip"')?>
      <?php echo form_close();?>
      <input type="hidden" id="paginaAjaxGenero" value="<?php echo base_url(). 'index.php/articulos/generoNombre'?>" />
    </div>
  </div>
<script>
$(document).ready(function(){
  generoNombre();
  $("#wizard input:text").first().focus();
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
    $("#detalle").removeAttr('disabled');
    $("#wizard").submit();
  });
  $(".wordkey").button();
  $(".wordkeyunit").button();
  $(".wordkeymedidas").button();
  $(".wordkey").click(function(){
    valor=$("#especificacion").val() + ' ' + $(this).text();
    $("#especificacion").val(valor);
    generoNombre();
  });
  $(".wordkeyunit").click(function(){
    valor=$(this).text();
    $("#medida").val(valor);
    generoNombre();
  });
  $(".wordkeymedidas").click(function(){
    if($(this).text()==='NADA'){
      valor='';
    }else{
      valor=$("#medida").val()+$(this).text();
    }
    $("#medida").val(valor);
    generoNombre();
  });
  $("#especificacion").change(function(){
    generoNombre();
  });
  $("#especificacion").keypress(function(){
    generoNombre();
  });
  $("#medida").change(function(){
    generoNombre();
  });
  $("#botonBack").click(function(){
        parent.history.back();
        return false;
  });
});
function generoNombre(){
  pagina   = $("#paginaAjaxGenero").val();
  subrubro = $("#ID_SUBRUBRO").text();
  submarca = $("#ID_MARCA").text();
  especif  = $("#especificacion").val();
  valor    = $("#medida").val();
  medida   = valor;
  $.ajax({
          url: pagina,
          contentType: "application/x-www-form-urlencoded",
          global: false,
          type: "POST",
          data: ({subrubro : subrubro,
                  submarca : submarca,
                  especif  : especif,
                  medida   : medida,
                }),
          dataType: "html",
          async:true,
          success: function(msg){
             $("#detalle").val(msg);
           }
  }).responseText;
}
</script>