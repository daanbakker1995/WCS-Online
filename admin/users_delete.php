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
                $userid = $_GET["id"];
                //userinformatie ophalen
                $db = new Database();
                $db->query('SELECT user_name, user_email, user_type FROM user WHERE user_id=:id');
                $db->bind(":id", $userid);
                $users = $db->single();

                //check of de user super admin is
                if ($users["user_type"] == 0)
                {
                    ?><div class="alert alert-danger">
                        <p>Super admin kan niet verwijderd worden</p>
                    </div>
                    <a href="users.php" class="btn btn-primary">Terug naar overzicht</a><?php
                }

                //user verwijderen als bevestigd
                elseif (isset($_POST['confirm']) AND $_POST['confirm'])
                {
                    $db = new Database();
                    $db->query('DELETE FROM user WHERE user_id=:id');
                    $db->bind(":id", $userid);
                    $db->execute();
                    ?>
                    <div class="alert alert-success">
                        <h2>De gebruiker is verwijderd</h2>
                        <br>
                    </div>
                    <a href="users.php" class="btn btn-primary">Terug naar overzicht</a> <?php
                } else
                {
                    ?>
                    <!-- overzicht van gebruiker -->
                    <div class="container-fluid">
                        <div id="page-wrapper">
                            <h2>Wilt u de volgende gebruiker verwijderen?</h2>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Emailadres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php print($users["user_name"]); ?></td>
                                            <td><?php print($users["user_email"]); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--bevestiging van verwijdering-->
                        <form action="users_delete.php?id=<?php print($userid); ?>" method="post">
                            <input type="hidden" name="confirm" value="TRUE"> 
                            <input class="btn btn-danger" type="submit" value="Verwijderen">
                        </form>
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
            <?php } ?>
    </body>

</html>
