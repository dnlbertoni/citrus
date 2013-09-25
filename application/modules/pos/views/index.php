<h1>Modulo de Puesto de Venta</h1>

<?php echo anchor('pos/factura/presupuesto','Emision Ticket','id="bot_ticket"');?>
<?php echo anchor('caja','Modulo de Caja','id="bot_caja"');?>

<script>
$(document).ready(function(){
  $("#bot_ticket").button({icons:{primary:'ui-icon-cart'}});
  $("#bot_caja").button({icons:{primary:'ui-icon-calculator'}});
});
</script>
