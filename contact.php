<?php
include "admin/functions.php";
$db = new Database();

//checken of alles correct is na het submitten
if (isset($_POST["submit"])) {
    $id_gender = $_POST["id_gender"];
    $full_name = $_POST['firstname'] . " " . $_POST['lastname'];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $querytype = $_POST["querytype"];
    $message = $_POST["message"];

    $subject = 'Contact formulier test';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: . $full_name ." ".  <$email>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    //re-captcha werkend maken
    $secret = "6LdOqQ4UAAAAAJsO6oQmSyEBcYEPdCsVRvrKF5Aw";
    $response = $_POST["g-recaptcha-response"];
    $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response");
    $result = json_decode($url, TRUE);
    //checken of alles correct is ingevuld
    if (intval($result["success"]) !== 1) {
        $errors[] = "Vul aub in of u geen robot bent";
    }

    if ($_POST['firstname'] == "" || $_POST['lastname'] == "") {
        $errors[] = 'Vul aub uw volledige naam in.';
    }

    if ($_POST['email'] == "" || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Vul aub een geldig email adres in.';
    }

    if (!$_POST['message']) {
        $errors[] = 'Vul aub uw bericht in.';
    }

    // Als er geen errors zijn stuur de mail
    if (!isset($errors)) {
        require './include/phpmailer/PHPMailerAutoload.php';

        $body = "Van: $id_gender $full_name<br> E-Mail: $email<br> Telefoonnummer: $phone<br> $querytype:<br><br> $message";

        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPDebug = NULL;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 587;                   // set the SMTP port for the GMAIL server
        $mail->Username = "wcs.test.kbs@gmail.com";  // GMAIL username
        $mail->Password = "test123456";            // GMAIL password

        $mail->SetFrom('wcs.test.kbs@gmail.com', 'Eddy Weiss');

        $mail->AddReplyTo("wcs.test.kbs@gmail.com", "Eddy Weiss");

        $mail->Subject = "Contact Formulier";

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $mail->MsgHTML($body);

        $mail->AddAddress($email, $full_name);


        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo '<div class="alert alert-success"><strong>Success!</strong>Het bericht is verzonden! Ga <a href=homepage.php>hier</a> terug naar de homepagina</div>';
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Contact pagina</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/small-business.css" rel="stylesheet">

        <?php if ($_SESSION['service'] == 2) echo "<link href='css/hardware.css' rel='stylesheet'>" ?>

        <script src='https://www.google.com/recaptcha/api.js'></script>

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
        <?php include 'include/menu.php'; ?>
        <!-- /.container -->

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="contact.php" method="post" id="contact_form">

                        <h2>Contact Formulier</h2>
                        <h4>Heeft u een vraag neem dan contact met ons op <br> en wij zullen u zo snel mogelijk u vraag beantwoorden.</h4><br>

                        <?php if (isset($errors)) { ?>
                            <div class="alert alert-danger">
                                <strong>Fout!</strong> er is iets fout gegaan met het versturen van uw gegevens
                                <ul>
                                    <?php
                                    foreach ($errors as $error) {
                                        echo "<li>" . $error . "</li>";
                                    }
                                    //maakt een lijstje van alle errors
                                    ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <div>
                                <label for="id_gender">Aanhef*</label>
                            </div>
                            <div class="form-radio"><input type="radio" name="id_gender" value="Dhr."checked="checked"><label for="id_gender">Dhr.</label></div>
                            <div class="form-radio"><input type="radio" name="id_gender" value="Mevr."><label for="id_gender">Mevr.</label></div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="firstname"> Voornaam*</label>
                            </div>
                            <input class="form-control" type="text" name="firstname" placeholder="Voornaam" required>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="lastname"> Achternaam*</label>
                            </div>
                            <input class="form-control" type="text" name="lastname" placeholder="Achternaam" required>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="emailaddress"> E-mailadres*</label>
                            </div>
                            <input class="form-control" type="email" name="email" placeholder="Email adres" required>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="phone"> Telefoonnummer</label>
                            </div>
                            <input class="form-control" type="text" name="phone" placeholder="Telefoonnummer">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="questions"> Soort vraag*</label>
                            </div>
                            <select class="form-control" name="querytype">
                                <option value='Vraag over lopende bestelling' >Vraag over lopende bestelling</option>
                                <option value='Vraag over betaling' >Vraag over betaling</option>
                                <option value='Vraag over product' >Vraag over product</option>
                                <option value='Overig' >Overig</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="notes"> Vraag*</label>
                            </div>
                            <textarea class="form-control"  name="message" id="message" rows="10" placeholder="Bericht" required></textarea>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdOqQ4UAAAAAGswQcKNkcBtXCmohi-q94smeV27"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>

                    </form>
                </div>
                <div class="col-md-5 col-md-offset-1">  
                    <div class="">   
                        <h2>Bedrijf gegevens</h2><br>
                        <?php
                        $company = get_company_info();
                        //waarden in een array stoppen
                        ?>
                        <div class="form-group">               
                            <h4><?php print($company["company_WCS"]);?></h4>
                            <p><?php print ($company["company_address"]);?></p>
                            <p><?php print ($company["company_zipcode"]." ".$company["company_location"]);?></p>
                            <p><?php print ("Telefoon nummer: " . $company["company_phone"]);?></p>
                            <p class=""><?php print ("Fax: " . $company["company_fax"]);?></p>
                            <p class=""><?php print ($company["company_btw_number"]);?></p>
                            <p class=""><?php print ($company["company_kvk_number"]);?></p>
                            <p class=""><?php print ($company["company_bank_number"]);?></p>     
                        </div>
                        <br /><br /><br/>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.081995756543!2d6.715679200795165!3d52.3870638764328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x50d0ac88c7319c6c!2sWeiss+Copy+%26+Computer+Service!5e0!3m2!1snl!2snl!4v1481032690834" width="350" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div> 
            </div>
        </div>


    </body>
</html>
