<?php
session_start();
//if($_SESSION["ingelogd"] == true){
//
//}
// else {
//       header('location: ./login.php');       
//}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- ADMIN HEADER -->
        <?php include 'include/head.php'; 
        include '/classes/database.php'?>
        <link href="css/MaartenTheme.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <!-- ADMIN MENU -->
            <?php
            $active = "Dashboard";
            include 'include/menu.php';
            ?>

            <div id="page-wrapper">

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
