<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Hardware Catalogus</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/small-business.css" rel="stylesheet">
        <!--- theme --->
        <link href="css/hardware.css" rel="stylesheet">
        <!--- category img CSS -->
        <link href="css/categorie.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar  navbar-inverse header-color navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img class="logo" src="images/logo.png" alt="">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div class="container">
                    <div class="page-header text-center">
                        <h1>Hardware Catalogus</h1>
                    </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- print voor elke categorie met een foreach -->

                <?php
                //database connectie maken
                include 'admin/classes/Database.php';
                $pdo = new Database();
                //waarden in een array stoppen
                $pdo->query("SELECT DISTINCT product_type, product_type_image FROM category WHERE category_id=2 ORDER BY product_type");
                $products = $pdo->resultset();
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
                    <div class="col-xs-6 col-md-4">
                        <a href="<?php
                        print ("/hardwarecategorie/" . $product["product_type"] . ".php");
                        ?>" class="thumbnail thumbmax">                           
                            <img class="img-responsive" src="<?php print($image); ?>"/>
                                <h2 class="text-center"><?php print(ucfirst($product["product_type"]));
                                if ($product["product_type"] == "PC") {
                                    print ("'s");
                                }
                                if ($product["product_type"] == "software") {
                                    print("");
                                }
                                else if ($product["product_type"] == "PC-component" ||$product["product_type"] == "monitor" ) {
                                    print ("en");
                                }
                                else {
                                    print ("s");
                                }
?></h2>            
                        </a>
                    </div>
                    <?php

                }
                ?>
            </div>
        </div>
    </body>
</html>
