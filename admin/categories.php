<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_category'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE name = ?");
   $select_categories->execute([$name]);

   if($select_categories->rowCount() > 0){
      $message[] = 'category name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_category = $conn->prepare("INSERT INTO `categories`(name,  image) VALUES(?,?)");
         $insert_category->execute([$name, $image]);

         //$message[] = 'new category added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_category_image = $conn->prepare("SELECT * FROM `categories` WHERE id = ?");
   $delete_category_image->execute([$delete_id]);
   $fetch_delete_image = $delete_category_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_category = $conn->prepare("DELETE FROM `categories` WHERE id = ?");
   $delete_category->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:categories.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>categories</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
     .admin-table {
            width: 70rem;
            border-collapse: collapse;
            margin-top: 20px;
         }

         .admin-table th, .admin-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: #ecf0f1;
         }

         .admin-table th {
            background-color: #19415B;
            color: #fff;
         }

         .admin-table img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 5px;
         }

         .option-btn, .delete-btn {
            display: inline-block;
    width:50%;
    padding: 1px 5px;
    margin: 0.2rem;
    text-decoration: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
         }

         .option-btn:hover, .delete-btn:hover {
            background-color: #c0392b;
         }

         .empty {
            text-align: center;
            padding: 10px;
            color: #888;
         }
       
   </style>
</head>
<body>
<?php include '../components/admin_slider.php'; ?>


<!-- add categories section starts  -->

<section class="add-categories">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add category</h3>
      <input type="text" required placeholder="enter category name" name="name" maxlength="100" class="box">
  
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add category" name="add_category" class="btn">
   </form>

</section>

<!-- add categories section ends -->

<!-- show categories section starts  -->

<section class="show-categories" style="padding-top: 0;">

   <div class="box-container">
   <table class="admin-table">
            <tr>
             
              
               <th>Image</th>
               <th>Name</th>
               <th>Actions</th>
              
            </tr>
   <?php
      $show_categories = $conn->prepare("SELECT * FROM `categories`");
      $show_categories->execute();
      if($show_categories->rowCount() > 0){
         while($fetch_categories = $show_categories->fetch(PDO::FETCH_ASSOC)){  
            echo '<tr>';
            echo '<td><img src="../uploaded_img/' .$fetch_categories['image'] . '" alt="' .$fetch_categories['name'] . '"></td>';
            echo '<td>' .$fetch_categories['name'] . '</td>';
            echo '<td>';
            echo '<a href="update_category.php?update=' . $fetch_categories['id'] . '" class="option-btn">Update</a>';
            echo '<a href="categories.php?delete=' .  $fetch_categories['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this category?\');">Delete</a>';
            echo '</td>';
            echo '</tr>';


   
         }
      }else{
         echo '<p class="empty">no categories added yet!</p>';
      }
 ?>

   </div>
    </table>

</section>

<!-- show categorys section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>