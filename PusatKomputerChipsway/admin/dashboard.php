<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
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
<body style="background-image: url('adminImages/home-bg.png');">

<?php include '../components/admin_header.php'; ?>

<!-- START DASHBOARD SECTION -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ DASHBOARD ]</h1>
           </div>
       </div>
   </section>

   <section class="dashboard" style="margin-top: -2.5rem;">
      <!-- START BOX CONTAINER -->
      <div class="box-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr)); gap:1.5rem; justify-content: center; align-items: flex-start;">
         <!-- START WELCOME -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <h3 style="font-size: 2.7rem; color:var(--black);">Selamat Datang!</h3>
            <p style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold; color:teal; margin:1rem 0;"><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="btn">Kemaskini Akaun</a>
         </div>
         <!-- END WELCOME -->
      </div><br></br>
      <!-- END BOX CONTAINER -->
      
      <!-- START BOX CONTAINER 1 -->
      <div class="box-container1" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr)); gap:1.5rem; justify-content: center; align-items: flex-start;">
         <!-- START ADMIN -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <?php
               $select_admins = $conn->prepare("SELECT * FROM `admins`");
               $select_admins->execute();
               $number_of_admins = $select_admins->rowCount()
            ?>
            <p style="font-size: 2rem; color:var(--black); font-weight: bold;">Bilangan Akaun Admin</p>
            <h3 style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold; color:teal; margin:1rem 0;"><?= $number_of_admins; ?></h3>
            <a href="admin_accounts.php" class="btn">Senarai Admin</a>
            <a href="register_admin.php" class="btn">Daftar Akaun Admin</a>
         </div>
         <!-- END ADMIN -->
         <!-- START PRODUCT -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <?php
               $select_products = $conn->prepare("SELECT * FROM `products`");
               $select_products->execute();
               $number_of_products = $select_products->rowCount()
            ?>
            <p style="font-size: 2rem; color:var(--black); font-weight: bold;">Bilangan Produk Yang Ditambah</p>
            <h3 style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold;color:teal; margin:1rem 0;"><?= $number_of_products; ?></h3>
            <a href="products.php" class="btn">Senarai Produk</a>
            <a href="add_products.php" class="btn">Tambah Produk</a>
         </div>
         <!-- END PRODUCT -->
         <!-- START SALE -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <?php
               $select_sales = $conn->prepare("SELECT * FROM `sales`");
               $select_sales->execute();
               $number_of_sales = $select_sales->rowCount()
            ?>
            <p style="font-size: 2rem; color:var(--black); font-weight: bold;">Bilangan Jualan Yang Ditambah</p>
            <h3 style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold;color:teal; margin:1rem 0;"><?= $number_of_sales; ?></h3>
            <a href="sales.php" class="btn">Senarai Jualan</a>
            <a href="add_sales.php" class="btn">Tambah Jualan</a>
         </div>
         <!-- END SALE -->
      </div><br></br>
      <!-- END BOX CONTAINER 1 -->

      <!-- START BOX CONTAINER 2 -->
      <div class="box-container2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr)); gap:1.5rem; justify-content: center; align-items: flex-start;">
         <!-- START DAILY SALE -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <?php
               $total_daily_sales = 0;
               $current_date = date("Y-m-d");

               $select_daily_sales_dashboard = $conn->prepare("SELECT SUM(total_price) as total_daily_sales FROM sales WHERE date = :current_date");
               $select_daily_sales_dashboard->bindParam(':current_date', $current_date);
               $select_daily_sales_dashboard->execute();

               if ($select_daily_sales_dashboard->rowCount() > 0) {
                  $fetch_daily_sales_dashboard = $select_daily_sales_dashboard->fetch(PDO::FETCH_ASSOC);
                  $total_daily_sales = $fetch_daily_sales_dashboard['total_daily_sales'];
               }
            ?>
            <p style="font-size: 2rem; color:var(--black); font-weight: bold;">Jualan Harian - <?= date("d M Y"); ?></p>
            <h3 style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold;color:teal; margin:1rem 0;"><span>RM </span><?= $total_daily_sales; ?><span></span></h3>
            <a href="daily_sales.php" class="btn">Senarai Jualan Harian</a>
         </div>
         <!-- END DAILY SALE -->
         <!-- START MONTHLY SALE -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <?php
               $total_sales = 0;

               $currentMonth = date('m');
               $currentYear = date('Y');

               $select_sales = $conn->prepare("SELECT SUM(total_price) as total_sales FROM sales WHERE MONTH(date) = ? AND YEAR(date) = ?");
               $select_sales->execute([$currentMonth, $currentYear]);

               if($select_sales->rowCount() > 0){
                  $fetch_sales = $select_sales->fetch(PDO::FETCH_ASSOC);
                  $total_sales = $fetch_sales['total_sales'];
               }
            ?>
            <p style="font-size: 2rem; color:var(--black); font-weight: bold;">Jualan Bulanan - <?= date('F Y'); ?></p>
            <h3 style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold;color:teal; margin:1rem 0;"><span>RM </span><?= $total_sales; ?><span></span></h3>
            <a href="monthly_sales.php" class="btn">Senarai Jualan Bulanan</a>
         </div>
         <!-- END MONTHLY SALE -->
         <!-- START MESSAGE -->
         <div class="box" style="padding:2rem; text-align: center; border:var(--border); box-shadow: var(--box-shadow); border-radius: .5rem; background-color: var(--white);">
            <?php
               $select_messages = $conn->prepare("SELECT * FROM `messages`");
               $select_messages->execute();
               $number_of_messages = $select_messages->rowCount()
            ?>
            <p style="font-size: 2rem; color:var(--black); font-weight: bold;">Bilangan Maklum Balas</p>
            <h3 style="padding:1.3rem; border: 1px solid black; border-radius: .5rem; background-color: var(--light-bg); font-size: 1.9rem; font-weight: bold;color:teal; margin:1rem 0;"><?= $number_of_messages; ?></h3>
            <a href="messages.php" class="btn">Lihat Maklum Balas</a>
         </div>
         <!-- END MESSAGE -->
      </div>
      <!-- END BOX CONTAINER 2 -->
   </section>
<!-- END DASHBOARD SECTION -->
   
</body>
</html>