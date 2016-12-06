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
        <?php include 'include/head.php'; ?>

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
                        <br>
                        <br>
                        <?php foreach($_POST as $key => $value){
                            print($key . $value);
                        }
?>
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
