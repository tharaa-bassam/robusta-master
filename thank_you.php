<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thank You for Ordering</title>
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/components.css">
     <!-- Favicon -->
  <link rel="icon" href="images/android-chrome-512x512.png" type="image/x-icon">

   <!-- Add your CSS styles here -->
   <style>
      .thank-container {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 60vh;
      }

      .thank {
         padding: 20px;
         background-color: #fff;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         max-width: 50rem;      }

     .thank h1 {
         color: #3498db;
         text-align: center;
         margin-bottom: 5px;
      }
      
     .thank p {
font-weight: bolder;  
font-size: 1.5rem; 

}

      .thank .checkmark {
         color: #4CAF50;
         font-size: 50px;
         margin-bottom: 20px;
         text-align: center;
      }
      
      .thank-btn {
         display: inline-block;
         padding: 10px 20px;
         background-color: #ff7800;
         color: #fff;
         text-decoration: none;
         border-radius: 5px;
         margin-top: 2rem;
         transition: background-color 0.3s ease;
         font-weight:bold ;
      }

      .thank-btn:hover {
         background-color: #777;
         letter-spacing: 1px;
      }
   </style>

   <!-- Add Font Awesome CDN link for the checkmark icon -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
<div class="thank-container">
      <div class="thank">
         <div class="checkmark">
            <i class="fas fa-check-circle"></i>
         </div>
         <h1>Thank You for Your Order!</h1>
         <p>Your order has been placed successfully. We appreciate your </p>
         <!-- You can add more details or links here if needed -->
      </div>
      
         <div> <a href="home.php" class="thank-btn">Back to home</a></div>
   </div>
  
   <!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
