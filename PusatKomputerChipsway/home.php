<?php

session_start();

include 'components/connect.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-kJLFjF+PpLXRbOv5lFiGIBDQ5K2f8T0IpMpO4ZLl+3QvqzR9R9j3QpNVdjzA2z2t" crossorigin="anonymous">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <style>
   /* START STYLE FOR HOME-WHY */
      .flex-container {
         display: flex;
         align-items: center; 
      }.big-side-image img {
         flex: 2;
         width: 100%;
         max-width: 400px;
         height: auto;
      }.feature1 {
         display: flex;
         align-items: center;
         margin: 10px; 
         flex: 1; 
         flex-direction: column; 
         align-items: center;
         border: 5px solid #ccc; 
         padding: 10px; 
      }.feature2 {
         display: flex;
         align-items: center;
         margin: 40px; 
         flex: 1; 
         flex-direction: column; 
         align-items: center;
         border: 5px solid #ccc; 
         padding: 10px; 
      }.feature .icon1, {
         margin-right: 10px; 
      }.feature .icon2 {
         margin-right: 10px; 
      }.feature1 span, .feature2 span {
         font-size: 18px;
         font-weight: bold; 
         color: #333; 
      }.feature1 h3, .feature2 h3 {
         font-size: 18px; 
         color: #666; 
      }
      <?php
        $smallScreenStyle = '@media screen and (max-width: 768px) {
            .big-side-image img {
               flex: 2;
               width: 8rem;
               height: auto;
            }
        }';

        echo $smallScreenStyle;
      ?>
   /* END STYLE FOR HOME-WHY */

   /* START STYLE FOR HOME-PRODUCTS */
      .form-label-container {
         display: flex;
         flex-direction: column;
         align-items: center;
         text-align: center;
      }.form-value {
         height: auto; 
         overflow: visible; /
         display: -webkit-box;
         -webkit-line-clamp: initial; 
         -webkit-box-orient: vertical;
         cursor: pointer; 
      }.form-value.expandable {
         overflow: hidden;
         display: -webkit-box;
         -webkit-line-clamp: 1; 
         -webkit-box-orient: vertical;
         cursor: pointer;
      }.form-value.expanded {
         -webkit-line-clamp: initial;
      }.product-slide {
         position: relative;
         overflow: hidden;
         border-radius: 15px; 
         box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
         transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      }.product-details-container, .product-name-container {
         position: absolute;
         bottom: 0;
         left: 0;
         right: 0;
         background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
         padding: 20px;
         color: #fff; 
         text-align: center;
      }.product-label {
         font-size: 20px;
         font-weight: bold;
         margin-bottom: 12px;
         color: #9932CC; 
      }.pro.product-details-container {
         position: absolute;
         bottom: 0;
         left: 0;
         right: 0;
         background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
         padding: 20px;
         color: #fff; 
         text-align: center;
      }duct-value {
         font-size: 18px;
         margin-bottom: 15px;
         color: #4B0082; 
      }.product-price {
         font-size: 22px;
         color: #FF1493; 
         font-weight: bold;
      }.product-slide img {
         width: 100%;
         height: auto;
         border-top-left-radius: 15px;
         border-top-right-radius: 15px;
      }.prev-button, .next-button {
         background-color: royalblue; 
         color: #fff;
         border: 2px solid darkblue;
         border-radius: 8px;
         padding: 12px;
         font-size: 1.2rem;
         cursor: pointer;
         transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
      }.prev-button:hover, .next-button:hover {
         background-color: lightblue;
         color: black;
      }
   /* END STYLE FOR HOME-PRODUCTS */

   /* START STYLE FOR HOME-VIDEOS */
      .home-videos .slide{
         padding:2rem;
         text-align: center;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         border:var(--border);
         margin-bottom: 5rem;
         user-select: none;
      }.home-videos .slide iframe{
         height: 20rem;
         width: 30rem;
         margin-bottom: .5rem;
      }.home-videos .slide p{
         padding:1rem 0;
         line-height: 2;
         font-size: 1.5rem;
         color:var(--light-color);
      }.home-videos .slide .stars i{
         margin:0 .3rem;
         font-size: 1.7rem;
         color:var(--orange);
      }.home-videos .slide h3{
         font-size: 2rem;
         color:var(--black);
      }
   /* END STYLE FOR HOME-VIDEOS */
   
   /* START STYLE FOR HOME-MAPS */
      .home-maps .slide{
         padding:2rem;
         text-align: center;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         border:var(--border);
         margin-bottom: 5rem;
         user-select: none;
      }.home-maps .slide img{
         height: 20rem;
         width: 30rem;
         margin-bottom: .5rem;
      }.home-maps .slide p{
         padding:1rem 0;
         line-height: 2;
         font-size: 1.5rem;
         color:var(--light-color);
      }.home-maps .slide .stars i{
         margin:0 .3rem;
         font-size: 1.7rem;
         color:var(--orange);
      }.home-maps .slide a{
         font-size: 2rem;
         color:var(--black);
      }
   /* END STYLE FOR HOME-MAPS */
   </style>
</head>
<body style="background-image: url('images/home-bg.png'); background-size: cover;">
   
<?php include 'components/user_header.php'; ?>

<!-- START HOME-WHY SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ KENAPA HARUS MEMILIH KAMI? ]</h1>
           </div>
       </div>
   </section>

   <section class="home-why" style="margin-top: -1rem; margin-bottom: 7rem; border-style: double; border-width: 20px; border-color: coral;">
      <div class="flex-container">
         <div class="big-side-image">
            <img src="images/img-1.png" alt="Big Side Image" class="img-fluid">
         </div>
         <div class="feature1">
            <div class="icon1">
               <img src="images/bag.jpg" alt="Image" class="img-fluid">
            </div>
            <div>
               <center><span>PENJUALAN</span></center>
               <center><h3>Kami menjual peralatan rumah atau perkakas elektrik, jualan runcit komputer, peranti persisian serta perisian dan kelengkapan telekomunikasi.</h3></center>
            </div>
         </div>
         <div class="feature2">
            <div class="icon2">
               <img src="images/repair.jpg" alt="Image" class="img-fluid">
            </div>
            <div>
               <center><span>PERBAIKAN</span></center>
               <center><h3>Kami juga membaiki komputer yang rosak dan sebagainya.</h3></center>
            </div>
         </div>
      </div>
   </section>
<!-- END HOME-WHY SECTION  -->

<!-- START HOME-PRODUCTS SECTION -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ PRODUK ]</h1>
           </div>
       </div>
   </section>

   <section class="home-products" style="margin-top: -3rem; margin-bottom: 5rem;">
      <div class="swiper products-slider">
         <div class="swiper-wrapper">
            <?php
               $select_products = $conn->prepare("SELECT * FROM `products`"); 
               $select_products->execute();
               if($select_products->rowCount() > 0){
                  while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
               <form action="" method="post" class="swiper-slide slide product-slide">
                  <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                  <input type="hidden" name="sale_price" value="<?= $fetch_product['sale_price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                  <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Nama Produk: </span>
                           <span class="form-value expandable" style="font-size: 24px; color: #555;"><?= $fetch_product['name']; ?></span>
                        </div>
                     </div>
                     <div class="details">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Penerangan Produk: </span>
                           <span class="form-value expandable" style="font-size: 24px; color: #555;"><?= $fetch_product['details']; ?></span>
                        </div>
                     </div>
                     <div class="quantity">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Stok Produk:</span>
                           <span class="form-value" style="font-size: 24px; color: #555;">
                              <?php
                                 if ($fetch_product['quantity'] > 0) {
                                    echo $fetch_product['quantity'];
                                 } else {
                                    echo '<div style="color: red;">Tiada Stok!</div>';
                                 }
                              ?>
                           </span>
                        </div>
                     </div>
                     <div class="sale_price">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Harga Produk: </span>
                           <span class="form-value" style="font-size: 24px; color: #e44d26; font-weight: bold;">RM <?= $fetch_product['sale_price']; ?></span>
                        </div>
                     </div>
                  </div>
               </form>
            <?php
                  }
               } else {
                  echo '<p class="empty" style="display: flex; justify-content: center; align-items: center;">Tiada Produk Yang Tersedia!</p></div>';
               }
            ?>
         </div>
      </div>
      <div class="product-slider-controls" style="display: flex; justify-content: center; align-items: center;">
         <button class="prev-button" onclick="prevProductSlide()"><i class="fas fa-arrow-left"></i></button>
         <button class="next-button" onclick="nextProductSlide()"><i class="fas fa-arrow-right"></i></button>
      </div>
   </section>
<!-- END HOME-PRODUCTS SECTION -->

<!-- START HOME-VIDEOS SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ VIDEO YANG BERKAITAN ]</h1>
           </div>
       </div>
   </section>

   <section class="home-videos" style="margin-top: -3rem;">
      <div class="swiper videos-slider">
         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/GlUNr_90UgQ"></iframe>
                  <h3>CARA MUDAH MEMASANG PERANGKAT KOMPUTER</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/R8j86PPUnIw"></iframe>
                  <h3>TUTORIAL CARA PASANG 2 MONITOR PADA PC</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/aldFJRUhHYY"></iframe>
                  <h3>CARA LEPAS & PASANG KEYCAPS KEYBOARD LAPTOP</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/SB0tGMSIwSo"></iframe>
                  <h3>CARA MENGATASI LAPTOP YANG LUPA PASSWORD</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/HIrolQb0U2k"></iframe>
                  <h3>CARA UPDATE WINDOWS 10 KE VERSI TERBARU</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/_Hmv7X5IaeY"></iframe>
                  <h3>CARA BUKA DAN BERSIHKAN KIPAS</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/2ckH74ScW4c"></iframe>
                  <h3>CARA MEMBAIKI PETI AIS YANG TAK SEJUK</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/wDbgCFZHfXo"></iframe>
                  <h3>CARA MENYELESAIKAN MASALAH SKRIN TV</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/og8BDpuLIEY"></iframe>
                  <h3>CARA MEMBAIKI MESIN BASUH YANG TIDAK BERPUSING</h3>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <iframe src="https://www.youtube.com/embed/G6GV3gUKJIY"></iframe>
                  <h3>CARA MENYELESAIKAN DAPUR GAS YANG TAK HIDUP</h3>
               </div>
            </div>
         </div>
      </div>
   </section>
<!-- END HOME-VIDEOS SECTION  -->

<!-- START HOME-MAPS SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ PERNIAGAAN YANG BERDEKATAN ]</h1>
           </div>
       </div>
   </section>

   <section class="home-maps" style="margin-top: -3rem;">
      <div class="swiper maps-slider">
         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/speedmart.png" alt="">
                  <a href="https://maps.app.goo.gl/zYcaAV1KGAZnaMRw7"><br><i class="fas fa-map-marker-alt"></br></i>99 Speedmart <br></br>Kedai TDK, No : 13 & 14 (Ground Floor, Pusat Bandar, 26900 Bandar Tun Abdul Razak, Pahang</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/eco.png" alt="">
                  <a href="https://maps.app.goo.gl/iCkDD6DTjyJ889XAA"><br><i class="fas fa-map-marker-alt"></br></i>Eco-Shop <br></br>No 5, Kedai TDK, Jalan Kerambit, Bandar Tun Razak, 26900 Keratong, Pahang</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/osiety.png" alt="">
                  <a href="https://maps.app.goo.gl/j5k3JiUfJ3mQXLG16"><br><i class="fas fa-map-marker-alt"></br></i>Osiety Inn <br></br>Kedai TDK, No 22, Tingkat 1, Felda Keratong 4, 26900 Bandar Tun Abdul Razak, Pahang</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/rieza.png" alt="">
                  <a href="https://maps.app.goo.gl/rwDpkSWa2fokwtiP8"><br><i class="fas fa-map-marker-alt"></br></i>Rieza Ranger Corner <br></br>Pusat, Jln Kerambit, Felda Keratong 4, 26900 Bandar Tun Abdul Razak, Pahang</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/juma.png" alt="">
                  <a href="https://maps.app.goo.gl/HbwtLbzL8G6zd9wt8"><br><i class="fas fa-map-marker-alt"></br></i>Juma Mobile Keratong <br></br>No. 10 Bawah, Kedai TDK, Jalan Sundang, Felda Keratong 4, 26900 Bandar Tun Abdul Razak, Pahang</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/carwash.png" alt="">
                  <a href="https://maps.app.goo.gl/cnthLFfNHtKvCRoy5"><br><i class="fas fa-map-marker-alt"></br></i>Cahaya Car Wash <br></br>KTR-3B, Off, Jln Kerambit, 26900 Bandar Tun Abdul Razak, <br>Pahang</br></a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/masakan.png" alt="">
                  <a href="https://maps.app.goo.gl/TyThTitKCqzdWDB68"><br><i class="fas fa-map-marker-alt"></br></i>Masakan Utara Selera Baru <br></br>GTR 9B, Felda Keratong 4, 26900 Bandar Tun Abdul Razak, <br>Pahang</br></a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/padang.png" alt="">
                  <a href="https://maps.app.goo.gl/FjBvjDkscZhT3wKN8"><br><i class="fas fa-map-marker-alt"></br></i>Padang Rekreasi <br></br>Felda Keratong 4, 26900 Bandar Tun Abdul Razak, <br>Pahang</br></a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/oppo.png" alt="">
                  <a href="https://maps.app.goo.gl/2xi9bbwDjnLCB17NA"><br><i class="fas fa-map-marker-alt"></br></i>Oppo <br></br>KEDAI DARA, GTR 10B, Jalan Sundang, 26900 Bandar Tun Abdul Razak, Pahang</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 44rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/smz.png" alt="">
                  <a href="https://maps.app.goo.gl/W4edWPZWX75M4zKD8"><br><i class="fas fa-map-marker-alt"></br></i>SMZ Enterprise <br></br>GTR-7B Jalan Kerambit Pusat, 26900 Bandar Tun Abdul Razak, Pahang</a>
               </div>
            </div>
         </div>
      </div>
   </section>
<!-- END HOME-MAPS SECTION  -->

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
// START JS FOR HOME-PRODUCTS
   document.addEventListener('DOMContentLoaded', function () {
      var productSlider = new Swiper('.products-slider', {
         loop: true,
         spaceBetween: 20,
         navigation: {
            nextEl: '.next-button',
            prevEl: '.prev-button',
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });

      function nextProductSlide() {
         productSlider.slideNext();
      }

      function prevProductSlide() {
         productSlider.slidePrev();
      }

      var productBoxes = document.querySelectorAll('.swiper-slide.product-slide');
      var maxHeight = 0;
      productBoxes.forEach(function(box) {
         maxHeight = Math.max(maxHeight, box.offsetHeight);
      });

      productBoxes.forEach(function(box) {
         box.style.height = maxHeight + 'px';
         box.style.overflowY = 'auto';
      });

      const formValues = document.querySelectorAll('.form-value');
      formValues.forEach(formValue => {
          formValue.addEventListener('click', function() {
              formValue.classList.toggle('expanded');
          });
      });

      const expandableElements = document.querySelectorAll('.expandable');
      expandableElements.forEach(element => {
         element.addEventListener('click', function() {
            element.classList.toggle('expanded');
         });
      });

      productBoxes.forEach(function(box) {
         box.addEventListener('click', function() {
            var formValues = box.querySelectorAll('.form-value');
            formValues.forEach(function(formValue) {
               formValue.classList.toggle('expanded');
            });
         });
      });
   });
// END JS FOR HOME-PRODUCTS

// START JS FOR HOME-VIDEOS
   document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper(".videos-slider", {
         loop: true,
         spaceBetween: 20,
         autoplay: {
            delay: 2000, // Adjust the delay in milliseconds (e.g., 5000 for 5 seconds)
            disableOnInteraction: false,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   });
// END JS FOR HOME-VIDEOS

// START JS FOR HOME-MAPS
   document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper(".maps-slider", {
         loop: true,
         spaceBetween: 20,
         autoplay: {
            delay: 2000, // Adjust the delay in milliseconds (e.g., 5000 for 5 seconds)
            disableOnInteraction: false,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   });
// END JS FOR HOME-MAPS
</script>

</body>
</html>