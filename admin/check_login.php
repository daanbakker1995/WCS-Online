<?php
session_start();
if($_SESSION["ingelogd"] == true){
}
 else {
       header('location: ./login.php');       
}
?>
