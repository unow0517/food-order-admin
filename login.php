<?php include('../config/constants.php')?>;
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href= "../css/admin.css"/>
    </head>
    <body>
        <div class="login">
        <br>
            <h1 class='text-center'>Login</h1>
            
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){

                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                
            ?>

            <br><br>

            <!-- login starts here-->
            <form action="" class ='text-center' method="POST">
            Username:<br>
            <input required type="text" name='username' placeholder='Enter username'/><br><br>
            Password:<br>
            <input required type="password" name='password' placeholder='Enter password'/><br><br>
            <input type="submit" name='submit' value ='Log In' class='btn-primary'>
            </form>
            <br>
            <!-- login ends here-->
            <p class='text-center'>Createad By - <a href="http://yoonho.ml" target='_blank'>YunHo</a></p>
            <br>
        </div>
    </body>
</html>

<?php 
    //check whether the Submit Button is Clicked or not
    if(isset($_POST['submit'])){
        //Process Log In
        //1. Get the Data from Login Form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user exists
        $sql= "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //3. Execute sql query
        $res = mysqli_query($conn, $sql);
        
        $count = mysqli_num_rows($res);

        if($count == 1){
            
            $_SESSION['login'] = "<div class='success'> Hello $username</div>";
            $_SESSION['user'] = $username;

            header("location:".SITEURL."admin/");
        }else{
            $_SESSION['login'] = "<div class='error text-center'> LogIn Failed</div>";
            // header("location:".SITEURL."admin/");
        }
    }
?>