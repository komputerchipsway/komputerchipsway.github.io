<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['add_sales'])) {
    // Get data from the form
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $quantity = $_POST['edited_quantity'];
    $details = $_POST['details'];
    $sale_price = $_POST['sale_price'];
    $image = base64_decode($_POST['image']);
    $total_price = $quantity * $sale_price; // Calculate total price

    // Insert data into the sales table
    $insert_sales = $conn->prepare("INSERT INTO `sales` (product_id, name, quantity, details, sale_price, total_price, image_01, date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $insert_sales->execute([$pid, $name, $quantity, $details, $sale_price, $total_price, $image]);

    // Redirect to a success page or perform other actions
    if ($insert_sales) {
        // Add any additional actions after successful insertion
        echo "Data added to the sales table successfully!";
    } else {
        echo "Failed to add data to the sales table.";
    }
}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `sales` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `sales` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:sales.php');
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
         }.option-btn, .delete-btn {
            margin: 5px;
            text-decoration: none;
            color: white;
            border: 1px solid white;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s;
         }.delete-btn {
            background-color: #FF0000 !important; /* Specify the color and use !important */
         }.option-btn:hover {
            background-color: #555;
         }.delete-btn:hover {
            background-color: #555 !important;
         }.empty {
            text-align: center;
         }
   </style>
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">
   
<?php include '../components/admin_header.php'; ?>

<!-- START SALES SECTION -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div>
               <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
           </div>
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ SENARAI JUALAN ]</h1>
           </div>
           <a id="add" href="add_sales.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-plus"></i></a>
       </div>
   </section>

   <section class="show-sales" style="margin-top: -5rem;">
      <div class="table-container">
         <table>
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Gambar</th>
                  <th>Nama</th>
                  <th>Stok</th>
                  <th>Harga jualan</th>
                  <th>Jumlah harga</th>
                  <th>Tarikh</th>
                  <th>Tindakan</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_sales = $conn->prepare("SELECT * FROM `sales`");
                  $select_sales->execute();
                  if ($select_sales->rowCount() > 0) {
                     $salesNumber = 1; // Initialize the sales number
                     while ($fetch_sales = $select_sales->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <tr>
                  <td><?= $salesNumber++; ?></td>
                  <td><img src="../uploaded_img/<?= $fetch_sales['image_01']; ?>" alt=""></td>
                  <td><?= $fetch_sales['name']; ?></td>
                  <td><?= $fetch_sales['quantity']; ?></td>
                  <td>RM<?= $fetch_sales['sale_price']; ?></td>
                  <td>RM<?= $fetch_sales['total_price']; ?></td>
                  <td><?= $fetch_sales['date']; ?></td>
                  <td class="button-container">
                     <a href="sales.php?delete=<?= $fetch_sales['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Padam</a>
                  </td>
               </tr>
               <?php
                       }
                   } else {
                       echo '<tr><td colspan="8" class="empty">Tiada jualan ditambah!</td></tr>';
                   }
               ?>
            </tbody>
         </table>
      </div>
   </section>
<!-- END SALES SECTION -->

<?php include 'components/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.box');

    forms.forEach(function (form) {
        const quantityInput = form.querySelector('.quantity-input');
        const totalPrice = form.querySelector('.total-price span'); // Corrected selector
        const salePrice = parseFloat(form.querySelector('.sale_price span').innerText);

        quantityInput.addEventListener('input', function () {
            const quantity = parseFloat(this.value);
            const total = quantity * salePrice;
            totalPrice.innerText = 'Total Price: RM ' + total.toFixed(2);
        });
    });

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