<?php

if($_SESSION["ingelogd"] == true){
}
 else {
       header('location: ./login.php');       
}
?>
