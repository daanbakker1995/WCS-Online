<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Producten Copy Service</title>


        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/small-business.css" rel="stylesheet">
        <!-- theme -->
        <link href="css/theme.css" rel="stylesheet">

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
            <div class="row row-eq-height">
                <!-- print voor elke categorie met een foreach -->

                <?php
                //database connectie maken
                $db = "mysql:host=localhost; dbname=wcs-online_database; port=3307";
                $user = "root";
                $pass = "usbw";
                $pdo = new PDO($db, $user, $pass);
                //waarden in een array stoppen
                $stmt = $pdo->prepare("SELECT product_price, product_image, product_description, product_name FROM product WHERE category_id=1 ORDER BY product_name ASC");
                $stmt->execute();
                $products = $stmt->fetchAll();
                $product_amount = 0;

                //waarden uit de array in een tabel stoppen
                foreach ($products as $product):
                    //invoegen standaard afbeelding als geen afbeelding beschikbaar is
                    if (!isset($product["product_image"]))
                    {
                        $image = "http://larics.rasip.fer.hr/wp-content/uploads/2016/04/default-placeholder.png";
                    } else
                    {
                        $image = $product["product_image"];
                    }
                    //check of de prijs een rond getal is
                    if (is_float($product["product_price"]))
                    {
                        $afronding = "";
                    } else
                    {
                        $afronding = ",-";
                    }
                    ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php print($image); ?>" alt="<?php print($product["product_name"]); ?>" />
                            <div class='caption'>
                                <h2><?php print($product["product_name"]); ?></h2>
                                <p><?php print($product["product_description"]); ?></p>
                                <div class="bt-group-vertical">
                                    
                                        <a href="#" class="btn btn-primary">Aanvragen</a>
                                   
                                   
                                        <a href="#" class="btn btn-default disabled"> Vanaf    &euro;<?php print($product["product_price"] . $afronding); ?></a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    //nieuwe rij beginnen na elk 4e product
                    $product_amount = $product_amount + 1;
                    if (is_integer(($product_amount / 4)))
                    {
                        print('</div><div class="row row-equal-height">');
                    }
                endforeach;
                ?>
            </div>
        </div>
    </body>
</html>
