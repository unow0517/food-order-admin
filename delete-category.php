<?php 
  include("../config/constants.php");

  if(isset($_GET['id']) AND isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    if($image_name != ""){
      //remove image!
      $path="../images/category/".$image_name;

      $remove = unlink($path);

      if($remove == false){
        $_SESSION['remove'] = "<div class='error'>Failed to delete Image</div>";
        header("location:".SITEURL."admin/manage-category.php");
        die();
      }
    }

    $sql = "DELETE FROM tbl_category WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    if($res){
      $_SESSION['delete'] = "<div class='success'>Category removed</div>";
      header("location:".SITEURL."admin/manage-category.php");
    } else {
      $_SESSION['delete'] = "<div class='error'>Error deleting the category</div>";
      header("location:".SITEURL."admin/manage-category.php");
    }
  }    

?>