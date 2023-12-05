<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admins accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
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
.btn-success {
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

.btn-success {
    background-color: #2ecc71;
}

.delete-btn:hover,
.btn-success:hover {
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

   <!-- admins accounts section starts  -->

   <section class="accounts">

      <h1 class="heading">admins account</h1>

      <div class="box-container">



         <?php
         $select_account = $conn->prepare("SELECT * FROM `admin`");
         $select_account->execute();
         if ($select_account->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>Admin ID</th><th>Username</th><th>Actions</th></tr>';
            while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
               echo '<tr>';
               echo '<td>' . $fetch_accounts['id'] . '</td>';
               echo '<td>' . $fetch_accounts['name'] . '</td>';
               echo '<td>';
               echo '<a href="admin_accounts.php?delete=' . $fetch_accounts['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this account?\');">Delete</a>';

               // Check if the current admin is the one being displayed
               if ($fetch_accounts['id'] == $admin_id) {
                  echo '<a href="update_profile.php" class="btn btn-success">Update</a>';
               }

               echo '</td>';
               echo '</tr>';
            }
            echo '</table>';
         } else {
            echo '<p class="empty">No accounts available</p>';
         }
         ?>

            <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>