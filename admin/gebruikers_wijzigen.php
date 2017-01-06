<?php
session_start();
if ($_SESSION["ingelogd"] == true) {
    
} else {
    header('location: ./login.php');
}

if (isset($_POST["submit"])) {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    if ($_POST['email'] == "" || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Vul aub een geldig email adres in.';
    }
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

            <?php
            $active = "profile";
            include 'include/menu.php';
            ?>

            <div id="page-wrapper">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Gebruiker <small>Gegevens</small>
                            </h1>
                        </div>
                    </div>

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> er is iets fout gegaan met het wijzigen van uw gegevens
                            <ul>
                                <?php
                                foreach ($errors as $error) {
                                    echo "<li>" . $error . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-6">
                            <form action="gebruikers_wijzigen.php" method="post">
                                <div class="form-group">
                                    <label for="user">Gebruikersnaam</label>
                                    <input type="text" class="form-control" id="user">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Wachtwoord</label>
                                    <input type="password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <input type="reset" class="btn btn-default" id="reset" value="Annuleren"/>
                                    <input type="submit" class="btn btn-primary" id="submit" value="Wijzigen"/>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
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
