<?php include('partials/menu.php');?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>
    <?php 
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM tbl_category WHERE id = $id";
        
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
          $row = mysqli_fetch_assoc($res);
          $title = $row['title'];
          $current_image = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];
        }
      }else{
        $_SESSION['no-category-found'] = "<div class='error'> Category not Found</div>";
        header("location:".SITEURL."/manage-category.php");
      }
      $image_name = $_GET['image_name'];
      
  
        
    ?>
    <br><br>

    <form action="" method='POST' enctype="multipart/form-data">
        <table class ='tbl-30'>     
          <tr>
            <td>title:</td>
            <td>
              <input type="text" name='title' placeholder='category title'
              value=<?php echo $title; ?>>
            </td>
          </tr>
          <tr>
            <td>Current Image:</td>
            <td>
              <?php
                if(isset($current_image)){
                  ?>
                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width=100px>
              <?php  
                } else {
                  echo "Image not found";
                }
              ?>
            
            </td>
          </tr>
          <tr>
            <td>Select New Image:</td>
            <td>
              <input type="file" name="image">
            </td>
          </tr>
          <tr>
            <td>featured:</td>
            <td>
                <input <?php if($featured == "Yes"){echo "checked";}?>
                  type="radio" name='featured' value='Yes'/>Yes
                <input <?php if($featured == "No"){echo "checked";}?>
                  type="radio" name='featured' value='No'/>No
            </td>
          </tr>
          <tr>
            <td>Active:</td>
            <td>
              <input <?php if($active == "Yes"){echo "checked";}?>
                type="radio" name='active' value='Yes'/>Yes
              <input <?php if($active == "No"){echo "checked";}?>
                type="radio" name='active' value='No'/>No
            </td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="current_image" value="<?php echo $current_image;?>" class="btn-primary">
              <input type='hidden' name='id' value ="<?php echo $id; ?>"/>
              <input type="submit" name="submit" value="Change Category" class="btn-primary">
            </td>
          </tr>
        </table>      
      </form>

      <?php 
        //If data is submitted
        if(isset($_POST['submit'])){
          $id = $_POST['id'];
          $title = $_POST['title'];
          $current_image = $_POST['current_image'];
          $featured = $_POST['featured'];
          $active = $_POST['active'];

          //If image file is submitted
          if(isset($_FILES['image']['name'])){

            $image_name = $_FILES['image']['name'];

            //Change name and upload in local folder
            if($image_name != ""){
              $ext = end(explode(".", $image_name));
              
              $image_name = "Food_Category_".rand(000,999).".".$ext;

              $source_path = $_FILES['image']['tmp_name'];

              $destination_path = "./images/category/".$image_name;

              $upload = move_uploaded_file($source_path, $destination_path);

              if($upload == false){
                $_SESSION['upload'] = "<div class='error'>Error uploading new picture</div>";
                header("location:".SITEURL."manage-category.php");
                die();
              }

              //Remove the Current Image
              $remove_path = "./images/category/".$current_image;
              $remove = unlink($remove_path);

              if($remove==false){

                $_SESSION['failed-remove'] = "<div class='error'>Error removing current image</div>";
                header("location:".SITEURL."manage-category.php");
                die();
              };
            }
          
          //WHen image file is not submitted
          } else {
              $image_name = $current_image;
          }
        
          //update dabase 
          $sql2 = "UPDATE tbl_category SET
          image_name = '$image_name',
          title = '$title',
          featured = '$featured',
          active = '$active'
          WHERE id = $id";

          $res2 = mysqli_query($conn, $sql2);
          
          if($res2 == true){
            $_SESSION['update'] = "<div class='success'> Updated done </div>";
            header("location:".SITEURL."manage-category.php");
          }else{
            $_SESSION['update'] = "<div class='error'> Updated Error </div>";
            header("location:".SITEURL."manage-category.php");
          }
          
        //If data is not submitted  
        } else {
          echo "Data is not submitted";
        }

      ?>
  </div>
</div>

<?php include('partials/footer.php')?>