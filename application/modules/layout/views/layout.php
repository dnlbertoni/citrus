<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Autoservico Santa Lucia</title>
		<meta name="description" content="">
		<meta name="author" content="William G. Rivera">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
		<script src="<?php echo base_url(); ?>assets/default/js/libs/modernizr-2.0.6.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap.min.js"></script>
        <script type="text/javascript">

            $(function()
            {
                $('.nav-tabs').tab();
                $('.tip').tooltip();
				
                //$('.datepicker').datepicker({ format: '<?php //echo date_format_datepicker(); ?>'});
		
                $('.create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>");
                });
				
                $('.create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>");
                });
				
                $('#btn_quote_to_invoice').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_quote_to_invoice'); ?>/" + quote_id);
                });
				
                $('#btn_copy_invoice').click(function() {
                    invoice_id = $(this).data('invoice-id');
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_copy_invoice'); ?>", {invoice_id: invoice_id});
                });
                
                $('#btn_copy_quote').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_copy_quote'); ?>", {quote_id: quote_id});
                });
                
                $('.client-create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });
                $('.client-create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });
				$(document).on('click', '.invoice-add-payment', function() {
                    invoice_id = $(this).data('invoice-id');
                    invoice_balance = $(this).data('invoice-balance');
                    $('#modal-placeholder').load("<?php echo site_url('payments/ajax/modal_add_payment'); ?>", {invoice_id: invoice_id, invoice_balance: invoice_balance });
                });

            });

        </script>

	</head>

	<body>

		<nav class="navbar navbar-inverse">

			<div class="navbar-inner">

				<div class="container">

					<ul class="nav">

						<li><?php echo anchor('pos/', 'Home'); ?></li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'Clientes - Eliminar'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('clients/form', 'Agregar Cliente'); ?></li>
								<li><?php echo anchor('clients/index', 'Ver Clientes'); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'Ventas'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('ticket', 'Ticket'); ?></li>
								<li><?php echo anchor('ticket', 'Cierre Z'); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('ticket', 'Factura  OFF LINE'); ?></li>
								<li><?php echo anchor('ticket', 'NC OFF LINE'); ?></li>
								<li><?php echo anchor('ticket', 'Cierre Z OFF LINE'); ?></li>
								<li><?php echo anchor('quotes/index', 'Ver objetivos'); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'Compras'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('facturas/add/10', 'Nueva Factura'); ?></li>
								<li><?php echo anchor('facturas/add/13', 'Nueva NC'); ?></li>
								<li><?php echo anchor('cuenta/crear', 'Nueva Proveedor'); ?></li>
								<li><?php echo anchor('facturas/buscar', 'Ver Facturas'); ?></li>
							</ul>
						</li>
                        
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'I.V.A'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('iva', 'Resumen'); ?></li>
								<li><?php echo anchor('iva/cierre', 'Cierre Perido'); ?></li>
								<li><?php echo anchor('iva/libro','Libro IVA'); ?></li>
								<li><?php echo anchor('iva/ingbru','Percepciones'); ?></li>
							</ul>
						</li>
						
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'Articulos'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('articulos/', 'Resumen'); ?></li>                              
								<li><?php echo anchor('articulos/estadisticas', 'Estadisticas'); ?></li>                              
                                <li class="divider"></li>                              
								<li><?php echo anchor('articulos/rubros', 'Rubros'); ?></li>
								<li><?php echo anchor('articulos/subrubros', 'Subrubros'); ?></li>
                                <li class="divider"></li>                              
								<li><?php echo anchor('articulos/marcas', 'Marcas'); ?></li>
								<li><?php echo anchor('articulos/submarcas', 'Submarcas'); ?></li>							
                                <li class="divider"></li>                              
								<li><?php echo anchor('articulos/subirListaAS', 'Lista de Precio '); ?></li>
								<li><?php echo anchor('articulos/subirListaLS', 'Lista de Precios Sugeridos'); ?></li>							
                            </ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'Carteleria'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('carteles/precios/1', 'Carteles Precios'); ?></li>
								<li><?php echo anchor('carteles/precios/2', 'Carteles Vinos'); ?></li>
								<li><?php echo anchor('carteles/navidad', 'Carteles Navidad'); ?></li>
                                <li class="divider"></li>                              
								<li><?php echo anchor('carteles/ofertas/3', 'Oferta 3xHoja'); ?></li>
								<li><?php echo anchor('carteles/ofertas/1', 'Oferta 1xHoja'); ?></li>
								<li><?php echo anchor('carteles/ofertaMultiple', 'Oferta Multiple'); ?></li>
								<li><?php echo anchor('carteles/ofertaEscrita', 'Oferta Texto Escrito'); ?></li>
                                <li class="divider"></li>                              
								<li><?php echo anchor('carteles/listaDePrecios', 'Lista de Precios'); ?></li>
							</ul>
						</li>
                        
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo 'CtaCte'; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('reports/sales_by_client','Panel Informativo'); ?></li>
								<li><?php echo anchor('reports/invoice_aging', 'Nuevo Cliente'); ?></li>
								<li><?php echo anchor('reports/payment_history', 'Estadisticas'); ?></li>
							</ul>
						</li>
					</ul>

					<?php if (isset($filter_display) and $filter_display == TRUE) { ?>
					<?php $this->layout->load_view('filter/jquery_filter'); ?>
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" id="filter" placeholder="<?php echo $filter_placeholder; ?>">
					</form>
					<?php } ?>

					<ul class="nav pull-right settings">
                      <!--
                        <li><a href="#"><?php echo 'Bienvenido' . ' ' . $this->session->userdata('user_name'); ?></a></li>
                        <li class="divider-vertical"></li>
                      -->
                        <li><a href="http://docs.fusioninvoice.com/1.3/" target="_blank" class="tip icon" data-original-title="Documentation" data-placement="bottom"><i class="icon-question-sign"></i></a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown" data-original-title="<?php echo 'Config'; ?>" data-placement="bottom"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu">
                            	<li><?php echo anchor('email_templates/index', 'Email'); ?></li>
                                <li><?php echo anchor('tax_rates/index', 'Impuestos'); ?></li>
								<li><?php echo anchor('users/index', 'Usuarios'); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('settings', 'Config. Sistema'); ?></li>
							</ul>
						</li>
                        <!--
						<li class="divider-vertical"></li>
						<li><a href="<?php echo site_url('sessions/logout'); ?>" class="tip icon logout" data-original-title="<?php echo 'Salir'; ?>" data-placement="bottom"><i class="icon-off"></i></a></li>
                        -->
					</ul>

				</div>

			</div>

		</nav>

		<div class="sidebar">

			<ul>
				<li><a href="<?php echo site_url('dashboard'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/dashboard24x24.png" title="<?php echo 'Home'; ?>" /></a></li>
				<li><a href="<?php echo site_url('clients/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/clients24x24.png" title="<?php echo 'Clientes'; ?>" /></a></li>
				<li><a href="<?php echo site_url('quotes/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/quotes24x24.png" title="<?php echo 'Objetivos'; ?>" /></a></li>
				<li><a href="<?php echo site_url('invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/invoices24x24.png" title="<?php echo 'Facturas'; ?>" /></a></li>
				<li><a href="<?php echo site_url('payments/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/payments24x24.png" title="<?php echo 'Pagos'; ?>" /></a></li>
			</ul>

		</div>

		<div class="main-area">

			<div id="ventanaAjax"></div>
			
			<?php echo $content; ?>

		</div><!--end.content-->

		<script defer src="<?php echo base_url(); ?>assets/default/js/plugins.js"></script>
		<script defer src="<?php echo base_url(); ?>assets/default/js/script.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datepicker.js"></script>

		<!--[if lt IE 7 ]>
			<script src="<?php echo base_url(); ?>assets/default/js/dd_belatedpng.js"></script>
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