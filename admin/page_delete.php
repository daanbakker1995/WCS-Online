<?php
if(isset($_GET['id'])){
    include "functions.php";
    if(delete_info_page($_GET['id'])){
        echo "Succesvol verwijderd.";
    }
    else{
        echo "Er is iets mis gegaan. probeer later opnieuw.";
    }
}