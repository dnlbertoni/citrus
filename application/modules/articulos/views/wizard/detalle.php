<div class="post">
  <h1>Paso 1 - Definicion del Rubro</h1>
  <div id="detalleArticulo" class="ui-widget">
    <table width="100%">
      <tr>
        <th>Codigo Barra</th>
        <td><?php echo $articulo->CODIGOBARRA_ARTICULO?></td>
        <td></td>
        <th>Descripcion</th>
        <td><?php echo $articulo->DESCRIPCION_ARTICULO?></td>
      </tr>
      <tr>
        <th>Subrubro</th>
        <td><?php echo "( ",$articulo->ID_SUBRUBRO," ) ",$articulo->DESCRIPCION_SUBRUBRO?></td>
        <td></td>
        <th>Rubro</th>
        <td><?php echo "( ",$articulo->ID_RUBRO," ) ",$articulo->DESCRIPCION_RUBRO?></td>
      </tr>
      <tr>
        <th>Submarca</th>
        <td><?php echo "( ",$articulo->ID_SUBMARCA," ) ",$articulo->DETALLE_SUBMARCA?></td>
        <td></td>
        <th>Marca</th>
        <td><?php echo "( ",$articulo->ID_MARCA," ) ",$articulo->DETALLE_MARCA?></td>
      </tr>
      <tr>
        <th>Espedificacion</th>
        <td><?php echo $articulo->especificacion?></td>
        <td></td>
        <th>Medida</th>
        <td><?php echo $articulo->medida?></td>
      </tr>
      <tr>
        <th>Nombre Final</th>
        <td colspan="4"><?php echo $articulo->detalle?></td>
      </tr>
    </table>
  </div>
  <div>&nbsp;</div>
  <?php echo Template::block('sugeridos');?>

  <div id="ninguno" class="ui-widget">
  </div>
  <div id="elegido" class="ui-widget">
    <b>No se Selecciono Ningun Subrubro</b>
  </div>