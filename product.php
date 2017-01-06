
<!--jan kaptijn-->
<?php
include "admin/functions.php";

$db = new Database();

///product info opvragem met het id van de vorige pagina
$db->query("select *  "
        . "from product "
        . "where product_id=" . $_GET['id']);
$result = $db->single();
$product_id = $_GET["id"];

/// kijken of er afmetingen moeten komen of dat er een maat moet komen.
if (isset($_POST['lengte'])){
    $specs = $_POST['lengte']."X".$_POST['breedte'];
}
elseif(isset ($_POST['maat'])){
   
    $specs = $_POST['maat'];
}
else{
    $specs = "no specs";
}

/// bedrijf is niet verplicht dus deze moet leeg zijn als hij niet geset is
if(isset($_POST['company'])){
    $company=$_POST['company'];
}
else
    $company = NULL;

///kijken of de er gesubmit is
if (isset($_POST['submit'])) {
    insert_quotation($_GET["id"], $_POST['name'], $_POST['email'],$_POST['address'],$_POST['zipcode'],$company,$_POST['place'],$specs,$_POST['aantal']);
        
    }

/// als er een email adres is ingevlut wordt de email geconfigureerd.
if (isset($_POST['email'])) {
    require_once('admin/classes/phpmailer/class.phpmailer.php');
    include("admin/classes/phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

    $mail = new PHPMailer();


    $body = "Beste " . ucfirst($_POST['name']) . "<br> U hebt een offerteaanvraag gedaan van het volgende product: " . $result['product_name'];
    $mail->IsSMTP(); // telling the class to use SMTP

    $mail->SMTPDebug = NULL;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    $mail->SMTPAuth = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username = "wcs.test.kbs@gmail.com";  // GMAIL username
    $mail->Password = "test123456";            // GMAIL password

    $mail->SetFrom('wcs.test.kbs@gmail.com', 'eddy weiss');

    $mail->AddReplyTo("wcs.test.kbs@gmail.com", "eddy weiss");

    $mail->Subject = "factuur aavraag";

    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($body);

    $address = $_POST['email'];
    $mail->AddAddress($address, "John Doe");


    if (!$mail->Send()) {
        print('<div class="alert alert-success"> <strong>Success!</strong> Uw aanvraag is verzonden, u ontvangt een email ter bevestiging.</div>');
    } else {
        print('<div class="alert alert-success"> <strong>Success!</strong> Uw aanvraag is verzonden, u ontvangt een email ter bevestiging.</div>');
    }
}
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>product</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/small-business.css" rel="stylesheet">
        <!--- theme --->
        <?php
        if (isset($_GET['service']) && $_GET['service'] == 'drukservice') {
            $_SESSION['service'] = 1; // drukservice
        } elseif (isset($_GET['service']) && $_GET['service'] == 'computerservice') {
            $_SESSION['service'] = 2; // computerservice
        } else {
            
        }

        if ($_SESSION['service'] == 2)
            echo "<link href='css/hardware.css' rel='stylesheet'>"
            ?>


        <!-- jQuery -->
        <script src="js/jquery.js"></script>
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
        
        <form method="POST">
            <div class="modal fade" id="quotation_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h3>aanvraag bevestigen</h3>
                        </div>
<!--                        het maken van een popup  -->
                            <div class="modal-body">
                                <p>Om uw aanvraag te bevestigen hebben wij de volgende gegevens nodig</p>
                                <input type="hidden" value="<?php echo $product_id; ?>" name="id">*
                                naam:<input type="text" class="form-control" name="name" required/>*
                                email:<input type="email" class="form-control" name="email" required/>*
                                adres:<input type="text" class="form-control" name="address" required/>*
                                woonplaats:<input type="text" class="form-control" name="place" required/>*
                                postcode:<input type="text" class="form-control" name="zipcode" required/>
                                bedrijf:<input type="text" class="form-control" name="company"/>
                            </div>
                            <div class="modal-footer">
                                <a href="#" type="button" class="btn btn-default" data-dismiss="modal">Annuleren</a>
                                <input type ="submit" class="btn btn-primary btn-ok" name="submit" value="gegevens verzenden"/>
                            </div>
                                        
                    </div>
                </div>
            </div>
            <?php include 'include/menu.php'; ?>

            <!-- Page Content -->
            <div class="container">
                <!--            <div class="thumbnail">-->

                <div class="row">
                    <div class="col-md-5 col-md-offset-2">
                        <img class="img-responsive" src="<?php print($result["product_image"]) ?>" alt="">
                    </div>
                    <div class="caption-full">
                        <div class="col-md-3">
                            
<!--                            hier kan de klant een aantal invoeren-->
                        aantal<input class=" form-control col-xs-2 " type="number" name="aantal" min="0" max="99"><br>
                            <?php
                            /// als de catgorie kleding is->
                            if ($result['category_id'] == 1) {
                               
                              
                                print('
                        
                            welke groot wil u hebben<br>
                            <label class="form-check-inline">
                                <input class="form-check-input" type="radio" name="maat" id="Radio1" value="S"> S
                            </label>
                            <label class="form-check-inline">
                                <input class="form-check-input" type="radio" name="maat" id="Radio2" value="M"> M
                            </label>
                            <label class="form-check-inline">
                                <input class="form-check-input" type="radio" name="maat" id="Radio3" value="M"> L
                            </label>
                            <label class="form-check-inline">
                                <input class="form-check-input" type="radio" name="maat" id="Radio3" value="XL"> XL
                            </label>
                            <label class="form-check-inline">
                                <input class="form-check-input" type="radio" name="maat" id="Radio3" value="XXl"> XXL
                            </label>
                        </form>
                       
                        '); 
                            }
                            if(isset($_POST['maat'])){
                                  $mail_content =" maat:".$_POST['maat'];
                            }
                            ?>
                     <?php
                          ///als de categorie iets anders van de drukservice is ->
                          if ($result['category_id'] == 10 || $result['category_id'] == 11) { 
                          print('afmetingen in cm
                            <div class = "row form-group">
                                <div class = "col-md-6">
                                    <label for = "ex1">lengte</label>
                                    <input class = "form-control"  type = "number" min="0" name="lengte">
                                </div>
                                
                                <div class = "col-md-6">
                                    <label for = "ex1">breedte</label>
                                    <input class = "form-control" type = "number" min="0" name="breedte">
                                </div>
                            </div>    
                          ');}
                             
                          ?>
                        </div>
                    </div>    
                </div>
                <div class="col-md-offset-2">
                    <h4><a href="#"><?php print($result["product_name"]) ?></a></h4>
                    <p><?php print($result["product_description"]) ?></p>
                    <a  class="btn btn-primary" data-toggle="modal" data-target="#quotation_request">factuur aanvragen</a>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container -->

    <div class="container">

        <!-- Footer -->
        <footer>
            <?php include 'include/footer.php'; ?>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>