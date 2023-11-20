<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/' . $image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'product name already exists!';
   } else {
      if ($image_size > 2000000) {
         $message[] = 'image size is too large';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'new product added!';
      }
   }
}

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/' . $fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

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

   <?php
   //  include '../components/admin_header.php' ?>
   <?php include '../components/admin_slider.php'; ?>

   <!-- add products section starts  -->

   <section class="add-products">

      <form action="" method="POST" enctype="multipart/form-data">
         <h3>add product</h3>
         <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
         <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
         <select name="category" class="box" required>
            <option value="" disabled selected>select category --</option>
            <option value="Drinks">Drinks</option>
            <option value="Dessert">Desserts</option>
            <option value="Machine">Machine</option>
            <option value="Beans">Beans</option>
         </select>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         <input type="submit" value="add product" name="add_product" class="btn">
      </form>

   </section>

   <!-- add products section ends -->

   <!-- show products section starts  -->

   <section class="show-products" style="padding-top: 0;">

      <div class="box-container">
         <table class="admin-table">
            <tr>
               <th>Image</th>
               <th>Name</th>
               <th>Category</th>
               <th>Price</th>
               <th>Actions</th>
            </tr>
            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
               while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>';
                  echo '<td><img src="../uploaded_img/' . $fetch_products['image'] . '" alt="' . $fetch_products['name'] . '"></td>';
                  echo '<td>' . $fetch_products['name'] . '</td>';
                  echo '<td>' . $fetch_products['category'] . '</td>';
                  echo '<td>$' . $fetch_products['price'] . '/-</td>';
                  echo '<td>';
                  echo '<a href="update_product.php?update=' . $fetch_products['id'] . '" class="option-btn">Update</a>';
                  echo '<a href="products.php?delete=' . $fetch_products['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this product?\');">Delete</a>';
                  echo '</td>';
                  echo '</tr>';
               }
            } else {
               echo '<tr><td colspan="5" class="empty">No products added yet!</td></tr>';
            }
            ?>
         </table>
      </div>

   </section>


   <!-- show products section ends -->










   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>