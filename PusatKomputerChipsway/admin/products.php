<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $quantity = $_POST['quantity'];  // Corrected
    $quantity = filter_var($quantity, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    // Corrected the variable name from $price to $buy_price
    $buy_price = $_POST['buy_price'];
    $buy_price = filter_var($buy_price, FILTER_SANITIZE_STRING);

    $sale_price = $_POST['sale_price'];
    $sale_price = filter_var($sale_price, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../uploaded_img/' . $image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../uploaded_img/' . $image_03;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'Nama produk telah wujud!';
    } else {
        $insert_products = $conn->prepare("INSERT INTO `products`(name, quantity, details, buy_price, sale_price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?,?,?)");
        $insert_products->execute([$name, $quantity, $details, $buy_price, $sale_price, $image_01, $image_02, $image_03]);

        if ($insert_products) {
            if ($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000) {
                $message[] = 'Saiz gambar terlalu besar!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
                move_uploaded_file($image_tmp_name_02, $image_folder_02);
                move_uploaded_file($image_tmp_name_03, $image_folder_03);
                $message[] = 'Produk baru telah ditambah!';
            }
        }
    }
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // Delete related records in the 'sales' table first
    $delete_sales = $conn->prepare("DELETE FROM `sales` WHERE product_id = ?");
    $delete_sales->execute([$delete_id]);

    // Fetch product data before deletion for file unlinking
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);

    // Check if the files exist before trying to unlink
    if (file_exists('../uploaded_img/' . $fetch_delete_image['image_01'])) {
        unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
    }
    if (file_exists('../uploaded_img/' . $fetch_delete_image['image_02'])) {
        unlink('../uploaded_img/' . $fetch_delete_image['image_02']);
    }
    if (file_exists('../uploaded_img/' . $fetch_delete_image['image_03'])) {
        unlink('../uploaded_img/' . $fetch_delete_image['image_03']);
    }

    // Delete the product record after related records have been deleted
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);

   header('location:products.php');
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
         }.stok-input-container {
            display: flex;
            align-items: center;
        }.stok-input {
            padding: 5px;
            margin-right: 5px;
        }.enter-btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }.display-stok {
            margin-top: 5px;
            font-size: 16px;
            color: white;
            font-weight: bold;
        }

   </style>
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">

<?php include '../components/admin_header.php'; ?>

<!-- START PRODUCTS SECTION -->
    <section>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
            </div>
            <div style="flex-grow: 1; text-align: center;">
                <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ SENARAI PRODUK ]</h1>
            </div>
            <a id="add" href="add_products.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-plus"></i></a>
        </div>
    </section>

    <section class="show-products" style="margin-top: -5rem;">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Penerangan</th>
                        <th>Harga beli</th>
                        <th>Harga jualan</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    if ($select_products->rowCount() > 0) {
                        $productNumber = 1; // Initialize the product number
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                            // Fetch and store the current quantity
                            $currentQuantity = fetchCurrentQuantity($fetch_products['id'], $conn);
                    ?>
                            <tr>
                                <td><?= $productNumber++; ?></td>
                                <td><img src="../uploaded_img/<?= htmlspecialchars($fetch_products['image_01']); ?>" alt=""></td>
                                <td><?= $fetch_products['name']; ?></td>
                                <td class="editable-quantity" contenteditable="true" data-product-id="<?= $fetch_products['id']; ?>">
                                    <div class="stok-input-container">
                                        <input type="number" class="stok-input" placeholder="Masukkan stok" value="0" />
                                        <button class="enter-btn" contenteditable="false">Serah</button>
                                    </div>
                                    <div class="display-stok" id="display-stok-<?= $fetch_products['id']; ?>">
                                        <?php
                                        if ($currentQuantity == 0) {
                                            echo '<span style="color: red; font-weight: bold;">Sila tambah produk!</span>';
                                        } else {
                                            echo $currentQuantity;
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td><?= $fetch_products['details']; ?></td>
                                <td>RM<?= $fetch_products['buy_price']; ?></td>
                                <td>RM<?= $fetch_products['sale_price']; ?></td>
                                <td class="button-container">
                                    <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Padam</a>
                                    <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Kemaskini</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="empty">Tiada produk tersenarai!</td></tr>';
                    }

                    // Function to fetch the current quantity
                    function fetchCurrentQuantity($productId, $conn) {
                        $select_quantity = $conn->prepare("SELECT quantity FROM `products` WHERE id = ?");
                        $select_quantity->execute([$productId]);
                        $result = $select_quantity->fetch(PDO::FETCH_ASSOC);
                        return $result['quantity'];
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
<!-- END PRODUCTS SECTION -->

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

    $('.enter-btn').on('click', function() {
        var inputContainer = $(this).closest('.stok-input-container');
        var quantityInput = inputContainer.find('.stok-input');
        var productId = quantityInput.closest('.editable-quantity').data('product-id');
        var updatedQuantity = quantityInput.val();

        // Check if the entered quantity is greater than 0
        if (parseInt(updatedQuantity) > 0) {
            $.post('update_quantity.php', { productId: productId, quantity: updatedQuantity }, function(data) {
                // Handle the response if needed
                if (data === 'success') {
                    // Update the displayed quantity
                    inputContainer.next('.display-stok').text(updatedQuantity);
                    
                    // Update the input placeholder
                    quantityInput.attr('placeholder', 'Masukkan stok').val('');
                } else {
                    // Handle the error case
                }
            });
        } else {
            // Display a message if the entered quantity is 0
            inputContainer.next('.display-stok').html('<span style="color: red; font-weight: bold;">Sila tambah produk!</span>');
        }
    });
});
</script>

</body>
</html>