<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['update'])) {
   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $quantity = intval($_POST['quantity']); // Convert to integer
   $price = $_POST['sale_price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   // Check if $_SESSION['updated_quantity'] is set and is an array
   if (!isset($_SESSION['updated_quantity']) || !is_array($_SESSION['updated_quantity'])) {
      $_SESSION['updated_quantity'] = array(); // Initialize as an empty array
   }

    // Update the database with the new stock quantity
   $update_product = $conn->prepare("UPDATE `products` SET name = ?, quantity = ?, sale_price = ?, details = ? WHERE id = ?");
   $update_product->execute([$name, $quantity, $price, $details, $pid]);

    // Store the updated quantity in a session variable
   $_SESSION['updated_quantity'][$pid] = $quantity;

   $message[] = 'Produk berjaya dikemaskini!';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'Saiz gambar terlalu besar!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = 'Gambar 1 berjaya dikemaskini!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'Saiz gambar terlalu besar!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../uploaded_img/'.$old_image_02);
         $message[] = 'Gambar 2 berjaya dikemaskini!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'Saiz gambar terlalu besar!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../uploaded_img/'.$old_image_03);
         $message[] = 'Gambar 3 berjaya dikemaskini!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pusat Komputer Chipsway</title>
   <link rel="shortcut icon" href="adminImages/icon-9.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      .inputBox {
         margin-bottom: 20px; 
      }.inputBox:last-child {
         margin-bottom: 5px;
      }
   </style>
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">

<?php include '../components/admin_header.php'; ?>

<!-- START UPDATE PRODUCT SECTION -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div>
               <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
           </div>
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ MENGEMASKINI PRODUK ]</h1>
           </div>
           <a id="add" href="products.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-eye"></i></a>
       </div>
   </section>

   <section class="update-product" style="text-align: center; margin-top: -3rem;">
      <?php
         $update_id = $_GET['update'];
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_products->execute([$update_id]);
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
      <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
         <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
         <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
         <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 110rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="image-container">
               <div class="main-image">
                  <img src="../uploaded_img/<?= htmlspecialchars($fetch_products['image_01']); ?>" alt="">
               </div>
               <div class="sub-image">
                  <img src="../uploaded_img/<?= htmlspecialchars($fetch_products['image_01']); ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
               </div>
            </div>
            <div class="flex">
               <div class="inputBox">
                  <span style="font-size: 2rem; color:black; font-weight: bold;">Kemaskini Nama Produk: </span>
                  <input type="text" name="name" required class="box" maxlength="100" placeholder="Masukkan nama produk baru" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" value="<?= $fetch_products['name']; ?>">
               </div>
               <div class="inputBox">
                  <span style="font-size: 2rem; color:black; font-weight: bold;">Kemaskini Harga Jual:</span>
                  <input type="number" name="sale_price" required class="box" min="0" max="9999999999" placeholder="Masukkan harga jual baru" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['sale_price']; ?>">
               </div>
               <div class="inputBox">
                  <span style="font-size: 2rem; color:black; font-weight: bold;">Kemaskini Penerangan Produk:</span>
                  <textarea name="details" class="box" required cols="30" rows="10" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;"><?= $fetch_products['details']; ?></textarea>
               </div>
               <div class="inputBox">
                  <span style="font-size: 2rem; color:black; font-weight: bold;">Kemaskini Gambar1: </span>
                  <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" style="display: block; margin: 0 auto; text-align: center; padding: 10px; margin-top: 5px; border: 1px solid black; border-radius: 5px; width: 220px; font-size: 16px;">
               </div>
               <div class="inputBox">
                  <span style="font-size: 2rem; color:black; font-weight: bold;">Kemaskini Gambar2: </span>
                  <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" style="display: block; margin: 0 auto; text-align: center; padding: 10px; margin-top: 5px; border: 1px solid black; border-radius: 5px; width: 220px; font-size: 16px;">
               </div>
               <div class="inputBox">
                  <span style="font-size: 2rem; color:black; font-weight: bold;">Kemaskini Gambar3: </span>
                  <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" style="display: block; margin: 0 auto; text-align: center; padding: 10px; margin-top: 5px; border: 1px solid black; border-radius: 5px; width: 220px; font-size: 16px;">
               </div>
            </div>
            <div style="margin-top: 1.5rem;">
               <input type="submit" value="Kemaskini" class="btn" name="update" style="display: inline-block; text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px; color: white; font-weight:bold;">
            </div>
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">Tiada produk dijumpai!</p>';
         }
      ?>
   </section>
<!-- END UPDATE PRODUCT SECTION -->

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