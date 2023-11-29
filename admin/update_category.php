
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
  

   $update_category = $conn->prepare("UPDATE `categories` SET name = ? WHERE id = ?");
   $update_category->execute([$name,  $pid]);

   $message[] = 'category updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `categories` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'image updated!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update category section starts  -->

<section class="update-category">

   <h1 class="heading">update category</h1>

   <?php
      $update_id = $_GET['update'];
      $show_categories = $conn->prepare("SELECT * FROM `categories` WHERE id = ?");
      $show_categories->execute([$update_id]);
      if($show_categories->rowCount() > 0){
         while($fetch_categories = $show_categories->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_categories['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_categories['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_categories['image']; ?>" alt="">
      <span>update name</span>
      <input type="text" required placeholder="enter category name" name="name" maxlength="100" class="box" value="<?= $fetch_categories['name']; ?>">
      
      <span>update image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="categories.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no categories added yet!</p>';
      }
   ?>

</section>

<!-- update category section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>