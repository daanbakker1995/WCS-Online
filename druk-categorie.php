<!-- orgineel Milan Weiss aangepast door Jan Kapijn-->
<!DOCTYPE html>
<?php
//databse class aanroepen
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

    <title>categorie</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/small-business.css" rel="stylesheet">
    <!--- theme --->
    <?php if($_SESSION['service'] == 2) echo "<link href='css/hardware.css' rel='stylesheet'>" ?>
    <!--- categorie.css -->
    <link href="css/categorie.css" rel="stylesheet">
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
        <?php include 'include/menu.php';
        
        ?>

        <div class="container">
                    <div class="page-header text-center">
                        <h1>Drukservice Catalogus</h1>
                    </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- print voor elke categorie met een foreach -->

                <?php
                //waarden in een array stoppen
                $db->query("SELECT * FROM category WHERE category_name = 'copy service' ORDER BY product_type");
                $products = $db->resultset();
                $product_amount = 0;
                foreach ($products as $product) {
                    //invoegen standaard afbeelding als geen afbeelding beschikbaar is
                    if ($product["product_type_image"] != NULL) {
                        $image = $product["product_type_image"];
                       
                    }
                    else {
                        $image = "http://gemkolabwell.com/Admin/images/product/default_product.jpg";
                    }
                    ?>
                    <?php $_SESSION['copy-category']=$product["category_id"]?>
                    <div class="col-xs-6 col-md-4">
                        <a href="druk-catalogus.php?category=<?=$_SESSION['copy-category'];?>" class="thumbnail thumbmax">
                            <img class="img-responsive" src="<?php print($image); ?>"/>
                                <h2 class="text-center"><?php print(ucfirst($product["product_type"]));?></h2>
                        </a>
                    </div>
                    <?php

                }
                ?>
            </div>
        </div>
    </body>
</html>
