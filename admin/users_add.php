<?php
session_start();
if($_SESSION["ingelogd"] == true){

}
 else {
       header('location: ./login.php');       
}
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
                        <form action="users_added.php" method="post">
                            <div class="form-group">
                                <label for="user">Gebruikersnaam</label>
                                <input type="text" class="form-control" id="user" required name="user">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" required name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Wachtwoord</label>
                                <input type="password" class="form-control" id="pwd" required name="pwd">
                            </div>
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <select class="form-control" id="role" required name="role">
                                    <option>Admin</option>
                                    <option>Content Beheerder</option>                                 
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="toevoegen"/>
                            </div>
                        </form>
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
