<?php
/**
 * Created by PhpStorm.
 * User: dnl
 * Date: 20/05/14
 * Time: 19:15
 */?>
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 ">
       <?php echo form_open('stock/inventario/agregoAlConteo');?>
       <div class="panel panel-info">
         <div class="panel-heading">
             <h3>Conteo del <?php echo $depositoNombre?></h3>
         </div>
         <div class="panel-body">
             <div class="form-group">
                 <div class="col-lg-2 ">
                     <?php echo form_label('Codigobarras');?>
                     <?php echo form_input('CB', '', 'class="form-control focus" id="codigobarra"');?>
                 </div>
                 <div class="col-lg-4">
                     <?php echo form_label('Nombre Articulo');?>
                     <div  id="nombreArticulo"></div>
                 </div>
                 <div class="col-lg-2 " >
                     <?php echo form_label('Cant. Bultos');?>
                     <div id="cantidadBultos"></div>
                 </div>
                 <div class="col-lg-2 ">
                     <?php echo form_label('Cant.X Bultos');?>
                     <div id="cantidadXbultos"></div>
                 </div>
                 <div class="col-lg-2 " >
                     <?php echo form_label('Cant. Total');?>
                     <?php echo form_input('cantidad', '', ' class="form-control" id="cantidad"');?>
                 </div>
             </div>
         </div>
         <div class="panel-footer text-center">
             <button type="button"  class="btn btn-info">
                 <span class="fa fa-plus-circle"></span> Agregar al Conteo
             </button>
         </div>
       </div>
       <?php echo form_close();?>
      </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="panel panel-info">
            <table class="table" >
                <thead>
                <th>Codigo Barra</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                </thead>
                <tbody id="datos">
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-info" id="BACK" >Volver</button>
        </div>
    </div>
  </div><!-- /.container -->
</div><!-- /.section -->

<div class="modal fade" role="dialog" id="ventanaCantidades" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cantidad de unidades</h4>
            </div>
            <div class="modal-body">
                <?php echo form_label('Cantidad de Bultos', 'cantidadBultosModal');?>
                <?php echo form_input('cantidadBultosModal', '', 'id="cantidadBultosModal" ');?>
                <br/>
                <?php echo form_label('Unidades X Bultos', 'cantidadXbultosModal');?>
                <?php echo form_input('cantidadXbultosModal', '', 'id="cantidadXbultosModal"');?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="dialog">Cancelar</button>
                <button type="button" class="btn btn-primary">Agregar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    $(document).ready(function(){

       $("#codigobarra").bind('keydown',function(e){
           var code = e.keyCode;
           if($("#codigobarra").hasClass('focus')){
               if($("#codigobarra").val().trim().length > 0){
                   if( code === 13 ){
                       PreguntoCantidadBultos(e);
                   }
               }
           };
       });
       $("#ventanaCantidades").on('show.bs.modal', function(e){
           lastfocus = $(this);
           $(this).find('input:text:visible:first').focus();
       });
    });
    function getSpecialKey(code){
        if(code > 111 && code < 124){
            aux = code - 111;
            return 'f'+aux;
        }else{
            return false;
        }
    }
    function PreguntoCantidadBultos(e){
        $("#codigobarra").removeClass('focus');
        valor=$("#codigobarra").val();
        DatosDelArticulo(valor);
        $("#cantidadBultosModal").focus();
        $("#ventanaCantidades").modal('show');
    }
    function DatosDelArticulo(codigo){
        url=<?php echo $paginaAjaxDatosArticulo?> + '/'+codigo;
        $.getJSON(url, function(data){
            $("#nombreArticulo").text(data.nombre);
            $("#cantidadXbultosModal").val(data.bultos);
        });
    }
</script>