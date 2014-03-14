<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <?php echo form_open('pos/billing/addArticulo', 'id="addCart"');?>
        <input type="hidden" name="tmpfacencab_id" value="<?php echo $tmpfacencab_id ?>" id="id_tmpencab" />
        Articulo <?php echo form_input('codigobarra','','id="codigobarra"');?>
        <span style="font-size: 8px;">(cant)*(articulo) | (cant)*(precio)*(articulo)</span>
        <?php echo form_close();?>
      </div>
      <div class="col-lg-8 col-md-8">
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
    </div><!-- /.row -->
<!-- ver com oeliminar -->
<input type="hidden" id="paginaPrecio" value="<?php echo base_url(),'index.php/articulos/precioAjax'?>" />
<input type="hidden" id="paginaBorroArticulo" value="<?php echo base_url(),'index.php/pos/factura/delArticulo'?>" />
<input type="hidden" id="paginaCliente" value="<?php echo base_url(),'index.php/cuenta/searchCuentaX/1'?>" />
<input type="hidden" id="paginaCancelo" value="<?php echo base_url(),'index.php/pos/factura/cancelo'?>" />
<input type="hidden" id="paginaTicket" value="<?php echo base_url(),'index.php/pos/factura/printTicket/',$tmpfacencab_id?>" />
<input type="hidden" id="paginaIndex" value="<?php echo base_url(),'index.php/pos/factura/presupuesto'?>" />        
<div class="row">
  &nbsp;
<div id="loading">
  <?php echo Assets::image('loading.gif',array('alt'=>"Loading..."));?>
</div>  
</div>
<div class="row text-center"><!-- fila de comprobante -->
        <div class="col-lg-3 col-md-3">
          <div class="panel panel-info">
            <div class="panel-heading"><?php echo $fechoy;?>&nbsp;<span id="clock"></span></div>
            <div class="panel-body">
              <ul class="list-group">
                <li class="list-group-item"><span id="tipcom_nom">Ticket</span></li>
                <li class="list-group-item">Nro:<?php printf("%04.0f - %08.0f", $presuEncab->puesto, $presuEncab->numero); ?></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="panel panel-success">
            <div class="panel-heading">Cliente</div>
            <div class="panel-body">
              <ul class="list-group">
                <li class=" list-group-item" ><span id="idCuenta"><?php echo sprintf("( %04u )",$presuEncab->cuenta_id)?></span>&nbsp;<span id="nombreCuenta"><?php echo $presuEncab->cuenta_nombre?></span></li>
              </ul>
            </div>
            <div class="panel-footer ">
              <p id="bultos">Total Bultos <?php echo intval($totales->Bultos) ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2">
          <div class="panel panel-warning">
            <div class=" panel-heading">Forma de Pago</div>
            <div class=" panel-body">
              <table class="table">
                <tbody>
                  <?php foreach( $fpagos as $fp):?>
                  <tr>
                    <td><?php echo $fp->nombre?></td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="panel panel-warning">
            <div class=" panel-heading">Importe</div>
            <div class=" panel-body">
              <ul class=" list-group">
                <li class=" list-group-item text-danger" style="font-size:56px;" id="importe"><?php printf("$%01.2f", floatval($totales->Total));?></li>
              </ul>
            </div>

          </div>
        </div>      
      </div><!-- /.row -->
      <div class="row">
        <div class="col-log-12 col-md-12">
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
              <?php foreach($Articulos as $articulo):?>
              <tr>
                <td><?php echo $articulo->Nombre?></td>
                <td><?php echo $articulo->Cantidad ?></td>
                <td align="right"><?php printf("$%01.2f", $articulo->Precio );?></td>
                <td align="right"><?php printf("$%01.2f", $articulo->Importe )?></td>
                <td>
                  <div id="<?php echo $articulo->codmov?>"class="botdel">Quitar Articulo</div>
                </td>
              </tr>
              <?php $total += $articulo->Importe;?>
              <?php endforeach;?>              
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" align="right">Total</th>
                <th align="right" colspan="2"><?php printf("$%01.2f", $total);?></th>
              </tr>              
            </tfoot>
          </table>        
        </div>
  </div> <!-- /.row-->
  </div><!-- /.container -->
</div><!-- /.section -->

<div id="cliente"></div>
<div id="cuentaAjax"></div>
<div id="precio"></div>
<div id="imprimo"></div>

<script>

$(document).ready(function(){
  setInterval('updateClock()', 1000);  
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
        case 'f9':
          ImprimoDescuento();
          break;
        case 'f10':
          ImprimoRemito();
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
                AgregoRenglon(data.descripcion, data.cantidad, data.precio);
                $("#bultos").html(data.Bultos);
                $("#importe").html(data.Totales);
              }
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
function AgregoRenglon(descripcion, cantidad, precio){
  linea = "<tr><td>"+descripcion+"</td><td>"+cantidad+"</td><td>"+precio+"</td><td>"+(cantidad*precio)+"</td></tr>";
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
    $("#cuenta").val(1);
    puesto       = $("#puesto").val();
    id_temporal = $("#id_tmpencab").val();
    pagina       = $("#paginaCancelo").val();
    $.ajax({
            url: pagina,
            contentType: "application/x-www-form-urlencoded",
            global: false,
            type: "POST",
            data: ({puesto : puesto,
                    id_tmpencab : id_temporal
                  }),
            dataType: "html",
            async:true,
            beforeSend: function(){$("#loading").fadeIn();},
            success: function(msg){
               $("#brief").html(msg);
               $("#codigobarra").val('');
               $("#codigobarra").focus();
               $("#loading").fadeOut(200);
            }
    }).responseText;
}
function CambioCliente(){
  $("#codigobarra").removeClass('focus');
  var dialogOpts = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        hide: "explode",
        height: 300,
        width: 500,
        title: "Consulta de Clientes",
        draggable: true,
        resizeable: true,
        close: function(){
          valor  = $("#cuentaAjax > .codigo").html();
          nombre = $("#cuentaAjax > .nombre").html();
          ctacte = $("#cuentaAjax > .ctacte").html();
          ctacteId = (ctacte === "CtaCte" )?1:0;
          tipcom = $("#cuentaAjax > .tipcom").html();
          $("#idCuenta").html(valor);
          $("#cuentaAjax").html(valor);
          $("#cuenta").val(valor);
          $("#nombreCuenta").html(nombre);
          $("#condVta").html(ctacte);
          $("#condVtaId").val(ctacteId);
          $("#tipcom_id").val(tipcom);
          $("#tipcom_nom").html("Factura");
          claseCondVta = (ctacte=="CtaCte")?"ui-state-error":"ui-state-default";
          $("#condVta").removeAttr('class');
          $("#condVta").addClass(claseCondVta);

          $("#cliente").dialog('destroy');
          $("#codigobarra").addClass('focus');
          $("#codigobarra").val('');
          $("#codigobarra").focus();
        }
     };
  $("#cliente").dialog(dialogOpts);   //end dialog
  $("#cliente").load($("#paginaCliente").val(), [], function(){
                 $("#cliente").dialog("moveToTop");
                 $("#cliente").dialog("open");
              }
           );
}
function CambioCondicion(){
  valor = $("#condVta").html();
  if(valor == "Contado"){
    $("#condVta").html('CtaCte');
    $("#condVta").removeClass('ui-state-default');
    $("#condVta").addClass('ui-state-error');
    $("#condVtaId").val(1);
  }else{
    $("#condVta").html('Contado');
    $("#condVta").removeClass('ui-state-error');
    $("#condVta").addClass('ui-state-default');
    $("#condVtaId").val(0);
  }
}
function ImprimoRemito(){
  tipo =   parseInt($("#tipcom_id").val());
  if(tipo == 6){
	$("#tipcom_nom").removeClass('ui-state-default');
	if($("#idCuenta").val()==1){
	  $("#tipcom_id").val('1');
	  $("#tipcom_nom").html('Ticket');
	}else{
	  $("#tipcom_id").val('2');
	  $("#tipcom_nom").html('Factura');
	}
  }else{
    $("#tipcom_id").val('6');
    $("#tipcom_nom").html('Remito');
    $("#tipcom_nom").addClass('ui-state-default');
  }
}
function ImprimoDescuento(){
  tipo =   parseInt($("#tipcom_id").val());
  if(tipo == 9){
	$("#tipcom_nom").removeClass('ui-state-default');
	if($("#idCuenta").val()==1){
	  $("#tipcom_id").val('1');
	  $("#tipcom_nom").html('Ticket');
	}else{
	  $("#tipcom_id").val('2');
	  $("#tipcom_nom").html('Factura');
	}
  }else{
    $("#tipcom_id").val('9');
    $("#tipcom_nom").html('Descuento CTACTE');
    $("#tipcom_nom").addClass('ui-state-default');
  }
}
function ImprimoTicket(){
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
</script>