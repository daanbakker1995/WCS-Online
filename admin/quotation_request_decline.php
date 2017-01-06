<?php
/**
 * Created by PhpStorm.
 * User: Daan
 * Date: 13-12-2016
 * Time: 15:46
 */

if(isset($_GET['id'])){
    include "functions.php";
    if(decline_quotation_request($_GET['id'])){
        header('location: quotation_request_overview.php?delete=1');
    }
    else{
        header('location: quotation_request_overview.php?delete=0');
    }
}