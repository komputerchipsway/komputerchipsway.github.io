<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Page Title</title>
   <link rel="stylesheet" href="your-styles.css">
   <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
   <style>
   /* Dropdown container */
      .dropdown {
         display: inline-block;
         position: relative;
      }.dropdown-content {
         display: none;
         position: absolute;
         background-color: #f9f9f9;
         min-width: 160px;
         box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
         z-index: 1;
      }.dropdown-content a {
         color: black;
         padding: 12px 16px;
         text-decoration: none;
         display: block;
      }.dropdown-content a:hover {
         background-color: #f1f1f1;
      }.dropdown:hover .dropdown-content {
         display: block;
      }

      @media screen and (max-width: 768px) {
         .navbar {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 70px;
            left: 0;
            width: 100%;
            height: 43rem;
            background-color: #fff; /* Set background color to white */
         }.navbar.active {
            display: flex;
         }
      }
    </style>
</head>
<body>

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

date_default_timezone_set('Asia/Kuala_Lumpur');
?>

<header class="header">
   <section class="flex">
      <a href="../admin/dashboard.php" class="logo">Admin<span>Komputer Chipsway</span></a>
      <p id="currentDateTime" style="font-size: 16px; color: #333;"><?= date('D-m-y  H:i:s'); ?></p>
      <nav class="navbar">
         <a href="../admin/dashboard.php" class="nav-link"><i class="fas fa-home"></i></a>
         <div class="dropdown">
            <a href="#" class="nav-link">Akaun <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-content">
               <a href="../admin/admin_accounts.php">Senarai Akaun Admin</a>
               <a href="../admin/register_admin.php">Tambah Akaun Admin</a>                
            </div>
         </div>
         <div class="dropdown">
            <a href="#" class="nav-link">Produk <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-content">
               <a href="../admin/products.php">Senarai Produk</a>
               <a href="../admin/add_products.php">Tambah Produk</a>
            </div>
         </div>
         <div class="dropdown">
            <a href="#" class="nav-link">Jualan <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-content">
               <a href="../admin/sales.php">Senarai Jualan</a>
               <a href="../admin/add_sales.php">Tambah Jualan</a>
            </div>
         </div>
            <a href="../admin/messages.php" class="nav-link">Maklum Balas</a>
        </nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars" style="font-size: 2.5rem; color:black;"></div>
         <a href="../components/admin_logout.php" class="delete-button" onclick="return confirm('Logout from the website?');" style="background: none; border: none; padding: 0; margin: 0; font-size: 2.5rem; cursor: pointer; color: #333; text-decoration: underline;"><i class="fas fa-sign-out-alt"></i></a>
      </div>
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
      </div>
   </section>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var menuBtn = document.getElementById("menu-btn");
        var navbar = document.querySelector(".navbar");

        menuBtn.addEventListener("click", function () {
            navbar.classList.toggle("active");
        });
    });

   setInterval(function() {
      var currentDate = new Date();
      var formattedDate = currentDate.getDate() + "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getFullYear() + " " + currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();
      document.getElementById("currentDateTime").innerText = formattedDate;
   }, 1000); // Update every second
</script>

</body>
</html>