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
   <title>Pusat Komputer Chipsway</title>
   <link rel="shortcut icon" href="images/icon-9.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> 
</head>
<body style="background-image: url('images/home-bg.png'); background-size: cover;">
   
<?php include 'components/user_header.php'; ?>

<!-- START HEADING SECTION -->
<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <div>
            <a id="out" href="home.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
        </div>
        <div style="flex-grow: 1; text-align: center;">
            <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ PENERANGAN PRODUK ]</h1>
        </div>
        <a id="add" href="" style="padding: 10px; border: 3px solid black; background-color: black; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><i class="fas fa-plus"></i></a>
    </div>
</section>
<!-- END HEADING SECTION -->
<section class="quick-view" style="margin-top: -4rem;">
   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box" style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="sale_price" value="<?= $fetch_product['sale_price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img id="subImage1" src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <img id="subImage2" src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
               <img id="subImage3" src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content" style="padding: 20px; background-color: wheat; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

            <div style="margin-bottom: 20px;">
               <h2 style="font-size: 28px; color: #333; font-weight: bold;">Nama Produk:</h2>
               <div class="name" style="font-size: 24px; color: #555;"><?= $fetch_product['name']; ?></div>
            </div>

            <div style="margin-bottom: 20px;">
               <h2 style="font-size: 28px; color: #333; font-weight: bold;">Penerangan Produk:</h2>
               <div class="details" style="font-size: 24px; color: #555;"><?= $fetch_product['details']; ?></div>
            </div>

            <div style="margin-bottom: 20px;">
               <h2 style="font-size: 28px; color: #333; font-weight: bold;">Stok Produk:</h2>
               <div class="quantity" style="font-size: 24px; color: #555;">
                  <?php
                     if ($fetch_product['quantity'] > 0) {
                        echo $fetch_product['quantity'];
                     } else {
                        echo '<div style="color: red;">Tiada Stok!</div>';
                     }
                  ?>
               </div>
            </div>

            <div style="margin-bottom: 20px;">
               <h2 style="font-size: 28px; color: #333; font-weight: bold;">Harga Produk:</h2>
               <div class="price" style="font-size: 24px; color: #e44d26; font-weight: bold;">
                  RM <?= $fetch_product['sale_price']; ?>
               </div>
            </div>

         </div>

      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Tiada produk tersedia!</p>';
   }
   ?>
</section>

<?php include 'components/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
   // Get references to the main and sub images
   const mainImage = document.querySelector('.main-image img');
   const subImages = document.querySelectorAll('.sub-image img');

   // Add a click event listener to each sub-image
   subImages.forEach(function(subImage) {
      subImage.addEventListener('click', function() {
         // Change the src attribute of the main image to the clicked sub-image
         mainImage.src = this.src;
      });
   });
});
</script>

</body>
</html>