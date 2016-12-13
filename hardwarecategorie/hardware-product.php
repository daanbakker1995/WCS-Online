<?php
include "../admin/functions.php";
$db = new Database();

///kijken of de er gesubmit is
if (isset($_POST['submit'])){
    if(insert_quotation($_GET["id"], $_POST['name'], $_POST['email'])){
         echo "succesvol aangevraagd!";
    }

} 
///pagina info opvragem met het id van de vorige pagina
 $db->query("select *  "
                . "from product "
                . "where product_id=".$_GET['id'] );
        $result = $db->single();
        $product_id = $_GET["id"];
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/small-business.css" rel="stylesheet">
    <!--- theme --->
    <?php if($_SESSION['service'] == 2) echo "<link href='../css/hardware.css' rel='stylesheet'>" ?>

        <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="modal fade" id="quotation_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h3>aanvraag bevestigen</h3>
                </div>
                  <form method="POST">
                    <div class="modal-body">
                        <p>Om uw aanvraag te bevestigen hebben wij de volgende gegevens nodig</p>
                        <input type="hidden" value="<?php echo $product_id; ?>" name="id">
                        naam:<input type="text" class="form-control" name="name"/>
                        email:<input type="email" class="form-control" name="email"/>
                    </div>
                    <div class="modal-footer">
                        <a href="#" type="button" class="btn btn-default" data-dismiss="modal">Annuleren</a>
                        <input type ="submit" class="btn btn-primary btn-ok" name="submit" value="gegevens verzenden"/>
                   </div>
                </form>                
            </div>
        </div>
    </div>
<?php include '../include/menu.php';?>

<!-- Page Content -->
   <div class="container">

            <div class="col-md-9 col-md-offset-1">

                <div class="thumbnail">
                    <img class="img-responsive" src="<?php print($result["product_image"]) ?>" alt="">
                    <div class="caption-full">
                       
                        <h4><a href="#"><?php print($result["product_name"])?></a>
                        </h4>
                        <p><?php print($result["product_description"])?></p>
                                              
                        <a  class="btn btn-primary" data-toggle="modal" data-target="#quotation_request">factuur aanvragen</a>
                    </div>
                    

                </div>

            </div>


    
    </div>
    <!-- /.container -->

    <div class="container">

    <!-- Footer -->
    <footer>
        <?php include '../include/footer.php';?>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

</body>

</html>