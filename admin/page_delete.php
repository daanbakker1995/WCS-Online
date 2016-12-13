<?php
if(isset($_GET['id'])){
    include "functions.php";
    if(delete_info_page($_GET['id'])){
        header('location: pages_overview.php?delete=1');
    }
    else{
        header('location: pages_overview.php?delete=0');
    }
}