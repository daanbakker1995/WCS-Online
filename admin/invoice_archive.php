<?php
$admin_rights = true; // Page is only for admins.
include "check_login.php";
/**
 * Set qoutation status to 1(achrive).
 */
if(isset($_GET['id'])){
    include "functions.php";
    if(archive_invoice($_GET['id'])){
        header('location: invoice_overview.php?archive=1');
        
    }
    else{
        header('location: invoice_overview.php?archive=0');
    }
}
