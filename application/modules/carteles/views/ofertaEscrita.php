<?php
/*
 * Vista para la funcion Navidad que buscar los articulos, los lista y despues los envia para que se impriman en php
 */

 ?>

 <h1>Carteles de Ofertas Escritas</h1>

 <?php echo form_label('Linea:','linea');?>
 <?php echo form_input('linea','','id="linea"');?>
 <div id="LinAdd">Agrego</div>
<?php echo form_open($accion,'id="Print"');?>
<?php echo form_label('Fecha','fecha');?>
<?php echo form_input('fecha',$fecha,'id="fecha"');?>
<?php echo form_label('Copias','copias');?>
<?php echo form_dropdown('copias',array('1','2','3'),1,'id="copias"');?>
<div id="lineas"></div>
<?php echo form_submit('Imprimir','Imprimir')?>
<?php echo form_close()?>
 <script>
  $(document).ready(function(){
  $("#linea").focus();
  $("#LinAdd").button({icons:{primary:'ui-icon-circle-plus'}});
  $("#linea").bind('keydown', function(e){
    $(this).val($(this).val().substr(0, 20));
  });
  $("#LinAdd").click(function(){
    cantidad = $("#lineas > div").length;
    valor = $("#linea").val();
    var msg = "<div id='linea_"+cantidad+"'>"+valor+"</div>";
    var msg2 = "<input type='hidden' name='linea_"+cantidad+"' value='"+valor+"' />";
    $("#lineas").append(msg);
    $("#lineas").append(msg2);
    $("#linea").val('');
    $("#linea").focus();
  });
  $("#fecha").datepicker({
    altField        : "#fecha",
    altFormat       : 'dd/mm/yy',
    appendText      : "dd/mm/aaaa",
    showButtonPanel : true,
    showOn          : "both"
  });
});
 </script>
