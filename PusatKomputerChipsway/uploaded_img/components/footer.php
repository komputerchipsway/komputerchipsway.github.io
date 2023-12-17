<html>
<head>
   <link rel="stylesheet" type="text/css" href="styles.css"> 
   <style>   
      .grid {
        display: flex;
        justify-content: center;
        align-items: center;
      }.box {
        text-align: center;
        padding: 5px;
      }
      <?php
        $smallScreenStyle = '@media screen and (max-width: 768px) {
            .grid {
               flex-direction: column;
               margin-bottom: 10rem;
            }
        }';

        echo $smallScreenStyle;
      ?>
   </style>
</head>
<body>

<footer class="footer">
   <section class="grid" style="height: 280px;">
      <div class="box">
         <h3>Pautan</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i>Laman Utama</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i>Tentang Kami</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i>Maklum Balas</a>
      </div>
      <div class="box">
         <h3>Hubungi Kami</h3>
         <a href="tel:0199119522"><i class="fas fa-phone"></i>0199119522</a>
         <a href="tel:094455675"><i class="fas fa-phone"></i>094455675</a>
         <a href="https://mail.google.com/ "><i class="fas fa-envelope"></i> nizam465@gmail.com</a>
         <a href="https://maps.app.goo.gl/jdVq9wUiy8gmDYVt8"><i class="fas fa-map-marker-alt"></i>No.15, Kedai Tdk pusat, <br>26900 Bandar Tun Abdul Razak, Pahang</br></a>
      </div>
   </section>
   <div class="credit">&copy; Pusat Komputer Chipsway <?= date('Y'); ?><span></span> | all rights reserved!</div>
</footer>

</body>
</html>
