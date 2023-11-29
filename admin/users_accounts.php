<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_order->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users Accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      /* table {
         width: 100%;
         max-width: 1200px;
         
         border-collapse: collapse;
         margin-top: 2rem;

      }

      th,
      td {
         border: 0.1rem solid black;
         padding: 4rem;
         text-align: center;
      }

      th {
         background-color: #C0D6E4;
         color: var(--white);
         font-size: 1.5rem;
         letter-spacing: 1px;
         color: var(--black);
      }

      td {
         background-color: var(--light-bg);
         color: var(--black);
         font-size: 1.5rem;
      }

      tr:nth-child(even) {
         background-color: var(--white);
      }

      tr:nth-child(odd) {
         background-color: var(--light-bg);
      } */
      table {
    width: 70rem;
    max-width: 1200px;
    border-collapse: collapse;
    margin-top: 2rem;
}

th,
td {
    border: 1px solid #ddd;
    padding: 1rem;
    text-align: center;
}

th {
    background-color: #19415B;
    color: #fff;
    font-size: 2rem;
}

td {
    background-color: #ecf0f1;
    font-size: 2rem;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #d4e6f1;
}

.delete-btn,
.option-btn {
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

.delete-btn {
    background-color: #e74c3c;
}

.option-btn {
    background-color: #2ecc71;
}

.delete-btn:hover,
.option-btn:hover {
    background-color: #c0392b;
}

/* Responsive styling for small screens */
@media (max-width: 600px) {
    th,
    td {
        padding: 0.5rem;
        font-size: 1rem;
    }
}
   </style>
</head>

<body>

<?php include '../components/admin_slider.php'; ?>
<?php include '../components/admin_header.php' ?>
   <!-- User accounts section starts  -->

   <section class="accounts">

      <h1 class="heading">User Accounts</h1>

      <div class="box-container">
         <table class="admin-table">
            <tr>
               <th>User ID</th>
               <th>Username</th>
               <th>Actions</th>
            </tr>
            <?php
            $select_account = $conn->prepare("SELECT * FROM `users`");
            $select_account->execute();
            if ($select_account->rowCount() > 0) {
               while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>';
                  echo '<td>' . $fetch_accounts['id'] . '</td>';
                  echo '<td>' . $fetch_accounts['name'] . '</td>';
                  echo '<td>';
                  echo '<a href="users_accounts.php?delete=' . $fetch_accounts['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this account?\');">Delete</a>';
                 
                  echo '</td>';
                  echo '</tr>';
               }
            } else {
               echo '<tr><td colspan="3" class="empty">No accounts available</td></tr>';
            }
            ?>
         </table>
      </div>

   </section>

   <!-- Rest of your code... -->
 <!-- custom js file link  -->
 <script src="../js/admin_script.js"></script>
</body>

</html>