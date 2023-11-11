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
         width: 100%;
         max-width: 1200px;
         /* Set a maximum width for the table */
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
      }
   </style>
</head>

<body>

   <?php include '../components/admin_header.php' ?>
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