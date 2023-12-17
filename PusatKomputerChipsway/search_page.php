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
   <style>
      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }th, td {
         border: 1px solid white;
         padding: 10px;
         text-align: center;
         color: white;
         font-size: 14px;
      }th {
         background-color: #333;
         color: white;
      }td img {
         max-width: 100px;
         max-height: 100px;
      }.button-container {
         display: flex;
         justify-content: center;
         align-items: center;
      }.option-btn{
         margin: 5px;
         text-decoration: none;
         color: white;
         border: 1px solid white;
         border-radius: 5px;
         padding: 10px;
         transition: background-color 0.3s;
      }.option-btn:hover {
         background-color: #555;
      }.empty {
         text-align: center;
      }
      <?php
        $smallScreenStyle = '@media screen and (max-width: 768px) {
            th, td {
               font-size: 10px;
            }td img {
               max-width: 60px;
               max-height: 60px;
            }.option-btn{
               width: 50px;
            }
        }';

        echo $smallScreenStyle;
      ?>
   </style>
</head>
<body style="background-image: url('images/home-bg.png'); background-size: cover;">
   
<?php include 'components/user_header.php'; ?>

<!-- START SEARCH FORM SECTION  -->
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="Cari produk..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>
<!-- END SEARCH FORM SECTION  -->

<!-- START PRODUCTS SECTION  -->
<section class="products" style="padding-top: 0; min-height:100vh;">
   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>No.</th>
               <th>Gambar</th>
               <th>Nama</th>
               <th>Stok</th>
               <th>Penerangan</th>
               <th>Harga produk</th>
               <th>Tindakan</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
                  $search_box = $_POST['search_box'];
                  $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); 
                  $select_products->execute();
                  if($select_products->rowCount() > 0){
                     $productNumber = 1; // Initialize the product number
                     while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
               <td><?= $productNumber++; ?></td>
               <td><img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt=""></td>
               <td><?= $fetch_product['name']; ?></td>
               <td>
                  <?php
                     if ($fetch_product['quantity'] == 0) {
                        echo '<span style="color: red; font-weight: bold;">Tiada stok!</span>';
                     } else {
                        echo $fetch_product['quantity'];
                     }
                  ?>
               </td>
               <td><?= $fetch_product['details']; ?></td>
               <td>RM<?= $fetch_product['sale_price']; ?></td>
               <td class="button-container">
                  <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="option-btn"><i class="fas fa-eye"></i></a>
               </td>
            </tr>
            <?php
                     }
                  } else {
                     echo '<tr><td colspan="8" class="empty">Tiada produk tersenarai!</td></tr>';
                  }
               }
            ?>
         </tbody>
      </table>
   </div>
</section>
<!-- END PRODUCTS SECTION  -->

<?php include 'components/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    // Iterate through each row in the table
    $('table tbody tr').each(function() {
        // Find the maximum height among all cells in the current row
        var maxHeight = 0;
        $(this).find('td').each(function() {
            var cellHeight = $(this).outerHeight();
            if (cellHeight > maxHeight) {
                maxHeight = cellHeight;
            }
        });

        // Set the height of the button container to match the maximum height
        $(this).find('.button-container').css('height', maxHeight);
    });
});
</script>

</body>
</html>