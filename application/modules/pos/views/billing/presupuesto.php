<div class="row ">
  <div class="panel panel-primary">
    <div class="panel-body">
      <div class="col-lg-4 col-md-4 col-xs-4">
        <!--
            <div class="alert alert-info"><?php echo $fechoy ?> <span id="clock"></span></div>
            -->
        <?php echo form_open ('pos/billing/addArticulo', 'id="addCart"'); ?>
        <input type="hidden" name="tmpfacencab_id" value="<?php echo $tmpfacencab_id ?>" id="tmpfacencab_id"/>

        <div class="col-xs-4">
          <?php echo form_label ('Articulo', 'codigobarra', ' class="control-label"'); ?>
        </div>
        <div class="col-xs-8 right">
          <?php echo form_input ('codigobarra', '', 'id="codigobarra" data-toggle="tooltip" data-placement="top" title="articulo | (cant)*(articulo) | (cant)*(precio)*(articulo)" class="form-control"'); ?>
        </div>
        <?php echo form_close (); ?>
        <input type="hidden" id="paginaPrecio" value="<?php echo base_url (), 'index.php/articulos/precioAjax' ?>"/>
        <input type="hidden" id="paginaCliente" value="<?php echo base_url (), 'index.php/cuenta/searchCuentaX/1' ?>"/>
        <input type="hidden" id="paginaCancelo" value="<?php echo base_url (), 'index.php/pos/billing/cancelo' ?>"/>
        <input type="hidden" id="paginaTicket"
               value="<?php echo base_url (), 'index.php/pos/billing/printTicket/', $tmpfacencab_id ?>"/>
        <input type="hidden" id="paginaIndex" value="<?php echo base_url (), 'index.php/pos/billing/presupuesto' ?>"/>
          </div>
      <div class="col-lg-8 col-md-8 col-xs-8">
        <div class="btn-toolbar" role="toolbar">
          <div class="btn-group">
            <button class="btn btn-danger" id="F1"><span class="badge pull-left"> F1 </span>&nbsp;Cancelar</button>
          </div>
          <div class="btn-group">
            <button class="btn btn-info" id="F6"><span class="badge pull-left"> F6 </span>&nbsp;Cliente</button>
            <button class="btn btn-info" id="F8"><span class="badge pull-left"> F8 </span>&nbsp;Forma Pago</button>
          </div>
          <div class="btn-group">
            <button class="btn btn-success" id="F10"><span class="badge pull-left"> F10 </span>&nbsp;Vale</button>
            <button class="btn btn-success" id="F12"><span class="badge pull-left"> F12 </span>&nbsp;Impresion</button>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div><!-- /.row -->
<div class="row"><!-- fila de comprobante -->
  <div class="col-lg-2 col-md-2 col-xs-2">
    <div class="panel <?php echo ($presuEncab->tipcom_id == 1) ? 'panel-info' : 'panel-danger'; ?>">
      <div class="panel-heading"><h4>
          <span id="tipcom_nom"><?php echo ($presuEncab->tipcom_id == 1) ? 'Ticket' : 'Remito'; ?></span>
          <span><?php printf ("%04.0f", $presuEncab->puesto) ?></span>
        </h4>
      </div>
              <div class="panel-body">
                <ul class="list-group">
                  <li class="list-group-item"><?php printf ("%08.0f", $presuEncab->numero) ?></li>
                </ul>
              </div>
      <div class="panel-footer">
        Bultos <span id="bultos" class="text-right"></span>
            </div>
          </div>
  </div>
  <div class="col-lg-3 col-md-3 col-xs-3">
            <div class="panel panel-success">
              <div class="panel-heading"><h4>Cliente <span
                    id="idCuenta"><?php echo sprintf ("( %04u )", $presuEncab->cuenta_id) ?></span></h4></div>
              <div class="panel-body">
                <ul class="list-group">
                  <li class=" list-group-item">
                    <span id="nombreCuenta"><?php echo $presuEncab->cuenta_nombre ?></span>
                  </li>
                </ul>
              </div>

            </div>
          </div>
  <div class="col-lg-3 col-md-3 col-xs-3">
            <div class="panel panel-warning">
              <div class=" panel-heading"><h4 class="text-center">Forma de Pago</h4></div>
              <div class=" panel-body">
                <div class="list-group" id="fpagosList">
                </div>
              </div>
            </div>
          </div>
  <div class="col-lg-4 col-md-4 col-xs-4">
    <div class="panel panel-primary">
      <div class=" panel-heading">
        <h4 class="text-center">Total </h4></div>
              <div class=" panel-body">
                <div>
                  <div class="alert alert-info text-right " style="font-size:48px;font-weight: bolder " id="importe">
                    <?php printf ("$%01.2f", floatval ($totales->Total)); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>      
        </div><!-- /.row -->
<div class="row">
          <div class="col-log-12 col-md-12">
            <div class="panel panel-primary">
              <div class="panel-body">
                <table class="table" id="brief">
                  <thead>
                  <tr>
                    <th width="50%">Descripcion</th>
                    <th width="5%">Cantidad</th>
                    <th width="10%">Precio</th>
                    <th colspan="2">Importe</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($Articulos as $articulo): ?>
                    <tr id="<?php echo $articulo->codmov; ?>">
                      <td><strong><?php echo $articulo->Nombre ?></strong></td>
                      <td><?php echo $articulo->Cantidad ?></td>
                      <td class="text-right"><?php printf ("$%01.2f", $articulo->Precio); ?></td>
                      <td class="text-right"><?php printf ("$%01.2f", $articulo->Importe) ?></td>
                      <td>
                        <?php echo anchor ('pos/billing/delArticulo/' . $articulo->codmov, '<button type="button" class="btn btn-circle btn-xs btn-danger botdel"><span class="fa fa-minus-circle"></span></button> ') ?>
                      </td>
                    </tr>
                    <?php $total += $articulo->Importe; ?>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="panel-footer text-right">
                <h3>Total <span id="importe2"><?php printf ("$%01.2f", $total); ?></span></h3>
              </div>
            </div>
          </div>
    </div> <!-- /.row-->

<div class="modal fade" id="cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Busco Cliente</h4>
        </div>
        <div class="modal-body">
          <?php echo form_open('cuenta/searchCuentaXDo', 'id="consultaCuenta"')?>
          <?php echo form_input('cuentaTXT','','id="cuentaTXT"')?>
          <input type="hidden" id="filtro" value="1" />
          <?php echo form_submit('Consultar', 'Consultar');?>
          <?php echo form_close()?>
          <div id="datosCliente">
            <table class="table" id="datosClientes">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>CUIT</th>
                  <th>Cond. Vta</th>
                  <th>&nbsp;</th>
                </tr>              
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
  </div>  
</div><!-- /.modal -->
<!-- modal de formas de pago -->
<div class="modal fade" id="fpago" tabindex="-1" role="dialog" aria-labelledby="myFpagos" aria-hidden="true">
<div class="modal-dialog modal-sm">
  <?php echo form_open ('pos/billing/fpagosDo', 'id="consultaFpagos"') ?>
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Medios de Pago</h4>
    </div>
    <div class="modal-body">
      <div id="datosFpagos">
        <?php echo form_input ('monto', 0, 'montoTXT') ?>
        <?php foreach ($mediosDePagos as $mp): ?>
          <?php
          $label = $tiposMdP[$mp->tipo]['label'];
          $icon  = $tiposMdP[$mp->tipo]['icon'];
          ?>
          <button type="button" class="btn btn-<?php echo $label ?>"><span
              class="fa <?php echo $icon ?>"></span> <?php echo $mp->nombre ?></button>
        <?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-fpagosSave"><span class="fa fa-save"></span> Grabar
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  <?php echo form_close () ?>
</div>
<!-- /.modal -->

<div class="modal fade" id="imprimo" tabindex="-1" role="dialog" aria-labelledby="imprimo" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Impresion de comprobante...</h4>
      </div>
      <div class="modal-body">
        <div class="fa fa-spinner fa-spin"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div><!-- /.modal impresion-->

<div id="precio"></div>

<script>
$(document).ready(function(){
  setInterval('updateClock()', 1000);  
  muestroFpagos();
  $("#loading").css('text-align', 'center');
  $("#loading").hide();
  $("#cuentaAjax").hide();
  $("#codigobarra").addClass('focus');
  $("#codigobarra").focus();;
  //chequeo las teclas de funciones
  $(document).bind('keydown',function(e){
    var code = e.keyCode;
    key = getSpecialKey(code);
    if(key){
      e.preventDefault();
      switch(key){
        case 'f1':
          CanceloComprobante();
          break;
        case 'f3':
          $("#codigobarra").addClass('focus');
          $("#codigobarra").focus();
          break;
        case 'f6':
          CambioCliente();
          break;
        case 'f8':
          CambioCondicion();
          break;
        case 'f10':
          CambioComprobante();
          break;
        case 'f12':
          Imprimo();
          break;
      }
    };
  });
  $("#codigobarra").bind('keydown',function(e){
    var code = e.keyCode;
    if($("#codigobarra").hasClass('focus')){
      if($("#codigobarra").val().trim().length === 0){
        if( code === 13 ){
              ConsultoPrecio(e);
        };
      }else{
        if( code === 13 ){
          AgregoArticulo(e);
        }
      }
    };
   });
  // fin de chequeo de teclas de funciones
  //activo botones
  $("#F1").button();
  $("#F1").click(function(){CanceloComprobante();});
  $("#F6").button();
  $("#F6").click(function(){CambioCliente();});
  $("#F8").button();
  $("#F8").click(function(){CambioCondicion();});
  $("#F10").button();
  $("#F10").click(function(){ImprimoRemito();});
  $("#F12").button();
  $("#F12").click(function(){ImprimoTicket();});
  $("#addCart").submit(function(e){
    e.preventDefault();
  });
  $("#brief > tbody > tr").first().addClass('info');
  $("#btn-fpagosPlus").button();
  $("#btn-fpagosPlus").click(function () {
    $("#nuevoFpago").show();
  });
});
function AgregoArticulo(e){
    e.preventDefault();
    pagina = $("#addCart").attr('action');
    datos  = $('#addCart').serialize();
    $.post(
            pagina,
            datos,
            function(data){
              if(data.error){
                MuestroError(data.codigoB, data.errorTipo);
              }else{
                AgregoRenglon(data.id,data.descripcion, data.cantidad, data.precio, data.importe);
                $("#bultos").html(data.Bultos);
                $("#importe").html(data.Totales);
                $("#importe2").html(data.Totales);
              };
              muestroFpagos();
              $("#codigobarra").addClass('focus');
              $("#codigobarra").val('');
              $("#codigobarra").focus();
              $("#loading").fadeOut(100);
            }
    );
  }
function MuestroError(CB, error){
  alert( CB + " " + error);
}
function AgregoRenglon(id, descripcion, cantidad, precio, importe){
  $("#brief > tbody > tr").first().removeClass('alert-warning')
  url = <?php echo "'".base_url()."pos/billing/delArticulo/'";?>;
  boton = '<a href="' + url + id + '" class="btn btn-circle btn-xs btn-danger botdel"><span class="fa fa-minus-circle"></span></a>'
  linea = "<tr class='alert alert-warning'>";
  linea += "<td><strong>";
  linea += descripcion;
  linea += "</strong></td><td>";
  linea += cantidad;
  linea += "</td><td align='right'>";
  linea += precio;
  linea += "</td><td align='right'>";
  linea += importe;
  linea += "</td>";
  linea += "<td>"+boton+"</td>";
  linea += "</tr>";
  $("#brief > tbody").prepend(linea);
}
function ConsultoPrecio(e){
  e.preventDefault();
  $("#codigobarra").removeClass('focus');
  var dialogOpts = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        height: 300,
        width: 500,
        title: "Consulta de Precios",
        draggable: true,
        resizeable: true,
        close: function(){
//          $('#precio').dialog("destroy");
          $("#codigobarra").addClass('focus');
          $("#codigobarra").val('');
          $("#codigobarra").focus();
        }
     };
  $("#precio").dialog(dialogOpts);   //end dialog
  $("#precio").load($("#paginaPrecio").val(), [], function(){
                 $("#precio").dialog("open");
              }
           );
}
function CanceloComprobante(){
    id_temporal = $("#tmpfacencab_id").val();
    pagina       = $("#paginaCancelo").val();
    $.post( pagina, {tmpfacencab_id : id_temporal }, function(){
         location.reload();
       });
}
function CambioCliente(){
    $("#cliente").modal({keyboard: true});
    $("#cliente").modal('show');
    $("#cliente").on('shown.bs.modal', function(){
      $("#cuentaTXT").focus();
    });
    $("#cliente").on('hide.bs.modal', function(){
      $("#cuentaTXT").val('');
      $("#datosClientes > tbody").html('');
    });  
    $("#cuentaTXT").bind('keyup',function(e){
      var code = e.keyCode;
      if( ( code<90 && code>57 )  || code===13 || code===8 ){
        envioFormCliente();
      };
   });
   $("#consultaCuenta").submit(function(e){
      e.preventDefault();
     envioFormCliente();
   });    
}
function CambioCondicion() {
  $("#fpago").modal({keyboard: true});
  $("#fpago").modal('show');
}
function CambioComprobante(){
  tipo = ($("#tipcom_nom").html()=='Ticket')?6:1;
  url = <?php echo $paginaCambioComprob;?> + tipo;
  window.location.replace(url);  
}
function ImprimoTicketVie() {
  var url = $("#paginaTicket").val() + '/' + $("#tipcom_id").val() + '/' + $("#condVtaId").val();
  var dialogOpts = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        hide: "explode",
        open: function(){$("#carga").fadeIn();},
        height: 200,
        width: 300,
        title: "Imprimo Comprobante",
        draggable: true,
        resizeable: true,
        close: function(){
          CanceloComprobante();
          window.location = $("#paginaIndex").val();}
  };
  $("#imprimo").dialog(dialogOpts);   //end dialog
  $("#imprimo").load(url, [], function(){
                 $("#imprimo").dialog("moveToTop");
                 $("#imprimo").dialog("open");
              });
}
function Imprimo() {
  $("#imprimo").modal('show');
}
function getSpecialKey(code){
  if(code > 111 && code < 124){
    aux = code - 111;
    return 'f'+aux;
  }else{
    return false;
  }
}
function updateClock(){
    var currentTime = new Date();
    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentSeconds = currentTime.getSeconds();
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
    timeOfDay='';
    // Choose either "AM" or "PM" as appropriate
    //var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
    // Convert the hours component to 12-hour format if needed
    //currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
    // Convert an hours component of "0" to "12"
    //currentHours = ( currentHours == 0 ) ? 12 : currentHours;
    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  total = 0;
  $("#brief > tbody > tr").each(function () {
    total++;
  });
  $("#bultos").html(total);
  $("#clock").html(currentTimeString); 
 }
function delArt(codmov){
  pagina = $("#paginaBorroArticulo").val();
  $.ajax({
        url: pagina,
        contentType: "application/x-www-form-urlencoded",
        global: false,
        type: "POST",
        data: ({ codmov : codmov }),
        dataType: "html",
        async:true,
        //beforeSend: function(){$("#loading").fadeIn();},
        success: function(msg){
           $("#brief").html(msg);
           $("#codigobarra").val('');
           $("#codigobarra").focus();
           $("#loading").fadeOut(100);
        }
  }).responseText;
}
/* funciones de muestra del comprobante */
function muestroFpagos(){
 $("#fpagosList").html('');
 $.getJSON(<?php echo $paginaMuestroFpagos;?>,function(data){
   $.each(data,function(key, dato){
     if(dato.fpagos_id==1){
       label = 'list-group-item-success';
     }else{
       if(dato.fpagos_id==9){
         label = 'list-group-item-danger';
      }else{
         label = 'list-group-item-warning';
      }
     }
     linea = " <div class='list-group-item " + label + "'>" + dato.pagoNombre + " " + dato.monto + "</div>";
     $("#fpagosList").append(linea);
   });
 });
}
function getFpagos() {
  $("#getFpagos").html('');
  $.getJSON(<?php echo $paginaMuestroFpagos;?>, function (data) {
    $.each(data, function (key, dato) {
      if (dato.fpagos_id == 1) {
        label = 'alert alert-success';
      } else {
        if (dato.fpagos_id == 9) {
          label = 'alert alert-danger';
        } else {
          label = 'alert alert-warning';
        }
      }
      linea = "<tr class='" + label + "'><td>" + dato.pagoNombre + "</td><td></td><td>";
      linea += "<input value='" + dato.monto + "'/>";
      linea += "</td></tr>";
      $("#getFpagos").append(linea);
    });
  });
}
function envioFormCliente() {
  cuenta  = $("#cuentaTXT").val().trim();
  filtro = $("#filtro").val();
  pagina       = $("#consultaCuenta").attr('action');
  if(cuenta.length > 0){
    $.ajax({
            url: pagina,
            contentType: "application/x-www-form-urlencoded",
            global: false,
            type: "POST",
            data: ({cuentaTXT : cuenta,
                    filtro    : filtro
                  }),
            dataType: "json",
            async:true,
            success: function(msg){
              muestroClientes(msg.cuentas);
            }
    }).responseText;
  }
}
function muestroClientes(data){
  $("#datosClientes > tbody").html('');
  $.each(data, function(key, cuenta){
    url = <?php echo "'".base_url()."pos/billing/cambioCuenta/$tmpfacencab_id/'"?>;
    linea  = "<tr><td>"+cuenta.id+"</td>";
    linea += "<td>"+cuenta.nombre+"</td>";
    linea += "<td>"+cuenta.cuit+"</td>";
    if(cuenta.ctacte==1){
      clase = 'btn btn-danger';
      label = 'Ctacte';
    }else{
      clase = 'btn btn-success';
      label = 'Contado';
    }
    linea += "<td><a href='"+url+cuenta.id+"' class='"+clase+" btnCli' id='btn_"+cuenta.id+"'><span class='fa fa-check-circle-o'></span> "+label+"</a></td>";   
    linea += "</tr>";
    $("#datosClientes > tbody").append(linea);
  })
}
</script>