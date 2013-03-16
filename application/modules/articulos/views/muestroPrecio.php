<?php echo form_open('', 'id="consultaPrecio"')?>
<?php echo form_input('codigobarraTXT','','id="CbTXT"')?>
<input type="hidden" id="paginaPrecio2" value="<?php echo base_url(),'index.php/articulos/precioAjaxDo'?>" />
<?php echo form_submit('Consultar', 'Consultar');?>
<?php echo form_close()?>
<br />
<div id="datos"></div>
<script>
$(document).ready(function(){
  $("#codigobarra").removeClass('focus');
  $("#CbTXT").addClass('focus');
  $("#CbTXT").focus();
  $("#CbTXT").bind('keydown', function(e){
    if($(this).hasClass('focus')){
      code=e.keyCode;
      if(code==13){
        $("#consultaPrecio").submit();
      }
    }
  });
  $("#consultaPrecio").submit(function(e){
    e.preventDefault();
    codigobarra  = $("#CbTXT").val().trim();
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
                 $("#CbTXT").val('');
                 $("#CbTXT").focus();
              }
      }).responseText;
    }
  })
});
</script>