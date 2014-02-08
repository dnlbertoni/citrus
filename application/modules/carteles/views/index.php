<?php
/**
 * Vista del index para el controlador de carteles
 */
?>
<div class="section">
<div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 ">
        <h3><i class="fa fa-money "></i>&nbsp;Carteles Precios</h3>
        <p>The 'Modern Business' website template by <a href="http://startbootstrap.com">Start Bootstrap</a> is built with <a href="http://getbootstrap.com">Bootstrap 3</a>. Make sure you're up to date with latest Bootstrap documentation!</p>
      </div>
      <div class="col-lg-4 col-md-4">
        <h3><i class="fa fa-tasks"></i>Carteles de Ofertas</h3>
        <p>You're ready to go with this pre-built page structure, now all you need to do is add your own custom stylings! You can see some free themes over at <a href="http://bootswatch.com">Bootswatch</a>, or come up with your own using <a href="http://getbootstrap.com/customize/">the Bootstrap customizer</a>!</p>
      </div>
      <div class="col-lg-4 col-md-4">
        <h3><i class="fa fa-usd"></i>Listas de Precios </h3>
        <p>This template features many common pages that you might see on a business website. Pages include: about, contact, portfolio variations, blog, pricing, FAQ, 404, services, and general multi-purpose pages.</p>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.section -->

  <?php foreach($Menu as $menu):?>
 <div id="<?php echo $menu['boton'];?>"><?php echo anchor($menu['link'],$menu['nombre'])?></div>
<?php endforeach;?>