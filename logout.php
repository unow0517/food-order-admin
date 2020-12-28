<?php 
    include('../config/constants.php');
    
    //Delete all the session
    session_destroy(); //unset $_SESSION['user']

    //Redirect
    header('location:'.SITEURL.'/admin/login.php');
?>