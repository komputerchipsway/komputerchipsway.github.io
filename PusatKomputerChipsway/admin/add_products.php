<?php
$uploadDirectory = '../uploaded_img';

// Create the 'uploaded_img' directory if it doesn't exist
if (!file_exists($uploadDirectory) && !is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

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

    // File upload logic for image_01
    $image_01 = $_FILES['image_01']['name'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_size_01 = $_FILES['image_01']['size'];
    $image_folder_01 = $uploadDirectory . '/' . $image_01;

    // File upload logic for image_02
    $image_02 = $_FILES['image_02']['name'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_size_02 = $_FILES['image_02']['size'];
    $image_folder_02 = $uploadDirectory . '/' . $image_02;

    // File upload logic for image_03
    $image_03 = $_FILES['image_03']['name'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_size_03 = $_FILES['image_03']['size'];
    $image_folder_03 = $uploadDirectory . '/' . $image_03;

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
}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
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
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">

<?php include '../components/admin_header.php'; ?>

<!-- START ADD PRODUCTS SECTION -->
    <section>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
            </div>
            <div style="flex-grow: 1; text-align: center;">
                <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ MENAMBAH PRODUK ]</h1>
            </div>
            <a id="add" href="products.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-eye"></i></a>
        </div>
    </section>

    <section class="add-products" style="text-align: center;">
        <form action="" method="post" enctype="multipart/form-data" style="width: 500px; margin: 0 auto; margin-top: -3rem;">
            <div class="huhu" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 88rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="flex">
                    <div class="inputBox">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Nama Produk: </span>
                        <input type="text" class="box" required maxlength="9999999999" cols="30" rows="10" placeholder="Masukkan nama produk" name="name" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;">
                    </div>
                    <div class="inputBox">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Stok Produk:</span>
                        <input type="number" min="0" class="box" required max="9999999999" placeholder="Masukkan stok produk" onkeypress="if(this.value.length == 10) return false;" name="quantity" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;">
                    </div>
                    <div class="inputBox">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Penerangan Produk:</span>
                        <input type="text" class="box" required maxlength="9999999999" cols="30" rows="10" placeholder="Masukkan penerangan produk" name="details" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;">
                    </div>
                    <div class="inputBox">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Harga Beli:</span>
                        <input type="number" min="0" class="box" required max="9999999999" cols="30" rows="10" placeholder="Masukkan harga beli produk" onkeypress="if(this.value.length == 10) return false;" name="buy_price" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;">
                    </div>
                    <div class="inputBox">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Harga Jual:</span>
                        <input type="number" min="0" class="box" required max="9999999999" cols="30" rows="10" placeholder="Masukkan harga jual produk" onkeypress="if(this.value.length == 10) return false;" name="sale_price" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;">
                    </div>
                    <div class="inputBox">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Gambar 1:</span>
                        <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" style="display: block; margin: 0 auto; text-align: center; padding: 10px; margin-top: 5px; border: 1px solid black; border-radius: 5px; width: 220px; font-size: 16px;">

                    <div class="inputBox" style="margin-top: 2rem;">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Gambar 2:</span>
                        <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" style="display: block; margin: 0 auto; text-align: center; padding: 10px; margin-top: 5px; border: 1px solid black; border-radius: 5px; width: 220px; font-size: 16px;">
                    </div>
                    <div class="inputBox" style="margin-top: 2rem;">
                        <span style="font-size: 2rem; color:black; font-weight: bold;">Gambar 3:</span>
                        <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" style="display: block; margin: 0 auto; text-align: center; padding: 10px; margin-top: 5px; border: 1px solid black; border-radius: 5px; width: 220px; font-size: 16px;">
                    </div>
                    <div style="margin-top: 2rem;">
                        <input type="submit" value="Tambah" class="btn" name="add_product" style="display: inline-block; text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px; font-weight: bold;">
                    </div>
                </div>
            </div>
        </form>
    </section>
<!-- END ADD PRODUCTS SECTION -->
   
</body>
</html>