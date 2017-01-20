<!-- orgineel Milan Weiss aangepast door Jan Kapijn-->
<!DOCTYPE html>
<?php
include './admin/classes/Database.php';
$db = new Database();
session_start();
$db->query("SELECT * FROM product WHERE category_id = :category ORDER BY product_name");
$db->bind(":category",$_GET["category"]);
$products = $db->resultset();
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Producten</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/small-business.css" rel="stylesheet">
        <!--- theme --->
        <link href="css/theme.css" rel="stylesheet">
        <!--- theme --->
        <?php if ($_SESSION['service'] == 2) echo "<link href='css/hardware.css' rel='stylesheet'>" ?>
        <link href="producten.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-89317406-1', 'auto');
            ga('send', 'pageview');

        </script>

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar  navbar-inverse header-color navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->

                <?php include 'include/menu.php'; ?>

              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div class="container">
          <div class="page-header text-center">
            <h1>Onze producten</h1>
        <!-- Page Content -->
            <div class="row">
                <!-- print voor elke product met een foreach -->

                <?php
                //waarden in een array stoppen
                foreach ($products as $product) {
                    //invoegen standaard afbeelding als geen afbeelding beschikbaar is
                    if ($product["product_image"] != NULL) {
                        $image = $product["product_image"];
                    } else {
                        $image = "http://gemkolabwell.com/Admin/images/product/default_product.jpg";
                    }
                    ?>
                    <div class="col-xs-8 col-md-2">
                        <a href="<?php print ("./product.php?id=" . ($product["product_id"])); ?>" class="thumbnail thumbmax">                           
                            <img class="img-responsive" src="<?php print($image); ?>"/>
                            <h4 class="text-center"><?php print(ucfirst($product["product_name"]));
                      ?></h4>
                            <p class="text-center"><?php print("€ " . $product["product_price"]);
                            ?></p>
                        </a>
                    </div>
    <?php
}
?>
            </div>
        </div>

 

        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
