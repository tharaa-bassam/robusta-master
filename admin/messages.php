<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <!-- custom message table styles -->
   <link rel="stylesheet" href="../css/message_table_style.css">

</head>
<style>
   /* Custom styles for the messages table */
   .message-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2rem;
      margin-left: 12rem;
   }

   .message-table th,
   .message-table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
   }

   .message-table th {
      background-color: #f2f2f2;
      font-weight: bold;
   }

   .message-table tr:nth-child(even) {
      background-color: #f2f2f2;
   }

   .message-table tr:hover {
      background-color: #ddd;
   }

   .empty-cell {
      text-align: center;
      padding: 20px;
      font-style: italic;
      color: #999;
   }

   /* Adjustments for responsiveness */
   @media screen and (max-width: 600px) {
      .message-table {
         font-size: 14px;
      }

      .message-table th,
      .message-table td {
         padding: 8px;
      }
   }
</style>

<body>

<?php include '../components/admin_slider.php'; ?>

   <!-- messages section starts  -->

   <section class="messages">

      <h1 class="heading">messages</h1>

      <div class="table-container">

         <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         if ($select_messages->rowCount() > 0) {
            echo '<table class="message-table">';
            echo '<tr><th>Name</th><th>Number</th><th>Email</th><th>Message</th><th>Action</th></tr>';
            while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
               echo '<tr>';
               echo '<td>' . $fetch_messages['name'] . '</td>';
               echo '<td>' . $fetch_messages['number'] . '</td>';
               echo '<td>' . $fetch_messages['email'] . '</td>';
               echo '<td>' . $fetch_messages['message'] . '</td>';
               echo '<td><a href="messages.php?delete=' . $fetch_messages['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this message?\');">Delete</a></td>';
               echo '</tr>';
            }
            echo '</table>';
         } else {
            echo '<p class="empty-cell">You have no messages</p>';
         }
         ?>

      </div>

   </section>

   <!-- messages section ends -->

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>