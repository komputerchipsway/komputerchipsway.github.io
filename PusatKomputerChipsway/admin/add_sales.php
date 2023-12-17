<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

$outOfStock = false; // Initialize the variable

if (isset($_POST['add_sales'])) {
    // Get data from the form
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $quantity = $_POST['edited_quantity'];
    $details = $_POST['details'];
    $sale_price = $_POST['sale_price'];
    $image = base64_decode($_POST['image']);

    // Check if the product is out of stock
    if ($_POST['quantity'] == 0) {
        $outOfStock = true; // Set the variable to true
    } else {
        $total_price = $quantity * $sale_price; // Calculate total price

        // Insert data into the sales table
        $insert_sales = $conn->prepare("INSERT INTO `sales` (product_id, name, quantity, details, sale_price, total_price, image_01, date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $result = $insert_sales->execute([$pid, $name, $quantity, $details, $sale_price, $total_price, $image]);

        // Update the quantity in the products table
        $update_quantity = $conn->prepare("UPDATE `products` SET quantity = quantity - ? WHERE id = ?");
        $update_quantity->execute([$quantity, $pid]);

        // Add the following AJAX call
        echo "<script>
            $.post('update_quantity.php', { productId: $pid, quantity: $quantity }, function(data) {
                // Handle the response if needed
                console.log('Quantity updated successfully');
            });
        </script>";

        // Set message for success or failure
        if ($result) {
            $_SESSION['success_message'] = 'Jualan baru ditambah!';
        } else {
            $_SESSION['message'] = 'Gagal menambah data pada jadual jualan.';
        }
    }
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `sales` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
    unlink('../uploaded_img/' . $fetch_delete_image['image_02']);
    unlink('../uploaded_img/' . $fetch_delete_image['image_03']);
    header('location:sales.php');
    exit();
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
        .search-form form{
            display: flex;
            gap:1rem;
        }.search-form form input{
           width: 100%;
           border:var(--border);
           border-radius: .5rem;
           background-color: var(--white);
           box-shadow: var(--box-shadow);
           padding:1.4rem;
           font-size: 1.8rem;
           color:var(--black);
        }.search-form form button{
           font-size: 2.5rem;
           height: 5.5rem;
           line-height: 5.5rem;
           background-color: var(--main-color);
           cursor: pointer;
           color:var(--white);
           border-radius: .5rem;
           width: 6rem;
           text-align: center;
        }.search-form form button:hover{
           background-color: var(--black);
        }.quantity-input {
            width: 6rem;
            padding: 1rem;
            border: var(--border);
            font-size: 1.8rem;
            color: var(--black);
            border-radius: .5rem;
            text-align: center;
        }table {
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
        }.empty {
            text-align: center;
        }
   </style>
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">
   
<?php include '../components/admin_header.php'; ?>

<!-- START ADD SALES SECTION -->
    <section>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
            </div>
            <div style="flex-grow: 1; text-align: center;">
                <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ MENAMBAH JUALAN ]</h1>
            </div>
            <a id="add" href="" style="padding: 10px; border: 3px solid black; background-color: black; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><i class="fas fa-eye"></i></a>
        </div>
    </section>

    <section class="search-form" style="margin-top: -3rem">
       <form action="" method="post">
          <input type="text" name="search_box" placeholder="Cari produk..." maxlength="100" class="box" required style="text-align: center;">
          <button type="submit" class="fas fa-search" name="search_btn"></button>
       </form>
    </section>

    <section class="add_sales">
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>Kuantiti</th>
                    <th>Tindakan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
                    $search_box = $_POST['search_box'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
                    $select_products->execute();
                    if ($select_products->rowCount() > 0) {
                        $productNumber = 1;
                        while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $productNumber++; ?></td>
                                <td><img src="../uploaded_img/<?= htmlspecialchars($fetch_product['image_01']); ?>" alt=""></td>
                                <td><?= $fetch_product['name']; ?></td>
                                <td>
                                    <?php
                                    if ($fetch_product['quantity'] == 0) {
                                        echo '<span style="color: red; font-weight: bold;">Sila tambah stok!</span>';
                                        $defaultQuantityValue = 0; // Set default value to 0 when quantity is 0
                                    } else {
                                        echo $fetch_product['quantity'];
                                        $defaultQuantityValue = 1; // Set default value to 1 for other products
                                    }
                                    ?>
                                </td>
                                <td>RM<?= $fetch_product['sale_price']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                                        <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                                        <input type="hidden" name="quantity" class="original-quantity"
                                               value="<?= $fetch_product['quantity']; ?>">
                                        <input type="hidden" name="details" value="<?= $fetch_product['details']; ?>">
                                        <input type="hidden" name="sale_price" value="<?= $fetch_product['sale_price']; ?>">
                                        <input type="hidden" name="image"
                                               value="<?= base64_encode($fetch_product['image_01']); ?>">
                                        <input type="number" name="edited_quantity" value="<?= $defaultQuantityValue; ?>"
                                               class="quantity-input" required min="0" max="<?= $fetch_product['quantity']; ?>">
                                </td>
                                <td>
                                    <input type="submit" value="Tambah" class="btn" name="add_sales" style="border: 1px solid white;">
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" class="empty">No products found!</td></tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
<!-- START ADMIN-REGISTER-FORM SECTION -->

<?php if (isset($_SESSION['success_message'])): ?>
    <script>
        // Display a pop-up message for successful sale addition
        if (confirm('<?php echo $_SESSION["success_message"]; ?>')) {
            // Redirect to the sales.php page
            window.location.href = 'sales.php';
        }
    </script>
    <?php
    // Clear the success message from the session to avoid displaying it on subsequent visits
    unset($_SESSION['success_message']);
endif;
?>

<?php if ($outOfStock): ?>
    <script>
        // Display a pop-up message if the product is out of stock
        alert('KEHABISAN STOK!');
    </script>
<?php endif; ?>

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

    // Display a pop-up message if the product is out of stock
    <?php if ($outOfStock): ?>
        if (confirm('KEHABISAN STOK!')) {
            // Redirect to the same page
            window.location.href = window.location.href;
        } else {
            // Redirect to the same page if the user cancels
            window.location.href = window.location.href;
        }
    <?php endif; ?>
});
</script>


</body>
</html>