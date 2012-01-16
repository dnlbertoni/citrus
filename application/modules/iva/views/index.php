<div style="with:48%;float:left">
<table align="center">
  <tr><th colspan="4">Ventas</th></tr>
  <tr>
    <th>Perido</th>
    <th>Cant.Comp.</th>
    <th>Total</th>
    <th>Total Iva</th>
  </tr>
  <?php foreach($periven as $periodo):?>
    <tr>
      <td><?php echo $periodo->periva;?></td>
      <td><?php echo $periodo->cantidad?></td>
      <td><?php echo $periodo->total;?></td>
      <td><?php echo $periodo->totiva;?></td>
    </tr>
  <?php endforeach;?>
</table>
</div>
<div style="with:48%;float:none">
<table align="center">
  <tr>
  <tr><th colspan="4">Compras</th></tr>
    <th>Perido</th>
    <th>Cant.Comp.</th>
    <th>Total</th>
    <th>Total Iva</th>
  </tr>
  <?php foreach($pericom as $periodo):?>
    <tr>
      <td><?php echo $periodo->periva;?></td>
      <td><?php echo $periodo->cantidad?></td>
      <td><?php echo $periodo->total;?></td>
      <td><?php echo $periodo->totiva;?></td>
    </tr>
  <?php endforeach;?>
</table>
</div>