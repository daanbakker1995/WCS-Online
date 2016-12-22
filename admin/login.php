<?php
include './classes/Database.php';
$db = new Database();

session_start();
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}

if (isset($_POST["signin"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $db->query("SELECT * FROM user WHERE user_email=:email");
    $db->bind(':email', $email);
    $row = $db->single();

    if ($row['user_email'] == $email) {

        if ($row['user_active'] == 0) {
            echo "Uw account is geblokkeerd.";
        } else {
            if ($_SESSION['count'] > 2) {
                $db->query("UPDATE user SET user_active = 0 WHERE user_email =:email");
                $db->bind(':email', $email);
                $db->execute();
                echo "U heeft te vaak geprobeerd in te loggen,uw account wordt geblokkeerd. ";
                $_SESSION['count'] = 0;
            } else {
                if (password_verify($password, $row['user_password'])) {
                    $_SESSION["ingelogd"] = true;
                    $_SESSION["email"] = $email;
                    header('location: ./index.php');
                } else {
                    ++$_SESSION['count'];
                    echo "Verkeerde gegevens ingevoerd.";
                }
            }
        }
    } else {
        echo "Verkeerde gegevens ingevoerd.";
    }
}
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wcs adminlogin</title>
        <link href="login.css" rel="stylesheet" type="text/css"/>
        <link href="../loginpagina/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../loginpagina/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <div class="container">
            <div class="card card-container">
                <img class="img-responsive"  src="../images/logo.png" alt=""/>
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin" method="POST" >
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="hidden" name="counter" value="<?php echo $_SESSION['count']; ?>" />
                    <input type="text" id="inputEmail" class="form-control" name="email" placeholder="Username" required autofocus>
                    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name = signin>Sign in</button>
                </form><!-- /form -->

            </div>
        </div>
<?php ?>
    </body>
</html>
