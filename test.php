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
</head>
<body>


<?php include 'components/user_header.php'; ?>
<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / privacy</span></p>
</div>
<?php include 'components/footer.php'; ?>
</body>
</html>