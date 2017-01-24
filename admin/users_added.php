<?php
/**
 * Created by Maarten Klomp
 * met medwerking van Daan Bakker & Jan Kaptijn
 */
session_start();
$admin_rights = true; // Page is only for admins.
include "check_login.php";
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
            $active = "gebruiker";
            include 'include/menu.php';
            include 'classes/Database.php';
            ?>

            <div id="page-wrapper">
                <!--invoegen in database-->
                <?php
                //test of wachtwoord voldoet aan eisen
                if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $_POST["pwd"]))
                {
                    ?>
                    <div class="alert alert-danger">
                        <p>Het wachtwoord moet 8-20 tekens bevatten. Waarvan minimaal 1 kleine letter(a-z), 1 hoofdletter(A-Z), 1 cijfer(0-9) en 1 speciaal teken(!@#$%).</p>
                    </div>
                    <a href="users_add.php" class="btn btn-primary">Terug</a>
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
                    $db = new Database();
                    $db->query('INSERT INTO user (user_name, user_email, user_password, user_type) VALUES (:username,:mail,:password,:type)');
                    $db->bind(':username', $_POST['user']);
                    $db->bind(':mail', $_POST['email']);
                    $db->bind(':password', $paswh);
                    $db->bind(':type', $role);
                    $db->execute();
                    ?>

                    <div id="page-wrapper">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <h2>De volgende gebruiker is toegevoegd</h2>
                                <br>
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Emailadres</th>
                                        <th>Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php print($_POST["user"]); ?></td>
                                        <td><?php print($_POST["email"]); ?></td>
                                        <td><?php print($_POST["role"]); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="users.php" class="btn btn-primary">Terug naar overzicht</a>
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
