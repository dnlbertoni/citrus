<?php echo form_open('', 'id="consultaPrecio"')?>
<?php echo form_input('codigobarraTXT','','id="codigobarraTXT" class=":integer :required"')?>
<input type="hidden" id="paginaPrecio2" value="<?php echo base_url(),'index.php/articulos/precioAjaxDo'?>" />
<?php echo form_submit('Consultar', 'Consultar');?>
<?php echo form_close()?>
<br />
<div id="datos"></div>
<script>
$(document).ready(function(){
  $("#codigobarraTXT").focus();
  $("#consultaPrecio").submit(function(e){
    e.preventDefault();
    codigobarra  = $("#codigobarraTXT").val().trim();
    pagina       = $("#paginaPrecio2").val()
    if(codigobarra.length > 0){
      $.ajax({
              url: pagina,
              contentType: "application/x-www-form-urlencoded",
              global: false,
              type: "POST",
              data: ({codigobarra : codigobarra }),
              dataType: "html",
              async:true,
              success: function(msg){
                 $("#datos").html(msg);
              }
      }).responseText;
    }
  })
});
</script>