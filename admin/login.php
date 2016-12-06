<?php
if (isset($_POST["signin"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

// to prevent mysql injection
    $email = stripcslashes($email);
    $password = stripcslashes($password);
    $email = mysql_real_escape_string($email);
    $password = mysql_real_escape_string($password);
// connect to the server and select database
    mysql_connect("localhost", "root", "");
    mysql_select_db("wcs-online");

    $query = mysql_query("SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password'")
            or die("failed to query database " . mysql_error());
    $row = mysql_fetch_array($query);
    if ($row['user_email'] == $email && $row['user_password'] == $password) {
        session_start();
        $_SESSION["ingelogd"] = true;
        $_SESSION["email"] = $email;
        header('location: ./index.php');
    } else {
        print ("Emailadres/wachtwoord onjuist.<br>");
        print ("Probeer opnieuw");
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
        <title></title>
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
                    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name = signin>Sign in</button>
                </form><!-- /form -->

            </div>
        </div>
    </body>
</html>
