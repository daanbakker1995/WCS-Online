<?php
include "check_login.php"; // if user is logged in.

if(isset($_GET['id'])){ // if the id of the page is set.
    include "functions.php";
    if(delete_info_page($_GET['id'])){ // delete the page
        header('location: pages_overview.php?delete=1'); // redirect user to the overview page with delete 1(success).
    }
    else{
        header('location: pages_overview.php?delete=0'); // redirect user to the overview page with delete 0(not successful).
    }
}
