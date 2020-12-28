<?php include('./partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        
        <br><br>
        
        <?php 

            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res == true){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $password = $row['password'];
                }
            }
        ?>
        <form action="" method="POST">
            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type='text' value=<?php echo $full_name;?> name='full_name' placeholder='Enter Your name'> </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type='text' value= <?php echo $username;?> name='username' placeholder='Your username'> </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <input type="hidden" name='id' value="<?php echo $id?>">
                        <input type='submit' name='submit' value='Update Admin' class='btn-secondary'> </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        
        $sql = "UPDATE tbl_admin 
                SET full_name = '$full_name',
                    username = '$username'
                WHERE id=$id";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res == true){
            $_SESSION['update'] = "<div class='success'>'Updated successfully'</div>";
            header("location:".SITEURL."/admin/manage-admin.php");
        } else {
            $_SESSION['update'] = "<div class='error'>'Updated failed'</div>";
            header("location:".SITEURL."/admin/manage-admin.php");
        }
    } 
?>

<?php include('./partials/footer.php');?>