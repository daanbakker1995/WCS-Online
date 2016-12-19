<?php
if(isset($_GET['id'])){
    include "functions.php";
    if(delete_product($_GET['id'])){
        header('location: product_overview.php?delete=1');
    }
    else{
        header('location: product_overview.php?delete=0');
    }
}