<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head> 
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
      <!-- Google Web Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Itim&family=Kalam:wght@400;700&family=Merriweather:wght@300;700&family=Poppins:wght@200;300&family=Quicksand&family=Raleway:wght@300;400&family=Shadows+Into+Light&family=Yellowtail&display=swap" rel="stylesheet">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="css/components.css">
   
    <!-- swiper cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/scrollreveal"></script>

</head>
<body>

<?php include 'components/user_header.php'; ?>


 <!-- home section starts -->

 <section class="home">

<div class="swiper home-slider">

    <div class="swiper-wrapper">

        <div class="swiper-slide slide" style="background: url(images/home-1.jpg) no-repeat;">
            <div class="content">
                <h3>the <span>tastiest</span> coffe <br> on the planet</h3>
                <a href="menu.php" class="btn">order now</a>
            </div>
        </div>

        <div class="swiper-slide slide" style="background: url(images/home-4.jpg) no-repeat;">
            <div class="content">
                <h3>the <span>tastiest</span> coffe <br> on the planet</h3>
                <a href="menu.php" class="btn">order now</a>
            </div>
        </div>

        <div class="swiper-slide slide" style="background: url(images/home-3.jpg) no-repeat;">
            <div class="content">
                <h3>the <span>tastiest</span> coffe <br> on the planet</h3>
                <a href="menu.php" class="btn">order now</a>
            </div>
        </div>

    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

</div>

</section>

<!-- home section ends -->




   <!-- about -->

   <section class="about-us">
        <div class="content-container">
            <div class="image">
                <img src="images/Breakroom-Blob02-coffe.png" alt="About Us Image">
            </div>
            <div class="content">
                <h1 class="title">Start your day with a cup of Robusta coffee</h1>
                <p>
                    Welcome to our Robusta cafe ! We are dedicated to providing you with the finest coffee experience. Our passion for quality coffee is matched only by our commitment to excellent service. From the bean to the cup, we strive for perfection in every sip.To share our customers’ daily moments by providing perfect, delicious coffee. Guarantee that the quality of coffee we produce. To be the leading Coffee providers in Jordan.
                </p>
                <div >
            <a href="about.php" class="btn">Read More</a>

    </div>

            </div>
            
        </div>
    </section>
<!-- end -->








 <section class="category">

 <h1 class="title">OUR Categories</h1>


<div class="box-container">









<?php
      $select_categories = $conn->prepare("SELECT * FROM categories ");
      $select_categories->execute();
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){
            $category_id = $fetch_categories['id'];
            $category_name = $fetch_categories['name'];
            $category_image = $fetch_categories['image'];
   ?>
      <div class="box">
         <img src="uploaded_img/<?= $category_image; ?>" alt="">
         <a href="category.php?category=<?= $category_name; ?>" class="btn"><?= $category_name; ?></a>
      </div>



      <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
   </div>



























</section>

<!-- banner section ends -->


<section class="products">

   <h1 class="title">latest Coffee</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fa-regular fa-eye"></a>
         <!-- <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button> -->
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><?= $fetch_products['price']; ?><span>JD</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
            
         </div>
      <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
         
        
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">veiw all</a>
   </div>

</section>


 







     <!-- gallery section starts -->

     <section class="gallery section" id="gallery">
            <h2 class="title">Gallery</h2>

            <div class="gallery__container container grid">
                <div class="gallery__img">
                    <img src="images/g1.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g2.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g9.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g4.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g5.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g6.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g7.jpg" alt="">
                </div>
                <div class="gallery__img">
                    <img src="images/g8.jpg" alt="">
                </div>
            </div>
        </section>

<!-- gallery section ends -->















<?php include 'components/footer.php'; ?>



<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});
</script>

</body>
</html>