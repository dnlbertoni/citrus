<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <?php echo $_scripts ?>
  <?php echo $_styles ?>
  <title><?php echo $title;?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="outer">
  <div id="outer2">
    <div id="header">
      <h1>Autoservicio Santa Lucia</h1>
      <h2>Sistema de Gestion</h2>
      <div id="boxAyuda"><div id="admin">Configuracion</div><div id="problema">Problema</div></div>
    </div>
    <div id="menu">
      <?php if(isset($menu)):?>
        <?php echo $menu?>
      <?php else:?>
        Falta definir el menu;
      <?php endif;?>
    </div>
    <div id="content">
      <?php if($tareas):?>
      <div id="column1">
        <?php echo $contenido;?>
      </div>
      <?php else:?>
        <?php echo $contenido;?>
      <?php endif;?>
      <?php if($tareas):?>
        <div id="column2">
        <h1>Tareas regulares</h1>
         <ul class="sidemenu">
            <?php echo $tareas ?>
         </ul>
        </div>
      <?php endif;?>
    </div>
    <div id="footer">
      <p>&copy; 2010 Autoservicio Santa Lucia | Author >> DnL | <?php echo anchor('version/', 'Version '. VERSION);?></p>
    </div>
  </div>
</div>
</body>
</html>

<script>
$(document).ready(function(){
  $("#admin").button({icons:{primary:'ui-icon-wrench'}, text:false});
  $("#ayuda").button({icons :{primary:'ui-icon-help'}});
  $("#problema").button({icons :{primary:'ui-icon-alert'}, text:false});
  $("#boxAyuda").css('float','right');
 
  alto   = $("#header").css('height');
  largo  = $("#header").css('width');
  posArr = $("#header > h1").position().top - 80;
  posIzq = $("#header > h1").position().left - 450;
  valor  = 0+ " " + 0;
  valor  = posIzq+ " " + posArr;
  $("#boxAyuda").position({ my: "top",
                            of:"#header",
                            offset: valor,
                            collision: "flip"});
  capa = $("#boxAyuda");
  var posicion = "";
  posicion += "Posición relativo al documento:\nLEFT: " + capa.offset().left + "\nTOP:" + capa.offset().top;
  posicion += "\n\nPosición si no tuviera margen:\nLEFT: " + capa.position().left + "\nTOP:" + capa.position().top;
  //alert(posicion);
 
});
</script>