<?php
/**
 * Set qoutation status to 1(achrive).
 */

if(isset($_GET['id'])){
    include "functions.php";
    if(acrhive_quotation($_GET['id'])){
        header('location: quotation_overview.php?archive=1');
    }
    else{
        header('location: quotation_overview.php?archive=0');
    }
}