<?php
/**
 * Created by PhpStorm.
 * User: Daan
 * Date: 13-12-2016
 * Time: 15:46
 */
$admin_rights = true; // Page is only for admins.
include "check_login.php";

if(isset($_GET['id'])){
    include "functions.php";
    if(accept_quotation_request($_GET['id'])){
        header('location: quotation_request_overview.php?accept=1');
    }
    else{
        header('location: quotation_request_overview.php?accept=0');
    }
}
