<?php
include 'admin/classes/Database.php';
$db = new Database();
session_start();

$db->query("select specs_id, category_id,product_price,product_type,product_name,product_description,product_image,spec_description  "
        . "from product as p join  specification as s on p.specs_id =s.spec_id "
        . "where product_id=11" );
$result = $db->single();
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>hardware-product</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/small-business.css" rel="stylesheet">
    <!--- theme --->
    <?php if($_SESSION['service'] == 2) echo "<link href='css/hardware.css' rel='stylesheet'>" ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php include 'include/menu.php';?>

<!-- Page Content -->
   <div class="container">

    



            <div class="col-md-9 col-md-offset-1">

                <div class="thumbnail">
                    <img class="img-responsive" src="<?php print($result["product_image"]) ?>" alt="">
                    <div class="caption-full">
                       
                        <h4><a href="#"><?php print($result["product_name"])?></a>
                        </h4>
                        <p><?php print($result["product_description"])?></p>
                       

                        <p><?php print($result["spec_description"])?></p>
                        <a class="btn btn-primary" href="#">factuur aanvragen</a>
                    </div>
                    

                </div>

            </div>


    
    </div>
    <!-- /.container -->

    <div class="container">

    <!-- Footer -->
    <footer>
        <?php include 'include/footer.php';?>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>