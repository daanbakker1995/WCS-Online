<?php
if($_SESSION["ingelogd"] == true){
    if(isset($admin_rights) && $_SESSION['user_type'] > 1){ // check if var admin_rights is set and user_type is smaller than 2(Content Beheerder).
        header('location: ./index.php');
    }
    else{

    }
}
 else {
       header('location: ./login.php');       
}
