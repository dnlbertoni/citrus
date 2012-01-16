<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php echo $_scripts ?>
  <?php echo $_styles ?>
  <title><?php echo $title;?></title>
</head>
<body >
<div id="wrap">
<!-- wrap starts here -->
	<div id="header">
        
		<h1 id="logo">Autoservicio <span>Santa Lucia</span></h1> 
		<h2 id="slogan">sistema Citrus</h2>
		<h3 id="tituloModulo"><?php echo $title ?></h3>			
	</div>
		
	<div id="menu">
	<?php if(isset($menu)):?>
	 <?php echo $menu?>
	<?php else:?>
    Falta definir el menu;
  <?php endif;?>
	</div>					
    <?php if(isset($tareasSet)):?>
      <?php if($tareasSet):?>
        <div id="sidebar">
        <h1>Tareas regulares</h1>
         <ul class="sidemenu">
            <?php echo $tareas ?>
         </ul>
        </div>
      <?php endif;?>
    <?php endif;?>
    
    <div id="main">
        <?php echo $contenido;?>
    </div>
</div>
<!-- wrap ends here -->	
<!-- footer starts here -->	
	<div id="footer">
        <div id="footer-content">
            <div id="footer">
                  &copy; 2010 Autoservicio Santa Lucia |
                  <a href="http://www.stylishtemplate.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a> | 
                  Author >> DnL |
                  <?php echo anchor('version/', 'Version '. VERSION);?> 
            </div>
		</div>	
	</div>
<!-- footer ends here -->	
</body>
</html>
