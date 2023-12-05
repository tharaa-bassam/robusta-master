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
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://kit.fontawesome.com/6487c144b2.js" crossorigin="anonymous"></script>
      <!-- Google Web Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Itim&family=Kalam:wght@400;700&family=Merriweather:wght@300;700&family=Poppins:wght@200;300&family=Quicksand&family=Raleway:wght@300;400&family=Shadows+Into+Light&family=Yellowtail&display=swap" rel="stylesheet">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css">
   <link rel="stylesheet" href="css/components.css">
     <!-- Favicon -->
     <link rel="icon" href="images/android-chrome-512x512.png" type="image/x-icon">


</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-3.png" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Robusta  was established  as a specialized cafe in the production and supply of premium coffee types chosen from the best coffees in the world. We believe that great coffee starts with the highest quality of green beans planted in the most famous farms of the world and given countless amounts of labor and love to ensure receiving an excellent product.

</p>
      </div>

   </div>


<br> <br> <br> <br> <br> <br> <br> 

   <div class="row">



<div class="content">
   <h3>Our Story</h3>
   <p>
   The aromas of coffee have captivated our senses and stolen our hearts for years. We’ve always been thinking that there is much more going on inside your daily cup of coffee than what meets the eye; we always found the journey of a coffee bean traveling from a farm to your mug inspiring; a journey that never ends and never grows old.
   </p>
</div>
<div class="image">
   <img src="images/about2.png" alt="">
</div>
</div>

</section>

<!-- about section ends -->




    <!-- steps section starts -->

    <section class="steps">

        <h1 class="title">how it works</h1>

        <div class="box-container">

        <div class="box">
                <img src="images/work-3.gif" alt="">
                <h3>Choose your favourite coffee</h3>
            </div>

            <div class="box">
                <img src="images/work-2.gif" alt="">
                <h3> fast delivery</h3>
            </div>

        

            <div class="box">
                <img src="images/work-4.gif" alt="">
                <h3>and finally, enjoy your coffe</h3>
            </div>

        </div>

    </section>

    <!-- steps section ends -->


<!-- barista section start -->

<section class="barista">
    <div class="abut-header">
        <h2 class="title">Our Team</h2>
    </div>
    <div class="sub-container">
        <div class="teams">
            <img src="images/barsta2.png" alt="">
            <div class="name">Sahar</div>
            <div class="desig">Barista</div>
            <div class="breif">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum labore quam
                reprehenderit
                vitae aliquam dicta! </div>

            <div class="social-links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
               
            </div>
        </div>

        <div class="teams">
            <img src="images/barsta1.png" alt="">
            <div class="name">Laith </div>
            <div class="desig">Barista</div>
            <div class="breif">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum labore quam
                reprehenderit
                vitae aliquam dicta! </div>

            <div class="social-links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
               
            </div>
        </div>

        <div class="teams">
            <img src="images/barsta3.jpg" alt="">
            <div class="name">Rami </div>
            <div class="desig">Barista</div>
            <div class="breif">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum labore quam
                reprehenderit
                vitae aliquam dicta! </div>

            <div class="social-links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
               
            </div>
        </div>
    </div>
</section>

<!-- end -->

















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>