<?php 
session_start();
include 'admin/classes/Database.php';
$db = new Database();


if (isset($_POST["submit"])) {
    $id_gender = $_POST["id_gender"];
    $full_name= $_POST['firstname']." ". $_POST['lastname'];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $querytype = $_POST["querytype"];
    $message = $_POST["message"];
    $securimage = $_POST["captcha_code"];
    $to = 'molletje15@live.nl'; 
    $subject = 'Contact formulier test';
    $headers =  'MIME-Version: 1.0' . "\r\n"; 
    $headers .= 'From: . $full_name ." ".  <$email>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    $body ="From: $full_name\n E-Mail: $email\n Message:\n $querytype\n. $message";

    if ($_POST['firstname'] == "" || $_POST['lastname'] == "") {
            $errors[] = 'Vul aub uw volledige naam in.';
    }

    if ($_POST['email'] == "" || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Vul aub een geldig email adres in.';
    }

    if (!$_POST['message']) {
            $errors[] = 'Vul aub uw bericht in.';
    }
    include_once './include/securimage/securimage.php';
    $securimage = new Securimage();


    if ($securimage->check($_POST['captcha_code']) == false) {
    // the code was incorrect
    // you should handle the error so that the form processor doesn't continue
    // or you can use the following code if there is no validation or you do not know how
    echo "De ingevoerde security code was niet geldig<br /><br />";
    echo "Ga aub <a href='javascript:history.go(-1)'>terug</a> en probeer het opnieuw.";
    }


    // If there are no errors, send the email
    if (!isset($errors)) {
         require("include/PHPmailer/_lib/class.phpmailer.php");
        $mail = new PHPMailer();

        if (mail ($to, $subject, $body, $headers)) {
                $result='<div class="alert alert-success">Uw bericht is verzonden, wij zullen u zo snel mogelijk een antwoord terug sturen <a href="homepage.php">Terug naar de homepagina</a> </div>';
        } else {
                $result='<div class="alert alert-danger">Uw bericht is NIET verzonden, probeer het opnieuw of probeer het later</div>';
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
    <!--- theme --->
    <link href="css/theme.css" rel="stylesheet">
    <?php if($_SESSION['service'] == 2) echo "<link href='css/hardware.css' rel='stylesheet'>" ?>


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
                <form  method="post" id="contact_form">
                    <?php if(isset($errors)){?>
                    <div class="alert alert-danger">
                        <strong>Fout!</strong> er is iets fout gegaan met het versturen van uw gegevens
                        <ul>
                        <?php
                            foreach ($errors as $error){
                               echo "<li>".$error."</li>";
                            }
                        ?>
                        </ul>
                      </div>
                    <?php } ?>
                    <h5><strong>Als u het formulier compleet invult dan zullen wij u z.s.m. beantwoorden</strong></h5>
                    <div class="form-group">
                        <div>
                            <label for="id_gender">Aanhef*</label>
                        </div>
                        <div class=" form-radio"><input type="radio" name="id_gender" id="id_gender" value="dhr" checked="checked"><label for="id_gender_dhr">Dhr.</label></div>
                        <div class="form-radio"><input type="radio" name="id_gender" id="id_gender" value="mevr"><label for="id_gender_mevr">Mevr.</label></div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="firstname"> Voornaam*</label>
                        </div>
                            <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Voornaam" required>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="lastname"> Achternaam*</label>
                        </div>
                            <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Achternaam" required>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="emailaddress"> E-mailadres*</label>
                        </div>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Email adres" required>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="phone"> Telefoonnummer</label>
                        </div>
                            <input class="form-control" type="text" id="phone" name="phone" placeholder="Telefoonnummer">
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="questions"> Soort vraag*</label>
                        </div>
                            <select  class="form-control" name="querytype">
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
                            <textarea class="form-control" name="message" id="message" rows="10" placeholder="Bericht" required></textarea>
                    </div>
                    
                        <div class="form-group">
                        <img id="captcha" src="./include/securimage/securimage_show.php" alt="CAPTCHA Image" />
                        <input type="text" name="captcha_code" size="10" maxlength="6" required/>
                        <a href="#" onclick="document.getElementById('captcha').src = './include/securimage/securimage_show.php?' + Math.random(); return false">[ Andere afbeelding ]</a>
                        </div>
                    
                        <button class="form-control" type="submit" id="submit" name="submit" class="btn btn-primary">Verzenden</button>

                </form>
            </div>
            <div class="col-md-6">  
                <div class="">   
                    <h3>Contact</h3>
                    <p><strong>Weiss Copy &amp; Computer Service</strong> <br />
                    Harbrinkhoek 7615 PW  <br />
                    <br />
                    <strong>T </strong>.0546-873366<br />
                    <strong>M.</strong> 06-22497841 <br />
                    <br />
                    <a href="mailto:info@ wcs-online.nl" target="_blank">info@ wcs-online.nl</a> <br />
                    <a href="http://www.wcs-online.nl/" target="_blank">www.wcs-online.nl  </a><br />
                    <br />
                    K.v.K. Enschede<br />
                    BTW nr. NL 059116158B01<br />
                    Rabobank: nr. 10.20.92.257 </p>
                    <br /><br />
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.081995756543!2d6.715679200795165!3d52.3870638764328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x50d0ac88c7319c6c!2sWeiss+Copy+%26+Computer+Service!5e0!3m2!1snl!2snl!4v1481032690834" width="350" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div> 
        </div>
    </div>
    
            
    </body>
</html>
