<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="sp"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="sp"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="sp"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="sp"> <!--<![endif]-->
	<head>
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->            
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Autoservico Santa Lucia</title>           
            <meta name="description" content="">
            <meta name="author" content="danielBertoni">
            <meta name="viewport" content="width=device-width,initial-scale=1.0">
            <?php echo Assets::js('jquery-1.8.3') ?>
            <?php //echo Assets::js('general_settings') ?>
            <?php echo Assets::js('bootstrap') ?>
            <?php echo Assets::css('bootstrap') ?>                 
            <?php echo Assets::js() ?>
            <?php echo Assets::css() ?>                 
	</head>

	<body>
                <?php echo Template::block('navegacion', 'barraNav');?>
		<div class="sidebar">
                    <ul>
                        <li><a href="<?php echo site_url('dashboard'); ?>"><img alt="" src="<?php echo base_url(); ?>themes/light/img/icons/dashboard24x24.png" title="<?php echo 'Home'; ?>" /></a></li>
                        <li><a href="<?php echo site_url('clients/index'); ?>"><img alt="" src="<?php echo base_url(); ?>themes/light/img/icons/clients24x24.png" title="<?php echo 'Clientes'; ?>" /></a></li>
                        <li><a href="<?php echo site_url('quotes/index'); ?>"><img alt="" src="<?php echo base_url(); ?>themes/light/img/icons/quotes24x24.png" title="<?php echo 'Objetivos'; ?>" /></a></li>
                        <li><a href="<?php echo site_url('invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>themes/light/img/icons/invoices24x24.png" title="<?php echo 'Facturas'; ?>" /></a></li>
                        <li><a href="<?php echo site_url('payments/index'); ?>"><img alt="" src="<?php echo base_url(); ?>themes/light/img/icons/payments24x24.png" title="<?php echo 'Pagos'; ?>" /></a></li>
                    </ul>
		</div>
		<div class="main-area">
			<div id="ventanaAjax"></div>
                        <?php echo Template::yield();?>
		</div>
            <!--end.content-->
		<!--[if lt IE 7 ]>
			<script src="http://demo.fusioninvoice.com/assets/default/js/dd_belatedpng.js"></script>
			<script type="text/javascript"> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
		<![endif]-->

		<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
			 chromium.org/developers/how-tos/chrome-frame-getting-started -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script type="text/javascript">window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->            
	</body>
</html>