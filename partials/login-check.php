<?php

    //Autorization - Access Control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])){ //if user session is not set
        //User is not logged in

        $_SESSION['no-login-message'] = "<div class='error text-center'>Please log in to access to admin</div>";
        
        //Redirect to log in page with message
        header("location:".SITEURL."admin/login.php");
        
    }


?>