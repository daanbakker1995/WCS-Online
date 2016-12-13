<!DOCTYPE html>
<?php
include 'admin/classes/Database.php';
$db = new Database();
session_start();
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Monitoren</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/small-business.css" rel="stylesheet">
        <!--- theme --->
        <link href="css/theme.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/hardware.css" rel="stylesheet">
        <link href="\hardwarecategorie\producten.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

    <!-- Navigation -->
    <?php include './include/menu.php';?>
        <div class="container">
                    <div class="page-header text-center">
                        <h1>Onze monitoren</h1>
                    </div>
        </div>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <!-- print voor elke categorie met een foreach -->

                <?php
                //waarden in een array stoppen
                $db->query("SELECT * FROM product WHERE product_type = 'monitor' ORDER BY product_name");
                $products = $db->resultset();
                foreach ($products as $product) {
                    //invoegen standaard afbeelding als geen afbeelding beschikbaar is
                    if ($product["product_image"] != NULL) {
                        $image = $product["product_image"];
                    } else {
                        $image = "http://gemkolabwell.com/Admin/images/product/default_product.jpg";
                    }
                    ?>
                    <div class="col-xs-8 col-md-2">
                        <a href="<?php print ("hardware-product.php?id=" . ($product["product_id"])); ?>" class="thumbnail thumbmax">                           
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