<?php
$admin_rights = true; // Page is only for admins.
/* 
 * jan kaptijn s1106061
 */
include "check_login.php";
if(isset($_GET['id'])){
    include "functions.php";
    if(quotation_to_invoice($_GET['id'])){
        header('location: quotation_overview.php?accept=1');
    }
    else{
        
        header('location: quotation_overview.php?accept=0');
    }
}
