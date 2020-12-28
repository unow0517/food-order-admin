<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/><br/>

        <?php
                    if(isset($_SESSION['add'])){

                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //Removing Session Message
                    }
                ?>

        <form action="" method="POST">
            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type='text' name='full_name' placeholder='Enter Your name'> </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type='text' name='username' placeholder='Your username'> </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type='password' name='password' placeholder='Your padssword'> </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type='submit' name='submit' value='Add Admin' class='btn-secondary'> </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    //process the value from Form and Save iti in Databse
    //Check wheter the submit button is clicked or not

    if(isset($_POST['submit'])){

        //get data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //Execute Query and Save Data in Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res == TRUE){
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "Admin Added Successfully";
            //Redirect Page to manage Admin
            // header('location:'.SITEURL."admin/manage-admin.php");
            header("location:manage-admin.php");
        } else {
            $_SESSION['add'] = "Failed to Add Admin";
            // header('location:'.SITEURL."admin/add-admin.php");
            header("location:add-admin.php");
        }
    }
?>

<?php include('partials/footer.php')?>
