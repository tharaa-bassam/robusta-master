<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['update_payment'])) {

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>
   <style>
      .table-container {
         margin-left: 13rem;
      }

      .gray-table {
         border-collapse: collapse;
         width: 100%;
         margin-top: 20px;
         background-color: #f4f4f4;
         /* Gray background color */
      }

      .gray-table th,
      .gray-table td {
         border: 1px solid #ddd;
         /* Gray border */
         padding: 8px;
         text-align: left;
      }

      .gray-table th {
         background-color: #19415B;
         /* Dark gray header background */
         color: white;
      }
      .drop-down {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
   }

   </style>
   <?php include '../components/admin_slider.php'; ?>

   <!-- placed orders section starts  -->


   <section class="placed-orders">
      <h1 class="heading">Placed Orders</h1>

      <div class="table-container">
         <table class="order-table gray-table">
            <thead>
               <tr>
                  <th>User ID</th>
                  <th>Placed On</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Number</th>
                  <th>Address</th>
                  <th>Total Products</th>
                  <th>Total Price</th>
                  <th>Payment Method</th>
                  <th>Payment Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders`");
               $select_orders->execute();
               if ($select_orders->rowCount() > 0) {
                  while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
               ?>
                     <tr>
                        <td><?= $fetch_orders['user_id']; ?></td>
                        <td><?= $fetch_orders['placed_on']; ?></td>
                        <td><?= $fetch_orders['name']; ?></td>
                        <td><?= $fetch_orders['email']; ?></td>
                        <td><?= $fetch_orders['number']; ?></td>
                        <td><?= $fetch_orders['address']; ?></td>
                        <td><?= $fetch_orders['total_products']; ?></td>
                        <td><?= $fetch_orders['total_price']; ?>JD</td>
                        <td><?= $fetch_orders['method']; ?></td>
                        <td>
                           <form action="" method="POST">
                              <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                              <select name="payment_status" class="drop-down">
                                 <option value="pending" <?= $fetch_orders['payment_status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                 <option value="completed" <?= $fetch_orders['payment_status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                              </select>
                              <input type="submit" value="Update" class="btn" name="update_payment">
                           </form>
                        </td>
                        <td>
                           <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                        </td>
                     </tr>
               <?php
                  }
               } else {
                  echo '<tr><td colspan="11" class="empty">No orders placed yet!</td></tr>';
               }
               ?>
            </tbody>
         </table>
      </div>
   </section>

   <!-- placed orders section ends -->









   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>