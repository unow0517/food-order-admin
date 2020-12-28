<?php include('partials/menu.php');?>

        <!--Main Content Section Starts -->
        <div class="main-content">
            <div class='wrapper'>
                <h1>Manage Admin</h1>
                
                <br/><br/>

                <?php
                    if(isset($_SESSION['add'])){

                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //Removing Session Message
                    };

                    if(isset($_SESSION['delete'])){

                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    };

                    if(isset($_SESSION['update'])){
                        
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found'])){
                        
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pw-not-match'])){
                        
                        echo $_SESSION['pw-not-match'];
                        unset($_SESSION['pw-not-match']);
                    }

                    if(isset($_SESSION['change-pwd'])){
                        
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>

                <br/><br/>

                <!--Button to add Admin-->
                <a href="add-admin.php" class='btn-primary'>Add Admin</a>

                <br/><br/><br/>

                <table class='tbl-full'>
                    <tr>
                        <th>S.N</th>
                        <th>FullName</th>
                        <th>UserName</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // Query to get all Admin 
                        $sql = "SELECT * FROM tbl_admin";

                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is executed or not
                        if($res == TRUE){
                            
                            //Count Rows to Check whether we have data in database or not
                            $rows = mysqli_num_rows($res);

                            $sn = 1 ; //Create a Variable and Assign the value

                            //Check the num of rows
                            if($rows>0){
                                //We have data in database
                                while($rows=mysqli_fetch_assoc($res)){
                                    //get all the rows in $rows

                                    $id = $rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class='btn-primary'>Update Password</a> 
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class='btn-secondary'>Update Admin</a> 
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class='btn-danger'>Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }else{
                                //We don't have data in database
                            }
                        }
                    ?>
                </table>
            </div>
            
        </div>
        <!--Main Content Section Ends -->

<?php include('partials/footer.php') ?>