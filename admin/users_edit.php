<?php
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

    </head>

    <body>

        <div id="wrapper">

            <!-- ADMIN MENU -->
            <?php
            $active = "gebruiker";
            include 'include/menu.php';
            include 'classes/Database.php';
                ?><div id="page-wrapper"><?php



            //check of gegevens opgestuurd
            if (isset($_POST["save"]) AND $_POST["save"] == TRUE)
            {

                //user type omzetten naar integer                        
                if ($_POST["role"] == "Admin")
                {
                    $typeint = 1;
                } else
                {
                    $typeint = 2;
                }

                if ($_POST["pwd"] != "")
                {
                    //check of nieuwe wachtwoord voldoet aan de eisen
                    //preg_match bron: http://stackoverflow.com/a/26904965
                    if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$_POST["pwd"]))
                    {
                        ?>
                        <div class="alert alert-danger">
                            <p>Het wachtwoord moet 8-20 tekens bevatten. Waarvan minimaal 1 kleine letter(a-z), 1 hoofdletter(A-Z), 1 cijfer(0-9) en 1 speciaal teken(@#-_$%^&+=§!?).</p>
                        </div>
                        <a href="users_edit.php?id=<?php print($_GET["id"]); ?>" class="btn btn-primary">Terug</a>
                        <?php
                    } else
                    {
                        //password hashen
                        $paswh = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                        //database updaten
                        $db = new Database();
                        $db->query('UPDATE user SET user_name=:user, user_email=:email, user_password=:pass, user_type=:type WHERE user_id=:id');
                        $db->bind(":user", $_POST["user"]);
                        $db->bind(":email", $_POST["email"]);
                        $db->bind(":pass", $paswh);
                        $db->bind(":type", $typeint);
                        $db->bind(":id", $_GET["id"]);
                        $db->execute();
                        ?>
                        <!--success bericht-->        
                        <h3 class="alert alert-success">De gebruiker is gewijzigd</h3>
                        <a href="users.php" class="btn btn-primary">Terug naar overzicht</a>
                        <?php
                    }
                } else
                {
                    //database updaten
                    $db = new Database();
                    $db->query('UPDATE user SET user_name=:user, user_email=:email, user_type=:type WHERE user_id=:id');
                    $db->bind(":user", $_POST["user"]);
                    $db->bind(":email", $_POST["email"]);
                    $db->bind(":type", $typeint);
                    $db->bind(":id", $_GET["id"]);
                    $db->execute();
                    ?>
                    <!--success bericht-->        
                    <h3 class="alert alert-success">De gebruiker is gewijzigd</h3>
                    <a href="users.php" class="btn btn-primary">Terug naar overzicht</a>
                    <?php
                }
            } else
            {
                //userinformatie ophalen

                $db = new Database();
                $db->query('SELECT user_name, user_email, user_type FROM user WHERE user_id=:id');
                $db->bind(":id", $_GET["id"]);
                $users = $db->single();

                //user integer omzetten naar type
                if ($users["user_type"] == 1)
                {
                    $usertype = "admin";
                } else
                {
                    $usertype = "Content Beheerder";
                }
                ?>

                    <div class="container-fluid">
                        <div id="page-wrapper">
                            <form action="users_edit.php?id=<?php print($_GET["id"]); ?>" method="post">
                                <div class="form-group">
                                    <label for="user">Gebruikersnaam</label>
                                    <input type="text" class="form-control" id="user" required name="user" value="<?php print($users["user_name"]); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" required name="email" value="<?php print($users["user_email"]); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Wachtwoord (Laat leeg om oude wachtwoord te behouden)</label>
                                    <input type="password" class="form-control" id="pwd" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="role">Rol</label>
                                    <select class="form-control" id="role" required name="role">
                                        <option <?php
                                        if ($users["user_type"] == 1)
                                        {
                                            print("selected");
                                        }
                                        ?>>Admin</option>
                                        <option <?php
                                        if ($users["user_type"] == 2)
                                        {
                                            print("selected");
                                        }
                                        ?>>Content Beheerder</option>                                 
                                    </select>
                                </div>
                                <input type="hidden" value="TRUE" name="save">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Wijzigen"/>
                                </div>
                            </form>
                        </div>
                        <!-- /.container-fluid -->
                    <?php } ?>
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
        </div>

    </body>

</html>
