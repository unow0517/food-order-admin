<?php include('./partials/menu.php');?>

<div class="main-contents">

    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
    ?>

    <form action = "" method= "POST">
        <table>
            <tr>
                <td>Current Password:</td>
                <td>
                <input required type='password' name='current_password' placeholder='Your password'> 
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>
                <input required type='password' name='new_password' placeholder='Your password'> 
                </td>
            </tr>

            <tr>
                <td>Confirm New Password:</td>
                <td>
                <input required type='password' name='confirm_password' placeholder='Your password'> 
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="hidden" name='id' value= '<?php echo $id?>'>
                <input type='submit' name='submit' placeholder='Change Password' class= 'btn-secondary'> 
                </td>
            </tr>
        </table>
    </form>
    <?php
            if(isset($_SESSION['user-not-found'])){ 
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['not-change-pwd'])){ 
                echo $_SESSION['not-change-pwd'];
                unset($_SESSION['not-change-pwd']);
            }
        ?>

    <?php 

        if(isset($_POST['submit'])){
            
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'" ;

            $res = mysqli_query($conn, $sql);
            
            if($res==true){

                $count = mysqli_num_rows($res);

                if($count == 1){

                    if($new_password ==$confirm_password){
                        $sql2 = "UPDATE tbl_admin 
                                SET password = '$new_password' 
                                WHERE id = $id
                        ";

                        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

                        if($res2 == true){
                            //Display Success Message
                            $_SESSION['change-pwd'] = "<div class='success'> Password changed </div>";
                            header("location:".SITEURL."admin/manage-admin.php");
                        } else {
                            //Display Error Message
                            $_SESSION['not-change-pwd'] = "<div class='error'> Failed to change password </div>";
                            header("location:".SITEURL."admin/manage-admin.php");
                        }

                    }else{
                        $_SESSION['pw-not-match']="<div class='error'> Confirm password right. </div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }   

                } else {

                    $_SESSION['user-not-found']= "<div class='error'> Wrong password! </div>";
                    header("location:".SITEURL."admin/manage-admin.php");

                };
            } else {
                $_SESSION['user-not-found'] = "<div class='error'> Wrong Password </div>";
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }
    ?>

</div>



<?php include('./partials/footer.php');?>