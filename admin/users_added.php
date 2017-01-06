<?php
session_start();
if ($_SESSION["ingelogd"] == true)
{
    
} else
{
    header('location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- ADMIN HEADER -->
<?php include 'include/head.php'; ?>
        <link href="css/MaartenTheme.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <!-- ADMIN MENU -->
            <?php
            $active = "Dashboard";
            include 'include/menu.php';
            include 'classes/Database.php';
            ?>

            <div id="page-wrapper">
                <!--invoegen in database-->
                <?php
                //test of wachtwoord voldoet aan eisen
                if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]$/', $_POST["pwd"]))
                {
                    ?>
                    <div class="alert alert-danger">
                        <p>Het wachtwoord moet minstens 1 letter, 1 cijfer en 1 teken bevatten.</p>
                    </div>
                <?php
                } else
                {
                    //rol string omzetten naar integer voor gemak

                    if ($_POST["role"] == "Admin")
                    {
                        $role = 1;
                    } else
                    {
                        $role = 2;
                    }
                    //password hashen
                    $paswh = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

                    //database connectie
                    $db = "mysql:host=localhost; dbname=wcs-online_database; port=3307";
                    $user = "root";
                    $pass = "usbw";
                    $pdo = new PDO($db, $user, $pass);
                    $sql = "INSERT INTO user (user_name, user_email, user_password, user_type) VALUES (?,?,?,?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($_POST["user"], $_POST["email"], $paswh, $role));
                    ?>

                    <div class="container-fluid">
                        <div id="page-wrapper">
                            <h2>De volgende gebruiker is toegevoegd</h2>
                            <br>
                            <div class="row index">
                                <div class="col-md-3">
                                    <p>username</p>
                                </div>
                                <div class="col-md-3">
                                    <p>emailadres</p>
                                </div>
                                <div class="col-md-3">
                                    <p>wachtwoord</p>
                                </div>
                                <div class="col-md-3">
                                    <p>rol</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><?php print($_POST["user"]); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <p><?php print($_POST["email"]); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <p><?php print($_POST["pwd"]); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <p><?php print($_POST["role"]); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- /#page-wrapper -->

                </div>
                <!-- /#wrapper -->
<?php } ?>

            <!-- jQuery -->
            <script src="js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="js/plugins/morris/raphael.min.js"></script>
            <script src="js/plugins/morris/morris.min.js"></script>
            <script src="js/plugins/morris/morris-data.js"></script>

    </body>

</html>
