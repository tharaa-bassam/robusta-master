<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>privacy</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      

        .privacy-policy,
        .return-policy,
        .delivery-time {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 2rem;
            border-radius: 8px;
            font-size: 1.7rem;
        }

        h2 {
            color: #333;
        }
    </style>
</head>
<body>


<!-- <?php include 'components/user_header.php'; ?> -->
<div class="heading">
   <h3>Privacy Policy</h3>
   <p><a href="home.php">home</a> <span> / privacy</span></p>
</div>

<div class="privacy-policy">
        <h2>Privacy Policy:</h2>
        <p>We are committed to protecting your privacy, and our team deals with this information for the purposes of follow-up and completing the purchase process correctly. This information is used only for commercial purposes. We inform you that we will not share this information. We also review our systems and data to ensure the best services. Robusta Food Industries (Robusta Coffee) also guarantees to deal with all information related to its customers with complete confidentiality.</p>
    </div>

    <div class="return-policy">
        <h2>Return Policy:</h2>
        <p>We at Bun Maarouf offer the best and finest types of coffee and cardamom. In the case of any complaint regarding either product or service, a full or partial refund will be issued to the customer.</p>
    </div>

    <div class="delivery-time">
        <h2>Delivery Time:</h2>
        <p>Local orders within 24 hours from the time of ordering.</p>
    </div>
 <?php include 'components/footer.php'; ?> 
</body>
</html>