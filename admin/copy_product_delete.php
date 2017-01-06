<?php
if(isset($_GET['id'])){
    include "functions.php";
    include "check_login.php";
    
    if(delete_product($_GET['id'])){
        header('location: drukservice_overview.php?delete=1');
    }
    else{
        header('location: drukservice_overview.php?delete=0');
    }
}
