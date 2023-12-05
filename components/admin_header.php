<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <section class="flex">
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div class="profile">
            <?php
               $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
               $select_profile->execute([$admin_id]);
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>Welcome: <?= $fetch_profile['name']; ?></p>
            <a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');" class="del-btn">Logout</a>
            <a href="update_profile.php" class="btn">Update Profile</a>
         </div>
         <!-- Move this part below the profile details -->
         <span class="ad-name">Admin: <?= $fetch_profile['name']; ?></span>
         <a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');" class="del-btn">Logout</a>
      </div>
   </section>
</header>
