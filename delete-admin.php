<?php 

    include("../config/constants.php");

    //1.get the ID of Admin to be deleted
    $id = $_GET['id'];    
    
    //2. create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query 
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not.
    if($res == true){
        // echo 'Admin Deleted Successfully.';
        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else { 
        // echo 'Failed to Delete Admin.';
        $_SESSION['delete'] = "<div class='error'>Deletion failed.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    };
    //3. Redirect to Manage Admin page with message(success)
    
?>