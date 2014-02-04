<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <?php echo Assets::js('jquery') ?>
    <?php echo Assets::js('bootstrap') ?>             
    <?php echo Assets::css('bootstrap') ?>                 
    <?php echo Assets::css('modern-business') ?> 
    <?php //echo Assets::css('bootstrap') ?>        
    <?php echo Assets::js() ?>
    <?php echo Assets::css() ?> 
  </head>

  <body>
    <!-- menu navegacion -->
    <?php echo Template::block('menu', 'menu')?>
    <?php echo Template::yield();  ?>

    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; Company 2013</p>
          </div>
        </div>
      </footer>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>
