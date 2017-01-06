<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
