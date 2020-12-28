<?php include('partials/menu.php');?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
      
    <br><br>
      
    <?php 
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }

      if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
    ?>


    <br><br>


    <!-- Add Category Form Starts-->
      <!-- enctype="multipart/form-data" ==>enable file upload-->
      <form action="" method='POST' enctype="multipart/form-data">
        <table>     
          <tr>
            <td>title:</td>
            <td>
              <input type="text" name='title' placeholder='category title'/>
            </td>
          </tr>
          <tr>
            <td>Select Image:</td>
            <td>
              <input type="file" name="image"/>
            </td>
          </tr>
          <tr>
            <td>featured:</td>
            <td>
                <input type="radio" name='featured' value='Yes'/>Yes
                <input type="radio" name='featured' value='No'/>No
            </td>
          </tr>
          <tr>
            <td>Active:</td>
            <td>
              <input type="radio" name='active' value='Yes'/>Yes
              <input type="radio" name='active' value='No'/>No
            </td>
          </tr>
          <tr>
            <td colspan ="2">
              <input type="submit" name="submit" value="Add Category" class="btn-primary">
            </td>
          </tr>
        </table>      
      </form>
      <!-- Add Category Form Ends-->

  <?php 
    if(isset($_POST['submit'])){
      //echo "clicked";

      //Get the value from Category form
      $title = $_POST['title'];

      //Get featured, radio
      if(isset($_POST['featured'])){

        //Get the value from form
        $featured = $_POST['featured'];
      }else{
        //Set the Default Value
        $featured = "No";
      }

      if(isset($_POST['active'])){
        $active = $_POST['active'];
      }else{
        $active = "No";
      };

      //Check whether the image is selected or not and set the value for image name accordingly
      
      //print out all the selected "name='image'" print_r == print array
      // print_r($_FILES['image']);
      
      // die();//Break the code here.
      if(isset($_FILES['image']['name'])){
        //upload the image
        $image_name = $_FILES['image']['name'];

        //Upload only if Image is selected
        if($image_name != ""){
          
          //Auto Rename our Image
          //this will explode the name according to . , and get the last factor.
          $ext =  end(explode('.',$image_name));

          //Rename the Image
          $image_name =" Food_Category_".rand(000,999).".".$ext;//Food_Category_400.jpg

          $source_path = $_FILES['image']['tmp_name'];
          
          $destination_path = "../images/category/".$image_name;

          //finally upload the image
          $upload = move_uploaded_file($source_path, $destination_path);

          //Check whether the image is uploaded or not
          //And if not uploaded, stop the process nd redirect with error message
          if($upload == false){

            $_SESSION['upload'] = "<div class = 'error'> Upload Error11</div>";
            header("location:".SITEURL."admin/add-category.php");
            die();
          } 
        }

      } else {
        //Don't uplaod image and set the image_value as blank
        $image_name= "";
      }

      $sql = "INSERT INTO tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
      ";

      $res = mysqli_query($conn, $sql);

      //check whether the queyr is executed or not
      if($res == true){
        $_SESSION['add'] ="<div class = 'success'>Added Successfully</div>";
        header("location:".SITEURL."admin/manage-category.php");
      } else{
        $_SESSION['add']="<div class = 'error'>Error adding category</div>";
        header("location:".SITEURL."admin/manage-category.php");
      } 
    }
  ?>
  </div>
</div>



<?php include('partials/footer.php')?>