<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="your-styles.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
    <style>
        @media screen and (max-width: 768px) {
            .navbar {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
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
?>

<header class="header">
    <section class="flex">
        <a href="index.html" class="logo">Pusat Komputer Chipsway<span>.</span></a>
        <nav class="navbar">
            <a href="index.html" class="nav-link"><i class="fas fa-home"></i></a>
            <a href="home.php">Laman Utama</a>
            <a href="about.php">Tentang Kami</a>
            <a href="contact.php">Maklum Balas</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars" style="font-size: 2.5rem; color:black;"></div>
            <a href="search_page.php"><i class="fas fa-search"></i></a>
            <a href="admin/admin_login.php" class="user-btn"><i class="fas fa-user"></i></a>
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
</script>

</body>
</html>
